---
name: rakit-frontend
description: Blade, HTML, CSS, JavaScript, accessibility, responsive design, and asset guidance for Rakit.
---

# Rakit Frontend

- Put source views in `application/views/` and browser assets in `assets/`.
- Use `.blade.php` and existing Blade helpers; use `asset()` for public asset URLs.
- Escape user-controlled values by default and avoid raw HTML output without sanitization.
- Preserve the project's responsive behavior, light/dark theme handling, typography, and visual language when modifying existing pages.
- Design for desktop and mobile, keyboard navigation, visible focus, semantic HTML, labels, and useful error states.
- Keep forms compatible with server-side validation and CSRF protection.
- Do not edit compiled output under `storage/views/` and do not place public files in `storage/`.
- Verify asset URLs, route behavior, form errors, loading states, and no-JavaScript fallbacks where relevant.
