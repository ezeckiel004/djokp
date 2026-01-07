<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'vehicle_category_id',
        'type',
        'start_date',
        'end_date',
        'pickup_time',
        'pickup_location',
        'dropoff_location',
        'passengers',
        'total_amount',
        'deposit_amount',
        'status',
        'special_requests',
        // Champs pour réservations publiques
        'type_service',
        'depart',
        'arrivee',
        'date',
        'heure',
        'type_vehicule',
        'passagers',
        'nom',
        'telephone',
        'email',
        'instructions',
        'source',
        'reference',
        'is_vtc_booking',
        // Nouveaux champs pour les calculs
        'depart_lat',
        'depart_lng',
        'arrivee_lat',
        'arrivee_lng',
        'calculated_prise_charge',
        'calculated_distance_price',
        'calculated_price_ht',
        'calculated_tva',
        'calculated_price_ttc',
        'calculated_distance_km',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'date' => 'date',
        'pickup_time' => 'datetime',
        'total_amount' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'passengers' => 'integer',
        'is_vtc_booking' => 'boolean',
        // Nouveaux casts
        'depart_lat' => 'decimal:8',
        'depart_lng' => 'decimal:8',
        'arrivee_lat' => 'decimal:8',
        'arrivee_lng' => 'decimal:8',
        'calculated_prise_charge' => 'decimal:2',
        'calculated_distance_price' => 'decimal:2',
        'calculated_price_ht' => 'decimal:2',
        'calculated_tva' => 'decimal:2',
        'calculated_price_ttc' => 'decimal:2',
        'calculated_distance_km' => 'decimal:2',
    ];

    /**
     * Boot method to generate reference
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($reservation) {
            if (empty($reservation->reference)) {
                $reservation->reference = 'RES' . strtoupper(Str::random(8));
            }
            if (empty($reservation->source)) {
                $reservation->source = auth()->check() ? 'client' : 'public';
            }
            if (empty($reservation->type)) {
                $reservation->type = 'vtc_transport';
            }
            if (empty($reservation->is_vtc_booking)) {
                $reservation->is_vtc_booking = true;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function vehicleCategory()
    {
        return $this->belongsTo(VehicleCategory::class);
    }

    /**
     * Scope pour les réservations publiques
     */
    public function scopePublic($query)
    {
        return $query->where('source', 'public');
    }

    /**
     * Scope pour les réservations VTC
     */
    public function scopeVtc($query)
    {
        return $query->where('is_vtc_booking', true)
            ->orWhere('type', 'vtc_transport');
    }

    /**
     * Scope pour les réservations avec compte
     */
    public function scopeWithAccount($query)
    {
        return $query->whereNotNull('user_id');
    }

    /**
     * Scope pour les réservations sans compte
     */
    public function scopeWithoutAccount($query)
    {
        return $query->whereNull('user_id');
    }

    /**
     * Scope pour les réservations avec catégorie de véhicule
     */
    public function scopeWithVehicleCategory($query)
    {
        return $query->whereNotNull('vehicle_category_id');
    }

    /**
     * Get the status label
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'En attente',
            'confirmed' => 'Confirmé',
            'in_progress' => 'En cours',
            'completed' => 'Terminé',
            'cancelled' => 'Annulé'
        ];

        return $labels[$this->status] ?? $this->status;
    }

    /**
     * Get the service type label
     */
    public function getServiceTypeLabelAttribute()
    {
        $types = [
            'transfert' => 'Transfert aéroport/gare',
            'professionnel' => 'Déplacement professionnel',
            'evenement' => 'Événement/mariage',
            'mise_disposition' => 'Mise à disposition'
        ];

        return $types[$this->type_service] ?? $this->type_service;
    }

    /**
     * Get the vehicle type label
     */
    public function getVehicleTypeLabelAttribute()
    {
        $types = [
            'eco' => 'Véhicule Éco',
            'business' => 'Véhicule Business',
            'prestige' => 'Véhicule Prestige'
        ];

        return $types[$this->type_vehicule] ?? $this->type_vehicule;
    }

    /**
     * Check if reservation is from public
     */
    public function getIsPublicAttribute()
    {
        return $this->source === 'public';
    }

    /**
     * Check if reservation is from client with account
     */
    public function getIsFromClientAttribute()
    {
        return $this->source === 'client';
    }

    /**
     * Get formatted total amount
     */
    public function getFormattedTotalAmountAttribute()
    {
        return number_format($this->total_amount, 2, ',', ' ') . ' €';
    }

    /**
     * Get formatted calculated price HT
     */
    public function getFormattedPriceHtAttribute()
    {
        return $this->calculated_price_ht
            ? number_format($this->calculated_price_ht, 2, ',', ' ') . ' €'
            : null;
    }

    /**
     * Get formatted calculated price TTC
     */
    public function getFormattedPriceTtcAttribute()
    {
        return $this->calculated_price_ttc
            ? number_format($this->calculated_price_ttc, 2, ',', ' ') . ' €'
            : null;
    }

    /**
     * Get formatted distance
     */
    public function getFormattedDistanceAttribute()
    {
        return $this->calculated_distance_km
            ? number_format($this->calculated_distance_km, 1, ',', ' ') . ' km'
            : null;
    }

    /**
     * Get price calculation details
     */
    public function getPriceDetailsAttribute()
    {
        if (!$this->calculated_price_ht) {
            return null;
        }

        return [
            'prise_charge' => $this->calculated_prise_charge
                ? number_format($this->calculated_prise_charge, 2, ',', ' ') . ' €'
                : '0,00 €',
            'distance_price' => $this->calculated_distance_price
                ? number_format($this->calculated_distance_price, 2, ',', ' ') . ' €'
                : '0,00 €',
            'price_ht' => $this->formatted_price_ht,
            'tva' => $this->calculated_tva
                ? number_format($this->calculated_tva, 2, ',', ' ') . ' €'
                : '0,00 €',
            'price_ttc' => $this->formatted_price_ttc,
            'distance_km' => $this->formatted_distance,
        ];
    }

    /**
     * Get full address for departure
     */
    public function getFullDepartAddressAttribute()
    {
        $address = $this->depart;
        if ($this->depart_lat && $this->depart_lng) {
            $address .= " (GPS: {$this->depart_lat}, {$this->depart_lng})";
        }
        return $address;
    }

    /**
     * Get full address for arrival
     */
    public function getFullArriveeAddressAttribute()
    {
        $address = $this->arrivee;
        if ($this->arrivee_lat && $this->arrivee_lng) {
            $address .= " (GPS: {$this->arrivee_lat}, {$this->arrivee_lng})";
        }
        return $address;
    }
}
