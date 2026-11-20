# Assignment 005: Linux Server Administration and Website Deployment

## 1. Introduction

This report documents the deployment and administration of the Nexora static website in an Ubuntu 24.04 WSL2 development environment. The work covered Linux administration, Apache configuration, virtual hosting, HTTP and HTTPS testing, SSH validation, website backup and restoration, and technical documentation.

All activities were performed in a local development environment, not on a production server.

## 2. Environment and Tools

- Operating system: Ubuntu 24.04.5 LTS
- Environment: Windows Subsystem for Linux 2 (WSL2)
- Web server: Apache 2.4.58
- Website: Nexora static website
- Document root: /var/www/nexora
- Local hostname: nexora.local
- Tools: Bash, Apache utilities, curl, OpenSSL, SSH, tar, SHA-256, Git

## 3. Linux Server Administration

The Linux environment was inspected using standard administration commands.

Tasks included:
- Inspecting disk capacity with df.
- Inspecting memory and swap usage with free.
- Inspecting running processes.
- Checking Apache service status with systemctl.
- Validating Apache configuration with apache2ctl.
- Inspecting file ownership and permissions.
- Reviewing Apache access and error logs.

The website directory was owned by sally:www-data with directory permissions set to 755. Website files were readable by the web server.

## 4. Apache Website Deployment

The Nexora website was deployed to:

`/var/www/nexora`

The Apache HTTP virtual host was configured with:
- ServerName: nexora.local
- ServerAlias: www.nexora.local
- DocumentRoot: /var/www/nexora
- A dedicated access log and error log.

The HTTPS virtual host was configured to use a TLS certificate and private key stored outside the website directory.

Apache configuration validation returned:

`Syntax OK`

Apache service status was confirmed as active and running.

## 5. Website Access and Testing

The local hostname nexora.local was used to test the website.

HTTP test:

`curl -I http://nexora.local`

Result: HTTP/1.1 200 OK

HTTPS test:

`curl -k -I https://nexora.local`

Result: HTTP/1.1 200 OK

The -k option was used because the local certificate is self-signed. It bypasses certificate trust validation for this test; it does not establish public certificate trust.

The website's HTML, CSS, and JavaScript resources were requested successfully. Apache access logs recorded successful HTTP requests.

## 6. SSL/TLS Configuration

A self-signed certificate was configured for the local hostname nexora.local.

Certificate details:
- Subject: CN=nexora.local
- Issuer: CN=nexora.local
- Validity: 10 November 2026 to 10 November 2027

The HTTPS virtual host used port 443 and enabled Apache SSL.

This certificate is suitable only for the local test environment. A publicly trusted certificate would be required for a production website.

## 7. SSH Administration and Testing

SSH configuration was checked using:

`sudo sshd -t`

An initial test reported that /run/sshd was missing. The runtime directory was created with root ownership and appropriate permissions. The SSH syntax test then completed without errors.

A local SSH login was tested using:

`ssh sally@localhost`

The login succeeded. This confirms local SSH access in WSL2, not remote access to another server.

## 8. Website Backup and Restoration

A compressed website archive was created at:

`~/assignment-005-backups/nexora-website-2026-11-20.tar.gz`

The archive contents were inspected using tar.

The archive was extracted into:

`~/assignment-005-restore`

The original and restored index.html files had matching SHA-256 checksums:

`e4b6030a5f071a20bce77e97c7f0d04faa09da05befcad1efe57d244ec250758`

A recursive directory comparison using diff -qr returned no differences.

This verified that the website files were restored successfully.

The archive covered the website directory. It did not include the Apache configuration or TLS private key.

## 9. Monitoring and Log Inspection

Apache service status was checked using systemctl.

Apache access and error logs were inspected to observe requests and identify potential problems. Successful page and asset requests returned HTTP 200 responses.

A request for /favicon.ico returned HTTP 404 because the favicon was not present. This was a minor observation and did not prevent the website from loading.

## 10. Documentation and Version Control

The following documentation was prepared:

- docs/deployment-guide.md
- docs/deployment-checklist.md
- docs/deployment-flow.md
- docs/troubleshooting-report.md

The deployment flow diagram describes the browser, local hostname resolution, WSL2 environment, Apache virtual hosts, TLS certificate, document root, and website resources.

The project is maintained in a Git repository. Changes will be reviewed before staging and committing. Passwords, tokens, and private keys must not be committed.

## 11. Limitations and Further Work

The following activities were not demonstrated as completed:

- Deployment to a remote production server.
- Remote SSH access from another machine.
- Public DNS configuration and public internet access.
- Publicly trusted SSL certificate installation.
- A full Nginx deployment comparison or migration.
- Automated monitoring and alerting.

These activities would require additional infrastructure or testing beyond the local WSL2 environment.

## 12. Conclusion

The Nexora static website was successfully deployed on Apache in Ubuntu WSL2. Apache configuration validation passed, local HTTP and HTTPS requests returned HTTP 200, and a local SSH login succeeded.

The website backup was restored successfully, with matching checksums and no directory differences. Supporting deployment and troubleshooting documentation was also prepared.

The project demonstrates practical Linux server administration and local website deployment while identifying the limitations of a development environment.
