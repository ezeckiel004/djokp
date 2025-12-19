<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;

class LocationReservation extends Model
{
    use HasFactory;

    protected $table = 'location_reservations';

    protected $fillable = [
        'reference',
        'user_id',
        'nom',
        'email',
        'telephone',
        'vehicle_id',
        'date_debut',
        'date_fin',
        'montant_total',
        'statut',
        'notes',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'montant_total' => 'decimal:2',
    ];

    protected $appends = [
        'duree_jours',
        'statut_fr',
        'statut_couleur',
        'montant_formatted',
        'jours_restants',
        'tarif_journalier_moyen',
        'tarif_journalier_moyen_formatted',
        'resume',
        'prochains_statuts_possibles',
        'email_logs_formatted',
        'email_count',
        'statistiques_emails',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($reservation) {
            $reservation->reference = 'LOC-' . date('Ymd') . '-' . strtoupper(uniqid());

            // Initialiser les logs d'email si la colonne existe
            if (isset($reservation->email_logs)) {
                $reservation->email_logs = [];
            }
        });

        static::created(function ($reservation) {
            // Logger la création
            Log::info('Réservation créée', [
                'reservation_id' => $reservation->id,
                'reference' => $reservation->reference,
                'email' => $reservation->email,
                'statut' => $reservation->statut,
                'montant' => $reservation->montant_total,
                'user_ip' => request()?->ip() ?? 'system'
            ]);
        });

        static::updated(function ($reservation) {
            // Vérifier si le statut a changé
            if ($reservation->isDirty('statut')) {
                $ancienStatut = $reservation->getOriginal('statut');
                $nouveauStatut = $reservation->statut;

                // Logger le changement de statut
                Log::info('Statut de réservation modifié', [
                    'reservation_id' => $reservation->id,
                    'reference' => $reservation->reference,
                    'email' => $reservation->email,
                    'ancien_statut' => $ancienStatut,
                    'nouveau_statut' => $nouveauStatut,
                    'user_ip' => request()?->ip() ?? 'system'
                ]);
            }

            // Logger les autres modifications importantes
            $changementsImportants = ['montant_total', 'date_debut', 'date_fin', 'vehicle_id'];
            foreach ($changementsImportants as $champ) {
                if ($reservation->isDirty($champ)) {
                    $ancienneValeur = $reservation->getOriginal($champ);
                    $nouvelleValeur = $reservation->$champ;

                    Log::info('Modification de réservation', [
                        'reservation_id' => $reservation->id,
                        'reference' => $reservation->reference,
                        'champ' => $champ,
                        'ancienne_valeur' => $ancienneValeur,
                        'nouvelle_valeur' => $nouvelleValeur,
                        'user_ip' => request()?->ip() ?? 'system'
                    ]);
                }
            }
        });

