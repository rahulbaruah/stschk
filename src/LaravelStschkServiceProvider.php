<?php

namespace Rahxcr\LaravelStschk;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Rahxcr\LaravelStschk\Http\Middleware\CheckSystemStatus;
use Rahxcr\LaravelStschk\Console\GetSystemId;

class LaravelStschkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-stschk');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-stschk');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');
        
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(CheckSystemStatus::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-stschk.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-stschk'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-stschk'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-stschk'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
            
            $this->commands([
                GetSystemId::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-stschk');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-stschk', function () {
            return new LaravelStschk;
        });
    }
}
