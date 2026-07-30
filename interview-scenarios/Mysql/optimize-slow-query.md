# Optimizing a Slow Query

## Query

Suppose you have an orders table with 10 million rows, and this query has become very slow:

```sql
SELECT * FROM orders
WHERE user_id = ?
ORDER BY created_at DESC
LIMIT 20;
```

- How would you optimize this query?
- Please explain your approach step by step, including database indexing and any other improvements you would consider.

## Ans: 

## Optimization Steps

### 1. Analyze the Query
Use `EXPLAIN` or `EXPLAIN ANALYZE` to identify bottlenecks like full table scans or sorting.

```sql
EXPLAIN
SELECT *
FROM orders
WHERE user_id = ?
ORDER BY created_at DESC
LIMIT 20;
```

### 2. Create a Composite Index
Create an index that supports both filtering and sorting.

```sql
CREATE INDEX idx_orders_user_created
ON orders(user_id, created_at DESC);
```

This allows the database to quickly locate a user's orders and return the latest 20 without an extra sort.

### 3. Avoid `SELECT *`
Retrieve only the required columns to reduce I/O.

```sql
SELECT order_id, created_at, status
FROM orders
WHERE user_id = ?
ORDER BY created_at DESC
LIMIT 20;
```

### 4. Use Keyset Pagination
Avoid large `OFFSET` values. Instead:

```sql
SELECT *
FROM orders
WHERE user_id = ?
AND created_at < ?
ORDER BY created_at DESC
LIMIT 20;
```

### 5. Consider Additional Improvements
- Use a **covering index** if only a few columns are needed.
- Cache frequently accessed results (e.g., Redis).
- Keep database statistics updated (`ANALYZE`).
- Consider partitioning for very large tables.

## Summary

- Use `EXPLAIN` to analyze performance.
- Create a composite index on `(user_id, created_at DESC)`.
- Avoid `SELECT *`.
- Use keyset pagination instead of large `OFFSET`s.
- Cache results and maintain database statistics for better performance.