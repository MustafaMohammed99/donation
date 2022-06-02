<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RequestsController extends Controller
{
    public function index()
    {
        $flashMessage = Session::get('success');
        $projects = Project::with(['category', 'association'])
            ->where('status', '=', 'pending')
            ->get();

        return view('admin.requests', [
            'projects' => $projects,
            'flashMessage' => $flashMessage,
        ]);
    }


    public function update($id)
    {
        $project = Project::findOrFail($id);

        $project->update([
            'status' => 'accepted'
        ]);
        return redirect()
            ->route('requests.index')
            ->with('success', "Project $project->title is accepted!");
    }


    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->update([
            'status' => 'declined'
        ]);
        return redirect()
            ->route('requests.index')
            ->with('success', "Project $project->title is declined!");
    }

}


//Route::get('/dashboard/associations/', [AssociationsController::class, 'index'])->name('associations.index');
//Route::get('/dashboard/associations/create', [AssociationsController::class, 'create'])->name('associations.create');
//Route::post('/dashboard/associations/', [AssociationsController::class, 'store'])->name('associations.store');
//Route::get('/dashboard/associations/{association}', [AssociationsController::class, 'show'])->name('associations.show');
//Route::get('/dashboard/associations/{association}/edit', [AssociationsController::class, 'edit'])->name('associations.edit');
//Route::put('/dashboard/associations/{association}', [AssociationsController::class, 'update'])->name('associations.update');
//Route::delete('/dashboard/associations/{association}', [AssociationsController::class, 'destroy'])->name('associations.destroy');
//
//
//
//Route::get('/dashboard/categories/', [CategoriesController::class, 'index'])->name('categories.index');
//Route::get('/dashboard/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
//Route::post('/dashboard/categories/', [CategoriesController::class, 'store'])->name('categories.store');
//Route::get('/dashboard/categories/{category}', [CategoriesController::class, 'show'])->name('categories.show');
//Route::get('/dashboard/categories/{category}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
//Route::put('/dashboard/categories/{category}', [CategoriesController::class, 'update'])->name('categories.update');
//Route::delete('/dashboard/categories/{category}', [CategoriesController::class, 'destroy'])->name('categories.destroy');
//
//Route::get('/dashboard/requests/', [RequestsController::class, 'index'])->name('requests.index');
//Route::put('/dashboard/requests/accepted/{id}', [RequestsController::class, 'update'])->name('requests.update');
//Route::put('/dashboard/requests/declined/{id}', [RequestsController::class, 'destroy'])->name('requests.destroy');
//
//Route::get('/dashboard/projects/', [ProjectsController::class, 'index'])->name('projects.index');
//Route::post('/dashboard/projects/', [ProjectsController::class, 'store'])->name('projects.store');
//Route::get('/dashboard/projects/create', [ProjectsController::class, 'create'])->name('projects.create');
