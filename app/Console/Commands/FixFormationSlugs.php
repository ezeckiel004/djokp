<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Formation;

class FixFormationSlugs extends Command
{
    protected $signature = 'formations:fix-slugs';
    protected $description = 'Corrige les slugs des formations en ajoutant le type de formation';

    public function handle()
    {
        $formations = Formation::all();
        $updated = 0;

        foreach ($formations as $formation) {
            $oldSlug = $formation->slug;
            $newSlug = $formation->generateUniqueSlug();

            if ($oldSlug !== $newSlug) {
                $formation->slug = $newSlug;
                $formation->saveQuietly(); // saveQuietly pour éviter les événements
                $this->info("Formation {$formation->id} : {$oldSlug} → {$newSlug}");
                $updated++;
            }
        }

        $this->info("Terminé ! {$updated} formations mises à jour.");

        // Optionnel : vérifier les doublons
        $this->checkDuplicates();
    }

    protected function checkDuplicates()
    {
        $duplicates = Formation::select('slug')
            ->groupBy('slug')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        if ($duplicates->isEmpty()) {
            $this->info("✓ Aucun doublon de slug détecté.");
        } else {
            $this->warn("Attention ! Doublons de slug détectés :");
            foreach ($duplicates as $dup) {
                $formations = Formation::where('slug', $dup->slug)->get();
                $this->warn("  Slug '{$dup->slug}' utilisé par les formations : " .
                    $formations->pluck('id')->implode(', '));
            }
        }
    }
}
