---
name: rakit-jobs
description: Guidance for Rakit background jobs, queues, scheduling, retries, and worker-safe processing.
---

# Rakit Jobs

- Put application jobs in `application/jobs/` and follow the existing job class conventions.
- Make jobs idempotent so retries cannot duplicate side effects or corrupt data.
- Validate and serialize only the minimum job payload; do not put secrets or large mutable objects in a queue.
- Use transactions for related writes and define behavior when a job is retried after a partial failure.
- Handle exceptions, retry limits, backoff, timeout, and permanent failure explicitly.
- Keep external calls bounded with timeouts and make them safe to retry where possible.
- Log job identity and outcome without logging passwords, tokens, or personal data unnecessarily.
- Ensure scheduled jobs do not overlap unless the operation is designed for concurrency.
- Test successful processing, duplicate delivery, malformed payloads, failures, and retry behavior.
- Read `packages/docs/data/job.md`, `schedule.md`, and `workers.md` before changing queue or worker behavior.
