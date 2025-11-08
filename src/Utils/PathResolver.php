<?php

namespace LaravelGpt\Vscode\Utils;

class PathResolver
{
    /**
     * Resolve the base path for Git operations
     *
     * @param string|null $path
     * @return string
     */
    public static function resolveBasePath(?string $path = null): string
    {
        if ($path) {
            return $path;
        }
        
        // Try to get from config first
        if (function_exists('config')) {
            try {
                $configPath = config('vscode-laravel-git.default_path');
                if ($configPath) {
                    return $configPath;
                }
            } catch (\Exception $e) {
                // Config not available, continue with other methods
            }
        }
        
        // Try to use Laravel's base_path helper if available and in Laravel context
        if (function_exists('base_path')) {
            try {
                // Check if we're in a Laravel context
                if (function_exists('app') && app() && method_exists(app(), 'basePath')) {
                    return \base_path();
                }
            } catch (\Exception $e) {
                // If we can't access the Laravel app, fall back to other methods
            }
        }
        
        // Fallback to current working directory
        return getcwd() ?: dirname(__DIR__, 3);
    }
}