# API Security Interview Question: IDOR Vulnerability

## Question

You are building a Laravel/Node.js REST API for a banking application.

The API has an endpoint:

```
GET /api/user/{id}/transactions
```

A developer has written:

```php
public function transactions($id)
{
    return Transaction::where('user_id', $id)->get();
}
```

A security review found that any logged-in user can change the ID in the URL and see another user's transactions.

**What security vulnerability is this? How would you fix it in a production application?**

---

# API Security Interview Answer: IDOR Vulnerability

## Detailed Answer

This is an IDOR (Insecure Direct Object Reference) vulnerability. It happens when an API uses a user-controlled value, such as an ID in the URL, to access a database record without verifying that the authenticated user is actually allowed to access that record.

In this case, the application trusts the ID from the request path and directly fetches transactions belonging to that user. If a logged-in attacker changes the ID to another user's ID, the server returns that user's data. That is a serious authorization problem because the API is exposing data based on input manipulation rather than proper access control.

## Why this is dangerous

- It allows unauthorized data access.
- It can expose sensitive financial information.
- It often affects APIs that use simple numeric IDs in the URL.
- It is common in systems where developers forget to enforce ownership checks.

## How to fix it

The fix should be based on authorization, not just input validation. The application should ensure that the requested resource belongs to the currently authenticated user.

A production-grade approach is:

1. Require authentication.
2. Get the authenticated user from the request.
3. Compare the requested user ID with the authenticated user's ID.
4. If they do not match, return 403 Forbidden.
5. Use a policy or gate for cleaner authorization logic.
6. Add logging and monitoring for suspicious access attempts.

## Improved Laravel example

### Vulnerable code

```php
public function transactions($id)
{
    return Transaction::where('user_id', $id)->get();
}
```

### Safer version

```php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

public function transactions(Request $request, $id)
{
    $authenticatedUser = $request->user();

    if (! $authenticatedUser) {
        abort(401, 'Unauthenticated');
    }

    if ((int) $id !== $authenticatedUser->id) {
        abort(403, 'You are not allowed to access these transactions.');
    }

    return Transaction::where('user_id', $authenticatedUser->id)
        ->latest()
        ->paginate(20);
}
```

## Better approach with a Policy

A cleaner and more maintainable solution is to use a Policy.

### Policy example

```php
namespace App\Policies;

use App\Models\User;
use App\Models\Transaction;

class TransactionPolicy
{
    public function view(User $authenticatedUser, Transaction $transaction): bool
    {
        return $transaction->user_id === $authenticatedUser->id;
    }
}
```

### Controller usage

```php
public function transactions(Request $request, Transaction $transaction)
{
    $this->authorize('view', $transaction);

    return response()->json($transaction->user->transactions()->latest()->get());
}
```

## Important production recommendations

- Use authentication middleware so only logged-in users can access protected routes.
- Prefer route model binding with scoped authorization.
- Return 403 Forbidden for unauthorized access instead of silently returning empty results.
- Use database-level constraints and proper indexing for performance.
- Add audit logging and rate limiting to detect abuse.
- For a banking application, consider using encryption and masking for sensitive financial data.

## Interview-style summary

In short, this is an IDOR vulnerability because the API allows a user to manipulate the resource ID and access another user's data. The proper fix is to enforce ownership checks using strong authorization logic, ideally through policies or gates, and to reject unauthorized access with a 403 response.