<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot() {
        app('view');
        Blade::include('components.input', 'input');
        Blade::include('components.select', 'select');
        Blade::include('components.pager', 'pager');
    }
}
