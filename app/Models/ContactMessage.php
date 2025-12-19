<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $table = 'contact_messages';

    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'service_id',
        'autre_service',
        'message',
        'is_read',
        'is_replied',
        'replied_at',
        'reply_message',

    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_replied' => 'boolean',
        'replied_at' => 'datetime',
    ];

    /**
     * Relation avec le service
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Accessor pour le nom complet du service
     */
    public function getServiceNameAttribute()
    {
        if ($this->service_id && $this->service) {
            return $this->service->name;
        } elseif ($this->autre_service) {
            return "Autre : " . $this->autre_service;
        }

        return 'Non spécifié';
    }

    /**
     * Accessor pour le statut formaté
     */
    public function getStatusBadgeAttribute()
    {
        if (!$this->is_read) {
            return '<span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 border border-red-200">Non lu</span>';
        } elseif ($this->is_replied) {
            return '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 border border-green-200">Répondu</span>';
        } else {
            return '<span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 border border-blue-200">Lu</span>';
        }
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
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope pour les messages non répondus
     */
    public function scopeUnreplied($query)
    {
        return $query->where('is_replied', false);
    }

    /**
     * Marquer comme lu
     */
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }

    /**
     * Marquer comme répondu
     */
    public function markAsReplied($replyMessage = null)
    {
        $this->update([
            'is_replied' => true,
            'replied_at' => now(),
            'reply_message' => $replyMessage
        ]);
    }
}
