# Laravel Interview Question: Refactoring Fat Controllers

## Question

You are reviewing a large Laravel project.

You notice that many controllers contain:

- Business logic
- Database queries
- Email sending
- Payment processing
- Third-party API calls

The controllers have become **1000+ lines long**.

**How would you refactor this application using Laravel best practices?**

---

# Answer

I would refactor the application by following the **Separation of Concerns (SoC)** principle.

First, controllers should only handle HTTP-related responsibilities such as request validation and response formatting.

I would move business rules into **service classes**. For example, an `OrderService` would handle order creation, payment calculation, and inventory updates.

For complex database operations, I may introduce **repositories** to separate data access from business logic.

For time-consuming operations like sending emails, notifications, generating reports, or synchronizing with third-party APIs, I would use **Laravel Queues and Jobs**.

I would use **Form Request** classes for validation and keep models focused on relationships and simple domain behavior.

Finally, I would add **unit tests** and **feature tests** to ensure the refactoring does not break existing functionality.