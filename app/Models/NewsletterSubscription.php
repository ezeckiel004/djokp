<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewsletterSubscription extends Model
{
    protected $fillable = [
        'email',
        'name',
        'is_active',
        'status',
        'source',
        'token',
        'confirmed_at',
        'unsubscribed_at'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'confirmed_at' => 'datetime',
        'unsubscribed_at' => 'datetime'
    ];

    public function logs(): HasMany
    {
        // Spécifiez explicitement la clé étrangère
        return $this->hasMany(NewsletterLog::class, 'subscription_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where('status', 'confirmed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function confirm(): void
    {
        $this->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
            'token' => null
        ]);
    }

    public function unsubscribe(): void
    {
        $this->update([
            'is_active' => false,
            'status' => 'unsubscribed',
            'unsubscribed_at' => now()
        ]);
    }

    public function resubscribe(): void
    {
        $this->update([
            'is_active' => true,
            'status' => 'confirmed',
            'unsubscribed_at' => null
        ]);
    }
}
