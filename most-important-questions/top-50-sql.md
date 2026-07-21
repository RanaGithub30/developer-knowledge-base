## Top SQL Interview Questions & Answers

# Table of Contents

1. [INNER JOIN](#inner-join)
   - [Q1. What is an INNER JOIN?](#q1-what-is-an-inner-join)
   - [Q2. Difference between INNER JOIN and LEFT JOIN](#q2-what-is-the-difference-between-inner-join-and-left-join)
   - [Q3. Difference between ON and WHERE in INNER JOIN](#q3-what-is-the-difference-between-on-and-where-in-an-inner-join)
   - [Q4. What is a Self INNER JOIN?](#q4-what-is-a-self-inner-join)

2. [LEFT JOIN](#left-join)
   - [Q5. What is a LEFT JOIN?](#q5-what-is-a-left-join)
   - [Q6. Can LEFT JOIN produce duplicate rows?](#q6-can-left-join-produce-duplicate-rows)

3. [RIGHT JOIN](#right-join)
   - [Q9. What is a RIGHT JOIN?](#q9-what-is-a-right-join)

4. [GROUP BY](#group-by)
   - [Q10. What is the GROUP BY clause in SQL?](#q10-what-is-the-group-by-clause-in-sql)
   - [Q11. Which aggregate functions are commonly used with GROUP BY?](#q11-which-aggregate-functions-are-commonly-used-with-group-by)

5. [HAVING](#having)
   - [Q12. What is the HAVING clause in SQL?](#q12-what-is-the-having-clause-in-sql)
   - [Q13. Difference between WHERE and HAVING](#q13-what-is-the-difference-between-where-and-having)
   - [Q14. Find departments with average salary greater than 60,000](#q14-write-a-query-to-find-departments-where-the-average-salary-is-greater-than-60000)

6. [UNION & UNION ALL](#union--union-all)
   - [Q15. What is UNION in SQL?](#q15-what-is-union-in-sql)
   - [Q16. Difference between UNION and UNION ALL](#q16-what-is-the-difference-between-union-and-union-all)
   - [Q17. When to use UNION ALL instead of UNION?](#q17-when-should-you-use-union-all-instead-of-union)

7. [Index](#index)
   - [Q18. What is an Index in SQL?](#q18-what-is-an-index-in-sql)
   - [Q19. Advantages of an Index](#q19-what-are-the-advantages-of-an-index)
   - [Q20. Difference between Clustered and Non-Clustered Index](#q20-what-is-the-difference-between-a-clustered-index-and-a-non-clustered-index)
   - [Q21. SQL operations that benefit from Index](#q21-which-sql-operations-benefit-from-an-index)
   - [Q22. SQL operations slowed down by Index](#q22-which-sql-operations-are-slowed-down-by-an-index)
   - [Q23. When should you create an Index?](#q23-when-should-you-create-an-index)
   - [Q24. What is a Composite Index?](#q24-what-is-a-composite-index)
   - [Q25. Single-Column Index vs Composite Index](#q25-what-is-the-difference-between-a-single-column-index-and-a-composite-index)
   - [Q26. When should you use a Composite Index?](#q26-when-should-you-use-a-composite-index)
   - [Q27. What is a Clustered Index?](#q27-what-is-a-clustered-index)
   - [Q28. What is a Non-Clustered Index?](#q28-what-is-a-non-clustered-index)
   - [Q29. Difference between Clustered and Non-Clustered Index](#q29-what-is-the-difference-between-clustered-and-non-clustered-index)
   - [Q30. Which is faster: Clustered or Non-Clustered Index?](#q30-which-is-faster-clustered-or-non-clustered-index)

8. [SQL Query](#sql-query)
   - [Q31. What is a SQL Query?](#q31-what-is-a-sql-query)
   - [Q32. Find the second highest salary](#q32-find-the-second-highest-salary)
   - [Q33. Find duplicate records](#q33-find-duplicate-records)
   - [Q34. Find employees without a department](#q34-find-employees-without-a-department)
   - [Q35. Find total salary department-wise](#q35-find-the-total-salary-department-wise)

9. [Transactions](#transactions)
   - [Q36. What is a Transaction in SQL?](#q36-what-is-a-transaction-in-sql)
   - [Q37. ACID Properties of Transaction](#q37-what-are-the-acid-properties-of-a-transaction)
   - [Q38. What is COMMIT?](#q38-what-is-commit)
   - [Q39. What is ROLLBACK?](#q39-what-is-rollback)
   - [Q40. What is SAVEPOINT?](#q40-what-is-savepoint)
   - [Q41. Difference between COMMIT and ROLLBACK](#q41-what-is-the-difference-between-commit-and-rollback)
   - [Q42. What happens if a transaction fails?](#q42-what-happens-if-a-transaction-fails)
   - [Q43. DELETE vs TRUNCATE with Transactions](#q43-what-is-the-difference-between-delete-and-truncate-with-transactions)
   - [Q44. What is a Dirty Read?](#q44-what-is-a-dirty-read)

10. [Deadlock](#deadlock)
    - [Q45. What is a Deadlock?](#q45-what-is-a-deadlock)
    - [Q46. What is Auto Commit?](#q46-what-is-auto-commit)

11. [Primary Key, Foreign Key & Composite Key](#primary-key-foreign-key--composite-key)
    - [Q47. What is a Primary Key?](#q47-what-is-a-primary-key)
    - [Q48. What is a Foreign Key?](#q48-what-is-a-foreign-key)
    - [Q49. What is a Composite Key?](#q49-what-is-a-composite-key)
    - [Q50. Difference between Primary Key and Foreign Key](#q50-difference-between-primary-key-and-foreign-key)
    - [Q51. Difference between Primary Key and Composite Key](#q51-difference-between-primary-key-and-composite-key)
    
# Inner Join

## Q1. What is an INNER JOIN?

**Answer:**

An **INNER JOIN** returns only the rows that have matching values in both tables based on the specified join condition.

It compares the join column(s) from two tables and returns only the matching records. Rows without a match in either table are excluded.

**Syntax:**
```sql
SELECT columns
FROM table1
INNER JOIN table2
ON table1.column = table2.column;
```
---

## Q2. What is the difference between INNER JOIN and LEFT JOIN?

| INNER JOIN | LEFT JOIN |
|------------|-----------|
| Returns only matching rows | Returns all rows from the left table |
| Unmatched rows are excluded | Unmatched rows return NULL values |
| Used when matching data is required | Used when all left-table records are needed |

---

## Q3. What is the difference between `ON` and `WHERE` in an INNER JOIN?

**Answer:**

- `ON` defines the join condition.
- `WHERE` filters the result after the join.

```sql
SELECT e.EmployeeName, d.DepartmentName
FROM Employees e
INNER JOIN Departments d
ON e.DeptID = d.DeptID
WHERE d.DepartmentName = 'IT';
```
---

## Q4. What is a Self INNER JOIN?

**Answer:**
A self join joins a table with itself.

```sql
SELECT e.EmployeeName,
       m.EmployeeName AS Manager
FROM Employees e
INNER JOIN Employees m
ON e.ManagerID = m.EmployeeID;
```
---

# LEFT JOIN

## Q5. What is a LEFT JOIN?

**Answer:**

A **LEFT JOIN** (or **LEFT OUTER JOIN**) returns **all rows from the left table** and the matching rows from the right table. If there is no match, the columns from the right table contain **NULL** values.

**Syntax:**
```sql
SELECT columns
FROM table1
LEFT JOIN table2
ON table1.column = table2.column;
```
---

## Q6. Can LEFT JOIN produce duplicate rows?

**Answer:**

Yes. If one row in the left table matches multiple rows in the right table, multiple rows are returned.

---

# RIGHT JOIN

## Q9. What is a RIGHT JOIN?

**Answer:**
A **RIGHT JOIN** (or **RIGHT OUTER JOIN**) returns **all rows from the right table** and the matching rows from the left table. If there is no match, the columns from the left table contain **NULL** values.

**Syntax:**
```sql
SELECT columns
FROM table1
RIGHT JOIN table2
ON table1.column = table2.column;
```
---

# GROUP BY

## Q10. What is the GROUP BY clause in SQL?

**Answer:**
The **GROUP BY** clause is used to group rows that have the same values in one or more columns into a single group. It is commonly used with aggregate functions like `COUNT()`, `SUM()`, `AVG()`, `MIN()`, and `MAX()`.

**Syntax:**
```sql
SELECT column_name, aggregate_function(column_name)
FROM table_name
GROUP BY column_name;
```
---

## Q11. Which aggregate functions are commonly used with GROUP BY?

**Answer:**

- `COUNT()`
- `SUM()`
- `AVG()`
- `MIN()`
- `MAX()`

**Example:**

```sql
SELECT DeptID, COUNT(*) AS TotalEmployees
FROM Employees
GROUP BY DeptID;
```
---

# HAVING

## Q12. What is the HAVING clause in SQL?

**Answer:**
The **HAVING** clause is used to **filter grouped records** after the `GROUP BY` clause. It is mainly used with aggregate functions such as `COUNT()`, `SUM()`, `AVG()`, `MIN()`, and `MAX()`.

**Syntax:**
```sql
SELECT column_name, aggregate_function(column_name)
FROM table_name
GROUP BY column_name
HAVING condition;
```
# Why is HAVING used?

`HAVING` is used to filter **groups of rows** based on aggregate values.

**Example:**

```sql
SELECT DeptID, COUNT(*) AS TotalEmployees
FROM Employees
GROUP BY DeptID
HAVING COUNT(*) > 5;
```

This returns only departments having **more than 5 employees**.

---

## Q13. What is the difference between WHERE and HAVING?

| WHERE | HAVING |
|--------|---------|
| Filters rows before grouping | Filters groups after grouping |
| Cannot use aggregate functions | Can use aggregate functions |
| Executed before `GROUP BY` | Executed after `GROUP BY` |

---

## Q14. Write a query to find departments where the average salary is greater than 60,000.

**Answer:**

```sql
SELECT DeptID,
       AVG(Salary) AS AverageSalary
FROM Employees
GROUP BY DeptID
HAVING AVG(Salary) > 60000;
```

---

# Interview One-Liner

> **HAVING is used to filter grouped records after the GROUP BY clause, typically using aggregate functions like COUNT(), SUM(), AVG(), MIN(), and MAX().**

---

# UNION & UNION ALL

## Q15. What is UNION in SQL?

**Answer:**
The **UNION** operator is used to combine the results of two or more `SELECT` statements into a single result set. It automatically removes duplicate rows.

**Syntax:**
```sql
SELECT column1, column2
FROM table1

UNION

SELECT column1, column2
FROM table2;
```

---

## Q16. What is the difference between UNION and UNION ALL?

| UNION | UNION ALL |
|--------|-----------|
| Removes duplicate rows | Keeps duplicate rows |
| Slower due to duplicate removal | Faster because no duplicate check |
| Returns distinct records | Returns all records |

---

## Q17. When should you use UNION ALL instead of UNION?

**Answer:**
Use **UNION ALL** when:

- You want to keep duplicate records.
- Better performance is required.
- Duplicate removal is unnecessary.

---

# Index

## Q18. What is an Index in SQL?

**Answer:**
An **Index** is a database object that improves the speed of data retrieval operations on a table. It works like the index of a book, allowing the database to find rows quickly without scanning the entire table.

**Syntax:**
```sql
CREATE INDEX index_name
ON table_name(column_name);
```
---

## Q19. What are the advantages of an Index?

**Answer:**

- Faster data retrieval.
- Improves query performance.
- Speeds up JOIN operations.
- Speeds up sorting (`ORDER BY`).
- Improves filtering (`WHERE`).

---

## Q20. What is the difference between a Clustered Index and a Non-Clustered Index?

| Clustered Index | Non-Clustered Index |
|-----------------|---------------------|
| Sorts and stores the actual table data | Stores only the index and a pointer to the data |
| Only one clustered index per table | Multiple non-clustered indexes are allowed |
| Faster for range queries | Faster for searching specific values |

---

## Q21. Which SQL operations benefit from an Index?

**Answer:**

Indexes improve the performance of:

- `SELECT`
- `WHERE`
- `JOIN`
- `ORDER BY`
- `GROUP BY`

---

## Q22. Which SQL operations are slowed down by an Index?

**Answer:**

Indexes can slow down:

- `INSERT`
- `UPDATE`
- `DELETE`

because the index also needs to be updated whenever data changes.

---

## Q23. When should you create an Index?

**Answer:**

Create an index when:

- A column is frequently used in the `WHERE` clause.
- A column is frequently used in `JOIN` conditions.
- A column is frequently used in `ORDER BY` or `GROUP BY`.
- The table contains a large amount of data.

---

## Q24.  What is a Composite Index?

**Answer:**
A **Composite Index** is an index created on **two or more columns** of a table. It improves the performance of queries that filter or sort using those columns together.

**Syntax:**
```sql
CREATE INDEX index_name
ON table_name(column1, column2);
```

---

## Q25. What is the difference between a Single-Column Index and a Composite Index?

**Answer:**
| Single-Column Index | Composite Index |
|---------------------|-----------------|
| Index on one column | Index on two or more columns |
| Best for single-column searches | Best for multi-column searches |
| Simpler to maintain | More efficient for combined conditions |

---

## Q26. When should you use a Composite Index?

**Answer:**

Use a Composite Index when:

- Queries frequently filter on multiple columns.
- Multiple columns are used together in `JOIN` conditions.
- Queries often sort using the same column order.
- Combined column searches are common.

---

## Q27.  What is a Clustered Index?

**Answer:**
A **Clustered Index** determines the **physical order** of data in a table. The actual table data is stored in the same order as the clustered index.

**Example:**
```sql
CREATE CLUSTERED INDEX idx_empid
ON Employees(EmployeeID);
```

---

## Q28. What is a Non-Clustered Index?

**Answer:**
A **Non-Clustered Index** stores the indexed column values separately from the actual table data. It contains pointers (references) to the corresponding data rows.

**Example:**
```sql
CREATE NONCLUSTERED INDEX idx_name
ON Employees(EmployeeName);
```

---

## Q29. What is the difference between Clustered and Non-Clustered Index?

| Clustered Index | Non-Clustered Index |
|-----------------|---------------------|
| Sorts the actual table data | Stores index separately from the data |
| Data is physically ordered | Data remains in its original order |
| Only **one** clustered index per table | Multiple non-clustered indexes are allowed |
| Faster for range queries | Faster for searching specific values |
| Leaf nodes contain actual data | Leaf nodes contain pointers to data |

---

## Q30. Which is faster: Clustered or Non-Clustered Index?

**Answer:**

- **Clustered Index** is generally faster for **range queries** because the data is physically ordered.
- **Non-Clustered Index** is faster for **searching specific values**, but it may require an additional lookup to retrieve the actual row.

---

# SQL Query

## Q31. What is a SQL Query?

**Answer:**
A **SQL Query** is a command used to communicate with a database to retrieve, insert, update, or delete data.

Example:

```sql
SELECT *
FROM Employees;
```

This query retrieves all records from the `Employees` table.

---

## Q32. Find the second highest salary.

**Answer:**
```sql
SELECT MAX(Salary) AS SecondHighest
FROM Employees
WHERE Salary < 
(
    SELECT MAX(Salary)
    FROM Employees
);
```

---

## Q33. Find duplicate records.

**Answer:**
```sql
SELECT EmployeeName, COUNT(*)
FROM Employees
GROUP BY EmployeeName
HAVING COUNT(*) > 1;
```

---

## Q34. Find employees without a department.

**Answer:**
```sql
SELECT e.EmployeeName
FROM Employees e
LEFT JOIN Departments d
ON e.DeptID = d.DeptID
WHERE d.DeptID IS NULL;
```

---

## Q35. Find the total salary department-wise.

**Answer:**
```sql
SELECT DeptID,
       SUM(Salary) AS TotalSalary
FROM Employees
GROUP BY DeptID;
```

---

# Transactions

## Q36. What is a Transaction in SQL?

**Answer:**
A **Transaction** is a sequence of one or more SQL operations that are executed as a single unit of work. Either all operations are completed successfully, or none of them are applied.

**Example:**
```sql
BEGIN TRANSACTION;

UPDATE Accounts
SET Balance = Balance - 1000
WHERE AccountID = 1;

UPDATE Accounts
SET Balance = Balance + 1000
WHERE AccountID = 2;

COMMIT;
```

---

## Q37. What are the ACID properties of a Transaction?

**Answer:**

ACID stands for:

| Property | Description |
|----------|-------------|
| **Atomicity** | Transaction is completed fully or not executed at all |
| **Consistency** | Database remains in a valid state before and after transaction |
| **Isolation** | Transactions execute independently without affecting each other |
| **Durability** | Committed changes are permanently stored |

---

## Q38. What is COMMIT?

**Answer:**
`COMMIT` permanently saves all changes made during a transaction.

Example:

```sql
COMMIT;
```

After `COMMIT`, changes cannot be rolled back.

---

## Q39. What is ROLLBACK?

**Answer:**
`ROLLBACK` cancels all changes made during the current transaction and restores the previous state.

Example:

```sql
ROLLBACK;
```

---

## Q40. What is SAVEPOINT?

**Answer:**
A **SAVEPOINT** creates a point inside a transaction where you can partially rollback.

Example:

```sql
BEGIN TRANSACTION;

UPDATE Employees
SET Salary = 50000
WHERE EmployeeID = 1;

SAVEPOINT Save1;

UPDATE Employees
SET Salary = 60000
WHERE EmployeeID = 2;

ROLLBACK TO Save1;
```

The second update is undone, but the first update remains.

---

## Q41. What is the difference between COMMIT and ROLLBACK?

| COMMIT | ROLLBACK |
|--------|----------|
| Saves changes permanently | Undoes changes |
| Ends the transaction successfully | Cancels the transaction |
| Cannot be reversed | Restores previous state |

---

## Q42. What happens if a transaction fails?

**Answer:**
If a transaction fails before `COMMIT`, the database can use `ROLLBACK` to undo all changes and maintain data consistency.

---

## Q43. What is the difference between DELETE and TRUNCATE with transactions?

**Answer:**

| DELETE | TRUNCATE |
|--------|----------|
| Can be rolled back before COMMIT | Depends on database behavior |
| Removes rows one by one | Removes all rows quickly |
| Supports WHERE condition | Does not support WHERE |

---

## Q44. What is a Dirty Read?

**Answer:**
A dirty read occurs when one transaction reads data that another transaction has modified but not yet committed.

Example:

- Transaction A updates a value.
- Transaction B reads that value.
- Transaction A rolls back.
- Transaction B has read invalid data.

---

# Deadlock

## Q45. What is a Deadlock?

**Answer:**
A deadlock occurs when two or more transactions wait for each other to release resources, causing all of them to stop executing.

Example:

- Transaction A locks Table 1 and waits for Table 2.
- Transaction B locks Table 2 and waits for Table 1.

---

## Q46. What is Auto Commit?

**Answer:**
Auto Commit automatically commits every SQL statement after execution.

Example:

```sql
INSERT INTO Employees VALUES (1, 'John');
```

The change is automatically saved if auto-commit is enabled.

---

# Primary Key, Foreign Key & Composite Key

## Q47. What is a Primary Key?

**Answer:**
A **Primary Key** is a column or set of columns that uniquely identifies each record in a table.

**Properties of Primary Key:**

- Must contain unique values.
- Cannot contain NULL values.
- A table can have only one Primary Key.
- Automatically creates a unique index (in most databases).

**Example:**

```sql
CREATE TABLE Employees
(
    EmployeeID INT PRIMARY KEY,
    EmployeeName VARCHAR(50),
    Salary INT
);
```

Here, `EmployeeID` uniquely identifies each employee.

---

## Q48. What is a Foreign Key?

**Answer:**

A **Foreign Key** is a column that creates a relationship between two tables by referencing the Primary Key of another table.

**Example:**

### Department Table

| DeptID | DepartmentName |
|--------|----------------|
| 101 | IT |
| 102 | HR |

`DeptID` is the Primary Key.

### Employee Table

| EmpID | Name | DeptID |
|------|------|--------|
| 1 | John | 101 |
| 2 | Mike | 102 |

`DeptID` in Employee table is a Foreign Key.

**SQL:**

```sql
CREATE TABLE Employees
(
    EmpID INT PRIMARY KEY,
    Name VARCHAR(50),
    DeptID INT,
    FOREIGN KEY (DeptID)
    REFERENCES Departments(DeptID)
);
```
---

## Q49. What is a Composite Key?

**Answer:**

A **Composite Key** is a Primary Key made up of two or more columns that together uniquely identify a record.

**Example:**

Student Course Enrollment:

| StudentID | CourseID | Grade |
|-----------|----------|-------|
| 1 | 101 | A |
| 1 | 102 | B |
| 2 | 101 | A |

Here, `(StudentID, CourseID)` together identify each record uniquely.

**SQL:**

```sql
CREATE TABLE Enrollment
(
    StudentID INT,
    CourseID INT,
    Grade VARCHAR(5),

    PRIMARY KEY(StudentID, CourseID)
);
```
---

## Q50. Difference between Primary Key and Foreign Key

| Primary Key | Foreign Key |
|-------------|-------------|
| Uniquely identifies records | Creates relationship between tables |
| Cannot contain NULL | Can contain NULL |
| Unique values only | Duplicate values allowed |
| Only one per table | Multiple allowed |
| Defined in the parent table | Defined in the child table |

---

## Q51. Difference between Primary Key and Composite Key

| Primary Key | Composite Key |
|-------------|---------------|
| Can contain one column | Contains multiple columns |
| Uniquely identifies records | Multiple columns together identify records |
| Simple structure | More complex structure |
| Example: EmployeeID | Example: StudentID + CourseID |

---