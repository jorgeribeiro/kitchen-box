<?php

use App\Http\Controllers\IngredientController;
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
