# SQL Joins

# Table of Contents

1. [Introduction](#1-introduction)
2. [Keys Relationship](#2-primary-key-and-foreign-key)
3. [JOIN Syntax](#3-join-syntax)
4. [Types of Joins](#4-types-of-joins)
5. [Join Comparison](#5-join-comparison)
6. [Performance Tips](#6-performance-tips)

---

# 1. Introduction

A **JOIN** is used to combine data from two or more tables using a related column.

Example:

```
Employee Table
      |
      | dept_id
      |
      v
Department Table
```

JOIN helps retrieve related information stored in different tables.

---

# 2. Primary Key and Foreign Key

## Primary Key (PK)

A **Primary Key** uniquely identifies each record in a table.

Properties:

- Unique value
- Cannot contain NULL
- Only one primary key per table

Example:

```
Employee

emp_id(PK) | name
-----------|------
101        | John
102        | Alice
```

---

## Foreign Key (FK)

A **Foreign Key** connects two tables by referencing another table's Primary Key.

Properties:

- Creates relationship between tables
- Can contain duplicate values
- Maintains data consistency

Example:

```
Department

dept_id(PK) | dept_name


Employee

dept_id(FK)
```

Relationship:

```
Department.dept_id
          |
          |
Employee.dept_id
```

---

# 3. JOIN Syntax

```sql
SELECT columns
FROM table1
JOIN table2
ON table1.column = table2.column;
```

Example:

```sql
SELECT e.name, d.dept_name
FROM employee e
JOIN department d
ON e.dept_id=d.dept_id;
```

---

# 4. Types of Joins

```
                    JOINS

                       |
       --------------------------------
       |          |          |        |
    INNER      OUTER      CROSS     SELF
     JOIN       JOIN       JOIN     JOIN

                |
          ---------------
          |      |      |
        LEFT  RIGHT   FULL
```

---

# INNER JOIN

Returns only matching records from both tables.

```
Table A ∩ Table B
```

Example:

```sql
SELECT *
FROM A
INNER JOIN B
ON A.id=B.id;
```

Output:

```
Only common rows
```

---

# LEFT JOIN

Returns:

- All rows from left table
- Matching rows from right table


```
LEFT TABLE + MATCHES
```

Example:

```sql
SELECT *
FROM A
LEFT JOIN B
ON A.id=B.id;
```

---

# RIGHT JOIN

Returns:

- All rows from right table
- Matching rows from left table


```
RIGHT TABLE + MATCHES
```

Example:

```sql
SELECT *
FROM A
RIGHT JOIN B
ON A.id=B.id;
```

---

# FULL OUTER JOIN

Returns all records from both tables.

```
A UNION B
```

Example:

```sql
SELECT *
FROM A
FULL OUTER JOIN B
ON A.id=B.id;
```

---

# CROSS JOIN

Creates all possible combinations.

Formula:

```
Rows = Table A rows × Table B rows
```

Example:

```
A: 2 rows
B: 3 rows

Result = 6 rows
```

Syntax:

```sql
SELECT *
FROM A
CROSS JOIN B;
```

---

# SELF JOIN

A table joined with itself.

Used for:

- Employee-manager relationship
- Hierarchical data


Example:

```sql
SELECT e.name, m.name
FROM employee e
JOIN employee m
ON e.manager_id=m.id;
```

---

# NATURAL JOIN

Automatically joins columns having the same name.

Example:

```sql
SELECT *
FROM employee
NATURAL JOIN department;
```

Usually avoided because it may create unexpected joins.

---

# 5. Join Comparison

| Join | Result |
|---|---|
|INNER JOIN|Only matching rows|
|LEFT JOIN|All left rows + matches|
|RIGHT JOIN|All right rows + matches|
|FULL JOIN|All rows from both tables|
|CROSS JOIN|All combinations|
|SELF JOIN|Same table join|

---

# 6. JOIN Conditions

## Equality Join

```sql
ON A.id=B.id
```

## Range Join

```sql
ON salary BETWEEN min_salary AND max_salary
```

## Multiple Conditions

```sql
ON A.id=B.id
AND status='Active'
```

---

# JOIN vs UNION

|JOIN|UNION|
|-|-|
|Combines columns|Combines rows|
|Uses ON condition|Uses SELECT|
|Horizontal merge|Vertical merge|

---

# Performance Tips

### Use Indexes

Index columns used in JOIN conditions.

Example:

```
employee.dept_id
department.dept_id
```

### Avoid

```sql
SELECT *
```

Prefer:

```sql
SELECT required_columns
```

### Use Correct JOIN Type

Example:

Need all employees → use `LEFT JOIN`

Need only matching data → use `INNER JOIN`

---

# Common Mistakes

## Missing JOIN Condition

Wrong:

```sql
SELECT *
FROM A,B;
```

Creates:

```
Cartesian Product
```

---

## Wrong NULL Comparison

Wrong:

```sql
column=NULL
```

Correct:

```sql
column IS NULL
```

---

# Quick Revision

```
INNER JOIN
      ↓
Matching records only


LEFT JOIN
      ↓
Everything from left + matches


RIGHT JOIN
      ↓
Everything from right + matches


FULL JOIN
      ↓
Everything from both


CROSS JOIN
      ↓
All possible combinations


SELF JOIN
      ↓
Table with itself
```

---

# Conclusion

SQL JOINs combine related data from multiple tables.

They are mainly used with:

- Primary Keys
- Foreign Keys

Understanding JOINs is essential for SQL queries, database design, and data analysis.