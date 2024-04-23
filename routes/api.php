<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\GuestApiController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\AdminApiController;
use App\Http\Controllers\Api\UserApiController;

// GUEST
Route::get('books', [GuestApiController::class, 'getBooks']);

// RESOURCES (ready only; open)
Route :: prefix('res') -> group(function () {

    // IMAGES
    Route::get('/image/{path}', [ImageController::class, 'getImage'])->where('path', '.*');
});

// AUTH
Route :: post('login', [AuthApiController::class, 'login']) -> name('login');
Route :: post('register', [AuthApiController::class, 'register']) -> name('register');


// LOGGED USER
Route::middleware('auth:api')->group(function () {

    // ADMIN ONLY
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {

        // GET USERS
        Route::get('users', [AdminApiController::class, 'getUsers']);
        // ADD USER
        Route::post('users', [AdminApiController::class, 'addUser']);
        // UPDATE USER
        Route::put('users/{id}', [AdminApiController::class, 'updateUser']);
        // DELETE USER
        Route::delete('users/{id}', [AdminApiController::class, 'deleteUser']);
    });

    // USER (prefix only)
    Route :: prefix('user') -> group(function () {

        // ME
        Route :: get('me', [AuthApiController::class, 'me']);
        Route :: put('update', [AuthApiController::class, 'update']) -> name('update');
        // IS ADMIN
        Route::get('is-admin', [AuthApiController::class, 'isAdmin']);

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

        // UPLOAD BOOK IMAGE
        Route::post('/books/{id}/image', [ImageController::class, 'uploadBookImage']);
        // DELETE BOOK IMAGE
        Route :: delete('books/{id}/image', [ImageController::class, 'deleteBookImage']);
    });
});


