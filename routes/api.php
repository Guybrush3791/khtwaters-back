<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\AdminApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\GuestApiController;

// AUTH
Route :: post('login', [AuthApiController::class, 'login']) -> name('login');
Route :: post('register', [AuthApiController::class, 'register']) -> name('register');


// LOGGED USER
Route::middleware('auth:api')->group(function () {

    // ADMIN ONLY
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {

        // IS ADMIN
        Route::get('is-admin', [AdminApiController::class, 'isAdmin']);

        // GET USERS
        Route::get('users', [AdminApiController::class, 'getUsers']);
        // ADD USER
        Route::post('users', [AdminApiController::class, 'addUser']);
        // UPDATE USER
        Route::put('users/{id}', [AdminApiController::class, 'updateUser']);
        // DELETE USER
        Route::delete('users/{id}', [AdminApiController::class, 'deleteUser']);
    });

    Route :: prefix('user') -> group(function () {
        // ME
        Route :: get('me', [AuthApiController::class, 'me']);
        Route :: put('update', [AuthApiController::class, 'update']) -> name('update');

        // GET MY BOOKS
        Route :: get('books', [UserApiController::class, 'getBooks']);
        // GET MY BOOK BY ID
        Route :: get('books/{id}', [UserApiController::class, 'getBook']);
        // ADD BOOK
        Route :: post('books', [UserApiController::class, 'addBook']);
        // UPDATE BOOK
        Route :: put('books/{id}', [UserApiController::class, 'updateBook']);
        // DELETE BOOK
        Route :: delete('books/{id}', [UserApiController::class, 'deleteBook']);
    });
});

// GUEST
Route::get('books', [GuestApiController::class, 'getBooks']);
