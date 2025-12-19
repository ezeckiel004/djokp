<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'formation_id',
        'reference',
        'amount',
        'currency',
        'status',
        'stripe_session_id',
        'stripe_payment_intent_id',
        'stripe_response',
        'paid_at',
        'customer_info',
        'refunded_at',
        'refund_reason',
        'refund_data',
    ];

    protected $casts = [
        'stripe_response' => 'array',
        'customer_info' => 'array',
        'refund_data' => 'array',
        'paid_at' => 'datetime',
        'refunded_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    /**
     * Relation avec l'utilisateur (peut être null pour les achats sans compte)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec la formation
     */
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    /**
     * Relation avec les inscriptions utilisateur (UserFormation)
     */
    public function userFormations()
    {
        return $this->hasMany(UserFormation::class);
    }

    /**
     * Relation avec les participants
     */
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    /**
     * Accessor pour l'email du client
     */
    public function getCustomerEmailAttribute()
    {
        // Priorité: email de l'utilisateur lié
        if ($this->user && $this->user->email) {
            return $this->user->email;
        }

        // Sinon: email des infos client Stripe
        return $this->customer_info['email'] ?? null;
    }

    /**
     * Accessor pour le nom du client
     */
    public function getCustomerNameAttribute()
    {
        // Priorité: nom de l'utilisateur lié
        if ($this->user && $this->user->name) {
            return $this->user->name;
        }

        // Sinon: nom des infos client Stripe
        return $this->customer_info['name'] ?? 'Client';
    }

    /**
     * Déterminer si l'achat est lié à un compte utilisateur
     */
    public function isLinkedToAccount()
    {
        return !is_null($this->user_id) && !is_null($this->user);
    }

    /**
     * Déterminer si l'achat est fait par un visiteur
     */
    public function isGuestPurchase()
    {
        return is_null($this->user_id) && isset($this->customer_info['email']);
    }

    /**
     * Vérifier si le paiement est payé
     */
    public function isPaid()
    {
        return $this->status === 'paid';
    }

    /**
     * Vérifier si le paiement est remboursé
     */
    public function isRefunded()
    {
        return $this->status === 'refunded';
    }

    /**
     * Vérifier si le paiement est en attente
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Marquer comme payé
     */
    public function markAsPaid()
    {
        $this->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);
    }

    /**
     * Marquer comme remboursé
     */
    public function markAsRefunded($reason = null, $refundData = null)
    {
        $this->update([
            'status' => 'refunded',
            'refunded_at' => now(),
            'refund_reason' => $reason,
            'refund_data' => $refundData,
        ]);
    }

    /**
     * Récupérer le participant associé
     */
    public function getAssociatedParticipant()
    {
        // Chercher d'abord par paiement_id
        $participant = $this->participants()->first();

        if (!$participant && $this->customer_email) {
            // Chercher par email si pas trouvé par paiement_id
            $participant = Participant::where('email', $this->customer_email)
                ->where('formation_id', $this->formation_id)
                ->first();
        }

        return $participant;
    }

    /**
     * Récupérer les inscriptions utilisateur associées
     */
    public function getAssociatedUserFormations()
    {
        if (!$this->user_id || !$this->formation_id) {
            return collect();
        }

        return UserFormation::where('user_id', $this->user_id)
            ->where('formation_id', $this->formation_id)
            ->get();
    }

    /**
     * Scope pour les paiements payés
     */
    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    /**
     * Scope pour les paiements en attente
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope pour les paiements remboursés
     */
    public function scopeRefunded($query)
    {
        return $query->where('status', 'refunded');
    }

    /**
     * Scope pour les paiements annulés
     */
    public function scopeCanceled($query)
    {
        return $query->where('status', 'canceled');
    }

    /**
     * Formater le montant pour l'affichage
     */
    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 0, ',', ' ') . ' €';
    }

    /**
     * Obtenir le statut formaté
     */
    public function getFormattedStatusAttribute()
    {
        $statusMap = [
            'paid' => 'Payé',
            'pending' => 'En attente',
            'refunded' => 'Remboursé',
            'canceled' => 'Annulé',
            'failed' => 'Échoué',
        ];

        return $statusMap[$this->status] ?? $this->status;
    }

    /**
     * Obtenir la couleur du badge selon le statut
     */
    public function getStatusColorAttribute()
    {
        $colors = [
            'paid' => 'bg-green-100 text-green-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'refunded' => 'bg-purple-100 text-purple-800',
            'canceled' => 'bg-red-100 text-red-800',
            'failed' => 'bg-gray-100 text-gray-800',
        ];

        return $colors[$this->status] ?? 'bg-gray-100 text-gray-800';
    }
}
