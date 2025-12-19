<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Vehicle;
use App\Mail\ReservationMail; // Pour la création
use App\Mail\ReservationUpdatedMail; // Pour la modification
use App\Mail\ReservationCancelledMail; // Pour l'annulation
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Afficher les réservations VTC
     */
    public function index()
    {
        $user = Auth::user();

        $reservations = Reservation::where('user_id', $user->id)
            ->orWhere('email', $user->email)
            ->with('vehicle')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('client.reservations.index', compact('reservations'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $vehicles = Vehicle::where('category', 'business')->available()->get();

        return view('client.reservations.create', compact('vehicles'));
    }

    /**
     * Enregistrer une nouvelle réservation VTC
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'type_service' => 'required|in:transfert,professionnel,evenement,mise_disposition',
            'depart' => 'required|string|max:255',
            'arrivee' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'heure' => 'required|date_format:H:i',
            'type_vehicule' => 'required|in:eco,business,prestige',
            'passagers' => 'required|string|in:1,2,3,4,5+',
            'instructions' => 'nullable|string|max:1000',
        ]);

        try {
            // Convertir la date
            $date = Carbon::parse($validated['date']);

            // Préparer les données pour l'email
            $reservationData = [
                'type_service' => $validated['type_service'],
                'depart' => $validated['depart'],
                'arrivee' => $validated['arrivee'],
                'date' => $date->format('Y-m-d'),
                'heure' => $validated['heure'],
                'type_vehicule' => $validated['type_vehicule'],
                'passagers' => $validated['passagers'],
                'nom' => $user->name,
                'telephone' => $user->phone,
                'email' => $user->email,
                'instructions' => $validated['instructions'] ?? null,
            ];

            // Calculer le montant estimé
            $estimatedAmount = $this->calculateEstimatedAmount($reservationData);

            // Convertir passagers en nombre pour le champ passengers
            $passengersCount = $this->convertPassagersToCount($reservationData['passagers']);

            // Créer la réservation selon le format du contrôleur principal
            $reservation = Reservation::create([
                'user_id' => $user->id,
                'vehicle_id' => null,

                // Champs obligatoires avec valeurs par défaut
                'type' => 'vtc_transport',
                'status' => 'pending',
                'total_amount' => $estimatedAmount,
                'deposit_amount' => 0.00,
                'passengers' => $passengersCount,
                'start_date' => $date,
                'end_date' => $date,

                // Champs de réservation publique
                'type_service' => $validated['type_service'],
                'depart' => $validated['depart'],
                'arrivee' => $validated['arrivee'],
                'date' => $date,
                'heure' => $validated['heure'],
                'type_vehicule' => $validated['type_vehicule'],
                'passagers' => $validated['passagers'],
                'nom' => $user->name,
                'telephone' => $user->phone,
                'email' => $user->email,
                'instructions' => $validated['instructions'] ?? null,

                // Champs de compatibilité
                'pickup_location' => $validated['depart'],
                'dropoff_location' => $validated['arrivee'],
                'pickup_time' => $validated['heure'],

                // Nouveaux champs
                'source' => 'client',
                'reference' => 'RES' . strtoupper(Str::random(8)),
                'is_vtc_booking' => true,
                'special_requests' => $validated['instructions'] ?? null,
            ]);

            // Envoyer l'email de création au client
            Mail::to($reservationData['email'])
                ->send(new ReservationMail($reservationData, 'client'));

            // Envoyer l'email de création à l'admin
            $adminEmail = config('mail.from.address', 'vtc@djokprestige.com');
            Mail::to($adminEmail)
                ->send(new ReservationMail($reservationData, 'admin'));

            // Envoyer un email de secours à un autre admin si nécessaire
            $secondaryAdminEmail = 'admin@djokprestige.com';
            if ($secondaryAdminEmail && $secondaryAdminEmail !== $adminEmail) {
                Mail::to($secondaryAdminEmail)
                    ->send(new ReservationMail($reservationData, 'admin'));
            }

            Log::info('Réservation VTC créée par le client', [
                'user_id' => $user->id,
                'reservation_id' => $reservation->id,
                'reference' => $reservation->reference,
            ]);

            return redirect()->route('client.reservations.show', $reservation->id)
                ->with('success', 'Réservation VTC créée avec succès! Votre référence: ' . $reservation->reference);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de réservation VTC', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Une erreur est survenue: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Afficher les détails d'une réservation VTC
     */
    public function show($id)
    {
        $user = Auth::user();

        $reservation = Reservation::where('id', $id)
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('email', $user->email);
            })
            ->firstOrFail();

        return view('client.reservations.show', compact('reservation'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit($id)
    {
        $user = Auth::user();

        $reservation = Reservation::where('id', $id)
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->firstOrFail();

        // Formater la date pour la vue
        if ($reservation->date) {
            $reservation->formatted_date = Carbon::parse($reservation->date)->format('Y-m-d');
        } else {
            $reservation->formatted_date = Carbon::today()->format('Y-m-d');
        }

        $vehicles = Vehicle::where('category', 'business')->get();

        return view('client.reservations.edit', compact('reservation', 'vehicles'));
    }

    /**
     * Mettre à jour une réservation VTC
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $reservation = Reservation::where('id', $id)
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->firstOrFail();

        $validated = $request->validate([
            'type_service' => 'required|in:transfert,professionnel,evenement,mise_disposition',
            'depart' => 'required|string|max:255',
            'arrivee' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'heure' => 'required|date_format:H:i',
            'type_vehicule' => 'required|in:eco,business,prestige',
            'passagers' => 'required|string|in:1,2,3,4,5+',
            'instructions' => 'nullable|string|max:1000',
        ]);

        try {
            // Convertir la date
            $date = Carbon::parse($validated['date']);

            // Détecter les changements
            $changes = $this->detectChanges($reservation, $validated);

            // Calculer le nouveau montant estimé
            $reservationData = array_merge($validated, [
                'nom' => $user->name,
                'telephone' => $user->phone,
                'email' => $user->email,
                'date' => $date->format('Y-m-d'),
            ]);

            $estimatedAmount = $this->calculateEstimatedAmount($reservationData);
            $passengersCount = $this->convertPassagersToCount($reservationData['passagers']);

            // Mettre à jour la réservation
            $reservation->update([
                'type_service' => $validated['type_service'],
                'depart' => $validated['depart'],
                'arrivee' => $validated['arrivee'],
                'date' => $date,
                'heure' => $validated['heure'],
                'type_vehicule' => $validated['type_vehicule'],
                'passagers' => $validated['passagers'],
                'instructions' => $validated['instructions'] ?? null,
                'start_date' => $date,
                'end_date' => $date,
                'pickup_time' => $validated['heure'],
                'pickup_location' => $validated['depart'],
                'dropoff_location' => $validated['arrivee'],
                'passengers' => $passengersCount,
                'special_requests' => $validated['instructions'] ?? null,
                'total_amount' => $estimatedAmount,
            ]);

            // Envoyer les emails de notification de modification
            $this->sendUpdateNotifications($reservation, $changes);

            Log::info('Réservation VTC mise à jour par le client', [
                'user_id' => $user->id,
                'reservation_id' => $reservation->id,
            ]);

            return redirect()->route('client.reservations.show', $reservation->id)
                ->with('success', 'Réservation mise à jour avec succès!');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour de réservation VTC', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Une erreur est survenue: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Supprimer une réservation VTC
     */
    public function destroy($id)
    {
        $user = Auth::user();

        $reservation = Reservation::where('id', $id)
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->firstOrFail();

        try {
            // Envoyer les emails de notification d'annulation
            $this->sendCancellationNotifications($reservation);

            // Supprimer la réservation
            $reservation->delete();

            Log::info('Réservation VTC annulée par le client', [
                'user_id' => $user->id,
                'reservation_id' => $id,
            ]);

            return redirect()->route('client.reservations.index')
                ->with('success', 'Réservation annulée avec succès!');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'annulation de réservation VTC', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }

    /**
     * Détecter les changements entre l'ancienne et la nouvelle réservation
     */
    private function detectChanges(Reservation $oldReservation, array $newData): array
    {
        $changes = [];
        $fieldLabels = [
            'type_service' => 'Type de service',
            'depart' => 'Lieu de départ',
            'arrivee' => 'Lieu d\'arrivée',
            'date' => 'Date',
            'heure' => 'Heure',
            'type_vehicule' => 'Type de véhicule',
            'passagers' => 'Nombre de passagers',
            'instructions' => 'Instructions',
        ];

        foreach ($fieldLabels as $field => $label) {
            $oldValue = $oldReservation->$field;
            $newValue = $newData[$field] ?? null;

            // Formater les valeurs pour l'affichage
            if ($field === 'date' && $oldValue) {
                $oldValue = Carbon::parse($oldValue)->locale('fr')->isoFormat('dddd D MMMM YYYY');
                $newValue = Carbon::parse($newValue)->locale('fr')->isoFormat('dddd D MMMM YYYY');
            }

            if ($field === 'type_service') {
                $serviceLabels = [
                    'transfert' => 'Transfert',
                    'professionnel' => 'Professionnel',
                    'evenement' => 'Événement',
                    'mise_disposition' => 'Mise à disposition',
                ];
                $oldValue = $serviceLabels[$oldValue] ?? $oldValue;
                $newValue = $serviceLabels[$newValue] ?? $newValue;
            }

            if ($field === 'type_vehicule') {
                $vehicleLabels = [
                    'eco' => 'Économique',
                    'business' => 'Business',
                    'prestige' => 'Prestige',
                ];
                $oldValue = $vehicleLabels[$oldValue] ?? $oldValue;
                $newValue = $vehicleLabels[$newValue] ?? $newValue;
            }

            // Pour les instructions nulles
            if ($field === 'instructions') {
                $oldValue = $oldValue ?? 'Aucune';
                $newValue = $newValue ?? 'Aucune';
            }

            if ($oldValue != $newValue) {
                $changes[$label] = [
                    'old' => $oldValue,
                    'new' => $newValue,
                ];
            }
        }

        return $changes;
    }

    /**
     * Envoyer les notifications de mise à jour (avec ReservationUpdatedMail)
     */
    private function sendUpdateNotifications(Reservation $reservation, array $changes): void
    {
        try {
            // Email au client (avec ReservationUpdatedMail)
            Mail::to($reservation->email)
                ->send(new ReservationUpdatedMail($reservation, 'client', $changes));

            // Email à l'admin principal (avec ReservationUpdatedMail)
            $adminEmail = config('mail.from.address', 'vtc@djokprestige.com');
            Mail::to($adminEmail)
                ->send(new ReservationUpdatedMail($reservation, 'admin', $changes));

            // Email à l'admin secondaire (avec ReservationUpdatedMail)
            $secondaryAdminEmail = 'admin@djokprestige.com';
            if ($secondaryAdminEmail && $secondaryAdminEmail !== $adminEmail) {
                Mail::to($secondaryAdminEmail)
                    ->send(new ReservationUpdatedMail($reservation, 'admin', $changes));
            }

            Log::info('Emails de mise à jour envoyés avec ReservationUpdatedMail', [
                'reservation_id' => $reservation->id,
                'client_email' => $reservation->email,
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi des emails de mise à jour', [
                'reservation_id' => $reservation->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Envoyer les notifications d'annulation (avec ReservationCancelledMail)
     */
    private function sendCancellationNotifications(Reservation $reservation): void
    {
        try {
            // Email au client (avec ReservationCancelledMail)
            Mail::to($reservation->email)
                ->send(new ReservationCancelledMail($reservation, 'client'));

            // Email à l'admin principal (avec ReservationCancelledMail)
            $adminEmail = config('mail.from.address', 'vtc@djokprestige.com');
            Mail::to($adminEmail)
                ->send(new ReservationCancelledMail($reservation, 'admin'));

            // Email à l'admin secondaire (avec ReservationCancelledMail)
            $secondaryAdminEmail = 'admin@djokprestige.com';
            if ($secondaryAdminEmail && $secondaryAdminEmail !== $adminEmail) {
                Mail::to($secondaryAdminEmail)
                    ->send(new ReservationCancelledMail($reservation, 'admin'));
            }

            Log::info('Emails d\'annulation envoyés avec ReservationCancelledMail', [
                'reservation_id' => $reservation->id,
                'client_email' => $reservation->email,
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi des emails d\'annulation', [
                'reservation_id' => $reservation->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Calcule un montant estimé pour la réservation
     */
    private function calculateEstimatedAmount(array $data): float
    {
        $basePrice = 50.00;
        $vehicleMultiplier = [
            'eco' => 1.0,
            'business' => 1.5,
            'prestige' => 2.0
        ];
        $multiplier = $vehicleMultiplier[$data['type_vehicule']] ?? 1.0;

        if ($data['passagers'] === '5+') {
            $multiplier *= 1.3;
        }

        $serviceMultiplier = [
            'transfert' => 1.0,
            'professionnel' => 1.2,
            'evenement' => 1.5,
            'mise_disposition' => 2.0
        ];
        $multiplier *= $serviceMultiplier[$data['type_service']] ?? 1.0;

        return round($basePrice * $multiplier, 2);
    }

    /**
     * Convertit la chaîne passagers en nombre
     */
    private function convertPassagersToCount(string $passagers): int
    {
        return $passagers === '5+' ? 5 : (int) $passagers;
    }
}
