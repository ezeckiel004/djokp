<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inscription;
use App\Models\User;
use App\Models\Formation;
use App\Models\Role;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\InscriptionStatusChanged;
use App\Mail\FormationTransferred;
use Illuminate\Support\Facades\Log;

class InscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:access-admin-dashboard');
    }

    public function index()
    {
        $inscriptions = Inscription::with(['user', 'formation'])
            ->latest()
            ->paginate(15);

        return view('admin.inscriptions.index', compact('inscriptions'));
    }

    public function create()
    {
        // Récupérer les utilisateurs (clients et étudiants)
        $clientRole = Role::where('slug', 'client')
            ->orWhere('name', 'client')
            ->first();

        if (!$clientRole) {
            $clientRole = Role::create([
                'name' => 'Client',
                'slug' => 'client',
                'description' => 'Utilisateur client',
                'permissions' => []
            ]);
        }

        $users = User::where('role_id', $clientRole->id)
            ->where('is_active', true)
            ->get(['id', 'name', 'email']);

        $formations = Formation::where('is_active', true)
            ->get(['id', 'title', 'type', 'price']);

        $statuses = [
            'pending' => 'En attente',
            'confirmed' => 'Confirmé',
            'in_progress' => 'En cours',
            'completed' => 'Terminé',
            'cancelled' => 'Annulé'
        ];

        $paymentMethods = [
            'cash' => 'Espèces',
            'card' => 'Carte bancaire',
            'bank_transfer' => 'Virement bancaire',
            'cpf' => 'CPF',
            'pôle_emploi' => 'Pôle Emploi',
            'other' => 'Autre'
        ];

        return view('admin.inscriptions.create', compact('users', 'formations', 'statuses', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'formation_id' => 'required|exists:formations,id',
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'amount_paid' => 'required|numeric|min:0',
            'payment_method' => 'nullable|in:cash,card,bank_transfer,cpf,pôle_emploi,other',
            'notes' => 'nullable|string',
        ]);

        // Vérifier si l'inscription existe déjà
        $existingInscription = Inscription::where('user_id', $validated['user_id'])
            ->where('formation_id', $validated['formation_id'])
            ->exists();

        if ($existingInscription) {
            return back()->withErrors(['formation_id' => 'Cet utilisateur est déjà inscrit à cette formation.'])->withInput();
        }

        $inscription = Inscription::create($validated);

        // Envoyer un email de confirmation de création
        $this->sendStatusEmail($inscription, 'created');

        return redirect()->route('admin.inscriptions.show', $inscription)
            ->with('success', 'Inscription créée avec succès.');
    }

    public function show(Inscription $inscription)
    {
        $inscription->load(['user', 'formation']);

        // Récupérer les formations pour le transfert éventuel
        $formations = Formation::where('is_active', true)
            ->where('id', '!=', $inscription->formation_id)
            ->get(['id', 'title', 'type', 'price']);

        $statuses = [
            'pending' => 'En attente',
            'confirmed' => 'Confirmé',
            'in_progress' => 'En cours',
            'completed' => 'Terminé',
            'cancelled' => 'Annulé'
        ];

        $paymentMethods = [
            'cash' => 'Espèces',
            'card' => 'Carte bancaire',
            'bank_transfer' => 'Virement bancaire',
            'cpf' => 'CPF',
            'pôle_emploi' => 'Pôle Emploi',
            'other' => 'Autre'
        ];

        return view('admin.inscriptions.show', compact('inscription', 'formations', 'statuses', 'paymentMethods'));
    }

    public function edit(Inscription $inscription)
    {
        // Récupérer les utilisateurs
        $clientRole = Role::where('slug', 'client')
            ->orWhere('name', 'client')
            ->first();

        if (!$clientRole) {
            $clientRole = Role::create([
                'name' => 'Client',
                'slug' => 'client',
                'description' => 'Utilisateur client',
                'permissions' => []
            ]);
        }

        $users = User::where('role_id', $clientRole->id)
            ->where('is_active', true)
            ->get(['id', 'name', 'email']);

        $formations = Formation::where('is_active', true)
            ->get(['id', 'title', 'type', 'price']);

        $statuses = [
            'pending' => 'En attente',
            'confirmed' => 'Confirmé',
            'in_progress' => 'En cours',
            'completed' => 'Terminé',
            'cancelled' => 'Annulé'
        ];

        $paymentMethods = [
            'cash' => 'Espèces',
            'card' => 'Carte bancaire',
            'bank_transfer' => 'Virement bancaire',
            'cpf' => 'CPF',
            'pôle_emploi' => 'Pôle Emploi',
            'other' => 'Autre'
        ];

        return view('admin.inscriptions.edit', compact('inscription', 'users', 'formations', 'statuses', 'paymentMethods'));
    }

    public function update(Request $request, Inscription $inscription)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'formation_id' => 'required|exists:formations,id',
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'amount_paid' => 'required|numeric|min:0',
            'payment_method' => 'nullable|in:cash,card,bank_transfer,cpf,pôle_emploi,other',
            'notes' => 'nullable|string',
        ]);

        // Vérifier si l'inscription existe déjà pour un autre utilisateur
        $existingInscription = Inscription::where('user_id', $validated['user_id'])
            ->where('formation_id', $validated['formation_id'])
            ->where('id', '!=', $inscription->id)
            ->exists();

        if ($existingInscription) {
            return back()->withErrors(['formation_id' => 'Cet utilisateur est déjà inscrit à cette formation.'])->withInput();
        }

        // Vérifier si le statut a changé
        $statusChanged = $inscription->status !== $validated['status'];
        $oldStatus = $inscription->status;

        $inscription->update($validated);

        // Envoyer un email si le statut a changé
        if ($statusChanged) {
            $this->sendStatusEmail($inscription, $oldStatus);
        }

        return redirect()->route('admin.inscriptions.show', $inscription)
            ->with('success', 'Inscription mise à jour avec succès.');
    }

    public function destroy(Inscription $inscription)
    {
        // Envoyer un email d'annulation avant suppression
        $this->sendStatusEmail($inscription, 'deleted');

        $inscription->delete();

        return redirect()->route('admin.inscriptions.index')
            ->with('success', 'Inscription supprimée avec succès.');
    }

    // Action rapide pour changer le statut
    public function updateStatus(Request $request, Inscription $inscription)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled'
        ]);

        $oldStatus = $inscription->status;
        $inscription->update(['status' => $request->status]);

        // Envoyer un email de notification
        $this->sendStatusEmail($inscription, $oldStatus);

        return response()->json([
            'success' => true,
            'message' => 'Statut mis à jour',
            'new_status' => $request->status,
            'status_label' => $this->getStatusLabel($request->status)
        ]);
    }

    // Action pour transférer vers une autre formation
    public function transfer(Request $request, Inscription $inscription)
    {
        $request->validate([
            'new_formation_id' => 'required|exists:formations,id'
        ]);

        // Vérifier si l'utilisateur est déjà inscrit à la nouvelle formation
        $existingInscription = Inscription::where('user_id', $inscription->user_id)
            ->where('formation_id', $request->new_formation_id)
            ->exists();

        if ($existingInscription) {
            return back()->withErrors(['new_formation_id' => 'Cet utilisateur est déjà inscrit à cette formation.'])->withInput();
        }

        // Sauvegarder l'ancienne formation pour l'email
        $oldFormation = $inscription->formation;
        $newFormation = Formation::find($request->new_formation_id);

        // Mettre à jour l'inscription
        $inscription->update([
            'formation_id' => $request->new_formation_id,
            'status' => 'pending', // Réinitialiser le statut
            'notes' => $inscription->notes . "\n\nTransfert de formation: " . date('d/m/Y')
        ]);

        // Envoyer un email de transfert
        $this->sendTransferEmail($inscription, $oldFormation, $newFormation);

        return redirect()->route('admin.inscriptions.show', $inscription)
            ->with('success', 'Inscription transférée avec succès.');
    }

    // NOUVELLE MÉTHODE : Renvoyer manuellement l'email
    public function resendEmail(Request $request, Inscription $inscription)
    {
        try {
            // Charger les relations
            $inscription->load(['user', 'formation']);

            // Préparer les données pour l'email
            $emailData = [
                'inscription' => $inscription,
                'student_name' => $inscription->user->name,
                'formation_title' => $inscription->formation->title,
                'new_status' => $this->getStatusLabel($inscription->status),
                'status' => $inscription->status,
                'action' => 'updated',
                'start_date' => $inscription->start_date ? $inscription->start_date->format('d/m/Y') : 'Non défini',
                'end_date' => $inscription->end_date ? $inscription->end_date->format('d/m/Y') : 'Non défini',
                'amount_paid' => number_format($inscription->amount_paid, 2) . ' €',
                'total_amount' => number_format($inscription->formation->price, 2) . ' €',
                'remaining_amount' => number_format($inscription->formation->price - $inscription->amount_paid, 2) . ' €',
                'is_resend' => true,
            ];

            // Envoyer l'email
            Mail::to($inscription->user->email)
                ->send(new InscriptionStatusChanged($emailData));

            Log::info('Email renvoyé manuellement pour l\'inscription #' . $inscription->id . ' à ' . $inscription->user->email);

            return response()->json([
                'success' => true,
                'message' => 'Email renvoyé avec succès à ' . $inscription->user->email
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors du renvoi de l\'email: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'envoi de l\'email : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Envoyer un email de notification de changement de statut
     */
    private function sendStatusEmail(Inscription $inscription, $oldStatus = null)
    {
        try {
            // Charger les relations
            $inscription->load(['user', 'formation']);

            $emailData = [
                'inscription' => $inscription,
                'student_name' => $inscription->user->name,
                'formation_title' => $inscription->formation->title,
                'new_status' => $this->getStatusLabel($inscription->status),
                'old_status' => $oldStatus ? $this->getStatusLabel($oldStatus) : null,
                'status' => $inscription->status,
                'action' => $oldStatus === null ? 'created' : ($inscription->exists ? 'updated' : 'deleted'),
                'start_date' => $inscription->start_date ? $inscription->start_date->format('d/m/Y') : 'Non défini',
                'end_date' => $inscription->end_date ? $inscription->end_date->format('d/m/Y') : 'Non défini',
                'amount_paid' => number_format($inscription->amount_paid, 2) . ' €',
                'total_amount' => number_format($inscription->formation->price, 2) . ' €',
                'remaining_amount' => number_format($inscription->formation->price - $inscription->amount_paid, 2) . ' €',
                'is_resend' => false,
            ];

            // Envoyer l'email
            Mail::to($inscription->user->email)
                ->send(new InscriptionStatusChanged($emailData));

            Log::info('Email de statut envoyé pour l\'inscription #' . $inscription->id . ' à ' . $inscription->user->email);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'email de statut: ' . $e->getMessage());
        }
    }

    /**
     * Envoyer un email de notification de transfert de formation
     */
    private function sendTransferEmail(Inscription $inscription, $oldFormation, $newFormation)
    {
        try {
            $emailData = [
                'inscription' => $inscription,
                'student_name' => $inscription->user->name,
                'old_formation' => $oldFormation->title,
                'new_formation' => $newFormation->title,
                'transfer_date' => date('d/m/Y'),
                'old_formation_type' => $oldFormation->type,
                'new_formation_type' => $newFormation->type,
                'old_formation_price' => number_format($oldFormation->price, 2) . ' €',
                'new_formation_price' => number_format($newFormation->price, 2) . ' €',
                'difference_amount' => number_format($newFormation->price - $oldFormation->price, 2) . ' €',
            ];

            // Envoyer l'email
            Mail::to($inscription->user->email)
                ->send(new FormationTransferred($emailData));

            Log::info('Email de transfert envoyé pour l\'inscription #' . $inscription->id);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'email de transfert: ' . $e->getMessage());
        }
    }

    private function getStatusLabel($status)
    {
        $labels = [
            'pending' => 'En attente',
            'confirmed' => 'Confirmé',
            'in_progress' => 'En cours',
            'completed' => 'Terminé',
            'cancelled' => 'Annulé'
        ];

        return $labels[$status] ?? $status;
    }
}
