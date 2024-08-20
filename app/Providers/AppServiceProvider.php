<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use App\Http\Middleware\DebugRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\MahasiswaController;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      Paginator::useBootstrap();
      URL::forceRootUrl(Config::get('app.url'));
      if (Str::contains(Config::get('app.url'), 'https://')) {
        URL::forceScheme('https');
      }
    }
}
