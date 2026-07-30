# Pessimistic Locking in Database

## What is Pessimistic Locking?

Pessimistic locking is a database locking mechanism where a record is locked before updating it.

It assumes that multiple users may try to modify the same data at the same time, so the system locks the resource first to prevent conflicts.

---

# Example: Booking System

Scenario:

```
User A and User B try to book the same seat
```

Without locking:

```
User A checks seat → Available

User B checks seat → Available

User A books seat

User B also books seat

Result: Double Booking
```

With pessimistic locking:

```
User A locks seat

User B waits

User A completes booking

User B checks availability

Booking rejected
```

---

# How Pessimistic Lock Works

SQL Example:

```sql
SELECT *
FROM seats
WHERE id = 101
FOR UPDATE;
```

`FOR UPDATE` locks the selected row until the transaction completes.

Flow:

```
BEGIN TRANSACTION

Lock resource

Update resource

COMMIT
```

---

# Example

Initial state:

```
Seat A10

Status: AVAILABLE
```

User A:

```
BEGIN

Lock Seat A10

Update:
AVAILABLE → BOOKED

COMMIT
```

User B:

```
Try locking Seat A10

Wait for User A transaction

Check status

Booking rejected
```

---

# Pessimistic Locking in Laravel

Pessimistic locking is not a Laravel or PHP feature.

It is a **database feature**.

Laravel provides a wrapper to use database locks.

Example:

```php
DB::transaction(function () {

    $seat = Seat::where('id', 101)
                ->lockForUpdate()
                ->first();

    if ($seat->status == 'AVAILABLE') {

        $seat->update([
            'status' => 'BOOKED'
        ]);

    }

});
```

Laravel:

```php
lockForUpdate()
```

generates SQL:

```sql
SELECT *
FROM seats
WHERE id = 101
FOR UPDATE;
```

---

# Supported Databases

Pessimistic locking is supported by:

- MySQL (InnoDB)
- PostgreSQL
- Oracle
- SQL Server

---

# Advantages

✅ Prevents race conditions  
✅ Ensures strong consistency  
✅ Simple implementation  
✅ Suitable for critical resources  

Examples:

- Seat booking
- Hotel room booking
- Inventory management
- Payment processing

---

# Disadvantages

❌ Reduces performance under heavy traffic  
❌ Requests may wait for locks  
❌ Can cause deadlocks if not handled properly  

---

# When to Use Pessimistic Locking?

Use it when:

- Multiple users frequently update the same data
- Data conflicts are expensive
- Only one user should modify a resource at a time

---

# Pessimistic vs Optimistic Locking

| Pessimistic Locking | Optimistic Locking |
|---|---|
| Locks data before update | Checks version before update |
| Uses database locks | Uses version fields |
| Prevents conflicts upfront | Detects conflicts later |
| Uses `FOR UPDATE` | Uses version checking |
| Better for high-conflict data | Better for high-read systems |

---

# Interview Summary

Pessimistic locking is a database-level locking mechanism where a row is locked before updating it. In Laravel, we use `lockForUpdate()` inside a transaction, which internally uses SQL `SELECT FOR UPDATE`.

It is commonly used in booking systems to ensure that when multiple users try to reserve the same resource, only one request succeeds and double booking is prevented.