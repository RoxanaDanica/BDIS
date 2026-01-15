<?php

use App\Http\Controllers\Consultatii;
use App\Http\Controllers\Pacienti;
use App\Http\Controllers\Statistici;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/acasa', function () {
    return Inertia::render('Acasa');
})->middleware(['auth'])->name('acasa');

Route::get('/gestionare-pacienti', [Pacienti::class, 'index'])
    ->middleware(['auth'])
    ->name('gestionare-pacienti');

Route::get('/gestionare-consultatii', function () {
    return Inertia::render('Consultations');
})->middleware(['auth'])->name('gestionare-consultatii');

Route::get('/rapoarte-si-statistici', function () {
    return Inertia::render('Statistics');
})->middleware(['auth'])->name('rapoarte-si-statistici');

Route::get('/pacienti', [Pacienti::class, 'index'])->name('pacienti.index');
Route::post('/pacienti', [Pacienti::class, 'store'])->name('pacienti.store');
Route::put('/pacienti/{pacient}', [Pacienti::class, 'update'])->name('pacienti.update');
Route::delete('/pacienti/{pacient}', [Pacienti::class, 'destroy'])->name('pacienti.destroy'); 

Route::get('/gestionare-consultatii', [Consultatii::class, 'index'])
    ->middleware(['auth'])
    ->name('gestionare-consultatii');

Route::get('/consultatii', [Consultatii::class, 'index'])->name('consultatii.index');
Route::post('/consultatii', [Consultatii::class, 'store'])->name('consultatii.store');
Route::put('/consultatii/{consultatie}', [Consultatii::class, 'update'])->name('consultatii.update');
Route::delete('/consultatii/{consultatie}', [Consultatii::class, 'destroy'])->name('consultatii.destroy'); 

Route::get('/rapoarte-si-statistici', [Statistici::class, 'index'])
    ->middleware('auth');


require __DIR__.'/settings.php';
