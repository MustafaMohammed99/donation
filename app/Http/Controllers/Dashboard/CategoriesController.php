<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::withCount([
            'projects'=>function($query){
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
        $request->validate($this->rules());
        $data = $request->all();
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
        $request->validate($this->rules());
        $category->update($request->all());
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
        'name' => ['required', 'string',],
    ];

    protected function rules()
    {
        $rules = $this->rules;
        return $rules;
    }
}
