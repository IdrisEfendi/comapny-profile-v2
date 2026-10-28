---
name: rakit-php-compatibility
description: PHP version and extension compatibility guidance for the Rakit PHP 5.4 through 8.x support range.
---

# Rakit PHP Compatibility

- The application target is PHP 8.2+ (verified locally on PHP 8.4); the framework core and legacy Composer constraint mention PHP 5.4, but that is not a supported application runtime until the lockfile and application code are tested there.
- Do not introduce syntax newer than the documented deployment baseline. For framework-core changes, preserve broader compatibility when practical, but do not let the legacy `composer.json` constraint misrepresent the tested application runtime.
- Check standard-library behavior differences across PHP 5, 7, and 8 before relying on edge-case behavior.
- Use existing Rakit polyfills and compatibility patterns; do not add redundant shims.
- Keep application code compatible with required extensions: JSON, mbstring, OpenSSL, and fileinfo; verify optional extension use.
- Run `php -l` and tests with PHP 8.2+; if PHP 5.4 compatibility is intentionally restored later, add a separate oldest-runtime CI job before documenting it as supported.
- Check Composer constraints and package versions before using newer APIs.
- Avoid relying on undocumented PHP 8-only edge behavior; when using PHP 7+/8+ APIs in the application, document the baseline and keep Composer metadata aligned.
- Document when a feature necessarily raises the minimum PHP version and update Composer and project documentation together.
