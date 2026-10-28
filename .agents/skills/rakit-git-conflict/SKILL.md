---
name: rakit-git-conflict
description: Safe GitHub and Git conflict resolution guidance for collaborative Rakit development.
---

# Rakit Git Conflict Resolution

Use this skill when branches, pull requests, rebases, merges, cherry-picks, or concurrent edits conflict.

## Safety Rules

- Inspect the worktree before changing anything with `git status`, `git diff`, and `git log --oneline -10`.
- Never use destructive commands such as `git reset --hard`, `git checkout --`, or broad cleanup commands unless the user explicitly authorizes them.
- Never discard another contributor's changes merely to make the conflict marker disappear.
- Do not use `git stash` as an automatic conflict strategy in shared worktrees; stashes are shared and can hide ownership.
- Preserve uncommitted user changes. If the current worktree is already conflicted or contains unexpected changes, stop and report the state before proceeding.
- Do not amend another contributor's commit or force-push a shared branch without explicit authorization.

## Diagnosis

1. Run `git status` and identify conflicted files and the current operation.
2. Inspect conflict markers and the surrounding code with `git diff`.
3. Compare the base, current branch, and incoming branch before choosing a resolution.
4. Check whether each side changes behavior, schema, routes, configuration, generated files, or only formatting.
5. Check the pull request discussion and commit intent when the correct behavior is not obvious.

## Resolution Rules

- Resolve the intent, not just the text. Keep compatible parts from both sides when both changes are required.
- For routes, controllers, models, migrations, and configuration, preserve security, validation, backward compatibility, and framework conventions.
- For database migrations, do not silently reorder or delete migrations. Coordinate names, dependencies, deployment order, and rollback behavior.
- For `AGENTS.md` and `.agents/skills/`, merge new team guidance instead of choosing one whole side.
- For generated files, determine the source-of-truth file first, then regenerate if the project supports it.
- For lockfiles, regenerate with the project's dependency manager when possible instead of hand-editing unrelated sections.
- Resolve all conflict markers: `<<<<<<<`, `=======`, and `>>>>>>>` must not remain in source files.
- Stage only reviewed resolutions with `git add path/to/file`; do not stage unrelated work.

## Verification

- Run `git diff --check` after resolving text conflicts.
- Run PHP lint on every changed PHP file: `php -l path/to/file.php`.
- Run relevant tests with `php rakit test:run` when dependencies are available.
- Smoke-test routes, migrations, API responses, frontend behavior, or CLI commands affected by the conflict.
- Review `git diff --cached` before completing the merge or rebase.
- Confirm status is clean of unmerged paths with `git status`.

## Collaboration Workflow

- Prefer a focused conflict-resolution commit or a clearly described merge result.
- Tell collaborators which files were conflicted, what behavior was preserved, and which checks passed.
- If the conflict reflects incompatible product decisions, do not guess; report the alternatives and required decision.
- Push only to an authorized branch and never force-push shared history without explicit approval.
- After a rebase, verify the branch's upstream and commit range before opening or updating a pull request.
