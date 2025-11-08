# Usage Guide

## Installation

### Laravel Package Installation

To install the package in your Laravel 12 project, run:

```bash
composer require your-vendor/vscode-laravel-git
```

### VS Code Extension Installation

To use the VS Code extension:

1. Clone this repository
2. Run `npm install` to install dependencies
3. Press `F5` to compile and run the extension in a new VS Code window

## Laravel Package Usage

### Basic Usage

```php
use YourVendor\VscodeLaravelGit\VscodeLaravelGit;

$git = new VscodeLaravelGit();

// Get current branch
$branch = $git->getCurrentBranch();

// Get Git status
$status = $git->getStatus();

// Get Git log
$log = $git->getLog();
```

### Using the Facade

```php
use YourVendor\VscodeLaravelGit\Facades\VscodeLaravelGit;

// Get current branch
$branch = VscodeLaravelGit::getCurrentBranch();

// Get Git status
$status = VscodeLaravelGit::getStatus();
```

### Working with GitResult Objects

All methods return a `GitResult` object with the following properties:

- `exitCode`: The exit code of the Git command (0 for success)
- `stdout`: The standard output of the command
- `stderr`: The standard error output of the command

```php
use YourVendor\VscodeLaravelGit\VscodeLaravelGit;

$git = new VscodeLaravelGit();
$result = $git->getStatus();

if ($result->isSuccess()) {
    echo "Command succeeded: " . $result->stdout;
} else {
    echo "Command failed: " . $result->stderr;
}

// Get output as array of lines
$lines = $result->getLines();
```

### Advanced Usage

#### Committing Changes

```php
use YourVendor\VscodeLaravelGit\VscodeLaravelGit;

$git = new VscodeLaravelGit();

// Stage files
$git->stageFiles(['file1.txt', 'file2.txt']);

// Commit changes
$git->commit('Initial commit');

// Push changes
$git->push();
```

#### Working with Branches

```php
use YourVendor\VscodeLaravelGit\VscodeLaravelGit;

$git = new VscodeLaravelGit();

// Get current branch
$currentBranch = $git->getCurrentBranch();

// Get all branches
$branches = $git->getBranches();

// Create and switch to a new branch
$git->executeGitCommand('checkout -b new-feature');
```

## VS Code Extension Usage

The VS Code extension provides the following commands:

- `Laravel Git: Show Status` - Shows the current Git status
- `Laravel Git: Commit Changes` - Commits staged changes
- `Laravel Git: Push Changes` - Pushes changes to the remote repository
- `Laravel Git: Pull Changes` - Pulls changes from the remote repository

You can access these commands through the Command Palette (`Ctrl+Shift+P` or `Cmd+Shift+P`).

## Configuration

### Laravel Package Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="YourVendor\VscodeLaravelGit\VscodeLaravelGitServiceProvider"
```

This will create a `config/vscode-laravel-git.php` file where you can customize the package settings.

### VS Code Extension Configuration

The extension can be configured through VS Code settings:

- `vscode-laravel-git.enable`: Enable/disable the extension
- `vscode-laravel-git.gitPath`: Path to Git executable