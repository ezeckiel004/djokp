<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaymentService;
use App\Models\Paiement;
use App\Models\Reservation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Succès du paiement
     */
    public function success(Request $request)
    {
        Log::info('=== DÉBUT PaymentController::success ===');
        Log::info('Session ID: ' . $request->get('session_id'));

        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            Log::warning('Aucun session_id fourni');
            return redirect()->route('home')
                ->with('error', 'Session de paiement invalide.');
        }

        try {
            // Traiter le paiement
            $paiement = $this->paymentService->handlePaymentSuccess($sessionId);

            if (!$paiement) {
                Log::error('Paiement non trouvé pour la session: ' . $sessionId);
                return redirect()->route('home')
                    ->with('error', 'Paiement non trouvé.');
            }

            Log::info('Paiement traité avec succès:', [
                'reference' => $paiement->reference,
                'service_type' => $paiement->service_type,
                'amount' => $paiement->amount,
            ]);

            // Rediriger vers la page appropriée
            return $this->redirectToServicePage($paiement);
        } catch (\Exception $e) {
            Log::error('Erreur payment success: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('home')
                ->with('error', 'Nous n\'avons pas pu valider votre paiement. Veuillez nous contacter.');
        }
    }

    /**
     * Annulation du paiement
     */
    public function cancel(Request $request)
    {
        Log::info('=== DÉBUT PaymentController::cancel ===');

        $sessionId = $request->get('session_id');

        if ($sessionId) {
            $paiement = Paiement::where('stripe_session_id', $sessionId)->first();

            if ($paiement) {
                $paiement->update(['status' => 'canceled']);
                Log::info('Paiement marqué comme annulé:', ['reference' => $paiement->reference]);
            }
        }

        return view('payments.cancel')
            ->with('message', 'Votre paiement a été annulé.');
    }

    /**
     * Webhook Stripe
     */
    public function webhook(Request $request)
    {
        Log::info('=== WEBHOOK PAYMENT RECU ===');
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        Log::info('En-tête Stripe-Signature: ' . $sigHeader);
        Log::info('Payload (premiers 500 caractères): ' . substr($payload, 0, 500));

        return $this->paymentService->handleWebhook($payload, $sigHeader);
    }

    /**
     * Créer une session de paiement pour réservation
     */
    public function createReservationPayment(Request $request)
    {
        Log::info('=== DÉBUT createReservationPayment ===');

        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
        ]);

        try {
            $reservation = Reservation::findOrFail($request->reservation_id);

            // Vérifier si la réservation n'est pas déjà payée
            if ($reservation->is_paid) {
                return response()->json([
                    'error' => 'Cette réservation est déjà payée.'
                ], 400);
            }

            // Calculer le prix (vous devez adapter cette partie)
            $amount = $reservation->total_amount ?? 0;

            if ($amount <= 0) {
                return response()->json([
                    'error' => 'Montant invalide pour le paiement.'
                ], 400);
            }

            // Préparer les données du service
            $serviceData = [
                'amount' => $amount,
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

            // Créer la session de paiement
            $paymentSession = $this->paymentService->createPaymentSession(
                'reservation',
                $serviceData,
                $customerData,
                [
                    'reservation_id' => $reservation->id,
                    'reference' => $reservation->reference,
                ]
            );

            // Mettre à jour la réservation avec l'ID de session
            $reservation->update([
                'stripe_session_id' => $paymentSession['session_id'],
            ]);

            Log::info('Session de paiement créée pour réservation:', [
                'reservation_id' => $reservation->id,
                'session_id' => $paymentSession['session_id'],
                'amount' => $amount,
            ]);

            return response()->json([
                'session_id' => $paymentSession['session_id'],
                'url' => $paymentSession['url'],
                'reference' => $paymentSession['reference'],
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur création paiement réservation: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'error' => 'Une erreur est survenue lors de la création du paiement: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Page de confirmation de paiement
     */
    public function confirmation($reference)
    {
        $paiement = Paiement::where('reference', $reference)->first();

        if (!$paiement) {
            abort(404, 'Paiement non trouvé');
        }

        return view('payments.confirmation', compact('paiement'));
    }

    /**
     * Rediriger vers la page appropriée selon le service
     */
    protected function redirectToServicePage(Paiement $paiement)
    {
        $successMessage = 'Merci pour votre paiement de ' .
            number_format($paiement->amount, 2, ',', ' ') . ' €. ' .
            'Votre transaction a été confirmée.';

        switch ($paiement->service_type) {
            case 'reservation':
                // Mettre à jour le statut de la réservation
                if ($paiement->reservation) {
                    $paiement->reservation->update([
                        'status' => 'confirmed',
                        'is_paid' => true,
                        'paiement_id' => $paiement->id,
                    ]);

                    // Envoyer l'email de confirmation
                    $this->sendReservationConfirmation($paiement->reservation, $paiement);
                }

                return redirect()->route('reservation.confirmation', $paiement->reference)
                    ->with('success', $successMessage);

            case 'formation':
                return redirect()->route('client.dashboard')
                    ->with('success', $successMessage)
                    ->with('payment_completed', true);

            default:
                return redirect()->route('payment.confirmation', $paiement->reference)
                    ->with('success', $successMessage);
        }
    }

    /**
     * Envoyer la confirmation de réservation
     */
    protected function sendReservationConfirmation($reservation, $paiement)
    {
        try {
            // Email au client
            Mail::to($reservation->email)
                ->send(new \App\Mail\ReservationPaidMail($reservation, $paiement));

            Log::info('Email de confirmation envoyé à: ' . $reservation->email);

            // Notification admin
            $adminEmail = config('mail.admin_email', 'vtc@djokprestige.com');
            Mail::to($adminEmail)
                ->send(new \App\Mail\AdminReservationPaidNotification($reservation, $paiement));

            Log::info('Notification admin envoyée à: ' . $adminEmail);
        } catch (\Exception $e) {
            Log::error('Erreur envoi email confirmation: ' . $e->getMessage());
        }
    }

    /**
     * Obtenir le label du type de service
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
}
