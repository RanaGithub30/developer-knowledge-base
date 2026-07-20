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

## Answer

This is an IDOR (Insecure Direct Object Reference) vulnerability. The issue is that the API directly trusts the user ID coming from the URL without verifying ownership.

I would fix it by implementing authorization checks. In Laravel, I would prefer Policies or Gates for resource-level authorization.

Instead of querying using the URL ID directly, I would verify that the authenticated user owns the requested resource.

I would also add proper authentication, validation, rate limiting, and logging for suspicious access attempts.

If the user is authenticated but not allowed to access the data, the API should return HTTP 403 Forbidden.