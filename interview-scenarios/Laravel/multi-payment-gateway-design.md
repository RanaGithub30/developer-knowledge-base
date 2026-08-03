# Laravel Multi Payment Gateway Design

## Q. Imagine you are building a payment module in Laravel. The application supports multiple payment gateways like Stripe, Razorpay, and PayPal. How would you design this module so that adding a new payment gateway in the future requires minimum code changes? Explain your approach.

# Answer: 

## Introduction

A payment module in Laravel should support multiple payment gateways like Stripe, Razorpay, and PayPal without tightly coupling the application with any specific provider.

The main goal:

> Adding a new payment gateway should require minimum code changes.

This can be achieved using:

- Interface-based design
- Strategy Pattern
- Dependency Injection
- Laravel Service Container
- Service Layer Pattern

---

# Architecture Overview

```
Controller
    |
    v
Payment Service
    |
    v
PaymentGatewayInterface
    |
    +-------------+-------------+
    |             |             |
    v             v             v
 Stripe       Razorpay       PayPal
    |             |             |
    v             v             v
        Payment Provider APIs
```

---

# 1. Payment Gateway Interface

Create a common interface that every payment gateway must implement.

File:

```
app/Contracts/PaymentGatewayInterface.php
```

```php
<?php

namespace App\Contracts;

interface PaymentGatewayInterface
{
    public function charge(array $data);

    public function refund(
        string $transactionId,
        float $amount
    );

    public function verify(
        string $transactionId
    );
}
```

This ensures every payment provider follows the same structure.

---

# 2. Payment Gateway Implementations

Each payment provider gets its own class.

Folder structure:

```
app/
 ├── Contracts/
 │    └── PaymentGatewayInterface.php
 │
 └── Services/
      └── Payments/
           ├── StripePayment.php
           ├── RazorpayPayment.php
           └── PaypalPayment.php
```

---

## Stripe Payment Gateway

```php
<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;

class StripePayment implements PaymentGatewayInterface
{
    public function charge(array $data)
    {
        // Stripe API integration
    }

    public function refund(
        string $transactionId,
        float $amount
    ) {
        // Stripe refund logic
    }

    public function verify(
        string $transactionId
    ) {
        // Stripe verification
    }
}
```

---

## Razorpay Payment Gateway

```php
<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;

class RazorpayPayment implements PaymentGatewayInterface
{
    public function charge(array $data)
    {
        // Razorpay API integration
    }

    public function refund(
        string $transactionId,
        float $amount
    ) {
        // Razorpay refund logic
    }

    public function verify(
        string $transactionId
    ) {
        // Razorpay verification
    }
}
```

---

# 3. Payment Service Layer

The controller should not directly communicate with payment providers.

The flow should be:

```
Controller
    |
    v
PaymentService
    |
    v
PaymentGatewayInterface
    |
    v
Payment Provider
```

Example:

```php
<?php

namespace App\Services;

use App\Contracts\PaymentGatewayInterface;

class PaymentService
{
    protected PaymentGatewayInterface $gateway;

    public function __construct(
        PaymentGatewayInterface $gateway
    ) {
        $this->gateway = $gateway;
    }

    public function makePayment(array $data)
    {
        return $this->gateway->charge($data);
    }
}
```

---

# 4. Laravel Service Container Binding

Laravel Service Container decides which gateway implementation should be used.

File:

```
app/Providers/AppServiceProvider.php
```

Example:

```php
use App\Contracts\PaymentGatewayInterface;
use App\Services\Payments\StripePayment;

public function register()
{
    $this->app->bind(
        PaymentGatewayInterface::class,
        StripePayment::class
    );
}
```

Now Laravel automatically injects:

```
PaymentGatewayInterface
          |
          v
    StripePayment
```

---

# 5. Controller Usage

The controller only depends on the payment service.

Example:

```php
class PaymentController
{
    public function pay(
        PaymentService $payment
    ) {
        return $payment->makePayment([
            'amount' => 500
        ]);
    }
}
```

The controller does not know whether the payment is processed by:

- Stripe
- Razorpay
- PayPal

---

# 6. Adding a New Payment Gateway

Example: Adding PayPal.

## Step 1: Create New Gateway Class

```php
class PaypalPayment implements PaymentGatewayInterface
{
    public function charge(array $data)
    {
        // PayPal payment logic
    }

    public function refund(
        string $transactionId,
        float $amount
    ) {
        // Refund logic
    }

    public function verify(
        string $transactionId
    ) {
        // Verification logic
    }
}
```

## Step 2: Update Service Container

Change only the binding:

```php
$this->app->bind(
    PaymentGatewayInterface::class,
    PaypalPayment::class
);
```

No changes required in:

- Controllers
- Payment Service
- Existing gateway classes

---

# 7. Dynamic Gateway Selection

If the user can select the payment gateway dynamically, use a manager class.

Example:

```php
class PaymentManager
{
    public function gateway($name)
    {
        return match($name) {

            'stripe' =>
                app(StripePayment::class),

            'razorpay' =>
                app(RazorpayPayment::class),

            'paypal' =>
                app(PaypalPayment::class),

        };
    }
}
```

Usage:

```php
$gateway = $manager->gateway('razorpay');

$gateway->charge($data);
```

---

# 8. Configuration Management

Store gateway configuration separately.

File:

```
config/payment.php
```

Example:

```php
return [

    'default' => 'stripe',

    'gateways' => [

        'stripe' => [
            'key' => env('STRIPE_KEY'),
            'secret' => env('STRIPE_SECRET'),
        ],

        'razorpay' => [
            'key' => env('RAZORPAY_KEY'),
            'secret' => env('RAZORPAY_SECRET'),
        ],

    ],

];
```

---

# Complete Payment Flow

```
User
 |
 v
Payment Controller
 |
 v
Payment Service
 |
 v
PaymentGatewayInterface
 |
 +------------+------------+
 |            |            |
 v            v            v
Stripe     Razorpay     PayPal
 |
 v
Payment Provider API
 |
 v
Response
```

---

# Design Principles Used

| Principle | Usage |
|---|---|
| Strategy Pattern | Allows switching payment algorithms |
| Dependency Injection | Injects required gateway automatically |
| Service Container | Manages object creation |
| Open/Closed Principle | Add new gateways without changing existing code |
| Interface Segregation | Common payment contract |

---

# Benefits

- Easy to add new payment gateways
- Minimal code changes
- Clean controller logic
- Independent gateway implementations
- Easier unit testing
- Scalable architecture

---

# Final Summary

A Laravel payment module should:

1. Define a common payment interface.
2. Create separate classes for each gateway.
3. Use a service layer for payment processing.
4. Use Laravel Service Container for dependency injection.
5. Keep controllers independent from payment providers.

With this design, adding a new payment gateway only requires creating a new implementation class and registering it, without modifying the existing business logic.

# Interview Answer: 

I would design the payment module using the Strategy Pattern with Laravel contracts.

First, I will create a PaymentGatewayInterface that defines common operations like charge(), refund(), and status().

Each gateway like Stripe, Razorpay, and PayPal will implement this interface separately.

Then I will create a PaymentService layer that communicates with the interface instead of directly depending on any gateway implementation.

Using Laravel's service container, I will bind the required gateway implementation dynamically based on configuration.

This follows SOLID principles, especially the Open/Closed Principle, because adding a new gateway will only require creating a new class implementing the interface without modifying existing business logic.