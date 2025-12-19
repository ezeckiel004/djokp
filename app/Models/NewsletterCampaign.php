<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewsletterCampaign extends Model
{
    protected $fillable = [
        'subject',
        'content',
        'template',
        'status',
        'scheduled_at',
        'sent_at',
        'total_recipients',
        'opened_count',
        'clicked_count',
        'stats'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'sent_at' => 'datetime',
        'stats' => 'array'
    ];

    public function logs(): HasMany
    {
        // Spécifiez explicitement la clé étrangère
        return $this->hasMany(NewsletterLog::class, 'campaign_id');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    public function scopeSent($query)
    {
        return $query->where('status', 'sent');
    }

    public function openRate(): float
    {
        if ($this->total_recipients === 0) {
            return 0;
        }
        return ($this->opened_count / $this->total_recipients) * 100;
    }

    public function clickRate(): float
    {
        if ($this->total_recipients === 0) {
            return 0;
        }
        return ($this->clicked_count / $this->total_recipients) * 100;
    }
}
