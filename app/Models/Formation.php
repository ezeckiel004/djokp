<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'duree',
        'format_affichage',
        'frais_examen',
        'location_vehicule',
        'type_formation',
        'format_type',
        'duration_hours',
        'categorie',
        'is_certified',
        'is_financeable_cpf',
        'is_active',
        'stripe_product_id',
        'stripe_price_id',
        'program',
        'requirements',
        'included_services',
        'programme_pdf',
        'programme_pdf_generated_at',
    ];

    protected $casts = [
        'is_certified' => 'boolean',
        'is_financeable_cpf' => 'boolean',
        'is_active' => 'boolean',
        'program' => 'array',
        'requirements' => 'array',
        'included_services' => 'array',
        'price' => 'decimal:2',
        'programme_pdf_generated_at' => 'datetime',
    ];

    protected $appends = [
        'price_formatted',
        'frais_examen_color',
        'location_vehicule_color',
        'programme_pdf_url',
        'programme_pdf_exists',
        'programme_pdf_route',
    ];

    /**
     * Relations
     */
    public function media()
    {
        return $this->hasMany(FormationMedia::class)->orderBy('order');
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'service_id')
            ->where('service_type', 'formation');
    }

    public function userFormations()
    {
        return $this->hasMany(UserFormation::class);
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeElearning($query)
    {
        return $query->where('type_formation', 'e_learning');
    }

    public function scopePresentiel($query)
    {
        return $query->where('type_formation', 'presentiel');
    }

    public function scopeCertified($query)
    {
        return $query->where('is_certified', true);
    }

    public function scopeFinanceableCpf($query)
    {
        return $query->where('is_financeable_cpf', true);
    }

    /**
     * Accessors
     */
    public function getPriceFormattedAttribute()
    {
        return number_format($this->price, 0, ',', ' ') . ' €';
    }

    public function getFraisExamenColorAttribute()
    {
        return $this->frais_examen === 'Inclus' ? 'text-green-600' : 'text-gray-500';
    }

    public function getLocationVehiculeColorAttribute()
    {
        return $this->location_vehicule === 'Inclus' ? 'text-green-600' : 'text-gray-500';
    }

    public function getDurationDaysAttribute()
    {
        if ($this->duration_hours >= 24) {
            return ceil($this->duration_hours / 8) . ' jours';
        }
        return $this->duration_hours . ' heures';
    }

    public function getFormattedTypeAttribute()
    {
        $types = [
            'vtc_theorique' => 'VTC Théorique',
            'vtc_pratique' => 'VTC Pratique',
            'e_learning' => 'E-learning',
            'renouvellement' => 'Renouvellement',
        ];

        return $types[$this->categorie] ?? $this->categorie;
    }

    public function getFormattedFormatTypeAttribute()
    {
        $formats = [
            'presentiel' => 'Présentiel',
            'en_ligne' => 'En ligne',
            'mixte' => 'Mixte',
        ];

        return $formats[$this->format_type] ?? $this->format_type;
    }

    public function getStripeConfiguredAttribute()
    {
        return !empty($this->stripe_product_id) && !empty($this->stripe_price_id);
    }

    /**
     * URL du PDF programme
     */
    public function getProgrammePdfUrlAttribute()
    {
        if ($this->programme_pdf && Storage::disk('public')->exists($this->programme_pdf)) {
            return Storage::url($this->programme_pdf);
        }
        return null;
    }

    /**
     * Vérifie si un PDF programme existe
     */
    public function getProgrammePdfExistsAttribute()
    {
        return $this->programme_pdf && Storage::disk('public')->exists($this->programme_pdf);
    }

    /**
     * Route pour accéder au PDF (génère automatiquement si besoin)
     */
    public function getProgrammePdfRouteAttribute()
    {
        return route('formation.programme.pdf.show', $this->id);
    }

    /**
     * Vérifie si le PDF doit être régénéré
     */
    public function shouldRegeneratePdf()
    {
        if (!$this->programme_pdf_generated_at) {
            return true;
        }

        // Regénérer si plus vieux que 7 jours
        return $this->programme_pdf_generated_at->diffInDays(now()) > 7;
    }

    /**
     * Récupère les PDFs programmes des médias
     */
    public function getProgrammePdfMediaAttribute()
    {
        return $this->media()
            ->where('type', 'pdf')
            ->where('is_programme', true)
            ->first();
    }

    /**
     * Méthodes pratiques
     */
    public function isElearning()
    {
        return $this->type_formation === 'e_learning';
    }

    public function isPresentiel()
    {
        return $this->type_formation === 'presentiel';
    }

    public function hasActiveUsers()
    {
        return $this->userFormations()->where('status', 'active')->exists();
    }

    public function getActiveUsersCount()
    {
        return $this->userFormations()->where('status', 'active')->count();
    }

    public function getPaidPaiementsCount()
    {
        return $this->paiements()->where('status', 'paid')->count();
    }

    public function getRevenueAttribute()
    {
        return $this->paiements()->where('status', 'paid')->sum('amount');
    }

    /**
     * Mutators
     */
    public function setSlugAttribute($value)
    {
        if (empty($value) && !empty($this->title)) {
            // Générer un slug basé sur le titre et le type de formation
            $value = $this->generateSlugFromTitle();
        }
        $this->attributes['slug'] = $value;
    }

    public function setProgramAttribute($value)
    {
        if (is_string($value)) {
            $value = array_filter(array_map('trim', explode("\n", $value)));
        }
        $this->attributes['program'] = !empty($value) ? json_encode($value) : null;
    }

    public function setRequirementsAttribute($value)
    {
        if (is_string($value)) {
            $value = array_filter(array_map('trim', explode("\n", $value)));
        }
        $this->attributes['requirements'] = !empty($value) ? json_encode($value) : null;
    }

    public function setIncludedServicesAttribute($value)
    {
        if (is_string($value)) {
            $value = array_filter(array_map('trim', explode("\n", $value)));
        }
        $this->attributes['included_services'] = !empty($value) ? json_encode($value) : null;
    }

    /**
     * Événements du modèle
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($formation) {
            if (empty($formation->slug) && !empty($formation->title)) {
                $formation->slug = $formation->generateUniqueSlug();
            }
        });

        static::updating(function ($formation) {
            // Regénérer le slug si le titre ou le type de formation change
            if ($formation->isDirty('title') || $formation->isDirty('type_formation')) {
                $formation->slug = $formation->generateUniqueSlug();
            }

            // Si on change le prix et qu'il y a un produit Stripe, il faudra le mettre à jour
            if ($formation->isElearning() && $formation->isDirty('price') && $formation->stripe_price_id) {
                \Log::info("Le prix de la formation {$formation->id} a changé. Mettre à jour Stripe manuellement.");
            }

            // Si le programme, les prérequis ou les services inclus changent, marquer pour régénération PDF
            if ($formation->isDirty(['program', 'requirements', 'included_services', 'description', 'title'])) {
                \Log::info("Formation {$formation->id} modifiée - PDF programme doit être régénéré");
            }
        });
    }

    /**
     * Génère un slug à partir du titre
     */
    public function generateSlugFromTitle()
    {
        $slug = Str::slug($this->title);

        // Ajouter le type de formation au slug
        if ($this->type_formation === 'presentiel') {
            $slug .= '-presentiel';
        } elseif ($this->type_formation === 'e_learning') {
            $slug .= '-en-ligne';
        }

        return $slug;
    }

    /**
     * Génère un slug unique pour la formation
     */
    public function generateUniqueSlug()
    {
        $baseSlug = $this->generateSlugFromTitle();
        $slug = $baseSlug;
        $counter = 1;

        // Vérifier si le slug existe déjà (sauf pour l'enregistrement actuel)
        while (self::where('slug', $slug)
            ->when($this->exists, function ($query) {
                return $query->where('id', '!=', $this->id);
            })
            ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Récupère le slug formaté avec le type
     */
    public function getFormattedSlugAttribute()
    {
        if (empty($this->slug)) {
            return $this->generateSlugFromTitle();
        }
        return $this->slug;
    }

    /**
     * Supprime le PDF programme
     */
    public function deleteProgrammePdf()
    {
        if ($this->programme_pdf && Storage::disk('public')->exists($this->programme_pdf)) {
            Storage::disk('public')->delete($this->programme_pdf);
        }

        $this->update([
            'programme_pdf' => null,
            'programme_pdf_generated_at' => null,
        ]);
    }

    /**
     * Met à jour la date de génération du PDF
     */
    public function markPdfGenerated()
    {
        $this->update([
            'programme_pdf_generated_at' => now(),
        ]);
    }
}
