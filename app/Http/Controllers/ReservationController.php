<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ReservationMail;
use App\Models\Reservation;
use App\Models\VehicleCategory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    public function index()
    {
        // Récupérer les catégories de véhicules actives
        $vehicleCategories = VehicleCategory::where('actif', true)
            ->orderBy('display_name')
            ->get();

        return view('reservation', compact('vehicleCategories'));
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
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
            'passagers' => 'required|string|in:1,2,3,4,5,6,7,8',
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'instructions' => 'nullable|string|max:1000',
            // Champs calculés (optionnels)
            'depart_lat' => 'nullable|numeric',
            'depart_lng' => 'nullable|numeric',
            'arrivee_lat' => 'nullable|numeric',
            'arrivee_lng' => 'nullable|numeric',
            'calculated_prise_charge' => 'nullable|numeric|min:0',
            'calculated_distance_price' => 'nullable|numeric|min:0',
            'calculated_price_ht' => 'nullable|numeric|min:0',
            'calculated_tva' => 'nullable|numeric|min:0',
            'calculated_price_ttc' => 'nullable|numeric|min:0',
            'calculated_distance_km' => 'nullable|numeric|min:0',
            'calculated_passengers' => 'nullable|integer|min:1',
        ], [
            'passagers.in' => 'Veuillez sélectionner un nombre de passagers valide.',
            'date.after_or_equal' => 'La date doit être aujourd\'hui ou une date future.',
            'heure.date_format' => 'Veuillez entrer une heure valide (format HH:MM).',
            'vehicle_category_id.exists' => 'Veuillez sélectionner un type de véhicule valide.',
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

            // 1. Récupérer la catégorie de véhicule
            $vehicleCategory = VehicleCategory::findOrFail($reservationData['vehicle_category_id']);

            // 2. Vérifier si l'utilisateur est connecté
            $userId = auth()->check() ? auth()->id() : null;

            // 3. Calculer les prix
            $calculatedPrices = $this->calculatePrices($reservationData, $vehicleCategory);

            // 4. Convertir passagers en nombre pour le champ passengers
            $passengersCount = $this->convertPassagersToCount($reservationData['passagers']);

            // 5. Préparer les données pour l'insertion
            $dataToInsert = [
                // Champs utilisateur (nullable)
                'user_id' => $userId,
                'vehicle_id' => null,

                // Champs obligatoires
                'type' => 'vtc_transport',
                'status' => 'pending',
                'total_amount' => $calculatedPrices['price_ttc'],
                'deposit_amount' => 0.00,
                'passengers' => $passengersCount,
                'start_date' => $reservationData['date'],
                'end_date' => $reservationData['date'],

                // Champs de réservation publique
                'type_service' => $reservationData['type_service'],
                'depart' => $reservationData['depart'],
                'arrivee' => $reservationData['arrivee'],
                'date' => $reservationData['date'],
                'heure' => $reservationData['heure'],
                'type_vehicule' => $vehicleCategory->display_name,
                'vehicle_category_id' => $vehicleCategory->id,
                'passagers' => $reservationData['passagers'],
                'nom' => $reservationData['nom'],
                'telephone' => $reservationData['telephone'],
                'email' => $reservationData['email'],
                'instructions' => $reservationData['instructions'] ?? null,

                // Champs de compatibilité
                'pickup_location' => $reservationData['depart'],
                'dropoff_location' => $reservationData['arrivee'],
                'pickup_time' => $reservationData['heure'],

                // Coordonnées GPS
                'depart_lat' => $reservationData['depart_lat'] ?? null,
                'depart_lng' => $reservationData['depart_lng'] ?? null,
                'arrivee_lat' => $reservationData['arrivee_lat'] ?? null,
                'arrivee_lng' => $reservationData['arrivee_lng'] ?? null,

                // Données calculées
                'calculated_prise_charge' => $calculatedPrices['prise_charge'],
                'calculated_distance_price' => $calculatedPrices['distance_price'],
                'calculated_price_ht' => $calculatedPrices['price_ht'],
                'calculated_tva' => $calculatedPrices['tva'],
                'calculated_price_ttc' => $calculatedPrices['price_ttc'],
                'calculated_distance_km' => $calculatedPrices['distance_km'],

                // Nouveaux champs
                'source' => $userId ? 'client' : 'public',
                'reference' => 'RES' . strtoupper(Str::random(8)),
                'is_vtc_booking' => true,
                'special_requests' => $reservationData['instructions'] ?? null,
            ];

            \Log::info('Données à insérer:', $dataToInsert);

            // 6. Sauvegarder en base de données
            $reservation = Reservation::create($dataToInsert);

            \Log::info('Réservation créée', [
                'id' => $reservation->id,
                'reference' => $reservation->reference,
                'user_id' => $userId,
                'vehicle_category_id' => $vehicleCategory->id,
                'price_ttc' => $calculatedPrices['price_ttc']
            ]);

            // 7. Préparer les données pour l'email
            $emailData = [
                // Informations client
                'nom' => $reservationData['nom'],
                'email' => $reservationData['email'],
                'telephone' => $reservationData['telephone'],

                // Détails du trajet
                'depart' => $reservationData['depart'],
                'arrivee' => $reservationData['arrivee'],
                'date' => $reservationData['date'],
                'heure' => $reservationData['heure'],

                // Type de service
                'type_service' => $reservationData['type_service'],
                'type_service_label' => $this->getServiceTypeLabel($reservationData['type_service']),

                // Véhicule
                'type_vehicule' => $vehicleCategory->display_name,
                'vehicle_category_name' => $vehicleCategory->display_name,
                'vehicle_category_details' => $vehicleCategory,

                // Passagers
                'passagers' => $reservationData['passagers'],

                // Instructions
                'instructions' => $reservationData['instructions'] ?? null,

                // Référence
                'reference' => $reservation->reference,

                // Prix calculés
                'calculated_prices' => $calculatedPrices,
                'formatted_prices' => [
                    'prise_charge' => number_format($calculatedPrices['prise_charge'], 2, ',', ' '),
                    'distance_price' => number_format($calculatedPrices['distance_price'], 2, ',', ' '),
                    'price_ht' => number_format($calculatedPrices['price_ht'], 2, ',', ' '),
                    'tva' => number_format($calculatedPrices['tva'], 2, ',', ' '),
                    'price_ttc' => number_format($calculatedPrices['price_ttc'], 2, ',', ' '),
                    'distance_km' => number_format($calculatedPrices['distance_km'], 1, ',', ' '),
                ],

                // Coordonnées GPS
                'depart_lat' => $reservationData['depart_lat'] ?? null,
                'depart_lng' => $reservationData['depart_lng'] ?? null,
                'arrivee_lat' => $reservationData['arrivee_lat'] ?? null,
                'arrivee_lng' => $reservationData['arrivee_lng'] ?? null,
            ];

            // 8. Envoyer l'email au client
            \Log::info('Envoi email client');
            Mail::to($reservationData['email'])
                ->send(new ReservationMail($emailData, 'client'));

            // 9. Envoyer l'email à l'admin
            $adminEmail = config('mail.from.address', 'vtc@djokprestige.com');
            \Log::info('Envoi email admin', ['admin_email' => $adminEmail]);
            Mail::to($adminEmail)
                ->send(new ReservationMail($emailData, 'admin'));

            // 10. Envoyer un email de secours si nécessaire
            $secondaryAdminEmail = 'admin@djokprestige.com';
            if ($secondaryAdminEmail && $secondaryAdminEmail !== $adminEmail) {
                \Log::info('Envoi email admin secondaire');
                Mail::to($secondaryAdminEmail)
                    ->send(new ReservationMail($emailData, 'admin'));
            }

            \Log::info('Réservation traitée avec succès');

            return redirect()->route('reservation')
                ->with('success', 'Votre réservation a été envoyée avec succès ! Vous allez recevoir un email de confirmation avec la référence : ' . $reservation->reference . ' et un montant total de ' . number_format($calculatedPrices['price_ttc'], 2, ',', ' ') . ' € TTC.');
        } catch (\Exception $e) {
            \Log::error('Erreur création réservation: ' . $e->getMessage());
            \Log::error('Trace: ' . $e->getTraceAsString());
            \Log::error('Données de réservation:', $reservationData);

            return redirect()->route('reservation')
                ->with('error', 'Une erreur est survenue lors de l\'envoi: ' . $e->getMessage() . '. Veuillez réessayer ou nous contacter directement au 01 76 38 00 17.')
                ->withInput();
        }
    }

    /**
     * Calcule les prix pour la réservation
     */
    private function calculatePrices(array $data, VehicleCategory $vehicleCategory): array
    {
        // Récupérer le nombre de passagers pour le calcul
        $passengers = isset($data['calculated_passengers']) ? (int)$data['calculated_passengers'] : $this->convertPassagersToCount($data['passagers']);

        // Vérifier si des données calculées ont été envoyées par le formulaire
        $hasCalculatedData = isset($data['calculated_distance_km']) && $data['calculated_distance_km'] > 0;

        if ($hasCalculatedData) {
            // Utiliser les données calculées par le formulaire JavaScript
            $priseCharge = (float) ($data['calculated_prise_charge'] ?? $vehicleCategory->prise_en_charge);
            $distancePrice = (float) ($data['calculated_distance_price'] ?? 0);
            $priceHT = (float) ($data['calculated_price_ht'] ?? $vehicleCategory->prix_minimum);
            $tva = (float) ($data['calculated_tva'] ?? 0);
            $priceTTC = (float) ($data['calculated_price_ttc'] ?? $vehicleCategory->prix_minimum);
            $distanceKm = (float) ($data['calculated_distance_km'] ?? 0);

            return [
                'prise_charge' => $priseCharge,
                'distance_price' => $distancePrice,
                'price_ht' => $priceHT,
                'tva' => $tva,
                'price_ttc' => $priceTTC,
                'distance_km' => $distanceKm,
                'passengers' => $passengers,
                'calculation_method' => 'javascript'
            ];
        }

        // Fallback: calcul manuel basé sur des estimations
        \Log::warning('Calcul des prix sans données de distance, utilisation de l\'estimation');

        // Estimer une distance moyenne (20km par défaut)
        $estimatedDistanceKm = 20.0;

        // Calcul standard
        $priseCharge = $vehicleCategory->prise_en_charge;
        $distancePrice = $estimatedDistanceKm * $vehicleCategory->prix_au_km;
        $priceHT = $priseCharge + $distancePrice;

        // Appliquer le prix minimum
        if ($priceHT < $vehicleCategory->prix_minimum) {
            $priceHT = $vehicleCategory->prix_minimum;
            $distancePrice = $priceHT - $priseCharge;
        }

        // Multiplier par le nombre de passagers
        $priceHT = $priceHT * $passengers;

        // Calcul de la TVA (10%)
        $tva = $priceHT * 0.1;
        $priceTTC = $priceHT + $tva;

        return [
            'prise_charge' => $priseCharge,
            'distance_price' => $distancePrice,
            'price_ht' => $priceHT,
            'tva' => $tva,
            'price_ttc' => $priceTTC,
            'distance_km' => $estimatedDistanceKm,
            'passengers' => $passengers,
            'calculation_method' => 'estimation'
        ];
    }

    /**
     * Convertit la chaîne passagers en nombre
     */
    private function convertPassagersToCount(string $passagers): int
    {
        return (int) $passagers; // Maintenant les valeurs sont 1-8, pas de 5+
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
     * API pour calculer le prix (optionnel - pour AJAX)
     */
    public function calculatePriceApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
            'depart_lat' => 'required|numeric',
            'depart_lng' => 'required|numeric',
            'arrivee_lat' => 'required|numeric',
            'arrivee_lng' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            $vehicleCategory = VehicleCategory::findOrFail($request->vehicle_category_id);

            // Dans une vraie application, vous appelleriez ici l'API Google Maps
            // pour calculer la distance exacte

            $distanceKm = $this->calculateDistance(
                $request->depart_lat,
                $request->depart_lng,
                $request->arrivee_lat,
                $request->arrivee_lng
            );

            $priseCharge = $vehicleCategory->prise_en_charge;
            $distancePrice = $distanceKm * $vehicleCategory->prix_au_km;
            $priceHT = $priseCharge + $distancePrice;

            // Appliquer le prix minimum
            if ($priceHT < $vehicleCategory->prix_minimum) {
                $priceHT = $vehicleCategory->prix_minimum;
                $distancePrice = $priceHT - $priseCharge;
            }

            // Calcul de la TVA (10%)
            $tva = $priceHT * 0.1;
            $priceTTC = $priceHT + $tva;

            return response()->json([
                'success' => true,
                'data' => [
                    'distance_km' => round($distanceKm, 1),
                    'prise_charge' => $priseCharge,
                    'distance_price' => $distancePrice,
                    'price_ht' => $priceHT,
                    'tva' => $tva,
                    'price_ttc' => $priceTTC,
                    'price_minimum' => $vehicleCategory->prix_minimum,
                    'formatted' => [
                        'distance_km' => number_format($distanceKm, 1, ',', ' '),
                        'prise_charge' => number_format($priseCharge, 2, ',', ' ') . ' €',
                        'distance_price' => number_format($distancePrice, 2, ',', ' ') . ' €',
                        'price_ht' => number_format($priceHT, 2, ',', ' ') . ' €',
                        'tva' => number_format($tva, 2, ',', ' ') . ' €',
                        'price_ttc' => number_format($priceTTC, 2, ',', ' ') . ' €',
                        'price_minimum' => number_format($vehicleCategory->prix_minimum, 2, ',', ' ') . ' €',
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur calcul prix API: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du calcul du prix'
            ], 500);
        }
    }

    /**
     * Calcule la distance entre deux points (formule haversine)
     * Note: Dans une vraie application, utilisez l'API Google Maps
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2): float
    {
        $earthRadius = 6371; // Rayon de la Terre en km

        $latDelta = deg2rad($lat2 - $lat1);
        $lonDelta = deg2rad($lon2 - $lon1);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
