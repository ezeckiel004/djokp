<?php

namespace App\Http\Controllers;

use App\Models\ConciergerieDemande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Mail\ConciergerieDemandeMail;
use App\Mail\ConciergerieConfirmationClientMail;

class ConciergerieController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'motif_voyage' => 'required|string',
            'date_arrivee' => 'required|date',
            'duree_sejour' => 'required|string',
            'nombre_personnes' => 'required|string',
            'budget' => 'nullable|string',
            'type_accompagnement' => 'required|string',
            'services' => 'required|array|min:1',
            'services.*' => 'string',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('conciergerie')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Création de la demande avec JSON encodé
            $demande = ConciergerieDemande::create([
                'nom_complet' => $request->nom,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'motif_voyage' => $request->motif_voyage,
                'date_arrivee' => $request->date_arrivee,
                'duree_sejour' => $request->duree_sejour,
                'nombre_personnes' => $request->nombre_personnes,
                'budget' => $request->budget,
                'type_accompagnement' => $request->type_accompagnement,
                'services' => json_encode($request->services, JSON_UNESCAPED_UNICODE),
                'message' => $request->message,
                'statut' => 'nouvelle',
                'devise' => 'EUR',
            ]);

            Log::info('Demande créée avec succès', [
                'reference' => $demande->reference,
                'email' => $demande->email
            ]);

            // Envoi email admin
            try {
                Mail::to('conciergerie@djokprestige.com')
                    ->send(new ConciergerieDemandeMail($demande));
                Log::info('Email admin envoyé avec succès');
            } catch (\Exception $e) {
                Log::error('Erreur envoi email admin: ' . $e->getMessage());
            }

            // Envoi email client
            try {
                Mail::to($demande->email)
                    ->send(new ConciergerieConfirmationClientMail($demande));
                Log::info('Email client envoyé avec succès');
            } catch (\Exception $e) {
                Log::error('Erreur envoi email client: ' . $e->getMessage());
            }

            return redirect()->route('conciergerie')
                ->with([
                    'success' => 'Votre demande a été envoyée avec succès ! Votre référence est : ' . $demande->reference . '. Un email de confirmation vous a été envoyé.',
                    'reference' => $demande->reference,
                ]);
        } catch (\Exception $e) {
            Log::error('Erreur globale conciergerie: ' . $e->getMessage());

            return redirect()->route('conciergerie')
                ->with('error', 'Une erreur technique est survenue. Veuillez réessayer ou nous contacter directement au 01 76 38 00 17.')
                ->withInput();
        }
    }

    public function suivi($reference)
    {
        $demande = ConciergerieDemande::where('reference', $reference)->firstOrFail();
        return view('conciergerie.suivi', compact('demande'));
    }
}
