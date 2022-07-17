<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function show()
    {
        $user = Auth::guard('sanctum')->user();

//        $user = User::with(['factories', 'basket'])
//            ->where('id', '=', $user->getAuthIdentifier())
//            ->get();
        return [
//            'pass' => decrypt($user->first()->password),
            'status' => true,
            'message' => 'Success Process :)',
            'data' => [
                'user' => $user,

            ],
        ];
    }


    public function update(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $request->validate([
            'password' => ['required'],
        ]);
        $result = $user->update([
            'password' => Hash::make($request['password']),
        ]);
        if ($result)
            return [
                'status' => true,
                'message' => 'Success update password :)',
                'data' => $result
            ]; else
            return [
                "message" => "update operation has been failed"
            ];
    }

}
