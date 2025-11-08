<?php

namespace LaravelGpt\Vscode\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaravelGpt\Vscode\VscodeLaravelGit
 */
class VscodeLaravelGit extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'vscode-laravel-git';
    }
}