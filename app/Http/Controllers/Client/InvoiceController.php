<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Afficher les factures
     */
    public function index()
    {
        $user = Auth::user();

        $paiements = Paiement::where('user_id', $user->id)
            ->where('status', 'paid')
            ->with('formation')
            ->orderBy('paid_at', 'desc')
            ->paginate(10);

        return view('client.factures.index', compact('paiements'));
    }

    /**
     * Afficher les détails d'une facture
     */
    public function show($id)
    {
        $user = Auth::user();

        $paiement = Paiement::where('id', $id)
            ->where('user_id', $user->id)
            ->where('status', 'paid')
            ->with(['formation', 'user'])
            ->firstOrFail();

        return view('client.factures.show', compact('paiement'));
    }

    /**
     * Télécharger une facture (à implémenter avec PDF)
     */
    public function download($id)
    {
        $user = Auth::user();

        $paiement = Paiement::where('id', $id)
            ->where('user_id', $user->id)
            ->where('status', 'paid')
            ->firstOrFail();

        // TODO: Générer le PDF
        // return PDF::loadView('client.factures.pdf', compact('paiement'))->download();

        // Pour l'instant, rediriger vers la vue
        return redirect()->route('client.factures.show', $paiement->id)
            ->with('info', 'La génération de PDF sera disponible prochainement.');
    }
}
