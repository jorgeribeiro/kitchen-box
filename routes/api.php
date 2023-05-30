<?php

use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::controller(IngredientController::class)->group(function () {
    Route::get('/ingredients', 'index');
    Route::post('/ingredients', 'store');
});

Route::controller(RecipeController::class)->group(function () {
    Route::get('/recipes', 'index');
    Route::post('/recipes', 'store');
});
