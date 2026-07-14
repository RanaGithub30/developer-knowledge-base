# Laravel Contracts - Interview Questions & Answers

## Q1. What are Contracts in Laravel?

### Answer

**Contracts** are a set of **interfaces** provided by Laravel that define the core services of the framework.

A contract specifies **what a class should do**, but not **how it should do it**.

Laravel uses contracts to achieve **dependency injection**, **loose coupling**, and **testability**.

---

## Q2. Why do we use Contracts?

### Answer

Contracts are used to:

- Achieve loose coupling
- Follow SOLID principles
- Improve code maintainability
- Support dependency injection
- Make applications easier to test
- Allow multiple implementations of the same interface

---

## Q3. What is an Interface?

### Answer

An **Interface** is a PHP feature that defines a set of methods that a class must implement.

Example:

```php
interface PaymentGateway
{
    public function pay($amount);
}
```

Any class implementing this interface must provide the `pay()` method.

---

## Q4. How are Contracts related to Interfaces?

### Answer

Laravel Contracts are simply **PHP interfaces**.

For example:

```php
Illuminate\Contracts\Mail\Mailer
```

is an interface that defines the methods a mail service must implement.

Laravel provides concrete implementations for these interfaces.

---

## Q5. Where are Laravel Contracts located?

### Answer

Laravel Contracts are located in the following namespace:

```text
Illuminate\Contracts
```

Example:

```php
use Illuminate\Contracts\Queue\Queue;
```

---

## Q6. What are some commonly used Laravel Contracts?

### Answer

Some commonly used Laravel Contracts include:

- `Illuminate\Contracts\Auth\Factory`
- `Illuminate\Contracts\Auth\Guard`
- `Illuminate\Contracts\Auth\Authenticatable`
- `Illuminate\Contracts\Cache\Repository`
- `Illuminate\Contracts\Config\Repository`
- `Illuminate\Contracts\Queue\Queue`
- `Illuminate\Contracts\Queue\ShouldQueue`
- `Illuminate\Contracts\Mail\Mailer`
- `Illuminate\Contracts\Filesystem\Factory`
- `Illuminate\Contracts\Validation\Factory`

---

## Q7. What is Dependency Injection?

### Answer

Dependency Injection is a design pattern where dependencies are provided to a class instead of being created inside it.

Example:

```php
use Illuminate\Contracts\Mail\Mailer;

class UserController
{
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
}
```

Laravel automatically injects the appropriate implementation.

---

## Q8. What is the difference between a Contract and a Facade?

### Answer

| Contract | Facade |
|----------|--------|
| Interface | Static proxy |
| Supports dependency injection | Uses static method calls |
| Easy to mock in testing | Convenient syntax |
| Encourages loose coupling | Provides quick access to services |

Both access Laravel services, but Contracts are generally preferred for dependency injection and testing.

---

## Q9. What is the `ShouldQueue` Contract?

### Answer

`ShouldQueue` is a contract that tells Laravel a job or listener should be processed by the queue.

Example:

```php
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail implements ShouldQueue
{
    //
}
```

Laravel automatically queues the job instead of executing it immediately.

---

## Q10. What is the `Authenticatable` Contract?

### Answer

The `Authenticatable` contract defines the methods required for user authentication.

Laravel's `User` model implements this contract.

Example:

```php
class User extends Authenticatable
{
    //
}
```

It enables the model to work with Laravel's authentication system.

---

## Q11. What is the `Mailer` Contract?

### Answer

The `Mailer` contract defines methods for sending emails.

Example:

```php
use Illuminate\Contracts\Mail\Mailer;

class MailService
{
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
}
```

Laravel injects the configured mail service automatically.

---

## Q12. What is the `Queue` Contract?

### Answer

The `Queue` contract defines methods for interacting with queue systems.

Example:

```php
use Illuminate\Contracts\Queue\Queue;

class OrderService
{
    public function __construct(Queue $queue)
    {
        $this->queue = $queue;
    }
}
```

This allows your code to work with different queue drivers.

---

## Q13. What is the `Repository` Contract?

### Answer

The `Repository` contract is used by several Laravel components, such as configuration and caching.

Example:

```php
use Illuminate\Contracts\Config\Repository;

class AppService
{
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }
}
```

It provides access to configuration values.

---

## Q14. How does Laravel resolve Contracts?

### Answer

Laravel uses the **Service Container** to resolve contracts.

When a contract is requested, the Service Container automatically provides its corresponding implementation.

Example:

```php
public function __construct(Mailer $mailer)
{
    //
}
```

Laravel resolves the `Mailer` contract and injects the configured mail service.

---

## Q15. Can developers create custom Contracts?

### Answer

Yes.

Developers can create their own interfaces and bind implementations using the Service Container.

Example interface:

```php
interface PaymentGateway
{
    public function pay($amount);
}
```

Implementation:

```php
class StripePayment implements PaymentGateway
{
    public function pay($amount)
    {
        //
    }
}
```

Bind the interface:

```php
$this->app->bind(
    PaymentGateway::class,
    StripePayment::class
);
```

---

## Q16. What are the advantages of using Contracts?

### Answer

Contracts provide several benefits:

- Loose coupling
- Easier unit testing
- Better code organization
- Improved flexibility
- Multiple implementations
- Cleaner dependency management
- Better adherence to SOLID principles

---

## Q17. What is the relationship between Contracts and the Service Container?

### Answer

The Service Container is responsible for resolving Contracts.

Workflow:

```text
Controller
      │
      ▼
Requests Contract
      │
      ▼
Service Container
      │
      ▼
Concrete Implementation
      │
      ▼
Object Returned
```

This allows developers to depend on interfaces rather than concrete classes.

---

## Q18. Give a real-world example of Contracts.

### Answer

Consider a payment system.

```text
PaymentGateway (Contract)
          │
          ├── StripePayment
          ├── PayPalPayment
          └── RazorpayPayment
```

The application depends only on the `PaymentGateway` interface.

If the payment provider changes, only the implementation needs to be updated without changing the business logic.

---

## Q19. What is the difference between a Contract and a concrete class?

### Answer

| Contract | Concrete Class |
|----------|----------------|
| Defines behavior | Implements behavior |
| Interface | Actual implementation |
| Cannot contain implementation logic | Contains implementation logic |
| Supports abstraction | Performs the actual work |

---

## Q20. Why are Contracts important in Laravel?

### Answer

Contracts are an essential part of Laravel because they promote clean architecture and loosely coupled code.

They:

- Support dependency injection
- Improve flexibility
- Make applications easier to maintain
- Simplify testing through mocking
- Encourage SOLID design principles
- Allow developers to swap implementations without changing application logic