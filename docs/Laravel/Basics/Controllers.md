# Laravel Controllers - Interview Questions & Answers

## Q1. What is a Controller in Laravel?

### Answer

A **Controller** is a class responsible for handling incoming HTTP requests and returning the appropriate response.

Controllers act as an intermediary between the **Model** and the **View**, keeping business logic separate from routes.

Instead of placing application logic inside routes, Laravel recommends organizing it inside controllers.

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
    ├──────────────┐
    ▼              ▼
 Model          View/JSON
    │
    ▼
Database
```

### Interview Tip

> Controllers help keep routes clean by separating request handling from business logic.

---

## Q2. Why do we use Controllers?

### Answer

Controllers are used to organize application logic and improve code maintainability.

### Benefits

- Keeps routes clean
- Separates business logic
- Improves code reusability
- Easier testing
- Better project organization
- Supports Dependency Injection

---

## Q3. How do you create a Controller?

### Answer

Use the Artisan command:

```bash
php artisan make:controller UserController
```

Laravel creates:

```text
app/
└── Http/
    └── Controllers/
        └── UserController.php
```

Basic controller:

```php
namespace App\Http\Controllers;

class UserController extends Controller
{
    //
}
```

---

## Q4. How do you define a Controller Route?

### Answer

Instead of using a Closure, routes can point to a controller method.

Example:

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
        return "All Users";
    }
}
```

---

## Q5. What is a Resource Controller?

### Answer

A **Resource Controller** provides methods for performing CRUD (Create, Read, Update, Delete) operations.

Generate a resource controller:

```bash
php artisan make:controller UserController --resource
```

Laravel generates:

```php
index()
create()
store()
show()
edit()
update()
destroy()
```

Register the routes:

```php
Route::resource('users', UserController::class);
```

---

## Q6. What methods are available in a Resource Controller?

### Answer

| Method | Purpose |
|---------|---------|
| index() | Display all records |
| create() | Show create form |
| store() | Save new record |
| show() | Display single record |
| edit() | Show edit form |
| update() | Update record |
| destroy() | Delete record |

---

## Q7. What is a Single Action Controller?

### Answer

A **Single Action Controller** handles only one action using the `__invoke()` method.

Create it using:

```bash
php artisan make:controller ProfileController --invokable
```

Example:

```php
class ProfileController extends Controller
{
    public function __invoke()
    {
        return "Profile";
    }
}
```

Route:

```php
Route::get('/profile', ProfileController::class);
```

### Use Cases

- Contact page
- Dashboard
- Landing page
- Webhook endpoint

---

## Q8. How do you pass data from a Controller to a View?

### Answer

Using the `view()` helper.

Example:

```php
public function index()
{
    $users = User::all();

    return view('users.index', compact('users'));
}
```

Alternative:

```php
return view('users.index', [
    'users' => $users
]);
```

---

## Q9. How do you return a JSON response from a Controller?

### Answer

Example:

```php
public function index()
{
    return response()->json([
        'success' => true,
        'message' => 'Users fetched successfully'
    ]);
}
```

This is commonly used for APIs.

---

## Q10. How do Controllers receive Request data?

### Answer

Laravel uses **Dependency Injection**.

Example:

```php
use Illuminate\Http\Request;

public function store(Request $request)
{
    $name = $request->input('name');

    return $name;
}
```

Laravel automatically injects the `Request` object.

---

## Q11. Can Middleware be applied to Controllers?

### Answer

Yes.

Example:

```php
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
```

Specific methods:

```php
$this->middleware('auth')->only([
    'index',
    'show'
]);
```

Exclude methods:

```php
$this->middleware('auth')->except([
    'login'
]);
```

---

## Q12. What is Dependency Injection in Controllers?

### Answer

Dependency Injection allows Laravel to automatically provide required class instances to a controller.

Example:

```php
public function show(UserService $service)
{
    return $service->all();
}
```

Laravel resolves the dependency using the **Service Container**.

### Benefits

- Loose coupling
- Easier testing
- Better maintainability

---

## Q13. What is Route Model Binding in Controllers?

### Answer

Laravel automatically injects a model instance into a controller.

Without Route Model Binding:

```php
public function show($id)
{
    $user = User::findOrFail($id);

    return $user;
}
```

With Route Model Binding:

```php
public function show(User $user)
{
    return $user;
}
```

Route:

```php
Route::get('/users/{user}', [
    UserController::class,
    'show'
]);
```

### Benefits

- Cleaner code
- Automatic 404 responses
- Less boilerplate

---

## Q14. What is the difference between a Closure Route and a Controller?

### Answer

| Closure Route | Controller |
|--------------|------------|
| Uses an anonymous function | Uses a class method |
| Suitable for small applications | Suitable for medium and large applications |
| Harder to maintain | Easier to organize |
| Not compatible with route caching | Compatible with route caching |

### Recommendation

Use controllers for production applications.

---

## Q15. What are Controller Namespaces?

### Answer

Controllers are typically located in:

```text
app/
└── Http/
    └── Controllers/
```

Example namespace:

```php
namespace App\Http\Controllers;
```

---

## Q16. What are the advantages of Controllers?

### Answer

- Cleaner routes
- Better separation of concerns
- Improved code organization
- Reusable business logic
- Easier testing
- Supports Dependency Injection
- Middleware integration
- Better scalability

---

## Interview Summary

> A Controller is a class that handles incoming HTTP requests, processes business logic, communicates with models, and returns a view or JSON response. Controllers improve code organization, promote separation of concerns, and are the recommended way to handle application logic in Laravel.