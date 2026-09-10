# SQL Coding — Must-Know Interview Q&A

# Table of Contents

* [1. Find the Second-Highest Salary](#1-find-the-second-highest-salary)
* [2. Find the Nth Highest Salary](#2-find-the-nth-highest-salary)
* [3. Find Duplicate Email Addresses](#3-find-duplicate-email-addresses)
* [4. Find Employees Whose Salary Is Greater Than the Average Salary](#4-find-employees-whose-salary-is-greater-than-the-average-salary)
* [5. Find Employees Whose Salary Is Greater Than Their Department's Average Salary](#5-find-employees-whose-salary-is-greater-than-their-departments-average-salary)
* [6. Find Employees Who Earn More Than Their Department's Average Salary and Display the Average](#6-find-employees-who-earn-more-than-their-departments-average-salary-and-display-the-average)
* [7. Find the Highest Salary in Each Department](#7-find-the-highest-salary-in-each-department)
* [8. Find the Employee Who Earns the Highest Salary in Each Department](#8-find-the-employee-who-earns-the-highest-salary-in-each-department)
* [9. Find Departments Having More Than N Employees](#9-find-departments-having-more-than-n-employees)
* [10. Find Customers Who Have Never Placed an Order](#10-find-customers-who-have-never-placed-an-order)
* [11. Find the Latest Order of Every Customer](#11-find-the-latest-order-of-every-customer)
* [12. Find Top 3 Products by Sales](#12-find-top-3-products-by-sales)
* [13. Delete Duplicate Records While Keeping One](#13-delete-duplicate-records-while-keeping-one)
* [14. Find Duplicate Records Without Deleting Them](#14-find-duplicate-records-without-deleting-them)
* [15. Write a Pagination Query](#15-write-a-pagination-query)
* [16. Find Customers With More Than 3 Orders](#16-find-customers-with-more-than-3-orders)
* [17. Find Employees With the Same Salary](#17-find-employees-with-the-same-salary)
* [18. Find Employees Who Don't Belong to Any Department](#18-find-employees-who-dont-belong-to-any-department)
* [19. Find Employees Whose Salary Is Greater Than Their Manager's Salary](#19-find-employees-whose-salary-is-greater-than-their-managers-salary)
* [20. Find Total Revenue by Month](#20-find-total-revenue-by-month)
* [21. Find Orders for a Specific Month](#21-find-orders-for-a-specific-month)
* [22. Find Total Sales of August 2026](#22-find-total-sales-of-august-2026)
* [23. Find How Many Orders Were Placed in August 2026](#23-find-how-many-orders-were-placed-in-august-2026)
* [24. Find Customers Who Placed Orders in August 2026](#24-find-customers-who-placed-orders-in-august-2026)
* [25. Find Orders Placed in Every Month of a Particular Year](#25-find-orders-placed-in-every-month-of-a-particular-year)

---

## 1. Find the second-highest salary.

**ANswer**

Process - 1:

```
SELECT MAX(salary) 
FROM employees 
WHERE salary < (
    SELECT MAX(salary) 
    FROM employees
) 
```

Process - 2:

```
SELECT DISTINCT salary 
FROM employees 
ORDER BY salary DESC 
LIMIT 1 OFFSET 1;
```

## 2. Find the nth highest salary.

**Answer**

```
SELECT DISTINCT salary 
FROM employees 
ORDER BY salary DESC
LIMIT 1 OFFSET (N - 1);
```

# For Example: 4th Highest Salary

```
SELECT DISTINCT salary 
FROM employees 
ORDER BY salary DESC
LIMIT 1 OFFSET 3
```

## 3. Find Duplicate Email Addresses

Given the following `employees` table:

```text
employees
---------
id
name
email
department_id
salary
```

**Question:**
Write a SQL query to find the email addresses that appear more than once in the `employees` table.

**Answer**

```
SELECT email, COUNT(*) AS duplicate_email 
FROM employees GROUP BY email Having count(*)>1 
```

# Find the complete duplicate records

```
SELECT * FROM 
employees WHERE email IN (
    SELECT email 
    FROM employees
    GROUP BY email
    Having COUNT(*) > 1
)
```

## 4. Write a SQL query to find all employees whose salary is greater than the average salary of all employees.

**Answer**

```
SELECT id,name,email,salary 
FROM employees 
WHERE salary > 
(
    SELECT AVG(salary) 
    from employees
);
```

## 5. Find employees whose salary is greater than the average salary of their own department.

**Answer**

```
SELECT e.id, e.name, e.email, e.salary, e.department_id 
FROM employees e 
WHERE e.salary > 
(
    SELECT Avg(e1.salary) 
    FROM employees e1
    WHERE e1.department_id = e.department_id
);
```

## 6. Find employees who earn more than their department's average salary, and also display the department's average salary.

**Answer**

```
SELECT id, name, email, salary, avg_dept_salary 
FROM (
    SELECT id, name, email, salary, 
    AVG(salary) OVER (
        PARTITION BY department_id 
    ) as avg_dept_salary
    FROM employees
) e
WHERE salary > avg_dept_salary;
```

## 7. Write a SQL query to find the highest salary in each department.

**Answer**

```
SELECT department_id, 
MAX(salary) as highest_salary
FROM employees
GROUP BY department_id
```

## 8. Write a SQL query to find the employee who earns the highest salary in each department.

**Answer**

```
SELECT e.id, e.name, e.department_id, e.salary
FROM employees e
JOIN (
    SELECT department_id,
    MAX(salary) as highest_salary
    FROM employees
    GROUP BY department_id
) m
ON e.department_id = m.department_id
AND e.salary = m.highest_salary
```

## 9. Write a SQL query to find departments having more than N employees.

**Answer**

```
SELECT department_id,
    count(*) As emp_count
FROM employees
GROUP BY department_id
HAVING count(*) > :N
```

## 10. Find Customers Who Have Never Placed an Order

Given the following tables:

### `customers`

```sql
customers (
    customer_id INT,
    customer_name VARCHAR(100),
    email VARCHAR(100)
)
```

### `orders`

```sql
orders (
    order_id INT,
    customer_id INT,
    order_date DATE,
    amount DECIMAL(10,2)
)
```

**Question:**
Write a SQL query to find all customers who have never placed an order.

Return the following columns:

* `customer_id`
* `customer_name`
* `email`

**Answer**

```
SELECT 
    c.customer_id, 
    c.customer_name, 
    c.email
FROM customers c
LEFT JOIN orders o
    ON c.customer_id = o.customer_id
WHERE o.customer_id IS NULL;
```

## 11. Find the Latest Order of Every Customer

Given the following tables:

### `customers`

```text
customers
---------
customer_id
customer_name
email
```

### `orders`

```text
orders
------
order_id
customer_id
order_date
amount
```

**Question:**
Write a SQL query to find the **latest order of every customer**.

Return the following columns:

* `customer_id`
* `order_id`
* `order_date`
* `amount`

**Answer**

```
SELECT customer_id, 
    MAX(order_date) as latest_order_date
FROM orders
GROUP BY customer_id;
```

## 12. Top 3 Products by Sales

You are given a table called `sales` with the following columns:

| Column         | Description              |
| -------------- | ------------------------ |
| `product_id`   | Unique ID of the product |
| `product_name` | Name of the product      |
| `quantity`     | Number of units sold     |
| `sales_amount` | Total amount of the sale |

**Question:**

> Write a SQL query to find the **top 3 products by total sales amount**.
>
> Your result should contain:
>
> * Product Id
> * Product name
> * Total sales amount
>
> The products should be sorted from **highest to lowest total sales**.

**Answer**

```
SELECT
    product_id,
    product_name,
    SUM(sales_amount) as total_sales
FROM sales
GROUP BY product_id
ORDER BY total_sales DESC
LIMIT 3 OFFSET 0
```

## 13. Delete Duplicate Records While Keeping One

You are given a table called `employees`:

| Column        | Description             |
| ------------- | ----------------------- |
| `employee_id` | Unique ID of the record |
| `name`        | Employee name           |
| `email`       | Employee email          |
| `department`  | Employee department     |

Due to a data-loading issue, the table contains duplicate employee records.

For example:

| employee_id | name  | email                                     | department |
| ----------: | ----- | ----------------------------------------- | ---------- |
|         101 | John  | [john@gmail.com](mailto:john@gmail.com)   | IT         |
|         102 | John  | [john@gmail.com](mailto:john@gmail.com)   | IT         |
|         103 | Sarah | [sarah@gmail.com](mailto:sarah@gmail.com) | HR         |
|         104 | John  | [john@gmail.com](mailto:john@gmail.com)   | IT         |
|         105 | Mike  | [mike@gmail.com](mailto:mike@gmail.com)   | Finance    |

### Question

> Write a SQL query to **delete duplicate records while keeping one record for each employee**.

Assume that records are considered duplicates when `name`, `email`, and `department` are identical.

---

**Answer**

```
DELETE
FROM employees
WHERE employee_id NOT IN (
    SELECT MIN(employee_id) 
    FROM employees
    GROUP BY name, email, department 
)
```

## 14. How do you find duplicate records without deleting them?

**Answer**

```
SELECT 
    name,
    email,
    department,
    count(*) AS duplicate_count
FROM employees
GROUP BY name, email, department
Having count(*)>1
```

## 15. Write a Pagination Query

You have an `employees` table:

| employee_id | name  | department |
| ----------: | ----- | ---------- |
|           1 | John  | IT         |
|           2 | Sarah | HR         |
|           3 | Mike  | Finance    |
|           4 | David | IT         |
|           5 | Lisa  | HR         |

### Question

> Write a SQL query to fetch **10 records per page**.
>
> For example, if the user requests **page 2**, return records **11–20**.

---

**Answer**

Approch 1:

For large offsets, the database may need to scan/skip many rows before returning the requested records.
That's why OFFSET pagination for millions of records is not recommended to use.

```
SELECT *
FROM employees
ORDER BY employee_id
LIMIT 10 OFFSET 10
```

Approch 2: 

Use keyset (cursor) pagination.

For example, if the last employee_id from the previous page was 100

```
SELECT *
FROM employees
WHERE employee_id > 100
ORDER BY employee_id
LIMIT 10
```
## 16. Find customers with more than 3 orders

**Answer**

```
SELECT 
    customer_id,
    count(*) as order_count
FROM orders
GROUP BY customer_id
Having count(*) > 3
```

## 17. Find employees with the same salary

**Answer**

```
SELECT 
    salary,
    count(*) as emp_count
FROM employees
GROUP BY salary
Having COUNT(*) > 1;
```

## 18. Find employees who don't belong to any department

**Answer**

```
SELECT
    e.*
FROM employees e
LEFT JOIN departments d
    ON e.department_id = d.department_id
WHERE d.department_id IS NULL;
```

## 19. Find employees whose salary is greater than their manager's salary

Assume:

employees
---------
id
name
salary
manager_id

---

**Answer**

# Self JOIN

```
SELECT 
    e.name AS employee_name,
    e.salary AS employee_salary,
    m.name AS manager_name,
    m.salary AS manager_salary
FROM employees e
    JOIN employees m
ON e.manager_id = m.id
WHERE e.salary > m.salary
```

## 20. Find total revenue by month

**Answer**

```
SELECT
    YEAR(order_date) as year,
    MONTH(order_date) as month,
    SUM(amount) as total_revenue
FROM ORDERS
GROUP BY 
    YEAR(order_date),
    MONTH(order_date),
ORDER BY year, month;
```

## 21. Find Orders for a Specific Month

You have an `orders` table:

| Column        | Description                    |
| ------------- | ------------------------------ |
| `order_id`    | Unique order ID                |
| `customer_id` | Customer ID                    |
| `order_date`  | Date when the order was placed |
| `amount`      | Order amount                   |

### Question

> Write a SQL query to find all orders placed by customers in **August 2026**.

---

**Answer**

```
SELECT
    order_id, 
    customer_id, 
    order_date, 
    amount
FROM orders
WHERE 
    MONTH(order_date) = 8
AND YEAR(order_date) = 2026
```

## 22. Find Total Sales of August 2026?

**Answer**

```
SELECT
    SUM(amount) as total_sales
FROM orders
WHERE 
    MONTH(order_date) = 8
AND YEAR(order_date) = 2026
```

## 23. How many orders were placed in August 2026?

**Answer**

```
SELECT 
    COUNT(*) as total_orders
FROM orders
WHERE 
    MONTH(order_date) = 8
AND YEAR(order_date) = 2026
```

## 24. Find customers who placed orders in August 2026

**Answer**

```
SELECT DISTINCT
    customer_id
FROM orders
WHERE 
    MONTH(order_date) = 8
AND YEAR(order_date) = 2026
```

## 25. Find orders placed in every month of a particular year

**Answer**

```
SELECT
    MONTH(order_date) AS month,
    COUNT(*) AS total_orders
FROM orders
WHERE YEAR(order_date) = 2026
GROUP BY MONTH(order_date)
ORDER BY MONTH(order_date);
```