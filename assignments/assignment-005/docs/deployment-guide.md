# Nexora Website Deployment Guide

## 1. Purpose
This guide documents the deployment and verification of the Nexora static website on an Ubuntu 24.04.5 LTS test environment using Apache HTTP Server.

## 2. Environment
- Operating system: Ubuntu 24.04.5 LTS
- Environment: WSL2 development environment
- Web server: Apache 2.4.58
- Website hostname: nexora.local
- Document root: /var/www/nexora
- HTTP port: 80
- HTTPS port: 443

## 3. Deployment procedure
1. Prepare an approved Ubuntu test environment.
2. Install Apache if it is not already installed.
3. Place the website files in /var/www/nexora.
4. Configure the Apache virtual host with ServerName nexora.local.
5. Set DocumentRoot to /var/www/nexora.
6. Configure the directory access rules.
7. Enable the required Apache site and SSL modules.
8. Configure HTTPS using a test certificate and protect its private key.
9. Validate the Apache configuration.
10. Reload Apache after approved configuration changes.
11. Test the website over HTTP and HTTPS.

## 4. Verification commands

Check Apache:
    sudo systemctl status apache2 --no-pager

Validate configuration:
    sudo apache2ctl configtest

List virtual hosts:
    sudo apache2ctl -S

Test HTTP:
    curl -I http://nexora.local

Test HTTPS with a local self-signed certificate:
    curl -k -I https://nexora.local

Inspect website permissions:
    stat -c '%A %a %U:%G %n' /var/www/nexora /var/www/nexora/index.html

## 5. Backup and restore

Create a backup:
    tar -czf ~/nexora-backup.tar.gz -C /var/www nexora

Inspect the archive:
    tar -tzf ~/nexora-backup.tar.gz

Restore into a separate test directory:
    mkdir -p ~/nexora-restore
    tar -xzf ~/nexora-backup.tar.gz -C ~/nexora-restore

Compare restored files:
    diff -qr /var/www/nexora ~/nexora-restore/nexora

A successful comparison produces no output.

## 6. Security precautions
- Keep private SSL keys out of public repositories.
- Never commit passwords, access tokens or private keys.
- Use approved test environments and credentials.
- Use SSH key authentication where appropriate.
- Do not change production DNS or server settings without authorization.
- Test backups before relying on them.

## 7. Actual test results
The Nexora deployment was verified in the Ubuntu WSL2 test environment:
- Apache service: active and running.
- Apache configuration: Syntax OK.
- HTTP request: 200 OK.
- HTTPS request: 200 OK using curl -k.
- HTTP and HTTPS virtual hosts: present.
- SSH local login as sally: successful.
- Website backup: created and inspected.
- Restore comparison: no differences found.

The HTTPS certificate is self-signed and is intended for local testing, not public production use.

## 8. Limitations
The SSH test was performed locally using localhost. A connection to a separate remote server was not demonstrated. Production deployment and public DNS changes were outside the scope of this test.
