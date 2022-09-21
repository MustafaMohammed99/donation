<?php

use App\Http\Controllers\Dashboard\Admin\AdminsController;
use App\Http\Controllers\Dashboard\Admin\AssociationsController;
use App\Http\Controllers\Dashboard\Admin\CategoriesController;
use App\Http\Controllers\Dashboard\Admin\HomeController;
use App\Http\Controllers\Dashboard\Admin\ProjectsAdminsController;
use App\Http\Controllers\Dashboard\Admin\RequestsController;
use App\Http\Controllers\Dashboard\Association\ProfileController;
use App\Http\Controllers\Dashboard\Association\ProjectsController;
use Illuminate\Support\Facades\Route;

Route::get('/started', [HomeController::class, 'started'])->name('donation.started');


Route::group([
    'prefix' => 'dashboard',
], function () {

    Route::group([
        'prefix' => 'admin',
        'middleware' => ['auth:admin'],
    ], function () {
        Route::get('/', [HomeController::class, 'index'])->name('adminHome.index');
        Route::resource('associations', AssociationsController::class);
        Route::get('association_ajax', [AssociationsController::class, 'ajax'])->name('associations.ajax');
        Route::resource('admins', AdminsController::class);
        Route::get('admin_ajax', [AdminsController::class, 'ajax'])->name('admins.ajax');
        Route::resource('categories', CategoriesController::class);
        Route::get('/projects', [ProjectsAdminsController::class, 'index'])->name('adminProjects.index');

        // ajax show all projects
//        https://stackoverflow.com/questions/56915545/why-datatables-is-very-slow-with-laravel
        Route::get('/projects/ajax_project_accept', [ProjectsAdminsController::class, 'ajax_project_accept'])->name('adminProjects.ajax_project_accept');
        Route::get('/projects/ajax_project_pending', [ProjectsAdminsController::class, 'ajax_project_pending'])->name('adminProjects.ajax_project_pending');
        Route::get('/projects/ajax_project_declined', [ProjectsAdminsController::class, 'ajax_project_declined'])->name('adminProjects.ajax_project_declined');
        Route::get('/projects/ajax_project_pending_stopping', [ProjectsAdminsController::class, 'ajax_project_pending_stopping'])->name('adminProjects.ajax_project_pending_stopping');
        Route::get('/projects/ajax_project_declined_stopping', [ProjectsAdminsController::class, 'ajax_project_declined_stopping'])->name('adminProjects.ajax_project_declined_stopping');
        Route::get('/projects/ajax_project_completed_partial', [ProjectsAdminsController::class, 'ajax_project_completed_partial'])->name('adminProjects.ajax_project_completed_partial');
        Route::get('/projects/ajax_project_completed', [ProjectsAdminsController::class, 'ajax_project_completed'])->name('adminProjects.ajax_project_completed');
        Route::get('/projects/ajax_project_pending_failed', [ProjectsAdminsController::class, 'ajax_project_pending_failed'])->name('adminProjects.ajax_project_pending_failed');
        Route::get('/projects/ajax_project_failed', [ProjectsAdminsController::class, 'ajax_project_failed'])->name('adminProjects.ajax_project_failed');

        // ajax show detail one project
        Route::get('/projects/ajax_show_project_accept/{project}', [ProjectsAdminsController::class, 'ajax_show_project_accept'])->name('adminProjects.ajax_show_project_accept');
        Route::get('/projects/ajax_show_project_pending/{project}', [ProjectsAdminsController::class, 'ajax_show_project_pending'])->name('adminProjects.ajax_show_project_pending');
        Route::get('/projects/ajax_show_project_declined/{project}', [ProjectsAdminsController::class, 'ajax_show_project_declined'])->name('adminProjects.ajax_show_project_declined');
        Route::get('/projects/ajax_show_project_pending_stopping/{project}', [ProjectsAdminsController::class, 'ajax_show_project_pending_stopping'])->name('adminProjects.ajax_show_project_pending_stopping');
        Route::get('/projects/ajax_show_project_declined_stopping/{project}', [ProjectsAdminsController::class, 'ajax_show_project_declined_stopping'])->name('adminProjects.ajax_show_project_declined_stopping');
        Route::get('/projects/ajax_show_project_completed_partial/{project}', [ProjectsAdminsController::class, 'ajax_show_project_completed_partial'])->name('adminProjects.ajax_show_project_completed_partial');
        Route::get('/projects/ajax_show_project_completed/{project}', [ProjectsAdminsController::class, 'ajax_show_project_completed'])->name('adminProjects.ajax_show_project_completed');
        Route::get('/projects/ajax_show_project_failed/{project}', [ProjectsAdminsController::class, 'ajax_show_project_failed'])->name('adminProjects.ajax_show_project_failed');
        Route::get('/projects/ajax_show_project_pending_failed/{project}', [ProjectsAdminsController::class, 'ajax_show_project_pending_failed'])->name('adminProjects.ajax_show_project_pending_failed');


        Route::put('/projects/stopping/{project}/{reason_failed}', [RequestsController::class, 'stopping'])->name('requests.stopping');
        Route::put('/projects/failed/{project}/{reason_failed}', [RequestsController::class, 'failed'])->name('requests.failed');
        Route::get('/requests', [RequestsController::class, 'index'])->name('requests.index');
        Route::put('/requests/accepted/{project}', [RequestsController::class, 'update'])->name('requests.update');
        Route::put('/requests/declined/{project}', [RequestsController::class, 'destroy'])->name('requests.destroy');
        Route::put('/requests_stopping/accepted/{project}', [RequestsController::class, 'accept_stopping'])->name('requests.accept_stopping');
        Route::put('/requests_stopping/declined/{project}', [RequestsController::class, 'decline_stopping'])->name('requests.decline_stopping');
        Route::put('/requests_failed/accepted/{project}', [RequestsController::class, 'accept_failed'])->name('requests.accept_failed');
        Route::put('/requests_failed/declined/{project}', [RequestsController::class, 'decline_failed'])->name('requests.decline_failed');
    });


    Route::group([
        'prefix' => 'association',
        'middleware' => ['auth:association'],
    ], function () {
        Route::get('/', [\App\Http\Controllers\Dashboard\Association\HomeController::class, 'index'])->name('associationHome.index');
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('projects', [ProjectsController::class, 'index'])->name('projects.index');
        Route::get('/projects/create', [ProjectsController::class, 'create'])->name('projects.create');
        Route::post('projects', [ProjectsController::class, 'store'])->name('projects.store');
        Route::get('projects/{project}/edit_accepted', [ProjectsController::class, 'edit_accepted'])->name('projects.edit_accepted');
        Route::get('projects/{project}/edit_pending', [ProjectsController::class, 'edit_pending'])->name('projects.edit_pending');
        Route::put('projects/{project}', [ProjectsController::class, 'update'])->name('projects.update');
        Route::get('projects/{project}/stopping/{type}', [ProjectsController::class, 'detail_stopping'])->name('projects.detail_stopping');
        Route::post('projects/stopping', [ProjectsController::class, 'stopping'])->name('projects.stopping');
        Route::post('projects/failed', [ProjectsController::class, 'failed'])->name('projects.failed');
    });


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

