---
name: rakit-requirements
description: Guidance for turning PRD and FRD requirements into scoped, testable Rakit implementation work.
---

# Rakit Requirements

- Identify the user, problem, business goal, scope, assumptions, constraints, and non-goals before implementation.
- Translate PRD outcomes into user stories and FRD behavior: routes, inputs, validation, authorization, persistence, responses, views, and failure states.
- Write acceptance criteria that are observable, testable, and independent of implementation details.
- Trace each requirement to affected Rakit files and tests without inventing Laravel conventions.
- Identify edge cases: empty data, invalid input, duplicate requests, unauthorized access, concurrency, timeout, and partial failure.
- Separate must-have behavior from optional improvements and ask for a decision when requirements conflict.
- Preserve existing API, database, security, accessibility, and compatibility constraints unless the requirement explicitly changes them.
- Define error messages, status codes, loading states, empty states, and rollback behavior before coding.
- Keep the implementation plan incremental; validate the smallest useful slice before expanding scope.
