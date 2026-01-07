<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    protected $fillable = [
        'registration',
        'brand',
        'model',
        'year',
        'color',
        'vehicle_category_id',
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
     * Relation avec la catégorie du véhicule
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(VehicleCategory::class, 'vehicle_category_id');
    }

    /**
     * Alias pour la relation category (pour compatibilité)
     */
    public function vehicleCategory(): BelongsTo
    {
        return $this->belongsTo(VehicleCategory::class, 'vehicle_category_id');
    }

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
        // Vérifier si la relation est chargée et accessible
        if ($this->relationLoaded('category')) {
            $categoryRelation = $this->getRelation('category');
            if ($categoryRelation instanceof VehicleCategory) {
                return $categoryRelation->display_name;
            }
        }

        // Sinon, retourner une valeur par défaut basée sur l'ID de catégorie
        return $this->getCategoryDisplayNameFromId();
    }

    /**
     * Getter pour le nom de la catégorie (code)
     */
    public function getCategoryNameAttribute(): ?string
    {
        // Vérifier si la relation est chargée et accessible
        if ($this->relationLoaded('category')) {
            $categoryRelation = $this->getRelation('category');
            if ($categoryRelation instanceof VehicleCategory) {
                return $categoryRelation->categorie;
            }
        }

        // Sinon, essayer de déterminer le nom basé sur l'ID
        return $this->getCategoryCodeFromId();
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
        // Utiliser directement l'ID de catégorie pour éviter les références circulaires
        return match ($this->vehicle_category_id) {
            1 => 'bg-blue-100 text-blue-800', // eco
            2 => 'bg-purple-100 text-purple-800', // business
            3 => 'bg-yellow-100 text-yellow-800', // prestige
            4 => 'bg-gray-100 text-gray-800', // van
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

        // Images par défaut par ID de catégorie (éviter les références circulaires)
        $defaultImages = [
            1 => 'https://images.unsplash.com/photo-1621135802920-133df287f89c?w=600&h=400&fit=crop', // eco
            2 => 'https://images.unsplash.com/photo-1617814076666-1dedaf7c4cbe?w=600&h=400&fit=crop', // business
            3 => 'https://images.unsplash.com/photo-1563720223485-8d84e8a6e9e7?w=600&h=400&fit=crop', // prestige
            4 => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=600&h=400&fit=crop', // van
        ];

        return $defaultImages[$this->vehicle_category_id] ?? $defaultImages[1];
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
     * Scope pour les véhicules par catégorie (via ID ou nom)
     */
    public function scopeByCategory($query, $category)
    {
        // Si c'est un ID, on filtre directement
        if (is_numeric($category)) {
            return $query->where('vehicle_category_id', $category);
        }

        // Si c'est un nom de catégorie, on fait une jointure
        return $query->whereHas('category', function ($q) use ($category) {
            $q->where('categorie', $category);
        });
    }

    /**
     * Scope pour les véhicules par ID de catégorie
     */
    public function scopeByCategoryId($query, $categoryId)
    {
        return $query->where('vehicle_category_id', $categoryId);
    }

    /**
     * Scope pour les véhicules économiques
     */
    public function scopeEconomiques($query)
    {
        return $query->whereHas('category', function ($q) {
            $q->where('categorie', 'eco');
        });
    }

    /**
     * Scope pour les véhicules business
     */
    public function scopeBusiness($query)
    {
        return $query->whereHas('category', function ($q) {
            $q->where('categorie', 'business');
        });
    }

    /**
     * Scope pour les véhicules prestige
     */
    public function scopePrestige($query)
    {
        return $query->whereHas('category', function ($q) {
            $q->where('categorie', 'prestige');
        });
    }

    /**
     * Scope pour les véhicules vans
     */
    public function scopeVans($query)
    {
        return $query->whereHas('category', function ($q) {
            $q->where('categorie', 'van');
        });
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

    /**
     * Getter pour les tarifs de catégorie
     */
    public function getCategoryPricingAttribute(): ?array
    {
        // Ne pas essayer d'accéder à la relation ici pour éviter les références circulaires
        return null;
    }

    /**
     * Accessor pour l'ancienne colonne category (lecture seule)
     * NE PAS UTILISER CET ACCESSOR - DÉPRÉCIÉ
     * Cette méthode est délicate car elle surcharge la relation
     */
    public function getCategoryAttribute()
    {
        // Si quelqu'un essaye d'accéder à la relation, retourner la relation
        if ($this->relationLoaded('category')) {
            return $this->getRelation('category');
        }

        // Sinon, pour compatibilité avec l'ancien code, retourner le code de catégorie
        return $this->getCategoryCodeFromId();
    }

    /**
     * Méthode pour obtenir les véhicules similaires
     */
    public function similarVehicles($limit = 3)
    {
        return self::with('category')
            ->available()
            ->where('vehicle_category_id', $this->vehicle_category_id)
            ->where('id', '!=', $this->id)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }

    /**
     * Vérifier si le véhicule a une catégorie
     */
    public function hasCategory(): bool
    {
        return !is_null($this->vehicle_category_id);
    }

    /**
     * Obtenir le nom de la marque avec formatage
     */
    public function getBrandFormattedAttribute(): string
    {
        $brands = [
            'toyota' => 'Toyota',
            'peugeot' => 'Peugeot',
            'renault' => 'Renault',
            'mercedes' => 'Mercedes-Benz',
            'volkswagen' => 'Volkswagen',
            'audi' => 'Audi',
            'tesla' => 'Tesla',
            'bmw' => 'BMw',
        ];

        $brandLower = strtolower($this->brand);
        return $brands[$brandLower] ?? ucfirst($this->brand);
    }

    /**
     * Obtenir l'année du modèle
     */
    public function getModelYearAttribute(): string
    {
        return $this->year . ' - ' . ($this->year + 1);
    }

    /**
     * Méthode helper pour obtenir le nom d'affichage d'une catégorie depuis l'ID
     */
    private function getCategoryDisplayNameFromId(): string
    {
        return match ($this->vehicle_category_id) {
            1 => 'Économique',
            2 => 'Business / Confort',
            3 => 'Prestige',
            4 => 'Van / Utilitaire',
            default => 'Non catégorisé',
        };
    }

    /**
     * Méthode helper pour obtenir le code de catégorie depuis l'ID
     */
    private function getCategoryCodeFromId(): ?string
    {
        return match ($this->vehicle_category_id) {
            1 => 'eco',
            2 => 'business',
            3 => 'prestige',
            4 => 'van',
            default => null,
        };
    }

    /**
     * Pour éviter les problèmes, on peut aussi désactiver complètement l'accessor category
     * en utilisant une méthode différente
     */
    public function getLegacyCategoryAttribute(): ?string
    {
        return $this->getCategoryCodeFromId();
    }
}
