# Database Interview — Must-Know Questions & Answers

## 1. What is a Database Index and why do we use it?

**Answer:**

A database index is a data structure that helps the database find records faster without scanning the entire table.

For example, if we have a users table with millions of records and frequently search by email, creating an index on the email column allows the database to locate the required user much faster.

We mainly use indexes to improve query performance, especially for columns frequently used in:

* `WHERE`
* `JOIN`
* `ORDER BY`
* `GROUP BY`

However, indexes have some trade-offs. They consume additional storage and can make INSERT, UPDATE, and DELETE operations slightly slower because the index also needs to be updated.

Example:

```sql
CREATE INDEX idx_users_email ON users(email);
```
---

## 2. What is a composite index?

**Answer:**

A composite index is an index created on multiple columns of a table.

Example:

```
CREATE INDEX idx_user_city_age
ON users(city, age);
```

Here, city and age together form a composite index.

The order of columns is important because the database generally uses the index efficiently from left to right, based on the leftmost prefix.

For example, with:

(city, age)

The index can efficiently support queries like:

WHERE city = 'Kolkata'

and:

WHERE city = 'Kolkata' AND age = 25

But it may not be as effective for:

WHERE age = 25

because age is the second column and the query doesn't use the first column, city.

---

## 3. How do you identify a slow SQL query?

**Answer:**

I identify slow queries by checking execution time and slow-query logs, then use EXPLAIN or EXPLAIN ANALYZE to understand the execution plan. I look for full table scans, missing indexes, inefficient joins, and excessive rows being processed, and then optimize the query accordingly.

I usually use tools like EXPLAIN or EXPLAIN ANALYZE to see how the database is executing the query. I look for things like:

* Full table scans
* Missing or inefficient indexes
* Large numbers of rows being scanned
* Expensive joins or sorting
* High CPU, memory, or I/O usage

For example:

EXPLAIN ANALYZE
SELECT *
FROM users
WHERE email = 'test@example.com';

I would also check the database's slow query logs or monitoring tools to identify queries that consistently take a long time.

## 4. What Happens If You Create Indexes on All Columns of a Table?

**Answer**

Creating indexes on all columns of a table is generally not recommended. Although indexes can make read operations faster, they also introduce additional overhead.

When an index exists on a column, the database has to maintain that index whenever data is inserted, updated, or deleted. So, if every column is indexed, write operations can become significantly slower because multiple indexes need to be updated.

Typically, we prioritize columns frequently used in WHERE clauses, JOIN conditions, ORDER BY, and GROUP BY, while avoiding unnecessary or redundant indexes.

So, indexing every column can improve some reads, but overall it can increase storage usage and slow down INSERT, UPDATE, and DELETE operations without providing proportional performance benefits.

## 5. What is EXPLAIN in SQL, and Which Fields Do You Look At?

**Answer**

EXPLAIN is a SQL command used to understand how the database plans to execute a query. It helps us analyze query performance and identify issues such as full table scans, inefficient joins, or missing indexes.

So, in practice, I use EXPLAIN to check how the query accesses data, which indexes are being used, how many rows are being examined, and whether the execution plan contains expensive operations.

The goal is not simply to make every query use an index, but to make sure the overall execution plan is efficient for the workload.

## 6. How would you optimize a query returning millions of rows?

**Answer**

First, I would check whether all the rows are actually required. Then I would use EXPLAIN or EXPLAIN ANALYZE to identify issues like full table scans, inefficient joins, or sorting.

I would:

* Add appropriate indexes on WHERE, JOIN, and ORDER BY columns.
* Avoid SELECT * and fetch only required columns.
* Use pagination or batch processing instead of returning millions of rows at once.
* Optimize joins and apply filters as early as possible.

Finally, I would compare the execution plan and query time before and after optimization.

## 7. What is the Difference Between INNER JOIN, LEFT JOIN, RIGHT JOIN, and FULL JOIN?

**Answer**

SQL **JOINs** are used to combine data from multiple tables based on a related column.

For example, suppose we have:

**`customers`**

| id | name  |
| -- | ----- |
| 1  | Rahul |
| 2  | Priya |
| 3  | Amit  |

