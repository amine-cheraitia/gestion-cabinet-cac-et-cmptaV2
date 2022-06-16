<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KpiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\MandatController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConventionController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\CommentaireController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('/')->middleware("auth");
Route::post('/fetchCA', [DashboardController::class, 'fetchCA'])->name('fetchCA');

//clients
Route::get('/clients', [EntrepriseController::class, 'index'])->name('client.list');
Route::get('/clients/create', [EntrepriseController::class, 'create'])->name('client.index');
Route::post('/clients/store', [EntrepriseController::class, 'store'])->name('client.store');
Route::get('/clients/{id}', [EntrepriseController::class, 'edit'])->name('client.edit');
Route::patch('/clients/{id}', [EntrepriseController::class, 'update'])->name('client.update');
Route::get('/clients/{id}/delete', [EntrepriseController::class, 'destroy'])->name('client.destroy');
/* Route::resource('/clients', EntrepriseController::class); */
//devis
Route::get('/devis', [DevisController::class, 'index'])->name('devis.list');
Route::get('/devis/ex/{id}', [DevisController::class, 'showExercice'])->name('devis.showExercice');
Route::get('/devis/create', [DevisController::class, 'create'])->name('devis.create');
Route::post('/devis/store', [DevisController::class, 'store'])->name('devis.store');
Route::get('/devis/{id}', [DevisController::class, 'edit'])->name('devis.edit');
Route::patch('/devis/{id}', [DevisController::class, 'update'])->name('devis.update');
Route::get('/devis/{id}/delete', [DevisController::class, 'destroy'])->name('devis.destroy');
//---pdf
Route::get('/devis/pdf/{id}', [DevisController::class, 'pdf'])->name('devis.pdf');
//---ajax devis
Route::post('/devis/fetch', [DevisController::class, 'calculPrix'])->name('devis.calculPrix');

//mission
Route::get('/missions', [MissionController::class, 'index'])->name('mission.list');
Route::get('/missions/{id}/show', [MissionController::class, 'show'])->name('mission.show');
Route::get('/missions/create', [MissionController::class, 'create'])->name('mission.create');
Route::post('/missions/store', [MissionController::class, 'store'])->name('mission.store');
Route::get('/missions/edit/{id}', [MissionController::class, 'edit'])->name('mission.edit');
Route::patch('/missions/{id}', [MissionController::class, 'update'])->name('mission.update');
Route::get('/missions/{id}/delete', [MissionController::class, 'destroy'])->name('mission.destroy');
//mission planning
Route::get('/missions/planning/fetch', [MissionController::class, 'planning'])->name('mission.planning');
Route::get('/missions/planning', [MissionController::class, 'planningLayout'])->name('mission.planningLayout');


//--ajax mission
Route::post('/missions/fetch/', [MissionController::class, 'devisContent'])->name('mission.devisContent');
//--ajax mission planning store
Route::post('/missions/planning/store', [MissionController::class, 'storeViaPlanning'])->name('mission.storeViaPlanning');
Route::get('/missions/{id}/deleteViaPlanning', [MissionController::class, 'deleteViaPlanning'])->name('mission.deleteViaPlanning');
//mandat
Route::get('/mandat/generate/{id}', [MandatController::class, 'generate'])->name('mandat.generate');
Route::get('/mandat/pdf/{id}', [MandatController::class, 'pdf'])->name('mandat.pdf');
//convention
Route::get('/convention/generate/{id}', [ConventionController::class, 'generate'])->name('convention.generate');
Route::get('/convention/pdf/{id}', [ConventionController::class, 'pdf'])->name('convention.pdf');

