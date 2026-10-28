---
name: rakit-code-review
description: Review checklist for bugs, security, compatibility, regressions, and missing tests in Rakit changes.
---

# Rakit Code Review

Review behavior first, then maintainability.

- Check changed routes, controllers, models, views, config, migrations, and core files for unintended behavior.
- Prioritize exploitable security issues, data loss, authorization bypasses, broken migrations, and production regressions.
- Verify syntax against the documented application target PHP 8.2+; treat the legacy `composer.json` PHP 5.4 constraint as a metadata inconsistency to report, not as proof of supported runtime.
- Check all external input for validation, CSRF, authorization, output escaping, and safe database access.
- Check response status, redirects, JSON shapes, headers, and error handling.
- Check migrations for rollback, existing-data safety, indexes, constraints, and cross-database behavior.
- Check worker-mode code for leaked mutable global state.
- Check tests for success, failure, security, and regression coverage; do not accept only syntax validation.
- Avoid requesting unrelated refactors. Every finding should include file/line evidence and impact.
- Review `system/` changes more strictly because they affect every application using Rakit.

Use `packages/docs/data/` and the applicable task-specific skill as the source of framework behavior.
