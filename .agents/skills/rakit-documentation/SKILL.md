---
name: rakit-documentation
description: Documentation conventions for Rakit features, APIs, setup, offline docs, examples, and changelog entries.
---

# Rakit Documentation

- Update the nearest relevant documentation when adding or changing public behavior.
- Keep README setup instructions accurate for PHP, extensions, Composer, web servers, and local startup.
- Document API method, path, authentication, request fields, response shape, status codes, and failure cases.
- Use the offline documentation under `packages/docs/data/` for framework behavior and keep links consistent.
- Include concise runnable examples that match the actual Rakit API; do not write Laravel examples for this project.
- Document configuration, permissions, migrations, workers, and deployment assumptions when they affect users.
- Add a changelog entry for user-visible or compatibility-relevant changes when the project convention requires it.
- Avoid documenting secrets, local machine paths, generated files, or unsupported versions.
- Verify code examples and command names before publishing documentation.
