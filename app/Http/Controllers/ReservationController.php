<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ReservationMail;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservation');
    }

    public function submit(Request $request)
    {
        \Log::info('Début du traitement de la réservation', ['ip' => $request->ip()]);

        // Validation des données
        $validator = Validator::make($request->all(), [
            'type_service' => 'required|in:transfert,professionnel,evenement,mise_disposition',
            'depart' => 'required|string|max:255',
            'arrivee' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'heure' => 'required|date_format:H:i',
            'type_vehicule' => 'required|in:eco,business,prestige',
            'passagers' => 'required|string|in:1,2,3,4,5+',
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'instructions' => 'nullable|string|max:1000',
        ], [
            'passagers.in' => 'Veuillez sélectionner un nombre de passagers valide.',
            'date.after_or_equal' => 'La date doit être aujourd\'hui ou une date future.',
            'heure.date_format' => 'Veuillez entrer une heure valide (format HH:MM).',
        ]);

        if ($validator->fails()) {
            \Log::warning('Validation échouée', ['errors' => $validator->errors()->toArray()]);
            return redirect()->route('reservation')
                ->withErrors($validator)
                ->withInput();
        }

        $reservationData = $validator->validated();

        try {
            \Log::info('Création de la réservation', ['email' => $reservationData['email']]);

            // 1. Vérifier si l'utilisateur est connecté
            $userId = auth()->check() ? auth()->id() : null;

            // 2. Calculer un montant estimé
            $estimatedAmount = $this->calculateEstimatedAmount($reservationData);

            // 3. Convertir passagers en nombre pour le champ passengers
            $passengersCount = $this->convertPassagersToCount($reservationData['passagers']);

            // 4. Préparer les données pour l'insertion
            $dataToInsert = [
                // Champs utilisateur (nullable)
                'user_id' => $userId, // NULL si pas connecté
                'vehicle_id' => null, // Pas de véhicule spécifié pour VTC

                // Champs obligatoires avec valeurs par défaut
                'type' => 'vtc_transport',
                'status' => 'pending',
                'total_amount' => $estimatedAmount,
                'deposit_amount' => 0.00,
                'passengers' => $passengersCount,
                'start_date' => $reservationData['date'], // DOIT avoir une valeur
                'end_date' => $reservationData['date'], // DOIT avoir une valeur

                // Champs de réservation publique
                'type_service' => $reservationData['type_service'],
                'depart' => $reservationData['depart'],
                'arrivee' => $reservationData['arrivee'],
                'date' => $reservationData['date'],
                'heure' => $reservationData['heure'],
                'type_vehicule' => $reservationData['type_vehicule'],
                'passagers' => $reservationData['passagers'],
                'nom' => $reservationData['nom'],
                'telephone' => $reservationData['telephone'],
                'email' => $reservationData['email'],
                'instructions' => $reservationData['instructions'] ?? null,

                // Champs de compatibilité
                'pickup_location' => $reservationData['depart'],
                'dropoff_location' => $reservationData['arrivee'],
                'pickup_time' => $reservationData['heure'],

                // Nouveaux champs
                'source' => $userId ? 'client' : 'public',
                'reference' => 'RES' . strtoupper(Str::random(8)),
                'is_vtc_booking' => true,
                'special_requests' => $reservationData['instructions'] ?? null,
            ];

            \Log::info('Données à insérer:', $dataToInsert);

            // 5. Sauvegarder en base de données
            $reservation = Reservation::create($dataToInsert);

            \Log::info('Réservation créée', [
                'id' => $reservation->id,
                'reference' => $reservation->reference,
                'user_id' => $userId
            ]);

            // 6. Envoyer l'email au client
            \Log::info('Envoi email client');
            Mail::to($reservationData['email'])
                ->send(new ReservationMail($reservationData, 'client'));

            // 7. Envoyer l'email à l'admin
            $adminEmail = config('mail.from.address', 'vtc@djokprestige.com');
            \Log::info('Envoi email admin', ['admin_email' => $adminEmail]);
            Mail::to($adminEmail)
                ->send(new ReservationMail($reservationData, 'admin'));

            // 8. Envoyer un email de secours à un autre admin si nécessaire
            $secondaryAdminEmail = 'admin@djokprestige.com';
            if ($secondaryAdminEmail && $secondaryAdminEmail !== $adminEmail) {
                \Log::info('Envoi email admin secondaire');
                Mail::to($secondaryAdminEmail)
                    ->send(new ReservationMail($reservationData, 'admin'));
            }

            \Log::info('Réservation traitée avec succès');

            return redirect()->route('reservation')
                ->with('success', 'Votre réservation a été envoyée avec succès ! Vous allez recevoir un email de confirmation avec la référence : ' . $reservation->reference);
        } catch (\Exception $e) {
            // Log l'erreur pour le débogage
            \Log::error('Erreur création réservation: ' . $e->getMessage());
            \Log::error('Trace: ' . $e->getTraceAsString());
            \Log::error('Données de réservation:', $reservationData);
            \Log::error('Données à insérer:', $dataToInsert ?? []);

            return redirect()->route('reservation')
                ->with('error', 'Une erreur est survenue lors de l\'envoi: ' . $e->getMessage() . '. Veuillez réessayer ou nous contacter directement au 01 76 38 00 17.')
                ->withInput();
        }
    }

    /**
     * Calcule un montant estimé pour la réservation
     */
    private function calculateEstimatedAmount(array $data): float
    {
        // Logique de calcul simple (à adapter selon vos tarifs)
        $basePrice = 50.00; // Prix de base

        // Supplément selon le type de véhicule
        $vehicleMultiplier = [
            'eco' => 1.0,
            'business' => 1.5,
            'prestige' => 2.0
        ];

        $multiplier = $vehicleMultiplier[$data['type_vehicule']] ?? 1.0;

        // Supplément pour 5+ passagers
        if ($data['passagers'] === '5+') {
            $multiplier *= 1.3;
        }

        // Supplément selon le type de service
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
        if ($passagers === '5+') {
            return 5; // Valeur minimale pour 5+
        }

        return (int) $passagers;
    }
}
