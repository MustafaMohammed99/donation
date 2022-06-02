<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AssociationsController extends Controller
{

    public function index()
    {
        $associations = Association::paginate(3);
        $flashMessage = Session::get('success');

        return view('admin.associations.index', [
            'associations' => $associations,
            'title' => 'Associations',
            'flashMessage' => $flashMessage,
        ]);
    }


    public function create()
    {
        $association = new Association;
        return view('admin.associations.create', compact('association'));
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());
        $data = $request->all();
        Association::create($data);

        return redirect()
            ->route('associations.index')
            ->with('success', 'Associations created!');
    }


    public function show(Association $association)
    {
        $projects = Project::latest()
            ->with([
                'category',
            ])
//            ->where('status', '=', 'accepted')
            ->where('association_id', '=', $association->id)
            ->get();

//        dd($projects);

        return view('admin.associations.show', [
            'association' => $association,
            'projects' => $projects,
        ]);
    }


//    public function edit($id)
//    {
//        $association = Association::findOrFail($id);
//        return view('admin.associations.edit', compact('association'));
//    }

//    public function update(Request $request, Association $association)
//    {
//        $request->validate($this->rules());
//        $association->update($request->all());
//
//        return redirect()
//            ->route('associations.index')
//            ->with('success', 'Associations updated!');
//    }


    public function destroy($id)
    {
        Association::destroy($id);
        Session::flash('success', 'deleted Associations :)');

        return redirect()->route('associations.index');
    }


    protected $rules = [
        'name' => ['required', 'string',],
        'email' => ['required', 'email'],
        'address' => ['required', 'string'],
        'password' => ['required',],
    ];

    protected function rules()
    {
        $rules = $this->rules;
        return $rules;
    }
}
