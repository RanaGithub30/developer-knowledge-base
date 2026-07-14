# Laravel Passport - Interview Questions & Answers

## Q1. What is Laravel Passport?

### Answer

**Laravel Passport** is Laravel's official **OAuth 2.0 authentication package** for securing RESTful APIs.

It provides a complete OAuth2 server implementation, allowing applications to issue and manage access tokens for authenticated users and third-party clients.

Passport is ideal for large applications and APIs that require OAuth2 authentication.

---

## Q2. Why do we use Laravel Passport?

### Answer

Laravel Passport is used to:

- Secure REST APIs
- Implement OAuth 2.0 authentication
- Generate access tokens
- Authenticate third-party applications
- Support mobile applications
- Provide secure API access

---

## Q3. What is OAuth 2.0?

### Answer

**OAuth 2.0** is an industry-standard authorization framework that allows third-party applications to access resources on behalf of a user without exposing the user's password.

Instead of sharing credentials, OAuth issues secure access tokens.

---

## Q4. What is an Access Token?

### Answer

An **Access Token** is a secure token issued after successful authentication.

Clients send this token with each API request to prove their identity.

Example:

```http
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJh...
```

The server validates the token before processing the request.

---

## Q5. What is the difference between Passport and Sanctum?

### Answer

| Passport | Sanctum |
|-----------|----------|
| OAuth 2.0 authentication | Lightweight token authentication |
| Supports third-party applications | Best for first-party SPAs and mobile apps |
| More complex setup | Simple setup |
| Supports OAuth grants | Personal access tokens and SPA authentication |

---

## Q6. When should you use Passport?

### Answer

Use Passport when your application requires:

- OAuth 2.0 support
- Third-party application authentication
- Public APIs
- Authorization servers
- Multiple client applications
- Enterprise-level API security

---

## Q7. How do you install Laravel Passport?

### Answer

Install Passport using Composer:

```bash
composer require laravel/passport
```

Then publish and run the migrations:

```bash
php artisan migrate
```

Finally, install Passport's encryption keys:

```bash
php artisan passport:install
```

---

## Q8. What tables does Passport create?

### Answer

Passport creates several database tables, including:

- `oauth_access_tokens`
- `oauth_refresh_tokens`
- `oauth_clients`
- `oauth_auth_codes`
- `oauth_personal_access_clients`

These tables store OAuth clients and tokens.

---

## Q9. How do you protect API routes using Passport?

### Answer

Example:

```php
Route::middleware('auth:api')
    ->get('/profile', function () {

        return auth()->user();

    });
```

Only authenticated users with valid access tokens can access the route.

---

## Q10. What are OAuth Clients?

### Answer

An **OAuth Client** is an application that requests access to your API.

Examples:

- Mobile application
- React frontend
- Angular application
- Third-party website

Each client has its own Client ID and Client Secret.

---

## Q11. What are Personal Access Tokens?

### Answer

Personal Access Tokens allow users to generate tokens for accessing the API without using the full OAuth authorization flow.

Example:

```php
$token = $user->createToken(
    'API Token'
)->accessToken;
```

The generated token is used in API requests.

---

## Q12. What are Refresh Tokens?

### Answer

A **Refresh Token** is used to obtain a new access token after the current one expires.

Benefits:

- Improves security
- Avoids repeated logins
- Extends authenticated sessions

---

## Q13. What are Authorization Codes?

### Answer

The **Authorization Code Grant** is an OAuth 2.0 flow where:

1. The user logs in.
2. The application receives an authorization code.
3. The code is exchanged for an access token.

This is commonly used by third-party applications.

---

## Q14. What OAuth Grant Types does Passport support?

### Answer

Passport supports several OAuth 2.0 grant types, including:

- Authorization Code Grant
- Password Grant *(legacy; not recommended for new applications)*
- Client Credentials Grant
- Personal Access Tokens
- Refresh Token Grant

---

## Q15. How do clients send the access token?

### Answer

Clients include the token in the HTTP Authorization header.

Example:

```http
Authorization: Bearer ACCESS_TOKEN
```

Laravel validates the token before allowing access to protected routes.

---

## Q16. What are Passport Scopes?

### Answer

**Scopes** define what an access token is allowed to do.

Example:

```php
Passport::tokensCan([

    'read-posts' => 'Read posts',

    'write-posts' => 'Create posts',

]);
```

Scopes provide fine-grained access control.

---

## Q17. What are some real-world uses of Passport?

### Answer

Passport is commonly used for:

- Public REST APIs
- Banking applications
- Payment gateways
- Enterprise APIs
- Third-party integrations
- SaaS applications
- Mobile applications

---

## Q18. What are the advantages of Laravel Passport?

### Answer

Passport provides several benefits:

- OAuth 2.0 support
- Secure API authentication
- Access token management
- Refresh tokens
- Token scopes
- Third-party application support
- Official Laravel package

---

## Q19. What are some commonly used Passport Artisan commands?

### Answer

Install Passport:

```bash
php artisan passport:install
```

Generate encryption keys:

```bash
php artisan passport:keys
```

Create an OAuth client:

```bash
php artisan passport:client
```

---

## Q20. What is the authentication flow in Passport?

### Answer

Workflow:

```text
User Login
      │
      ▼
OAuth Client
      │
      ▼
Passport
      │
      ▼
Access Token Issued
      │
      ▼
Client Sends Token
      │
      ▼
Protected API
      │
      ▼
Response
```

Passport verifies the token before granting access to protected resources.

---

## Q21. What is the difference between Session Authentication and Passport Authentication?

### Answer

| Session Authentication | Passport Authentication |
|------------------------|-------------------------|
| Uses sessions and cookies | Uses OAuth access tokens |
| Best for web applications | Best for APIs |
| Browser-based | Token-based |
| Stateful | Stateless |

---

## Q22. Give a real-world example of Passport.

### Answer

Consider a food delivery application.

```text
Mobile App
      │
      ▼
User Login
      │
      ▼
Laravel Passport
      │
      ▼
Access Token
      │
      ▼
API Requests
      │
      ▼
Order Data Returned
```

The mobile application uses the access token to securely communicate with the Laravel API.

---

## Q23. Why is Laravel Passport important?

### Answer

Laravel Passport is a powerful authentication solution for API-driven applications.

It:

- Implements the OAuth 2.0 standard
- Secures RESTful APIs
- Supports third-party integrations
- Provides access and refresh tokens
- Enables token scopes and client management
- Helps build secure, scalable, and enterprise-grade APIs