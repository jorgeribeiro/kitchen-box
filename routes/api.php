<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login']);

Route::controller(IngredientController::class)->group(function () {
    Route::get('/ingredients', 'index');
    Route::post('/ingredients', 'store');
    Route::get('/ingredients/order', 'ingredientsToOrder');
});

Route::controller(RecipeController::class)->group(function () {
    Route::get('/recipes', 'index');
    Route::post('/recipes', 'store');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(BoxController::class)->group(function () {
        Route::post('/boxes', 'store');
    });
});
