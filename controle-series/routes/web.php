<?php

use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Autenticador;
use App\Mail\SeriesCreated;
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

// Route::resource('/series', SeriesController::class)->only(['index', 'create', 'store', 'destroy', 'edit', 'update']);

Route::resource('/series', SeriesController::class)->except(['show']);

Route::middleware('autenticador')->group(function () {
    Route::get('/', function () {
        return redirect('/series');
        // return view('welcome');
    })
        // ->middleware(Autenticador::class)
    ;

    Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])
        ->name("seasons.index")
        // ->middleware('autenticador')
    ;

    Route::get('seasons/{season}/episodes', [EpisodeController::class, 'index'])->name("episodes.index");
    Route::post('seasons/{season}/episodes', [EpisodeController::class, 'update'])->name("episodes.update");
});

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/login', [LoginController::class, 'store'])->name('signin');

Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/register', [UsersController::class, 'create'])->name('users.create');

Route::post('/register', [UsersController::class, 'store'])->name('users.store');

Route::get('/email', function () {
    return new SeriesCreated(
        'Série de teste',
        16,
        1,
        10,
    );
});

// Route::delete('/series/destroy/{serie}', [SeriesController::class, 'destroy'])->name("series.destroy");

// Route::get('/series/{serie}/edit', [SeriesController::class, 'edit'])->name("series.edit");

// Route::put('/series/{serie}', [SeriesController::class, 'update'])->name("series.update");

// Route::controller(SeriesController::class)->group(function() {
//     Route::get('/series', 'index')->name("series.index");
//     Route::get('/series/criar', 'create')->name("series.create");
//     Route::post('/series/salvar', 'store')->name("series.store");
// });

// Route::get('/series', [SeriesController::class, 'index']);
// Route::get('/series/criar', [SeriesController::class, 'create']);
// Route::post('/series/salvar', [SeriesController::class, 'store']);
