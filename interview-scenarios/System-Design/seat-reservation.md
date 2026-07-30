# Question: How do you prevent double booking when a user selects a seat but has not completed payment?

## Scenario

User A selects a seat and goes to payment. Before payment completion, User B tries to book the same seat.

How do we temporarily block the seat?

---

# Solution: Temporary Seat Reservation

Use a **seat locking / reservation mechanism**.

Seat lifecycle:

```
AVAILABLE
    |
    v
HELD (5 minutes)
    |
    +----------------+
    |                |
Payment Success   Timeout/Cancel
    |                |
    v                v
BOOKED          AVAILABLE
```

---

# Flow

## 1. User Selects Seat

Create a temporary lock:

```
Seat: A10
Status: HELD
User: User_A
Expiry: 5 minutes
```

Other users cannot book the seat while it is in `HELD` state.

---

## 2. Payment Success

Update status:

```
HELD → BOOKED
```

---

## 3. Payment Failure / Timeout

After expiry:

```
HELD → AVAILABLE
```

The seat becomes available again.

---

# Database Design

```sql
CREATE TABLE seats (
    seat_id VARCHAR(10) PRIMARY KEY,
    status VARCHAR(20),
    locked_by VARCHAR(50),
    locked_until TIMESTAMP
);
```

---

# Handling Concurrent Requests

If multiple users select the same seat:

```
User A + User B
        |
        v
Database Lock / Redis Lock
        |
        v
Only one user gets the seat
```

---

# Redis Lock (For High Traffic)

Use Redis for temporary seat locking:

```redis
SET seat:A10 User_A NX EX 300
```

- NX → Create lock only if it does not exist
- EX → Automatically expire after 300 seconds

---

# Architecture

```
User
 |
API Gateway
 |
Booking Service
 |
Redis Lock
 |
Database
 |
Payment Service
```

---

# Interview Summary

Use a temporary reservation system. When a user selects a seat, mark it as **HELD** with an expiry time. Other users cannot reserve that seat until the lock expires or payment is completed.

After successful payment:

```
HELD → BOOKED
```

If payment fails or timeout occurs:

```
HELD → AVAILABLE
```

This prevents double booking while maintaining high performance.