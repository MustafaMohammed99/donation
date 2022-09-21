<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Models\Basket;
use App\Models\DeviceToken;
use App\Models\Monitor_status_of_project;
use App\Models\Project;
use App\Models\StoppingProject;
use App\Models\User;
use App\Notifications\MobileNotification;
use App\Notifications\NewProjectNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RequestsController extends Controller
{
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

//            pending   ------ accepted
//                      ------ declined
//            accepted  ------ completed_partial
//                      ------ failed
//            pending_stopping
//                      ------ completed_partial
//                      ------ declined_stopping
//            pending_failed
//                      ------ accepted_failed
//                      ------ declined_failed
//            $table->enum('before_edit', ['pending', 'accepted', 'pending_stopping']);
//            $table->enum('status', ['accepted', 'declined', 'failed', 'completed_partial', 'declined_stopping']);

    public function update(Project $project)
    {

        $project->update([
            'status' => 'accepted',
            'start_period' => Carbon::now(),
            'end_period' => Carbon::now()->addDays($project->interval),
        ]);
        $this->monitor_project($project->id, 'pending', 'accepted');

        $association = Association::findOrFail($project->association_id);
        $project->association->notify(new NewProjectNotification($project, $association, 'accepted',''));

        $deviceTokens = DeviceToken::with('user')->get();
        foreach ($deviceTokens as $deviceToken) {
            $deviceToken->user->notify(new MobileNotification($project, 'accepted',100,''));
        }

          return response()->json(['success' => 'تم قبول المشروع  بنجاح!']);
    }

    public function destroy(Project $project)
    {
        $project->update([
            'status' => 'declined',
        ]);
        $association = Association::findOrFail($project->association_id);
        $project->association->notify(new NewProjectNotification($project, $association, 'destroy', $project->stopping_reason));

        $this->monitor_project($project->id, 'pending', 'declined');

        return response()->json(['success' => 'تم رفض  المشروع  بنجاح!']);
    }

    public function stopping(Project $project, $reason_failed)
    {
        $project->update([
            'status' => 'completed_partial',
        ]);
        $stoppingProject = StoppingProject::where('project_id', '=', $project->id)->get();

        if (count($stoppingProject) === 0) {
            StoppingProject::create([
                'project_id' => $project->id,
                'association_id' => $project->association_id,
                'status' => 'accepted',
                'reason_stopping' => $reason_failed
            ]);
        } else {
            StoppingProject::where('project_id', '=', $project->id)->update([
                'status' => 'accepted',
                'reason_stopping' => $reason_failed
            ]);
        }
        $association = Association::findOrFail($project->association_id);
        $project->association->notify(new NewProjectNotification($project, $association, 'stopping', $reason_failed));

        $this->monitor_project($project->id, 'accepted', 'completed_partial');
        return response()->json(['success' => 'تم ايقاف المشروع  بنجاح!']);
    }

    public function failed(Project $project, $reason_failed)
    {
        $project->update([
            'status' => 'failed'
        ]);

        $stoppingProject = StoppingProject::where('project_id', '=', $project->id)->get();

        if (count($stoppingProject) === 0) {
            StoppingProject::create([
                'project_id' => $project->id,
                'association_id' => $project->association_id,
                'status' => 'accepted_failed',
                'reason_stopping' => $reason_failed
            ]);
        } else {
            StoppingProject::where('project_id', '=', $project->id)->update([
                'status' => 'accepted_failed',
                'reason_stopping' => $reason_failed
            ]);
        }
        $association = Association::findOrFail($project->association_id);
        $project->association->notify(new NewProjectNotification($project, $association, 'failed', $reason_failed));

        $basket_users = Basket::with('user')
            ->where('project_id', '=', $project->id)->get();
        foreach ($basket_users as $user_basket) {
            $user_basket->user->notify(new MobileNotification($project, 'failed', $user_basket->amount, $reason_failed));
        }

        $this->monitor_project($project->id, 'accepted', 'failed');
        return response()->json(['success' => 'تم إلغاء المشروع  بنجاح!']);
    }

    public function accept_stopping(StoppingProject $project)
    {
        $project->update([
            'status' => 'accepted',
        ]);

        $original_project = Project::findOrFail($project->project_id);
        $original_project->update([
            'status' => 'completed_partial',
        ]);
        $association = Association::findOrFail($project->association_id);
        $project->association->notify(new NewProjectNotification($original_project, $association, 'accepted_stopping', $project->stopping_reason));


        $this->monitor_project($original_project->id, 'pending_stopping', 'completed_partial');

        return response()->json(['success' => 'تم قبول توقيف  المشروع  بنجاح!']);
    }

    public function decline_stopping(StoppingProject $project)
    {
        $project->update([
            'status' => 'declined'
        ]);
        $original_project = Project::findOrFail($project->project_id);
        $association = Association::findOrFail($project->association_id);
        $project->association->notify(new NewProjectNotification($original_project, $association, 'decline_stopping', $project->stopping_reason));

        $this->monitor_project($original_project->id, 'pending_stopping', 'declined_stopping');
        return response()->json(['success' => 'تم رفض توقيف المشروع  بنجاح!']);
    }

    public function accept_failed(StoppingProject $project)
    {
        $project->update([
            'status' => 'accepted_failed',
        ]);

        $original_project = Project::findOrFail($project->project_id);
        $original_project->update([
            'status' => 'failed',
        ]);
        $basket_users = Basket::with('user')
            ->where('project_id', '=', $project->id)->get();

        $association = Association::findOrFail($project->association_id);
        $project->association->notify(new NewProjectNotification($original_project, $association, 'accept_failed', $project->stopping_reason));

        foreach ($basket_users as $user_basket) {
            $user_basket->user->notify(new MobileNotification($original_project, 'failed', $user_basket->amount, $project->reason_stopping));
        }

        $this->monitor_project($original_project->id, 'pending_failed', 'accepted_failed');

        return response()->json(['success' => 'تم قبول توقيف  المشروع  بنجاح!']);
    }

    public function decline_failed(StoppingProject $project)
    {
        $project->update([
            'status' => 'declined_failed'
        ]);

        $original_project = Project::findOrFail($project->project_id);

        $association = Association::findOrFail($project->association_id);
        $project->association->notify(new NewProjectNotification($original_project, $association, 'decline_failed', $project->stopping_reason));

        $this->monitor_project($original_project->id, 'pending_failed', 'declined_failed');
        return response()->json(['success' => 'تم رفض توقيف المشروع  بنجاح!']);
    }


    private function monitor_project($project_id, $status_before_edit, $status)
    {
        $admin = Auth::user();
        Monitor_status_of_project::create([
            'admin_id' => $admin->getAuthIdentifier(),
            'project_id' => $project_id,
            'before_edit' => $status_before_edit,
            'status' => $status,
        ]);
    }
}
