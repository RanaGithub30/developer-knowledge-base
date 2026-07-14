# Laravel RESTful API - Interview Questions & Answers

## Q1. What is a RESTful API?

### Answer

A **RESTful API (Representational State Transfer API)** is an architectural style used to enable communication between client applications and servers using the HTTP protocol.

REST APIs expose resources through URLs and use standard HTTP methods such as:

- GET
- POST
- PUT
- PATCH
- DELETE

Laravel provides excellent support for building RESTful APIs.

---

## Q2. Why do we use RESTful APIs?

### Answer

RESTful APIs are used to:

- Connect frontend and backend applications
- Build mobile applications
- Enable third-party integrations
- Exchange data in JSON format
- Support microservices
- Build scalable web services

---

## Q3. What are the principles of REST?

### Answer

REST is based on the following principles:

- Client-Server Architecture
- Stateless Communication
- Uniform Interface
- Resource-Based URLs
- Cacheable Responses
- Layered System

These principles make APIs scalable and maintainable.

---

## Q4. What is a Resource in a REST API?

### Answer

A **Resource** is any object or data exposed through an API.

Examples:

```text
/users
/products
/orders
/categories
```

Each resource is identified by a unique URL.

---

## Q5. Which HTTP methods are commonly used in REST APIs?

### Answer

| HTTP Method | Purpose |
|-------------|---------|
| GET | Retrieve data |
| POST | Create new data |
| PUT | Replace existing data |
| PATCH | Update part of existing data |
| DELETE | Remove data |

---

## Q6. What is the difference between PUT and PATCH?

### Answer

| PUT | PATCH |
|-----|-------|
| Replaces the entire resource | Updates only specific fields |
| Sends complete resource data | Sends only changed fields |
| Used for full updates | Used for partial updates |

---

## Q7. How do you create an API Controller?

### Answer

Use the Artisan command:

```bash
php artisan make:controller Api/ProductController --api
```

The `--api` option generates a controller with methods commonly used for RESTful APIs.

---

## Q8. How do you define API routes?

### Answer

API routes are defined in:

```text
routes/api.php
```

Example:

```php
use App\Http\Controllers\Api\ProductController;

Route::apiResource('products', ProductController::class);
```

Laravel automatically creates RESTful routes.

---

## Q9. What is `Route::apiResource()`?

### Answer

`Route::apiResource()` generates API routes without the `create` and `edit` routes used for web forms.

Example:

```php
Route::apiResource(
    'users',
    UserController::class
);
```

Generated routes include:

- index
- store
- show
- update
- destroy

---

## Q10. What methods are included in an API Resource Controller?

### Answer

An API controller typically contains:

```php
index()

store()

show()

update()

destroy()
```

These methods correspond to standard CRUD operations.

---

## Q11. How do you return JSON responses?

### Answer

Example:

```php
return response()->json([

    'success' => true,

    'message' => 'Product Created'

]);
```

Laravel automatically sends the response in JSON format.

---

## Q12. What is the difference between Web Routes and API Routes?

### Answer

| Web Routes | API Routes |
|------------|------------|
| `routes/web.php` | `routes/api.php` |
| Returns HTML views | Returns JSON responses |
| Uses sessions and cookies | Stateless by default |
| Intended for browsers | Intended for clients such as mobile apps and SPAs |

---

## Q13. How do you validate API requests?

### Answer

Example:

```php
$request->validate([

    'name' => 'required',

    'price' => 'required|numeric'

]);
```

Laravel automatically returns validation errors in JSON for API requests.

---

## Q14. What are API Resources in Laravel?

### Answer

API Resources transform models into JSON responses.

Create one using:

```bash
php artisan make:resource ProductResource
```

Example:

```php
return new ProductResource($product);
```

They help keep API responses consistent.

---

## Q15. What is Resource Collection?

### Answer

A Resource Collection transforms multiple models.

Example:

```php
return ProductResource::collection(
    Product::all()
);
```

It formats all records before returning them to the client.

---

## Q16. How do you authenticate REST APIs?

### Answer

Laravel commonly uses:

- Laravel Sanctum
- Laravel Passport

These packages secure API endpoints using tokens.

Example:

```php
Route::middleware('auth:sanctum')
    ->get('/user', function () {

        return request()->user();

    });
```

---

## Q17. What are HTTP status codes commonly used in REST APIs?

### Answer

| Status Code | Meaning |
|-------------|---------|
| 200 | OK |
| 201 | Created |
| 204 | No Content |
| 400 | Bad Request |
| 401 | Unauthorized |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Validation Error |
| 500 | Internal Server Error |

---

## Q18. What are some best practices for RESTful APIs?

### Answer

Some best practices include:

- Use meaningful resource names
- Return JSON responses
- Use proper HTTP methods
- Return appropriate HTTP status codes
- Validate requests
- Authenticate protected endpoints
- Use pagination for large datasets
- Version APIs when needed
- Handle errors consistently

---

## Q19. What are some real-world uses of RESTful APIs?

### Answer

RESTful APIs are commonly used for:

- Mobile applications
- Single Page Applications (SPA)
- E-commerce platforms
- Payment gateways
- Social media applications
- Third-party integrations
- Microservices
- IoT applications

---

## Q20. What is the difference between REST API and GraphQL?

### Answer

| REST API | GraphQL |
|-----------|----------|
| Multiple endpoints | Single endpoint |
| Fixed response structure | Client requests required fields |
| Uses HTTP methods | Uses queries and mutations |
| Easier to understand | More flexible for complex data |

---

## Q21. Give a real-world example of a RESTful API.

### Answer

Consider an e-commerce application.

```text
GET     /api/products
```

Retrieve all products.

```text
GET     /api/products/1
```

Retrieve product with ID 1.

```text
POST    /api/products
```

Create a new product.

```text
PUT     /api/products/1
```

Update the entire product.

```text
PATCH   /api/products/1
```

Update specific product fields.

```text
DELETE  /api/products/1
```

Delete the product.

---

## Q22. Why are RESTful APIs important in Laravel?

### Answer

RESTful APIs are a fundamental part of modern Laravel development.

They:

- Enable communication between applications
- Support mobile and frontend frameworks
- Return standardized JSON responses
- Integrate with authentication packages like Sanctum and Passport
- Make applications scalable, maintainable, and easy to integrate with third-party services