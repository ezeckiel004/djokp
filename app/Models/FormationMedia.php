<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FormationMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'formation_id',
        'type',
        'title',
        'description',
        'file_path',
        'thumbnail_path',
        'file_name',
        'file_size',
        'duration',
        'order',
        'is_active',
        'download_count',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'file_url',
        'thumbnail_url',
        'file_extension',
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function getFileUrlAttribute()
    {
        if ($this->file_path && Storage::disk('public')->exists($this->file_path)) {
            return Storage::url($this->file_path);
        }
        return null;
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail_path && Storage::disk('public')->exists($this->thumbnail_path)) {
            return Storage::url($this->thumbnail_path);
        }

        // Retourner une miniature par défaut si aucune miniature n'est définie et c'est une vidéo
        if ($this->type === 'video') {
            return asset('images/default-video-thumbnail.jpg');
        }

        return null;
    }

    public function getFileExtensionAttribute()
    {
        return pathinfo($this->file_name, PATHINFO_EXTENSION);
    }

    public function getFormattedFileSizeAttribute()
    {
        if (!$this->file_size) return '0 B';

        $bytes = intval(preg_replace('/[^0-9]/', '', $this->file_size));
        $units = ['B', 'KB', 'MB', 'GB'];
        $unitIndex = 0;

        while ($bytes >= 1024 && $unitIndex < count($units) - 1) {
            $bytes /= 1024;
            $unitIndex++;
        }

        return round($bytes, 2) . ' ' . $units[$unitIndex];
    }

    public function getFormattedDurationAttribute()
    {
        if (!$this->duration) return '00:00';

        // Convertir "1h30" en "01:30:00" ou "30:00" en "00:30:00"
        $duration = $this->duration;

        // Si format "h:mm:ss" ou "mm:ss"
        if (str_contains($duration, ':')) {
            $parts = explode(':', $duration);
            if (count($parts) === 2) {
                return '00:' . $duration;
            }
            return $duration;
        }

        // Si format "1h30"
        if (str_contains($duration, 'h')) {
            $duration = str_replace('h', ':', $duration);
            $duration = str_replace('m', '', $duration);
            $parts = explode(':', $duration);
            if (count($parts) === 2) {
                $hours = str_pad($parts[0], 2, '0', STR_PAD_LEFT);
                $minutes = str_pad($parts[1], 2, '0', STR_PAD_LEFT);
                return $hours . ':' . $minutes . ':00';
            }
        }

        return $duration;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at');
    }

    public function isVideo()
    {
        return $this->type === 'video';
    }

    public function isPdf()
    {
        return $this->type === 'pdf';
    }
}
