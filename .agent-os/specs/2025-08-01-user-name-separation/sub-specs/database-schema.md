# Database Schema

This is the database schema implementation for the spec detailed in @.agent-os/specs/2025-08-01-user-name-separation/spec.md

## Migration: Replace Name Field with Separated Fields

### Remove Old Column and Add New Columns

```sql
ALTER TABLE users 
DROP COLUMN name,
ADD COLUMN first_name VARCHAR(255) NOT NULL,
ADD COLUMN middle_name VARCHAR(255),
ADD COLUMN last_name VARCHAR(255) NOT NULL,
ADD COLUMN suffix VARCHAR(50);
```

### Indexes

```sql
-- Add index on last_name, first_name for efficient name-based searches
CREATE INDEX idx_users_last_first_name ON users(last_name, first_name);
```

### Constraints

- `first_name`: NOT NULL, VARCHAR(255)
- `middle_name`: NULL allowed, VARCHAR(255)
- `last_name`: NOT NULL, VARCHAR(255)
- `suffix`: NULL allowed, VARCHAR(50)

### Laravel Migration File Structure

```php
Schema::table('users', function (Blueprint $table) {
    $table->dropColumn('name');
    $table->string('first_name');
    $table->string('middle_name')->nullable();
    $table->string('last_name');
    $table->string('suffix', 50)->nullable();
    
    $table->index(['last_name', 'first_name']);
});
```

## Rationale

- **Separate fields**: Provides better data structure and allows for more flexible formatting
- **Required fields**: First and last names are required as they are essential for most use cases
- **Optional fields**: Middle name and suffix are optional to accommodate various naming conventions
- **Index on names**: Improves performance for user searches by name
- **Clean start**: Since we're in development, we can drop the old name column and start fresh with the new structure