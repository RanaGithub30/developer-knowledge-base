# Database Interview — 7 Must-Know Questions & Answers

## 1. What is a Database Index and why do we use it?

**Answer:**
A database index is a data structure that helps the database **find rows faster** without scanning the entire table.

Example:

```sql
CREATE INDEX idx_users_email ON users(email);
```

Indexes are useful for columns frequently used in:

* `WHERE`
* `JOIN`
* `ORDER BY`
* `GROUP BY`

**Trade-off:**
Indexes improve read performance but require additional storage and can slow down `INSERT`, `UPDATE`, and `DELETE`.

**One-liner:**

> An index speeds up data retrieval by reducing the amount of data the database needs to scan.

---

## 2. What is a Composite Index and when would you use it?

**Answer:**
A Composite Index is an index created on **multiple columns**.

Example:

```sql
CREATE INDEX idx_orders_user_status
ON orders(user_id, status);
```

Use it when queries commonly filter or sort by those columns together.

Example:

```sql
SELECT *
FROM orders
WHERE user_id = 10
AND status = 'pending';
```

**Important:**
Column order matters. An index on `(user_id, status)` is most useful when the query uses `user_id` as the leading column.

**One-liner:**

> Use a Composite Index when multiple columns are commonly used together in query conditions.

---

## 3. What is `EXPLAIN` and how would you investigate a slow query?

**Answer:**
`EXPLAIN` shows **how the database plans to execute a query**.

Example:

```sql
EXPLAIN SELECT *
FROM users
WHERE email = 'test@example.com';
```

I would check:

* Whether an index is being used
* Number of rows being scanned
* Full table scans
* Join strategy
* Sort operations
* Query execution time

Then I would optimize by:

* Adding or improving indexes
* Reducing unnecessary columns
* Optimizing joins
* Rewriting the query if necessary

**One-liner:**

> `EXPLAIN` helps identify why a query is slow and whether the database is using indexes efficiently.

---

## 4. What is a Database Transaction and what are ACID properties?

**Answer:**
A transaction treats multiple database operations as **one unit of work**.

Example:

```text
Deduct money
     ↓
Add money
     ↓
Both succeed → COMMIT
Any failure → ROLLBACK
```

### ACID

* **Atomicity** → All operations succeed or all are rolled back.
* **Consistency** → Data remains valid according to database rules.
* **Isolation** → Concurrent transactions do not improperly interfere with each other.
* **Durability** → Committed data persists even after a failure.

**One-liner:**

> ACID ensures transactions are reliable, consistent, and safe.

---

## 5. What is a Database Deadlock and how would you handle it?

**Answer:**
A deadlock occurs when **two or more transactions wait for each other to release locks**, so none of them can continue.

Example:

```text
Transaction A locks Row 1
        ↓
Transaction B locks Row 2
        ↓
A waits for Row 2
B waits for Row 1
        ↓
Deadlock
```

### How to handle it:

* Keep transactions short
* Access tables/rows in a consistent order
* Avoid unnecessary locks
* Use appropriate indexes
* Retry the transaction when appropriate

In Laravel, `DB::transaction()` can be configured with retry attempts for deadlocks:

```php
DB::transaction(function () {
    // Database operations
}, 5);
```

**One-liner:**

> Prevent deadlocks by keeping transactions short and consistent, and retry when appropriate.

---

## 6. What is the difference between `paginate()` and `cursorPaginate()`?

**Answer:**

### `paginate()`

Uses **offset-based pagination**.

```php
User::paginate(20);
```

It is simple and provides page numbers, but becomes less efficient for very large datasets because the database may need to skip many rows.

### `cursorPaginate()`

Uses **cursor-based pagination**.

```php
User::orderBy('id')->cursorPaginate(20);
```

It is more efficient for large datasets and is useful for APIs or infinite scrolling.

| `paginate()`                    | `cursorPaginate()`               |
| ------------------------------- | -------------------------------- |
| Offset-based                    | Cursor-based                     |
| Supports page numbers           | Uses next/previous cursor        |
| Can become slower on deep pages | Efficient for large datasets     |
| Good for traditional pagination | Good for APIs/infinite scrolling |

**One-liner:**

> Use `paginate()` for normal page-based navigation and `cursorPaginate()` for large datasets and continuous/infinite scrolling.

---

## 7. A query/API is slow. How would you optimize it?

**Answer:**
I would **measure first, then optimize the actual bottleneck**.

### Step 1 — Investigate

* Check application logs
* Identify slow queries
* Use `EXPLAIN`
* Check indexes
* Look for N+1 queries
* Check external API latency
* Check cache performance

### Step 2 — Optimize

* Add appropriate indexes
* Optimize SQL/Eloquent queries
* Fix N+1 using eager loading
* Select only required columns
* Use pagination
* Add caching where appropriate
* Move heavy work to queues
* Optimize external API calls

**Interview answer:**

> First I identify whether the bottleneck is the database, application code, cache, or external service. Then I use tools like `EXPLAIN` and query profiling to find the root cause and optimize based on evidence rather than guessing.