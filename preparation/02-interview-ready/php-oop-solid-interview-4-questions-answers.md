# PHP OOP & SOLID — 4 Must-Know Interview Q&A

## 1. What are the SOLID principles? Give a real-project example.

**Answer:**
SOLID is a set of five principles for writing **maintainable, flexible, and loosely coupled OOP code**.

### S — Single Responsibility Principle

A class should have **one responsibility**.

```php
class InvoiceService
{
    public function createInvoice() {}
}
```

Don't put email sending, PDF generation, and invoice creation into the same class.

### O — Open/Closed Principle

A class should be **open for extension but closed for modification**.

Example: Add a new payment method without modifying existing payment logic.

### L — Liskov Substitution Principle

A child class should be replaceable with its parent/interface **without breaking the application**.

### I — Interface Segregation Principle

Prefer **small, focused interfaces** instead of one large interface.

### D — Dependency Inversion Principle

High-level classes should depend on **abstractions/interfaces**, not concrete implementations.

Example:

```php
class PaymentService
{
    public function __construct(
        PaymentGateway $gateway
    ) {}
}
```

Now `PaymentService` can work with Stripe, PayPal, Razorpay, etc.

**Interview one-liner:**

> SOLID helps us build code that is easier to maintain, extend, test, and change.

---

## 2. What is the difference between Interface, Abstract Class, and Trait?

**Answer:**

| Interface                                 | Abstract Class                                 | Trait                                |
| ----------------------------------------- | ---------------------------------------------- | ------------------------------------ |
| Defines a contract                        | Defines a base class                           | Reuses code                          |
| A class can implement multiple interfaces | A class can extend only one class              | Can be used in multiple classes      |
| Mainly method signatures/contract         | Can contain properties and implemented methods | Contains reusable methods/properties |
| Used for abstraction                      | Used for common base behavior                  | Used for code reuse                  |

### Example

**Interface:**

```php
interface PaymentGateway
{
    public function pay(float $amount);
}
```

**Abstract Class:**

```php
abstract class Payment
{
    abstract public function pay(float $amount);

    public function logPayment()
    {
        // Common logic
    }
}
```

**Trait:**

```php
trait LogsActivity
{
    public function log()
    {
        // Reusable logic
    }
}
```

**Easy way to remember:**

> Interface = **Contract**
> Abstract Class = **Base/Class structure**
> Trait = **Code reuse**

---

## 3. How would you design a Payment Gateway using a Contract/Interface?

**Answer:**
I would create a common `PaymentGateway` interface and make each payment provider implement it.

### Step 1 — Create the Contract

```php
interface PaymentGateway
{
    public function charge(float $amount): bool;
}
```

### Step 2 — Implement it

```php
class StripePayment implements PaymentGateway
{
    public function charge(float $amount): bool
    {
        // Stripe implementation
        return true;
    }
}
```

Another provider:

```php
class RazorpayPayment implements PaymentGateway
{
    public function charge(float $amount): bool
    {
        // Razorpay implementation
        return true;
    }
}
```

### Step 3 — Bind it in Laravel

```php
$this->app->bind(
    PaymentGateway::class,
    StripePayment::class
);
```

### Step 4 — Inject the interface

```php
class PaymentService
{
    public function __construct(
        PaymentGateway $gateway
    ) {
        $this->gateway = $gateway;
    }
}
```

Now we can change Stripe to Razorpay by changing the **binding**, without changing `PaymentService`.

**Interview one-liner:**

> Depend on the `PaymentGateway` contract, not a concrete payment provider, so the implementation can be changed easily.

---

## 4. What are the important concepts of PHP OOP?

**Answer:**
The most important PHP OOP concepts are:

### 1. Class & Object

A **class** is a blueprint; an **object** is an instance of that class.

### 2. Encapsulation

Keep data and behavior together and control access using `public`, `protected`, and `private`.

### 3. Inheritance

A child class can reuse or extend the behavior of a parent class.

```php
class Admin extends User
{
}
```

### 4. Polymorphism

The same interface/method can have different implementations.

```php
$gateway->charge(100);
```

The actual behavior can differ for Stripe, PayPal, or Razorpay.

### 5. Abstraction

Expose what an object does while hiding implementation details.

Interfaces and abstract classes are commonly used for abstraction.

**Interview one-liner:**

> The core OOP concepts are Encapsulation, Inheritance, Polymorphism, and Abstraction, along with classes and objects.
