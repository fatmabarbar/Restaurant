<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('api')->group(function () {
    Route::resource('categories', CategorieController::class);
    });
    Route::middleware('api')->group(function () {
        Route::resource('produits', ProduitController::class);
        });
        Route::middleware('api')->group(function () {
            Route::resource('users', UserController::class);
            });
            Route::middleware('api')->group(function () {
                Route::resource('commandes', CommandeController::class);
                });
                Route::post('/login', [LoginController::class, 'login']);
                Route::post('/register', [RegisterController::class, 'register']);
                Route::middleware('auth:sanctum')->post('/logout', [LoginController::class,
                'logout']);
                Route::middleware('api')->middleware('auth:sanctum')->group(function () {
                    Route::resource('produits', ProduitController::class);
                    });
                    Route::get('/admin/dashboard', function () {
                        // Admin-only dashboard logic
                    })->middleware('role:1'); 