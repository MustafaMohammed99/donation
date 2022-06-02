<?php

use App\Http\Controllers\Api\AuthTokensController;
use App\Http\Controllers\Api\BasketController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\ProjectsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::delete('currentTokens', [AuthTokensController::class, 'destroyCurrentTokens'])->middleware('auth:sanctum');
//Route::get('tokens', [AuthTokensController::class, 'index'])->middleware('auth:sanctum');
//Route::get('currentTokens', [AuthTokensController::class, 'getCurrentTokens']) ->middleware('auth:sanctum');
Route::post('register', [AuthTokensController::class, 'createAccount']);
Route::post('login', [AuthTokensController::class, 'store'])->middleware('guest:sanctum');
Route::delete('logout', [AuthTokensController::class, 'destroy'])->middleware('auth:sanctum');


// GET /api/projects -> index
// POST /api/projects -> store
// GET  /api/projects/{project} -> show
// PUT|PATCH  /api/projects/{project} -> update
// DELETE  /api/projects/{project} -> destroy
Route::apiResource('categories', CategoriesController::class);
Route::apiResource('projects', ProjectsController::class);
Route::post('projects/search', [ProjectsController::class, 'search']);
Route::get('home', [ProjectsController::class, 'home']);

Route::get('basket', [BasketController::class, 'index'])->middleware('auth:sanctum');
Route::post('basket', [BasketController::class, 'store'])->middleware('auth:sanctum');

Route::get('favorites', [FavoriteController::class, 'index'])->middleware('auth:sanctum');
Route::post('favorites', [FavoriteController::class, 'store'])->middleware('auth:sanctum');








