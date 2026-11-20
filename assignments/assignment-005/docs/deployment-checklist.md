# Nexora Website Deployment Checklist

## A. Preparation
- [ ] Confirm authorization to use the test environment.
- [ ] Confirm Ubuntu and Apache versions.
- [ ] Identify the website source files.
- [ ] Keep private keys, passwords and tokens secure.
- [ ] Create a backup before making changes.

## B. Linux administration
- [ ] Check the working directory using pwd.
- [ ] Inspect files using ls and find.
- [ ] Check disk space using df -h.
- [ ] Check memory using free -h.
- [ ] Inspect processes using ps.
- [ ] Understand ownership and permissions.

## C. Apache configuration
- [ ] Check Apache service status.
- [ ] Configure the website document root.
- [ ] Configure the HTTP virtual host.
- [ ] Configure the HTTPS virtual host where authorized.
- [ ] Validate configuration using apache2ctl configtest.
- [ ] Inspect virtual hosts using apache2ctl -S.

## D. Website verification
- [ ] Confirm the homepage loads.
- [ ] Check all website pages.
- [ ] Check CSS, JavaScript and image assets.
- [ ] Test HTTP response.
- [ ] Test HTTPS response.
- [ ] Inspect access and error logs.

## E. SSH
- [ ] Check SSH service and socket status.
- [ ] Validate SSH configuration using sshd -t.
- [ ] Inspect SSH authentication settings.
- [ ] Test an authorized SSH connection.
- [ ] Protect credentials and private keys.

## F. Backup and restore
- [ ] Create a compressed website backup.
- [ ] Inspect archive contents.
- [ ] Restore to a separate test directory.
- [ ] Compare restored files with the originals.
- [ ] Record verification results.

## G. Documentation and delivery
- [ ] Document deployment steps.
- [ ] Include the deployment flow diagram.
- [ ] Document troubleshooting and resolution.
- [ ] Capture terminal evidence with secrets hidden.
- [ ] Review Git changes before committing.
- [ ] Confirm no private keys or credentials are included.
- [ ] Prepare the final PDF report.
