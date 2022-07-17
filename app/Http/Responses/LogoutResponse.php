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

class   LogoutResponse implements LogoutResponseContract
{

    public function toResponse($request)
    {

//        $user = Auth::guard(config('fortify.guard'))->user();

        dd( "session" . Session::get("type_user"));
        if (config('fortify.guard') === "admin") {
            Session::put('type_user', "admin");
        } elseif (config('fortify.guard') === "association") {
            Session::put('type_user', "association");
        }
    }
}
