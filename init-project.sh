#!/bin/bash

# Initialize the VS Code Laravel Git project

echo "Initializing VS Code Laravel Git project..."

# Create necessary directories
mkdir -p docs
mkdir -p examples
mkdir -p tests/DataTransferObjects
mkdir -p tests/Console/Commands
mkdir -p tests/Http/Controllers
mkdir -p resources

echo "Installing PHP dependencies..."
composer install

echo "Installing Node.js dependencies..."
npm install

echo "Generating autoload files..."
composer dump-autoload

echo "Project initialized successfully!"
echo ""
echo "To start development:"
echo "  - For Laravel package: Run 'composer test' to run tests"
echo "  - For VS Code extension: Run 'npm run watch' to compile in watch mode"
echo "  - Press F5 in VS Code to run the extension in development mode"