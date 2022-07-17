<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Models\Project;
use App\Models\StoppingProject;
use App\Notifications\NewProjectNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProjectsRequestsController extends Controller
{
    public function showProjects()
    {
        $projects_accepted = Project::with('category', 'association')
            ->where('status', '=', 'accepted')->get();

        $projects_pending = Project::with('category', 'association')
            ->where('status', '=', 'pending')->get();
        $projects_declined = Project::with('category', 'association')
            ->where('status', '=', 'declined')->get();
        $projects_completed = Project::with('category', 'association')
            ->where('status', '=', 'completed')
            ->get();
        $projects_failed = Project::with('category', 'association')
            ->where('status', '=', 'failed')
            ->get();

        $projects_completed_partial = Project::with(['category', 'association', 'project_stopping' => function ($query) {
            $query->where('status', '=', 'accepted');
        }])->where('status', '=', 'completed_partial')
            ->get();
        $projects_pending_stopping = StoppingProject::with(['project' => function ($query) {
            $query->with('category', 'association');
        }])->where('status', '=', 'pending')
            ->get();
        $projects_declined_stopping = StoppingProject::with(['project' => function ($query) {
            $query->with('category', 'association');
        }])->where('status', '=', 'declined')
            ->get();

        return view('admin.projects.index', [
            'projects_accepted' => $projects_accepted,
            'projects_pending' => $projects_pending,
            'projects_declined' => $projects_declined,
            'projects_completed' => $projects_completed,
            'projects_failed' => $projects_failed,
            'projects_completed_partial' => $projects_completed_partial,
            'projects_pending_stopping' => $projects_pending_stopping,
            'projects_declined_stopping' => $projects_declined_stopping,
        ]);
    }

    public function stopping(Project $project)
    {
        $project->update([
            'status' => 'completed_partial',
        ]);
        return redirect()
            ->route('adminProjects.index')
            ->with('success', "Project $project->title is completed_partial!");
    }

    public function failed(Project $project)
    {
        $project->update([
            'status' => 'failed'
        ]);
        return redirect()
            ->route('adminProjects.index')
            ->with('success', "Project " . $project->title . "is failed!");
    }

    public function index()
    {
        $flashMessage = Session::get('success');
        $projects = Project::with(['category', 'association'])
            ->where('status', '=', 'pending')
            ->get();

        $projects_stopping = StoppingProject::with(['project' => function ($query) {
            $query->with('category');
            $query->with('association');
        }])->where('status', '=', 'pending')->get();


        return view('admin.projects.requests', [
            'projects' => $projects,
            'projects_stopping' => $projects_stopping,
            'flashMessage' => $flashMessage,
        ]);
    }


    public function update($id, $index)
    {
        $project = Project::findOrFail($id);

        $project->update([
            'status' => 'accepted',
            'start_period' => Carbon::now(),
            'end_period' => Carbon::now()->addDays($project->interval),
        ]);

        $association = Association::findOrFail($project->association_id);
        $project->association->notify(new NewProjectNotification($project, $association));

        if ($index === "home") {
            return redirect()
                ->route('adminHome.index')
                ->with('success', "Project $project->title is accepted!");
        } else {
            return redirect()
                ->route('requests.index')
                ->with('success', "Project $project->title is accepted!");
        }
    }

    public function destroy($id, $index)
    {
        $project = Project::findOrFail($id);
        $project->update([
            'status' => 'declined',
            'start_period' => Carbon::now(),
        ]);

        if ($index === "home") {
            return redirect()
                ->route('adminHome.index')
                ->with('success', "Project " . $project->title . "is declined!");
        } else {
            return redirect()
                ->route('requests.index')
                ->with('success', "Project " . $project->title . "is declined!");
        }
    }

    public function accept_stopping(StoppingProject $project, $index)
    {
        $project->update([
            'status' => 'accepted',
        ]);
        $original_project = Project::findOrFail($project->project_id);
        $original_project->update([
            'status' => 'completed_partial',
        ]);

        if ($index === "home") {
            return redirect()
                ->route('adminHome.index')
                ->with('success', "Project $original_project->title is accepted!");
        } else {
            return redirect()
                ->route('requests.index')
                ->with('success', "Project $original_project->title is accepted!");
        }
    }

    public function decline_stopping(StoppingProject $project, $index)
    {
        $project->update([
            'status' => 'declined'
        ]);

        if ($index === "home") {
            return redirect()
                ->route('adminHome.index')
                ->with('success', "Project " . $project->project->title . "is declined!");
        } else {
            return redirect()
                ->route('requests.index')
                ->with('success', "Project " . $project->project->title . "is declined!");
        }
    }

}

