<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('equipes',\App\Http\Controllers\EquipeController::class);

Route::controller(\App\Http\Controllers\EquipeController::class)->group(function() {
        Route::get("france/equipes", 'equipeFr')->name("equipes.france");
        Route::post("italy/equipes",'creerIt')->name('equipes.store.ita');
        Route::delete("equipes/delete/juv","supprimerJuv")->name("equipes.delete.juv");
        Route::get("esp", 'modifierPaysJuventus')->name("equipes.modifier.esp");
        Route::get("equipes", 'equipesEtJoueurs')->name("equipes.joueurs");
        Route::get("espagne", 'equipesEsp')->name("equipes.espagne");
        Route::get("joueurs-sup", 'JoueursSup')->name("joueurs.sup");
        Route::get("joueurs-mil-15", 'joueursMarqueMilieuArg')->name("joueurs.milieu15");
        Route::get("buts", 'butesParEquipe')->name("equipes.butes");
        Route::get("buts-equipes-pays", 'butesParEquipeEtPays')->name("butes.equipeEtPays");
        Route::get("buts-equipes-def", 'butesParEquipeEtDefenseur')->name("butes.equipeEtDef");
        Route::get("buts-equipes-top3", 'topScorersParEquipe')->name("butes.top3");
        Route::get("buts-top3", 'topSoccer')->name("butes.top3ever");
        Route::get("equipes-age", 'joueursParEquipeParAge')->name("equipes.age");
    });
require __DIR__.'/auth.php';
