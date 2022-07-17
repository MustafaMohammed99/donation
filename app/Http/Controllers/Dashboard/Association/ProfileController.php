<?php

namespace App\Http\Controllers\Dashboard\Association;

use App\Http\Controllers\Controller;
use App\Models\Association;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $association = Auth::user();
        return view('association.profile.edit', compact('association'));
    }

    public function update(Request $request)
    {
        $association = Auth::user();
        $request->validate($this->rules());

        $data = $request->except('image_path');
        $data['image_path'] = (($this->uploadImage_Path($request) ?? $association->image_path));
//        dd($data);
        $association->update($data);


        return redirect()
            ->route('associationHome.index')
            ->with('success', 'Associations updated!');
    }

    protected $rules = [
        'name' => ['required', 'string',],
        'email' => ['required', 'email'],
        'address' => ['required', 'string'],
        'image_path' => ['required', 'sometimes', 'image',],

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
