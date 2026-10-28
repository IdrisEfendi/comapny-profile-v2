---
name: rakit-dependency-management
description: Composer and dependency lifecycle guidance for Rakit packages, patches, audits, and PHP compatibility.
---

# Rakit Dependency Management

- Treat `composer.json` as the declared dependency source and `composer.lock` as the reproducible installation state.
- Inspect existing constraints, PHP support, extensions, patches, stability, and autoload behavior before changing dependencies.
- Keep dependencies minimal and prefer Rakit or PHP facilities already present before adding a package.
- Use Composer commands from the project root and review the complete lockfile diff after updates.
- Run Composer's audit or equivalent security checks when available; investigate advisories rather than silently ignoring them.
- Verify package licenses, maintenance status, transitive dependencies, and PHP 5.4 compatibility.
- Preserve required Composer patches and confirm patch application after install or update.
- Do not commit `vendor/`, machine-specific config, credentials, or generated runtime files.
- Test install from a clean environment and run lint/tests after dependency changes.
