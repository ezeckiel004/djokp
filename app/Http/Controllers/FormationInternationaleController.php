<?php

namespace App\Http\Controllers;

use App\Models\DemandeFormationInternationale;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\FormationInternationaleConfirmation;
use App\Mail\FormationInternationaleNotificationAdmin;

class FormationInternationaleController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'nationalite' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'formation' => 'required|string',
            'message' => 'required|string|min:10|max:2000',
            'services' => 'nullable|array',
            'services.*' => 'string|max:100',
            'date_debut' => 'nullable|date|after_or_equal:today',
            'duree' => 'nullable|string|max:50'
        ], [
            'nom.required' => 'Le nom complet est obligatoire.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'nationalite.required' => 'La nationalité est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'telephone.required' => 'Le téléphone est obligatoire.',
            'whatsapp.max' => 'Le numéro WhatsApp ne doit pas dépasser 20 caractères.',
            'formation.required' => 'Veuillez sélectionner une formation.',
            'message.required' => 'Veuillez décrire votre projet.',
            'message.min' => 'Veuillez donner plus de détails sur votre projet (minimum 10 caractères).',
            'message.max' => 'Le message ne doit pas dépasser 2000 caractères.',
            'date_debut.date' => 'La date de début doit être une date valide.',
            'date_debut.after_or_equal' => 'La date de début doit être aujourd\'hui ou une date future.',
            'duree.max' => 'La durée ne doit pas dépasser 50 caractères.'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('formation.international')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Veuillez corriger les erreurs dans le formulaire.');
        }

        try {
            // Déterminer si c'est une formation existante ou personnalisée
            $formationId = null;
            $formationPersonnalisee = null;
            $formationTitre = null;

            if (is_numeric($request->formation)) {
                $formation = Formation::find($request->formation);
                if ($formation) {
                    $formationId = $formation->id;
                    $formationTitre = $formation->title;
                } else {
                    return redirect()
                        ->route('formation.international')
                        ->withInput()
                        ->with('error', 'La formation sélectionnée n\'existe pas.');
                }
            } else {
                $formationPersonnalisee = $request->formation;
                $formationTitre = $formationPersonnalisee;
            }

            // Nettoyer les services
            $services = [];
            if ($request->has('services') && is_array($request->services)) {
                $services = array_filter(array_unique($request->services));
            }

            // Création de la demande
            $demande = DemandeFormationInternationale::create([
                'formation_id' => $formationId,
                'formation_personnalisee' => $formationPersonnalisee,
                'nom_complet' => $request->nom,
                'nationalite' => $request->nationalite,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'whatsapp' => $request->whatsapp ?? $request->telephone,
                'message' => strip_tags($request->message),
                'services' => $services,
                'date_debut' => $request->date_debut,
                'duree' => $request->duree,
                'statut' => 'nouveau',
                'notes_admin' => 'Demande créée via formulaire public'
            ]);

            // Charger les relations nécessaires
            $demande->load('formation');

            // CORRECTION 1 : Envoyer email de confirmation AU DEMANDEUR (son email)
            Mail::to($request->email)->send(new FormationInternationaleConfirmation($demande));

            // CORRECTION 2 : Envoyer email de notification À L'ADMIN
            $this->sendNotificationEmail($demande);

            // Log de succès
            Log::info('Nouvelle demande formation internationale créée et emails envoyés', [
                'id' => $demande->id,
                'nom' => $request->nom,
                'email' => $request->email,
                'formation' => $formationTitre
            ]);

            return redirect()
                ->route('formation.international')
                ->with('success', 'Votre demande a été envoyée avec succès ! Nous vous contacterons dans les plus brefs délais. Un email de confirmation vous a été envoyé.')
                ->with('email', $request->email);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de la demande formation internationale: ' . $e->getMessage(), [
                'request' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->route('formation.international')
                ->withInput()
                ->with('error', 'Une erreur technique est survenue lors de l\'envoi de votre demande. Veuillez réessayer ou nous contacter directement.');
        }
    }

    private function sendNotificationEmail($demande)
    {
        try {
            $adminEmail = config('mail.admin_email', 'admin@djokprestige.com');
            $internationalEmail = config('mail.international_email', 'international@djokprestige.com');

            $adminEmails = array_filter([$adminEmail, $internationalEmail]);

            foreach ($adminEmails as $email) {
                Mail::to($email)->send(new FormationInternationaleNotificationAdmin($demande));
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'email de notification: ' . $e->getMessage());
        }
    }

    public static function getPendingCount()
    {
        return DemandeFormationInternationale::where('statut', 'nouveau')->count();
    }
}
