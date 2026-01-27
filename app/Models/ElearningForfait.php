<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ElearningForfait extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'duration_days',
        'max_concurrent_connections',
        'includes_qcm',
        'includes_examens_blancs',
        'includes_certification',
        'access_order',
        'is_active',
        'features',
        'stripe_product_id',
        'stripe_price_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'duration_days' => 'integer',
        'max_concurrent_connections' => 'integer',
        'includes_qcm' => 'boolean',
        'includes_examens_blancs' => 'boolean',
        'includes_certification' => 'boolean',
        'is_active' => 'boolean',
        'features' => 'array',
        'access_order' => 'integer',
    ];

    public function acces(): HasMany
    {
        return $this->hasMany(ElearningAcces::class, 'forfait_id');
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 0, ',', ' ') . ' €';
    }

    public function getDurationLabelAttribute(): string
    {
        return $this->duration_days . ' jours d\'accès';
    }

    public function getFeaturesListAttribute(): array
    {
        return $this->features ?? [];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('access_order')->orderBy('price');
    }
}
