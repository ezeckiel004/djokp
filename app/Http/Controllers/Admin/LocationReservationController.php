<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LocationReservation;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\LocationReservationStatusUpdated;

class LocationReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = LocationReservation::with(['vehicle', 'user'])
            ->latest()
            ->paginate(10);

        return view('admin.location-reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::where('is_available', true)->get();
        return view('admin.location-reservations.create', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
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
            'montant_total' => 'required|numeric|min:0',
            'statut' => 'required|in:en_attente,confirmee,en_cours,terminee,annulee',
            'notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // VÉRIFIER SI CET EMAIL A DÉJÀ RÉSERVÉ CE VÉHICULE
            $existingReservation = LocationReservation::where('email', $validated['email'])
                ->where('vehicle_id', $validated['vehicle_id'])
                ->whereNotIn('statut', ['annulee', 'terminee'])
                ->first();

            if ($existingReservation) {
                throw new \Exception('Cet email a déjà une réservation en cours pour ce véhicule.');
            }

            // Vérifier que le véhicule est disponible pour la période
            $vehicle = Vehicle::findOrFail($validated['vehicle_id']);

            if ($validated['statut'] !== 'en_attente') {
                // Pour les statuts confirmés/en cours, vérifier la disponibilité
                if (!$vehicle->isAvailableForPeriod($validated['date_debut'], $validated['date_fin'])) {
                    throw new \Exception('Ce véhicule n\'est pas disponible pour la période sélectionnée.');
                }
            }

            $reservation = LocationReservation::create($validated);

            // Mettre à jour la disponibilité du véhicule seulement si la réservation est confirmée/en cours
            if (in_array($validated['statut'], ['confirmee', 'en_cours'])) {
                $vehicle->is_available = false;
                $vehicle->save();
            }

            DB::commit();

            // ENVOYER L'EMAIL DE CRÉATION DE RÉSERVATION
            $emailResult = $this->sendStatusUpdateEmail($reservation, $reservation->statut, null, "Votre réservation a été créée avec succès.");

            if ($emailResult) {
                Log::info('Email de création envoyé avec succès pour la réservation: ' . $reservation->reference);
            } else {
                Log::warning('Email de création non envoyé pour la réservation: ' . $reservation->reference);
            }

            return redirect()->route('admin.location-reservations.index')
                ->with('success', 'Réservation créée avec succès.' . ($emailResult ? '' : ' (Note: Email non envoyé)'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LocationReservation $locationReservation)
    {
        $locationReservation->load(['vehicle', 'user']);
        return view('admin.location-reservations.show', compact('locationReservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LocationReservation $locationReservation)
    {
        $vehicles = Vehicle::all();
        return view('admin.location-reservations.edit', compact('locationReservation', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LocationReservation $locationReservation)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'vehicle_id' => 'required|exists:vehicles,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'montant_total' => 'required|numeric|min:0',
            'statut' => 'required|in:en_attente,confirmee,en_cours,terminee,annulee',
            'notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $ancienStatut = $locationReservation->statut;
            $nouveauStatut = $validated['statut'];

            // VÉRIFIER SI CET EMAIL A DÉJÀ UNE AUTRE RÉSERVATION POUR CE VÉHICULE (autre que celle en cours)
            if ($locationReservation->email !== $validated['email'] || $locationReservation->vehicle_id !== $validated['vehicle_id']) {
                $existingReservation = LocationReservation::where('email', $validated['email'])
                    ->where('vehicle_id', $validated['vehicle_id'])
                    ->where('id', '!=', $locationReservation->id)
                    ->whereNotIn('statut', ['annulee', 'terminee'])
                    ->first();

                if ($existingReservation) {
                    throw new \Exception('Cet email a déjà une autre réservation en cours pour ce véhicule.');
                }
            }

            // Vérifier si le statut change
            if ($ancienStatut !== $nouveauStatut) {
                // Si le véhicule a changé, mettre à jour les disponibilités
                if ($locationReservation->vehicle_id != $validated['vehicle_id']) {
                    // Libérer l'ancien véhicule s'il était réservé
                    if (in_array($ancienStatut, ['confirmee', 'en_cours'])) {
                        $oldVehicle = Vehicle::find($locationReservation->vehicle_id);
                        $oldVehicle->is_available = true;
                        $oldVehicle->save();
                    }

                    // Vérifier la disponibilité du nouveau véhicule
                    $newVehicle = Vehicle::find($validated['vehicle_id']);

                    // Bloquer le nouveau véhicule seulement si la réservation est confirmée/en cours
                    if (in_array($nouveauStatut, ['confirmee', 'en_cours'])) {
                        // Vérifier que le nouveau véhicule est disponible pour la période
                        if (!$newVehicle->isAvailableForPeriod($validated['date_debut'], $validated['date_fin'])) {
                            throw new \Exception('Le nouveau véhicule n\'est pas disponible pour la période sélectionnée.');
                        }
                        $newVehicle->is_available = false;
                        $newVehicle->save();
                    }
                } else {
                    // Même véhicule, gestion du changement de statut
                    $vehicle = $locationReservation->vehicle;

                    // Si on passe de en_attente à confirmée/en cours
                    if (($ancienStatut === 'en_attente' || $ancienStatut === 'annulee') &&
                        in_array($nouveauStatut, ['confirmee', 'en_cours'])
                    ) {
                        // Vérifier que le véhicule est toujours disponible
                        if (!$vehicle->isAvailableForPeriod($validated['date_debut'], $validated['date_fin'])) {
                            throw new \Exception('Le véhicule n\'est pas disponible pour la période sélectionnée.');
                        }
                        $vehicle->is_available = false;
                        $vehicle->save();
                    }
                    // Si on passe de confirmée/en cours à annulée/terminée
                    elseif (
                        in_array($ancienStatut, ['confirmee', 'en_cours']) &&
                        in_array($nouveauStatut, ['annulee', 'terminee', 'en_attente'])
                    ) {
                        // Vérifier si le véhicule n'a pas d'autres réservations actives
                        $hasOtherActiveReservations = LocationReservation::where('vehicle_id', $vehicle->id)
                            ->where('id', '!=', $locationReservation->id)
                            ->whereIn('statut', ['confirmee', 'en_cours'])
                            ->exists();

                        if (!$hasOtherActiveReservations) {
                            $vehicle->is_available = true;
                            $vehicle->save();
                        }
                    }
                }
            }

            $locationReservation->update($validated);

            DB::commit();

            // ENVOYER L'EMAIL DE MISE À JOUR SI LE STATUT A CHANGÉ
            $emailResult = true;
            if ($ancienStatut !== $nouveauStatut) {
                $emailResult = $this->sendStatusUpdateEmail($locationReservation, $nouveauStatut, $ancienStatut, $validated['notes'] ?? null);

                if ($emailResult) {
                    Log::info('Email de mise à jour envoyé avec succès pour la réservation: ' . $locationReservation->reference);
                } else {
                    Log::warning('Email de mise à jour non envoyé pour la réservation: ' . $locationReservation->reference);
                }
            }

            return redirect()->route('admin.location-reservations.index')
                ->with('success', 'Réservation mise à jour avec succès.' . ($emailResult ? '' : ' (Note: Email non envoyé)'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LocationReservation $locationReservation)
    {
        try {
            DB::beginTransaction();

            // ENVOYER L'EMAIL D'ANNULATION AVANT SUPPRESSION
            $emailResult = $this->sendStatusUpdateEmail($locationReservation, 'annulee', $locationReservation->statut, "Votre réservation a été supprimée par notre équipe.");

            if ($emailResult) {
                Log::info('Email d\'annulation envoyé avec succès pour la réservation: ' . $locationReservation->reference);
            } else {
                Log::warning('Email d\'annulation non envoyé pour la réservation: ' . $locationReservation->reference);
            }

            // Libérer le véhicule s'il était réservé
            if (in_array($locationReservation->statut, ['confirmee', 'en_cours'])) {
                $vehicle = Vehicle::find($locationReservation->vehicle_id);

                // Vérifier si le véhicule n'a pas d'autres réservations actives
                $hasOtherActiveReservations = LocationReservation::where('vehicle_id', $vehicle->id)
                    ->where('id', '!=', $locationReservation->id)
                    ->whereIn('statut', ['confirmee', 'en_cours'])
                    ->exists();

                if (!$hasOtherActiveReservations) {
                    $vehicle->is_available = true;
                    $vehicle->save();
                }
            }

            $locationReservation->delete();

            DB::commit();

            return redirect()->route('admin.location-reservations.index')
                ->with('success', 'Réservation supprimée avec succès.' . ($emailResult ? '' : ' (Note: Email non envoyé)'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }

    /**
     * Mettre à jour le statut d'une réservation
     */
    public function updateStatus(Request $request, LocationReservation $locationReservation)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,confirmee,en_cours,terminee,annulee',
            'notes' => 'nullable|string|max:1000',
        ]);

        try {
            DB::beginTransaction();

            $ancienStatut = $locationReservation->statut;
            $nouveauStatut = $request->statut;
            $notes = $request->notes;

            // LOG INITIAL
            Log::info('=== DEBUT updateStatus ===');
            Log::info('Réservation: ' . $locationReservation->reference);
            Log::info('Email client: ' . $locationReservation->email);
            Log::info('Changement: ' . $ancienStatut . ' → ' . $nouveauStatut);
            Log::info('Notes: ' . ($notes ?: 'Aucune'));

            // Ne rien faire si le statut est le même
            if ($ancienStatut === $nouveauStatut) {
                Log::info('Statut identique - Pas de changement');
                DB::commit();
                return redirect()->back()
                    ->with('info', 'Le statut est déjà ' . $locationReservation->statut_fr . '.');
            }

            // Mettre à jour la réservation
            $locationReservation->update([
                'statut' => $nouveauStatut,
                'notes' => $notes ? ($locationReservation->notes ? $locationReservation->notes . "\n\n" . date('d/m/Y H:i') . " - Changement de statut: " . $notes : date('d/m/Y H:i') . " - Changement de statut: " . $notes) : $locationReservation->notes
            ]);

            // Gestion de la disponibilité du véhicule
            $vehicle = $locationReservation->vehicle;

            if ($ancienStatut !== $nouveauStatut) {
                // Si on passe de en_attente/annulée à confirmée/en cours
                if (($ancienStatut === 'en_attente' || $ancienStatut === 'annulee') &&
                    in_array($nouveauStatut, ['confirmee', 'en_cours'])
                ) {
                    // Vérifier que le véhicule est toujours disponible
                    if (!$vehicle->isAvailableForPeriod($locationReservation->date_debut, $locationReservation->date_fin)) {
                        // Annuler le changement si le véhicule n'est plus disponible
                        $locationReservation->update(['statut' => $ancienStatut]);
                        throw new \Exception('Le véhicule n\'est plus disponible pour cette période.');
                    }
                    $vehicle->is_available = false;
                    $vehicle->save();
                }
                // Si on passe de confirmée/en cours à annulée/terminée/en_attente
                elseif (
                    in_array($ancienStatut, ['confirmee', 'en_cours']) &&
                    in_array($nouveauStatut, ['annulee', 'terminee', 'en_attente'])
                ) {
                    // Vérifier si le véhicule n'a pas d'autres réservations actives
                    $hasOtherActiveReservations = LocationReservation::where('vehicle_id', $vehicle->id)
                        ->where('id', '!=', $locationReservation->id)
                        ->whereIn('statut', ['confirmee', 'en_cours'])
                        ->exists();

                    if (!$hasOtherActiveReservations) {
                        $vehicle->is_available = true;
                        $vehicle->save();
                    }
                }
            }

            DB::commit();

            Log::info('Base de données mise à jour avec succès');
            Log::info('--- DEBUT ENVOI EMAIL ---');

            // ENVOYER L'EMAIL HTML AU CLIENT
            $emailResult = $this->sendStatusUpdateEmail($locationReservation, $nouveauStatut, $ancienStatut, $notes);

            if ($emailResult) {
                Log::info('✅ Email HTML envoyé avec succès');
                $message = 'Statut mis à jour avec succès et email envoyé.';
            } else {
                Log::info('⚠️ Email HTML NON envoyé');
                $message = 'Statut mis à jour avec succès. (Note: Email non envoyé)';
            }

            Log::info('=== FIN updateStatus ===');

            return redirect()->back()
                ->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('ERREUR updateStatus: ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }

    /**
     * Envoyer l'email HTML de mise à jour de statut
     */
    private function sendStatusUpdateEmail($reservation, $nouveauStatut, $ancienStatut, $notes = null)
    {
        Log::info('--- DEBUT sendStatusUpdateEmail ---');
        Log::info('ID Réservation: ' . $reservation->id);
        Log::info('Référence: ' . $reservation->reference);

        try {
            // Vérifier que l'email n'est pas vide
            if (empty($reservation->email)) {
                Log::error('❌ Email vide pour la réservation');
                return false;
            }

            Log::info('Email à envoyer: ' . $reservation->email);

            // Vérifier que l'adresse email est valide
            if (!filter_var($reservation->email, FILTER_VALIDATE_EMAIL)) {
                Log::error('❌ Email invalide: ' . $reservation->email);
                return false;
            }

            Log::info('✅ Email valide');

            // Préparer le message personnalisé
            $messagePersonnalise = $notes;
            if (!$messagePersonnalise) {
                // Message par défaut selon le statut
                $messagePersonnalise = match ($nouveauStatut) {
                    'confirmee' => 'Votre réservation a été confirmée. Notre équipe vous contactera pour les prochaines étapes.',
                    'en_cours' => 'Votre location est maintenant en cours. Profitez bien de votre véhicule !',
                    'terminee' => 'Votre location est terminée. Merci de nous avoir choisi !',
                    'annulee' => 'Votre réservation a été annulée. Nous restons à votre disposition pour toute nouvelle demande.',
                    default => 'Le statut de votre réservation a été mis à jour.'
                };
            }

            Log::info('Message personnalisé: ' . $messagePersonnalise);
            Log::info('Nouveau statut: ' . $nouveauStatut);
            Log::info('Ancien statut: ' . ($ancienStatut ?: 'Aucun'));

            // Créer l'email HTML
            $mail = new LocationReservationStatusUpdated($reservation, $nouveauStatut, $ancienStatut, $messagePersonnalise);

            Log::info('--- ENVOI EMAIL HTML ---');
            Log::info('Objet: ' . $mail->envelope()->subject);
            Log::info('De: ' . config('mail.from.address'));
            Log::info('À: ' . $reservation->email);

            // Envoyer l'email HTML
            Mail::to($reservation->email)
                ->send($mail);

            // Vérifier les échecs
            $failures = Mail::failures();
            if (count($failures) > 0) {
                Log::error('❌ Échec envoi email HTML: ' . implode(', ', $failures));
                return false;
            }

            Log::info('✅ Email HTML envoyé avec succès');

            // Logger dans le modèle
            $reservation->logEmailSent('changement_statut', 'succes', 'Email de changement de statut envoyé');

            Log::info('--- FIN sendStatusUpdateEmail ---');

            return true;
        } catch (\Exception $e) {
            Log::error('❌ Exception sendStatusUpdateEmail: ' . $e->getMessage());
            Log::error('Fichier: ' . $e->getFile());
            Log::error('Ligne: ' . $e->getLine());
            Log::error('Trace: ' . $e->getTraceAsString());
            return false;
        }
    }

    /**
     * Méthode de test direct (à appeler depuis une route)
     */
    public function testEmail(Request $request, $id)
    {
        $reservation = LocationReservation::findOrFail($id);

        Log::info('=== TEST EMAIL MANUEL ===');
        Log::info('Réservation: ' . $reservation->reference);
        Log::info('Email: ' . $reservation->email);

        try {
            // Test : Envoyer un email HTML complet
            $mail = new LocationReservationStatusUpdated($reservation, 'confirmee', 'en_attente', 'Ceci est un email de test manuel');

            Mail::to($reservation->email)
                ->send($mail);

            $result = count(Mail::failures()) > 0 ? 'ÉCHEC: ' . implode(', ', Mail::failures()) : 'SUCCÈS';

            Log::info('Résultat test: ' . $result);
            Log::info('=== FIN TEST ===');

            return response()->json([
                'success' => count(Mail::failures()) === 0,
                'message' => $result,
                'email' => $reservation->email,
                'failures' => Mail::failures()
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur test: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
