<?php

namespace App\Http\Controllers;

use App\Models\LocationReservation;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\LocationReservationConfirmation;

class LocationReservationController extends Controller
{
    /**
     * Traiter la réservation
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'vehicle_id' => 'required|exists:vehicles,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
            'notes' => 'nullable|string|max:1000',
            'terms' => 'required|accepted',
        ]);

        try {
            DB::beginTransaction();

            // Récupérer le véhicule
            $vehicle = Vehicle::findOrFail($validated['vehicle_id']);

            // VÉRIFIER SI CET EMAIL A DÉJÀ RÉSERVÉ CE VÉHICULE
            $existingReservation = LocationReservation::where('email', $validated['email'])
                ->where('vehicle_id', $validated['vehicle_id'])
                ->whereNotIn('statut', ['annulee', 'terminee'])
                ->first();

            if ($existingReservation) {
                throw new \Exception('Vous avez déjà une réservation en cours pour ce véhicule avec cet email.');
            }

            // Vérifier que le véhicule est disponible
            if (!$vehicle->is_available) {
                throw new \Exception('Ce véhicule n\'est plus disponible.');
            }

            // NOTE: On ne vérifie PLUS la disponibilité pour la période
            // Les véhicules sont toujours disponibles si is_available = true

            // Calculer la durée en jours
            $debut = \Carbon\Carbon::parse($validated['date_debut']);
            $fin = \Carbon\Carbon::parse($validated['date_fin']);
            $dureeJours = $debut->diffInDays($fin) + 1;

            // Calculer le montant selon la durée
            if ($dureeJours <= 7) {
                // Tarif journalier
                $montantTotal = $dureeJours * $vehicle->daily_rate;
                $tarifType = 'journalier';
            } elseif ($dureeJours <= 30) {
                // Tarif hebdomadaire
                $semaines = ceil($dureeJours / 7);
                $montantTotal = $semaines * $vehicle->weekly_rate;
                $tarifType = 'hebdomadaire';
            } else {
                // Tarif mensuel
                $mois = ceil($dureeJours / 30);
                $montantTotal = $mois * $vehicle->monthly_rate;
                $tarifType = 'mensuel';
            }

            // Créer la réservation
            $reservation = LocationReservation::create([
                'nom' => $validated['nom'],
                'email' => $validated['email'],
                'telephone' => $validated['telephone'],
                'vehicle_id' => $validated['vehicle_id'],
                'date_debut' => $validated['date_debut'],
                'date_fin' => $validated['date_fin'],
                'montant_total' => $montantTotal,
                'statut' => 'en_attente',
                'notes' => $validated['notes'] ?? null,
            ]);

            DB::commit();

            // ENVOYER LES EMAILS AU CLIENT ET À L'ADMIN
            $this->sendReservationEmails($reservation);

            // Rediriger vers une page de confirmation
            return redirect()->route('location.reservation.confirmation', $reservation->reference)
                ->with('success', 'Votre demande de réservation a été envoyée avec succès. Un email de confirmation vous a été envoyé. Notre équipe vous contactera pour confirmer la disponibilité.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la création de la réservation: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }

    /**
     * Vérifier la disponibilité d'un véhicule - VERSION CORRIGÉE
     * TOUJOURS DISPONIBLE si is_available = true
     */
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        try {
            $vehicle = Vehicle::findOrFail($request->vehicle_id);

            // Vérifier si le véhicule est disponible (simplement is_available)
            $isAvailable = $vehicle->is_available === true;

            // Calculer la durée en jours
            $debut = \Carbon\Carbon::parse($request->date_debut);
            $fin = \Carbon\Carbon::parse($request->date_fin);
            $dureeJours = $debut->diffInDays($fin) + 1;

            // Calculer le prix estimé
            if ($dureeJours <= 7) {
                $montantEstime = $dureeJours * $vehicle->daily_rate;
                $tarifType = 'Tarif journalier';
            } elseif ($dureeJours <= 30) {
                $semaines = ceil($dureeJours / 7);
                $montantEstime = $semaines * $vehicle->weekly_rate;
                $tarifType = 'Tarif hebdomadaire';
            } else {
                $mois = ceil($dureeJours / 30);
                $montantEstime = $mois * $vehicle->monthly_rate;
                $tarifType = 'Tarif mensuel';
            }

            // Message personnalisé
            $message = $isAvailable
                ? 'Ce véhicule est disponible pour la période sélectionnée.'
                : 'Ce véhicule n\'est actuellement pas disponible à la location.';

            return response()->json([
                'available' => $isAvailable,
                'vehicle' => [
                    'id' => $vehicle->id,
                    'brand' => $vehicle->brand,
                    'model' => $vehicle->model,
                    'full_name' => $vehicle->full_name,
                    'category_fr' => $vehicle->category_fr,
                    'fuel_type_fr' => $vehicle->fuel_type_fr,
                    'daily_rate' => $vehicle->daily_rate,
                    'weekly_rate' => $vehicle->weekly_rate,
                    'monthly_rate' => $vehicle->monthly_rate,
                    'is_available' => $vehicle->is_available,
                ],
                'duree_jours' => $dureeJours,
                'montant_estime' => $montantEstime,
                'tarif_type' => $tarifType,
                'message' => $message,
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur dans checkAvailability: ' . $e->getMessage());

            return response()->json([
                'available' => false,
                'message' => 'Erreur lors de la vérification de disponibilité.',
            ], 500);
        }
    }

    /**
     * Méthode privée pour envoyer les emails
     */
    private function sendReservationEmails(LocationReservation $reservation)
    {
        try {
            // 1. EMAIL AU CLIENT
            Mail::to($reservation->email)
                ->send(new LocationReservationConfirmation($reservation, 'client'));

            Log::info('Email client envoyé pour la réservation: ' . $reservation->reference);

            // 2. EMAIL À L'ADMIN
            $adminEmail = $this->getAdminEmail();

            Mail::to($adminEmail)
                ->send(new LocationReservationConfirmation($reservation, 'admin'));

            Log::info('Email admin envoyé pour la réservation: ' . $reservation->reference);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi des emails pour la réservation ' . $reservation->reference . ': ' . $e->getMessage());
        }
    }

    /**
     * Méthode pour récupérer l'email admin
     */
    private function getAdminEmail()
    {
        // Option 1: Email depuis la configuration
        $configEmail = config('mail.admin_email');
        if ($configEmail) {
            return $configEmail;
        }

        // Option 2: Email par défaut
        $defaultEmail = config('mail.from.address');
        if ($defaultEmail) {
            return $defaultEmail;
        }

        // Option 3: Email fallback
        return 'admin@djokprestige.com';
    }

    /**
     * Afficher la confirmation de réservation
     */
    public function confirmation($reference)
    {
        $reservation = LocationReservation::where('reference', $reference)
            ->with('vehicle')
            ->firstOrFail();

        return view('location-reservation.confirmation', compact('reservation'));
    }

    /**
     * Afficher le formulaire de réservation
     */
    public function create()
    {
        $vehicles = Vehicle::where('is_available', true)->get();
        return view('location-reservation.create', compact('vehicles'));
    }

    /**
     * Liste des réservations pour un client
     */
    public function index()
    {
        if (auth()->check()) {
            $reservations = LocationReservation::where('email', auth()->user()->email)
                ->orWhere('user_id', auth()->id())
                ->with('vehicle')
                ->latest()
                ->paginate(10);

            return view('location-reservation.index', compact('reservations'));
        }

        return redirect()->route('location.reservation.create');
    }

    /**
     * Afficher les détails d'une réservation
     */
    public function show($reference)
    {
        $reservation = LocationReservation::where('reference', $reference)
            ->with('vehicle')
            ->firstOrFail();

        if (auth()->check()) {
            $user = auth()->user();
            if ($reservation->email !== $user->email && $reservation->user_id !== $user->id) {
                abort(403, 'Vous n\'avez pas accès à cette réservation.');
            }
        }

        return view('location-reservation.show', compact('reservation'));
    }

    /**
     * Annuler une réservation
     */
    public function cancel(Request $request, $reference)
    {
        $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            $reservation = LocationReservation::where('reference', $reference)->firstOrFail();

            if ($reservation->statut === 'annulee') {
                return back()->with('error', 'Cette réservation est déjà annulée.');
            }

            if ($reservation->statut === 'terminee') {
                return back()->with('error', 'Impossible d\'annuler une réservation terminée.');
            }

            // Mettre à jour le statut
            $reservation->update([
                'statut' => 'annulee',
                'notes' => $request->reason ? "Annulé : " . $request->reason : "Annulé par le client.",
            ]);

            // Libérer le véhicule
            $vehicle = $reservation->vehicle;
            $vehicle->update(['is_available' => true]);

            DB::commit();

            return back()->with('success', 'Votre réservation a été annulée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }

    /**
     * Télécharger le contrat de location
     */
    public function downloadContract($reference)
    {
        $reservation = LocationReservation::where('reference', $reference)
            ->with('vehicle')
            ->firstOrFail();

        if (auth()->check()) {
            $user = auth()->user();
            if ($reservation->email !== $user->email && $reservation->user_id !== $user->id) {
                abort(403, 'Vous n\'avez pas accès à cette réservation.');
            }
        }

        return view('location-reservation.contract', compact('reservation'));
    }
}
