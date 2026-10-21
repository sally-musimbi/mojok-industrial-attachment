# Assignment 003: PHP & MySQL Dynamic Website and Admin Dashboard

## Project Overview

This project extends the Nexora Digital Solutions website from Assignment 002 by introducing PHP and MySQL database functionality and a secure administration dashboard.

## Objectives

- Connect the website to a MySQL database using PHP PDO.
- Display services and portfolio projects dynamically.
- Implement secure administrator login and logout.
- Support creating, reading, updating, and deleting services and projects.
- Store and manage visitor enquiries.
- Apply server-side validation and security practices.

## Technologies

- HTML5
- CSS3
- JavaScript
- PHP
- MySQL
- PDO
- Git and GitHub

## Database Design

The database is named `nexora_db` and contains four tables:

- `admin_users`
- `services`
- `projects`
- `enquiries`

Database documentation is stored in the `database/` directory.

## Security Requirements

- Use PDO prepared statements for database queries.
- Store password hashes instead of plain-text passwords.
- Validate input on the server.
- Escape output before displaying user-provided content.
- Protect administrator pages with sessions.
- Regenerate the session ID after successful login.
- Use CSRF tokens to protect form submissions.
- Keep real environment credentials out of GitHub.


## Setup

1. Install PHP with the PDO MySQL extension, MySQL, and a local web server such as XAMPP.
2. Create the `nexora_db` database by importing `database/schema.sql` into MySQL.
3. Configure the database connection variables shown in `.env.example` in your local server environment. The example file documents the required values; PHP does not automatically load it.
4. Ensure `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, and `DB_PASSWORD` are available to PHP.
5. Start the local web server and open the project through its local server URL.
6. Create the initial administrator only in a trusted local development environment.

### Administrator Setup Security

`create-admin.php` is a temporary initial-account setup page. Do not expose it on a public server. After creating the first administrator, remove or disable the file before deployment. A CSRF token alone does not make public access to this page safe.

Never commit a real `.env` file, database passwords, or other secrets to GitHub.

## Testing

The `testing-report.md` file contains the planned test cases. Update the test statuses only after running and verifying each test.

## Current Progress

### Completed
- Database schema for admin users, services, projects, and enquiries.
- Entity Relationship Diagram (ERD).
- SQL query documentation.
- Example environment configuration.
- PHP database connection using PDO.
- Dynamic services and portfolio pages.
- Contact form for storing visitor enquiries.
- Administrator login and logout functionality.
- Admin dashboard and CRUD pages for services and projects.
- Enquiry listing and status management.
- Testing report with planned test cases.

### Remaining
- Review the project folder structure and file paths.
- Complete security checks and fix any issues found.
- Configure and run the project in a PHP/MySQL environment.
- Execute the test cases and record the actual results.
- Capture screenshots of the working website and dashboard.
- Complete the learning report.


## Learning Outcomes

This project provides practical experience in PHP development, relational database design, secure authentication, CRUD operations, server-side validation, CSRF protection, testing, and version control with Git and GitHub.

