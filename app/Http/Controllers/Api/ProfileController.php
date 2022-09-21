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
            'data' => $user,
        ];
    }

    public function check_password(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $request->validate([
            'password' => ['required'],
        ]);


    }

    public function update(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $request->validate([
            'old_password' => ['required'],
            'new_password' => ['required'],
        ]);
        if (Hash::check($request->old_password, $user->password)) {

            $result = $user->update([
                'password' => Hash::make($request['password']),
            ]);
            return [
                'status' => true,
                'message' => 'Success update password :)',
                'data' => [
                    'check'=> $result
                ]
            ];
        }

        return [
            'status' => true,
            'message' => 'old password is not match :)',
            'data' => [
                'check'=> false
            ]
        ];

    }

}
