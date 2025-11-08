const path = require('path');
const fs = require('fs');

// Simple build script for the VS Code extension
console.log('Building VS Code extension...');

// Create dist directory if it doesn't exist
const distDir = path.join(__dirname, 'dist');
if (!fs.existsSync(distDir)) {
    fs.mkdirSync(distDir);
}

console.log('Extension built successfully!');
console.log('To package the extension, run: vsce package');