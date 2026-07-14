# Laravel CSRF Protection - Interview Questions & Answers

## Q1. What is CSRF?

### Answer

**CSRF (Cross-Site Request Forgery)** is a type of web security attack in which a malicious website tricks an authenticated user into performing unintended actions on another website without their consent.

For example, if a user is logged into a banking application, an attacker could trick them into submitting a request to transfer money.

CSRF attacks exploit the trust that a website has in an authenticated user's browser.

---

## Q2. What is CSRF Protection in Laravel?

### Answer

Laravel provides built-in protection against CSRF attacks by generating a unique **CSRF token** for every active user session.

When a form is submitted, Laravel verifies that the submitted token matches the token stored in the user's session.

If the tokens do not match, Laravel rejects the request with a **419 Page Expired** response.

---

## Q3. How does CSRF Protection work?

### Answer

The CSRF protection flow is:

```text
User Visits Form
        │
        ▼
Laravel Generates CSRF Token
        │
        ▼
Token Stored in Session
        │
        ▼
Hidden Token Added to Form
        │
        ▼
User Submits Form
        │
        ▼
Laravel Verifies Token
        │
        ▼
Match?
 ┌───────────────┐
 │ Yes           │ No
 ▼               ▼
Process Request  419 Error
```

---

## Q4. How do you include a CSRF token in a Blade form?

### Answer

Laravel provides the `@csrf` Blade directive.

Example:

```blade
<form method="POST" action="/users">

    @csrf

    <button type="submit">
        Save
    </button>

</form>
```

Laravel automatically generates:

```html
<input
    type="hidden"
    name="_token"
    value="random_csrf_token"
/>
```

### Interview Tip

> Always include `@csrf` in HTML forms that use the POST, PUT, PATCH, or DELETE methods.

---

## Q5. Why is the `@csrf` directive important?

### Answer

The `@csrf` directive ensures that every form submission contains a valid CSRF token.

Without it, Laravel cannot verify the authenticity of the request and rejects it.

If omitted, Laravel typically returns:

```
419 Page Expired
```

---

## Q6. Which HTTP methods require a CSRF token?

### Answer

CSRF protection applies to all **state-changing** requests.

Protected methods include:

- POST
- PUT
- PATCH
- DELETE

GET requests do **not** require a CSRF token because they should only retrieve data.

Example:

```php
Route::post('/users', ...);
Route::put('/users/{id}', ...);
Route::delete('/users/{id}', ...);
```

---

## Q7. How do you send a CSRF token in an AJAX request?

### Answer

The CSRF token can be included in the request headers.

Example:

```html
<meta name="csrf-token" content="{{ csrf_token() }}">
```

JavaScript:

```javascript
fetch('/users', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': document
            .querySelector('meta[name="csrf-token"]')
            .content
    }
});
```

Laravel automatically validates the token.

---

## Q8. What is the `csrf_token()` helper?

### Answer

Laravel provides the `csrf_token()` helper to retrieve the current session's CSRF token.

Example:

```php
csrf_token();
```

Blade:

```blade
<meta name="csrf-token" content="{{ csrf_token() }}">
```

---

## Q9. What happens if the CSRF token is invalid?

### Answer

If the submitted token:

- is missing,
- has expired, or
- does not match the session token,

Laravel rejects the request and returns:

```
419 Page Expired
```

This prevents unauthorized requests from being processed.

---

## Q10. Can CSRF protection be disabled?

### Answer

Yes, but it should only be done when necessary.

Typical cases include:

- Third-party webhooks
- Payment gateway callbacks
- External API callbacks

In these scenarios, routes can be excluded from CSRF verification.

Example:

```php
Route::post('/webhook', WebhookController::class);
```
---

## Q11. What is the difference between CSRF and XSS?

### Answer

| CSRF | XSS |
|------|-----|
| Tricks authenticated users into submitting unwanted requests | Injects malicious scripts into a web page |
| Exploits user trust | Exploits application vulnerabilities |
| Prevented using CSRF tokens | Prevented by escaping output, validation, and Content Security Policy (CSP) |

---

## Q12. What are the advantages of CSRF protection?

### Answer

- Prevents unauthorized form submissions
- Protects authenticated users
- Prevents forged requests
- Built into Laravel
- Easy to use with `@csrf`
- Works automatically with session-based authentication

---

## Interview Summary

> CSRF (Cross-Site Request Forgery) is an attack that tricks authenticated users into performing unwanted actions. Laravel prevents CSRF attacks by generating a unique token for each user session and verifying it on every state-changing request (POST, PUT, PATCH, DELETE). Developers include the token in forms using the `@csrf` directive.

---