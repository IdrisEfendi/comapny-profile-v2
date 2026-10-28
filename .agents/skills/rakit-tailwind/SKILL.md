---
name: rakit-tailwind
description: CSS and UI styling guidance for Rakit using Tailwind CSS, responsive utilities, accessible states, and Blade views.
---

# Rakit Tailwind

Use this skill for CSS, layout, responsive UI, components, themes, spacing, typography, and visual states in Rakit.

- Use Tailwind CSS utility classes as the default styling approach. Do not introduce Bootstrap or another CSS framework without an explicit requirement.
- Keep source styles and Tailwind configuration in the established frontend asset structure; do not edit generated CSS as the source of truth.
- Reuse existing design tokens, colors, typography, radii, spacing, dark-mode behavior, and component patterns before adding new values.
- Build responsive layouts mobile-first using Tailwind breakpoint utilities.
- Use semantic HTML and style states for hover, focus-visible, active, disabled, loading, error, success, and empty conditions.
- Ensure readable contrast, visible keyboard focus, adequate touch targets, and reduced-motion-friendly transitions.
- Keep class lists understandable. Extract a reusable Blade component or partial when the same UI pattern is repeated.
- Avoid arbitrary values when an existing Tailwind utility or project token expresses the intent.
- Use conditional Blade classes carefully and ensure all states remain valid when data is missing or validation fails.
- Preserve the existing light/dark theme behavior and test both themes when modifying shared UI.
- Do not use inline styles for normal styling. Use Tailwind utilities or the project stylesheet for exceptional reusable rules.
- Avoid excessive `!important`, deep selector overrides, and CSS that depends on fragile markup order.
- Verify desktop, tablet, and mobile widths; long text; form errors; empty states; and keyboard navigation.
