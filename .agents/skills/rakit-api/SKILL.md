---
name: rakit-api
description: API design and implementation guidance for REST and JSON endpoints in Rakit.
---

# Rakit API

- Define API routes in `application/routes.php`; use controllers for non-trivial endpoints.
- Choose HTTP methods and status codes consistently: validation errors 422, authentication 401, authorization 403, missing resources 404, and successful writes according to the operation.
- Validate request input and return a stable JSON error shape without leaking internal exceptions.
- Set JSON response headers explicitly and avoid returning sensitive model fields.
- Use pagination, filtering, and sorting only with validated allowlists and bounded limits.
- Protect private endpoints with Rakit authentication, authorization, CSRF where session-based, and rate limiting where appropriate.
- Use Bearer/JWT handling from existing Rakit APIs; do not invent token parsing or password hashing.
- Add HTTP tests for success, malformed input, authentication, authorization, not-found, and error responses.
- Document endpoint method, path, request fields, response shape, status codes, and authentication requirements.
