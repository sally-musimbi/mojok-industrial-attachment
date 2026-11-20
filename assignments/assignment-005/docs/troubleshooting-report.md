# Nexora Deployment Troubleshooting Report

## 1. Issue Identified

During SSH server configuration testing, the command `sudo sshd -t` returned:

`Missing privilege separation directory: /run/sshd`

This indicated that the required runtime directory was missing.

## 2. Investigation

The SSH server configuration was checked using `sshd -t`. The error identified the missing runtime directory rather than an invalid SSH configuration.

## 3. Corrective Action

The missing directory was created with the appropriate ownership and permissions:

`sudo install -d -o root -g root -m 0755 /run/sshd`

## 4. Verification

The command `sudo sshd -t` was run again and returned no error output, indicating that the SSH configuration passed the syntax test.

A local SSH connection was also tested using:

`ssh sally@localhost`

The login succeeded, confirming local SSH access.

## 5. Result

The issue was resolved. SSH configuration validation and local SSH login were successful.

## 6. Lessons Learned

- Read error messages carefully before changing configuration.
- Check required runtime directories and permissions.
- Validate SSH configuration before relying on the service.
- Test SSH access in the approved local development environment.
- Do not expose passwords or private SSH keys in reports or Git repositories.

## 7. Scope and Limitations

This was a local SSH test inside Ubuntu on WSL2. It does not demonstrate access to a remote production server.
