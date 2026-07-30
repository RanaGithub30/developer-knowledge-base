## Mock Interview - 1 Questions

This document contains a polished set of interview questions covering Laravel, databases, system design, debugging, and backend concepts.

---

## 1. Authentication vs. Authorization
Explain the difference between authentication and authorization. Also tell me how you have implemented both in Laravel APIs.

---

## 2. Preventing Double Booking in a High-Traffic Booking System
Imagine you're building a high-traffic booking system (such as hotel or cab booking), and multiple users try to book the same slot at exactly the same time. How would you design the backend to prevent double booking while maintaining good performance?

---

## 3. Investigating a Sudden Production Slowdown
Suppose one of your Laravel API endpoints has suddenly become very slow in production. It used to respond in 200 ms, but now it takes 5–6 seconds. How would you investigate the problem, and what steps would you take to identify and fix the root cause?

---

## 4. Service Container and Dependency Injection in Laravel
In Laravel, what is the Service Container, and how does Dependency Injection work?

---

## 5. Designing a REST API for Profile Updates
You're designing a REST API to update a user's profile.

- Which HTTP method would you choose (PUT or PATCH), and why?
- What validations would you perform?
- How would you make sure the API is secure and follows REST best practices?

---

## 6. Optimizing a Slow SQL Query
Suppose you have an orders table with 10 million rows, and this query has become very slow:

```sql
SELECT * FROM orders
WHERE user_id = ?
ORDER BY created_at DESC
LIMIT 20;
```

- How would you optimize this query?
- Please explain your approach step by step, including database indexing and any other improvements you would consider.

---

## 7. Reviewing a Pull Request
You're reviewing a pull request from a junior developer. The code works, but you notice:

- Duplicate business logic in three different controllers.
- A few database queries inside loops (potential N+1 issue).
- Almost no unit tests.
- Variable names are difficult to understand.

How would you handle this code review? What feedback would you give, and would you approve the pull request?

---

## 8. Explaining a Production Bug You Fixed
Tell me about a production bug that you personally fixed.

Please explain:

- What the bug was.
- How you investigated it.
- The root cause.
- The fix you implemented.
- What you did to prevent it from happening again.

---

## 9. Designing a Reliable Third-Party Payment Integration
Imagine your service calls a third-party payment API.

Sometimes:

- It responds very slowly.
- Sometimes it returns HTTP 500.
- Occasionally it times out.

How would you design your integration to make your application reliable and avoid a poor user experience?

---

## 10. Using Redis to Improve Product Listing Performance
You have an e-commerce application where the product listing page is accessed thousands of times per minute. How would you use Redis to improve the performance of this page? What data would you cache, and how would you handle cache invalidation?

---

## 11. Difference Between var, let, and const
Explain the difference between:

- var
- let
- const

---

## 12. Request Lifecycle in Express.js
In an Express.js application, explain what happens internally when a request comes from the client until the response is sent back.

---

## 13. Designing a Multi-Tenant SaaS Database
You are designing a multi-tenant SaaS application where thousands of companies use the same platform. How would you design the database structure so that each company's data remains isolated and secure? Explain your approach and the trade-offs.

---

## 14. Handling a Sensitive Information Leak in Git
A developer accidentally pushed a commit containing sensitive information (for example, an API key) to the remote repository. What steps would you take to handle this situation immediately and prevent it from happening again?

---

## 15. Debugging a Laravel App Inside Docker
Imagine your Laravel application is deployed using Docker.

A developer says:

"It works perfectly on my local machine, but it fails inside the Docker container."

How would you debug this issue? What things would you check first?