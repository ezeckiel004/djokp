<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\LocationReservation;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\LocationReservationConfirmation;
use App\Mail\LocationReservationCancellation;

class LocationReservationController extends Controller
{
    /**
     * Afficher les réservations de location
     */
    public function index()
    {
        $user = Auth::user();

        // Exclure les réservations annulées
        $reservations = LocationReservation::where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->orWhere('email', $user->email);
        })
            ->where('statut', '!=', 'annulee') // Exclure les annulées
            ->with('vehicle')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('client.location-reservations.index', compact('reservations'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $vehicles = Vehicle::available()->get();

        return view('client.location-reservations.create', compact('vehicles'));
    }

    /**
     * Enregistrer une nouvelle réservation
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
            'notes' => 'nullable|string|max:1000',
        ]);

        try {
            DB::beginTransaction();

            $vehicle = Vehicle::findOrFail($validated['vehicle_id']);

            // Vérifier si cet utilisateur a déjà réservé ce véhicule
            $existingReservation = LocationReservation::where('email', $user->email)
                ->where('vehicle_id', $validated['vehicle_id'])
                ->whereNotIn('statut', ['annulee', 'terminee'])
                ->first();

            if ($existingReservation) {
                throw new \Exception('Vous avez déjà une réservation en cours pour ce véhicule.');
            }

            // Vérifier que le véhicule est disponible
            if (!$vehicle->is_available) {
                throw new \Exception('Ce véhicule n\'est plus disponible.');
            }

            // Calculer la durée et le montant
            $date_debut = \Carbon\Carbon::parse($validated['date_debut']);
            $date_fin = \Carbon\Carbon::parse($validated['date_fin']);
            $duree_jours = $date_debut->diffInDays($date_fin) + 1;

            // Calculer le montant selon la durée
            if ($duree_jours <= 7) {
                $montant_total = $duree_jours * $vehicle->daily_rate;
            } elseif ($duree_jours <= 30) {
                $semaines = ceil($duree_jours / 7);
                $montant_total = $semaines * $vehicle->weekly_rate;
            } else {
                $mois = ceil($duree_jours / 30);
                $montant_total = $mois * $vehicle->monthly_rate;
            }

            // Créer la réservation
            $reservation = LocationReservation::create([
                'user_id' => $user->id,
                'nom' => $user->name,
                'email' => $user->email,
                'telephone' => $user->phone,
                'vehicle_id' => $validated['vehicle_id'],
                'date_debut' => $validated['date_debut'],
                'date_fin' => $validated['date_fin'],
                'montant_total' => $montant_total,
                'statut' => 'en_attente',
                'notes' => $validated['notes'] ?? null,
            ]);

            // Marquer le véhicule comme indisponible
            $vehicle->is_available = false;
            $vehicle->save();

            DB::commit();

            // Envoyer les emails de confirmation
            $this->sendReservationEmails($reservation);

            Log::info('Réservation de location créée par le client', [
                'user_id' => $user->id,
                'reservation_id' => $reservation->id,
                'reference' => $reservation->reference,
            ]);

            return redirect()->route('client.location-reservations.show', $reservation->id)
                ->with('success', 'Réservation créée avec succès! Votre référence: ' . $reservation->reference);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la création de réservation client', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', 'Une erreur est survenue: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Afficher les détails d'une réservation
     */
    public function show($id)
    {
        $user = Auth::user();

        $reservation = LocationReservation::where('id', $id)
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('email', $user->email);
            })
            ->with('vehicle')
            ->firstOrFail();

        return view('client.location-reservations.show', compact('reservation'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit($id)
    {
        $user = Auth::user();

        $reservation = LocationReservation::where('id', $id)
            ->where('user_id', $user->id)
            ->where('statut', 'en_attente')
            ->firstOrFail();

        $vehicles = Vehicle::all();

        return view('client.location-reservations.edit', compact('reservation', 'vehicles'));
    }

    /**
     * Mettre à jour une réservation
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $reservation = LocationReservation::where('id', $id)
            ->where('user_id', $user->id)
            ->where('statut', 'en_attente')
            ->firstOrFail();

        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'notes' => 'nullable|string|max:1000',
        ]);

        try {
            DB::beginTransaction();

            // Libérer l'ancien véhicule
            $oldVehicle = Vehicle::find($reservation->vehicle_id);
            $oldVehicle->is_available = true;
            $oldVehicle->save();

            // Vérifier le nouveau véhicule
            $newVehicle = Vehicle::findOrFail($validated['vehicle_id']);

            if (!$newVehicle->is_available) {
                DB::rollBack();
                return back()->with('error', 'Le véhicule sélectionné n\'est pas disponible.')
                    ->withInput();
            }

            // Calculer le nouveau montant
            $date_debut = \Carbon\Carbon::parse($validated['date_debut']);
            $date_fin = \Carbon\Carbon::parse($validated['date_fin']);
            $duree_jours = $date_debut->diffInDays($date_fin) + 1;

            // Calculer le montant selon la durée
            if ($duree_jours <= 7) {
                $montant_total = $duree_jours * $newVehicle->daily_rate;
            } elseif ($duree_jours <= 30) {
                $semaines = ceil($duree_jours / 7);
                $montant_total = $semaines * $newVehicle->weekly_rate;
            } else {
                $mois = ceil($duree_jours / 30);
                $montant_total = $mois * $newVehicle->monthly_rate;
            }

            // Mettre à jour la réservation
            $reservation->update([
                'vehicle_id' => $validated['vehicle_id'],
                'date_debut' => $validated['date_debut'],
                'date_fin' => $validated['date_fin'],
                'montant_total' => $montant_total,
                'notes' => $validated['notes'] ?? null,
            ]);

            // Bloquer le nouveau véhicule
            $newVehicle->is_available = false;
            $newVehicle->save();

            DB::commit();

            Log::info('Réservation de location mise à jour par le client', [
                'user_id' => $user->id,
                'reservation_id' => $reservation->id,
            ]);

            return redirect()->route('client.location-reservations.show', $reservation->id)
                ->with('success', 'Réservation mise à jour avec succès!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la mise à jour de réservation client', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', 'Une erreur est survenue: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Annuler une réservation (ancienne méthode destroy)
     */
    public function destroy($id)
    {
        $user = Auth::user();

        $reservation = LocationReservation::where('id', $id)
            ->where('user_id', $user->id)
            ->whereIn('statut', ['en_attente', 'confirmee'])
            ->firstOrFail();

        try {
            DB::beginTransaction();

            // Libérer le véhicule
            $vehicle = Vehicle::find($reservation->vehicle_id);
            $vehicle->is_available = true;
            $vehicle->save();

            // Mettre à jour le statut (annuler au lieu de supprimer)
            $reason = "Annulé par le client via l'espace client";
            $reservation->update([
                'statut' => 'annulee',
                'notes' => ($reservation->notes ? $reservation->notes . "\n" : '') . $reason
            ]);

            // Envoyer les emails d'annulation
            $this->sendCancellationEmails($reservation, $reason);

            DB::commit();

            Log::info('Réservation de location annulée par le client', [
                'user_id' => $user->id,
                'reservation_id' => $id,
            ]);

            return redirect()->route('client.location-reservations.index')
                ->with('success', 'Réservation annulée avec succès!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de l\'annulation de réservation client', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }

    /**
     * Annuler une réservation (nouvelle méthode avec raison)
     */
    public function cancel(Request $request, $id)
    {
        $user = Auth::user();

        $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        $reservation = LocationReservation::where('id', $id)
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('email', $user->email);
            })
            ->whereIn('statut', ['en_attente', 'confirmee'])
            ->firstOrFail();

        try {
            DB::beginTransaction();

            // Libérer le véhicule
            $vehicle = $reservation->vehicle;
            $vehicle->is_available = true;
            $vehicle->save();

            // Mettre à jour le statut
            $reason = $request->reason ?: "Sans raison spécifiée";
            $reasonText = "Annulé par le client : " . $reason;
            $reservation->update([
                'statut' => 'annulee',
                'notes' => ($reservation->notes ? $reservation->notes . "\n" : '') . $reasonText
            ]);

            // Envoyer les emails d'annulation
            $this->sendCancellationEmails($reservation, $reasonText);

            DB::commit();

            Log::info('Réservation de location annulée par le client', [
                'user_id' => $user->id,
                'reservation_id' => $id,
                'reason' => $reason,
            ]);

            return redirect()->route('client.location-reservations.index')
                ->with('success', 'Réservation annulée avec succès!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de l\'annulation de réservation client', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }

    /**
     * Méthode privée pour envoyer les emails de confirmation de réservation
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
     * Méthode privée pour envoyer les emails d'annulation
     */
    private function sendCancellationEmails(LocationReservation $reservation, $reason = null)
    {
        try {
            // 1. EMAIL AU CLIENT
            Mail::to($reservation->email)
                ->send(new LocationReservationCancellation($reservation, 'client', $reason));

            Log::info('Email d\'annulation envoyé au client pour la réservation: ' . $reservation->reference);

            // 2. EMAIL À L'ADMIN
            $adminEmail = $this->getAdminEmail();

            Mail::to($adminEmail)
                ->send(new LocationReservationCancellation($reservation, 'admin', $reason));

            Log::info('Email d\'annulation envoyé à l\'admin pour la réservation: ' . $reservation->reference);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi des emails d\'annulation pour la réservation ' . $reservation->reference . ': ' . $e->getMessage());
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
     * Vérifier la disponibilité d'un véhicule
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
}
