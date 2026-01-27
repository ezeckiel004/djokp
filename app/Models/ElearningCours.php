<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class ElearningCours extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'video_path',      // Changé de video_url
        'pdf_path',        // Changé de pdf_url
        'video_name',      // Nouveau
        'pdf_name',        // Nouveau
        'duration_minutes',
        'order',
        'is_active',
        'attachments',
    ];

    protected $casts = [
        'duration_minutes' => 'integer',
        'order' => 'integer',
        'is_active' => 'boolean',
        'attachments' => 'array',
    ];

    protected $appends = [
        'video_url',
        'pdf_url',
        'duration_formatted',
        'content_type',
        'video_display_name',
        'pdf_display_name',
    ];

    public function qcms(): HasMany
    {
        return $this->hasMany(ElearningQcm::class, 'cours_id');
    }

    public function progressions(): HasMany
    {
        return $this->hasMany(ElearningProgression::class, 'cours_id');
    }

    public function getDurationFormattedAttribute(): string
    {
        if (!$this->duration_minutes) {
            return 'Non spécifié';
        }

        if ($this->duration_minutes < 60) {
            return $this->duration_minutes . ' min';
        }

        $hours = floor($this->duration_minutes / 60);
        $minutes = $this->duration_minutes % 60;

        if ($minutes === 0) {
            return $hours . 'h';
        }

        return $hours . 'h' . $minutes . 'min';
    }

    public function getVideoUrlAttribute(): ?string
    {
        if (!$this->video_path) {
            return null;
        }

        // Si c'est déjà une URL complète (YouTube, Vimeo, etc.)
        if (filter_var($this->video_path, FILTER_VALIDATE_URL)) {
            return $this->video_path;
        }

        // Sinon c'est un fichier uploadé
        return Storage::url($this->video_path);
    }

    public function getPdfUrlAttribute(): ?string
    {
        if (!$this->pdf_path) {
            return null;
        }

        // Si c'est déjà une URL
        if (filter_var($this->pdf_path, FILTER_VALIDATE_URL)) {
            return $this->pdf_path;
        }

        // Sinon c'est un fichier uploadé
        return Storage::url($this->pdf_path);
    }

    public function hasVideo(): bool
    {
        return !empty($this->video_path);
    }

    public function hasPdf(): bool
    {
        return !empty($this->pdf_path);
    }

    public function getVideoDisplayNameAttribute(): ?string
    {
        return $this->video_name ?: ($this->video_path ? basename($this->video_path) : null);
    }

    public function getPdfDisplayNameAttribute(): ?string
    {
        return $this->pdf_name ?: ($this->pdf_path ? basename($this->pdf_path) : null);
    }

    public function getContentTypeAttribute(): string
    {
        if ($this->hasVideo()) {
            return 'video';
        } elseif ($this->hasPdf()) {
            return 'pdf';
        } else {
            return 'html';
        }
    }

    public function getQcmAttribute()
    {
        return $this->qcms()->first();
    }

    public function hasQcm(): bool
    {
        return $this->qcms()->exists();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('title');
    }

    public function getPreviousCours()
    {
        return self::active()
            ->where('order', '<', $this->order)
            ->orWhere(function ($query) {
                $query->where('order', '=', $this->order)
                    ->where('id', '<', $this->id);
            })
            ->ordered()
            ->latest('id')
            ->first();
    }

    public function getNextCours()
    {
        return self::active()
            ->where('order', '>', $this->order)
            ->orWhere(function ($query) {
                $query->where('order', '=', $this->order)
                    ->where('id', '>', $this->id);
            })
            ->ordered()
            ->oldest('id')
            ->first();
    }
}
