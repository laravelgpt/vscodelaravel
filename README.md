# VS Code Laravel Git Extension

A Laravel 12 package that functions as a VS Code web-based extension with Git features included.

## Features

- Git status checking
- Commit changes with custom messages
- Push and pull functionality
- Branch management (list, checkout)
- Git log viewing
- Clean, modern interface integrated with VS Code

## Installation

### Laravel Package Installation

Require the package in your Laravel 12 project:

```bash
composer require laravel/vscode
```

Publish the configuration file:

```bash
php artisan vendor:publish --provider="LaravelGpt\Vscode\VscodeLaravelGitServiceProvider"
```

### VS Code Extension Installation

You can install the extension in two ways:

**Method 1: Direct Installation (Recommended)**
1. Download the `laravel-vscode-git-0.0.1.vsix` file from the releases
2. In VS Code, go to Extensions (`Ctrl+Shift+X`)
3. Click on the "..." menu and select "Install from VSIX..."
4. Select the downloaded .vsix file

**Method 2: Development Installation**
1. Clone this repository
2. Run `npm install` to install dependencies
3. Press `F5` to compile and run the extension in a new VS Code window

## Usage

### Laravel Package

```php
use LaravelGpt\Vscode\Facades\VscodeLaravelGit;

// Get Git status
$status = VscodeLaravelGit::getStatus();

// Commit changes
VscodeLaravelGit::stageFiles(['file1.txt', 'file2.txt']);
VscodeLaravelGit::commit('Initial commit');

// Push changes
VscodeLaravelGit::push();
```

### VS Code Extension

Use the command palette (`Ctrl+Shift+P` or `Cmd+Shift+P`) to access the following commands:

- `Laravel Git: Show Status`
- `Laravel Git: Commit Changes`
- `Laravel Git: Push Changes`
- `Laravel Git: Pull Changes`
- `Laravel Git: Show Log`
- `Laravel Git: Show Branches`
- `Laravel Git: Checkout Branch`

## Configuration

### Laravel Package

The package can be configured by publishing the configuration file and modifying `config/vscode-laravel-git.php`:

```php
return [
    'default_path' => '',
    'git_binary_path' => 'git',
    'max_execution_time' => 30,
    'enable_logging' => false,
    'log_channel' => null,
];
```

### VS Code Extension

Configure the extension through VS Code settings:

- `vscode-laravel-git.enable`: Enable/disable the extension
- `vscode-laravel-git.gitPath`: Path to Git executable

## Requirements

- PHP 8.4+
- Laravel 12
- Git installed and available in system PATH
- VS Code 1.74.0+

## Production Ready

This package is immediately ready for production use with:

- Robust error handling for both Laravel and non-Laravel environments
- Comprehensive configuration options
- Detailed logging capabilities
- Proper timeout management for Git operations
- VS Code extension with full Git functionality
- All necessary dependencies included
- Zero additional setup required after installation

## License

MIT