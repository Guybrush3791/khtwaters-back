<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GuestController;
use App\Http\Controllers\LoggedController;

Route::get('/', function () {
    return view('backend');
}) -> name('home');

// Route::get('/', function () {
//     return view('welcome');
// }) -> name('home');

// Route::get('/dashboard', function () {

//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route :: get('/guest/home', [GuestController :: class, 'index'])
//     -> name('guest.index');

// Route :: get('/logged/home', [LoggedController :: class, 'index'])
//     -> middleware('auth')
//     -> name('logged.index');

// Route::middleware('auth')
//     -> name('logged.')
//     -> prefix('logged')
//     -> group(function () {

//     Route :: get('home', [LoggedController :: class, 'index'])
//         -> name('index');
// });

require __DIR__.'/auth.php';
