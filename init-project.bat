@echo off
REM Initialize the VS Code Laravel Git project

echo Initializing VS Code Laravel Git project...

REM Create necessary directories
mkdir docs 2>nul
mkdir examples 2>nul
mkdir tests\DataTransferObjects 2>nul
mkdir tests\Console\Commands 2>nul
mkdir tests\Http\Controllers 2>nul
mkdir resources 2>nul

echo Installing PHP dependencies...
composer install

echo Installing Node.js dependencies...
npm install

echo Generating autoload files...
composer dump-autoload

echo Project initialized successfully!
echo.
echo To start development:
echo   - For Laravel package: Run 'composer test' to run tests
echo   - For VS Code extension: Run 'npm run watch' to compile in watch mode
echo   - Press F5 in VS Code to run the extension in development mode