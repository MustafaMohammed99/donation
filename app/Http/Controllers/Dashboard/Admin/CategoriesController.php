<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Association;
use App\Models\Basket;
use App\Models\Category;
use App\Models\DeviceToken;
use App\Models\Project;
use App\Models\User;
use App\Notifications\MobileNotification;
use App\Notifications\NewProjectNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    public function index()
    {
//        $project = Project::find(43);
//        $user = User::find(10);
//        $deviceTokens = DeviceToken::with('user')->get();
//        foreach ($deviceTokens as $deviceToken) {
//            $deviceToken->user->notify(new MobileNotification($project, 'created',100));
//        }
//        $admins= Admin::all();
//        dd($admins);
//        foreach ($admins as $admin) {
//            $admin->notify(new NewProjectNotification($project, new Association(),'pending',''));
//        }

        $categories = Category::withCount([
            'projects' => function ($query) {
//                $query->where(function($query) {
//                    $query->where('status','=','accepted')
//                        ->orWhere('status','=','completed')
//                        ->orWhere('status','=','completed_partial');
//                });
            },])
            ->paginate(7);
        $flashMessage = Session::get('success');

        return view('admin.categories.index', [
            'categories' => $categories,
            'flashMessage' => $flashMessage,
        ]);
    }


    public function create()
    {
        $category = new Category;
        return view('admin.categories.create', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate($this->rules(new Category()));
        $data = $request->except('image_path');
        $data['image_path'] = $this->uploadImage_Path($request);
        Category::create($data);
        return redirect()
            ->route('categories.index')
            ->with('success', 'تم انشاء القسم بنجاح!');
    }

    public function show(Category $category)
    {
        $projects = Project::
//        where(function($query) {
//            $query->where('status','=','accepted')
//                ->orWhere('status','=','completed')
//                ->orWhere('status','=','completed_partial');
//        })
        where('category_id', '=', $category->id)
            ->get();

        return view('admin.categories.show', [
            'category' => $category,
            'projects' => $projects,
        ]);
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate($this->rules($category));
        $data = $request->except('image_path');
        $data['image_path'] = (($this->uploadImage_Path($request) ?? $category->image_path));

        $category->update($data);
        return redirect()
            ->route('categories.index')
            ->with('success', 'تم تحديث القسم بنجاح');
    }


    public function destroy($id)
    {
        Category::destroy($id);
        Session::flash('success', 'تم حذف القسم بنجاح :)');

        return redirect()->route('categories.index');
    }


    protected $rules = [
        'name' => ['required', 'unique:categories,name', 'string',],
        'image_path' => ['required', 'sometimes', 'image',],
    ];


    protected function rules($category)
    {
        return [
            'name' => ['required', 'string', Rule::unique('categories')->ignore($category)],
            'image_path' => ['required', 'sometimes', 'image',],

        ];
    }

    protected function uploadImage_Path(Request $request)
    {
        if (!$request->hasFile('image_path')) {
            return;
        }
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            if ($file->isValid()) {
                $path = $file->store('/categories', [
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
