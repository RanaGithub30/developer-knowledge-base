# Laravel Interview — 15 Must-Know Questions & Answers

# Table of Contents

1. [What is the Laravel Service Container and why do we use it?](#1-what-is-the-laravel-service-container-and-why-do-we-use-it)
2. [What is Dependency Injection and how does Laravel resolve dependencies?](#2-what-is-dependency-injection-and-how-does-laravel-resolve-dependencies)
3. [What is a Service Provider? What is the difference between `register()` and `boot()`?](#3-what-is-a-service-provider-what-is-the-difference-between-register-and-boot)
4. [What is Middleware and how does it work?](#4-what-is-middleware-and-how-does-it-work)
5. [What is the difference between Authentication and Authorization?](#5-what-is-the-difference-between-authentication-and-authorization-how-would-you-implement-them-in-laravel)
6. [What are Eloquent Relationships and why do we use `with()`?](#6-what-are-eloquent-relationships-and-why-do-we-use-with)
7. [What is the N+1 problem and how do you solve it?](#7-what-is-the-n1-problem-and-how-do-you-solve-it)
8. [What is a Database Transaction and how do you implement it in Laravel?](#8-what-is-a-database-transaction-and-how-do-you-implement-it-in-laravel)
9. [Why do we use Laravel Queues?](#9-why-do-we-use-laravel-queues)
10. [What happens when a Job fails? How do you handle `tries`, `backoff`, and failed jobs?](#10-what-happens-when-a-job-fails-how-do-you-handle-tries-backoff-and-failed-jobs)
11. [What is Idempotency and how do you prevent duplicate Jobs or Requests?](#11-what-is-idempotency-and-how-do-you-prevent-duplicate-jobs-or-requests)
12. [What is the difference between Events, Listeners, and Jobs?](#12-what-is-the-difference-between-events-listeners-and-jobs)
13. [What is Cache? Why and when would you use Redis?](#13-what-is-cache-why-and-when-would-you-use-redis)
14. [How would you secure a Laravel API?](#14-how-would-you-secure-a-laravel-api)
15. [How would you investigate and optimize a Laravel application's performance?](#15-how-would-you-investigate-and-optimize-a-laravel-applications-performance)

## 1. What is the Laravel Service Container and why do we use it?

**Answer:**
The Service Container is Laravel's **IoC (Inversion of Control) and Dependency Injection container**. It manages and automatically resolves class dependencies.

We use it for:

* Dependency Injection
* Loose coupling
* Dependency management
* Better testability and maintainability

**One-liner:**

> The Service Container automatically resolves and injects dependencies.

---

## 2. What is Dependency Injection and how does Laravel resolve dependencies?

**Answer:**
Dependency Injection means providing a class with its required dependencies instead of creating them manually using `new`.

```php
class UserController
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
}
```

Laravel's Service Container sees `UserService`, resolves it, creates the required object, and injects it into the constructor.

**One-liner:**

> Dependency Injection provides dependencies, and the Service Container resolves them.

---

## 3. What is a Service Provider? What is the difference between `register()` and `boot()`?

**Answer:**
A Service Provider is the central place for **registering and bootstrapping application services**.

### `register()`

Used to register services and bindings in the Service Container.

```php
public function register()
{
    $this->app->bind(
        PaymentGateway::class,
        StripePayment::class
    );
}
```

### `boot()`

Runs after services have been registered and is used for initialization or bootstrapping logic.

**Easy way to remember:**

> `register()` = Register services
> `boot()` = Initialize services

---

## 4. What is Middleware and how does it work?

**Answer:**
Middleware is a **filter between an HTTP request and the application**. It can inspect or modify a request before it reaches the controller and can also process the response.

Common uses:

* Authentication
* Authorization
* Logging
* Request filtering
* CSRF protection

Example:

```php
Route::get('/dashboard', ...)
    ->middleware('auth');
```

**One-liner:**

> Middleware filters HTTP requests before or after they reach the application.

---

## 5. What is the difference between Authentication and Authorization? How would you implement them in Laravel?

**Answer:**

**Authentication** verifies **who the user is**.

> Who are you?

**Authorization** checks **what an authenticated user is allowed to do**.

> What can you do?

In Laravel:

* Authentication → `auth` middleware
* Authorization → Gates and Policies

Example:

```php
Route::get('/dashboard', ...)
    ->middleware('auth');
```

**Easy way to remember:**

> Authentication = Identity
> Authorization = Permission

---

## 6. What are Eloquent Relationships and why do we use `with()`?

**Answer:**
Eloquent Relationships define relationships between database models.

Common relationships:

* `hasOne`
* `hasMany`
* `belongsTo`
* `belongsToMany`

Example:

```php
public function posts()
{
    return $this->hasMany(Post::class);
}
```

We use `with()` for **Eager Loading**:

```php
$users = User::with('posts')->get();
```

This loads the relationship efficiently and helps reduce unnecessary database queries.

**One-liner:**

> `with()` performs eager loading and helps prevent N+1 queries.

---

## 7. What is the N+1 problem and how do you solve it?

**Answer:**
The N+1 problem occurs when we execute **one query for the main records and an additional query for each related record**.

Example:

```php
$users = User::all();

foreach ($users as $user) {
    echo $user->posts;
}
```

If there are 100 users, this can result in:

```text
1 query for users
+ 100 queries for posts
= 101 queries
```

### Solution

Use Eager Loading:

```php
$users = User::with('posts')->get();
```

**One-liner:**

> Use Eloquent's `with()` eager loading to prevent N+1 queries.

---

## 8. What is a Database Transaction and how do you implement it in Laravel?

**Answer:**
A database transaction treats multiple database operations as **one unit of work**.

If everything succeeds → **Commit**
If something fails → **Rollback**

Laravel:

```php
DB::transaction(function () {
    Order::create($orderData);
    Payment::create($paymentData);
});
```

If an exception occurs, Laravel automatically rolls back the transaction.

**One-liner:**

> A transaction ensures that related database operations either all succeed or all fail.

---

## 9. Why do we use Laravel Queues?

**Answer:**
Queues are used to process **time-consuming tasks in the background**, so the user does not have to wait for them.

Examples:

* Sending emails
* Notifications
* Image processing
* Report generation
* External API calls

```text
Request
   ↓
Dispatch Job
   ↓
Return Response
   ↓
Queue Worker
   ↓
Process Job
```

**One-liner:**

> Queues move slow tasks to background processing and keep the application responsive.

---

## 10. What happens when a Job fails? How do you handle `tries`, `backoff`, and failed jobs?

**Answer:**
When a Job throws an exception, Laravel can **retry the job** according to its configuration.

### `tries`

Defines the maximum number of attempts:

```php
public $tries = 3;
```

### `backoff()`

Defines the delay before retrying:

```php
public function backoff()
{
    return 10;
}
```

After the maximum attempts are exhausted, the job can be stored as a **failed job**.

View failed jobs:

```bash
php artisan queue:failed
```

Retry a failed job:

```bash
php artisan queue:retry <id>
```

Handle permanent failure:

```php
public function failed(Throwable $exception)
{
    // Handle failure
}
```

**Interview answer:**

> First I identify and fix the root cause, then retry the job if it is safe. I also configure appropriate retries and backoff and handle permanent failures properly.

---

## 11. What is Idempotency and how do you prevent duplicate Jobs or Requests?

**Answer:**
Idempotency means that executing the same operation multiple times **does not create an incorrect duplicate side effect**.

For example, if a payment job is retried, the customer should not be charged twice.

Use a unique business/reference ID:

```php
if (Payment::where('transaction_id', $transactionId)->exists()) {
    return;
}
```

For critical operations, also use **database unique constraints and transactions**.

**One-liner:**

> Idempotency makes retries safe by preventing duplicate side effects.

---

## 12. What is the difference between Events, Listeners, and Jobs?

**Answer:**

### Event

Represents something that happened.

> `UserRegistered`

### Listener

Defines what should happen when an event occurs.

> `SendWelcomeEmail`

### Job

Represents a task that can be processed asynchronously through a queue.

> `SendWelcomeEmailJob`

**Simple flow:**

```text
Event
  ↓
Listener
  ↓
Job
  ↓
Queue
  ↓
Worker
```

**One-liner:**

> Event = What happened, Listener = What should happen, Job = A task that can run asynchronously.

---

## 13. What is Cache? Why and when would you use Redis?

**Answer:**
Cache stores frequently accessed data temporarily so we don't repeatedly perform expensive database queries or operations.

Example:

```php
$data = Cache::remember(
    'users',
    3600,
    fn () => User::all()
);
```

Redis is a **fast in-memory data store** commonly used for:

* Application caching
* Shared cache
* Queues
* Sessions
* Frequently accessed data

**One-liner:**

> Cache reduces expensive operations, and Redis provides fast in-memory storage for high-performance use cases.

---

## 14. How would you secure a Laravel API?

**Answer:**
I would use multiple security layers:

* Authentication using Sanctum, Passport, or an appropriate authentication mechanism
* Authorization using Gates/Policies
* Request validation
* Rate limiting
* HTTPS
* Proper API permissions/scopes
* Secure environment secrets
* Avoid exposing sensitive data
* Proper error handling

Example:

```php
Route::middleware('auth:sanctum')
    ->get('/profile', ...);
```

**One-liner:**

> Secure an API using authentication, authorization, validation, rate limiting, HTTPS, and proper data protection.

---

## 15. How would you investigate and optimize a Laravel application's performance?

**Answer:**
First, I would **identify the actual bottleneck** before optimizing.

### Investigation

* Check slow database queries
* Identify N+1 queries
* Inspect query count and execution time
* Check application logs
* Check queue bottlenecks
* Check cache performance
* Check external API latency

### Optimization

* Use Eager Loading
* Add proper database indexes
* Optimize database queries
* Use caching
* Move heavy tasks to queues
* Use pagination
* Reduce unnecessary queries and data

**Interview one-liner:**

> First I measure and identify the bottleneck, then optimize the database, queries, caching, queues, and application code based on the actual issue.