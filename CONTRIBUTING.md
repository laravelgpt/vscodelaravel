# Contributing

We welcome contributions to the VS Code Laravel Git package! This document provides guidelines for contributing to the project.

## Getting Started

1. Fork the repository
2. Clone your fork
3. Install dependencies:
   ```bash
   composer install
   npm install
   ```
4. Create a new branch for your feature or bug fix

## Development Setup

### Laravel Package Development

1. Install Laravel 12 dependencies:
   ```bash
   composer install
   ```

2. Run tests:
   ```bash
   ./vendor/bin/phpunit
   ```

### VS Code Extension Development

1. Install Node.js dependencies:
   ```bash
   npm install
   ```

2. Compile the extension:
   ```bash
   npm run compile
   ```

3. Run the extension in development mode:
   ```bash
   npm run watch
   ```

## Code Standards

### PHP Code

- Follow PSR-12 coding standards
- Use type hints wherever possible
- Write meaningful docblocks
- Keep methods small and focused
- Follow SOLID principles

### TypeScript Code

- Follow TypeScript best practices
- Use strict typing
- Write meaningful JSDoc comments
- Keep functions small and focused

### Documentation

- Update documentation when adding new features
- Write clear, concise documentation
- Use Markdown format for documentation files

## Testing

### PHP Tests

- Write unit tests for new functionality
- Ensure all tests pass before submitting a pull request
- Use PHPUnit for testing

### TypeScript Tests

- Write unit tests for new functionality
- Ensure all tests pass before submitting a pull request
- Use Mocha/Chai for testing

## Pull Request Process

1. Ensure any install or build dependencies are removed before the end of the layer when doing a build
2. Update the README.md with details of changes to the interface, this includes new environment variables, exposed ports, useful file locations and container parameters
3. Increase the version numbers in any examples files and the README.md to the new version that this Pull Request would represent
4. You may merge the Pull Request in once you have the sign-off of two other developers, or if you do not have permission to do that, you may request the second reviewer to merge it for you

## Reporting Issues

- Use the GitHub issue tracker to report bugs
- Use the GitHub issue tracker to request features
- Provide as much information as possible when reporting issues
- Include steps to reproduce bugs
- Include expected and actual behavior

## Code of Conduct

This project adheres to the Contributor Covenant code of conduct. By participating, you are expected to uphold this code. Please report unacceptable behavior to the project maintainers.