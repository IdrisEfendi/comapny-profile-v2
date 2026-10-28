---
name: rakit-jquery
description: JavaScript development guidance for Rakit using jQuery, Blade, AJAX, DOM events, and progressive enhancement.
---

# Rakit jQuery

Use this skill for JavaScript behavior, AJAX, interactive forms, DOM updates, and browser-side validation in Rakit.

- Use jQuery as the project JavaScript library. Do not introduce React, Vue, Alpine, or another frontend framework without an explicit requirement.
- Put application JavaScript in the public asset structure under `assets/`; do not edit compiled files under `storage/`.
- Use `$(function () { ... });` or delegated handlers for initialization and dynamically rendered content.
- Prefer event delegation for elements that Blade or AJAX may add after page load.
- Keep selectors stable and meaningful. Prefer IDs, classes, or `data-*` attributes over fragile DOM traversal.
- Scope selectors to a component or form to avoid affecting unrelated page elements.
- Use `$.ajax`, `$.get`, `$.post`, or the project's existing AJAX helper consistently; handle success, validation errors, server errors, timeout, and network failure.
- Include the Rakit CSRF token in state-changing AJAX requests. Use the existing page token and the `X-Csrf-Token` header where applicable.
- Never insert untrusted response data with unsafe HTML APIs. Prefer `.text()`, safe DOM APIs, or sanitize trusted HTML explicitly.
- Disable or guard submit controls during requests to prevent duplicate actions, then restore the correct state on completion.
- Provide loading, empty, success, and error states. Do not rely only on browser console output.
- Keep JavaScript progressively enhanced: forms and important navigation should remain understandable when JavaScript fails where feasible.
- Avoid global variables and duplicate event bindings. Namespace events when teardown may be needed.
- Ensure keyboard interaction, focus management, labels, and ARIA state are preserved for dynamic UI.
- Test normal behavior, invalid input, double-submit, failed request, slow request, and dynamically inserted elements.
