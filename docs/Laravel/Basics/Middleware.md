# Laravel Middleware - Interview Questions & Answers

## Q1. What is Middleware in Laravel?

### Answer

Middleware acts as a **filter** between an incoming HTTP request and the application.

It intercepts requests before they reach the controller (or before the response is sent back) to perform tasks such as authentication, authorization, logging, CORS handling, and request validation.

### Request Flow

```text
Browser
    │
    ▼
HTTP Request
    │
    ▼
Route
    │
    ▼
Middleware
    │
    ▼
Controller
    │
    ▼
Response
    │
    ▼
Browser
```

### Interview Tip

> Middleware acts as a gatekeeper that decides whether a request should continue to the application or be rejected.

---

## Q2. Why do we use Middleware?

### Answer

Middleware is used to execute logic before or after handling an HTTP request.

Common use cases include:

- Authentication
- Authorization
- CSRF Protection
- Logging
- CORS Handling
- API Rate Limiting
- Request Modification
- Response Modification
- Maintenance Mode

---

## Q3. How do you create Middleware?

### Answer

Generate middleware using Artisan.

```bash
php artisan make:middleware CheckAge
```

Laravel creates:

```text
app/
└── Http/
    └── Middleware/
        └── CheckAge.php
```

---

## Q4. What is the structure of a Middleware?

### Answer

A middleware contains a `handle()` method.

Example:

```php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->age < 18) {
            return response('Unauthorized', 403);
        }

        return $next($request);
    }
}
```

### Explanation

- Perform logic before the request reaches the controller.
- Call `$next($request)` to continue the request.
- Return a response to stop further execution.

---

## Q5. How do you register Middleware?

### Answer

Middleware can be registered in the application's middleware configuration.

You can register it:

- Globally
- As route middleware (alias)
- Within middleware groups

Example (alias):

```php
'check.age' => App\Http\Middleware\CheckAge::class,
```

---

## Q6. How do you apply Middleware to a route?

### Answer

Single middleware:

```php
Route::get('/dashboard', function () {
    //
})->middleware('auth');
```

Multiple middleware:

```php
Route::get('/admin', function () {
    //
})->middleware(['auth', 'verified']);
```

---

## Q7. How do you apply Middleware to a controller?

### Answer

Middleware can be applied inside the controller constructor.

```php
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
```

For specific methods:

```php
$this->middleware('auth')->only(['index', 'show']);
```

Exclude methods:

```php
$this->middleware('auth')->except(['login']);
```

---

## Q8. What are Global Middleware?

### Answer

Global middleware runs on **every incoming HTTP request**.

Examples include:

- Handle CORS
- Trim Strings
- Convert Empty Strings to Null
- Prevent Requests During Maintenance

Global middleware is configured in the application's middleware configuration.

### Use Cases

- Logging
- Maintenance Mode
- CORS
- Request Sanitization

---

## Q9. What are Route Middleware?

### Answer

Route middleware is applied only to selected routes.

Example:

```php
Route::get('/profile', function () {
    //
})->middleware('auth');
```

### Benefits

- Applied only where needed
- Better performance
- Cleaner code

---

## Q10. What are Middleware Groups?

### Answer

Middleware groups allow multiple middleware to be applied together.

Laravel provides two common groups:

- `web`
- `api`

Example:

```php
Route::middleware(['web'])->group(function () {

    Route::get('/home', function () {

    });

});
```

---

## Q11. What is the difference between Global Middleware and Route Middleware?

### Answer

| Global Middleware | Route Middleware |
|-------------------|------------------|
| Runs on every request | Runs only on selected routes |
| Configured globally | Applied individually |
| Used for common functionality | Used for route-specific functionality |

---

## Q12. What is Middleware Priority?

### Answer

Sometimes middleware must execute in a specific order.

Example:

```text
Authenticate
        ↓
Authorize
        ↓
Controller
```

Laravel ensures middleware executes in the correct sequence when required.

---

## Q13. Can Middleware modify the request?

### Answer

Yes.

Middleware can modify the request before it reaches the controller.

Example:

```php
public function handle(Request $request, Closure $next)
{
    $request->merge([
        'country' => 'India'
    ]);

    return $next($request);
}
```

---

## Q14. Can Middleware modify the response?

### Answer

Yes.

Middleware can modify the response after the controller executes.

Example:

```php
public function handle(Request $request, Closure $next)
{
    $response = $next($request);

    $response->headers->set('X-App', 'Laravel');

    return $response;
}
```

---

## Q15. What are some built-in Middleware in Laravel?

### Answer

Common built-in middleware include:

- auth
- guest
- verified
- throttle
- signed
- SubstituteBindings
- ValidateCsrfToken
- HandleCors

---

## Q16. What happens if Middleware doesn't call `$next($request)`?

### Answer

If `$next($request)` is not called, the request stops at the middleware and never reaches the controller.

Example:

```php
public function handle(Request $request, Closure $next)
{
    return response('Access Denied', 403);
}
```

The controller is never executed.

---

## Q17. What is the difference between Authentication and Authorization Middleware?

### Answer

**Authentication Middleware**

Checks **who the user is**.

Example:

```php
->middleware('auth')
```

**Authorization Middleware**

Checks **what the user is allowed to do**.

Example:

```php
->middleware('can:update,user')
```

Authentication verifies identity, while authorization verifies permissions.

---

## Q18. What are the advantages of Middleware?

### Answer

- Separation of concerns
- Reusable request filters
- Improved security
- Cleaner controllers
- Centralized request handling
- Easy authentication and authorization
- Better code organization
- Easy logging and monitoring

---

## Interview Summary

> Middleware is a request filtering mechanism in Laravel that executes before or after a request reaches the controller. It is commonly used for authentication, authorization, CORS, rate limiting, logging, request modification, and response modification.
