---
name: rakit-security
description: Security guidance for authentication, authorization, input, output, sessions, files, and production changes in Rakit.
---

# Rakit Security

Use this skill for login, permissions, API credentials, uploads, sessions, encryption, or any user-controlled data.

- Validate all external input with Rakit validation APIs.
- Escape HTML output by default; use raw output only for trusted or sanitized content.
- Protect state-changing requests with CSRF. Exempt webhooks only when necessary and explicitly.
- Use Rakit authentication and authorization APIs rather than scattered user-ID checks.
- Keep passwords, tokens, keys, and credentials out of source code, logs, responses, and commits.
- Keep sensitive model fields in `$hidden` and limit mass assignment with `$fillable`.
- Use parameter binding or framework database APIs; never concatenate user input into SQL.
- Validate upload size, MIME type, extension, filename, and destination. Prevent path traversal.
- Admin authentication is package-local in `packages/admin/routes.php`; centralize auth, CSRF, rate-limit, session-regeneration, and authorization checks in package helpers rather than duplicating them in views.
- Treat `packages/admin/views/` as application views. Keep admin actions POST-only with CSRF; logout and destructive actions must never be GET-only.
- Review `.htaccess` whenever adding a directory or public file. Internal folders must not be web-accessible.
- Do not expose stack traces, config, secrets, or debug output in production.
- For security changes, add regression tests for both allowed and rejected behavior.

Read the relevant offline docs under `packages/docs/data/auth/`, `hash.md`, `jwt.md`, `crypter.md`, and `input.md` before implementation.
