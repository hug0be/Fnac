<?php

use App\Http\Controllers\jeuVideoController;
use App\Models\Genre;
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

Route::get('/rayon{idRayon}', [jeuVideoController::class, 'searchByRayon'])->name('searchByRayon');

Route::get('/console{idConsole}', [jeuVideoController::class, 'searchByConsole'])->name('searchByConsole');

Route::get('/videoGameDetail/{idGame}', [jeuVideoController::class, 'detailVideoGame'])->name('detailVideoGame');

Route::get('/service-comm/avisAbusifs', [jeuVideoController::class, 'avisAbusifs'])->name('avisAbusifs');

Route::post('/service-comm/delete_avis', [jeuVideoController::class, 'delete_avis'])->name('delete_avis');