<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AuthTokensController extends Controller
{

    public function createAccount(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required'
        ]);
        $user = User::create([
            'name' => $attr['name'],
            'password' => bcrypt($attr['password']),
            'email' => $attr['email']
        ]);

        if ($user) {
            $token = $user->createToken($request->name);
            $user->token = $token->plainTextToken;
            return new SuccessResource($user);
        }
        return Response::json([
            'message' => 'Invalid Register',
            'status' => false
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'device_name' => 'required', // device_name
        ]);
        $user = User::where('email', '=', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken($request->device_name);
            $user->token = $token->plainTextToken;
            $message = "message";
            return new SuccessResource($user);
        }
        return Response::json([
            'message' => 'Invalid credentials',
            'status' => false
        ], 200);
    }

    /*
        public function getCurrentTokens(Request $request)
        {
    //         request()->user()->currentAccessToken()->token
            $user = Auth::guard('sanctum')->user();

            return $request->user()->currentAccessToken()->token;
        }
    */

    public function destroyCurrentTokens()
    {
        $user = Auth::guard('sanctum')->user();
//        logOut from current device
        $user->currentAccessToken()->delete();
        return [
            'message' => 'Current Token deleted'
        ];
    }

    public function destroy()
    {
        $user = Auth::guard('sanctum')->user();
//        logOut from singel device
//        $user->tokens()->findOrFail($id)->delete();
//        logOut from singel device
        $user->tokens()->delete();
        return [
            'message' => 'LogOut, Deleted All Tokens ',
            'status' => true
        ];
    }
}
