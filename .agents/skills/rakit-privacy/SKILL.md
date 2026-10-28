---
name: rakit-privacy
description: Privacy and personal-data handling guidance for Rakit storage, APIs, logs, exports, and deletion workflows.
---

# Rakit Privacy

- Identify personal, sensitive, authentication, and operational data before adding fields, logs, API responses, or jobs.
- Collect the minimum data needed for a documented purpose and avoid copying it across storage systems unnecessarily.
- Keep sensitive model fields hidden from serialization and restrict access through authorization.
- Redact passwords, tokens, session identifiers, secrets, and unnecessary personal data from logs and error responses.
- Define retention, deletion, anonymization, export, and correction behavior for user data where applicable.
- Protect exports and backups with access control, encryption, expiry, and auditability.
- Validate ownership before allowing users or administrators to read, download, edit, or delete personal data.
- Do not use real personal data in tests, fixtures, screenshots, examples, or documentation.
- Review privacy impact when changing analytics, cookies, sessions, notifications, uploads, or third-party integrations.
