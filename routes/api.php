<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('ingredient')->name('ingredient.')->group(function () {
    Route::get('/list', 'IngredientController@index')->name('list');
    Route::post('/create', 'IngredientController@create')->name('create');
});

Route::prefix('recipe')->name('recipe.')->group(function () {
    Route::get('/list', 'RecipeController@index')->name('list');
    Route::post('/create', 'RecipeController@create')->name('create');
});

Route::prefix('box')->name('box.')->group(function () {
    Route::post('/create', 'BoxController@create')->name('create');
});

