# Optimistic Locking in Database

## What is Optimistic Locking?

Optimistic locking is a database concurrency control mechanism where we **do not lock the record** while reading.

Instead, we assume conflicts are rare and check whether the data was modified before updating.

If another user has already updated the record, the update fails.

---

# Example: Booking System

Scenario:

```
User A and User B try to book the same seat
```

Without optimistic locking:

```
User A reads seat → AVAILABLE

User B reads seat → AVAILABLE

User A books seat

User B also books seat

Result: Double Booking
```

With optimistic locking:

```
User A reads seat with version = 1

User B reads seat with version = 1


User A updates seat

version: 1 → 2


User B tries update

Version mismatch

Booking rejected
```

---

# How Optimistic Lock Works

Add a version column:

Example:

```
Seats Table

seat_id | status      | version
--------------------------------
A10     | AVAILABLE   | 1
```

User reads:

```
seat_id = A10
version = 1
```

Update query:

```sql
UPDATE seats
SET status='BOOKED',
    version=version+1
WHERE seat_id='A10'
AND version=1;
```

---

# Update Result

## Success

```
Rows updated = 1
```

Booking successful.

Database:

```
seat_id | status | version
--------------------------
A10     | BOOKED | 2
```

---

## Failure

```
Rows updated = 0
```

Means another user already updated the record.

Action:

```
Retry or show "Seat already booked"
```

---

# Optimistic Locking Flow

```
Read Resource

      |
      v

Get Current Version

      |
      v

Update With Version Check

      |
      |
  ----------------
  |              |
Success        Failed
  |              |
  v              v
Booked      Retry / Reject
```

---

# Optimistic Locking in Laravel

Optimistic locking is not built into Laravel by default.

It is implemented using a version column.

Example:

Migration:

```php
Schema::table('seats', function ($table) {
    $table->integer('version')->default(1);
});
```

Update:

```php
$updated = Seat::where('id', 101)
    ->where('version', $currentVersion)
    ->update([
        'status' => 'BOOKED',
        'version' => $currentVersion + 1
    ]);

if ($updated == 0) {
    throw new Exception('Seat already booked');
}
```

---

# Supported Databases

Optimistic locking can be implemented with:

- MySQL
- PostgreSQL
- Oracle
- SQL Server

It works using:

- Version column
- Timestamp column
- Updated_at column

---

# Advantages

✅ No database locks  
✅ Better performance  
✅ Higher throughput  
✅ Suitable for high-read systems  
✅ Scales well with many users  

---

# Disadvantages

❌ Failed updates require retry handling  
❌ More application logic needed  
❌ Not ideal when conflicts happen frequently  

---

# When to Use Optimistic Locking?

Use it when:

- Reads are much higher than writes
- Conflicts are rare
- Performance is important

Examples:

- Product inventory
- User profile updates
- Document editing
- Booking availability checks

---

# Optimistic vs Pessimistic Locking

| Optimistic Locking | Pessimistic Locking |
|---|---|
| Does not lock records | Locks records before update |
| Checks version before update | Uses database locks |
| Better performance | Strong consistency |
| Good for low-conflict data | Good for high-conflict data |
| Uses version column | Uses `FOR UPDATE` |

---

# Interview Summary

Optimistic locking is a database concurrency technique where we avoid locking rows during reads. Instead, we store a version number and check it during updates. If the version has changed, it means another user modified the data, so the update fails.

In booking systems, optimistic locking improves scalability by allowing multiple users to read availability while ensuring that only one user can successfully complete the booking.