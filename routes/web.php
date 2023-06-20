<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\MelnyController;

Route::get('/', function(){return view('Auth.login');})->name('login');

Route::get('/register', function(){return view('Auth.register');})->name('register');


Route::post('/register', [MelnyController::class, 'register'])->name('register.store');

Route::get('/index', function(){ return view('listings.index');})->name('index');

Route::get('/', [Controllers\ListingController::class, 'index'])
    ->name('listings.index');

Route::get('/new', [Controllers\ListingController::class, 'create'])
    ->name('listings.create');

Route::post('/new', [Controllers\ListingController::class, 'store'])
    ->name('listings.store');

Route::get('/newE', [Controllers\ListingController::class, 'createE'])
    ->name('listings.createE');

Route::post('/newE', [Controllers\ListingController::class, 'job'])
    ->name('listings.job');


Route::get('/dashboard', function (\Illuminate\Http\Request $request) {
    return view('dashboard', [
        'listings' => $request->user()->listings
    ]);
})->middleware(['auth'])->name('dashboard');



require __DIR__ . '/auth.php';

Route::get('/{listing}', [Controllers\ListingController::class, 'show'])
    ->name('listings.show');

Route::get('/{listing}/apply', [Controllers\ListingController::class, 'apply'])
    ->name('listings.apply');
