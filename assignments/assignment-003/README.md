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

1. Install PHP, MySQL, and a local web server such as XAMPP.
2. Create the `nexora_db` database using `database/schema.sql`.
3. Configure local database credentials using the environment configuration approach selected for the project.
4. Create a local administrator account with a securely generated password hash.
5. Start the local server and test the website.

Never commit a real `.env` file or actual database passwords.

## Testing

The `testing-report.md` file contains the planned test cases. Update the test statuses only after running and verifying each test.

## Current Progress

Completed documentation files:

- `database/schema.sql`
- `database/ERD.md`
- `database/sql-queries.md`
- `.env.example`
- `testing-report.md`

The PHP implementation, admin dashboard, and final testing remain to be completed.

## Learning Outcomes

This project provides practical experience in PHP development, relational database design, secure authentication, CRUD operations, testing, and version control.
