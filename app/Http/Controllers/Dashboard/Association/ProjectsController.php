<?php

namespace App\Http\Controllers\Dashboard\Association;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProjectsController extends Controller
{
    public function index()
    {
        $flashMessage = Session::get('success');

        $projects_accepted = Project::with('category')
            ->where('status', '=', 'accepted')
            ->paginate(3);
        $projects_pending = Project::with('category')
            ->where('status', '=', 'pending')
            ->paginate(3);
        $projects_declined = Project::with('category')
            ->where('status', '=', 'declined')
            ->paginate(3);

        return view('association.projects.index', [
            'projects_accepted' => $projects_accepted,
            'projects_pending' => $projects_pending,
            'projects_declined' => $projects_declined,
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
        $request->validate($this->rules());
//        $request->association_id = 1;
        Project::create($request->all() + ['association_id' => 1]);
        return redirect()
            ->route('projects.index')
            ->with('success', 'Project created!');
    }


    public function destroy($id)
    {
        Project::destroy($id);
        Session::flash('success', 'deleted Project :)');
        return redirect()->route('projects.index');
    }


    protected $rules = [
        'title' => ['required', 'string'],
        'description' => ['required', 'string'],
        'category_id' => ['required', 'int', 'exists:categories,id'],
        'num_beneficiaries' => ['required', 'int'],
        'require_amount' => ['required', 'int'],
        'price_stock' => ['required', 'int'],
    ];

    protected function rules()
    {
//        $rules = [
////            'status' => 'required|in:Released,UnReleased',
////            'interval' => [
////                'nullable',
////                'digits:4',
////                function ($attribute, $value, $fail) {
////                    $status = Input::get('status'); // Retrieve status
////
////                    if ($status === 'Released' ) {
////                        return $fail($attribute . ' is invalid.');
////                    }
////                },
////            ],
//
//        ];
        $rules = $this->rules;
        return $rules;
    }



    //    public function show(Project $project)
//    {
//        $projects = Project::where('status', '=', 'accepted')
//            ->where('category_id', '=', $category->id)
//            ->get();
//
//        return view('admin.categories.show', [
//            'category' => $category,
//            'projects' => $projects,
//        ]);
//    }
}
