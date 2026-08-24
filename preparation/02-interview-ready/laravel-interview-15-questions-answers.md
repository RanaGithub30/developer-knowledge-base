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
16. [Explain Module-Based Architecture in Laravel. Why would you use it?](#16-explain-module-based-architecture-in-laravel-why-would-you-use-it)
17. [What is a Cron Job? Why do we use it? When do we use Laravel Task Scheduling?](#17-what-is-a-cron-job-why-do-we-use-it-when-do-we-use-laravel-task-scheduling)
18. [How do you prevent SQL Injection in a Laravel application?]
(#18-how-do-you-prevent-sql-injection-in-a-laravel-application)

## 1. What is the Laravel Service Container and why do we use it?

**Answer:**

The Service Container in Laravel is a tool that manages dependencies between classes.

For example, suppose I have a UserController that needs a UserRepository. Instead of creating the repository manually using new UserRepository(), I can type-hint UserRepository in the controller's constructor, and Laravel's Service Container will automatically resolve and inject it.

This helps us achieve loose coupling, because the controller doesn't need to worry about how the dependency is created. It also makes our application easier to test, maintain, and modify.

We can also explicitly tell Laravel how to create a dependency using bindings, for example, binding an interface to a particular implementation. Then whenever Laravel needs that interface, the container knows which class to provide.

So, in simple terms, the Service Container is Laravel's dependency manager. It creates, manages, and injects the dependencies that our classes need.

**Example**

```php
class UserController
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
}
```

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

Dependency Injection is a design pattern where a class receives the objects or services it depends on from outside, instead of creating them itself. This makes the code more loosely coupled, easier to test, and easier to maintain.

In Laravel, Dependency Injection is mainly handled by Laravel’s Service Container. When we type-hint a dependency in a constructor or method, Laravel looks at that type and automatically resolves and injects the required object.

If the dependency itself has other dependencies, Laravel recursively resolves those as well. For interfaces, we can explicitly tell Laravel which concrete class should be used using bindings in a service provider.

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

A Service Provider is a central place in Laravel where we register and configure application services. Laravel uses service providers to bootstrap different parts of the application, such as bindings, events, routes, and other services.

A service provider mainly has two important methods: register() and boot().

The register() method is used to register things into Laravel's Service Container. For example, we can bind an interface to a concrete implementation using $this->app->bind(). The important point is that we should generally only register services in register() and not perform actions that depend on other services being available.

The boot() method runs after all service providers have been registered. So, it is used for initialization or actions that require other services to already be registered.

So the simple difference is: register() is for registering dependencies and bindings, while boot() is for initializing or configuring services after registration is complete.

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

Middleware in Laravel is a mechanism that filters HTTP requests before they reach the application's controller or route. It is mainly used for things like authentication, authorization, checking user roles, logging, CORS, and request validation.

For example, Laravel's authentication middleware checks whether a user is logged in. If the user is authenticated, the request continues to the controller. If not, the middleware can redirect the user to the login page.

Middleware works like a pipeline. A request enters the middleware, the middleware performs some checks or processing, and then it can either stop the request or pass it to the next middleware using $next($request). After the controller response is generated, middleware can also modify or process the response before it is sent back to the user.

We can apply middleware to individual routes, groups of routes, or controllers. Laravel also provides built-in middleware, and we can create custom middleware for our own requirements.

So, in simple terms, middleware sits between the incoming request and the application logic and acts as a filter or checkpoint.

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

Authentication and Authorization are related but different concepts. Authentication means verifying who the user is, while Authorization means checking what that authenticated user is allowed to do.

For example, when a user logs into Laravel with email and password, Laravel verifies their identity — that's Authentication. If that user tries to access an admin page, Laravel checks whether they have the admin role or permission — that's Authorization.

In Laravel, Authentication can be implemented using Laravel's authentication features or starter kits like Breeze or Jetstream. We can protect routes using the auth middleware. For example, Route::get('/dashboard', ...)->middleware('auth') ensures only authenticated users can access the route.

For Authorization, Laravel provides Gates and Policies. Gates are useful for simple authorization checks, while Policies are commonly used for authorization related to a specific model or resource.

So, the simple difference is: Authentication answers ‘Who are you?’, while Authorization answers ‘What are you allowed to do?’”

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

Eloquent Relationships are Laravel's way of defining relationships between database tables using Eloquent models. Instead of writing SQL joins manually, we can define relationships such as hasOne, hasMany, belongsTo, and belongsToMany in our models.

For example, a User can have many Posts, so in the User model we can define a hasMany(Post::class) relationship. Then we can easily access the user's posts using $user->posts.

We use with() mainly for eager loading relationships. It tells Laravel to load the relationship data along with the main query, instead of querying the database separately every time we access the relationship. This helps prevent the N+1 query problem and improves performance.

For example, if I want to fetch users along with their posts, I can write User::with('posts')->get(). Laravel will load the users and their related posts efficiently, instead of running a separate query for posts for every user.

So, in simple terms, Eloquent Relationships define how models are connected, while with() is used to eager-load those relationships efficiently.

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

The N+1 problem happens when we execute one query to get a list of records and then execute an additional query for each record to get its related data. So, if we fetch 100 users, we might execute 1 query for users plus 100 queries for their posts, resulting in 101 queries. This can seriously affect application performance.

In Laravel, this commonly happens when using Eloquent relationships with lazy loading. For example, if I do User::all() and then inside a loop access $user->posts, Laravel may run a separate query for posts for every user.

The common solution is eager loading using with(). For example, User::with('posts')->get() tells Laravel to load the users and their posts upfront, reducing the number of database queries.

So, in simple terms, the N+1 problem means too many database queries caused by loading relationships one by one, and we usually solve it using Eloquent eager loading with with().

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

A database transaction is a group of database operations that are treated as a single unit. The main purpose is to make sure that either all operations succeed or, if something fails, all changes are rolled back. This helps maintain data consistency.

For example, suppose we're placing an order. We need to create the order, reduce the product stock, and create the payment record. If the order is created but updating the stock fails, we don't want the database to be left in an inconsistent state. A transaction allows us to roll back all the changes if any operation fails.

In Laravel, we can use the DB::transaction() method. We put all related database operations inside the transaction callback. If the callback completes successfully, Laravel automatically commits the transaction. If an exception occurs, Laravel automatically rolls it back.

We can also manually use DB::beginTransaction(), DB::commit(), and DB::rollBack() when we need more control.

So, in simple terms, a transaction ensures that a group of database operations either all succeed or none of them are applied.

Laravel:

```php
DB::transaction(function () {
    Order::create($orderData);
    Payment::create($paymentData);
});
```

**One-liner:**

> A transaction ensures that related database operations either all succeed or all fail.

---

## 9. Why do we use Laravel Queues?

**Answer:**

Laravel Queues are used to handle time-consuming tasks in the background instead of making the user wait for them to finish. They improve application performance and make the user experience faster.

For example, suppose after a user registers, we need to send a welcome email, generate a report, process an uploaded image, or send a notification. If we do these tasks directly during the HTTP request, the user may have to wait. Instead, we can put these tasks into a queue and let a background worker process them.

In Laravel, we create a Job that contains the task we want to perform and dispatch it using methods like dispatch(). Laravel puts the job into a configured queue such as Redis or a database queue. Then a queue worker runs in the background and processes the job.

Queues also support features like retries, delayed jobs, failed jobs, and multiple queues with different priorities.

So, in simple terms, Laravel Queues allow us to move heavy or time-consuming tasks out of the user's request and process them asynchronously in the background.


**One-liner:**

> Queues move slow tasks to background processing and keep the application responsive.

---

## 10. What happens when a Job fails? How do you handle `tries`, `backoff`, and failed jobs?

**Answer:**

When a Laravel queued Job fails, Laravel can retry the Job based on the retry configuration. By default, Laravel will attempt the Job according to the worker's configuration, but we can control the number of attempts using the Job's tries property or method.

For example, if I set public $tries = 3, Laravel will try the Job up to three times. If the Job continues to fail, Laravel considers it a failed Job and stores information about it in the failed jobs storage, depending on the application's configuration.

backoff controls how long Laravel should wait before retrying a failed Job. For example, public $backoff = 10 means Laravel waits 10 seconds before retrying. We can also use a backoff array to increase the delay between attempts, such as [10, 30, 60].

For jobs that ultimately fail, we can define a failed() method in the Job. This method is useful for cleanup, logging, notifying an administrator, or updating the status of an operation. We can also use Laravel's failed-job commands to inspect or retry failed jobs.

So, in simple terms: tries controls how many times we attempt the Job, backoff controls how long we wait between attempts, and the failed() method handles what happens after the Job permanently fails.

## Example

```php
class SendEmail implements ShouldQueue
{
    public $tries = 3;

    public $backoff = [10, 30, 60];

    public function handle()
    {
        // Send email
    }

    public function failed(Throwable $exception)
    {
        // Log error or notify admin
    }
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

Idempotency means that performing the same operation multiple times should have the same final result as performing it once. This is especially important in APIs, payments, and Laravel queues because requests or jobs can sometimes be retried or accidentally sent multiple times.

For example, if a payment request is submitted twice because of a network retry, we don't want to charge the customer twice. We can give the request a unique idempotency key and store it in the database. Before processing the request, we check whether that key has already been processed. If it has, we return the existing result instead of performing the operation again.

So, in simple terms, idempotency ensures that retries or duplicate requests don't create duplicate side effects.

---

For example, if a payment job is retried, the customer should not be charged twice.

Use a unique business/reference ID:

```php
if (Payment::where('transaction_id', $transactionId)->exists()) {
    return;
}
```

For critical operations, also use **database unique constraints and transactions**.

**One-liner:**

> Idempotency means safely repeating the same operation produces the same result as doing it once. In Laravel, we can achieve it using idempotency keys, unique jobs like ShouldBeUnique, and database unique constraints to prevent duplicate processing.

---

## 12. What is the difference between Events, Listeners, and Jobs?

**Answer:**

Events, Listeners, and Jobs are all used to make Laravel applications more decoupled, but they have different purposes.

An Event represents that something happened in the application. For example, OrderPlaced means an order has been successfully placed. The Event usually contains the data related to what happened.

A Listener is responsible for reacting to an Event. For example, when OrderPlaced occurs, a listener called SendOrderConfirmation can send a confirmation email. One Event can have multiple Listeners, so different actions can respond to the same Event.

A Job represents a specific task that we want to execute, often in the background using Laravel Queues. For example, SendWelcomeEmail or GenerateReport can be Jobs. A Job is useful when the task is time-consuming and we don't want the user to wait.

The important difference is: an Event says ‘something happened’, a Listener says ‘when that happens, do this’, and a Job says ‘perform this task’, usually asynchronously through a queue.

They can also work together. For example, an OrderPlaced Event can trigger a Listener, and that Listener can dispatch a queued Job to send an email.

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

Cache is a temporary storage mechanism used to store frequently accessed data so that we don't have to repeatedly perform expensive operations, such as database queries or API calls. The main purpose of caching is to improve application speed and reduce the load on the database and other services.

For example, if we have a list of categories that doesn't change frequently, instead of querying the database on every request, we can store the result in the cache and retrieve it quickly.

Redis is an in-memory data store that is commonly used as a cache in Laravel. Because Redis stores data primarily in memory, reading and writing data is very fast.

We would use Redis when we need high-performance caching, especially for frequently accessed data, sessions, queues, rate limiting, counters, or real-time data. Laravel can also use Redis as a queue backend.

For example, we can use Laravel's Cache::remember() to cache a database query for a specific amount of time. If the data exists in Redis, Laravel returns it from the cache; otherwise, it queries the database and stores the result in Redis.

So, in simple terms, caching avoids repeated expensive operations, and Redis is a fast in-memory technology that Laravel can use to store and retrieve that cached data.

Example:

```php
$data = Cache::remember(
    'users',
    3600,
    fn () => User::all()
);
```

**One-liner:**

> Cache reduces expensive operations, and Redis provides fast in-memory storage for high-performance use cases.

---

## 14. How would you secure a Laravel API?

**Answer:**

To secure a Laravel API, I would use multiple layers of security rather than relying on a single mechanism.

First, I would use proper authentication, such as Laravel Sanctum for token-based API authentication. Protected routes would use authentication middleware so only authenticated users can access them.

Second, I would implement authorization using Gates or Policies to make sure an authenticated user can only access or modify resources they are actually allowed to use. Authentication answers ‘Who are you?’, while authorization answers ‘What can you do?’

Third, I would validate and sanitize incoming request data using Laravel Form Requests or validation rules. I would also use mass-assignment protection with $fillable or $guarded to prevent users from modifying fields they shouldn't control.

I would also apply rate limiting to sensitive endpoints such as login, OTP, password reset, and expensive APIs to prevent abuse or brute-force attacks.

Finally, I would keep secrets such as API keys and database credentials in environment configuration rather than hard-coding them, use secure password hashing, handle errors without exposing sensitive information, and keep Laravel and its dependencies updated.

So, in short, API security involves authentication, authorization, validation, rate limiting, HTTPS, secure configuration, and keeping dependencies updated.

**One-liner:**

> Secure an API using authentication, authorization, validation, rate limiting, HTTPS, and proper data protection.

---

## 15. How would you investigate and optimize a Laravel application's performance?

**Answer:**

I would first measure the performance before making changes. I would identify where the bottleneck is — whether it's the database, application code, external APIs, queues, or server resources. I would use Laravel logs, database query monitoring, and tools such as Laravel Telescope or a profiling/APM tool to investigate slow requests and queries.

For database performance, I would look for slow queries and the N+1 problem. I would use eager loading with with(), select only the required columns, add proper database indexes, and optimize expensive queries.

For application performance, I would use caching for frequently accessed data, for example with Laravel's Cache system and Redis. I would move time-consuming operations such as sending emails, generating reports, and processing files to queues so they don't block the HTTP request.

I would also check unnecessary loops, repeated database calls, external API calls, and large datasets. For large data, I would use pagination, chunking, or lazy collections instead of loading everything into memory.

Finally, I would optimize production configuration by enabling Laravel's production optimizations, caching configuration and routes where appropriate, and monitoring the application after changes to make sure the improvement is measurable.

So my approach is: measure first, identify the bottleneck, optimize the specific problem, and then measure again.

**Interview one-liner:**

> First I measure and identify the bottleneck, then optimize the database, queries, caching, queues, and application code based on the actual issue.

## 16. Explain Module-Based Architecture in Laravel. Why would you use it?

**Answer:**

Module-Based Architecture is an approach where we divide a Laravel application into separate modules based on business features or domains, instead of keeping everything inside the default Controllers, Models, and Services folders.

For example, in an e-commerce application, we might have modules like User, Product, Order, Payment, and Inventory. Each module contains the code related to that particular feature, such as its controllers, models, routes, services, requests, migrations, and views.

The main advantage is separation of concerns. Each module becomes more independent and easier to understand, maintain, test, and develop. It also makes a large Laravel application more scalable because developers can work on different modules without affecting unrelated parts of the application.

For example, the structure could look like Modules/Order/Controllers, Modules/Order/Models, Modules/Order/Routes, and Modules/Order/Services. So all Order-related functionality stays inside the Order module.

In Laravel, this can be implemented using packages such as nwidart/laravel-modules, or we can create our own module structure depending on the project's requirements.

So, in simple terms, Module-Based Architecture means organizing a large Laravel application by business features, where each module contains most of the code required for that feature.

Modules/
│
├── User/
│   ├── Controllers/
│   ├── Models/
│   ├── Services/
│   ├── Requests/
│   ├── Routes/
│   └── Migrations/
│
├── Product/
│   ├── Controllers/
│   ├── Models/
│   ├── Services/
│   └── Routes/
│
└── Order/
    ├── Controllers/
    ├── Models/
    ├── Services/
    └── Routes/

---

## 17. What is a Cron Job? Why do we use it? When do we use Laravel Task Scheduling?

**Answer:**

A Cron Job is a scheduled task provided by the operating system, commonly used on Linux servers to automatically execute commands or scripts at a specific time or interval. For example, we can run a command every minute, every hour, or every day.

We use Cron Jobs when we need to perform repetitive tasks automatically without manual intervention. Examples include sending daily reports, cleaning old records, deleting expired data, generating backups, or processing scheduled jobs.

Laravel provides Task Scheduling, which gives us a clean way to define these scheduled tasks inside the Laravel application instead of putting many different commands directly into the server's Cron configuration.

For example, in Laravel we can schedule an Artisan command to run every day at midnight. Laravel's scheduler defines when the task should run, while the server's Cron Job triggers Laravel's scheduler, usually every minute.

So, Cron is the server-level mechanism that triggers the scheduler, while Laravel Task Scheduling is the application-level feature where we define and manage our scheduled tasks.

We use Task Scheduling when the task is related to our Laravel application's business logic and needs to run periodically.

---

## 18. How do you prevent SQL Injection in a Laravel application?

**Answer:**

SQL Injection is prevented in Laravel mainly by using Laravel’s Query Builder and Eloquent ORM, because they use parameterized queries and bind user input instead of directly concatenating it into SQL.

For example, I would prefer something like User::where('email', $email)->first() or DB::table('users')->where('email', $email)->first() rather than building a raw SQL string with user input.

If I need to use raw SQL, I make sure to use parameter binding, for example DB::select('SELECT * FROM users WHERE email = ?', [$email]), instead of directly inserting $email into the query.

I also validate and sanitize incoming data using Laravel Form Requests or validation rules. However, validation alone is not a complete protection against SQL Injection—the most important thing is using parameterized queries.

I avoid methods like DB::raw() with untrusted user input unless the input is properly controlled and parameterized. For dynamic sorting or column names, I use an allowlist rather than directly accepting a column name from the request.

So, my main approach is: use Eloquent or Query Builder, use parameter binding for raw queries, validate input, and never concatenate untrusted input into SQL statements.

---