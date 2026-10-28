---
name: rakit-localization
description: Guidance for language files, translation keys, locale behavior, dates, numbers, and multilingual Rakit views.
---

# Rakit Localization

- Store application translations under `application/language/<locale>/` and follow existing language file structure.
- Use translation APIs and keys instead of hard-coded user-facing text in controllers and views.
- Keep translation keys stable, descriptive, and consistent across supported locales.
- Ensure every new required key has a fallback or is added to all supported language files.
- Preserve the configured default language and URI language behavior in `application/config/application.php`.
- Use locale-aware formatting for dates, numbers, currency, pluralization, and validation messages.
- Do not use translation strings as HTML containers unless their markup is controlled and escaped appropriately.
- Test missing keys, fallback behavior, language selection, and rendered output for relevant locales.
- Keep source files ASCII unless existing project content requires another encoding.
