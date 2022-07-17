<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Models\Project;
use App\Models\StoppingProject;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $flashMessage = Session::get('success');

        $count_associations = Association::count();
        $count_projects = Project::where('status', '=', 'accepted')->count();
        $sum_received_amount = Project::where('status', '=', 'accepted')->sum('received_amount');
        $sum_num_beneficiaries = Project::where('status', '=', 'accepted')->sum('num_beneficiaries');

        $projects = Project::with(['category', 'association'])
            ->where('status', '=', 'pending')
            ->get();
        $projects_stopping = StoppingProject::with(['project' => function ($query) {
            $query->with('category');
            $query->with('association');
        }])->where('status', '=', 'pending')->get();

        return view('admin.index',
            compact('count_associations', 'count_projects',
                'sum_received_amount', 'sum_num_beneficiaries', 'projects', 'projects_stopping', 'flashMessage'));
    }

}
