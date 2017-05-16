<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('master', function($view)
        {
            $users = User::All();
            $view->with('users', $users);
        });

        view()->composer('users.index', function($view)
        {
            $user = Auth::user();
            $view->with('currentUser', $user);
        });

        view()->composer('users.editProfile', function($view)
        {
            $user = Auth::user();
            $view->with('currentUser', $user);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
