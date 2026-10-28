---
name: rakit-database
description: Database, Facile ORM, query, schema, migration, and data integrity guidance for Rakit.
---

# Rakit Database

- Read `application/config/database.php` and the relevant docs under `packages/docs/data/database/` first.
- Application models normally extend `Facile`; define `$fillable` and `$hidden` deliberately.
- Change schema through timestamped migrations in `application/migrations/`, not machine-specific manual SQL.
- Use Facile ORM or query builder for normal operations; use raw queries only when justified and parameterized.
- Never interpolate external input into SQL. Use bindings and validate values before querying.
- Add indexes and constraints for lookup, uniqueness, and referential integrity where supported.
- Use transactions for multi-step writes that must be atomic.
- Consider nullability, defaults, rollback behavior, existing data, and deployment order in every migration.
- Do not commit local database files or runtime data under `storage/database/`.
- Add tests for persistence, validation, relationships, duplicate data, and rollback-sensitive behavior.
