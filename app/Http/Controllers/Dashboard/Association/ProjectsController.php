<?php

namespace App\Http\Controllers\Dashboard\Association;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Models\Category;
use App\Models\Project;
use App\Models\ProjectPath;
use App\Models\StoppingProject;
use App\Models\User;
use App\Notifications\NewProjectNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProjectsController extends Controller
{
    public function index()
    {

        $flashMessage = Session::get('success');
        $user = Auth::user();
        $projects_accepted = Project::with('category')
            ->where('status', '=', 'accepted')
            ->where('association_id', '=', $user->id)
            ->get();
        $projects_completed = Project::with('category')
            ->where('status', '=', 'completed')
            ->where('association_id', '=', $user->id)
            ->get();
        $projects_failed = Project::with('category')
            ->where('status', '=', 'failed')
            ->where('association_id', '=', $user->id)
            ->get();
        $projects_pending = Project::with('category')
            ->where('status', '=', 'pending')
            ->where('association_id', '=', $user->id)
            ->get();
        $projects_declined = Project::with('category')
            ->where('status', '=', 'declined')
            ->where('association_id', '=', $user->id)
            ->get();


        $projects_accepted_stopping = StoppingProject::with(['project' => function ($query) use ($user) {
            $query->with('category');
        }])->where('status', '=', 'accepted')
            ->where('association_id', '=', $user->id)
            ->get();

        $projects_pending_stopping = StoppingProject::with(['project' => function ($query) use ($user) {
            $query->with('category');
        }])->where('status', '=', 'pending')
            ->where('association_id', '=', $user->id)
            ->get();

        $projects_declined_stopping = StoppingProject::with(['project' => function ($query) use ($user) {
            $query->with('category');
        }])->where('status', '=', 'declined')
            ->where('association_id', '=', $user->id)
            ->get();


        return view('association.projects.index', [
            'projects_accepted' => $projects_accepted,
            'projects_completed' => $projects_completed,
            'projects_failed' => $projects_failed,
            'projects_pending' => $projects_pending,
            'projects_declined' => $projects_declined,
            'projects_accepted_stopping' => $projects_accepted_stopping,
            'projects_pending_stopping' => $projects_pending_stopping,
            'projects_declined_stopping' => $projects_declined_stopping,
            'flashMessage' => $flashMessage,
        ]);

    }

    public function create()
    {
        $categories = Category::all();
        $project = new Project();
        return view('association.projects.create', compact('project', 'categories'));
    }


    public function store(Request $request)
    {
        $association = Auth::user();
        $request->validate($this->rules());
        $project = Project::create($request->all() + ['association_id' => $association->id, 'received_amount' => 0]);
        $this->uploadImage_Path($request, $project->id);


        return redirect()
            ->route('projects.index')
            ->with('success', 'Project created!');
    }

    public function edit(Project $project)
    {
        $project_path = ProjectPath::where('project_id', '=', $project->id)->get();

        return view('association.projects.edit', [
            'project' => $project,
            'project_path' => $project_path
        ]);
    }

    public function update(Request $request, Project $project)
    {

        $this->uploadImage_Path($request, $project->id);

        return redirect()
            ->route('projects.index')
            ->with('success', "Project $project->title is accepted!");
    }


    public function detail_stopping(Project $project)
    {
        return view('association.projects.detail_stopping', compact('project'));
    }


    public function stopping(Request $request)
    {
        $request->validate($this->rules_stopping());
        StoppingProject::create($request->all() + ['association_id' => Auth::user()->getAuthIdentifier()]);
        return redirect()
            ->route('projects.index')
            ->with('success', 'Added Stopping Project :)');
    }

    protected function uploadImage_Path(Request $request, $id)
    {
        if (!$request->hasFile('image_path')) {
            return;
        }

        $files = $request->file('image_path');
        foreach ($files as $file) {
            if ($file->isValid()) {
                $path = $file->store('/projects', [
                    'disk' => 'uploads',
                ]);
                ProjectPath::create([
                    'project_id' => $id,
                    'image_path' => 'uploads/' . $path
                ]);
            }
        }

    }


    protected function rules()
    {
        $rules = $this->rules;
        return $rules;
    }

    protected $rules = [
        'title' => ['required', 'string'],
        'description' => ['required', 'string'],
        'category_id' => ['required', 'int', 'exists:categories,id'],
        'num_beneficiaries' => ['required', 'int'],
        'require_amount' => ['required', 'int'],
        'interval' => ['required', 'int'],
        'price_stock' => ['required', 'int'],
        'image_path' => ['required'],
    ];

    protected function rules_stopping()
    {
        $rules = $this->rules_Stopping;
        return $rules;
    }


    protected $rules_Stopping = [
        'reason_stopping' => ['required', 'string'],
        'project_id' => ['required', 'int'],
    ];


}
