# How Do You Prevent Duplicate API Requests? What Is Idempotency?

## Answer

> "Duplicate API requests can happen when a user clicks a button twice, the network is slow, or a request is retried after a timeout. To prevent duplicate operations, I use an idempotency key. The client sends a unique key with the request, and the server stores that key along with the result. If the same request comes again with the same key, the server returns the previous result instead of performing the operation again."

## What Is Idempotency?

**Idempotency** means that making the same request multiple times produces the **same final result** as making it once.

For example, imagine a payment request:

```text
Request 1:
Payment ₹1,000
Idempotency-Key: ABC123

Request 2:
Payment ₹1,000
Idempotency-Key: ABC123
```

The server sees that `ABC123` was already processed, so it **does not charge the customer again**.

```text
First request
     ↓
ABC123 not found
     ↓
Process payment
     ↓
Store result for ABC123
     ↓
Return success


Same request again
     ↓
ABC123 already exists
     ↓
Do NOT process again
     ↓
Return previous result
```

## How to Implement It

The client sends a unique key:

```http
POST /payments
Idempotency-Key: ABC123
```

The server stores something like:

```text
idempotency_key | status  | response
----------------|---------|----------------
ABC123          | success | payment_id=101
```

When another request comes with `ABC123`, the server checks the database first.

```pseudo
if idempotencyKey already exists:
    return previous response

else:
    process request
    save idempotencyKey + response
    return response
```

## Important Point

The **idempotency key should be unique for each logical operation**.

For example:

```text
Create Payment #1 → ABC123
Create Payment #2 → XYZ456
```

If the first payment request times out, the client can safely retry using `ABC123`.

## Where Is Idempotency Useful?

It is especially useful for operations such as:

* Payments
* Order creation
* Booking
* Account creation
* Sending important commands
* Any API operation where duplicate processing can cause a problem

## Simple Real-World Example

Suppose a user clicks **"Pay Now"** twice:

```text
User
 ↓
Pay Now
 ↓
API
 ↓
Payment processed
```

Without idempotency:

```text
Click 1 → ₹1,000 charged
Click 2 → ₹1,000 charged again ❌
```

With idempotency:

```text
Click 1 → ₹1,000 charged
Click 2 → Same request detected
        → No second charge ✅
```

## Best Short Interview Answer

> **"To prevent duplicate API requests, especially for operations like payments, I use idempotency keys. The client sends a unique key with the request. The server stores that key and the result. If the same key is received again, the server doesn't perform the operation again; it returns the previous result. This makes retries safe and prevents duplicate operations."**

## Remember

**Unique Key → Check → Process Once → Store Result → Return Same Result**