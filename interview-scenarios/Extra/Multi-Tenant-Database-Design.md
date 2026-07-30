# Multi-Tenant Database Design

## Question

**You are designing a multi-tenant SaaS application where thousands of companies use the same platform. How would you design the database structure so that each company's data remains isolated and secure? Explain your approach and the trade-offs.**

---

## Answer

A multi-tenant application allows multiple companies (tenants) to share the same platform while keeping their data isolated and secure.

### Approach

### 1. Shared Database, Shared Schema (Recommended for Most SaaS)

- Use a single database and a single schema.
- Add a `tenant_id` column to every tenant-specific table.
- Every query filters data using the corresponding `tenant_id`.

Example:

```sql
CREATE TABLE orders (
    id INT PRIMARY KEY,
    tenant_id INT NOT NULL,
    customer_name VARCHAR(100),
    total DECIMAL(10,2)
);
```

Query:

```sql
SELECT *
FROM orders
WHERE tenant_id = ?;
```

**Advantages**
- Cost-effective
- Easy to maintain
- Scales well for thousands of tenants

**Disadvantages**
- Strong application logic is required to prevent data leakage.
- A bug in filtering could expose another tenant's data.

---

### 2. Shared Database, Separate Schemas

- Each company has its own database schema.
- Tables are duplicated across schemas.

**Advantages**
- Better data isolation.
- Easier tenant-specific backups.

**Disadvantages**
- More complex database management.
- Schema updates must be applied to every tenant.

---

### 3. Separate Database per Tenant

- Each company has its own database.

**Advantages**
- Maximum security and isolation.
- Easy backup and restore for individual tenants.
- Suitable for enterprise customers.

**Disadvantages**
- Higher infrastructure cost.
- More difficult to manage thousands of databases.
- Scaling and maintenance become more complex.

---

## Security Measures

- Always filter queries using `tenant_id`.
- Implement role-based access control (RBAC).
- Validate tenant identity through authentication.
- Encrypt sensitive data.
- Audit user actions and database access.
- Use parameterized queries to prevent SQL injection.

---

## Conclusion

For a SaaS platform serving **thousands of companies**, I would choose a **shared database with a shared schema** using a `tenant_id` column. It offers the best balance of scalability, cost, and performance while maintaining data isolation through proper authentication, authorization, and query filtering. For customers with strict compliance or security requirements, a **separate database per tenant** can be offered as a premium option.