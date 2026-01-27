<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ElearningQcm extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cours_id',
        'title',
        'description',
        'questions_count',
        'passing_score',
        'time_limit_minutes',
        'attempts_allowed',
        'is_examen_blanc',
        'allow_multiple_correct', // Ajouté
        'is_active',
        'questions_data',
    ];

    protected $casts = [
        'questions_count' => 'integer',
        'passing_score' => 'integer',
        'time_limit_minutes' => 'integer',
        'attempts_allowed' => 'integer',
        'is_examen_blanc' => 'boolean',
        'allow_multiple_correct' => 'boolean', // Ajouté
        'is_active' => 'boolean',
        'questions_data' => 'array',
    ];

    public function cours(): BelongsTo
    {
        return $this->belongsTo(ElearningCours::class, 'cours_id');
    }

    public function progressions(): HasMany
    {
        return $this->hasMany(ElearningProgression::class, 'qcm_id');
    }

    public function getQuestionsAttribute(): array
    {
        return $this->questions_data['questions'] ?? [];
    }

    public function getCorrectAnswersAttribute(): array
    {
        $answers = [];
        foreach ($this->questions as $question) {
            // Gérer les deux formats : multiple ou unique
            if ($this->allow_multiple_correct && isset($question['correct_answers'])) {
                $answers[$question['id']] = (array) $question['correct_answers'];
            } else {
                $answers[$question['id']] = isset($question['correct_answer'])
                    ? [$question['correct_answer']]
                    : [];
            }
        }
        return $answers;
    }

    public function isExamenBlanc(): bool
    {
        return $this->is_examen_blanc;
    }

    public function allowsMultipleCorrect(): bool
    {
        return $this->allow_multiple_correct;
    }

    public function getTimeLimitFormattedAttribute(): ?string
    {
        if (!$this->time_limit_minutes) {
            return null;
        }

        if ($this->time_limit_minutes < 60) {
            return $this->time_limit_minutes . ' minutes';
        }

        $hours = floor($this->time_limit_minutes / 60);
        $minutes = $this->time_limit_minutes % 60;

        if ($minutes === 0) {
            return $hours . ' heure' . ($hours > 1 ? 's' : '');
        }

        return $hours . 'h' . $minutes;
    }

    public function scopeExamenBlanc($query)
    {
        return $query->where('is_examen_blanc', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
