<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Association;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;


class AdminsController extends Controller
{

    public function index()
    {
        $flashMessage = Session::get('success');
        return view('admin.admins.index', compact('flashMessage'));
    }


    public function ajax()
    {
        $admins = Admin::get();
//        return datatables($query)->make(true);
        return Datatables::of($admins)
            ->editColumn('isSuperAdmin', function ($drawings) {
                if ($drawings->is_super_admin === 1) {
                    return 'مشرف متميز';
                }
                return 'مشرف طبيعي';
            })->make(true);
    }


    public function create()
    {
        $admin = new Admin();
        $address = [
            'gaza' => 'gaza',
            'kan-younes' => 'kan-younes',
            'al-wsta' => 'al-wsta',
            'al-shmal' => 'al-shmal',
            'rafah' => 'rafah'];
        return view('admin.admins.create', compact('admin', 'address'));
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());
        $data = $request->except('image_path', 'is_super_admin');
        $data['image_path'] = $this->uploadImage_Path($request);
        $data['password'] = Hash::make($request->password);
        if ($request->has('is_super_admin')) {
            //Checkbox checked
            Admin::create($data + ['is_super_admin' => 1]);
        } else {
            //Checkbox not checked
            Admin::create($data + ['is_super_admin' => 0]);
        }

        return redirect()
            ->route('admins.index')
            ->with('success', 'تم انشاء المشرف بنجاح!');
    }

    public function show(Admin $admin)
    {
////        dd($admin);
//        $projects = Admin::with(['admin_monitor_status_of_projects' => function ($query) {
//            $query->with(['project_monitor' => function ($q) use ($query) {
//                $q->with('association', 'category');
//                $query->where('project_id', '=', $q->project_id);
//            }]);
//        }])->where('id', '=', $admin->id)
//            ->get();
//

//        return view('admin.admins.show', [
//            'admin' => $admin,
//            'projects' => $projects,
//        ]);
        return redirect()
            ->route('admins.index');
    }

    public function destroy(Admin $admin)
    {
        $result = $admin->delete($admin->id);
        return response()->json(['success' => 'تم حذف المشرف بنجاح!' . $result]);
    }

    protected $rules = [
        'name' => ['required', 'string', 'unique:admins,name',],
        'email' => ['required', 'email', 'unique:admins,email'],
        'address' => ['required', 'in:gaza,kan-younes,al-wsta,al-shmal,rafah'],
        'password' => ['required',],
        'image_path' => ['required',],
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
                $path = $file->store('/admins', [
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
