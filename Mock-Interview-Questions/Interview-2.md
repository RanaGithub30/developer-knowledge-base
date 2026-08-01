# Mock Interview - 2 Questions

This document contains a polished set of interview questions covering Laravel, databases, system design, debugging, and backend concepts.

---

## 1. Laravel Request Lifecycle

In a Laravel application, explain the complete request lifecycle from the moment a user hits a URL until the response is returned to the browser.

Also explain where middleware, service providers, routing, controllers, and service containers fit into this lifecycle.

---

## 2. Designing a Multi-Payment Gateway System in Laravel

Imagine you are building a payment module in Laravel.

The application supports multiple payment gateways like Stripe, Razorpay, and PayPal.

How would you design this module so that adding a new payment gateway in the future requires minimum code changes?

Explain your approach.

---

## 3. Debugging and Optimizing a Slow Laravel API

Your Laravel application has an API endpoint:

```http
GET /api/orders
```

It returns 20 orders with customer details and product details.

Currently, the API response takes 5 seconds in production.

How will you debug and optimize this API?

---

## 4. Designing Secure APIs for Millions of Users

You are designing an API for a mobile application with millions of users.

How will you design:

* Authentication
* Authorization
* Rate limiting
* API security

in Laravel?

---

## 5. Interface vs Abstract Class vs Trait in PHP

In PHP, what is the difference between:

* Interface
* Abstract class
* Trait

When would you choose one over another in a Laravel application?

---

## 6. Debugging a Slow Node.js Application

You are building a Node.js + Express API.

Suddenly, during peak traffic, the server becomes slow and API response time increases.

How will you debug and optimize the Node.js application?

---

## 7. Understanding the JavaScript Event Loop

Explain the JavaScript event loop.

How does Node.js handle asynchronous operations even though JavaScript is single-threaded?

---

## 8. Designing User and Order Database Relationships

You have:

* A `users` table
* An `orders` table

A user can place thousands of orders.

How would you design the database schema and relationships?

Also explain:

* What indexes you would add.
* Why those indexes are required.
* How they improve performance.

---

## 9. Using Redis for Product Listing Optimization

Your Laravel application has a product listing API.

The product data changes only a few times per day, but the API receives thousands of requests per minute.

How would you use Redis to optimize this API?

Explain:

* What data you would cache.
* Cache strategy.
* Cache invalidation approach.

---

## 10. Solving Production Environment Issues Using Docker

Your Laravel application works perfectly on your local machine, but after deployment to production, it shows errors like:

* Missing PHP extensions.
* Different PHP versions.
* Environment configuration issues.

How would you solve this problem using Docker?

---

## 11. Handling Sensitive Credentials Leak in Git

You are working in a team of 6 developers.

A developer accidentally pushes a commit containing database credentials to the Git repository.

What steps will you take immediately?

How will you prevent this from happening again?

---

## 12. Designing a Large-Scale Notification System

Design a notification system for a large application.

Requirements:

* Millions of users.
* Users can receive email, SMS, and push notifications.
* Notifications should not slow down the main application.
* The system should handle high traffic spikes.

Explain your architecture.