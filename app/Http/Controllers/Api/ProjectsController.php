<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\SuccessResource;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;
use function Symfony\Component\String\s;

class ProjectsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->except(['index', 'show', 'search', 'home']);
    }

    public function index()
    {
        $entries = Project::latest()
            ->with([
                'category',
                'association:id,name,address,email',
                'projects_paths'
            ])
            ->where('status', '=', 'accepted')
            ->get();

        return new SuccessResource($entries);
    }

    public function home()
    {
        $entries = Project::with([
            'category',
            'association:id,name,address,email',
            'projects_paths'
        ])
            ->where('status', '=', 'accepted')
            ->latest()->take(3)->get();

        $categories = Category::get();
        $sum_received_amount = Project::where('status', '=', 'accepted')->sum('received_amount');
        $sum_num_beneficiaries = Project::where('status', '=', 'accepted')->sum('num_beneficiaries');
        $count_project = Project::where('status', '=', 'accepted')->count();

        return [
            'status' => true,
            'message' => 'Success Process :)',
            'data' => [
                'count_project' => $count_project,
                'sum_received_amount' => $sum_received_amount,
                'sum_num_beneficiaries' => (int)$sum_num_beneficiaries,
                'banners' => $categories,
                'projects' =>  ProjectResource::collection($entries),
            ],
        ];
    }


    public function show(Project $project)
    {
        $entries = Project::with([
            'category',
            'association:id,name,address,email',
            'projects_paths'
        ])->where('id', '=', $project->id)
            ->where('status', '=', 'accepted')
            ->get();
        return new ProjectResource($entries[0]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'received_amount' => ['sometimes', 'numeric', 'min:0'],
        ]);
        $project = Project::findOrFail($id);
        $result = $project->update([
            'received_amount' => $request->received_amount + $project->received_amount
        ]);

        if ($result)
            return new SuccessResource($project);
        else
            return [
                "message" => "update operation has been failed"
            ];
    }

    public function search(Request $request)
    {
        $result = Project::with('projects_paths')->where('status', '=', 'accepted')
            ->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
//                $query->orWhere('description', 'like', '%' . $request->search . '%');
            })
            ->get();

        if ($result)
            return [
                'data' => ['data' => $result],
                'status' => true,
                'message' => 'Success Process:)'
            ];
        else
            return [
                'message' => $request->title . 'not found'
            ];
    }



//    public function store(Request $request)
//    {
//        $request->validate([
//            'title' => ['required', 'string', 'max:255'],
//            'description' => ['required', 'string'],
//            'status' => ['required', 'in:pending,accepted,declined'],
//            'budget' => ['nullable', 'numeric', 'min:0'],
//        ]);
//        $project = Project::create($request->all());
//        return $project;
//    }

//    public function destroy(Project $project)
//    {
//        $result = $project->delete();
//        if ($result)
//            return new SuccessResource($project);
//        else
//            return [
//                "message" => "deleted operation has been failed"
//            ];
//    }

}
