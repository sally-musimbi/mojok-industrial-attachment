# SQL Queries and Notes

## 1. SELECT

Retrieves records from a database table.

```sql
SELECT * FROM services;
```

This query retrieves all services.

## 2. INSERT

Adds a new record to a table.

```sql
INSERT INTO services (title, description)
VALUES ('Web Development', 'Website design and development services');
```

This query adds a new service.

## 3. UPDATE

Modifies an existing record.

```sql
UPDATE services
SET title = 'Website Development'
WHERE id = 1;
```

This query updates the title of the service with ID 1.

## 4. DELETE

Removes a record from a table.

```sql
DELETE FROM services
WHERE id = 1;
```

This query deletes the service with ID 1. The `WHERE` clause is important to avoid deleting every record.

## 5. JOIN

Combines related records from two or more tables using a matching column.

Example using the enquiries table and a hypothetical admin assignment table:

```sql
SELECT enquiries.name, enquiries.subject
FROM enquiries
INNER JOIN enquiry_assignments
    ON enquiries.id = enquiry_assignments.enquiry_id;
```

This illustrates an `INNER JOIN`, which returns matching records from both tables.

**Note:** `enquiry_assignments` is not currently included in the project schema. This is an illustrative example, not a query to run against the current database.

## Conclusion

These SQL operations support retrieving, adding, updating, deleting, and combining database records. In the application, database changes should use prepared statements through PDO.
