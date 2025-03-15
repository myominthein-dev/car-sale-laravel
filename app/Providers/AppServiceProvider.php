<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Force HTTPS in production
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
        
        // Override the serve command if it exists
        if ($this->app->runningInConsole()) {
            $this->app->extend('command.serve', function () {
                return new \App\Console\Commands\ServeCommand;
            });
        }
    }
}