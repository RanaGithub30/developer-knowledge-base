# High-Level Notification System Design (Interview Friendly)

## Question

Design a notification system for:

- 10 million users
- Email, SMS, and Push notifications
- User notification preferences

Explain the architecture, database, queue usage, and scalability.

---

# Answer

## High-Level Architecture

```
User Event
    │
    ▼
Notification Service
    │
Check User Preferences
    │
    ▼
 Message Queue
 ┌────┼────┐
 ▼    ▼    ▼
Email SMS Push Workers
 │     │      │
 ▼     ▼      ▼
Providers (SES/Twilio/FCM)
```

---

## Components

- **Application Server:** Generates notification events.
- **Notification Service:** Checks user preferences and creates notification jobs.
- **Message Queue (Kafka/RabbitMQ/SQS):** Stores jobs for asynchronous processing.
- **Workers:** Separate workers send Email, SMS, or Push notifications.
- **Notification Providers:** SendGrid/SES, Twilio, Firebase (FCM), APNs.

---

## Database Design

### Users

- `id`
- `email`
- `phone`

### Notification Preferences

- `user_id`
- `email_enabled`
- `sms_enabled`
- `push_enabled`

### Notifications

- `id`
- `user_id`
- `type`
- `status`
- `created_at`

---

## Queue Usage

1. User action triggers an event.
2. Notification Service checks preferences.
3. Creates notification jobs.
4. Jobs are pushed to the queue.
5. Workers process jobs asynchronously.
6. Status is updated after delivery.

**Benefit:** Keeps the application fast by avoiding synchronous notification sending.

---

## Handling Millions of Notifications

- **Horizontal Scaling:** Run multiple worker instances.
- **Separate Queues:** Email, SMS, and Push queues prevent one channel from blocking another.
- **Retry Mechanism:** Retry failed jobs with exponential backoff.
- **Dead Letter Queue (DLQ):** Store permanently failed jobs for investigation.
- **Batch Processing:** Send notifications in batches when supported.
- **Monitoring:** Track queue size, worker health, failures, and delivery time.

---

## Conclusion

Use an **event-driven architecture** with a **message queue** and **dedicated workers**. Store user preferences in the database, process notifications asynchronously, and scale workers horizontally. This design is reliable, scalable, and capable of handling millions of notifications efficiently.