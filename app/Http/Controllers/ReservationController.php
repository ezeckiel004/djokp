<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaymentService;
use App\Mail\ReservationMail;
use App\Mail\ReservationPaidMail;
use App\Mail\AdminReservationPaidNotification;
use App\Models\Reservation;
use App\Models\VehicleCategory;
use App\Models\Paiement;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService = null)
    {
        $this->paymentService = $paymentService ?? app(PaymentService::class);
        Log::info('ReservationController initialisé avec PaymentService');
    }

    public function index()
    {
        $vehicleCategories = VehicleCategory::where('actif', true)
            ->orderBy('display_name')
            ->get();

        return view('reservation', compact('vehicleCategories'));
    }

    public function submit(Request $request)
    {
        Log::info('=== DÉBUT ReservationController::submit ===');
        Log::info('Données reçues:', $request->except(['_token']));

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
            'payment_option' => 'required|in:demande,pay_now',
            'depart_lat' => 'nullable|numeric',
            'depart_lng' => 'nullable|numeric',
            'arrivee_lat' => 'nullable|numeric',
            'arrivee_lng' => 'nullable|numeric',
            'start_date' => 'required|date',
            // Ajouter les champs calculés à la validation
            'calculated_prise_charge' => 'nullable|numeric',
            'calculated_distance_price' => 'nullable|numeric',
            'calculated_price_ht_base' => 'nullable|numeric',
            'calculated_price_ht_total' => 'nullable|numeric',
            'calculated_tva' => 'nullable|numeric',
            'calculated_price_ttc' => 'nullable|numeric',
            'calculated_distance_km' => 'nullable|numeric',
            'calculated_passengers' => 'nullable|integer',
        ], [
            'passagers.in' => 'Veuillez sélectionner un nombre de passagers valide.',
            'date.after_or_equal' => 'La date doit être aujourd\'hui ou une date future.',
            'heure.date_format' => 'Veuillez entrer une heure valide (format HH:MM).',
            'vehicle_category_id.exists' => 'Veuillez sélectionner un type de véhicule valide.',
            'payment_option.required' => 'Veuillez sélectionner une option de paiement.',
            'start_date.required' => 'La date de début est requise.',
            'start_date.date' => 'La date de début doit être une date valide.',
        ]);

        if ($validator->fails()) {
            Log::warning('Validation échouée', ['errors' => $validator->errors()->toArray()]);
            return redirect()->route('reservation')
                ->withErrors($validator)
                ->withInput();
        }

        $reservationData = $validator->validated();

        try {
            Log::info('Création de la réservation', ['email' => $reservationData['email']]);

            // 1. Récupérer la catégorie de véhicule
            $vehicleCategory = VehicleCategory::findOrFail($reservationData['vehicle_category_id']);
            Log::info('Catégorie véhicule trouvée:', ['id' => $vehicleCategory->id, 'name' => $vehicleCategory->display_name]);

            // 2. Vérifier si l'utilisateur est connecté
            $userId = auth()->check() ? auth()->id() : null;
            Log::info('User ID:', ['user_id' => $userId]);

            // 3. Calculer les prix
            $calculatedPrices = $this->calculatePrices($reservationData, $vehicleCategory);
            Log::info('Prix calculés:', $calculatedPrices);

            // 4. Convertir passagers en nombre
            $passengersCount = $this->convertPassagersToCount($reservationData['passagers']);
            Log::info('Nombre de passagers:', ['count' => $passengersCount]);

            // 5. Calculer end_date (ajouter 1 heure par défaut)
            $startDate = new \DateTime($reservationData['start_date']);
            $endDate = clone $startDate;
            $endDate->modify('+1 hour'); // Ajouter 1 heure par défaut
            Log::info('Dates calculées:', ['start_date' => $startDate->format('Y-m-d H:i:s'), 'end_date' => $endDate->format('Y-m-d H:i:s')]);

            // 6. Déterminer le statut
            $status = 'pending';
            if ($reservationData['payment_option'] === 'pay_now') {
                $status = 'pending_payment';
                Log::info('Option "pay_now" sélectionnée, statut: pending_payment');
            } else {
                Log::info('Option "demande" sélectionnée, statut: pending');
            }

            // 7. Créer la réservation
            $reservationDataToCreate = [
                'user_id' => $userId,
                'type_service' => $reservationData['type_service'],
                'depart' => $reservationData['depart'],
                'arrivee' => $reservationData['arrivee'],
                'date' => $reservationData['date'],
                'heure' => $reservationData['heure'],
                'vehicle_category_id' => $vehicleCategory->id,
                'type_vehicule' => $vehicleCategory->display_name,
                'passagers' => $reservationData['passagers'],
                'passengers' => $passengersCount,
                'nom' => $reservationData['nom'],
                'telephone' => $reservationData['telephone'],
                'email' => $reservationData['email'],
                'instructions' => $reservationData['instructions'] ?? null,
                'total_amount' => $calculatedPrices['price_ttc'],
                'status' => $status,
                'reference' => 'RES' . strtoupper(Str::random(8)),
                'depart_lat' => $reservationData['depart_lat'] ?? null,
                'depart_lng' => $reservationData['depart_lng'] ?? null,
                'arrivee_lat' => $reservationData['arrivee_lat'] ?? null,
                'arrivee_lng' => $reservationData['arrivee_lng'] ?? null,
                'calculated_price_ttc' => $calculatedPrices['price_ttc'],
                'calculated_distance_km' => $calculatedPrices['distance_km'],
                'is_vtc_booking' => true,
                'source' => $userId ? 'client' : 'public',
                'type' => 'vtc_transport',
                'start_date' => $reservationData['start_date'],
                'end_date' => $endDate->format('Y-m-d H:i:s'),
                'calculation_method' => $calculatedPrices['calculation_method'],
            ];

            Log::info('Données pour création réservation:', $reservationDataToCreate);

            $reservation = Reservation::create($reservationDataToCreate);

            Log::info('Réservation créée avec succès', [
                'id' => $reservation->id,
                'reference' => $reservation->reference,
                'status' => $reservation->status,
                'amount' => $calculatedPrices['price_ttc'],
                'start_date' => $reservation->start_date,
                'end_date' => $reservation->end_date,
                'calculation_method' => $calculatedPrices['calculation_method'],
            ]);

            // 8. Gérer selon l'option de paiement
            if ($reservationData['payment_option'] === 'pay_now') {
                Log::info('=== DÉBUT Traitement paiement immédiat ===');

                // Rediriger vers le paiement
                return $this->processPayment($reservation, $calculatedPrices);
            } else {
                Log::info('=== DÉBUT Envoi demande de devis ===');

                // Envoyer la demande par email
                $this->sendReservationRequest($reservation, $calculatedPrices);

                Log::info('=== FIN Envoi demande de devis - Succès ===');

                return redirect()->route('reservation')
                    ->with('success', 'Votre demande de réservation a été envoyée avec succès ! Nous vous contacterons rapidement pour confirmer votre trajet. Référence : ' . $reservation->reference);
            }
        } catch (\Exception $e) {
            Log::error('Erreur création réservation: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('reservation')
                ->with('error', 'Une erreur est survenue lors de l\'envoi: ' . $e->getMessage() . '. Veuillez réessayer ou nous contacter directement au 01 76 38 00 17.')
                ->withInput();
        }
    }

    /**
     * Traiter le paiement d'une réservation
     */
    protected function processPayment(Reservation $reservation, array $prices)
    {
        try {
            Log::info('=== DÉBUT processPayment ===');
            Log::info('Données réservation:', [
                'id' => $reservation->id,
                'reference' => $reservation->reference,
                'email' => $reservation->email,
                'nom' => $reservation->nom,
                'amount' => $prices['price_ttc'],
                'calculation_method' => $prices['calculation_method'],
            ]);

            // Vérifier si le montant est plausible
            if ($prices['price_ttc'] < 10 || $prices['price_ttc'] > 10000) {
                Log::warning('Montant suspect détecté, utilisation de fallback', [
                    'price_ttc' => $prices['price_ttc'],
                    'distance_km' => $prices['distance_km'],
                    'calculation_method' => $prices['calculation_method'],
                ]);

                // Si le montant est suspect, recalculer avec estimation
                $vehicleCategory = VehicleCategory::find($reservation->vehicle_category_id);
                if ($vehicleCategory) {
                    $prices = $this->calculatePricesFallback($vehicleCategory);
                    Log::info('Recalcul avec fallback:', $prices);
                }
            }

            // Préparer les données du service
            $serviceData = [
                'amount' => $prices['price_ttc'],
                'service_name' => 'Réservation VTC - ' . $this->getServiceTypeLabel($reservation->type_service),
                'description' => 'Trajet ' . $reservation->depart . ' → ' . $reservation->arrivee,
                'reservation_data' => $reservation->toArray(),
            ];

            // Données client
            $customerData = [
                'name' => $reservation->nom,
                'email' => $reservation->email,
                'phone' => $reservation->telephone,
            ];

            Log::info('Données préparées pour PaymentService:', [
                'service_type' => 'reservation',
                'service_data' => $serviceData,
                'customer_data' => $customerData,
                'metadata' => [
                    'reservation_id' => $reservation->id,
                    'reference' => $reservation->reference,
                ]
            ]);

            // Créer la session de paiement
            Log::info('Appel à PaymentService::createPaymentSession...');
            $paymentSession = $this->paymentService->createPaymentSession(
                'reservation',
                $serviceData,
                $customerData,
                [
                    'reservation_id' => $reservation->id,
                    'reference' => $reservation->reference,
                ]
            );

            Log::info('PaymentService a retourné:', $paymentSession);

            // Mettre à jour la réservation avec l'ID de session
            $reservation->update([
                'stripe_session_id' => $paymentSession['session_id'],
            ]);

            Log::info('Réservation mise à jour avec stripe_session_id:', [
                'reservation_id' => $reservation->id,
                'stripe_session_id' => $paymentSession['session_id'],
            ]);

            Log::info('=== FIN processPayment - Redirection vers Stripe ===');
            Log::info('URL de redirection: ' . $paymentSession['url']);

            // Rediriger vers Stripe Checkout
            return redirect($paymentSession['url']);
        } catch (\Exception $e) {
            Log::error('Erreur création paiement réservation: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            // En cas d'erreur, envoyer quand même la demande
            Log::info('Fallback: envoi par email suite à erreur paiement');
            $this->sendReservationRequest($reservation, $prices);

            return redirect()->route('reservation')
                ->with('warning', 'Nous avons reçu votre demande mais avons rencontré une erreur avec le paiement en ligne. Nous vous contacterons pour finaliser la réservation. Référence : ' . $reservation->reference);
        }
    }

    /**
     * Envoyer une demande de réservation (sans paiement immédiat)
     */
    protected function sendReservationRequest(Reservation $reservation, array $prices)
    {
        try {
            Log::info('=== DÉBUT sendReservationRequest ===');

            // Préparer les données pour l'email
            $emailData = [
                'nom' => $reservation->nom,
                'email' => $reservation->email,
                'telephone' => $reservation->telephone,
                'depart' => $reservation->depart,
                'arrivee' => $reservation->arrivee,
                'date' => $reservation->date,
                'heure' => $reservation->heure,
                'start_date' => $reservation->start_date,
                'end_date' => $reservation->end_date,
                'type_service' => $reservation->type_service,
                'type_service_label' => $this->getServiceTypeLabel($reservation->type_service),
                'type_vehicule' => $reservation->type_vehicule,
                'passagers' => $reservation->passagers,
                'instructions' => $reservation->instructions,
                'reference' => $reservation->reference,
                'calculated_prices' => $prices,
                'formatted_prices' => [
                    'price_ttc' => number_format($prices['price_ttc'], 2, ',', ' '),
                    'distance_km' => number_format($prices['distance_km'], 1, ',', ' '),
                ],
            ];

            Log::info('Données email:', $emailData);

            // Envoyer l'email au client
            Mail::to($reservation->email)
                ->send(new ReservationMail($emailData, 'client'));

            Log::info('Email de demande envoyé à: ' . $reservation->email);

            // Envoyer la notification admin
            $adminEmail = config('mail.admin_email', 'vtc@djokprestige.com');
            Mail::to($adminEmail)
                ->send(new ReservationMail($emailData, 'admin'));

            Log::info('Notification admin envoyée à: ' . $adminEmail);

            Log::info('=== FIN sendReservationRequest - Succès ===');
        } catch (\Exception $e) {
            Log::error('Erreur envoi email réservation: ' . $e->getMessage());
        }
    }

    /**
     * Calcule les prix pour la réservation
     */
    private function calculatePrices(array $data, VehicleCategory $vehicleCategory): array
    {
        Log::info('=== DÉBUT calculatePrices ===');
        Log::info('Données reçues pour calcul:', [
            'has_calculated_distance_km' => isset($data['calculated_distance_km']),
            'calculated_distance_km' => $data['calculated_distance_km'] ?? 'non défini',
            'calculated_price_ttc' => $data['calculated_price_ttc'] ?? 'non défini',
            'calculated_price_ht_base' => $data['calculated_price_ht_base'] ?? 'non défini',
            'calculated_price_ht_total' => $data['calculated_price_ht_total'] ?? 'non défini',
        ]);

        // Vérifier si des données calculées ont été envoyées par le formulaire
        $hasCalculatedData = isset($data['calculated_distance_km'])
            && !empty($data['calculated_distance_km'])
            && floatval($data['calculated_distance_km']) > 0;

        if ($hasCalculatedData) {
            Log::info('Utilisation des données calculées JavaScript');

            // Utiliser les données calculées par le formulaire JavaScript
            // IMPORTANT: Votre JavaScript envoie calculated_price_ht_base et calculated_price_ht_total
            // Mais vous devez utiliser calculated_price_ttc pour le paiement

            $priseCharge = floatval($data['calculated_prise_charge'] ?? $vehicleCategory->prise_en_charge);
            $distancePrice = floatval($data['calculated_distance_price'] ?? 0);

            // Essayer d'abord calculated_price_ht_total, puis calculated_price_ht_base, puis fallback
            if (isset($data['calculated_price_ht_total']) && floatval($data['calculated_price_ht_total']) > 0) {
                $priceHT = floatval($data['calculated_price_ht_total']);
            } elseif (isset($data['calculated_price_ht_base']) && floatval($data['calculated_price_ht_base']) > 0) {
                $priceHT = floatval($data['calculated_price_ht_base']);
            } else {
                $priceHT = floatval($vehicleCategory->prix_minimum);
            }

            $tva = floatval($data['calculated_tva'] ?? 0);

            // CORRECTION CRITIQUE: Utiliser calculated_price_ttc pour le montant TTC
            if (isset($data['calculated_price_ttc']) && floatval($data['calculated_price_ttc']) > 0) {
                $priceTTC = floatval($data['calculated_price_ttc']);
            } else {
                // Fallback: recalculer TTC
                $priceTTC = $priceHT + $tva;
            }

            $distanceKm = floatval($data['calculated_distance_km'] ?? 0);

            $result = [
                'prise_charge' => $priseCharge,
                'distance_price' => $distancePrice,
                'price_ht' => $priceHT,
                'tva' => $tva,
                'price_ttc' => $priceTTC,
                'distance_km' => $distanceKm,
                'calculation_method' => 'javascript'
            ];

            Log::info('Résultat avec données JavaScript:', $result);
        } else {
            Log::warning('Calcul des prix sans données de distance, utilisation de l\'estimation');

            // Fallback: calcul manuel basé sur des estimations
            $result = $this->calculatePricesFallback($vehicleCategory);
        }

        Log::info('=== FIN calculatePrices ===');
        return $result;
    }

    /**
     * Calcul de prix de fallback (estimation)
     */
    private function calculatePricesFallback(VehicleCategory $vehicleCategory): array
    {
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

        // Calcul de la TVA (10%)
        $tva = $priceHT * 0.1;
        $priceTTC = $priceHT + $tva;

        $result = [
            'prise_charge' => $priseCharge,
            'distance_price' => $distancePrice,
            'price_ht' => $priceHT,
            'tva' => $tva,
            'price_ttc' => $priceTTC,
            'distance_km' => $estimatedDistanceKm,
            'calculation_method' => 'estimation'
        ];

        Log::info('Résultat avec estimation:', $result);

        return $result;
    }

    /**
     * Convertit la chaîne passagers en nombre
     */
    private function convertPassagersToCount(string $passagers): int
    {
        return (int) $passagers;
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
     * API pour créer une session de paiement (AJAX)
     */
    public function createPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reservation_id' => 'required|exists:reservations,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $reservation = Reservation::find($request->reservation_id);

            // Calculer les prix
            $calculatedPrices = $this->calculatePrices($reservation->toArray(), $reservation->vehicleCategory);

            // Créer la session de paiement
            return $this->processPayment($reservation, $calculatedPrices);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
            Log::error('Erreur calcul prix API: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du calcul du prix'
            ], 500);
        }
    }

    /**
     * Calcule la distance entre deux points (formule haversine)
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
