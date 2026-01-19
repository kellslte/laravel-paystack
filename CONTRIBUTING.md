# Contributing to Laravel Paystack SDK

Thank you for considering contributing to Laravel Paystack SDK! This document provides guidelines and instructions for contributing.

## Code of Conduct

Please be respectful and considerate of others when contributing to this project.

## How Can I Contribute?

### Reporting Bugs

Before creating bug reports, please check the issue list as you might find out that you don't need to create one. When you are creating a bug report, please include as many details as possible:

- PHP version
- Laravel version
- Package version
- Steps to reproduce
- Expected behavior
- Actual behavior
- Code examples

### Suggesting Enhancements

Enhancement suggestions are tracked as GitHub issues. When creating an enhancement suggestion, please include:

- A clear and descriptive title
- A detailed description of the proposed enhancement
- Use cases for the enhancement
- Possible implementation details

### Pull Requests

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Make your changes
4. Add tests for your changes
5. Ensure all tests pass (`composer test`)
6. Commit your changes (`git commit -m 'Add some amazing feature'`)
7. Push to the branch (`git push origin feature/amazing-feature`)
8. Open a Pull Request

## Development Setup

1. Clone the repository:
```bash
git clone https://github.com/scwar/laravel-paystack.git
cd laravel-paystack
```

2. Install dependencies:
```bash
composer install
```

3. Run tests:
```bash
composer test
```

## Coding Standards

- Follow PSR-12 coding standards
- Use type hints wherever possible
- Add PHPDoc comments for all public methods
- Write tests for new features
- Ensure all tests pass before submitting a PR

## Testing

- All new features must include tests
- Tests should be written using Pest PHP
- Aim for high test coverage
- Run tests before submitting a PR

## Version Bumping

Version bumps are handled automatically via GitHub Actions:

1. Go to Actions → Version Bump
2. Select the type of bump (patch, minor, major)
3. The workflow will create a PR with the version bump
4. Review and merge the PR

## Release Process

Releases are created via GitHub Actions:

1. Go to Actions → Release
2. Choose version type or specify exact version
3. Choose whether to publish to Packagist
4. The workflow will:
   - Bump the version
   - Create a Git tag
   - Create a GitHub release
   - Optionally publish to Packagist

## Commit Messages

Please follow these guidelines for commit messages:

- Use the present tense ("Add feature" not "Added feature")
- Use the imperative mood ("Move cursor to..." not "Moves cursor to...")
- Limit the first line to 72 characters or less
- Reference issues and pull requests liberally after the first line

## Questions?

If you have any questions, please open an issue for discussion.

Thank you for contributing! 🎉
