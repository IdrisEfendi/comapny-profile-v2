---
name: rakit-release
description: Release preparation and deployment checklist for versioned Rakit changes.
---

# Rakit Release

- Confirm scope, version, changelog, documentation, migration notes, compatibility impact, and rollback plan.
- Inspect the full diff and included commits; ensure no secrets, `key.php`, runtime files, local config, or debug output are included.
- Install dependencies from the lockfile and run PHP lint, relevant tests, smoke checks, and security checks.
- Verify migrations on a copy of representative data and document ordering, backfill, downtime, and rollback behavior.
- Check production configuration, trusted hosts/proxies, writable storage, Apache/Nginx rules, and error/debug settings.
- Confirm health endpoint `/up`, home page, authentication, authorization, API routes, assets, sessions, and logs.
- Prepare a backup before schema or data changes and define who can execute rollback.
- Communicate known limitations, required PHP extensions, operator steps, and post-release monitoring.
- Tag or publish only through the team's approved workflow; do not force-push or release unreviewed changes.
