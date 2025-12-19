<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price_from',
        'price_unit',
        'period',
        'is_active',
        'sort_order',
        'icon',
        'color',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price_from' => 'decimal:2',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
        });

        static::updating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function getPriceFormattedAttribute()
    {
        if (!$this->price_from) {
            return 'Sur devis';
        }

        return number_format($this->price_from, 2, ',', ' ') . ' €' . ($this->price_unit ? '/' . $this->price_unit : '');
    }

    public function getPeriodFormattedAttribute()
    {
        if (!$this->period) {
            return '';
        }

        $periods = [
            'jour' => 'Par jour',
            'journee' => 'Par journée',
            'nuit' => 'Par nuit',
            'visite' => 'Par visite',
            'mois' => 'Par mois',
            'trajet' => 'Par trajet',
            'heure' => 'Par heure',
            'forfait' => 'Forfait unique',
        ];

        return $periods[$this->period] ?? $this->period;
    }

    public function getStatusBadgeAttribute()
    {
        return $this->is_active
            ? '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Actif</span>'
            : '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactif</span>';
    }

    public function getIconHtmlAttribute()
    {
        if (!$this->icon) {
            return '<i class="fas fa-cog text-gray-400"></i>';
        }

        return '<i class="' . $this->icon . '"></i>';
    }
}
