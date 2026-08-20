# MySQL Interview

## 🔥 Top 20 Questions You Should Know

### 1. What is MySQL?

MySQL is an **RDBMS** (Relational Database Management System) that uses SQL to store, manage, and retrieve data.

---

### 2. Primary Key vs Foreign Key?

**Primary Key**

* Uniquely identifies a row
* Cannot be `NULL`
* One primary key per table

**Foreign Key**

* References a key in another table
* Maintains referential integrity

---

### 3. WHERE vs HAVING?

* `WHERE` → filters **rows before grouping**
* `HAVING` → filters **groups after `GROUP BY`**

```sql
SELECT department, COUNT(*)
FROM employees
WHERE salary > 30000
GROUP BY department
HAVING COUNT(*) > 5;
```

---

### 4. INNER JOIN vs LEFT JOIN?

**INNER JOIN:** Only matching records.

**LEFT JOIN:** All records from the left table + matching records from the right table.

```sql
SELECT *
FROM employees e
LEFT JOIN departments d
ON e.department_id = d.id;
```

---

### 5. DELETE vs TRUNCATE vs DROP?

| Command    | Meaning                        |
| ---------- | ------------------------------ |
| `DELETE`   | Removes rows; supports `WHERE` |
| `TRUNCATE` | Removes all rows               |
| `DROP`     | Removes the table itself       |

---

### 6. What is an Index?

An index is a data structure that helps MySQL **find rows faster**.

```sql
CREATE INDEX idx_email ON users(email);
```

**Downside:** indexes consume storage and can slow `INSERT`/`UPDATE`/`DELETE`.

---

### 7. What is a transaction?

A transaction is a group of operations treated as **one unit of work**.

```sql
START TRANSACTION;

UPDATE accounts SET balance = balance - 100 WHERE id = 1;
UPDATE accounts SET balance = balance + 100 WHERE id = 2;

COMMIT;
```

---

### 8. What is ACID?

* **A — Atomicity:** All or nothing
* **C — Consistency:** Data remains valid
* **I — Isolation:** Transactions don't improperly interfere
* **D — Durability:** Committed data survives failures

---

### 9. What is NULL?

`NULL` means **missing/unknown value**.

Wrong:

```sql
WHERE phone = NULL
```

Correct:

```sql
WHERE phone IS NULL
```

---

### 10. What is GROUP BY?

Groups rows so aggregate functions can be applied.

```sql
SELECT department, AVG(salary)
FROM employees
GROUP BY department;
```

Common aggregate functions:

`COUNT()`, `SUM()`, `AVG()`, `MIN()`, `MAX()`

---

### 11. COUNT(*) vs COUNT(column)?

```sql
COUNT(*)
```

Counts rows.

```sql
COUNT(column)
```

Counts only **non-NULL** values in that column.

---

### 12. UNION vs UNION ALL?

* `UNION` → removes duplicates
* `UNION ALL` → keeps duplicates and is generally faster when duplicate removal isn't needed

---

### 13. What is a subquery?

A query inside another query.

Example: employees earning above average:

```sql
SELECT *
FROM employees
WHERE salary > (
    SELECT AVG(salary)
    FROM employees
);
```

---

### 14. What is normalization?

Organizing tables to **reduce duplicate data and data anomalies**.

Common levels:

`1NF → 2NF → 3NF`

---

### 15. What is a deadlock?

A deadlock happens when transactions wait for each other's locks.

```text
Transaction A → locks Row 1 → waits for Row 2
Transaction B → locks Row 2 → waits for Row 1
```

InnoDB detects deadlocks and rolls back one transaction.

---

### 16. What is a VIEW?

A view is a **virtual table based on a query**.

```sql
CREATE VIEW active_users AS
SELECT id, name
FROM users
WHERE status = 'active';
```

---

### 17. What is EXPLAIN?

`EXPLAIN` shows how MySQL plans to execute a query.

```sql
EXPLAIN
SELECT *
FROM users
WHERE email = 'a@b.com';
```

Use it when investigating **slow queries and index usage**.

---

### 18. How do you find duplicate records?

```sql
SELECT email, COUNT(*)
FROM users
GROUP BY email
HAVING COUNT(*) > 1;
```

**Remember:** `GROUP BY + HAVING COUNT(*) > 1`

---

### 19. How do you find the second-highest salary?

```sql
SELECT MAX(salary)
FROM employees
WHERE salary < (
    SELECT MAX(salary)
    FROM employees
);
```

---

### 20. RANK vs DENSE_RANK vs ROW_NUMBER?

For salaries:

```text
100, 100, 90
```

Results:

```text
ROW_NUMBER() → 1, 2, 3
RANK()       → 1, 1, 3
DENSE_RANK() → 1, 1, 2
```

**Easy memory trick:**

* `ROW_NUMBER` → no ties
* `RANK` → gaps
* `DENSE_RANK` → no gaps

---

# ⚡ 5-Minute Revision

Memorize these pairs:

```text
WHERE       → rows
HAVING      → groups

INNER JOIN  → matching only
LEFT JOIN   → everything from left

DELETE      → rows
TRUNCATE    → all rows
DROP        → table

UNION       → removes duplicates
UNION ALL   → keeps duplicates

COUNT(*)    → all rows
COUNT(col)  → non-NULL

RANK        → gaps
DENSE_RANK  → no gaps
```

### Most likely SQL coding questions

If the interviewer gives you a coding problem, be ready for:

1. **Second/Nth highest salary**
2. **Find duplicate records**
3. **Employees with salary > average**
4. **Customers with no orders**
5. **Highest salary per department**

### ⭐ Absolute must-know

If you have **only 2 minutes**, revise:

**JOIN → WHERE/HAVING → GROUP BY → INDEX → PRIMARY/FOREIGN KEY → DELETE/TRUNCATE/DROP → ACID → TRANSACTION → NULL → EXPLAIN → duplicate query → second-highest salary.**