        static::deleting(function ($reservation) {
            // Logger la suppression
            Log::info('Réservation supprimée', [
                'reservation_id' => $reservation->id,
                'reference' => $reservation->reference,
                'email' => $reservation->email,
                'statut' => $reservation->statut,
                'user_ip' => request()?->ip() ?? 'system'
            ]);
        });
    }

    /**
     * Relation avec le véhicule
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Relation avec l'utilisateur
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calculer la durée en jours
     */
    public function calculateDuree(): int
    {
        if ($this->date_debut && $this->date_fin) {
            $debut = \Carbon\Carbon::parse($this->date_debut);
            $fin = \Carbon\Carbon::parse($this->date_fin);
            return $debut->diffInDays($fin) + 1;
        }
        return 0;
    }

    /**
     * Getter pour la durée (utilise la colonne générée ou calcule)
     */
    public function getDureeJoursAttribute()
    {
        // Si la colonne générée existe, l'utiliser
        if (isset($this->attributes['duree_jours'])) {
            return $this->attributes['duree_jours'];
        }

        // Sinon calculer
        return $this->calculateDuree();
    }

    /**
     * Logger l'envoi d'email
     */
    public function logEmailSent($type, $status, $message = null)
    {
        $context = [
            'reservation_id' => $this->id,
            'reference' => $this->reference,
            'email' => $this->email,
            'type' => $type,
            'status' => $status,
            'message' => $message,
            'user_ip' => request()?->ip() ?? 'system',
            'timestamp' => now()->toISOString()
        ];

        // Utiliser différents niveaux de log selon le type
        switch ($type) {
            case 'erreur':
                Log::error('Erreur d\'envoi d\'email pour réservation', $context);
                break;
            case 'création':
                Log::info('Email de création envoyé', $context);
                break;
            case 'changement_statut':
                Log::info('Email de changement de statut envoyé', $context);
                break;
            case 'suppression':
                Log::info('Email de suppression envoyé', $context);
                break;
            default:
                Log::info('Email envoyé pour réservation', $context);
                break;
        }

        return $context;
    }

    /**
     * Vérifier si un email a été envoyé récemment pour un type donné
     */
    public function hasEmailSentRecently($type, $minutes = 5)
    {
        // Par défaut, retourner false pour permettre l'envoi
        return false;
    }

    /**
     * Scope pour les réservations en attente
     */
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    /**
     * Scope pour les réservations confirmées
     */
    public function scopeConfirmees($query)
    {
        return $query->where('statut', 'confirmee');
    }

    /**
     * Scope pour les réservations en cours
     */
    public function scopeEnCours($query)
    {
        return $query->where('statut', 'en_cours');
    }

    /**
     * Scope pour les réservations actives (non annulées/terminées)
     */
    public function scopeActives($query)
    {
        return $query->whereNotIn('statut', ['annulee', 'terminee']);
    }

    /**
     * Scope pour les réservations par email
     */
    public function scopeParEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    /**
     * Scope pour les réservations du mois en cours
     */
    public function scopeCeMois($query)
    {
        return $query->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year);
    }

    /**
     * Scope pour les réservations futures
     */
    public function scopeFutures($query)
    {
        return $query->where('date_debut', '>', now());
    }

    /**
     * Scope pour les réservations en cours de date
     */
    public function scopeEnCoursDate($query)
    {
        $today = now()->format('Y-m-d');
        return $query->where('date_debut', '<=', $today)
            ->where('date_fin', '>=', $today);
    }

    /**
     * Scope pour les réservations terminées
     */
    public function scopeTerminees($query)
    {
        return $query->where('statut', 'terminee');
    }

    /**
     * Scope pour les réservations annulées
     */
    public function scopeAnnulees($query)
    {
        return $query->where('statut', 'annulee');
    }

    /**
     * Getter pour le statut en français
     */
    public function getStatutFrAttribute(): string
    {
        return match ($this->statut) {
            'en_attente' => 'En attente',
            'confirmee' => 'Confirmée',
            'en_cours' => 'En cours',
            'terminee' => 'Terminée',
            'annulee' => 'Annulée',
            default => 'Inconnu',
        };
    }

    /**
     * Getter pour la couleur du statut
     */
    public function getStatutCouleurAttribute(): string
    {
        return match ($this->statut) {
            'en_attente' => 'bg-yellow-100 text-yellow-800',
            'confirmee' => 'bg-green-100 text-green-800',
            'en_cours' => 'bg-blue-100 text-blue-800',
            'terminee' => 'bg-gray-100 text-gray-800',
            'annulee' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Getter pour la couleur du statut (version pour emails)
     */
    public function getStatutCouleurHexAttribute(): string
    {
        return match ($this->statut) {
            'en_attente' => '#fef3c7',
            'confirmee' => '#d1fae5',
            'en_cours' => '#dbeafe',
            'terminee' => '#f3f4f6',
            'annulee' => '#fee2e2',
            default => '#f3f4f6',
        };
    }

    /**
     * Vérifier si la réservation est en cours
     */
    public function estEnCours(): bool
    {
        $today = \Carbon\Carbon::today();
        return $this->statut === 'en_cours' ||
            ($this->date_debut <= $today && $this->date_fin >= $today);
    }

    /**
     * Vérifier si la réservation est future
     */
    public function estFuture(): bool
    {
        return $this->date_debut > now();
    }

    /**
     * Vérifier si la réservation est passée
     */
    public function estPassee(): bool
    {
        return $this->date_fin < now();
    }

    /**
     * Calculer les jours restants
     */
    public function getJoursRestantsAttribute(): ?int
    {
        if ($this->date_fin->isPast()) {
            return 0;
        }

        $today = \Carbon\Carbon::today();
        return max(0, $today->diffInDays($this->date_fin, false));
    }

    /**
     * Formater le montant
     */
    public function getMontantFormattedAttribute(): string
    {
        return number_format($this->montant_total, 2, ',', ' ') . ' €';
    }

    /**
     * Calculer le tarif journalier moyen
     */
    public function getTarifJournalierMoyenAttribute(): ?float
    {
        if ($this->duree_jours > 0) {
            return $this->montant_total / $this->duree_jours;
        }
        return null;
    }

    /**
     * Formater le tarif journalier moyen
     */
    public function getTarifJournalierMoyenFormattedAttribute(): ?string
    {
        $tarif = $this->tarif_journalier_moyen;
        return $tarif ? number_format($tarif, 2, ',', ' ') . ' €' : null;
    }

    /**
     * Générer un résumé pour les emails
     */
    public function getResumeAttribute(): array
    {
        return [
            'reference' => $this->reference,
            'client' => $this->nom,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'vehicule' => $this->vehicle->full_name ?? 'N/A',
            'immatriculation' => $this->vehicle->registration ?? 'N/A',
            'date_debut' => $this->date_debut->format('d/m/Y'),
            'date_fin' => $this->date_fin->format('d/m/Y'),
            'duree' => $this->duree_jours . ' jours',
            'montant' => $this->montant_formatted,
            'statut' => $this->statut_fr,
            'jours_restants' => $this->jours_restants,
            'tarif_journalier' => $this->tarif_journalier_moyen_formatted,
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
        ];
    }

    /**
     * Vérifier si la réservation peut être annulée
     */
    public function peutEtreAnnulee(): bool
    {
        // On peut annuler si le statut n'est pas déjà annulé ou terminé
        return !in_array($this->statut, ['annulee', 'terminee']);
    }

    /**
     * Vérifier si la réservation peut être confirmée
     */
    public function peutEtreConfirmee(): bool
    {
        // On peut confirmer si le statut est en attente
        return $this->statut === 'en_attente';
    }

    /**
     * Vérifier si la réservation peut être mise en cours
     */
    public function peutEtreMiseEnCours(): bool
    {
        // On peut mettre en cours si le statut est confirmé et que la date de début est aujourd'hui ou passée
        return $this->statut === 'confirmee' && $this->date_debut <= now();
    }

    /**
     * Vérifier si la réservation peut être terminée
     */
    public function peutEtreTerminee(): bool
    {
        // On peut terminer si le statut est en cours et que la date de fin est aujourd'hui ou passée
        return $this->statut === 'en_cours' && $this->date_fin <= now();
    }

    /**
     * Obtenir le prochain statut possible
     */
    public function getProchainsStatutsPossiblesAttribute(): array
    {
        $statuts = [];

        switch ($this->statut) {
            case 'en_attente':
                $statuts = ['confirmee', 'annulee'];
                break;
            case 'confirmee':
                $statuts = ['en_cours', 'annulee'];
                if ($this->date_debut <= now()) {
                    $statuts[] = 'en_cours';
                }
                break;
            case 'en_cours':
                $statuts = ['terminee'];
                if ($this->date_fin <= now()) {
                    $statuts[] = 'terminee';
                }
                $statuts[] = 'annulee';
                break;
            case 'terminee':
            case 'annulee':
                $statuts = ['en_attente'];
                break;
        }

        return array_unique($statuts);
    }

    /**
     * Vérifier la validité de l'email
     */
    public function emailEstValide(): bool
    {
        return !empty($this->email) && filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Vérifier si la réservation est pour aujourd'hui
     */
    public function estPourAujourdhui(): bool
    {
        $today = \Carbon\Carbon::today();
        return $this->date_debut->isSameDay($today);
    }

    /**
     * Vérifier si la réservation se termine aujourd'hui
     */
    public function seTermineAujourdhui(): bool
    {
        $today = \Carbon\Carbon::today();
        return $this->date_fin->isSameDay($today);
    }

    /**
     * Obtenir le dernier log d'email
     */
    public function getLastEmailLog()
    {
        // Retourner null car on n'a pas de colonne email_logs
        return null;
    }

    /**
     * Getter pour les logs d'email formatés
     */
    public function getEmailLogsFormattedAttribute()
    {
        // Retourner un tableau vide car on n'a pas de colonne email_logs
        return [];
    }

    /**
     * Obtenir le nombre d'emails envoyés
     */
    public function getEmailCountAttribute()
    {
        // Retourner 0 car on n'a pas de colonne email_logs
        return 0;
    }

    /**
     * Obtenir les statistiques d'emails envoyés
     */
    public function getStatistiquesEmailsAttribute(): array
    {
        return [
            'total_emails' => 0,
            'creations' => 0,
            'changements_statut' => 0,
            'suppressions' => 0,
            'dernier_email' => null,
        ];
    }

    /**
     * Getter pour la couleur du statut (version simple)
     */
    public function getCouleurStatutSimpleAttribute(): string
    {
        return match ($this->statut) {
            'en_attente' => 'warning',
            'confirmee' => 'success',
            'en_cours' => 'primary',
            'terminee' => 'secondary',
            'annulee' => 'danger',
            default => 'light',
        };
    }

    /**
     * Vérifier si la réservation est expirée
     */
    public function estExpiree(): bool
    {
        return $this->date_fin->isPast() && $this->statut !== 'terminee' && $this->statut !== 'annulee';
    }

    /**
     * Obtenir la période sous forme de chaîne
     */
    public function getPeriodeAttribute(): string
    {
        return $this->date_debut->format('d/m/Y') . ' - ' . $this->date_fin->format('d/m/Y');
    }

    /**
     * Obtenir le nombre de jours écoulés depuis le début
     */
    public function getJoursEcoulesAttribute(): ?int
    {
        if ($this->date_debut->isFuture()) {
            return 0;
        }

        $today = \Carbon\Carbon::today();
        return $this->date_debut->diffInDays($today) + 1;
    }

    /**
     * Obtenir le pourcentage de progression
     */
    public function getProgressionAttribute(): ?int
    {
        if ($this->duree_jours <= 0) {
            return null;
        }

        if ($this->date_debut->isFuture()) {
            return 0;
        }

        if ($this->date_fin->isPast()) {
            return 100;
        }

        $joursEcoules = $this->jours_ecoules;
        return min(100, (int) round(($joursEcoules / $this->duree_jours) * 100));
    }

    /**
     * Scope pour les réservations expirées
     */
    public function scopeExpirees($query)
    {
        $today = now()->format('Y-m-d');
        return $query->where('date_fin', '<', $today)
            ->whereNotIn('statut', ['terminee', 'annulee']);
    }

    /**
     * Scope pour les réservations à venir cette semaine
     */
    public function scopeCetteSemaine($query)
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        return $query->whereBetween('date_debut', [$startOfWeek, $endOfWeek]);
    }

    /**
     * Scope pour les réservations se terminant cette semaine
     */
    public function scopeSeTermineCetteSemaine($query)
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        return $query->whereBetween('date_fin', [$startOfWeek, $endOfWeek]);
    }

    /**
     * Vérifier si la réservation nécessite une action
     */
    public function necessiteAction(): bool
    {
        return $this->statut === 'en_attente' ||
            ($this->statut === 'confirmee' && $this->estPourAujourdhui()) ||
            ($this->statut === 'en_cours' && $this->seTermineAujourdhui());
    }
}
