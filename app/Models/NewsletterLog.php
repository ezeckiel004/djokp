<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsletterLog extends Model
{
    protected $fillable = [
        'campaign_id',
        'subscription_id',
        'email',
        'action',
        'data',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public function campaign(): BelongsTo
    {
        // Spécifiez explicitement la clé étrangère
        return $this->belongsTo(NewsletterCampaign::class, 'campaign_id');
    }

    public function subscription(): BelongsTo
    {
        // Spécifiez explicitement la clé étrangère
        return $this->belongsTo(NewsletterSubscription::class, 'subscription_id');
    }
}
