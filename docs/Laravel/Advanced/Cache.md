# Laravel Cache - Interview Questions & Answers

## Q1. What is Cache in Laravel?

### Answer

**Cache** is a mechanism used to temporarily store frequently accessed data in fast storage so it can be retrieved quickly instead of executing expensive operations repeatedly.

Laravel provides a simple and unified API for working with different cache drivers.

Using cache improves application performance and reduces database load.

---

## Q2. Why do we use Cache?

### Answer

Cache is used to:

- Improve application performance
- Reduce database queries
- Decrease server load
- Speed up response time
- Store frequently accessed data
- Enhance user experience

---

## Q3. How does Cache work?

### Answer

The caching workflow is:

```text
User Request
      │
      ▼
Check Cache
      │
 ┌────┴────┐
 │         │
 ▼         ▼
Hit      Miss
 │         │
 ▼         ▼
Return   Query Database
Cached       │
Data         ▼
         Store in Cache
               │
               ▼
        Return Response
```

If data exists in the cache (**cache hit**), Laravel returns it immediately. Otherwise (**cache miss**), Laravel retrieves the data from its source, stores it in the cache, and returns it.

---

## Q4. Which cache drivers does Laravel support?

### Answer

Laravel supports multiple cache drivers:

- File
- Database
- Redis
- Memcached
- DynamoDB
- Array (for testing)
- Null

The cache driver is configured in the `.env` file.

Example:

```env
CACHE_STORE=file
```

---

## Q5. Where is the cache configuration located?

### Answer

Cache configuration is stored in:

```text
config/cache.php
```

The default cache store is usually configured using:

```env
CACHE_STORE=file
```

---

## Q6. Which Facade is used for Cache?

### Answer

Laravel provides the `Cache` Facade.

Example:

```php
use Illuminate\Support\Facades\Cache;
```

It provides methods for storing, retrieving, updating, and deleting cached data.

---

## Q7. How do you store data in the cache?

### Answer

Use the `put()` method.

Example:

```php
Cache::put(
    'name',
    'John',
    now()->addMinutes(10)
);
```

The value is stored for 10 minutes.

---

## Q8. How do you retrieve data from the cache?

### Answer

Use the `get()` method.

Example:

```php
$name = Cache::get('name');
```

Provide a default value if the key does not exist:

```php
$name = Cache::get('name', 'Guest');
```

---

## Q9. How do you check if a cache key exists?

### Answer

Use the `has()` method.

Example:

```php
if (Cache::has('name')) {

    echo 'Cache exists';

}
```

It returns `true` if the key is present.

---

## Q10. How do you remove data from the cache?

### Answer

Use the `forget()` method.

Example:

```php
Cache::forget('name');
```

The specified cache entry is deleted.

---

## Q11. How do you clear the entire cache?

### Answer

Use the `flush()` method.

Example:

```php
Cache::flush();
```

This removes all cached data from the current cache store.

---

## Q12. What is the `remember()` method?

### Answer

The `remember()` method retrieves data from the cache or stores it if it does not already exist.

Example:

```php
$users = Cache::remember(
    'users',
    now()->addMinutes(30),
    function () {
        return User::all();
    }
);
```

If the `users` key exists, Laravel returns the cached data. Otherwise, it executes the closure, caches the result, and returns it.

---

## Q13. What is the `rememberForever()` method?

### Answer

The `rememberForever()` method stores data permanently until it is manually removed.

Example:

```php
$settings = Cache::rememberForever(
    'settings',
    function () {
        return Setting::all();
    }
);
```

The data remains in the cache until it is deleted.

---

## Q14. What is the difference between `put()` and `remember()`?

### Answer

| put() | remember() |
|--------|------------|
| Always stores data | Stores data only if it is missing |
| Requires data beforehand | Generates data using a closure |
| Does not check existing cache | Automatically checks cache first |

---

## Q15. What is Cache Tagging?

### Answer

Cache Tags allow related cache items to be grouped together so they can be cleared as a group.

Example:

```php
Cache::tags(['users'])->put(
    'user_1',
    $user,
    600
);
```

Clear all items with the tag:

```php
Cache::tags(['users'])->flush();
```

> **Note:** Cache tags are supported only by certain drivers such as Redis and Memcached.

---

## Q16. How do you increment and decrement cached values?

### Answer

Increment:

```php
Cache::increment('visits');
```

Increment by a specific amount:

```php
Cache::increment('visits', 5);
```

Decrement:

```php
Cache::decrement('visits');
```

These methods are useful for counters and statistics.

---

## Q17. What Artisan commands are commonly used for Cache?

### Answer

Clear application cache:

```bash
php artisan cache:clear
```

Clear configuration cache:

```bash
php artisan config:clear
```

Cache configuration:

```bash
php artisan config:cache
```

Clear route cache:

```bash
php artisan route:clear
```

Cache routes:

```bash
php artisan route:cache
```

Clear compiled views:

```bash
php artisan view:clear
```

Cache views:

```bash
php artisan view:cache
```

---

## Q18. What are some real-world uses of Cache?

### Answer

Cache is commonly used for:

- User profile data
- Product listings
- Website settings
- Dashboard statistics
- Frequently accessed API responses
- Navigation menus
- Configuration values
- Popular blog posts

---

## Q19. What are the advantages of using Cache?

### Answer

Cache provides several benefits:

- Faster response times
- Reduced database load
- Better application performance
- Lower server resource usage
- Improved scalability
- Better user experience

---

## Q20. What is the difference between Cache and Session?

### Answer

| Cache | Session |
|-------|---------|
| Stores application data | Stores user-specific data |
| Shared across users (depending on key design) | Unique for each user |
| Improves performance | Maintains user state |
| Can expire based on TTL or be cleared manually | Expires when the session ends or times out |

---

## Q21. Give a real-world example of Cache.

### Answer

Consider an online shopping application.

```text
User Requests Product List
           │
           ▼
Check Cache
     │
 ┌───┴────┐
 │        │
 ▼        ▼
Hit      Miss
 │        │
 ▼        ▼
Return   Query Database
Cached        │
Data          ▼
         Store in Cache
               │
               ▼
        Return Products
```

Frequently viewed products are served from the cache, reducing database queries and improving performance.

---

## Q22. Why is Cache important in Laravel?

### Answer

Cache is an essential performance optimization feature in Laravel.

It:

- Reduces expensive database and API calls
- Speeds up application responses
- Improves scalability
- Works with multiple cache drivers
- Integrates seamlessly with Laravel's configuration, routing, and application services
- Helps build fast and efficient web applications