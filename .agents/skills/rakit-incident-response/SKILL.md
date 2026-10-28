---
name: rakit-incident-response
description: Production incident response guidance for diagnosis, mitigation, rollback, communication, and prevention in Rakit.
---

# Rakit Incident Response

1. Confirm the incident, affected environment, start time, symptoms, and user impact.
2. Preserve evidence: logs, request IDs, deploy version, metrics, error samples, and relevant configuration without exposing secrets.
3. Assign an incident owner and communicate status, scope, mitigation, and next update through the team's approved channel.
4. Mitigate safely: disable the failing path, reduce load, roll back, or apply a narrow configuration change; do not make broad destructive edits under pressure.
5. Protect data and credentials. Rotate secrets only through an approved process and assess whether data exposure occurred.
6. Verify the mitigation with `/up`, representative requests, authentication, database checks, and error monitoring.
7. Preserve compatibility with in-flight requests, queued jobs, sessions, and schema versions during rollback.
8. After recovery, identify root and contributing causes, add regression tests or monitoring, and document a blameless postmortem.
9. Track follow-up actions with owners and deadlines; do not close the incident while known risks remain undocumented.
