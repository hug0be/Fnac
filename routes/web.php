<?php

use App\Http\Controllers\imageController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\jeuVideoController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\FavoriController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\videoController;
use Illuminate\Support\Facades\Route;
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

Route::get('/', [jeuVideoController::class, 'home'])->name('home');

//Il faut être authentifié en client pour accéder à ces routes
Route::middleware('client')->group(function () {
    //Compte client
    Route::get('/profile', [ClientController::class, 'profile'])->name('profile');
    Route::post('/profile', [ClientController::class, 'editAccount'])->name('profile');
    Route::get('/profile/adresses', [ClientController::class, 'myAdresses'])->name('myAdresses');
    Route::get('/password', [ClientController::class, 'password'])->name('password');
    Route::post('/password', [ClientController::class, 'changePassword'])->name('password');
    // Route::get('/account', [ClientController::class, 'detailAccount'])->name('detailAccount');
    
    //Adresses
    Route::get('/ajouter-adresse', [ClientController::class, 'newAdresse'])->name('newAdresse');
    Route::post('/createAdresse', [ClientController::class, 'createAdresse'])->name('createAdresse');

    //Favoris
    Route::post('/toggle_favori', [FavoriController::class, 'toggle_favori'])->name('toggle_favori');
    Route::get('/favoritesGames', [FavoriController::class, 'favoritesGames'])->name('favoritesGames');
    
    //Commande 
    Route::get('/mes-commandes', [CommandeController::class, 'myCommandes'])->name('myCommandes');
    Route::get('/mes-commandes-en-cours', [CommandeController::class, 'myCommandesEnCours'])->name('myCommandesEnCours');
    Route::get('/passerCommande', [CommandeController::class, 'passerCommande'])->name('passerCommande');
    Route::post('/createCommande', [CommandeController::class, 'createCommande'])->name('createCommande');
});

//Il faut être authentifié en employé pour accéder à ces routes
Route::middleware('employe')->group(function () {
    Route::get('/profile', [EmployeController::class, 'view_profile'])->name('profile');
    Route::post('/profile', [EmployeController::class, 'edit'])->name('edit');
    Route::get('/password', [EmployeController::class, 'view_password'])->name('password');
    Route::post('/password', [EmployeController::class, 'change_password'])->name('password');
    
    Route::middleware(['role:service comm'])->group(function () {
        Route::get('/avisAbusifs', [AvisController::class, 'avisAbusifs'])->name('avisAbusifs');
        Route::post('/delete_avis', [AvisController::class, 'delete_avis'])->name('delete_avis');
    });

    Route::middleware(['role:service vente'])->group(function () {
        Route::get('/videoGameDetail/imageUpload', [ imageController::class, 'imageUpload' ])->name('image.upload');
        Route::post('image-upload', [ imageController::class, 'imageUploadPost' ])->name('image.upload.post');

        Route::get('/videoGameDetail/videoUpload', [ videoController::class, 'videoUpload' ])->name('video.upload');
        Route::post('video-upload', [ videoController::class, 'videoUploadPost' ])->name('video.upload.post');
    });

    Route::middleware(['role:service client'])->group(function () {
        Route::get('/commandeVeille', [ CommandeController::class, 'commandeVeille'])->name('commandeVeille');
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/employe/administration', [EmployeController::class, 'view_manage'])->name('admin');
        Route::post('/employe/administration/edit', [EmployeController::class, 'edit_admin'])->name('admin.edit');
        Route::post('/employe/administration/add', [EmployeController::class, 'create'])->name('admin.add');
    });
});

//Jeux Vidéos
Route::get('/rayon{idRayon}', [jeuVideoController::class, 'searchByRayon'])->name('searchByRayon');
Route::post('/', [jeuVideoController::class, 'rechercheJeu'])->name('rechercheJeu');
Route::get('/console{idConsole}', [jeuVideoController::class, 'searchByConsole'])->name('searchByConsole');
Route::get('/videoGameDetail/{idGame}', [jeuVideoController::class, 'detailVideoGame'])->name('detailVideoGame');
Route::get('/videoGameDetailN/{idGame}', [jeuVideoController::class, 'detailVideoGameAvisNeg'])->name('detailVideoGameAvisNeg');


//Authentification
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authentificate'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'createAccount'])->name('register');

Route::get('/employe/login', [EmployeController::class, 'view_login'])->name('emp.login');
Route::post('/employe/login', [EmployeController::class, 'login'])->name('emp.login');


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Panier
Route::get('/panier',[PanierController::class, 'panier'])->name('panier');
Route::post('/addPanier',[PanierController::class, 'addPanier'])->name('addPanier');
Route::post('/decrement_qte_panier',[PanierController::class, 'decrement_qte_panier'])->name('decrement_qte_panier');

//Comparateur
Route::get('/comparateur', [ jeuVideoController::class, 'comparateur'])->name('comparateur');

//Session
Route::post('/addToSession', [ SessionController::class, 'addToSession']);
Route::post('/deleteFromSession', [ SessionController::class, 'deleteFromSession']);

// Avis
Route::post('/avis/add', [AvisController::class, 'addAvis'])->name('add_avis');

Route::post('/add_avisUtile', [AvisController::class, 'add_avisUtile'])->name('add_avisUtile');
Route::post('/add_avisInutile', [AvisController::class, 'add_avisInutile'])->name('add_avisInutile');
Route::post('/add_avisAbusif', [AvisController::class, 'add_avisAbusif'])->name('add_avisAbusif');