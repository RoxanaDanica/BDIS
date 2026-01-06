<?php

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

Route::get('acasa', function () {
    return Inertia::render('Acasa');
})->middleware(['auth', 'verified'])->name('acasa');


Route::get('gestionare-pacienti', function () {
    return Inertia::render('Patients');
})->middleware(['auth', 'verified'])->name('gestionare-pacienti');

Route::get('gestionare-consultatii', function () {
    return Inertia::render('Consultations');
})->middleware(['auth', 'verified'])->name('gestionare-consultatii');

Route::get('rapoarte-si-statistici', function () {
    return Inertia::render('Statistics');
})->middleware(['auth', 'verified'])->name('rapoarte-si-statistici');

require __DIR__.'/settings.php';
