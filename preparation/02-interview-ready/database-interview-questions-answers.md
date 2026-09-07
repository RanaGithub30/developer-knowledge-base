# Database Interview — Must-Know Questions & Answers

## Table of Contents

1. [What is a Database Index and why do we use it?](#1-what-is-a-database-index-and-why-do-we-use-it)
2. [What is a Composite Index?](#2-what-is-a-composite-index)
3. [How do you identify a slow SQL query?](#3-how-do-you-identify-a-slow-sql-query)
4. [What happens if you create indexes on all columns of a table?](#4-what-happens-if-you-create-indexes-on-all-columns-of-a-table)
5. [What is EXPLAIN in SQL, and which fields do you look at?](#5-what-is-explain-in-sql-and-which-fields-do-you-look-at)
6. [How would you optimize a query returning millions of rows?](#6-how-would-you-optimize-a-query-returning-millions-of-rows)
7. [What is the difference between INNER JOIN, LEFT JOIN, RIGHT JOIN, and FULL JOIN?](#7-what-is-the-difference-between-inner-join-left-join-right-join-and-full-join)
8. [What is the difference between WHERE and HAVING?](#8-what-is-the-difference-between-where-and-having)
9. [How does GROUP BY work in SQL?](#9-how-does-group-by-work-in-sql)
10. [Subquery vs JOIN — When would you choose which?](#10-subquery-vs-join--when-would-you-choose-which)
11. [What is the difference between EXISTS and IN in SQL?](#11-what-is-the-difference-between-exists-and-in-in-sql)
12. [What is Normalization?](#12-what-is-normalization)
13. [When would you consider Denormalization?](#13-when-would-you-consider-denormalization)
14. [What is a Database Transaction?](#14-what-is-a-database-transaction)
15. [Explain ACID Properties](#15-explain-acid-properties)
16. [What is a Database Deadlock?](#16-what-is-a-database-deadlock)
17. [How would you handle a Deadlock in Laravel/MySQL?](#17-how-would-you-handle-a-deadlock-in-laravelmysql)
18. [Why can Offset Pagination become slow for large datasets?](#18-why-can-offset-pagination-become-slow-for-large-datasets)

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

## 11. What is the difference between EXISTS and IN in SQL? When would you use one over the other?

**Answer**

IN and EXISTS are both used to filter records based on values from another query, but they work differently.

IN compares a value against a list of values returned by a subquery. For example:

```
SELECT *
FROM employees
WHERE department_id IN (
    SELECT department_id
    FROM departments
    WHERE location = 'NY'
);
```

Here, SQL gets the list of department IDs and checks whether each employee's department ID is present in that list.

EXISTS, on the other hand, checks whether the subquery returns at least one matching row. It's commonly used with a correlated subquery:

```
SELECT *
FROM employees e
WHERE EXISTS (
    SELECT 1
    FROM departments d
    WHERE d.department_id = e.department_id
      AND d.location = 'NY'
);
```

The key difference is that IN is value-based, while EXISTS is existence-based.

## 12. What is normalization?

**Answer**

Normalization is a process of organizing data in a database to reduce duplicate data and maintain data consistency.

Basically, instead of storing all the information in one large table, we divide it into smaller related tables and connect them using primary keys and foreign keys.

For example, suppose we have an Employee table where the department name is repeated for every employee:

Employee
--------------------------------
ID | Name  | Department
--------------------------------
1  | John  | IT
2  | Sarah | IT
3  | David | HR

Here, IT is stored multiple times. So, we can create a separate Department table and store only the DepartmentID in the Employee table.

The main goal of normalization is to reduce redundancy and avoid data anomalies, such as problems while inserting, updating, or deleting data.

There are different normal forms like 1NF, 2NF, and 3NF. In most cases, 3NF is commonly used for transactional database design.

In simple words, normalization means storing each piece of information in the right place and avoiding unnecessary duplication.

## 13. When would you consider denormalization?

**Answer**

Denormalization is mainly used when we want to improve read performance, even though it may introduce some data duplication.

For example, in a highly normalized database, getting customer order details might require joining several tables. If that query is executed very frequently, those joins can become expensive.

In that situation, we might denormalize the data by storing some frequently required information together, so that we can retrieve it faster with fewer joins.

So, I wouldn't denormalize by default. I would first use proper normalization, indexing, and query optimization. If performance is still an issue, then I would consider denormalization based on the actual workload.

## 14. What is a database transaction?

**Answer**

A transaction is a group of one or more database operations that are treated as a single unit of work.

For example, imagine transferring ₹1,000 from Account A to Account B. We need to do two operations:

* Deduct ₹1,000 from Account A.
* Add ₹1,000 to Account B.

Both operations should succeed together. If one operation fails, the other should also be rolled back. We don't want money to be deducted from A but not added to B.

In simple words, a transaction ensures that a group of related database operations is completed safely and reliably as one unit.

## 15. Explain ACID properties.

**Answer**

ACID stands for Atomicity, Consistency, Isolation, and Durability. These properties ensure that database transactions are reliable and safe.

I usually explain them with a bank money transfer example.

* Atomicity: A transaction should be completed fully or not at all. For example, if ₹1,000 is deducted from Account A but adding it to Account B fails, the deduction should be rolled back.
* Consistency: A transaction should take the database from one valid state to another valid state. All database rules and constraints should remain satisfied.
* Isolation: Multiple transactions running at the same time should not interfere with each other in a way that produces incorrect results. Each transaction should behave as if it is running independently.
* Durability: Once a transaction is committed, the changes should be permanently saved, even if there is a system crash or power failure.

So, in simple terms:

* Atomicity = All or nothing
* Consistency = Valid state
* Isolation = Transactions don't incorrectly interfere
* Durability = Committed data stays saved

## 16. What is a database deadlock?

**Answer**

A deadlock occurs when two or more database transactions are waiting for each other to release locks, so none of them can proceed.

For example, suppose Transaction A locks Row 1 and then tries to access Row 2. At the same time, Transaction B has already locked Row 2 and tries to access Row 1.

Now Transaction A is waiting for B to release Row 2, while Transaction B is waiting for A to release Row 1. So both transactions are stuck. This situation is called a deadlock.

Most databases have a deadlock detection mechanism. When a deadlock is detected, the database usually rolls back one of the transactions, releases its locks, and allows the other transaction to continue.

To reduce deadlocks, we can keep transactions short, access tables or rows in a consistent order, use proper indexes, and avoid holding locks unnecessarily.

## 17. How would you handle a deadlock in Laravel/MySQL?

**Answer**

In Laravel with MySQL, I would handle deadlocks mainly by using database transactions with retry logic.

Laravel's DB::transaction() supports a retry count. If a deadlock occurs, Laravel can automatically retry the transaction.

For example:

```
DB::transaction(function () {
    // database operations
}, 5);
```

Here, Laravel can retry the transaction up to 5 times if it encounters a concurrency error such as a deadlock.

But I wouldn't rely only on retries. I would also try to prevent deadlocks by making sure that transactions are short, accessing tables or rows in a consistent order, and using proper indexes so that MySQL doesn't lock unnecessary rows.

So, my approach would be: detect and log the deadlock, retry the transaction, and then investigate and fix the underlying locking or query-order issue.

## 18. Why can offset pagination become slow for large datasets?

**Answer**

Offset pagination can become slow when the dataset becomes very large because the database still has to scan and skip the rows before reaching the requested page.

For example:

```
SELECT *
FROM users
ORDER BY id
LIMIT 20 OFFSET 1000000;
```

Here, the database needs to find and skip 1 million rows before returning the next 20 rows. As the offset increases, the query can take more time and require more database work.

This becomes especially noticeable when we have millions of records and users request pages near the end.

A better approach for large datasets is cursor-based pagination, also called keyset pagination. Instead of saying "skip the first 1 million rows," we say "give me the next 20 rows after this ID."

For example:

```
SELECT *
FROM users
WHERE id > 1000000
ORDER BY id
LIMIT 20;
```

With a proper index on id, the database can efficiently find the next records without scanning all the previous rows.

So, I would use offset pagination for normal pagination where users don't go very deep, and cursor pagination for large datasets, infinite scrolling, or high-performance APIs.