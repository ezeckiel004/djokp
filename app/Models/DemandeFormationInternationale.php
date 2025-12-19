<?php
// app/Models/DemandeFormationInternationale.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DemandeFormationInternationale extends Model
{
    protected $fillable = [
        'formation_id',
        'nom_complet',
        'nationalite',
        'email',
        'telephone',
        'whatsapp',
        'formation_personnalisee',
        'message',
        'services',
        'date_debut',
        'duree',
        'statut',
        'notes_admin'
    ];

    protected $casts = [
        'services' => 'array',
        'date_debut' => 'date'
    ];

    /**
     * Relation avec la formation
     */
    public function formation(): BelongsTo
    {
        return $this->belongsTo(Formation::class);
    }

    // Méthodes utilitaires
    public function getFormationLabelAttribute()
    {
        if ($this->formation_id && $this->formation) {
            return $this->formation->title;
        }

        if ($this->formation_personnalisee) {
            // Si c'est une clé de formation personnalisée
            $formations = [
                'vtc' => 'Formation VTC',
                'micro_entreprise' => 'Formation Micro-entreprise & gestion',
                'marketing' => 'Formation Communication & marketing digital',
                'creation_entreprise' => 'Formation Création d\'entreprise',
                'bureautique' => 'Formation Bureautique & Excel',
                'langue' => 'Formation Langue & accueil client',
                'personnalise' => 'Programme personnalisé'
            ];

            return $formations[$this->formation_personnalisee] ?? $this->formation_personnalisee;
        }

        return 'Non spécifié';
    }

    public function getStatutLabelAttribute()
    {
        $statuts = [
            'nouveau' => 'Nouveau',
            'en_cours' => 'En cours',
            'traite' => 'Traité',
            'annule' => 'Annulé'
        ];

        return $statuts[$this->statut] ?? $this->statut;
    }

    public function getStatutColorAttribute()
    {
        return match ($this->statut) {
            'nouveau' => 'bg-yellow-100 text-yellow-800',
            'en_cours' => 'bg-blue-100 text-blue-800',
            'traite' => 'bg-green-100 text-green-800',
            'annule' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    public function getServicesListAttribute()
    {
        if (empty($this->services) || !is_array($this->services)) {
            return 'Aucun service spécifique';
        }

        return implode(', ', $this->services);
    }

    /**
     * Scope pour filtrer par statut
     */
    public function scopeFilterByStatut($query, $statut)
    {
        if ($statut) {
            return $query->where('statut', $statut);
        }
        return $query;
    }

    /**
     * Scope pour les demandes récentes
     */
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }
}
