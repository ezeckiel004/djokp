<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VehicleCategory extends Model
{
    protected $fillable = [
        'categorie',
        'display_name',
        'prise_en_charge',
        'prix_au_km',
        'prix_minimum',
        'actif'
    ];

    protected $casts = [
        'prise_en_charge' => 'decimal:2',
        'prix_au_km' => 'decimal:2',
        'prix_minimum' => 'decimal:2',
        'actif' => 'boolean',
    ];

    /**
     * Relation avec les véhicules
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    /**
     * Scope pour les catégories actives
     */
    public function scopeActive($query)
    {
        return $query->where('actif', true);
    }

    /**
     * Getter pour le prix de prise en charge formaté
     */
    public function getPriseEnChargeFormattedAttribute(): string
    {
        return number_format($this->prise_en_charge, 2, ',', ' ') . ' €';
    }

    /**
     * Getter pour le prix au km formaté
     */
    public function getPrixAuKmFormattedAttribute(): string
    {
        return number_format($this->prix_au_km, 2, ',', ' ') . ' €/km';
    }

    /**
     * Getter pour le prix minimum formaté
     */
    public function getPrixMinimumFormattedAttribute(): string
    {
        return number_format($this->prix_minimum, 2, ',', ' ') . ' €';
    }

    /**
     * Calculer le prix pour une distance donnée
     */
    public function calculatePriceForDistance(float $distance_km): float
    {
        $prix = ($distance_km * $this->prix_au_km) + $this->prise_en_charge;
        return max($prix, $this->prix_minimum);
    }

    /**
     * Calculer le prix formaté pour une distance
     */
    public function calculatePriceForDistanceFormatted(float $distance_km): string
    {
        $prix = $this->calculatePriceForDistance($distance_km);
        return number_format($prix, 2, ',', ' ') . ' €';
    }
}
