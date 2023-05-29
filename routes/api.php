<?php

use App\Http\Controllers\IngredientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::controller(IngredientController::class)->group(function () {
    Route::post('/ingredients', 'store');
});
