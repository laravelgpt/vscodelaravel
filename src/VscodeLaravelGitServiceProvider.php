<?php

namespace LaravelGpt\Vscode;

use Illuminate\Support\ServiceProvider;
use LaravelGpt\Vscode\Console\Commands\GitStatusCommand;

class VscodeLaravelGitServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'vscode-laravel-git');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'vscode-laravel-git');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        // Publishing config file
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('vscode-laravel-git.php'),
        ], 'config');

        // Registering package commands.
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Commands\GitStatusCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'vscode-laravel-git');

        // Register the main class to use with the facade
        $this->app->singleton('vscode-laravel-git', function ($app) {
            return new VscodeLaravelGit;
        });

        // Register the facade
        $this->app->alias('vscode-laravel-git', \LaravelGpt\Vscode\VscodeLaravelGit::class);

        // Register events
        $this->app->make('events')->listen('vscode.git.commit', function ($event) {
            // Handle commit event
        });
    }
}