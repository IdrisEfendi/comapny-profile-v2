---
name: rakit-contributing
description: Team contribution workflow for branches, commits, pull requests, migrations, and review-ready Rakit changes.
---

# Rakit Contributing

- Keep each change focused and avoid mixing unrelated formatting, generated files, or refactors.
- Inspect existing worktree changes before editing and never revert work made by another contributor.
- Use a descriptive branch and commit message that explain the user-visible or maintenance change.
- Before review, inspect the diff, changed-file list, and recent history; ensure secrets and runtime files are excluded.
- Run relevant PHP lint, tests, smoke checks, and migration checks before requesting review.
- Include verification commands, environment limitations, migration/deployment notes, and known risks in the change description.
- Treat schema changes as coordinated deployment work: document ordering, rollback, backfill, and compatibility.
- Keep commits reviewable; do not rewrite shared history or amend another contributor's commit.
- Resolve conflicts in the working branch while preserving both intended changes and rerun affected checks.
- Review security, compatibility, accessibility, and documentation impact before merge.
