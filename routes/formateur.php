<?php

use App\Http\Controllers\Formateur\DashboardController as FormateurDashboardController;

Route::middleware(['auth', 'can:access-formateur-dashboard'])->prefix('formateur')->name('formateur.')->group(function () {
    Route::get('/dashboard', [FormateurDashboardController::class, 'index'])->name('dashboard');

    // Vous pouvez ajouter d'autres routes formateur ici
    // Par exemple :
    // Route::get('/formations', [FormateurDashboardController::class, 'formations'])->name('formations');
    // Route::get('/formations/{id}', [FormateurDashboardController::class, 'showFormation'])->name('formations.show');
});
