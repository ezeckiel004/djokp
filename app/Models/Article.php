<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'image',
        'icon',
        'color',
        'reading_time',
        'featured',
        'published',
        'published_at',
        'user_id'
    ];

    protected $casts = [
        'published' => 'boolean',
        'featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('published', true)
            ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Accessors
    public function getCategoryLabelAttribute()
    {
        return [
            'location' => 'Location',
            'vtc-transport' => 'VTC Transport',
            'conciergerie' => 'Conciergerie',
            'formation' => 'Formation',
        ][$this->category] ?? $this->category;
    }

    public function getColorClassAttribute()
    {
        return [
            'location' => 'yellow',
            'vtc-transport' => 'blue',
            'conciergerie' => 'green',
            'formation' => 'purple',
        ][$this->category] ?? 'gray';
    }

    // Mutators
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
