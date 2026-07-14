# Laravel Request - Interview Questions & Answers

## Q1. What is the Request object in Laravel?

### Answer

The **Request** object represents the current HTTP request made by the client. It contains all the information about the incoming request, such as:

- Form data
- Query parameters
- Route parameters
- Uploaded files
- Cookies
- Headers
- JSON payload
- HTTP method

Laravel automatically injects the `Illuminate\Http\Request` object into controllers using **Dependency Injection**.

Example:

```php
use Illuminate\Http\Request;

public function store(Request $request)
{
    //
}
```

---

## Q2. Why do we use the Request object?

### Answer

The Request object provides a clean and convenient way to access incoming request data.

It is used to:

- Retrieve form inputs
- Access query parameters
- Read JSON requests
- Handle uploaded files
- Retrieve cookies
- Access request headers
- Validate incoming data

---

## Q3. How do you retrieve all request data?

### Answer

Use the `all()` method.

```php
$data = $request->all();
```

Example Output:

```php
[
    "name" => "John",
    "email" => "john@example.com"
]
```

---

## Q4. How do you retrieve a specific input value?

### Answer

Use the `input()` method.

```php
$name = $request->input('name');
```

Provide a default value:

```php
$name = $request->input('name', 'Guest');
```

---

## Q5. What is the difference between `input()`, `query()`, and `route()`?

### Answer

| Method | Retrieves |
|---------|-----------|
| `input()` | Form data, JSON body, query parameters |
| `query()` | Query string parameters only |
| `route()` | Route parameters |

Example URL:

```
/users/10?page=2
```

Route:

```php
Route::get('/users/{id}', ...);
```

```php
$request->route('id');    // 10

$request->query('page');  // 2

$request->input('page');  // 2
```

---

## Q6. How do you retrieve only selected input fields?

### Answer

Use the `only()` method.

```php
$data = $request->only([
    'name',
    'email'
]);
```

---

## Q7. How do you exclude specific input fields?

### Answer

Use the `except()` method.

```php
$data = $request->except([
    '_token',
    'password'
]);
```

---

## Q8. How do you check if an input exists?

### Answer

Use the `has()` method.

```php
if ($request->has('email')) {

}
```

Multiple inputs:

```php
$request->has([
    'name',
    'email'
]);
```

---

## Q9. What is the difference between `has()`, `filled()`, and `missing()`?

### Answer

### has()

Checks if the key exists.

```php
$request->has('name');
```

### filled()

Checks if the value exists and is not empty.

```php
$request->filled('name');
```

### missing()

Checks if the input does not exist.

```php
$request->missing('email');
```

---

## Q10. How do you retrieve uploaded files?

### Answer

Use the `file()` method.

```php
$file = $request->file('image');
```

Check if a file exists:

```php
if ($request->hasFile('image')) {

}
```

Store a file:

```php
$path = $request->file('image')
                ->store('images');
```

---

## Q11. How do you retrieve request headers?

### Answer

```php
$token = $request->header('Authorization');
```

Default value:

```php
$request->header(
    'Authorization',
    null
);
```

---

## Q12. How do you retrieve cookies?

### Answer

```php
$value = $request->cookie('theme');
```

Default value:

```php
$value = $request->cookie(
    'theme',
    'light'
);
```

---

## Q13. How do you retrieve JSON request data?

### Answer

Laravel automatically parses JSON requests.

```php
$name = $request->input('name');
```

Entire JSON:

```php
$data = $request->json()->all();
```

---

## Q14. How do you determine the HTTP request method?

### Answer

```php
$request->method();
```

Example Output:

```
GET
```

Check a specific method:

```php
$request->isMethod('POST');
```

---

## Q15. How do you retrieve the current URL?

### Answer

Current URL:

```php
$url = $request->url();
```

Full URL:

```php
$fullUrl = $request->fullUrl();
```

Current Path:

```php
$path = $request->path();
```

---

## Q16. How do you validate incoming requests?

### Answer

Laravel provides built-in validation.

Example:

```php
$request->validate([
    'name' => 'required|string',
    'email' => 'required|email'
]);
```

If validation fails, Laravel automatically redirects back with validation errors.

---

## Q17. What is Form Request Validation?

### Answer

Form Request Validation moves validation logic into a dedicated class.

Generate a Form Request:

```bash
php artisan make:request StoreUserRequest
```

Example:

```php
public function rules()
{
    return [
        'name' => 'required',
        'email' => 'required|email'
    ];
}
```

Controller:

```php
public function store(StoreUserRequest $request)
{
    //
}
```

### Benefits

- Cleaner controllers
- Reusable validation
- Better organization

---

## Q18. What is Dependency Injection in Request?

### Answer

Laravel automatically injects the Request object into controller methods.

Example:

```php
public function store(Request $request)
{
    //
}
```

This is handled by Laravel's **Service Container**.

---

## Q19. What is the difference between `Request` and the `request()` helper?

### Answer

Using Dependency Injection:

```php
public function store(Request $request)
{
    $request->input('name');
}
```

Using the helper:

```php
$name = request('name');

$data = request()->all();
```

Both access the current request, but Dependency Injection is generally preferred because it improves readability, testability, and makes dependencies explicit.

---

## Q20. What are the advantages of the Request object?

### Answer

- Easy access to request data
- Automatic JSON parsing
- Built-in file upload support
- Cookie and header access
- Validation support
- Dependency Injection
- Cleaner controllers
- Better code organization

---

## Interview Summary

> The Laravel Request object represents the current HTTP request and provides methods to access input data, query parameters, route parameters, files, cookies, headers, and JSON payloads. It also integrates with Laravel's validation system and is automatically injected into controllers through Dependency Injection.