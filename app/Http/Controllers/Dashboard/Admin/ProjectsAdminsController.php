<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Models\Basket;
use App\Models\Project;
use App\Models\StoppingProject;
use App\Notifications\NewProjectNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ProjectsAdminsController extends Controller
{
    public function index()
    {
        return view('admin.projects.index');
    }

    //            $table->enum('status', ['accepted', 'declined', 'failed', 'completed_partial', 'declined_stopping']);

    public function ajax_project_accept()
    {
        $projects_accepted = Project::with('category:id,name', 'association:id,name')
            ->where('status', '=', 'accepted')->get();

        return Datatables::of($projects_accepted)
            ->editColumn('association', function ($drawings) {
                return $drawings->association->name;
            })->editColumn('remaining_amount', function ($drawings) {
                return $drawings->remaining_amount ?? 0;
            })->editColumn('remaining_days', function ($drawings) {
                return $drawings->remaining_days ?? 0;
            })->editColumn('category', function ($drawings) {
                return $drawings->category->name;
            })->make(true);

    }

    public function ajax_project_pending()
    {
        $projects_pending = Project::with('category', 'association')
            ->where('status', '=', 'pending')->get();
        return Datatables::of($projects_pending)
            ->editColumn('association', function ($drawings) {
                return $drawings->association->name;
            })->editColumn('category', function ($drawings) {
                return $drawings->category->name;
            })->make(true);
    }

    public function ajax_project_declined()
    {
        $projects_declined = Project::with('category', 'association')
            ->where('status', '=', 'declined')->get();
        return Datatables::of($projects_declined)
            ->editColumn('association', function ($drawings) {
                return $drawings->association->name;
            })->editColumn('category', function ($drawings) {
                return $drawings->category->name;
            })->make(true);
    }

    public function ajax_project_pending_stopping()
    {
        $projects_pending_stopping = StoppingProject::with(['project' => function ($query) {
            $query->with('category', 'association');
        }])->where('status', '=', 'pending')
            ->get();

        return Datatables::of($projects_pending_stopping)
            ->editColumn('association', function ($drawings) {
                return $drawings->project->association->name;
            })->editColumn('category', function ($drawings) {
                return $drawings->project->category->name;
            })->editColumn('title', function ($drawings) {
                return $drawings->project->title;
            })->editColumn('require_amount', function ($drawings) {
                return $drawings->project->require_amount;
            })->editColumn('remaining_amount', function ($drawings) {
                return $drawings->project->remaining_amount ?? 0;
            })->editColumn('remaining_days', function ($drawings) {
                return $drawings->project->remaining_days ?? 0;
            })
//            ->editColumn('action', function ($drawings) {
//                $btn = '<button  style="display: inline-block" id="project_' . $drawings->project->id . '"  data-id= "' . $drawings->project->id . '"
//                data-original-title="show"  class="btn btn-sm btn-primary show_project_pending_stopping">show</button>';
//
//                $btn = $btn . '<button  style="display: inline-block" id="project_' . $drawings->project->id . '"  data-id= "' . $drawings->project->id . '"
//                data-original-title="accept"  class="btn btn-sm btn-success accept_project_pending_stopping">accept</button>';
//
//                $btn = $btn . '<button  style="display: inline-block" id="project_' . $drawings->project->id . '"  data-id= "' . $drawings->project->id . '"
//                data-original-title="decliened"  class="btn btn-sm btn-danger declined_project_pending_stopping">decliened</button>';
//
//                return $btn;
//            })
            ->make(true);
    }

    public function ajax_project_declined_stopping()
    {
        $projects_declined_stopping = StoppingProject::with(['project' => function ($query) {
            $query->with('category:id,name', 'association:id,name');
        }])->where('status', '=', 'declined')
            ->get();

        return Datatables::of($projects_declined_stopping)
            ->editColumn('association', function ($drawings) {
                return $drawings->project->association->name;
            })->editColumn('category', function ($drawings) {
                return $drawings->project->category->name;
            })->editColumn('title', function ($drawings) {
                return $drawings->project->title;
            })->editColumn('require_amount', function ($drawings) {
                return $drawings->project->require_amount;
            })->editColumn('remaining_amount', function ($drawings) {
                return $drawings->project->remaining_amount ?? 0;
            })->editColumn('remaining_days', function ($drawings) {
                return $drawings->project->remaining_days;
            })
//            ->editColumn('action', function ($drawings) {
//                $btn = '<button  style="display: inline-block" id="project_' . $drawings->project->id . '"  data-id= "' . $drawings->project->id . '"
//                data-original-title="show"  class="btn btn-sm btn-primary show_project_declined_stopping">show</button>';
//                return $btn;
//            })
            ->make(true);
    }

    public function ajax_project_completed_partial()
    {
        $projects_completed_partial = Project::with(['category:id,name', 'association:id,name'])
            ->where('status', '=', 'completed_partial')
            ->get();

        return $this->getDatatables($projects_completed_partial);
    }

    public function ajax_project_completed()
    {
        $projects_completed = Project::with(['category:id,name', 'association:id,name'])
            ->where('status', '=', 'completed')
            ->get();

        return $this->getDatatables($projects_completed);
    }

    public function ajax_project_pending_failed()
    {
        $projects_pending_failed = StoppingProject::with(['project' => function ($query) {
            $query->with('category', 'association');
        }])->where('status', '=', 'pending_failed')
            ->get();

        return Datatables::of($projects_pending_failed)
            ->editColumn('association', function ($drawings) {
                return $drawings->project->association->name;
            })->editColumn('category', function ($drawings) {
                return $drawings->project->category->name;
            })->editColumn('title', function ($drawings) {
                return $drawings->project->title;
            })->editColumn('require_amount', function ($drawings) {
                return $drawings->project->require_amount;
            })->editColumn('remaining_amount', function ($drawings) {
                return $drawings->project->remaining_amount ?? 0;
            })->editColumn('remaining_days', function ($drawings) {
                return $drawings->project->remaining_days ?? 0;
            })
            ->make(true);
    }

    public function ajax_project_failed()
    {
        $projects_failed = Project::with(['category:id,name', 'association:id,name'])
            ->where('status', '=', 'failed')
            ->get();

        return $this->getDatatables($projects_failed);
    }


    public function ajax_project_declined_failed()
    {
        $projects_declined_stopping = StoppingProject::with(['project' => function ($query) {
            $query->with('category:id,name', 'association:id,name');
        }])->where('status', '=', 'declined_failed')
            ->get();

        return Datatables::of($projects_declined_stopping)
            ->editColumn('association', function ($drawings) {
                return $drawings->project->association->name;
            })->editColumn('category', function ($drawings) {
                return $drawings->project->category->name;
            })->editColumn('title', function ($drawings) {
                return $drawings->project->title;
            })->editColumn('require_amount', function ($drawings) {
                return $drawings->project->require_amount;
            })->editColumn('remaining_amount', function ($drawings) {
                return $drawings->project->remaining_amount ?? 0;
            })->editColumn('remaining_days', function ($drawings) {
                return $drawings->project->remaining_days;
            })
            ->make(true);
    }


    public function ajax_show_project_accept(Project $project)
    {
        $admin = Auth::user();
        if ($admin->is_super_admin === 1) {
            $projects_accepted = Project::with('category:id,name', 'association:id,name', 'monitor_status_of_projects.admin_project')
                ->where('status', '=', 'accepted')
                ->where('id', '=', $project->id)->get();
        } else {
            $projects_accepted = Project::with('category:id,name', 'association:id,name')
                ->where('status', '=', 'accepted')
                ->where('id', '=', $project->id)->get();
        }
        return response()->json(['project' => $projects_accepted]);
    }

    public function ajax_show_project_pending(Project $project)
    {
        $projects_pending = Project::with('category', 'association')
            ->where('status', '=', 'pending')
            ->where('id', '=', $project->id)->get();
        return response()->json(['project' => $projects_pending]);

    }

    public function ajax_show_project_declined(Project $project)
    {
        $admin = Auth::user();
        if ($admin->is_super_admin === 1) {
            $projects_declined = Project::with('category', 'association', 'monitor_status_of_projects.admin_project')
                ->where('status', '=', 'declined')
                ->where('id', '=', $project->id)->get();
        } else {
            $projects_declined = Project::with('category', 'association')
                ->where('status', '=', 'declined')
                ->where('id', '=', $project->id)->get();
        }
        return response()->json(['project' => $projects_declined]);

    }

    public function ajax_show_project_pending_stopping(StoppingProject $project)
    {
        $projects_pending_stopping = StoppingProject::with(['project' => function ($query) use ($project) {
            $query->with('category', 'association', 'monitor_status_of_projects.admin_project');
            $query->where('id', '=', $project->project_id);
        }
        ])->where('status', '=', 'pending')
            ->where('id', '=', $project->id)

            ->get();

        return response()->json(['project' => $projects_pending_stopping]);
    }

    public function ajax_show_project_declined_stopping(StoppingProject $project)
    {
        $admin = Auth::user();
        if ($admin->is_super_admin === 1) {
            $projects_declined_stopping = StoppingProject::with(['project' => function ($query) use ($project) {
                $query->with('category:id,name', 'association:id,name', 'monitor_status_of_projects.admin_project');
                $query->where('id', '=', $project->project_id);
            }])->where('status', '=', 'declined')
                ->where('id', '=', $project->id)
                ->get();
        } else {
            $projects_declined_stopping = StoppingProject::with(['project' => function ($query) use ($project) {
                $query->with('category:id,name', 'association:id,name');
                $query->where('id', '=', $project->project_id);
            }
            ])->where('status', '=', 'declined')
                ->where('id', '=', $project->id)
                ->get();
        }
        return response()->json(['project' => $projects_declined_stopping]);

    }

    public function ajax_show_project_completed_partial(Project $project)
    {
        $admin = Auth::user();
        if ($admin->is_super_admin === 1) {
            $projects_completed_partial = Project::with(['category:id,name', 'association:id,name', 'monitor_status_of_projects.admin_project'])
                ->where('status', '=', 'completed_partial')
                ->where('id', '=', $project->id)
                ->get();
        } else {
            $projects_completed_partial = Project::with(['category:id,name', 'association:id,name'])
                ->where('status', '=', 'completed_partial')
                ->where('id', '=', $project->id)
                ->get();
        }
        return response()->json(['project' => $projects_completed_partial]);

    }

    public function ajax_show_project_completed(Project $project)
    {
        $projects_completed = Project::with(['category:id,name', 'association:id,name'])
            ->where('status', '=', 'completed')
            ->where('id', '=', $project->id)
            ->get();

        return response()->json(['project' => $projects_completed]);
    }

    public function ajax_show_project_failed(Project $project)
    {
        $admin = Auth::user();
        if ($admin->is_super_admin === 1) {
            $projects_failed = Project::with(['category:id,name', 'association:id,name', 'project_stopping', 'monitor_status_of_projects.admin_project'])
                ->where('status', '=', 'failed')
                ->where('id', '=', $project->id)
                ->get();
        } else {
            $projects_failed = Project::with(['category:id,name', 'association:id,name', 'project_stopping'])
                ->where('status', '=', 'failed')
                ->where('id', '=', $project->id)
                ->get();
        }
        return response()->json(['project' => $projects_failed]);

    }


    public function ajax_show_project_pending_failed(StoppingProject $project)
    {
        $projects_pending_stopping = StoppingProject::with(['project' => function ($query) use ($project) {
            $query->with('category', 'association', 'monitor_status_of_projects.admin_project');
            $query->where('id', '=', $project->project_id);
        }
        ])->where('id', '=', $project->id)
            ->where('status', '=', 'pending_failed')
            ->get();

        return response()->json(['project' => $projects_pending_stopping]);
    }


    public function getDatatables($projects)
    {
        return Datatables::of($projects)
            ->editColumn('association', function ($drawings) {
                return $drawings->association->name;
            })->editColumn('category', function ($drawings) {
                return $drawings->category->name;
            })->editColumn('title', function ($drawings) {
                return $drawings->title;
            })->editColumn('received_amount', function ($drawings) {
                return $drawings->received_amount;
            })->editColumn('donation_period', function ($drawings) {
                return $drawings->donation_period ?? 0;
            })->editColumn('date_completed', function ($drawings) {
                return $drawings->updated_at ?? 0;
            })->make(true);
    }
}

