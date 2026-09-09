# RESTFUL API — Must-Know Interview Q&A

# Table of Contents

1. [What makes an API RESTful?](#1-what-makes-an-api-restful)
2. [What is the difference between GET vs POST vs PUT vs PATCH vs DELETE?](#2-what-is-the-difference-between-get-vs-post-vs-put-vs-patch-vs-delete)
3. [What is the difference between 200, 201, and 204?](#3-what-is-the-difference-between-200-201-and-204)
4. [What is the difference between 400, 401, 403, 404, 422, and 500?](#4-what-is-the-difference-between-400-401-403-404-422-and-500)
5. [How does JWT work?](#5-how-does-jwt-work)
6. [How do you handle an expired JWT token in Laravel?](#6-how-do-you-handle-an-expired-jwt-token-in-laravel)
7. [Where is the authentication token stored in Laravel?](#7-where-is-the-authentication-token-stored-in-laravel)
8. [How do you secure a REST API?](#8-how-do-you-secure-a-rest-api)
9. [How do you handle API validation errors in Laravel?](#9-how-do-you-handle-api-validation-errors-in-laravel)
10. [How would you design API pagination?](#10-how-would-you-design-api-pagination)
11. [How do you version APIs?](#11-how-do-you-version-apis)
12. [How do you handle duplicate API requests?](#12-how-do-you-handle-duplicate-api-requests)
13. [What is idempotency in APIs?](#13-what-is-idempotency-in-apis)

## 1. What makes an API RESTful?

**Answer**

A RESTful API is an API that follows the principles of REST, or Representational State Transfer.

The main characteristics are:

First, it is resource-based. Everything is treated as a resource, such as users, products, or orders, and we identify those resources using URLs. For example, /users/123 represents a specific user.

Second, it uses HTTP methods correctly. Typically, GET is used to retrieve data, POST to create a resource, PUT or PATCH to update it, and DELETE to remove it.

Third, REST APIs are stateless. Each request should contain all the information needed to process it. The server should not depend on previous requests to understand the current request.

RESTful APIs should also use appropriate HTTP status codes, such as 200 for success, 201 for creation, 404 when a resource isn't found, and 500 for server errors.

So, in short, an API is considered RESTful when it follows REST principles like resource-based URLs, proper HTTP methods, stateless communication, client-server separation, and standard HTTP semantics.

## 2. What is the difference between GET vs POST vs PUT vs PATCH vs DELETE?

**Answer**

These are HTTP methods commonly used in RESTful APIs, and each one has a different purpose.

GET is used to retrieve data from the server. For example, GET /users/123 gets the user with ID 123. It should not modify data.

POST is used to create a new resource. For example, POST /users with user details creates a new user. Calling the same POST request multiple times can potentially create multiple resources.

PUT is generally used to replace or completely update an existing resource. For example, PUT /users/123 can replace the user’s complete information. PUT is also idempotent, meaning making the same request multiple times should have the same final result.

PATCH is used for a partial update. For example, if I only want to change a user's email, I can send PATCH /users/123 with just the email field.

Finally, DELETE is used to remove a resource, such as DELETE /users/123.

So, a simple way to remember them is:

GET → Read
POST → Create
PUT → Replace
PATCH → Partially update
DELETE → Remove

The key difference between PUT and PATCH is that PUT generally represents a complete replacement, while PATCH modifies only specific fields.

## 3. What is the difference between 200, 201, and 204?

**Answer**

All three are successful HTTP status codes, but they indicate different kinds of success.

200 OK means the request was successful and the server is returning a response. It's commonly used for a successful GET, but it can also be used for successful updates or other operations when a response body is returned.

201 Created means the request was successful and a new resource was created. It's most commonly used with a POST request. For example, when we create a new user using POST /users, the server can return 201 along with the newly created user's details.

204 No Content means the request was successful, but the server has no response body to return. It's commonly used after a successful DELETE, or sometimes after an update where the client doesn't need the updated resource in the response.

So, the easiest way to remember is:

200 → Success + response data
201 → Resource created
204 → Success + no response body

For example, if I fetch a user, I might get 200. If I create a new user, I might get 201. And if I delete a user successfully without returning any data, I might get 204.

## 4. What is the difference between 400, 401, 403, 404, 422, and 500?

**Answer**

These are HTTP status codes that help the client understand what happened when an API request was processed.

400 Bad Request means the request is invalid or malformed. For example, the client sends invalid JSON or missing required request parameters.

401 Unauthorized actually means authentication is required or has failed. For example, the client sends an expired or invalid access token.

403 Forbidden means the server understood the request and the user is authenticated, but doesn't have permission to perform that action. For example, a normal user trying to access an admin-only endpoint.

404 Not Found means the requested resource doesn't exist. For example, requesting /users/999 when user 999 doesn't exist.

422 Unprocessable Content means the request is syntactically valid, but the data fails validation or business rules. For example, sending a valid JSON request with an invalid email address or a password that doesn't meet the required rules.

Finally, 500 Internal Server Error means something unexpected went wrong on the server side. For example, an unhandled exception or unexpected database failure.

So, I remember them like this:

400 → Bad request
401 → Not authenticated
403 → Not authorized
404 → Resource not found
422 → Validation failed
500 → Server error

The important distinction is between 401 and 403: 401 is about authentication — “Who are you?” — while 403 is about authorization — “You are identified, but you can't do this.”

## 5. How does JWT work?

**Answer:**

JWT stands for **JSON Web Token**. It is commonly used for **authentication and authorization** in web applications and APIs.

A JWT consists of three parts: **Header, Payload, and Signature**.

When a user logs in with their credentials, the server first verifies those credentials. If they are valid, the server generates a JWT and sends it back to the client.

The client then sends this token with subsequent requests to protected APIs, usually in the **Authorization header** using the `Bearer` scheme.

When the server receives the request, it verifies the JWT's **signature** and checks whether the token is valid and hasn't expired. If the token is valid, the server can read the claims, such as the user's ID or role, and use them to determine whether the user is authorized to access the resource.

One important point is that a JWT is generally **signed, not encrypted**. So we should not put sensitive information like passwords or secret data inside the payload.

The main advantage of JWT is that it supports **stateless authentication**, meaning the server doesn't need to maintain traditional session state for every user.

So, the basic flow is:

**Login → Verify credentials → Generate JWT → Client stores token → Send token with requests → Server verifies token → Grant or deny access.**

## 6. How do you handle an expired JWT token in Laravel?

**Answer:**

In Laravel, handling an expired JWT depends on the authentication package we are using, but the general approach is similar.

When a user logs in, the server generates a JWT with an expiration time, for example, 60 minutes. The client sends this token with every protected API request.

When the token expires, the JWT authentication middleware detects that the token is expired. The API should return a **401 Unauthorized** response instead of allowing the request to continue.

On the client side, when we receive a 401 response because the token has expired, we can use a **refresh token** to request a new access token. The client can then retry the original API request with the new token.

In Laravel, I would also handle JWT-related exceptions centrally, either through the authentication middleware or Laravel's exception handling mechanism, so that the API consistently returns a proper JSON response.

For security, I would keep the access token short-lived and use a longer-lived refresh token. If the refresh token is also expired or invalid, the user needs to log in again.

So the typical flow is:

**Access token expires → API returns 401 → Client sends refresh token → Server validates it → New access token is generated → Original request is retried.**

This approach improves both **security and user experience**, because users don't have to log in again every time their short-lived access token expires.


## 7. Where is the authentication token stored in Laravel?

**Answer:**

It depends on the Laravel authentication package we are using.

If we are using **Laravel Passport**, access tokens are stored server-side in the database, typically in the `oauth_access_tokens` table. The client receives an access token and sends it with API requests using:

`Authorization: Bearer <access_token>`

Laravel Passport then validates that token when the request reaches a protected API route.

If we are using **Laravel Sanctum**, the implementation is different. For SPA authentication, Sanctum typically uses Laravel's session authentication and an HttpOnly cookie. For API tokens, Sanctum stores hashed tokens in the `personal_access_tokens` table.

So, I would not say that Laravel always stores JWTs in one particular table. It depends on the authentication mechanism.

For example:

**Passport → `oauth_access_tokens`**
**Sanctum API tokens → `personal_access_tokens`**
**JWT package → token is usually self-contained and doesn't necessarily require a database record**

The important point is that the **client stores/sends the credential**, while the Laravel authentication system determines how that credential is validated and whether it is persisted server-side.

## 8. How do you secure a REST API?

**Answer:**

There are several layers I would use to secure a REST API.

First, I would implement proper **authentication**, using something like Laravel Sanctum, Passport, or JWT, depending on the application requirements. Every protected endpoint should verify the user's identity.

Second, I would implement **authorization** using Laravel Policies, Gates, or roles and permissions. Authentication tells us who the user is, while authorization determines what that user is allowed to do.

Third, I would always use **HTTPS** so that credentials and API data are encrypted while being transmitted.

I would also use **short-lived access tokens** and a secure refresh-token mechanism when appropriate. Tokens should never contain sensitive information, and they should be revoked when necessary.

Another important area is **input validation**. In Laravel, I would use Form Request validation to make sure incoming data is valid and to prevent malicious or unexpected input.

I would also implement **rate limiting** to protect APIs from brute-force attacks and excessive requests.

For sensitive operations, I would use proper **CSRF protection** where cookie-based authentication is involved, and configure CORS carefully rather than allowing every origin.

Finally, I would avoid exposing sensitive information in API responses, keep secrets in environment variables, use proper HTTP status codes, log security-related events, and keep Laravel and its dependencies updated.

So, in short:

**Authentication + Authorization + HTTPS + Token Security + Validation + Rate Limiting + CORS/CSRF + Secure Error Handling + Monitoring**

Together, these provide a layered approach to REST API security.

## 9. How do you handle API validation errors in Laravel?

**Answer:**

In Laravel, I usually handle API validation using **Form Request classes** or Laravel's built-in validation system.

For example, instead of putting validation logic directly inside the controller, I can create a Form Request class and define the validation rules in the `rules()` method.

For example, for user registration, I might validate that the email is required and unique, and that the password meets the required rules.

If the validation fails, Laravel automatically returns a **422 Unprocessable Content** response for an API request, along with the validation errors.

A typical response could look like:

`{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The email field is required."],
        "password": ["The password must be at least 8 characters."]
    }
}`

On the client side, I can use these field-level errors to show meaningful messages to the user.

For more complex APIs, I also make sure that all validation errors follow a **consistent JSON response format**, so frontend or mobile developers can handle them easily.

I would also keep validation separate from business logic. Validation checks whether the input is acceptable, while the service layer handles the actual business operation.

So, in short:

**Form Request → Define validation rules → Laravel validates the request → Return 422 with structured errors → Client displays the appropriate messages.**

## 10. How would you design API pagination?

**Answer:**

For a REST API, I would use pagination whenever an endpoint can return a large number of records. This prevents the API from loading and returning too much data at once.

In Laravel, I can use Eloquent's built-in pagination methods, such as `paginate()` or `simplePaginate()`.

For example, instead of returning all users, I can use something like:

`User::paginate(20);`

This returns 20 users per page along with pagination metadata.

The client can then request a specific page using query parameters, for example:

`GET /api/users?page=2&per_page=20`

I would also put a reasonable maximum limit on `per_page`, such as 100, so a client cannot request thousands or millions of records in a single request.

The response should include both the data and useful pagination information, such as the current page, page size, total records, last page, and links to the next and previous pages.

For very large datasets, traditional offset pagination can become slower. In that situation, I would consider **cursor-based pagination**, which Laravel supports with `cursorPaginate()`. Cursor pagination is particularly useful for large or frequently changing datasets.

So, in short:

**Use pagination → Define page size → Limit maximum page size → Return pagination metadata → Use cursor pagination for very large datasets when appropriate.**

This improves **API performance, database efficiency, and response time**.

## 11. How do you version APIs?

**Answer** 

I usually version APIs to make sure we can introduce breaking changes without disrupting existing clients.

The most common approach I prefer is **URL-based versioning**, for example:

```text
/api/v1/users
/api/v2/users
```

When we make a backward-incompatible change, such as changing a response structure or removing a field, we introduce a new version rather than modifying the existing one.

For **backward-compatible changes**, like adding an optional field, I generally keep the same API version.

I also make sure that different API versions are supported during a **migration/deprecation period**. We communicate the deprecation timeline to consumers and eventually remove the older version once clients have migrated.

Other approaches include **header-based versioning** or **query-parameter versioning**, but URL versioning is simple, explicit, and easy to understand.

So, in short: **version only when there are breaking changes, maintain backward compatibility where possible, and provide a clear migration and deprecation strategy.**

## 12. How do you handle duplicate API requests?

**Answer**

I handle duplicate requests using **idempotency**.

For important operations like payment or order creation, I use a unique **idempotency key** for each request. The server stores the result for that key.

If the same request comes again with the same key, we don't process it again. We simply return the previous result.

For example, if a payment request is sent twice because of a network issue, the customer should be charged only once.

I also use **unique database constraints** to prevent duplicate data.

So, basically, I use **idempotency keys and database constraints** to safely handle duplicate requests.

## 13. What is idempotency in APIs?

**Answer**

Idempotency means that **making the same API request multiple times should have the same effect as making it once**.

For example, if I send a payment request and, because of a network issue, the request is sent twice, I don't want the customer to be charged twice.

We can handle this using an **idempotency key**. The client sends a unique key with the request, and the server remembers the result. If the same key comes again, the server returns the previous result instead of processing the request again.

So, in simple terms, **idempotency helps make APIs safe when the same request is repeated**.