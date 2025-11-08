<?php
/**
 * Verification script for Laravel VS Code Git package
 * 
 * This script verifies that the package is properly installed and configured
 * for both Laravel and standalone PHP environments.
 */

// Include the autoloader
require_once __DIR__ . '/vendor/autoload.php';

echo "Verifying Laravel VS Code Git Package Installation...\n\n";

// Check if we're in a Laravel environment
$isLaravel = false;
if (class_exists('Illuminate\Foundation\Application')) {
    $isLaravel = true;
    echo "✓ Laravel environment detected\n";
} else {
    echo "✓ Standalone PHP environment detected\n";
}

// Check if the main class exists
if (class_exists('LaravelGpt\Vscode\VscodeLaravelGit')) {
    echo "✓ Main package class found\n";
} else {
    echo "✗ Main package class not found\n";
    exit(1);
}

// Check if the facade exists (in Laravel environment)
if ($isLaravel && class_exists('LaravelGpt\Vscode\Facades\VscodeLaravelGit')) {
    echo "✓ Facade class found\n";
} else if ($isLaravel) {
    echo "✗ Facade class not found\n";
}

// Try to instantiate the main class
try {
    $git = new LaravelGpt\Vscode\VscodeLaravelGit();
    echo "✓ Package instantiated successfully\n";
} catch (Exception $e) {
    echo "✗ Failed to instantiate package: " . $e->getMessage() . "\n";
    exit(1);
}

// Check if Git is available
try {
    $isAvailable = $git->isGitAvailable();
    if ($isAvailable) {
        echo "✓ Git is available\n";
    } else {
        echo "⚠ Git is not available (this is OK if you're verifying installation only)\n";
    }
} catch (Exception $e) {
    echo "⚠ Error checking Git availability: " . $e->getMessage() . "\n";
}

// Check configuration (in Laravel environment)
if ($isLaravel) {
    try {
        if (function_exists('config')) {
            $gitPath = config('vscode-laravel-git.git_binary_path', 'git');
            echo "✓ Configuration loaded successfully (Git path: $gitPath)\n";
        } else {
            echo "⚠ Configuration helper not available\n";
        }
    } catch (Exception $e) {
        echo "⚠ Error loading configuration: " . $e->getMessage() . "\n";
    }
}

echo "\nVerification completed successfully!\n";
echo "The package is ready for production use.\n";