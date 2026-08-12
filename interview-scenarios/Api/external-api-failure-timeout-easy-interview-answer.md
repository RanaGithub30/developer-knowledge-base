# How Do You Handle an External API Failure/Timeout?

## Answer

> "External APIs can sometimes fail or take too long to respond. I handle this by setting a timeout so my application doesn't wait forever. If the failure is temporary, I retry the request a few times with a small delay. If the API continues to fail, I use a circuit breaker to stop calling it temporarily. Where possible, I return cached data or a friendly error message. I also log the error and monitor the API so we can identify problems quickly."

## Simple Approach

### 1. Set a Timeout

Don't wait forever for the external API.

```text
My API → External API
              |
           Timeout
              |
              v
        Handle the error
```

### 2. Retry

If the failure is temporary, retry a few times.

```text
Request
   ↓
Failed
   ↓
Wait 1 second
   ↓
Retry
   ↓
Failed
   ↓
Wait 2 seconds
   ↓
Retry
```

Don't retry forever.

### 3. Circuit Breaker

If the external API keeps failing, stop calling it for some time.

```text
API failing
    ↓
Stop calling temporarily
    ↓
Wait
    ↓
Try again
```

This protects our application from wasting resources.

### 4. Fallback

If possible, provide an alternative.

For example:

```text
External API fails
       ↓
Check cached data
       ↓
Return cached data
```

If no fallback is available, return a simple message:

```text
"Service is temporarily unavailable. Please try again later."
```

### 5. Logging

I would log the failure so developers can investigate it.

For example:

```text
External API failed
Status: 503
Response Time: 5 seconds
Retry Count: 2
```

## Simple Example

```pseudo
try:
    call external API

    if successful:
        return response

    if temporary failure:
        retry 2-3 times

catch timeout:
    return fallback or friendly error
```

## Best Short Interview Answer

> **"I handle external API failures by setting a timeout, retrying temporary failures a few times, and using a circuit breaker if the service keeps failing. If possible, I use cached or fallback data; otherwise, I return a user-friendly error. I also log and monitor these failures."**

## Remember

**Timeout → Retry → Circuit Breaker → Fallback → Log**