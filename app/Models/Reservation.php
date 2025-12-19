<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'vehicle_id',
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
        'is_vtc_booking'
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
}
