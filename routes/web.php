<?php

use App\Http\Controllers\imageController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\jeuVideoController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
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

//Il faut être authentifié pour accéder à ces routes
Route::middleware('auth')->group(function () {
    //Compte client
    Route::get('/profile', [ClientController::class, 'profile'])->name('profile');
    Route::post('/profile', [ClientController::class, 'editAccount'])->name('profile');
    Route::get('/password', [ClientController::class, 'password'])->name('password');
    Route::post('/password', [ClientController::class, 'changePassword'])->name('password');
    Route::get('/account', [ClientController::class, 'detailAccount'])->name('detailAccount');
    //Déconnexion
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/', [jeuVideoController::class, 'home'])->name('home');

Route::get('/rayon{idRayon}', [jeuVideoController::class, 'searchByRayon'])->name('searchByRayon');
Route::get('/console{idConsole}', [jeuVideoController::class, 'searchByConsole'])->name('searchByConsole');
Route::get('/videoGameDetail/{idGame}', [jeuVideoController::class, 'detailVideoGame'])->name('detailVideoGame');
Route::get('/panier',[jeuVideoController::class, 'panier'])->name('panier');
Route::post('/addPanier',[jeuVideoController::class, 'addPanier'])->name('addPanier');

//Authentification
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authentificate'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'createAccount'])->name('register');


//Upload Photo
Route::get('/videoGameDetail/imageUpload', [ imageController::class, 'imageUpload' ])->name('image.upload');
Route::post('image-upload', [ imageController::class, 'imageUploadPost' ])->name('image.upload.post');

//Upload video
Route::get('/videoGameDetail/videoUpload', [ videoController::class, 'videoUpload' ])->name('video.upload');
Route::post('video-upload', [ videoController::class, 'videoUploadPost' ])->name('video.upload.post');

//Comparateur
Route::get('/comparateur', [ jeuVideoController::class, 'comparateur'])->name('comparateur');



//Commande Veille
Route::get('/service-cli/commandeVeille', [ CommandeController::class, 'commandeVeille'])->name('commandeVeille');
 
// Avis
Route::get('/service-comm/avisAbusifs', [AvisController::class, 'avisAbusifs'])->name('avisAbusifs');
Route::post('/service-comm/delete_avis', [AvisController::class, 'delete_avis'])->name('delete_avis');
Route::post('/avis/add', [AvisController::class, 'addAvis'])->name('add_avis');

Route::post('/add_avisUtile', [AvisController::class, 'add_avisUtile'])->name('add_avisUtile');
Route::post('/add_avisInutile', [AvisController::class, 'add_avisInutile'])->name('add_avisInutile');


 