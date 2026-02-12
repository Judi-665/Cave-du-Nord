<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\VinController as SiteVinController;
use App\Http\Controllers\Site\MenuController as SiteMenuController;
use App\Http\Controllers\Site\GalerieController as SiteGalerieController;
use App\Http\Controllers\Site\ContactController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VinController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\GalerieController;
use Illuminate\Support\Facades\Auth;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/vins', [SiteVinController::class, 'index'])->name('site.vins');
Route::get('/menus', [SiteMenuController::class, 'index'])->name('site.menus');
Route::get('/galerie', [SiteGalerieController::class, 'index'])->name('site.galerie');
Route::get('/contact', [ContactController::class, 'index'])->name('site.contact');
Route::post('/contact', [ContactController::class, 'send'])->name('site.contact.send');

// Routes de l'administration avec authentification et middleware admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Routes pour les vins
    Route::get('/vins', [VinController::class, 'index'])->name('vins.index');
    Route::post('/vins', [VinController::class, 'store'])->name('vins.store');
    Route::get('/vins/{id}/edit', [VinController::class, 'edit'])->name('vins.edit');
    Route::put('/vins/{id}', [VinController::class, 'update'])->name('vins.update');
    Route::delete('/vins/{id}', [VinController::class, 'destroy'])->name('vins.destroy');

    // Routes pour les menus
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
    Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/menus/{id}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::put('/menus/{id}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/menus/{id}', [MenuController::class, 'destroy'])->name('menus.destroy');

    // Routes pour la galerie
    Route::get('/galeries', [GalerieController::class, 'index'])->name('galeries.index');
    Route::post('/galeries', [GalerieController::class, 'store'])->name('galeries.store');
    Route::get('/galeries/{id}/edit', [GalerieController::class, 'edit'])->name('galeries.edit');
    Route::put('/galeries/{id}', [GalerieController::class, 'update'])->name('galeries.update');
    Route::delete('/galeries/{id}', [GalerieController::class, 'destroy'])->name('galeries.destroy');
});

// Route de déconnexion
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

require __DIR__.'/auth.php';