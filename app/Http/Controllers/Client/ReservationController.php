<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Vehicle;
use App\Models\VehicleCategory;
use App\Mail\ReservationMail;
use App\Mail\ReservationUpdatedMail;
use App\Mail\ReservationCancelledMail;
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
        // Utiliser VehicleCategory au lieu de Vehicle
        $vehicleCategories = VehicleCategory::where('actif', true)
            ->orderBy('display_name')
            ->get();

        return view('client.reservations.create', compact('vehicleCategories'));
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
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
            'passagers' => 'required|string|in:1,2,3,4,5,6,7,8',
            'instructions' => 'nullable|string|max:1000',
        ]);

        try {
            // Convertir la date
            $date = Carbon::parse($validated['date']);

            // Récupérer la catégorie de véhicule
            $vehicleCategory = VehicleCategory::findOrFail($validated['vehicle_category_id']);

            // Convertir passagers en nombre
            $passengersCount = $this->convertPassagersToCount($validated['passagers']);

            // Calculer le montant estimé
            $estimatedAmount = $this->calculateEstimatedAmount($validated, $vehicleCategory);

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
                'type_vehicule' => $vehicleCategory->display_name,
                'vehicle_category_id' => $vehicleCategory->id,
                'passagers' => $validated['passagers'],
                'nom' => $user->name,
                'telephone' => $user->phone ?? 'Non renseigné',
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

            // Préparer les données pour l'email
            $emailData = [
                'nom' => $user->name,
                'email' => $user->email,
                'telephone' => $user->phone ?? 'Non renseigné',
                'depart' => $validated['depart'],
                'arrivee' => $validated['arrivee'],
                'date' => $date->format('d/m/Y'),
                'heure' => $validated['heure'],
                'type_service' => $validated['type_service'],
                'type_service_label' => $this->getServiceTypeLabel($validated['type_service']),
                'type_vehicule' => $vehicleCategory->display_name,
                'vehicle_category_name' => $vehicleCategory->display_name,
                'passagers' => $validated['passagers'],
                'instructions' => $validated['instructions'] ?? null,
                'reference' => $reservation->reference,
                'estimated_amount' => number_format($estimatedAmount, 2, ',', ' ') . ' €',
            ];

            // Envoyer l'email de création au client
            Mail::to($user->email)
                ->send(new ReservationMail($emailData, 'client'));

            // Envoyer l'email de création à l'admin
            $adminEmail = config('mail.from.address', 'vtc@djokprestige.com');
            Mail::to($adminEmail)
                ->send(new ReservationMail($emailData, 'admin'));

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

        // Utiliser VehicleCategory
        $vehicleCategories = VehicleCategory::where('actif', true)
            ->orderBy('display_name')
            ->get();

        return view('client.reservations.edit', compact('reservation', 'vehicleCategories'));
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
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
            'passagers' => 'required|string|in:1,2,3,4,5,6,7,8',
            'instructions' => 'nullable|string|max:1000',
        ]);

        try {
            // Convertir la date
            $date = Carbon::parse($validated['date']);

            // Récupérer la catégorie de véhicule
            $vehicleCategory = VehicleCategory::findOrFail($validated['vehicle_category_id']);

            // Détecter les changements
            $changes = $this->detectChanges($reservation, $validated, $vehicleCategory);

            // Convertir passagers en nombre
            $passengersCount = $this->convertPassagersToCount($validated['passagers']);

            // Calculer le nouveau montant estimé
            $estimatedAmount = $this->calculateEstimatedAmount($validated, $vehicleCategory);

            // Mettre à jour la réservation
            $reservation->update([
                'type_service' => $validated['type_service'],
                'depart' => $validated['depart'],
                'arrivee' => $validated['arrivee'],
                'date' => $date,
                'heure' => $validated['heure'],
                'type_vehicule' => $vehicleCategory->display_name,
                'vehicle_category_id' => $vehicleCategory->id,
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
    private function detectChanges(Reservation $oldReservation, array $newData, VehicleCategory $vehicleCategory): array
    {
        $changes = [];
        $fieldLabels = [
            'type_service' => 'Type de service',
            'depart' => 'Lieu de départ',
            'arrivee' => 'Lieu d\'arrivée',
            'date' => 'Date',
            'heure' => 'Heure',
            'vehicle_category_id' => 'Type de véhicule',
            'passagers' => 'Nombre de passagers',
            'instructions' => 'Instructions',
        ];

        foreach ($fieldLabels as $field => $label) {
            $oldValue = $oldReservation->$field;
            $newValue = $newData[$field] ?? null;

            // Gestion spéciale pour vehicle_category_id
            if ($field === 'vehicle_category_id') {
                $oldCategory = VehicleCategory::find($oldReservation->vehicle_category_id);
                $oldValue = $oldCategory ? $oldCategory->display_name : 'Inconnu';
                $newValue = $vehicleCategory->display_name;
            }

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
     * Envoyer les notifications de mise à jour
     */
    private function sendUpdateNotifications(Reservation $reservation, array $changes): void
    {
        try {
            // Email au client
            Mail::to($reservation->email)
                ->send(new ReservationUpdatedMail($reservation, 'client', $changes));

            // Email à l'admin principal
            $adminEmail = config('mail.from.address', 'vtc@djokprestige.com');
            Mail::to($adminEmail)
                ->send(new ReservationUpdatedMail($reservation, 'admin', $changes));

            Log::info('Emails de mise à jour envoyés', [
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
     * Envoyer les notifications d'annulation
     */
    private function sendCancellationNotifications(Reservation $reservation): void
    {
        try {
            // Email au client
            Mail::to($reservation->email)
                ->send(new ReservationCancelledMail($reservation, 'client'));

            // Email à l'admin principal
            $adminEmail = config('mail.from.address', 'vtc@djokprestige.com');
            Mail::to($adminEmail)
                ->send(new ReservationCancelledMail($reservation, 'admin'));

            Log::info('Emails d\'annulation envoyés', [
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
    private function calculateEstimatedAmount(array $data, VehicleCategory $vehicleCategory): float
    {
        // Utiliser la logique similaire au contrôleur principal
        $basePrice = $vehicleCategory->prise_en_charge;

        // Estimation simplifiée (vous pouvez améliorer cette logique)
        $estimatedDistance = 20; // km par défaut
        $distancePrice = $estimatedDistance * $vehicleCategory->prix_au_km;

        $priceHT = $basePrice + $distancePrice;

        // Appliquer le prix minimum
        if ($priceHT < $vehicleCategory->prix_minimum) {
            $priceHT = $vehicleCategory->prix_minimum;
        }

        // Multiplier par le nombre de passagers
        $passengers = $this->convertPassagersToCount($data['passagers']);
        $priceHT = $priceHT * $passengers;

        // TVA 10%
        $priceTTC = $priceHT * 1.1;

        return round($priceTTC, 2);
    }

    /**
     * Retourne le label du type de service
     */
    private function getServiceTypeLabel(string $type): string
    {
        $labels = [
            'transfert' => 'Transfert aéroport/gare',
            'professionnel' => 'Déplacement professionnel',
            'evenement' => 'Événement/mariage',
            'mise_disposition' => 'Mise à disposition'
        ];

        return $labels[$type] ?? $type;
    }

    /**
     * Convertit la chaîne passagers en nombre
     */
    private function convertPassagersToCount(string $passagers): int
    {
        return (int) $passagers;
    }
}
