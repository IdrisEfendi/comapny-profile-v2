---
name: rakit-backup-recovery
description: Backup, migration rollback, restore, and disaster recovery guidance for Rakit applications.
---

# Rakit Backup and Recovery

- Identify recoverable assets: database, `key.php`, environment configuration, uploads, required package metadata, and deployment configuration.
- Keep secrets protected and backed up only through approved secure storage; never place backups in public directories or Git.
- Back up before destructive migrations, bulk data changes, dependency upgrades, or releases.
- Test restore procedures on an isolated environment; a backup is not valid until restoration succeeds.
- Define retention, encryption, access control, recovery point objective, and recovery time objective with the team.
- Design migrations with rollback or a documented forward-recovery path; do not assume destructive down migrations are safe.
- Preserve application-key continuity when encrypted data or sessions depend on it.
- Verify file permissions and storage ownership after restore, then run health, authentication, database, and smoke checks.
- Record recovery steps and limitations in deployment documentation without exposing secrets.
