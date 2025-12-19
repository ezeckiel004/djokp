<?php

use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\FormationController;
use App\Http\Controllers\Client\LocationReservationController;
use App\Http\Controllers\Client\ReservationController;
use App\Http\Controllers\Client\ConciergerieController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\InvoiceController;
use App\Http\Controllers\ContactController;

Route::middleware(['auth', 'can:access-client-dashboard'])->prefix('client')->name('client.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ==============================================
    // FORMATIONS - SYSTÈME COMPLET
    // ==============================================
    Route::prefix('formations')->name('formations.')->group(function () {
        // Mes formations
        Route::get('/', [FormationController::class, 'index'])->name('index');

        // Catalogue des formations disponibles
        Route::get('/catalogue', [FormationController::class, 'catalogue'])->name('catalogue');
        Route::get('/catalogue/{formation}', [FormationController::class, 'showCatalogueDetails'])->name('catalogue.details');

        // Inscription aux formations
        Route::get('/inscrire/{formation}', [FormationController::class, 'inscrire'])->name('inscrire');
        Route::post('/inscrire/{formation}/store', [FormationController::class, 'storeInscription'])->name('inscrire.store');

        // Paiement e-learning
        Route::post('/{formation}/create-payment', [FormationController::class, 'createPayment'])->name('create-payment');
        Route::get('/paiement/success', [FormationController::class, 'paymentSuccess'])->name('payment.success');
        Route::get('/paiement/cancel', [FormationController::class, 'paymentCancel'])->name('payment.cancel');

        // Gestion des formations achetées
        Route::get('/{id}', [FormationController::class, 'show'])->name('show');
        Route::get('/{id}/acceder', [FormationController::class, 'acceder'])->name('acceder');
        Route::get('/{id}/compte-rendu', [FormationController::class, 'compteRendu'])->name('compte-rendu');

        // Téléchargement des documents
        Route::get('/{userFormation}/download/{media}', [FormationController::class, 'downloadMedia'])->name('download.media');
    });

    // Location Reservations
    Route::get('/location-reservations', [LocationReservationController::class, 'index'])->name('location-reservations.index');
    Route::get('/location-reservations/create', [LocationReservationController::class, 'create'])->name('location-reservations.create');
    Route::post('/location-reservations', [LocationReservationController::class, 'store'])->name('location-reservations.store');
    Route::get('/location-reservations/{reservation}', [LocationReservationController::class, 'show'])->name('location-reservations.show');
    Route::get('/location-reservations/{reservation}/edit', [LocationReservationController::class, 'edit'])->name('location-reservations.edit');
    Route::put('/location-reservations/{reservation}', [LocationReservationController::class, 'update'])->name('location-reservations.update');
    Route::delete('/location-reservations/{reservation}', [LocationReservationController::class, 'destroy'])->name('location-reservations.destroy');

    // Reservations VTC
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    // ==============================================
    // CONCIERGERIE - ROUTES CORRIGÉES
    // ==============================================
    Route::prefix('conciergerie-demandes')->name('conciergerie-demandes.')->group(function () {
        // CRUD de base - Utiliser {id} partout pour la cohérence
        Route::get('/', [ConciergerieController::class, 'index'])->name('index');
        Route::get('/create', [ConciergerieController::class, 'create'])->name('create');
        Route::post('/', [ConciergerieController::class, 'store'])->name('store');
        Route::get('/{id}', [ConciergerieController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [ConciergerieController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ConciergerieController::class, 'update'])->name('update');
        Route::delete('/{id}', [ConciergerieController::class, 'destroy'])->name('destroy');

        // Filtrage et recherche
        Route::post('/filtrer', [ConciergerieController::class, 'filtrer'])->name('filtrer');

        // Statistiques
        Route::get('/statistiques', [ConciergerieController::class, 'statistiques'])->name('statistiques');

        // Actions sur les devis
        Route::post('/{id}/demander-nouveau-devis', [ConciergerieController::class, 'demanderNouveauDevis'])
            ->name('demander-nouveau-devis');
        Route::post('/{id}/confirmer-devis', [ConciergerieController::class, 'confirmerDevis'])
            ->name('confirmer-devis');

        // Export PDF
        Route::get('/{id}/export-pdf', [ConciergerieController::class, 'exportPdf'])
            ->name('export-pdf');
    });

    // Invoices
    Route::get('/factures', [InvoiceController::class, 'index'])->name('factures.index');
    Route::get('/factures/{paiement}', [InvoiceController::class, 'show'])->name('factures.show');
    Route::get('/factures/{paiement}/download', [InvoiceController::class, 'download'])->name('factures.download');

    // Profile
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Settings
    Route::get('/parametres', [ProfileController::class, 'settings'])->name('settings');
    Route::put('/parametres', [ProfileController::class, 'updateSettings'])->name('settings.update');

    // Support - CORRIGÉ
    Route::get('/support', function () {
        return view('client.dashboard.support');
    })->name('support');

    // Ajoutez cette ligne pour la route POST
    Route::post('/support', [ContactController::class, 'storeSupport'])->name('support.store');
});
