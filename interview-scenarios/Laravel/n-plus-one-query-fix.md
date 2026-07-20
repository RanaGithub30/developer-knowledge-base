# Laravel Interview Question: N+1 Query Problem

## Question

Your `/orders` API has this code:

```php
$orders = Order::where('status', 'completed')
    ->get();

foreach($orders as $order){
    echo $order->customer->name;
}
```

The API is slow and the database shows thousands of queries being executed.

**What is the problem here, and how would you fix it in Laravel?**

---

## Answer

### Problem

The issue is the **N+1 Query Problem**.

Here's what happens:

- The first query fetches all completed orders.
- Then, for each order, Laravel executes another query to fetch the related customer.
- If there are **1,000 orders**, Laravel executes:
  - **1 query** to fetch the orders.
  - **1,000 additional queries** to fetch each customer.

This results in **1,001 database queries**, causing significant performance issues.

### Solution

Use **Eager Loading** with `with()` to load the related customers in advance.

```php
$orders = Order::with('customer')
    ->where('status', 'completed')
    ->get();

foreach ($orders as $order) {
    echo $order->customer->name;
}
```

### Why This Works

With eager loading:

- Laravel executes **one query** to fetch all completed orders.
- It executes **one additional query** to fetch all related customers.
- Total database queries: **2**, regardless of the number of orders.

This eliminates the N+1 query problem and significantly improves API performance.

### Additional Optimizations

- Fetch only the required columns using `select()`.
- Add indexes on frequently filtered columns such as `status`.
- Use pagination if the endpoint returns a large number of orders.
- Cache frequently requested data using Redis if appropriate.

### Summary

The slowdown is caused by the **N+1 Query Problem**. Using Laravel's **eager loading (`with()`)** reduces thousands of database queries to just a few, greatly improving the performance of the `/orders` API.