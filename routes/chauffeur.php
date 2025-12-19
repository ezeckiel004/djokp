<?php

use App\Http\Controllers\Chauffeur\DashboardController as ChauffeurDashboardController;

Route::middleware(['auth', 'can:access-chauffeur-dashboard'])->prefix('chauffeur')->name('chauffeur.')->group(function () {
    Route::get('/dashboard', [ChauffeurDashboardController::class, 'index'])->name('dashboard');

    // Vous pouvez ajouter d'autres routes chauffeur ici
    // Par exemple :
    // Route::get('/missions', [ChauffeurDashboardController::class, 'missions'])->name('missions');
    // Route::get('/missions/{id}', [ChauffeurDashboardController::class, 'showMission'])->name('missions.show');
});