**`orders`**

| id  | customer_id | amount |
| --- | ----------- | -----: |
| 101 | 1           |    500 |
| 102 | 2           |    800 |
| 103 | 4           |    300 |

Here, customer `3` has no order, and order `103` belongs to customer `4`, who doesn't exist in `customers`.

### 1. INNER JOIN

Returns **only matching records from both tables**.

```sql
SELECT c.name, o.amount
FROM customers c
INNER JOIN orders o ON c.id = o.customer_id;
```

**Result:** Rahul–500 and Priya–800.

**Real-time use:** Show customers who have actually placed an order.

### 2. LEFT JOIN

Returns **all records from the left table**, plus matching records from the right table. If there is no match, we get `NULL`.

```sql
SELECT c.name, o.amount
FROM customers c
LEFT JOIN orders o ON c.id = o.customer_id;
```

**Result:** Rahul–500, Priya–800, Amit–NULL.

**Real-time use:** Find all customers, including customers who haven't placed any order.

### 3. RIGHT JOIN

Returns **all records from the right table**, plus matching records from the left table.

**Real-time use:** Less commonly used because the same result can usually be written using a `LEFT JOIN` by changing the table order.

### 4. FULL OUTER JOIN

Returns **all records from both tables**. Matching rows are combined, and non-matching rows contain `NULL`.

**Real-time use:** Comparing two datasets, such as finding customers/orders that exist in one system but not the other.

### Easy way to remember

* **INNER JOIN** → Only matching records
* **LEFT JOIN** → Everything from left + matches from right
* **RIGHT JOIN** → Everything from right + matches from left
* **FULL JOIN** → Everything from both tables

**In real projects, `INNER JOIN` and `LEFT JOIN` are the most commonly used.**

## 8. What is the Difference Between WHERE and HAVING?

**Answer**

Both WHERE and HAVING are used to filter data, but the main difference is when they filter the data.

* WHERE filters individual rows before GROUP BY and aggregation.
* HAVING filters groups after GROUP BY and is mainly used with aggregate functions like COUNT(), SUM(), and AVG().

For example, if I want customers whose orders are above ₹1,000:

```
SELECT customer_id, SUM(amount) AS total
FROM orders
WHERE status = 'completed'
GROUP BY customer_id
HAVING SUM(amount) > 1000;
```

Here, WHERE first filters only completed orders. Then GROUP BY groups them by customer, and HAVING keeps only customers whose total order amount is greater than ₹1,000.

## 9. How Does GROUP BY Work in SQL?

**Amswer**

GROUP BY is used to group rows that have the same values in one or more columns. It is commonly used with aggregate functions like COUNT(), SUM(), AVG(), MAX(), and MIN().

For example, suppose we have an orders table:

customer_id | amount
------------|-------
101         | 500
101         | 300
102         | 700
102         | 200

If I want to find the total order amount for each customer, I can use:

```
SELECT customer_id, SUM(amount) AS total_amount
FROM orders
GROUP BY customer_id;
```

The database groups all rows with the same customer_id and then calculates SUM(amount) for each group.

The result would be:

101 → 800
102 → 900

In real-time applications, GROUP BY is useful for things like total sales by customer, number of orders by status, or average salary by department.

## 10. Subquery vs JOIN — When Would You Choose Which?

**Ans**

Both subqueries and JOINs can be used to retrieve related data, but I choose between them based on the use case, readability, and performance.

A JOIN is usually preferred when I need to combine data from multiple tables. It is often easier to read and can be more efficient, especially when the tables are properly indexed.

For example, to find customers and their orders:

```
SELECT c.name, o.amount
FROM customers c
JOIN orders o ON c.id = o.customer_id;
```

I would use a subquery when I need the result of one query as a condition or input for another query. For example, finding customers who have placed an order:

```
SELECT name
FROM customers
WHERE id IN (
    SELECT customer_id
    FROM orders
);
```

So, my general approach is:

* JOIN → when combining related data from multiple tables.
* Subquery → when I need to use the result of one query inside another.
For performance-sensitive queries, I would use EXPLAIN to compare the execution plans rather than assuming one is always faster.