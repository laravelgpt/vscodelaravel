<?php

/*
 * Laravel VS Code Git Package Configuration
 *
 * This configuration file contains all the settings needed for the package to work
 * in production environments without additional setup.
 */
return [
    /*
     * The default path for Git operations
     * 
     * Set this to your project root directory if you want to restrict Git operations
     * to a specific path. Leave empty to use the Laravel base path or current working directory.
     * 
     * Example: base_path() or '/var/www/html/my-project'
     */
    'default_path' => '',

    /*
     * Git binary path
     * 
     * Specify the full path to the Git binary if it's not in your system PATH.
     * This is especially useful in production environments where Git might be
     * installed in a non-standard location.
     * 
     * Example: '/usr/bin/git' or 'C:\Program Files\Git\bin\git.exe'
     */
    'git_binary_path' => 'git',

    /*
     * Maximum execution time for Git commands (in seconds)
     * 
     * Set a timeout for Git operations to prevent hanging processes in production.
     * Set to 0 for no timeout (not recommended for production).
     */
    'max_execution_time' => 30,

    /*
     * Enable detailed logging
     * 
     * Set to true to log all Git operations to the Laravel log.
     * Useful for debugging in production environments.
     */
    'enable_logging' => false,

    /*
     * Log channel
     * 
     * Specify which log channel to use for Git operations.
     * Defaults to the default Laravel log channel.
     */
    'log_channel' => env('VS_CODE_GIT_LOG_CHANNEL', null),
];