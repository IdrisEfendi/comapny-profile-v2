---
name: rakit-debugging
description: Diagnostic workflow for common Rakit, PHP, Apache, routing, storage, and Composer failures.
---

# Rakit Debugging

1. Identify whether the failure occurs in Apache/PHP, the front controller, bootstrap, routing, controller, view, database, or storage.
2. Check the PHP version and required extensions before changing application code.
3. Confirm requests enter `index.php`; do not bypass the bootstrap by opening application files directly.
4. For `No direct access.`, inspect DirectoryIndex and rewrite rules. Apache must select `index.php`, not a protective `index.html`.
5. For 404 or broken pretty URLs, check `mod_rewrite`, `.htaccess`, `application/config/application.php`, and the route definition.
6. For permission errors, inspect `storage/` and `assets/` permissions and compiled view/cache directories.
7. Check logs and error pages without exposing their contents publicly.
8. Clear only the relevant runtime cache; never delete user data or rewrite unrelated changes.
9. Reproduce with a focused request or HTTP test, then add a regression test when fixing a bug.

Useful checks: `php -v`, `php -m`, `php -l file.php`, `composer install`, and `php rakit test:run`.
