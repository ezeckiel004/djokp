<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConciergerieDemande extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom_complet',
        'email',
        'telephone',
        'motif_voyage',
        'date_arrivee',
        'duree_sejour',
        'nombre_personnes',
        'budget',
        'type_accompagnement',
        'services',
        'message',
        'statut',
        'reference',
        'notes_admin',
        'montant_devis',
        'devise',
        'date_devis',
    ];

    protected $casts = [
        'services' => 'array',
        'date_arrivee' => 'date',
        'date_devis' => 'date',
        'montant_devis' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($demande) {
            $demande->reference = 'CONC-' . date('Ymd') . '-' . strtoupper(uniqid());
        });
    }

    // Constantes pour les statuts
    const STATUTS = [
        'nouvelle' => 'Nouvelle',
        'en_cours' => 'En cours',
        'devis_envoye' => 'Devis envoyé',
        'confirme' => 'Confirmé',
        'annule' => 'Annulé',
        'termine' => 'Terminé',
    ];

    // Constantes pour les motifs de voyage
    const MOTIFS = [
        'tourisme' => 'Tourisme',
        'affaires' => 'Affaires / Business',
        'formation' => 'Formation / Études',
        'installation' => 'Installation en France',
        'familial' => 'Visite familiale',
        'evenementiel' => 'Événementiel',
        'autre' => 'Autre',
    ];

    // Constantes pour les types d'accompagnement
    const ACCOMPAGNEMENTS = [
        'chauffeur' => 'Avec chauffeur',
        'location' => 'Location de voiture',
        'mixte' => 'Mixte (Chauffeur + Location)',
    ];

    // Relation avec l'utilisateur (via email)
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    // Accessor pour afficher le statut
    public function getStatutLabelAttribute()
    {
        return self::STATUTS[$this->statut] ?? $this->statut;
    }

    // Accessor pour afficher le motif
    public function getMotifLabelAttribute()
    {
        return self::MOTIFS[$this->motif_voyage] ?? $this->motif_voyage;
    }

    // Accessor pour afficher le type d'accompagnement
    public function getAccompagnementLabelAttribute()
    {
        return self::ACCOMPAGNEMENTS[$this->type_accompagnement] ?? $this->type_accompagnement;
    }

    // Méthode pour formater le montant
    public function getMontantFormateAttribute()
    {
        if (!$this->montant_devis) {
            return 'À déterminer';
        }

        return number_format($this->montant_devis, 2, ',', ' ') . ' ' . $this->devise;
    }

    // Méthode pour vérifier si un devis a été envoyé
    public function getDevisEnvoyeAttribute()
    {
        return in_array($this->statut, ['devis_envoye', 'confirme']);
    }

    // Scopes pour filtrer
    public function scopeNouvelles($query)
    {
        return $query->where('statut', 'nouvelle');
    }

    public function scopeEnCours($query)
    {
        return $query->where('statut', 'en_cours');
    }

    public function scopeDevisEnvoyes($query)
    {
        return $query->where('statut', 'devis_envoye');
    }

    public function scopeConfirmees($query)
    {
        return $query->where('statut', 'confirme');
    }

    public function scopeAnnulees($query)
    {
        return $query->where('statut', 'annule');
    }

    // Scope pour filtrer par email utilisateur
    public function scopeForUser($query, $user)
    {
        return $query->where('email', $user->email);
    }
}
