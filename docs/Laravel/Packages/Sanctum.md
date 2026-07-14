# Laravel Sanctum - Interview Questions & Answers

## Q1. What is Laravel Sanctum?

### Answer

**Laravel Sanctum** is Laravel's official lightweight authentication package for securing APIs and Single Page Applications (SPAs).

It provides simple token-based authentication and session-based authentication without the complexity of OAuth 2.0.

Sanctum is ideal for first-party applications such as:

- Single Page Applications (SPA)
- Mobile Applications
- RESTful APIs

---

## Q2. Why do we use Laravel Sanctum?

### Answer

Laravel Sanctum is used to:

- Secure REST APIs
- Authenticate Single Page Applications (SPAs)
- Generate API tokens
- Authenticate mobile applications
- Protect API routes
- Replace complex OAuth authentication for first-party applications

---

## Q3. What are the main features of Laravel Sanctum?

### Answer

Sanctum provides:

- API Token Authentication
- SPA Authentication
- Token Abilities (Permissions)
- Multiple API Tokens per User
- Lightweight Authentication
- Easy Integration with Laravel

---

## Q4. When should you use Laravel Sanctum?

### Answer

Use Sanctum when building:

- Single Page Applications (Vue, React, Angular)
- Mobile Applications
- Internal APIs
- Personal Projects
- Small and Medium APIs
- First-party applications

---

## Q5. What is the difference between Sanctum and Passport?

### Answer

| Sanctum | Passport |
|----------|-----------|
| Lightweight authentication | Full OAuth 2.0 authentication |
| Easy to configure | More complex setup |
| Best for first-party applications | Best for third-party integrations |
| Uses API tokens | Uses OAuth access tokens |
| Ideal for SPAs and mobile apps | Ideal for enterprise/public APIs |

---

## Q6. How do you install Laravel Sanctum?

### Answer

Install Sanctum using Composer:

```bash
composer require laravel/sanctum
```

Publish the configuration and migration files:

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

Run the migrations:

```bash
php artisan migrate
```

---

## Q7. What table does Sanctum create?

### Answer

Sanctum creates the following table:

```text
personal_access_tokens
```

This table stores API tokens issued to authenticated users.

---

## Q8. Which trait is required for Sanctum?

### Answer

Sanctum uses the `HasApiTokens` trait.

Example:

```php
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
}
```

This enables API token generation for the model.

---

## Q9. How do you create an API token?

### Answer

Example:

```php
$token = $user->createToken(
    'API Token'
)->plainTextToken;
```

The generated token should be returned to the client and included in future API requests.

---

## Q10. How do clients send the API token?

### Answer

Clients include the token in the HTTP Authorization header.

Example:

```http
Authorization: Bearer YOUR_API_TOKEN
```

Laravel validates the token before allowing access to protected routes.

---

## Q11. How do you protect API routes using Sanctum?

### Answer

Example:

```php
Route::middleware('auth:sanctum')
    ->get('/user', function () {

        return request()->user();

    });
```

Only authenticated users with valid Sanctum tokens can access the route.

---

## Q12. What are Token Abilities?

### Answer

**Token Abilities** (also called token scopes or permissions) define what an API token is allowed to do.

Example:

```php
$user->createToken(
    'API Token',
    ['create-post', 'delete-post']
);
```

This token can only perform the specified actions.

---

## Q13. How do you check token abilities?

### Answer

Example:

```php
if ($request->user()
    ->tokenCan('create-post')) {

    // Authorized

}
```

Returns `true` if the token has the required ability.

---

## Q14. Can a user have multiple API tokens?

### Answer

Yes.

Example:

```php
$user->createToken('Mobile');

$user->createToken('Web');

$user->createToken('Desktop');
```

Each device or application can have its own API token.

---

## Q15. How do you revoke an API token?

### Answer

Delete the current token:

```php
$request->user()
    ->currentAccessToken()
    ->delete();
```

Delete all tokens:

```php
$user->tokens()->delete();
```

Revoked tokens can no longer access protected routes.

---

## Q16. How does SPA Authentication work with Sanctum?

### Answer

Workflow:

```text
SPA
 │
 ▼
Login Request
 │
 ▼
Laravel Session
 │
 ▼
Authenticated User
 │
 ▼
Protected Routes
```

Instead of API tokens, Sanctum uses Laravel's session cookies for first-party SPAs.

---

## Q17. What are some real-world uses of Sanctum?

### Answer

Sanctum is commonly used for:

- React applications
- Vue applications
- Angular applications
- Mobile applications
- Internal APIs
- Admin dashboards
- Company portals

---

## Q18. What are the advantages of Laravel Sanctum?

### Answer

Sanctum provides several benefits:

- Official Laravel package
- Simple setup
- Lightweight authentication
- API token management
- SPA authentication
- Multiple API tokens
- Token abilities
- Secure API protection

---

## Q19. What is the authentication workflow in Sanctum?

### Answer

Workflow:

```text
User Login
      │
      ▼
Laravel Sanctum
      │
      ▼
API Token Created
      │
      ▼
Client Stores Token
      │
      ▼
Bearer Token Sent
      │
      ▼
Protected API
      │
      ▼
JSON Response
```

Sanctum validates the API token before granting access to protected endpoints.

---

## Q20. What is the difference between Session Authentication and Sanctum Authentication?

### Answer

| Session Authentication | Sanctum Token Authentication |
|------------------------|------------------------------|
| Uses sessions and cookies | Uses API tokens |
| Best for traditional web apps | Best for APIs and mobile apps |
| Stateful | Stateless |
| Browser-based | Token-based |

> **Note:** Sanctum also supports **session-based authentication for first-party SPAs**, making it flexible for both browser-based SPAs and token-based APIs.

---

## Q21. Give a real-world example of Laravel Sanctum.

### Answer

Consider a food delivery application.

```text
Mobile App
      │
      ▼
User Login
      │
      ▼
Laravel Sanctum
      │
      ▼
API Token Generated
      │
      ▼
Bearer Token
      │
      ▼
Protected APIs
      │
      ▼
Order Details Returned
```

The mobile application uses the API token to securely access the Laravel backend.

---

## Q22. Why is Laravel Sanctum important?

### Answer

Laravel Sanctum is an essential authentication solution for modern Laravel applications.

It:

- Simplifies API authentication
- Supports SPAs and mobile applications
- Provides secure API token management
- Supports token abilities (permissions)
- Offers session authentication for first-party SPAs
- Integrates seamlessly with Laravel's authentication system
- Helps build secure, scalable, and maintainable APIs