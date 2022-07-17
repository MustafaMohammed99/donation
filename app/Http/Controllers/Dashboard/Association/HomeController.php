<?php

namespace App\Http\Controllers\Dashboard\Association;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $count_projects = Project::where('status', '=', 'accepted')->where('association_id', '=', $user->id)->count();
        $sum_received_amount = Project::where('status', '=', 'accepted')->where('association_id', '=', $user->id)->sum('received_amount');
        $sum_num_beneficiaries = Project::where('status', '=', 'accepted')->where('association_id', '=', $user->id)->sum('num_beneficiaries');


        return view('association.index',
            compact('count_projects',
                'sum_received_amount', 'sum_num_beneficiaries'));
    }
}
