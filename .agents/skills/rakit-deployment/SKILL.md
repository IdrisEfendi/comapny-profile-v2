---
name: rakit-deployment
description: Deployment and web-server guidance for Apache, Nginx, PHP, storage, and production Rakit configuration.
---

# Rakit Deployment

- Serve the project through `index.php`; configure Apache `mod_rewrite` or Nginx `try_files` correctly.
- Keep `application`, `packages`, `storage`, `system`, `vendor`, `tests`, `key.php`, `paths.php`, and Composer metadata inaccessible from the web.
- Generate and protect `key.php`; never commit it. Keep secrets in environment or server-local configuration.
- Ensure `storage/` and required public asset directories are writable only as needed by PHP.
- Set the production URL, timezone, trusted hosts, trusted proxies, and error/debug settings deliberately.
- Run dependency installation with the supported PHP 8.2+ version and use Composer's production-appropriate options. Reconcile the legacy `composer.json` PHP constraint with `composer.lock` before claiming support for older PHP.
- Verify `/up`, the home page, authentication, static assets, sessions, and logs after deployment.
- Do not enable verbose error output or expose debugbar data in production.
- Prefer a repeatable deployment process and back up databases before migrations.

Read `packages/docs/data/install.md`, `packages/docs/data/config.md`, and `sample.htaccess` before server changes.
