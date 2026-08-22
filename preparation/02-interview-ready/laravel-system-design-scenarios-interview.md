# Laravel System Design Scenarios — 4 Interview Q&A

## 1. Payment successful but database update failed — what would you do?

**Answer:**
I would treat this as a **distributed transaction problem**, because the payment provider and our database cannot usually be committed in one database transaction.

I would:

1. Use a unique **payment/transaction ID**.
2. Store the payment attempt/status in our database.
3. After payment succeeds, update the payment status to `paid`.
4. If the database update fails, use the payment provider's **webhook** to recover the final status.
5. Make the webhook and payment update **idempotent**.
6. Use retries/queue processing for temporary failures.
7. Reconcile payments periodically with the payment provider.

**Example flow:**

```text
Create Payment
     ↓
Payment Provider
     ↓
Payment Successful
     ↓
DB Update ❌
     ↓
Webhook / Retry
     ↓
Verify Payment
     ↓
Update DB → PAID
```

**Interview one-liner:**

> I would rely on payment IDs, webhooks, retries, idempotency, and reconciliation instead of assuming the payment and database update can happen atomically.

---

## 2. What is a Webhook and how would you handle duplicate Webhooks?

**Answer:**
A Webhook is an **HTTP callback sent by an external service** to notify our application that an event has occurred.

Example:

```text
Payment Provider
      ↓
POST /webhooks/payment
      ↓
Laravel
      ↓
Process Payment Event
```

### Handling duplicate webhooks

I would make the webhook **idempotent**.

Use the provider's unique event/transaction ID:

```php id="dygjcn"
if (WebhookEvent::where('event_id', $eventId)->exists()) {
    return response()->json(['status' => 'already_processed']);
}
```

Also use a **unique database constraint** on `event_id` to protect against race conditions.

For heavy processing:

```text
Webhook
   ↓
Validate Signature
   ↓
Store Event ID
   ↓
Dispatch Job
   ↓
Process Asynchronously
```

**Important:**
Always verify the webhook's **signature/authenticity** before processing it.

**Interview one-liner:**

> Verify the webhook signature, use a unique event ID, enforce a database unique constraint, and make processing idempotent.

---

## 3. How would you design a Booking System?

**Answer:**
I would focus on **availability, concurrency, transactions, and preventing double booking**.

### Basic flow

```text
User selects slot
       ↓
Check availability
       ↓
Create booking
       ↓
Payment
       ↓
Confirm booking
       ↓
Send notification
```

### Database design

Typical tables:

```text
users
resources
availability_slots
bookings
payments
```

A `bookings` table could contain:

```text
id
user_id
resource_id
start_time
end_time
status
```

### Prevent double booking

I would use:

* Database transaction
* Proper locking where required
* Appropriate database constraints
* Consistent availability checks
* Idempotency key for repeated booking requests

For example:

```php id="2wq8dy"
DB::transaction(function () {
    // Lock/check availability
    // Create booking
});
```

### Additional considerations

* Booking expiration for unpaid reservations
* Queue notifications/emails
* Time-zone handling
* Cancellation/refund handling
* Idempotent booking requests

**Interview one-liner:**

> The most important part of a booking system is preventing double booking using transactions, concurrency control, and idempotency.

---

## 4. How would you design a Notification System?

**Answer:**
I would design it to be **asynchronous, scalable, and channel-independent**.

### Basic architecture

```text
Application Event
       ↓
Notification
       ↓
Queue
       ↓
Notification Worker
       ↓
 ┌─────────┬─────────┬─────────┐
 ↓         ↓         ↓
Email      SMS      Push
```

### Database

I would typically have:

```text
notifications
notification_preferences
```

Store information such as:

```text
user_id
type
channel
status
payload
sent_at
```

### Important considerations

* Use queues for sending notifications
* Support multiple channels
* Retry failed notifications
* Use idempotency to prevent duplicates
* Store notification status
* Respect user notification preferences
* Log failures
* Allow retrying failed notifications

**Example:**

```php id="n40fqe"
SendOrderConfirmation::dispatch($order);
```

The request returns quickly while the queue worker sends the notification.

**Interview one-liner:**

> I would use Events to trigger notifications, Jobs/Queues for asynchronous processing, and a channel-based design for email, SMS, and push notifications.