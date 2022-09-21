<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AssociationsController extends Controller
{

    public function index()
    {
        $association = new Association;
        $flashMessage = Session::get('success');
        return view('admin.associations.index_ajax', compact('association', 'flashMessage'));
    }


    public function ajax()
    {
         $query = Association::get();
        return datatables($query)->make(true);
    }


    public function create()
    {
        $association = new Association;
        return view('admin.associations.create', compact('association'));
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());
        $data = $request->except('image_path');
        $data['image_path'] = $this->uploadImage_Path($request);
        $data['password'] = Hash::make($request->password);
// Project::create($request->all() + ['association_id' => $association->id, 'received_amount' => 0]);

        Association::create($data + ['is']);

        return redirect()
            ->route('associations.index')
            ->with('success', 'تم انشاء الجمعية بنجاح!');
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

        return view('admin.associations.show', [
            'association' => $association,
            'projects' => $projects,
        ]);
    }


    public function destroy(Association $association)
    {
        $result = $association->delete($association->id);
        return response()->json(['success' => 'تم حذف الجمعية بنجاح!' . $result]);
    }

    protected $rules = [
        'name' => ['required', 'string', 'unique:associations,name',],
        'email' => ['required', 'email', 'unique:associations,email'],
        'address' => ['required', 'string'],
        'password' => ['required',],
    ];

    protected function rules()
    {
        $rules = $this->rules;
        return $rules;
    }


    protected function uploadImage_Path(Request $request)
    {
        if (!$request->hasFile('image_path')) {
            return;
        }
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            if ($file->isValid()) {
                $path = $file->store('/associations', [
                    'disk' => 'uploads',
                ]);
            }
        }
        if ($path) {
            return 'uploads/' . $path;
        }
        return;
    }

}
