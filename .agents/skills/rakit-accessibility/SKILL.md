---
name: rakit-accessibility
description: Accessibility guidance for semantic HTML, keyboard use, forms, dynamic jQuery UI, and Tailwind styling in Rakit.
---

# Rakit Accessibility

- Use semantic HTML elements and correct heading hierarchy before adding ARIA.
- Every form control needs a visible or programmatically associated label, useful instructions, and accessible validation errors.
- Ensure all interactive controls work with keyboard focus and have a visible `:focus-visible` state.
- Maintain sufficient color contrast in light and dark themes; never communicate state by color alone.
- Use buttons for actions and links for navigation. Do not make non-interactive elements clickable without keyboard behavior.
- Manage focus when dialogs, menus, AJAX content, validation errors, or page changes alter the user's context.
- Keep dynamic jQuery updates synchronized with text, disabled state, `aria-expanded`, `aria-busy`, and live-region messaging where appropriate.
- Use ARIA only when native HTML cannot express the behavior, and keep its state accurate.
- Respect reduced-motion preferences and avoid flashing or rapidly changing content.
- Test keyboard-only navigation, zoom, mobile layout, screen-reader names, errors, empty states, and both themes.
