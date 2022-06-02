<?php

use App\Http\Controllers\Dashboard\Association\ProjectsController;
use App\Http\Controllers\Dashboard\AssociationsController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\RequestsController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'dashboard',
], function () {

//    Route::group([
//        'prefix' => 'admin',
//        'middleware' => ['auth:admin'],
//    ], function () {
    Route::resource('associations', AssociationsController::class);
    Route::resource('categories', CategoriesController::class);

    Route::get('/requests/', [RequestsController::class, 'index'])->name('requests.index');
    Route::put('/requests/accepted/{id}', [RequestsController::class, 'update'])->name('requests.update');
    Route::put('/requests/declined/{id}', [RequestsController::class, 'destroy'])->name('requests.destroy');
//    });


//Route::prefix('/projects')
//    ->as('projects.')
//    ->group(function() {
    Route::get('/projects/', [ProjectsController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectsController::class, 'create'])->name('projects.create');
    Route::post('/projects/', [ProjectsController::class, 'store'])->name('projects.store');
//    });


});
//Route::get('/dashboard/associations/', [AssociationsController::class, 'index'])->name('associations.index');
//Route::get('/dashboard/associations/create', [AssociationsController::class, 'create'])->name('associations.create');
//Route::post('/dashboard/associations/', [AssociationsController::class, 'store'])->name('associations.store');
//Route::get('/dashboard/associations/{association}', [AssociationsController::class, 'show'])->name('associations.show');
//Route::get('/dashboard/associations/{association}/edit', [AssociationsController::class, 'edit'])->name('associations.edit');
//Route::put('/dashboard/associations/{association}', [AssociationsController::class, 'update'])->name('associations.update');
//Route::delete('/dashboard/associations/{association}', [AssociationsController::class, 'destroy'])->name('associations.destroy');

//Route::get('/dashboard/categories/', [CategoriesController::class, 'index'])->name('categories.index');
//Route::get('/dashboard/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
//Route::post('/dashboard/categories/', [CategoriesController::class, 'store'])->name('categories.store');
//Route::get('/dashboard/categories/{category}', [CategoriesController::class, 'show'])->name('categories.show');
//Route::get('/dashboard/categories/{category}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
//Route::put('/dashboard/categories/{category}', [CategoriesController::class, 'update'])->name('categories.update');
//Route::delete('/dashboard/categories/{category}', [CategoriesController::class, 'destroy'])->name('categories.destroy');


?>
