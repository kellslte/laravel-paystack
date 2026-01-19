# GitHub Actions Workflows

This directory contains GitHub Actions workflows for CI/CD automation.

## Workflows

### Tests (`tests.yml`)
- **Trigger**: Push and Pull Requests to `main` and `develop` branches
- **Purpose**: Run test suite across multiple PHP and Laravel versions
- **Matrix**: Tests against PHP 8.2, 8.3 and Laravel 11.x

### Code Quality (`code-quality.yml`)
- **Trigger**: Push and Pull Requests to `main` and `develop` branches
- **Purpose**: Run static analysis and code style checks
- **Tools**: PHPStan and PHP CS Fixer (if configured)

### Version Bump (`version-bump.yml`)
- **Trigger**: Manual workflow dispatch
- **Purpose**: Create a pull request with version bump
- **Options**: 
  - `version_type`: patch, minor, or major
- **Output**: Pull request with updated `composer.json` and `CHANGELOG.md`

### Release (`release.yml`)
- **Trigger**: Manual workflow dispatch
- **Purpose**: Create a new release with version bump, Git tag, and GitHub release
- **Options**:
  - `version`: Specific version (e.g., 1.0.0) or leave empty for auto-bump
  - `release_type`: patch, minor, or major (used if version is empty)
  - `publish_to_packagist`: Boolean to publish to Packagist
- **Output**: 
  - Updated `composer.json` and `CHANGELOG.md`
  - Git tag (e.g., `v1.0.0`)
  - GitHub release
  - Packagist update (if enabled)

### Packagist Publishing (`packagist.yml`)
- **Trigger**: 
  - GitHub release published
  - Manual workflow dispatch
- **Purpose**: Publish package to Packagist
- **Requirements**: 
  - `PACKAGIST_TOKEN` secret
  - `PACKAGIST_USERNAME` secret

## Secrets Required

For Packagist publishing, add these secrets to your repository:

1. Go to Settings → Secrets and variables → Actions
2. Add the following secrets:
   - `PACKAGIST_TOKEN`: Your Packagist API token
   - `PACKAGIST_USERNAME`: Your Packagist username

To get your Packagist token:
1. Visit https://packagist.org/profile/
2. Click "Show API Token"
3. Copy the token

## Usage Examples

### Creating a Version Bump PR

1. Go to Actions → Version Bump
2. Click "Run workflow"
3. Select version type (patch/minor/major)
4. Review and merge the created PR

### Creating a Release

1. Go to Actions → Release
2. Click "Run workflow"
3. Either:
   - Specify exact version (e.g., `1.0.0`)
   - Or select release type for auto-bump
4. Choose whether to publish to Packagist
5. The workflow will handle the rest

### Manual Packagist Update

1. Go to Actions → Publish to Packagist
2. Click "Run workflow"
3. The package will be updated on Packagist
