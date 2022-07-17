<?php

use App\Http\Controllers\Dashboard\Admin\AssociationsController;
use App\Http\Controllers\Dashboard\Admin\CategoriesController;
use App\Http\Controllers\Dashboard\Admin\HomeController;
use App\Http\Controllers\Dashboard\Admin\ProjectsRequestsController;
use App\Http\Controllers\Dashboard\Association\ProfileController;
use App\Http\Controllers\Dashboard\Association\ProjectsController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'dashboard',
], function () {

    Route::group([
        'prefix' => 'admin',
        'middleware' => ['auth:admin'],
    ], function () {
        Route::get('/', [HomeController::class, 'index'])->name('adminHome.index');
        Route::resource('associations', AssociationsController::class);
//        Route::get('associations/ajax', [AssociationsController::class, 'index_ajax'])->name('associations.index_ajax');
        Route::get('ajax', [AssociationsController::class, 'ajax'])->name('associations.ajax');
        Route::resource('categories', CategoriesController::class);

        Route::get('/projects', [ProjectsRequestsController::class, 'showProjects'])->name('adminProjects.index');
        Route::put('/projects/stopping/{project}', [ProjectsRequestsController::class, 'stopping'])->name('adminProjects.stopping');
        Route::put('/projects/failed/{project}', [ProjectsRequestsController::class, 'failed'])->name('adminProjects.failed');
        Route::get('/requests', [ProjectsRequestsController::class, 'index'])->name('requests.index');
        Route::put('/requests/accepted/{id}/{index}', [ProjectsRequestsController::class, 'update'])->name('requests.update');
        Route::put('/requests/declined/{id}/{index}', [ProjectsRequestsController::class, 'destroy'])->name('requests.destroy');
        Route::put('/requests_stopping/accepted/{project}/{index}', [ProjectsRequestsController::class, 'accept_stopping'])->name('requests.accept_stopping');
        Route::put('/requests_stopping/declined/{project}/{index}', [ProjectsRequestsController::class, 'decline_stopping'])->name('requests.decline_stopping');
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
        Route::get('projects/{project}/edit', [ProjectsController::class, 'edit'])->name('projects.edit');
        Route::put('projects/{project}', [ProjectsController::class, 'update'])->name('projects.update');
        Route::get('projects/{project}/stopping', [ProjectsController::class, 'detail_stopping'])->name('projects.detail_stopping');
        Route::post('projects/stopping', [ProjectsController::class, 'stopping'])->name('projects.stopping');
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
/*
//window.Echo.private(`App.Models.User.${userId}`)
//     .notification(function(data) {
//         $('#notificationsList').prepend(`<li class="notifications-not-read">
//             <a href="${data.url}?notify_id=${data.id}">
//                 <span class="notification-icon"><i class="icon-material-outline-group"></i></span>
//                 <span class="notification-text">
//                     <strong>*</strong>
//                     ${data.body}
//                 </span>
//             </a>
//         </li>`);
//         let count = Number($('#newNotifications').text())
//         count++;
//         if (count > 99) {
//             count = '99+';
//         }
//         $('#newNotifications').text(count)
//     })
//
// window.Echo.join(`messages.${userId}`)
//     .listen('.message.created', function(data) {
//         alert(data.message.message)
//     })

 */
?>

