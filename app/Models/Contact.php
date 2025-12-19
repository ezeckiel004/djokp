<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'assigned_to',
        'admin_notes'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relation avec l'utilisateur assigné
     */
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Accessor pour le sujet formaté
     */
    public function getSubjectFormattedAttribute()
    {
        $subjects = [
            'formation' => 'Formation',
            'location' => 'Location',
            'vtc' => 'VTC',
            'conciergerie' => 'Conciergerie',
            'international' => 'International',
            'other' => 'Autre'
        ];

        return $subjects[$this->subject] ?? ucfirst($this->subject);
    }

    /**
     * Accessor pour le statut formaté
     */
    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'new' => '<span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 border border-red-200">Nouveau</span>',
            'read' => '<span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 border border-blue-200">Lu</span>',
            'in_progress' => '<span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">En cours</span>',
            'closed' => '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 border border-green-200">Fermé</span>',
        ];

        return $statuses[$this->status] ?? '<span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800 border border-gray-200">Inconnu</span>';
    }

    /**
     * Accessor pour la date formatée
     */
    public function getDateFormattedAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }

    /**
     * Scope pour les messages non lus
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Scope pour les messages en cours
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    /**
     * Marquer comme lu
     */
    public function markAsRead()
    {
        $this->update(['status' => 'read']);
    }

    /**
     * Marquer comme en cours
     */
    public function markAsInProgress()
    {
        $this->update(['status' => 'in_progress']);
    }

    /**
     * Marquer comme fermé
     */
    public function markAsClosed()
    {
        $this->update(['status' => 'closed']);
    }

    /**
     * Assigner à un utilisateur
     */
    public function assignTo($userId)
    {
        $this->update(['assigned_to' => $userId]);
    }

    /**
     * Vérifier si c'est une demande urgente (basé sur le contenu)
     */
    public function isUrgent()
    {
        return str_contains(strtolower($this->admin_notes ?? ''), 'urgent') ||
            str_contains(strtolower($this->message), 'urgent');
    }
}
