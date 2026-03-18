<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Paginator::defaultView('pagination::simple-tailwind');
        Paginator::defaultSimpleView('pagination::simple-tailwind');

        View::composer('*', function ($view): void {
            $view->with('demoUser', Auth::user());
        });
    }
}
