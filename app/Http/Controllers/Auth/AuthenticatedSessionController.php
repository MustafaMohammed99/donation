<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{

    protected $gurad = 'web';

    public function __construct(Request $request)
    {
        if ($request->is('admin/*')) {
            $this->gurad = 'admin';
        } elseif ($request->is('association/*')) {
            $this->gurad = 'association';
        }
    }

    public function create()
    {
        return view('auth.login', [
            'routePrefix' => $this->gurad == 'admin' ? "admin." : ($this->gurad == 'association' ? "association." : "")
        ]);
    }


    public function store(LoginRequest $request)
    {
        $request->authenticate($this->gurad);

        $request->session()->regenerate();

        return redirect()->intended(
            $this->gurad == "admin" ? "dashboard/admin/associations" : ($this->gurad == 'association' ? "dashboard/association/projects" : "/")
        );
    }


    public function destroy(Request $request)
    {
        Auth::guard($this->gurad)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect($this->gurad . '/login');
    }
}
