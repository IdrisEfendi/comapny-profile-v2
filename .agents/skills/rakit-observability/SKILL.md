---
name: rakit-observability
description: Guidance for logging, health checks, diagnostics, metrics, and production-safe observability in Rakit.
---

# Rakit Observability

- Use the existing Rakit logging and debug facilities instead of inventing parallel log formats.
- Keep `/up` fast, dependency-light, cache-disabled, and suitable for load balancers and uptime monitors.
- Log actionable context such as request/job identity, operation, outcome, and duration where available.
- Never log passwords, application keys, bearer tokens, session IDs, or unnecessary personal data.
- Use appropriate severity levels and avoid flooding logs in loops or successful high-volume paths.
- Keep production debug output, stack traces, debugbar data, and internal paths inaccessible to users.
- Add observability for important failures and state transitions without changing business behavior.
- Ensure log and storage directories are writable and rotated or cleaned according to deployment policy.
- Test health status, error responses, and sensitive-data redaction when observability changes.

Read `packages/docs/data/debugging.md`, `log`, `hooks`, and deployment guidance before implementation.
