---
name: rakit-performance
description: Performance guidance for database access, caching, rendering, assets, and long-running Rakit workers.
---

# Rakit Performance

- Measure before optimizing; identify the slow request, query, render, asset, or worker operation.
- Avoid N+1 queries and repeated database reads inside loops; use appropriate query shaping and pagination.
- Add indexes for frequent filters, joins, uniqueness checks, and ordering after considering write cost.
- Use the Rakit cache APIs for stable expensive results and define invalidation behavior before adding cache.
- Bound pagination, uploads, batch processing, and API response sizes.
- Keep Blade views focused on presentation; do not perform repeated database work from templates.
- Minimize frontend asset size and avoid loading unnecessary assets on every page.
- In worker mode, avoid static/global request state and release large resources between jobs.
- Do not trade away authorization, validation, consistency, or observability for small speed gains.
- Add a reproducible benchmark or regression test for meaningful optimizations.
