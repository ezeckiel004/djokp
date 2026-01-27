<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ElearningSession extends Model
{
    protected $fillable = [
        'acces_id',
        'session_token',
        'ip_address',
        'user_agent',
        'login_at',
        'last_activity_at',
        'logout_at',
        'activity_log',
        'forced_logout',
    ];

    protected $casts = [
        'login_at' => 'datetime',
        'last_activity_at' => 'datetime',
        'logout_at' => 'datetime',
        'activity_log' => 'array',
        'forced_logout' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($session) {
            if (empty($session->session_token)) {
                $session->session_token = Str::random(60);
            }
        });
    }

    public function acces(): BelongsTo
    {
        return $this->belongsTo(ElearningAcces::class, 'acces_id');
    }

    public function isActive(): bool
    {
        return empty($this->logout_at) &&
            $this->last_activity_at > now()->subHours(2);
    }

    public function logActivity(string $action, array $data = []): void
    {
        $log = $this->activity_log ?? [];
        $log[] = [
            'timestamp' => now()->toDateTimeString(),
            'action' => $action,
            'data' => $data,
            'ip' => request()->ip(),
        ];

        $this->update([
            'last_activity_at' => now(),
            'activity_log' => $log,
        ]);
    }

    public function logout(): void
    {
        $this->update([
            'logout_at' => now(),
            'last_activity_at' => now(),
        ]);
    }

    public function forceLogout(): void
    {
        $this->update([
            'logout_at' => now(),
            'forced_logout' => true,
            'last_activity_at' => now(),
        ]);
    }

    public function getDurationAttribute(): string
    {
        if ($this->logout_at) {
            $duration = $this->logout_at->diffInMinutes($this->login_at);
        } else {
            $duration = now()->diffInMinutes($this->login_at);
        }

        if ($duration < 60) {
            return $duration . ' min';
        }

        $hours = floor($duration / 60);
        $minutes = $duration % 60;

        if ($minutes === 0) {
            return $hours . 'h';
        }

        return $hours . 'h' . $minutes . 'min';
    }
}
