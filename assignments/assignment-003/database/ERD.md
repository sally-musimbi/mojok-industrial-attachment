# Entity Relationship Diagram (ERD)

## Database: nexora_db

This diagram represents the four tables in the Nexora Digital Solutions website database.

```mermaid
erDiagram
    ADMIN_USERS {
        int id PK
        varchar username
        varchar email
        varchar password_hash
        timestamp created_at
    }

    SERVICES {
        int id PK
        varchar title
        text description
        timestamp created_at
        timestamp updated_at
    }

    PROJECTS {
        int id PK
        varchar title
        text description
        varchar image_url
        timestamp created_at
        timestamp updated_at
    }

    ENQUIRIES {
        int id PK
        varchar name
        varchar email
        varchar subject
        text message
        enum status
        timestamp created_at
    }
```

## Explanation

- **admin_users:** Stores administrator accounts and securely hashed passwords.
- **services:** Stores the services displayed on the website.
- **projects:** Stores portfolio project information and optional image URLs.
- **enquiries:** Stores visitor messages and their processing status.

Each table has its own primary key (`id`). The current schema does not define foreign-key relationships between these tables.
