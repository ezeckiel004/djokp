<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ReservationConfirmation;
use App\Mail\AdminReservationNotification;
use Carbon\Carbon;

class PublicReservationController extends Controller
{
    public function create()
    {
        return view('public.vtc-reservation');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'user_phone' => 'required|string|max:20',
            'pickup_location' => 'required|string|max:500',
            'dropoff_location' => 'required|string|max:500',
            'start_date' => 'required|date|after_or_equal:today',
            'pickup_time' => 'required|date_format:H:i',
            'vehicle_type' => 'required|in:eco,business,prestige',
            'passengers' => 'required|integer|min:1|max:20',
            'special_requests' => 'nullable|string|max:1000',
            'payment_method' => 'nullable|in:cash,card,online',
            'agree_terms' => 'required|accepted',
        ]);

        try {
            $reference = 'VTC-' . strtoupper(uniqid());

            // Calcul du prix estimé
            $basePrices = ['eco' => 45, 'business' => 65, 'prestige' => 90];
            $estimatedPrice = $basePrices[$validated['vehicle_type']] ?? 65;

            // Email au client
            $clientEmailData = [
                'reference' => $reference,
                'start_date' => $validated['start_date'],
                'pickup_time' => $validated['pickup_time'],
                'pickup_location' => $validated['pickup_location'],
                'dropoff_location' => $validated['dropoff_location'],
                'vehicle_type' => ucfirst($validated['vehicle_type']),
                'passengers' => $validated['passengers'],
                'estimated_price' => $estimatedPrice,
                'status' => 'pending',
                'special_requests' => $validated['special_requests'] ?? null,
                'payment_method' => $validated['payment_method'] ?? 'À confirmer',
            ];

            Mail::to($validated['user_email'])
                ->send(new ReservationConfirmation($clientEmailData, $validated['user_name']));

            // Email à l'admin
            $adminEmailData = [
                'reference' => $reference,
                'start_date' => $validated['start_date'],
                'pickup_time' => $validated['pickup_time'],
                'pickup_location' => $validated['pickup_location'],
                'dropoff_location' => $validated['dropoff_location'],
                'vehicle_type' => ucfirst($validated['vehicle_type']),
                'passengers' => $validated['passengers'],
                'estimated_price' => $estimatedPrice,
                'status' => 'pending',
                'source' => 'formulaire public',
            ];

            $userInfo = [
                'name' => $validated['user_name'],
                'email' => $validated['user_email'],
                'phone' => $validated['user_phone'],
            ];

            Mail::to(config('mail.admin_address', 'admin@example.com'))
                ->send(new AdminReservationNotification($adminEmailData, $userInfo));

            return redirect()->back()
                ->with('success', 'Votre réservation a été envoyée avec succès. Vous allez recevoir un email de confirmation.');
        } catch (\Exception $e) {
            Log::error('Erreur formulaire public : ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Une erreur est survenue. Veuillez réessayer ou nous contacter directement.')
                ->withInput();
        }
    }
}
