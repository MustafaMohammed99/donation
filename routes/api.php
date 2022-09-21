<?php

use App\Http\Controllers\Api\AuthTokensController;
use App\Http\Controllers\Api\BasketController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\MobileNotificationController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProjectsController;
use App\Http\Controllers\PaymentsCallbackController;
use App\Http\Controllers\PaymentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// GET /api/projects -> index
// POST /api/projects -> store
// GET  /api/projects/{project} -> show
// PUT|PATCH  /api/projects/{project} -> update
// DELETE  /api/projects/{project} -> destroy

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::delete('currentTokens', [AuthTokensController::class, 'destroyCurrentTokens'])->middleware('auth:sanctum');
//Route::get('tokens', [AuthTokensController::class, 'index'])->middleware('auth:sanctum');
//Route::get('currentTokens', [AuthTokensController::class, 'getCurrentTokens']) ->middleware('auth:sanctum');
Route::post('register', [AuthTokensController::class, 'createAccount']);
Route::post('login', [AuthTokensController::class, 'store'])->middleware('guest:sanctum');
Route::delete('logout', [AuthTokensController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('profile', [ProfileController::class, 'show'])->middleware('auth:sanctum');
Route::put('update_profile', [ProfileController::class, 'update'])->middleware('auth:sanctum');
Route::apiResource('categories', CategoriesController::class);
Route::apiResource('projects', ProjectsController::class);
Route::post('projects/search', [ProjectsController::class, 'search']);
Route::get('completed', [ProjectsController::class, 'completed']);
Route::get('home', [ProjectsController::class, 'home']);

Route::get('basket', [BasketController::class, 'index'])->middleware('auth:sanctum');
Route::post('basket', [BasketController::class, 'store'])->middleware('auth:sanctum');

Route::get('favorites', [FavoriteController::class, 'index'])->middleware('auth:sanctum');
Route::post('favorites', [FavoriteController::class, 'store'])->middleware('auth:sanctum');



Route::post('firebaseTokens',[MobileNotificationController::class,'create_token']);
Route::get('notifications',[MobileNotificationController::class,'show'])->middleware('auth:sanctum');
Route::post('update_status',[MobileNotificationController::class,'read_notification'])->middleware('auth:sanctum');
Route::post('back_money',[MobileNotificationController::class,'back_money'])->middleware('auth:sanctum');
//    ->middleware('auth:sanctum');