//taches
Route::get('/taches', [TacheController::class, 'index'])->name('tache.list');
Route::get('/taches/{id}/show', [TacheController::class, 'show'])->name('tache.show');
Route::get('/taches/create', [TacheController::class, 'create'])->name('tache.create');
Route::post('/taches/store', [TacheController::class, 'store'])->name('tache.store');
Route::get('/taches/edit/{id}', [TacheController::class, 'edit'])->name('tache.edit');
Route::patch('/taches/{id}', [TacheController::class, 'update'])->name('tache.update');
Route::patch('/taches/statut/{id}', [TacheController::class, 'updateStatut'])->name('tache.updateStatut');
Route::get('/taches/{id}/delete', [TacheController::class, 'destroy'])->name('tache.destroy');
//tache planning
Route::get('/taches/planning/fetch', [TacheController::class, 'planning'])->name('tache.planning');
Route::get('/taches/planning', [TacheController::class, 'planningLayout'])->name('tache.planningLayout');
//--ajax tache planning store
Route::post('/taches/planning/store', [TacheController::class, 'storeViaPlanning'])->name('tache.storeViaPlanning');
Route::get('/taches/{id}/deleteViaPlanning', [TacheController::class, 'deleteViaPlanning'])->name('tache.deleteViaPlanning');
/* Route::get('/missions', 'App\Http\Controllers\MissionController@index')->name('mission.list');
[MissionController::class, 'index'] */

//commentaire
Route::post('commentaires/store/{tache}', [CommentaireController::class, 'store'])->name('commentaire.store');
Route::get('/commentaires/{id}/delete', [CommentaireController::class, 'destroy'])->name('commentaire.destroy');
Route::patch('/commentaires/{id}', [CommentaireController::class, 'update'])->name('commentaire.update');

//facture
Route::get('/factures', [FactureController::class, 'index'])->name('facture.list');
Route::get('/factures/ex/{id}', [FactureController::class, 'showExercice'])->name('facture.showExercice');
Route::get('/factures/create', [FactureController::class, 'create'])->name('facture.create');
Route::get('/factures/createAvoir', [FactureController::class, 'createAvoir'])->name('facture.createAvoir');
Route::post('/factures/store', [FactureController::class, 'store'])->name('facture.store');
Route::get('/factures/edit/{id}', [FactureController::class, 'edit'])->name('facture.edit');
Route::patch('/factures/{id}', [FactureController::class, 'update'])->name('facture.update');
Route::get('/factures/{id}/delete', [FactureController::class, 'destroy'])->name('facture.destroy');
//---ajax devis
Route::post('/factures/fetch', [FactureController::class, 'calculPrix'])->name('facture.calculPrix');
Route::post('/factures/fetchinfo', [FactureController::class, 'factureInfo'])->name('facture.factureInfo');
//---pdf
Route::get('/factures/pdf/{id}', [FactureController::class, 'pdf'])->name('facture.pdf');

//paiement
Route::get('/paiements', [PaiementController::class, 'index'])->name('paiement.list');
Route::get('/paiements/create', [PaiementController::class, 'create'])->name('paiement.create');
Route::post('/paiements/store', [PaiementController::class, 'store'])->name('paiement.store');
Route::get('/paiements/edit/{id}', [PaiementController::class, 'edit'])->name('paiement.edit');
Route::patch('/paiements/{id}', [PaiementController::class, 'update'])->name('paiement.update');
Route::get('/paiements/{id}/delete', [PaiementController::class, 'destroy'])->name('paiement.destroy');
Route::get('/paiements/creances', [PaiementController::class, 'creances'])->name('paiement.creances');
Route::get('/paiements/planning-paiement', [PaiementController::class, 'PlanningPaiement'])->name('paiement.PlanningPaiement');
//---ajax paiement
Route::post('/paiements/fetch', [PaiementController::class, 'fetch'])->name('paiement.fetch');


//utilisateurs
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('list');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [UserController::class, 'update'])->name('update');
    Route::get('/{id}/delete', [UserController::class, 'destroy'])->name('destroy');
});

//kpi
Route::prefix('kpi')->name('kpi.')->group(function () {
    Route::get('/', [KpiController::class, 'index'])->name('basic');
    Route::post('/usr', [KpiController::class, 'showUser'])->name('showUser');
    /*     Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [UserController::class, 'update'])->name('update');
    Route::get('/{id}/delete', [UserController::class, 'destroy'])->name('destroy'); */
});


//auth
Auth::routes();

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */