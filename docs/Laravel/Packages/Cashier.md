# Laravel Cashier - Interview Questions & Answers

## Q1. What is Laravel Cashier?

### Answer

**Laravel Cashier** is Laravel's official package for **subscription billing and recurring payments**.

It provides an expressive interface for integrating payment gateways and managing subscriptions without writing complex billing logic.

Laravel Cashier supports:

- Stripe
- Paddle (separate Cashier package)

---

## Q2. Why do we use Laravel Cashier?

### Answer

Laravel Cashier is used to:

- Manage recurring subscriptions
- Handle one-time payments
- Process invoices
- Manage free trials
- Handle subscription upgrades and downgrades
- Cancel and resume subscriptions
- Reduce payment integration complexity

---

## Q3. Which payment gateways does Laravel Cashier support?

### Answer

Laravel Cashier provides official support for:

- **Stripe**
- **Paddle** (via a separate package)

These payment providers handle payment processing while Cashier manages the subscription logic in Laravel.

---

## Q4. What are the main features of Laravel Cashier?

### Answer

Cashier provides:

- Subscription billing
- Free trial management
- Invoice generation
- Coupon and promotion support (provider-dependent)
- Subscription upgrades and downgrades
- Cancellation and resumption
- Webhook handling
- Tax support (provider-dependent)

---

## Q5. When should you use Laravel Cashier?

### Answer

Use Laravel Cashier when building applications with:

- SaaS products
- Membership websites
- Subscription services
- Premium content platforms
- Monthly or yearly billing
- Online learning platforms
- Software licensing

---

## Q6. How do you install Laravel Cashier?

### Answer

Install Cashier using Composer.

For Stripe:

```bash
composer require laravel/cashier
```

After installation:

```bash
php artisan migrate
```

This creates the required billing-related database columns and tables (depending on the Cashier version and setup).

---

## Q7. Which Billable trait is used in Cashier?

### Answer

Cashier provides the `Billable` trait.

Example:

```php
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Billable;
}
```

This enables billing methods on the `User` model.

---

## Q8. How do you create a subscription?

### Answer

Example:

```php
$user->newSubscription(
    'default',
    'price_monthly'
)->create($paymentMethod);
```

This creates a new subscription for the user.

---

## Q9. How do you check if a user is subscribed?

### Answer

Example:

```php
if ($user->subscribed('default')) {

    // User has an active subscription

}
```

Returns `true` if the subscription is active.

---

## Q10. How do you cancel a subscription?

### Answer

Example:

```php
$user->subscription('default')
     ->cancel();
```

The subscription remains active until the end of the current billing period unless configured otherwise.

---

## Q11. How do you resume a cancelled subscription?

### Answer

Example:

```php
$user->subscription('default')
     ->resume();
```

This resumes a subscription that is still within its grace period.

---

## Q12. What is a Free Trial?

### Answer

A **Free Trial** allows users to access premium features without immediate payment.

Example:

```php
$user->newSubscription(
    'default',
    'price_monthly'
)->trialDays(14)
 ->create($paymentMethod);
```

The user receives a 14-day trial before billing begins.

---

## Q13. How do you swap subscription plans?

### Answer

Example:

```php
$user->subscription('default')
     ->swap('price_yearly');
```

This changes the user's current subscription plan.

---

## Q14. How do you retrieve invoices?

### Answer

Example:

```php
$invoices = $user->invoices();
```

This returns the user's billing invoices.

---

## Q15. What are Webhooks in Cashier?

### Answer

**Webhooks** allow payment providers to notify your application about billing events.

Examples:

- Payment succeeded
- Payment failed
- Subscription renewed
- Subscription cancelled
- Refund issued

Cashier automatically handles many webhook events when configured correctly.

---

## Q16. What is a Grace Period?

### Answer

A **Grace Period** is the time after cancellation during which the subscription remains active.

Example:

```php
if ($user->subscription('default')->onGracePeriod()) {

    // Subscription is still active

}
```

Users can continue using premium features until the billing period ends.

---

## Q17. What are some real-world uses of Laravel Cashier?

### Answer

Laravel Cashier is commonly used for:

- SaaS applications
- Streaming platforms
- Membership websites
- Online courses
- Premium newsletters
- Subscription-based software
- Cloud services

---

## Q18. What are the advantages of Laravel Cashier?

### Answer

Cashier provides several benefits:

- Simple subscription management
- Official Laravel package
- Stripe and Paddle integration
- Built-in billing features
- Free trial support
- Invoice management
- Subscription lifecycle management
- Reduced development effort

---

## Q19. What is the difference between Cashier and Passport?

### Answer

| Cashier | Passport |
|----------|----------|
| Manages subscriptions and billing | Manages API authentication |
| Integrates with payment providers | Implements OAuth 2.0 |
| Handles recurring payments | Secures REST APIs |
| Used for billing | Used for authorization and authentication |

---

## Q20. What is the billing workflow in Laravel Cashier?

### Answer

Workflow:

```text
User Selects Plan
        │
        ▼
Payment Method
        │
        ▼
Cashier
        │
        ▼
Payment Provider
        │
        ▼
Subscription Created
        │
        ▼
Recurring Billing
```

Cashier manages the subscription while the payment provider processes the payments.

---

## Q21. Give a real-world example of Laravel Cashier.

### Answer

Consider a video streaming platform.

```text
User
   │
   ▼
Choose Premium Plan
   │
   ▼
Stripe Payment
   │
   ▼
Laravel Cashier
   │
   ▼
Subscription Activated
   │
   ▼
Watch Premium Content
```

Cashier handles subscription creation, renewals, cancellations, and billing while Stripe processes payments.

---

## Q22. Why is Laravel Cashier important?

### Answer

Laravel Cashier is a powerful billing solution for subscription-based applications.

It:

- Simplifies recurring billing
- Integrates with Stripe and Paddle
- Supports subscription management
- Handles invoices and free trials
- Processes billing events through webhooks
- Helps developers build secure and scalable subscription-based applications