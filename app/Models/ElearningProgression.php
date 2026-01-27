<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ElearningProgression extends Model
{
    protected $fillable = [
        'acces_id',
        'cours_id',
        'qcm_id',
        'cours_completed',
        'cours_completed_at',
        'qcm_completed',
        'qcm_score',
        'qcm_attempts',
        'qcm_completed_at',
        'qcm_answers', // Ajouté pour stocker les réponses
        'qcm_details', // Ajouté pour stocker les détails du score
    ];

    protected $casts = [
        'cours_completed' => 'boolean',
        'cours_completed_at' => 'datetime',
        'qcm_completed' => 'boolean',
        'qcm_score' => 'integer',
        'qcm_attempts' => 'integer',
        'qcm_completed_at' => 'datetime',
        'qcm_answers' => 'array', // Cast en array pour stocker les réponses
        'qcm_details' => 'array', // Cast en array pour stocker les détails
    ];

    public function acces(): BelongsTo
    {
        return $this->belongsTo(ElearningAcces::class, 'acces_id');
    }

    public function cours(): BelongsTo
    {
        return $this->belongsTo(ElearningCours::class, 'cours_id');
    }

    public function qcm(): BelongsTo
    {
        return $this->belongsTo(ElearningQcm::class, 'qcm_id');
    }

    public function markCoursCompleted(): void
    {
        $this->update([
            'cours_completed' => true,
            'cours_completed_at' => now(),
        ]);
    }

    public function recordQcmAttempt(int $score, array $answers = null, array $details = null): void
    {
        $this->update([
            'qcm_completed' => true,
            'qcm_score' => $score,
            'qcm_attempts' => $this->qcm_attempts + 1,
            'qcm_completed_at' => now(),
            'qcm_answers' => $answers,
            'qcm_details' => $details,
        ]);
    }

    public function hasPassedQcm(): bool
    {
        if (!$this->qcm || !$this->qcm_completed) {
            return false;
        }

        return $this->qcm_score >= $this->qcm->passing_score;
    }

    public function getStatusAttribute(): string
    {
        if ($this->cours_completed && $this->qcm_completed) {
            return $this->hasPassedQcm() ? 'réussi' : 'échoué';
        }

        if ($this->cours_completed) {
            return 'cours terminé';
        }

        return 'en cours';
    }

    /**
     * Récupère les réponses de l'utilisateur avec les questions
     */
    public function getQcmAnswersWithQuestions(): array
    {
        if (!$this->qcm || !$this->qcm_completed || empty($this->qcm_answers)) {
            return [];
        }

        $questions = $this->qcm->questions ?? [];
        $answers = $this->qcm_answers ?? [];
        $details = $this->qcm_details ?? [];

        $result = [];

        foreach ($questions as $index => $question) {
            $questionId = $question['id'] ?? $index;
            $userAnswer = $answers[$questionId] ?? null;

            $result[] = [
                'question_number' => $index + 1,
                'question' => $question['text'] ?? 'Question ' . ($index + 1),
                'user_answer' => $userAnswer,
                'correct_answer' => $question['correct_answer'] ?? ($question['correct_answers'] ?? null),
                'is_correct' => $details[$index]['correct'] ?? false,
                'points' => $details[$index]['points'] ?? 0,
                'max_points' => $details[$index]['max_points'] ?? 1,
                'explanation' => $question['explanation'] ?? null,
                'options' => $question['options'] ?? [],
            ];
        }

        return $result;
    }

    /**
     * Récupère les statistiques détaillées du QCM
     */
    public function getQcmStats(): array
    {
        $answersWithQuestions = $this->getQcmAnswersWithQuestions();

        $totalQuestions = count($answersWithQuestions);
        $correctAnswers = count(array_filter($answersWithQuestions, fn($item) => $item['is_correct']));
        $incorrectAnswers = $totalQuestions - $correctAnswers;

        return [
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'incorrect_answers' => $incorrectAnswers,
            'score_percentage' => $this->qcm_score,
            'passing_score' => $this->qcm ? $this->qcm->passing_score : 70,
            'passed' => $this->hasPassedQcm(),
            'attempt_number' => $this->qcm_attempts,
            'completed_at' => $this->qcm_completed_at,
            'details' => $answersWithQuestions,
        ];
    }
}
