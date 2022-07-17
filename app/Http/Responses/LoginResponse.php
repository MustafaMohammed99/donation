<?php

namespace App\Http\Responses;

use App\Models\Admin;
use App\Models\Association;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
use Symfony\Component\HttpFoundation\Response;

class   LoginResponse implements LogoutResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function toResponse($request)
    {
//        https://stackoverflow.com/questions/64074079/laravel-fortify-customize-authentication-redirect
//        $user= Auth::guard(config('fortify.guard'))->user();
        if (config('fortify.guard') === "admin") {
            Session::put('type_user', "admin");
        } elseif (config('fortify.guard') === "association") {
            Session::put('type_user', "association");
        }

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect(config('fortify.home'));
    }
}
