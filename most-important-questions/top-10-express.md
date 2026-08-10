# Express.js Interview Q&A

## 1. What is Express.js?

Express.js is a **minimal and flexible web framework for Node.js**. It is mainly used to build **REST APIs, web servers, and backend applications**.

It provides features like routing, middleware, request/response handling, and error handling.

---

## 2. Explain Express middleware.

Middleware is a **function that runs between the incoming request and the final response**.

It can:

* Modify the request or response
* Authenticate users
* Log requests
* Validate data
* Handle errors

Example:

```js
app.use((req, res, next) => {
  console.log(req.method, req.url);
  next();
});
```

`next()` passes control to the next middleware.

---

## 3. How does Express request/response flow work?

The basic flow is:

```text
Client
  ↓
Request
  ↓
Middleware
  ↓
Route Handler
  ↓
Response
  ↓
Client
```

For example:

```js
app.get("/users", authMiddleware, (req, res) => {
  res.json({ users: [] });
});
```

The request first passes through `authMiddleware`, then reaches the route handler.

---

## 4. Application-level vs router-level middleware.

### Application-level

Applied to the entire Express application.

```js
app.use(logger);
```

It can run for multiple routes.

### Router-level

Applied only to a specific router.

```js
router.use(authMiddleware);
```

**Short answer:** Application middleware is generally used across the application, while router middleware is scoped to a particular router or set of routes.

---

## 5. How do you implement authentication middleware?

Authentication middleware verifies the user's credentials or token before allowing access to a protected route.

For example, with a JWT:

```js
const jwt = require("jsonwebtoken");

function auth(req, res, next) {
  const token = req.headers.authorization?.split(" ")[1];

  if (!token) {
    return res.status(401).json({ message: "Unauthorized" });
  }

  try {
    req.user = jwt.verify(token, process.env.JWT_SECRET);
    next();
  } catch {
    res.status(401).json({ message: "Invalid token" });
  }
}
```

Then:

```js
app.get("/profile", auth, (req, res) => {
  res.json(req.user);
});
```

**Interview answer:** The middleware extracts the token, verifies it, attaches the user information to the request, and calls `next()` if authentication succeeds.

---

## 6. How do you handle errors globally?

I use a **centralized error-handling middleware** at the end of the middleware chain.

```js
app.use((err, req, res, next) => {
  console.error(err);

  res.status(err.status || 500).json({
    message: err.message || "Internal Server Error"
  });
});
```

For errors from asynchronous route handlers, I make sure rejected Promises are forwarded to the error handler, using the async-error behavior provided by the Express version or an appropriate wrapper.

**Interview answer:** Centralized error handling keeps error responses consistent and avoids repeating error-handling code in every route.

---

## 7. How do you validate request data?

I validate request data **before processing it**.

Common libraries include:

* Joi
* Zod
* express-validator

Example with a schema-based validator:

```js
const schema = z.object({
  name: z.string().min(2),
  email: z.string().email()
});
```

**Interview answer:** I validate `req.body`, `req.params`, and `req.query` using a validation library and return a `400 Bad Request` when the data is invalid.

---

## 8. How do you structure a large Express application?

For a large application, I separate the code by responsibility.

```text
src/
├── routes/
├── controllers/
├── services/
├── models/
├── middleware/
├── validators/
├── config/
└── app.js
```

Typical flow:

```text
Route → Controller → Service → Model/Database
```

**Interview answer:** I keep routes thin, put business logic in services, database logic in models/repositories, and reusable logic in middleware.

---

## 9. How do you implement rate limiting?

I use a rate-limiting middleware to **limit the number of requests a client can make within a specific time period**.

For example, using `express-rate-limit`:

```js
const rateLimit = require("express-rate-limit");

const limiter = rateLimit({
  windowMs: 15 * 60 * 1000,
  limit: 100
});

app.use("/api", limiter);
```

**Interview answer:** Rate limiting protects APIs from abuse, brute-force attacks, and excessive traffic.

For distributed applications, I would use a shared store or enforce limits at an API gateway/load-balancer layer rather than relying only on in-memory counters.

---

## 10. How do you secure an Express API?

I follow multiple security practices:

* Use **HTTPS**
* Validate and sanitize input
* Use authentication and authorization
* Use secure password hashing such as **Argon2 or bcrypt**
* Protect secrets with environment/secret management
* Configure security headers, commonly with **Helmet**
* Implement rate limiting
* Use secure cookies where applicable
* Keep dependencies updated
* Avoid exposing sensitive error details
* Configure CORS carefully

**Interview answer:**

> "I secure an Express API using HTTPS, authentication and authorization, input validation, secure password hashing, security headers, rate limiting, proper CORS configuration, and safe secret management."

---

# ⭐ One-Line Revision

| #  | Topic                    | Short Answer                                                  |
| -- | ------------------------ | ------------------------------------------------------------- |
| 1  | Express.js               | Node.js framework for web servers and APIs                    |
| 2  | Middleware               | Functions that run during request processing                  |
| 3  | Request Flow             | Request → Middleware → Route → Response                       |
| 4  | App vs Router Middleware | Global scope vs router-specific scope                         |
| 5  | Auth Middleware          | Verify credentials/token before accessing routes              |
| 6  | Global Errors            | Centralized error-handling middleware                         |
| 7  | Validation               | Validate body, params, and query before processing            |
| 8  | Project Structure        | Separate routes, controllers, services, models, middleware    |
| 9  | Rate Limiting            | Limit requests to prevent abuse                               |
| 10 | API Security             | HTTPS + auth + validation + headers + rate limiting + secrets |