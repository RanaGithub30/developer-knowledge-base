# Payment Gateway Integration Flow

## Answer

> "First, the customer clicks **Pay Now**. Our backend creates an order and payment request with the payment gateway. The customer completes the payment through the gateway. After payment, the gateway sends a webhook to our backend. We verify the payment details and webhook signature, then update our order status as **PAID, FAILED, or PENDING**."

## Simple Flow

```text
Customer
   ↓
Frontend
   ↓
Backend → Payment Gateway
              ↓
          Customer Pays
              ↓
           Webhook
              ↓
           Backend
              ↓
       Verify Payment
              ↓
        Update Database
              ↓
       PAID / FAILED
```

## Important Points

* Use **HTTPS**.
* Never trust only the frontend payment response.
* Verify payment on the **backend**.
* Verify **amount, order ID, payment ID, and webhook signature**.
* Use **idempotency** to prevent duplicate payments/webhooks.
* Don't store sensitive card details unnecessarily.
* Handle `SUCCESS`, `FAILED`, and `PENDING` states.

## One-Line Answer

> **"Create order → Create payment → Customer pays → Receive webhook → Verify payment → Update order status."**