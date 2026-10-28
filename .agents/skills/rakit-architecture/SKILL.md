---
name: rakit-architecture
description: Architecture guidance for boundaries between Rakit application layers, framework core, packages, and runtime concerns.
---

# Rakit Architecture

- Keep request routing in `application/routes.php`, orchestration in controllers, persistence in models/query APIs, presentation in views, and asynchronous work in jobs.
- Keep business rules out of Blade views and avoid putting application behavior in `index.php` or `paths.php`.
- Prefer existing Rakit helpers, hooks, middleware, libraries, and package APIs before adding new abstractions.
- Add a library or service only when logic is reusable, independently testable, or too complex for a controller; avoid speculative layers.
- Keep `system/` changes reserved for framework behavior that cannot be solved safely in the application layer.
- Treat `packages/admin/` as an application package boundary: keep admin routes/helpers/views together, and do not confuse it with the Rakit framework core under `system/`.
- Respect bootstrap order, autoload directories, package boundaries, and worker-mode state isolation.
- Define contracts for API responses, model data, jobs, and events before parallel implementation.
- Avoid circular dependencies, hidden global state, duplicated validation, and direct access from views to infrastructure.
- Consider compatibility, security, observability, and testability in architecture decisions.
