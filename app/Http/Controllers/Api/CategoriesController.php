<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\SuccessResource;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function index()
    {
        $entries = Category::latest()->paginate();
        return [
            'data' => $entries,
            'status' => true,
            'message' => 'success process'
        ];
    }

    public function show(Category $category)
    {
        $entries = Category::with('projects:id,category_id,description,title')
            ->where('id', '=', $category->id)
            ->get();

//        $s= $entries->toArray();
        return [
            'status' => true,
            'data' => $entries[0]->projects ,
            'message' => 'suc',
        ];
    }

//    public function store(Request $request)
//    {
//        /*
//        DB::table('categories')->insert([
//        ['name' => 'كفارة', 'created_at'=>now(),'updated_at'=>now() ]
//        ]);
//        */
//        $category = Category::create($request->all());
//        return $category;
//    }

//    public function update(Request $request, $id)
//    {
//        $request->validate(['name' => ['sometimes', 'required', 'string', 'max:255']]);
//        $category = Category::findOrFail($id);
//        $category->update($request->all());
//        return $category;
//    }

//    public function destroy(Category $category)
//    {
//        $category->delete();
//        return [
//            'message' => 'Porject deleted',
//        ];
//    }
}
