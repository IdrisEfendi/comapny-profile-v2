---
name: rakit-testing
description: Testing conventions and verification workflow for Rakit application changes.
---

# Rakit Testing

- Put Rakit/PHPUnit application tests in `application/tests/` and follow existing PHPUnit conventions. Keep lightweight deployment smoke checks in the repository-level `tests/` directory.
- Use `System\\Testing\\Http` for end-to-end HTTP behavior through middleware, session, routing, controllers, and views.
- Use `get`, `post`, `put`, `patch`, `delete`, `json`, or `call` according to the endpoint.
- Assert status, redirects, body, JSON, headers, cookies, session, validation errors, and authorization as applicable.
- Use `acting_as()` for authenticated requests and `with_headers()` for authorization headers.
- Test happy paths, validation failures, unauthenticated access, forbidden access, not-found behavior, and regression cases.
- After PHP edits, run `php -l path/to/changed-file.php`; run `php rakit test:run` when dependencies and the PHP 8.2+ runtime are available.
- Do not edit compiled views in `storage/views/`; test the source view in `application/views/`.
- Report unavailable dependencies, database services, or PHP version limitations instead of claiming tests passed.

Reference: `packages/docs/data/testing.md` and `packages/docs/data/debugging.md`.
