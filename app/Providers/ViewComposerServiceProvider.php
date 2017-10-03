<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeAuthUser();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function composeAuthUser()
    {
        view()->composer(['*'], function ($view) {
            $authUser = Auth::user();
            $isLoggedIn = Auth::check();
            $view->with(compact('authUser', 'isLoggedIn'));
        });
    }
}
