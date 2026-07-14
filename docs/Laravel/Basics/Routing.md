# Laravel Routing - Interview Questions & Answers

## Q1. What is Routing in Laravel?

### Answer

Routing is the mechanism that maps an incoming HTTP request (such as **GET**, **POST**, **PUT**, **PATCH**, or **DELETE**) to a specific action in the application.

In Laravel, routes determine how the application responds to a particular URL. A route can execute either:

- A Closure (anonymous function)
- A Controller method

Web routes are defined in **`routes/web.php`**, while API routes are defined in **`routes/api.php`**.

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
Controller
    │
    ▼
Model (Optional)
    │
    ▼
View / JSON Response
    │
    ▼
Browser
```

### Interview Tip

> Routing is the entry point of every HTTP request in a Laravel application.

---

## Q2. Where are routes defined in Laravel?

### Answer

Laravel stores routes inside the **routes** directory.

```text
routes/
├── web.php
├── api.php
├── console.php
└── channels.php
```

**web.php**

- Used for web applications
- Supports sessions
- Supports CSRF protection

**api.php**

- Used for REST APIs
- Stateless
- No session support

---

## Q3. How do you define a basic route?

### Answer

```php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Welcome to Laravel!';
});
```

When a user visits:

```
http://localhost:8000/
```

Laravel returns:

```
Welcome to Laravel!
```

---

## Q4. How do you define a route that uses a controller?

### Answer

Instead of a Closure, Laravel recommends using controllers.

```php
use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index']);
```

Controller:

```php
class UserController extends Controller
{
    public function index()
    {
        return "List of users";
    }
}
```

Using controllers keeps routes clean and separates business logic.

---

## Q5. What HTTP methods does Laravel support?

### Answer

Laravel supports all common HTTP verbs.

| Method | Purpose |
|---------|---------|
| GET | Retrieve data |
| POST | Create data |
| PUT | Update an entire resource |
| PATCH | Partially update a resource |
| DELETE | Delete data |

Example:

```php
Route::get('/users', ...);
Route::post('/users', ...);
Route::put('/users/{id}', ...);
Route::patch('/users/{id}', ...);
Route::delete('/users/{id}', ...);
```

---

## Q6. What are Route Parameters?

### Answer

Route parameters allow values to be passed through the URL.

Example:

```php
Route::get('/users/{id}', function ($id) {
    return "User ID: " . $id;
});
```

Request:

```
/users/5
```

Output:

```
User ID: 5
```

---

## Q7. What are Named Routes?

### Answer

Named routes allow you to reference routes using a name instead of hardcoding URLs.

Example:

```php
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
```

Redirect:

```php
return redirect()->route('dashboard');
```

Generate URL:

```php
$url = route('dashboard');
```

### Benefits

- Easy maintenance
- Avoid hardcoded URLs
- Better readability

---

## Q8. What are Route Groups?

### Answer

Route groups allow multiple routes to share common attributes such as:

- Prefix
- Middleware
- Namespace
- Controller

Example:

```php
Route::prefix('admin')->group(function () {

    Route::get('/users', ...);

    Route::get('/products', ...);

});
```

Generated URLs:

```
/admin/users
/admin/products
```

---

## Q9. What are Resource Routes?

### Answer

A resource route automatically creates CRUD routes.

```php
Route::resource('users', UserController::class);
```

Generated routes:

- index
- create
- store
- show
- edit
- update
- destroy

This reduces repetitive route definitions.

---

## Q10. What is Route Model Binding?

### Answer

Route Model Binding automatically injects a model instance into the route or controller.

Without Route Model Binding:

```php
$user = User::find($id);
```

With Route Model Binding:

```php
Route::get('/users/{user}', function (User $user) {
    return $user;
});
```

Laravel automatically queries the database based on the route parameter.

### Benefits

- Less code
- Cleaner controllers
- Automatic 404 response if the model is not found

---

## Q11. What are the advantages of Routing in Laravel?

### Answer

- Clean URL management
- Maps URLs to controllers
- Supports RESTful APIs
- Route naming
- Route grouping
- Middleware support
- Route model binding
- Better application organization
- Improved maintainability

---

---

## Q12. What is a Fallback Route?

### Answer

A **Fallback Route** is executed when no other route matches the incoming request. It is commonly used to display a custom **404 Not Found** page.

Example:

```php
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
```

### Use Cases

- Custom 404 page
- Redirect users to a specific page
- Return a JSON response for APIs

### Interview Tip

> The fallback route should always be defined **at the end** of the route file because Laravel matches routes in the order they are defined.

---

## Q13. What is Rate Limiting in Laravel?

### Answer

**Rate Limiting** restricts the number of requests a client can make within a given time period. It helps protect applications from abuse, brute-force attacks, and API overuse.

Laravel provides built-in rate limiting using the `RateLimiter` facade and the `throttle` middleware.

Example:

```php
Route::middleware('throttle:60,1')->group(function () {
    Route::get('/profile', function () {
        //
    });
});
```

This allows:

- **60 requests**
- **Per 1 minute**

### API Example

Laravel automatically applies rate limiting to API routes.

```php
Route::middleware('throttle:api')->group(function () {
    //
});
```

### Benefits

- Prevents abuse
- Protects APIs
- Reduces server load
- Improves security

---

## Q14. What is Method Spoofing?

### Answer

HTML forms support only **GET** and **POST** methods.

To send **PUT**, **PATCH**, or **DELETE** requests, Laravel uses **Method Spoofing**.

Example:

```blade
<form action="/users/1" method="POST">
    @csrf
    @method('PUT')

    <button type="submit">
        Update
    </button>
</form>
```

Laravel converts the request into a **PUT** request internally.

Equivalent HTML:

```html
<input type="hidden" name="_method" value="PUT">
```

### Supported Methods

- PUT
- PATCH
- DELETE

### Interview Tip

> Method Spoofing is required because browsers do not natively support PUT, PATCH, or DELETE in HTML forms.

---

## Q15. What is CORS?

### Answer

**CORS (Cross-Origin Resource Sharing)** is a browser security mechanism that controls whether a web application can access resources from a different domain, protocol, or port.

Example:

Frontend:

```
http://localhost:3000
```

Backend:

```
http://localhost:8000
```

Without CORS, the browser blocks the request.

Laravel allows configuring CORS using the `config/cors.php` configuration file.

Example:

```php
'allowed_origins' => [
    'http://localhost:3000',
],
```

### Why is CORS Needed?

- Allows frontend and backend to communicate
- Enables secure API access
- Prevents unauthorized cross-origin requests

### Interview Tip

> CORS is enforced by the **browser**, not Laravel. Laravel simply sends the appropriate HTTP headers.

---

## Q16. What is Route Caching?

### Answer

Route Caching improves application performance by storing all registered routes in a cached file.

Instead of parsing route definitions on every request, Laravel loads the cached routes.

Create route cache:

```bash
php artisan route:cache
```

Clear route cache:

```bash
php artisan route:clear
```

View all routes:

```bash
php artisan route:list
```

### Benefits

- Faster application boot time
- Better production performance
- Reduces route registration overhead

### Limitations

Route caching **does not support Closure-based routes**.

Example (Not Supported):

```php
Route::get('/', function () {
    return 'Welcome';
});
```

Instead, use controllers:

```php
Route::get('/', [HomeController::class, 'index']);
```

### Interview Tip

> Route caching should be used in **production** environments for better performance. It only works when all routes are controller-based and contain no Closures.