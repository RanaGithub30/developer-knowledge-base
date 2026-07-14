# Laravel Migrations - Interview Questions & Answers

## Q1. What are Migrations in Laravel?

### Answer

**Migrations** are Laravel's version control system for databases.

They allow developers to create, modify, and manage database tables using PHP code instead of writing SQL manually.

Migrations make it easy to share and synchronize database structures across development, testing, and production environments.

---

## Q2. Why do we use Migrations?

### Answer

Migrations are used to:

- Version control the database schema
- Create and modify database tables
- Keep database structure consistent across environments
- Collaborate with team members
- Roll back database changes when needed
- Eliminate the need for manual SQL scripts

---

## Q3. How do Migrations work?

### Answer

The migration workflow is:

```text
Create Migration
        │
        ▼
Write Schema
        │
        ▼
Run Migration
        │
        ▼
Database Updated
```

Laravel keeps track of executed migrations in the `migrations` table to prevent running the same migration multiple times.

---

## Q4. Where are Migration files stored?

### Answer

Migration files are stored in:

```text
database/migrations
```

Each migration file has a timestamp to ensure migrations run in the correct order.

Example:

```text
2026_01_10_120000_create_users_table.php
```

---

## Q5. How do you create a Migration?

### Answer

Use the Artisan command:

```bash
php artisan make:migration create_products_table
```

Laravel creates a new migration file in:

```text
database/migrations
```

---

## Q6. What are the `up()` and `down()` methods?

### Answer

Every migration contains two methods:

- `up()` → Applies the migration.
- `down()` → Reverts the migration.

Example:

```php
public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('products');
}
```

---

## Q7. How do you run all pending migrations?

### Answer

Use the Artisan command:

```bash
php artisan migrate
```

Laravel executes all pending migrations that have not yet been run.

---

## Q8. How do you roll back the last migration?

### Answer

Use the Artisan command:

```bash
php artisan migrate:rollback
```

This reverts the most recent batch of migrations.

---

## Q9. How do you roll back all migrations?

### Answer

Use the Artisan command:

```bash
php artisan migrate:reset
```

This rolls back all executed migrations.

---

## Q10. How do you refresh the database?

### Answer

Use the Artisan command:

```bash
php artisan migrate:refresh
```

This command:

1. Rolls back all migrations.
2. Runs all migrations again.

It is useful during development.

---

## Q11. How do you recreate the database from scratch?

### Answer

Use the Artisan command:

```bash
php artisan migrate:fresh
```

This command:

- Drops all tables.
- Runs all migrations again.

It is commonly used in development and testing.

---

## Q12. How do you create a table using a Migration?

### Answer

Example:

```php
Schema::create('products', function (Blueprint $table) {

    $table->id();

    $table->string('name');

    $table->decimal('price', 8, 2);

    $table->timestamps();

});
```

Laravel creates the `products` table with the specified columns.

---

## Q13. How do you add a new column to an existing table?

### Answer

Create a migration:

```bash
php artisan make:migration add_description_to_products_table
```

Example:

```php
Schema::table('products', function (Blueprint $table) {

    $table->text('description')->nullable();

});
```

---

## Q14. How do you remove a column from a table?

### Answer

Example:

```php
Schema::table('products', function (Blueprint $table) {

    $table->dropColumn('description');

});
```

Laravel removes the specified column.

---

## Q15. What column types are commonly used in Migrations?

### Answer

Common column types include:

- `id()`
- `string()`
- `text()`
- `integer()`
- `bigInteger()`
- `boolean()`
- `decimal()`
- `float()`
- `double()`
- `date()`
- `dateTime()`
- `timestamp()`
- `json()`
- `uuid()`
- `foreignId()`
- `timestamps()`

---

## Q16. How do you define foreign keys in Migrations?

### Answer

Example:

```php
$table->foreignId('user_id')
      ->constrained()
      ->cascadeOnDelete();
```

This creates a foreign key relationship with the `users` table.

---

## Q17. What is the `Schema` Facade?

### Answer

The `Schema` facade provides methods for creating and modifying database tables.

Example:

```php
use Illuminate\Support\Facades\Schema;
```

Common methods include:

- `create()`
- `table()`
- `drop()`
- `dropIfExists()`
- `hasTable()`
- `hasColumn()`

---

## Q18. What are some commonly used Migration Artisan commands?

### Answer

Create a migration:

```bash
php artisan make:migration create_orders_table
```

Run migrations:

```bash
php artisan migrate
```

Rollback:

```bash
php artisan migrate:rollback
```

Refresh:

```bash
php artisan migrate:refresh
```

Fresh migration:

```bash
php artisan migrate:fresh
```

Check migration status:

```bash
php artisan migrate:status
```

---

## Q19. What are the advantages of using Migrations?

### Answer

Migrations provide several benefits:

- Database version control
- Easy collaboration
- Reproducible database structure
- Rollback support
- Simplified deployment
- Database portability
- Better maintainability

---

## Q20. What is the difference between Migrations and Seeders?

### Answer

| Migrations | Seeders |
|------------|---------|
| Manage database structure | Populate database with data |
| Create and modify tables | Insert sample or initial records |
| Define schema | Define data |
| Run with `migrate` | Run with `db:seed` |

---

## Q21. Give a real-world example of Migrations.

### Answer

Consider an e-commerce application.

```text
Migration
     │
     ▼
Create Products Table
     │
     ▼
Create Orders Table
     │
     ▼
Create Order Items Table
     │
     ▼
Database Ready
```

Each table is created using a separate migration, making the database structure organized and easy to maintain.

---

## Q22. Why are Migrations important in Laravel?

### Answer

Migrations are a core feature of Laravel's database management system.

They:

- Version control the database schema
- Simplify database changes
- Support team collaboration
- Enable safe rollbacks
- Work seamlessly with Seeders, Factories, and Eloquent
- Help build maintainable and scalable applications