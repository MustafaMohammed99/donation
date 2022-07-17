<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Admin;
use App\Models\Association;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{

    public function register()
    {
        $request = request();
        if ($request->is('admin/*')  ) {
            Config::set('fortify.guard', 'admin');
            Config::set('fortify.prefix', 'admin');
            Config::set('fortify.home', '/dashboard/admin');

        }
        if ($request->is('association/*')) {
            Config::set('fortify.guard', 'association');
            Config::set('fortify.prefix', 'association');
            Config::set('fortify.home', '/dashboard/association');
        }
        $this->app->singleton(
            \Laravel\Fortify\Contracts\LogoutResponse::class,
            \App\Http\Responses\LogoutResponse::class
        );
//        $this->app->singleton(
//            \Laravel\Fortify\Contracts\LoginResponse::class,
//            \App\Http\Responses\LoginResponse::class
//        );

//        https://stackoverflow.com/questions/64074079/laravel-fortify-customize-authentication-redirect
//        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
//            public function toResponse($request)
//            {
//                $user= Auth::user();
//                dd(config('fortify.guard'));
//                if ($user instanceof Admin){
//                    return redirect('admin/login');
//                }elseif ($user instanceof Association){
//                    return redirect('association/login');
//                }
//            }
//        });
//
//
//        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
//            public function toResponse($request)
//            {
//                /**
//                 * @var User $user
//                 */
//                $user = $request->user();
//                return $request->wantsJson()
//                    ? response()->json(['two_factor' => false, 'email' => $user->email ])
//                    : redirect()->intended(Fortify::redirects('login'));
//            }
//        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {



        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string)$request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::viewPrefix('auth.');
    }
}
