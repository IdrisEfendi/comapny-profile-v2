---
name: rakit-cli
description: Guidance for Rakit console commands, generators, workers, jobs, and command-line verification.
---

# Rakit CLI

- Run commands from the project root so `paths.php`, `application/`, and `system/` resolve correctly.
- Inspect `php rakit` or the offline console documentation before guessing a command name or option.
- Common commands include `php rakit key:generate` and `php rakit test:run`; verify availability in the current version first.
- Use generators when the project provides one, then inspect and adapt generated files to project conventions.
- Never print or commit application keys, credentials, tokens, or sensitive command output.
- Treat commands that migrate, delete, publish, or modify data as destructive; verify target environment first.
- Keep custom commands in `application/commands/`, preserve the direct-access guard, and validate arguments.
- Keep long-running workers and jobs free of leaked request state; handle retries and failures explicitly.
- Prefer reproducible commands and record required PHP extensions, Composer dependencies, and working directory.
