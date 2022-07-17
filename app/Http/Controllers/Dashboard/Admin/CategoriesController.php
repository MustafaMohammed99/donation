<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::withCount([
            'projects' => function ($query) {
                $query->where('status', '=', 'accepted');
            },])
            ->paginate(3);
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
            ->with('success', 'Categories created!');
    }

    public function show(Category $category)
    {
        $projects = Project::where('status', '=', 'accepted')
            ->where('category_id', '=', $category->id)
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
            ->with('success', 'Category updated!');
    }


    public function destroy($id)
    {
        Category::destroy($id);
        Session::flash('success', 'deleted Category :)');

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
