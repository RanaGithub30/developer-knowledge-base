# Question: How do you prevent double booking in a high-traffic booking system?

## Problem

In a booking system (hotel, cab, ticket booking), multiple users may try to book the same resource at the same time.

The system should:
- Prevent double booking
- Handle concurrent requests
- Maintain consistency
- Scale for high traffic

---

# Solution

## 1. Database Constraint (Final Safety Layer)

Use a unique constraint to ensure only one booking is created.

Example:

```sql
UNIQUE(resource_id, booking_date)
```

If multiple requests arrive together, the database allows only one successful booking.

---

## 2. Transaction & Locking

Perform booking inside a transaction.

Flow:

```
BEGIN TRANSACTION

Check availability
Lock resource
Create booking

COMMIT
```

Use row-level locking (`SELECT FOR UPDATE`) to prevent race conditions.

---

## 3. Optimistic Locking

Maintain a version field and update only if the version matches.

Example:

```
Resource:
id = 101
status = AVAILABLE
version = 5
```

If another user books first, the version changes and the update fails.

---

## 4. Redis Distributed Lock

For high traffic, use Redis to temporarily lock the resource.

Flow:

```
User A → Acquire Lock → Book → Release Lock

User B → Wait/Retry → Booking Failed
```

---

## 5. Idempotency

Use an idempotency key to handle duplicate requests caused by retries.

Example:

```
Idempotency-Key: abc123
```

Repeated requests return the existing booking result.

---

# Architecture

```
Client
 |
API Gateway
 |
Booking Service
 |
Redis Lock
 |
Database Transaction
 |
Booking Database
 |
Message Queue
```

---

# Interview Summary

Use **database constraints + transactions** for correctness, **Redis locks** for high concurrency, and **idempotency** for duplicate requests. For payment-based bookings, use a temporary reservation state (`AVAILABLE → HELD → BOOKED`) to avoid holding resources permanently.

This ensures no double booking while maintaining scalability and performance.