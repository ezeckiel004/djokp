<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $fillable = [
        'registration',
        'brand',
        'model',
        'year',
        'color',
        'category',
        'fuel_type',
        'seats',
        'features',
        'is_available',
        'daily_rate',
        'weekly_rate',
        'monthly_rate',
        'image',
        'description'
    ];

    protected $casts = [
        'year' => 'integer',
        'seats' => 'integer',
        'is_available' => 'boolean',
        'daily_rate' => 'decimal:2',
        'weekly_rate' => 'decimal:2',
        'monthly_rate' => 'decimal:2',
        'features' => 'array',
    ];

    /**
     * Relation avec les réservations de location
     */
    public function locationReservations(): HasMany
    {
        return $this->hasMany(LocationReservation::class);
    }

    /**
     * Relation avec les réservations (pour compatibilité)
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Getter pour la catégorie en français
     */
    public function getCategoryFrAttribute(): string
    {
        return match ($this->category) {
            'eco' => 'Économique',
            'business' => 'Business / Confort',
            'prestige' => 'Prestige',
            'van' => 'Van / Utilitaire',
            default => ucfirst($this->category),
        };
    }

    /**
     * Getter pour le type de carburant en français
     */
    public function getFuelTypeFrAttribute(): string
    {
        return match ($this->fuel_type) {
            'essence' => 'Essence',
            'diesel' => 'Diesel',
            'hybrid' => 'Hybride',
            'electric' => 'Électrique',
            default => ucfirst($this->fuel_type),
        };
    }

    /**
     * Getter pour la disponibilité en français
     */
    public function getAvailabilityFrAttribute(): string
    {
        return $this->is_available ? 'Disponible' : 'Indisponible';
    }

    /**
     * Getter pour le nom complet du véhicule
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->brand} {$this->model} ({$this->year})";
    }

    /**
     * Getter pour le tarif journalier formaté
     */
    public function getDailyRateFormattedAttribute(): string
    {
        return number_format($this->daily_rate, 2, ',', ' ') . ' €';
    }

    /**
     * Getter pour le tarif hebdomadaire formaté
     */
    public function getWeeklyRateFormattedAttribute(): string
    {
        return number_format($this->weekly_rate, 2, ',', ' ') . ' €';
    }

    /**
     * Getter pour le tarif mensuel formaté
     */
    public function getMonthlyRateFormattedAttribute(): string
    {
        return number_format($this->monthly_rate, 2, ',', ' ') . ' €';
    }

    /**
     * Getter pour la couleur de disponibilité
     */
    public function getAvailabilityColorAttribute(): string
    {
        return $this->is_available
            ? 'bg-green-100 text-green-800'
            : 'bg-red-100 text-red-800';
    }

    /**
     * Getter pour la couleur de la catégorie
     */
    public function getCategoryColorAttribute(): string
    {
        return match ($this->category) {
            'eco' => 'bg-blue-100 text-blue-800',
            'business' => 'bg-purple-100 text-purple-800',
            'prestige' => 'bg-yellow-100 text-yellow-800',
            'van' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Getter pour l'URL de l'image du véhicule
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        // Images par défaut par catégorie
        $defaultImages = [
            'eco' => 'https://images.unsplash.com/photo-1621135802920-133df287f89c?w=600&h=400&fit=crop',
            'business' => 'https://images.unsplash.com/photo-1617814076666-1dedaf7c4cbe?w=600&h=400&fit=crop',
            'prestige' => 'https://images.unsplash.com/photo-1563720223485-8d84e8a6e9e7?w=600&h=400&fit=crop',
            'van' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=600&h=400&fit=crop',
        ];

        return $defaultImages[$this->category] ?? $defaultImages['eco'];
    }

    /**
     * Getter pour l'image de thumbnail
     */
    public function getThumbnailUrlAttribute(): string
    {
        return $this->image_url;
    }

    /**
     * Scope pour les véhicules disponibles
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    /**
     * Scope pour les véhicules par catégorie
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope pour les véhicules économiques
     */
    public function scopeEconomiques($query)
    {
        return $query->where('category', 'eco');
    }

    /**
     * Scope pour les véhicules business
     */
    public function scopeBusiness($query)
    {
        return $query->where('category', 'business');
    }

    /**
     * Scope pour les véhicules prestige
     */
    public function scopePrestige($query)
    {
        return $query->where('category', 'prestige');
    }

    /**
     * Vérifier si le véhicule est disponible pour une période donnée
     * VERSION SIMPLIFIÉE - TOUJOURS DISPONIBLE si is_available = true
     */
    public function isAvailableForPeriod($date_debut, $date_fin): bool
    {
        // Seule vérification : le véhicule doit être marqué comme disponible
        // PAS de vérification des réservations existantes
        return $this->is_available === true;
    }

    /**
     * Calculer le prix pour une durée donnée
     */
    public function calculatePriceForDuration($duree_jours): float
    {
        if ($duree_jours <= 7) {
            // Tarif journalier
            return $duree_jours * $this->daily_rate;
        } elseif ($duree_jours <= 30) {
            // Tarif hebdomadaire
            $semaines = ceil($duree_jours / 7);
            return $semaines * $this->weekly_rate;
        } else {
            // Tarif mensuel
            $mois = ceil($duree_jours / 30);
            return $mois * $this->monthly_rate;
        }
    }

    /**
     * Calculer le meilleur tarif pour une durée
     */
    public function calculateBestPrice($duree_jours): array
    {
        $options = [];

        // Option 1: Tarif journalier
        $options['journalier'] = [
            'type' => 'journalier',
            'label' => 'Tarif journalier',
            'montant' => $duree_jours * $this->daily_rate,
            'unite' => $duree_jours . ' jour(s)',
        ];

        // Option 2: Tarif hebdomadaire
        $semaines = ceil($duree_jours / 7);
        $options['hebdomadaire'] = [
            'type' => 'hebdomadaire',
            'label' => 'Tarif hebdomadaire',
            'montant' => $semaines * $this->weekly_rate,
            'unite' => $semaines . ' semaine(s)',
        ];

        // Option 3: Tarif mensuel (si plus d'une semaine)
        if ($duree_jours > 7) {
            $mois = ceil($duree_jours / 30);
            $options['mensuel'] = [
                'type' => 'mensuel',
                'label' => 'Tarif mensuel',
                'montant' => $mois * $this->monthly_rate,
                'unite' => $mois . ' mois',
            ];
        }

        // Trouver le meilleur prix
        $bestOption = collect($options)->sortBy('montant')->first();

        return [
            'options' => $options,
            'best' => $bestOption,
        ];
    }

    /**
     * Obtenir les caractéristiques formatées
     */
    public function getFeaturesListAttribute(): array
    {
        $defaultFeatures = [
            'Climatisation',
            'GPS',
            'Bluetooth',
            'Caméra de recul',
            'Sièges cuir',
            'Toit ouvrant',
            'Régulateur de vitesse',
        ];

        if (empty($this->features)) {
            return array_slice($defaultFeatures, 0, 3);
        }

        return is_array($this->features) ? $this->features : [];
    }

    /**
     * Formater les caractéristiques pour l'affichage
     */
    public function getFeaturesDisplayAttribute(): string
    {
        $features = $this->features_list;
        return !empty($features) ? implode(', ', array_slice($features, 0, 3)) : 'Équipement standard';
    }

    /**
     * Statistiques d'utilisation du véhicule
     */
    public function getStatsAttribute(): array
    {
        $totalReservations = $this->locationReservations()->count();
        $completedReservations = $this->locationReservations()->where('statut', 'terminee')->count();
        $totalRevenue = $this->locationReservations()->where('statut', 'terminee')->sum('montant_total');

        return [
            'total_reservations' => $totalReservations,
            'completed_reservations' => $completedReservations,
            'total_revenue' => $totalRevenue,
            'avg_duration' => $totalReservations > 0
                ? $this->locationReservations()->avg('duree_jours')
                : 0,
            'occupation_rate' => $totalReservations > 0
                ? ($completedReservations / $totalReservations) * 100
                : 0,
        ];
    }

    /**
     * Obtenir le modèle équivalent pour l'affichage
     */
    public function getModelNameAttribute(): string
    {
        $modelsMapping = [
            'Toyota Prius Hybride' => 'Toyota Prius Hybride',
            'Peugeot 508' => 'Peugeot 508',
            'Renault Talisman' => 'Renault Talisman',
            'Mercedes Classe C' => 'Mercedes Classe C',
            'Volkswagen Passat' => 'Volkswagen Passat',
            'Audi A4' => 'Audi A4',
            'Mercedes Classe E' => 'Mercedes Classe E',
            'Tesla Model Y' => 'Tesla Model Y',
            'BMW Série 5' => 'BMW Série 5',
        ];

        $key = $this->brand . ' ' . $this->model;
        return $modelsMapping[$key] ?? $this->full_name;
    }

    // Dans app/Models/Vehicle.php

    /**
     * Getter pour les features formatées en chaîne
     */
    public function getFeaturesStringAttribute(): string
    {
        if (empty($this->features)) {
            return 'Aucun équipement spécifique';
        }

        if (is_string($this->features)) {
            return $this->features;
        }

        if (is_array($this->features)) {
            return implode(', ', $this->features);
        }

        return '';
    }
}
