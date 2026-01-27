<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ElearningAcces extends Model
{
    protected $fillable = [
        'forfait_id',
        'paiement_id',
        'email',
        'nom',
        'prenom',
        'telephone',
        'access_code',
        'virtual_room_code',
        'current_session_token',
        'current_session_start',
        'current_session_ip',
        'current_session_browser',
        'access_start',
        'access_end',
        'last_access_at',
        'cours_completed',
        'total_cours',
        'average_qcm_score',
        'exam_results',
        'certification_eligible',
        'certification_file_path',
        'certification_sent_at',
        'status',
        'suspension_reason',
    ];

    protected $casts = [
        'access_start' => 'datetime',
        'access_end' => 'datetime',
        'last_access_at' => 'datetime',
        'current_session_start' => 'datetime',
        'certification_sent_at' => 'datetime',
        'exam_results' => 'array',
        'average_qcm_score' => 'decimal:2',
        'cours_completed' => 'integer',
        'total_cours' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($acces) {
            if (empty($acces->access_code)) {
                $acces->access_code = Str::upper(Str::random(10));
            }
            if (empty($acces->virtual_room_code)) {
                $acces->virtual_room_code = 'ROOM-' . Str::upper(Str::random(8));
            }
        });
    }

    public function forfait(): BelongsTo
    {
        return $this->belongsTo(ElearningForfait::class, 'forfait_id');
    }

    public function paiement(): BelongsTo
    {
        return $this->belongsTo(Paiement::class);
    }

    public function progressions(): HasMany
    {
        return $this->hasMany(ElearningProgression::class, 'acces_id');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(ElearningSession::class, 'acces_id');
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && $this->access_end > now();
    }

    public function isExpired(): bool
    {
        return $this->access_end <= now() || $this->status === 'expired';
    }

    public function hasActiveSession(): bool
    {
        return !empty($this->current_session_token) &&
            $this->current_session_start > now()->subHours(2);
    }

    public function getFullNameAttribute(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }

    public function getProgressionPercentageAttribute(): float
    {
        if ($this->total_cours === 0) {
            return 0;
        }
        return ($this->cours_completed / $this->total_cours) * 100;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where('access_end', '>', now());
    }

    public function scopeExpired($query)
    {
        return $query->where(function ($q) {
            $q->where('status', 'expired')
                ->orWhere('access_end', '<=', now());
        });
    }
}
