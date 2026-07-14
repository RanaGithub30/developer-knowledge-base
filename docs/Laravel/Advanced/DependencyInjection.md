# Laravel Dependency Injection - Interview Questions & Answers

## Q1. What is Dependency Injection (DI)?

### Answer

**Dependency Injection (DI)** is a design pattern in which the dependencies of a class are provided from the outside instead of being created inside the class.

Laravel uses Dependency Injection extensively through its **Service Container** to automatically resolve and inject dependencies.

This results in cleaner, more maintainable, and loosely coupled code.

---

## Q2. Why do we use Dependency Injection?

### Answer

Dependency Injection is used to:

- Reduce tight coupling
- Improve code reusability
- Simplify testing
- Increase maintainability
- Follow SOLID principles
- Make code easier to extend

---

## Q3. What is a Dependency?

### Answer

A **dependency** is any object or service that another class requires to perform its work.

Example:

```php
class UserController
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
}
```

Here, `UserService` is the dependency of `UserController`.

---

## Q4. Explain Dependency Injection with an example.

### Answer

Without Dependency Injection:

```php
class UserController
{
    protected $service;

    public function __construct()
    {
        $this->service = new UserService();
    }
}
```

With Dependency Injection:

```php
class UserController
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
}
```

Laravel automatically creates and injects the `UserService` object using the Service Container.

---

## Q5. What are the types of Dependency Injection?

### Answer

Laravel commonly supports three types of Dependency Injection:

1. Constructor Injection
2. Method Injection
3. Interface Injection

---

## Q6. What is Constructor Injection?

### Answer

Constructor Injection provides dependencies through the class constructor.

Example:

```php
class UserController
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
}
```

This is the most commonly used type of Dependency Injection in Laravel.

---

## Q7. What is Method Injection?

### Answer

Method Injection provides dependencies directly to a method.

Example:

```php
use Illuminate\Http\Request;

class UserController
{
    public function store(Request $request)
    {
        //
    }
}
```

Laravel automatically injects the `Request` object into the method.

---

## Q8. What is Interface Injection?

### Answer

Interface Injection occurs when Laravel injects an implementation of an interface instead of a concrete class.

Example:

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

Binding:

```php
$this->app->bind(
    PaymentGateway::class,
    StripePayment::class
);
```

Controller:

```php
public function __construct(PaymentGateway $payment)
{
    $this->payment = $payment;
}
```

Laravel injects the `StripePayment` implementation automatically.

---

## Q9. How does Laravel perform Dependency Injection?

### Answer

Laravel uses the **Service Container** to resolve dependencies.

Workflow:

```text
Controller
      │
      ▼
Needs Dependency
      │
      ▼
Service Container
      │
      ▼
Creates Object
      │
      ▼
Injects Dependency
```

Developers only type-hint the dependency, and Laravel handles the rest.

---

## Q10. What is the role of the Service Container in Dependency Injection?

### Answer

The Service Container is responsible for:

- Creating objects
- Resolving dependencies
- Injecting services automatically
- Managing object lifecycles

It is the core component that enables Dependency Injection in Laravel.

---

## Q11. What is the difference between Dependency Injection and Dependency Resolution?

### Answer

| Dependency Injection | Dependency Resolution |
|----------------------|-----------------------|
| Providing dependencies to a class | Creating and resolving the required objects |
| Focuses on object injection | Focuses on object creation |
| Uses the Service Container | Performed by the Service Container |

---

## Q12. What is the difference between Dependency Injection and Facades?

### Answer

| Dependency Injection | Facades |
|----------------------|----------|
| Uses constructor or method injection | Uses static method calls |
| Easy to mock during testing | Convenient syntax |
| Promotes loose coupling | Can increase coupling if overused |
| Recommended for business logic | Commonly used for quick access to services |

---

## Q13. Can Laravel automatically resolve dependencies?

### Answer

Yes.

If a class has no unresolved constructor dependencies, Laravel automatically resolves it.

Example:

```php
class UserService
{
    //
}

class UserController
{
    public function __construct(UserService $service)
    {
        //
    }
}
```

No manual binding is required.

---

## Q14. When is manual binding required?

### Answer

Manual binding is required when injecting an **interface** or when multiple implementations are possible.

Example:

```php
$this->app->bind(
    PaymentGateway::class,
    StripePayment::class
);
```

Laravel now knows which implementation to inject.

---

## Q15. What are the advantages of Dependency Injection?

### Answer

Dependency Injection provides several benefits:

- Loose coupling
- Better code organization
- Easier testing
- Improved maintainability
- Increased flexibility
- Better scalability
- Easier mocking during unit testing

---

## Q16. What is loose coupling?

### Answer

Loose coupling means classes depend on **abstractions (interfaces)** instead of concrete implementations.

Example:

```php
public function __construct(PaymentGateway $payment)
{
    $this->payment = $payment;
}
```

The controller does not depend on a specific payment provider, making it easy to switch implementations.

---

## Q17. Give a real-world example of Dependency Injection.

### Answer

Consider a payment system.

```text
PaymentGateway (Interface)
          │
          ├── StripePayment
          ├── PayPalPayment
          └── RazorpayPayment
                 │
                 ▼
        OrderController
```

The controller depends only on the `PaymentGateway` interface.

Changing the payment provider requires only updating the Service Container binding, without modifying the controller.

---

## Q18. What is the relationship between Dependency Injection and the Service Container?

### Answer

The Service Container performs Dependency Injection.

Workflow:

```text
Controller
      │
      ▼
Type-Hinted Dependency
      │
      ▼
Service Container
      │
      ▼
Resolved Object
      │
      ▼
Injected into Controller
```

Laravel automatically creates and injects the required object.

---

## Q19. What are some common classes injected in Laravel?

### Answer

Some commonly injected classes include:

- `Illuminate\Http\Request`
- Services (e.g., `UserService`)
- Repositories
- `Illuminate\Contracts\Mail\Mailer`
- `Illuminate\Contracts\Queue\Queue`
- `Illuminate\Contracts\Cache\Repository`
- Custom interfaces

---

## Q20. Why is Dependency Injection important in Laravel?

### Answer

Dependency Injection is one of Laravel's core architectural concepts.

It:

- Promotes clean and modular code
- Supports the Service Container
- Improves testability
- Reduces tight coupling
- Encourages SOLID principles
- Makes applications easier to maintain, extend, and scale