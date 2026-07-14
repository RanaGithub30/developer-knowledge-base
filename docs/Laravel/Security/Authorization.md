# Laravel Authorization - Interview Questions & Answers

## Q1. What is Authorization in Laravel?

### Answer

**Authorization** is the process of determining **what an authenticated user is allowed to do** within an application.

After a user logs in (Authentication), Laravel uses Authorization to check whether the user has permission to perform a specific action.

Examples:

- Can edit a post
- Can delete a user
- Can access the admin panel
- Can update an order
- Can view a report

---

## Q2. Why do we use Authorization?

### Answer

Authorization is used to:

- Protect sensitive resources
- Control user permissions
- Restrict unauthorized actions
- Implement role-based access
- Improve application security
- Enforce business rules

---

## Q3. What is the difference between Authentication and Authorization?

### Answer

| Authentication | Authorization |
|---------------|---------------|
| Verifies user identity | Determines user permissions |
| Login process | Permission checking |
| "Who are you?" | "What can you do?" |
| Happens first | Happens after authentication |

Example:

- Authentication → User logs in.
- Authorization → User is allowed to edit only their own post.

---

## Q4. What are the main authorization methods in Laravel?

### Answer

Laravel provides two primary authorization mechanisms:

- **Gates**
- **Policies**

Both are used to determine whether a user can perform specific actions.

---

## Q5. What are Gates?

### Answer

**Gates** are simple authorization rules used for actions that do not require a dedicated policy class.

They are typically defined in the application's service providers.

Example:

```php
Gate::define('edit-post', function ($user, $post) {
    return $user->id === $post->user_id;
});
```

---

## Q6. What are Policies?

### Answer

**Policies** are classes that organize authorization logic for a specific model.

Example:

```
PostPolicy
```

A policy may contain methods such as:

- view()
- create()
- update()
- delete()
- restore()
- forceDelete()

Policies keep authorization logic clean and reusable.

---

## Q7. How do you create a Policy?

### Answer

Use the Artisan command:

```bash
php artisan make:policy PostPolicy
```

Or create one associated with a model:

```bash
php artisan make:policy PostPolicy --model=Post
```

Laravel creates the policy in:

```text
app/Policies
```

---

## Q8. How do you authorize an action using a Gate?

### Answer

Example:

```php
use Illuminate\Support\Facades\Gate;

if (Gate::allows('edit-post', $post)) {

    // Authorized

}
```

To deny access:

```php
if (Gate::denies('edit-post', $post)) {

    // Not Authorized

}
```

---

## Q9. How do you authorize using a Policy?

### Answer

Example:

```php
public function update(User $user, Post $post)
{
    return $user->id === $post->user_id;
}
```

Controller:

```php
$this->authorize('update', $post);
```

Laravel automatically calls the appropriate policy method.

---

## Q10. What is the `authorize()` method?

### Answer

The `authorize()` method checks whether the authenticated user is allowed to perform an action.

Example:

```php
$this->authorize('delete', $post);
```

If the user is not authorized, Laravel automatically throws a **403 Forbidden** response.

---

## Q11. What is the `can()` method?

### Answer

The `can()` method checks permissions for the authenticated user.

Example:

```php
if (Auth::user()->can('update', $post)) {

    // Allowed

}
```

It returns `true` if the action is permitted.

---

## Q12. What is the `cannot()` method?

### Answer

The `cannot()` method is the opposite of `can()`.

Example:

```php
if (Auth::user()->cannot('delete', $post)) {

    // Access denied

}
```

It returns `true` if the user is not authorized.

---

## Q13. How do you use authorization in Blade templates?

### Answer

Laravel provides the `@can` directive.

Example:

```blade
@can('update', $post)

    <button>Edit</button>

@endcan
```

You can also use:

```blade
@cannot('delete', $post)

    <p>Access Denied</p>

@endcannot
```

---

## Q14. What is the `Gate::allows()` method?

### Answer

`Gate::allows()` checks whether an action is authorized.

Example:

```php
if (Gate::allows('delete-post', $post)) {

    // Allowed

}
```

It returns `true` if the authorization succeeds.

---

## Q15. What is the `Gate::authorize()` method?

### Answer

Example:

```php
Gate::authorize('update', $post);
```

If the user is not authorized, Laravel automatically throws a **403 Forbidden** exception.

---

## Q16. Where are Gates and Policies registered?

### Answer

Policies are commonly registered in the application's service providers.

In earlier Laravel versions, this was typically done in:

```text
app/Providers/AuthServiceProvider.php
```

Example:

```php
protected $policies = [

    Post::class => PostPolicy::class,

];
```

> **Note:** Newer Laravel versions support policy auto-discovery, reducing the need for manual registration in many cases.

---

## Q17. What are some real-world uses of Authorization?

### Answer

Authorization is commonly used for:

- Admin panel access
- Editing blog posts
- Deleting users
- Managing products
- Updating orders
- Viewing confidential reports
- Accessing premium content

---

## Q18. What are the advantages of using Policies?

### Answer

Policies provide several benefits:

- Organized authorization logic
- Reusable code
- Model-specific permissions
- Cleaner controllers
- Better maintainability
- Easier testing

---

## Q19. What are the advantages of using Gates?

### Answer

Gates provide several benefits:

- Simple authorization rules
- Easy to implement
- Suitable for small applications
- No separate policy class required
- Good for single-action permissions

---

## Q20. What is the relationship between Authentication and Authorization?

### Answer

Workflow:

```text
User Login
      │
      ▼
Authentication
      │
      ▼
Authenticated User
      │
      ▼
Authorization
      │
 ┌────┴────┐
 │         │
 ▼         ▼
Allowed   Denied
```

A user must be authenticated before authorization checks are performed.

---

## Q21. What are some commonly used authorization methods?

### Answer

Laravel provides several authorization methods:

Check permission:

```php
$user->can('update', $post);
```

Check denied permission:

```php
$user->cannot('delete', $post);
```

Authorize inside a controller:

```php
$this->authorize('update', $post);
```

Gate authorization:

```php
Gate::allows('edit-post');
```

---

## Q22. What is the difference between Gates and Policies?

### Answer

| Gates | Policies |
|-------|----------|
| Simple authorization rules | Model-specific authorization classes |
| Best for small applications | Best for larger applications |
| Closure-based | Class-based |
| Suitable for individual actions | Organizes multiple permissions for a model |

---

## Q23. Give a real-world example of Authorization.

### Answer

Consider a blogging application.

```text
User
 │
 ▼
Edit Post Request
 │
 ▼
Post Policy
 │
 ┌──────────────┐
 │ User Owns Post? │
 └──────┬───────┘
        │
   Yes  │  No
        ▼
 Allow   Deny (403)
```

Only the owner of the post is allowed to edit it.

---

## Q24. Why is Authorization important in Laravel?

### Answer

Authorization is a critical security feature in Laravel.

It:

- Protects application resources
- Prevents unauthorized actions
- Works seamlessly with Authentication
- Supports Gates and Policies
- Keeps permission logic organized
- Helps build secure and maintainable applications