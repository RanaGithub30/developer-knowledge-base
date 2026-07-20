# E-commerce Order System Database Design - Interview Answer

## Question

You are designing an e-commerce order system.

Tables:

- users
- products
- orders
- order_items
- payments

A product can appear in thousands of orders, and a user can place thousands of orders.

Explain:

- How will you design the relationships?
- What columns and indexes will you add?
- How will you handle product price changes after an order is placed?

---

## Answer

I would design the database using proper relationships and keep historical data consistent.

### 1. Database Relationships

**User and Orders**

A user can have multiple orders.

Relationship:

```
User hasMany Orders
Order belongsTo User
```

`orders` table:

```sql
id
user_id
status
total_amount
created_at
```

---

**Orders and Products**

An order can contain multiple products, and a product can exist in many orders.

I would use an intermediate table:

`order_items`

```sql
id
order_id
product_id
quantity
price
```

Relationship:

```
Order hasMany OrderItems
Product hasMany OrderItems
```

---

**Orders and Payments**

An order can have payment records.

Relationship:

```
Order hasOne Payment
Payment belongsTo Order
```

---

### 2. Columns and Indexes

Important indexes:

- `users.email` → unique index
- `orders.user_id` → index for fetching user orders
- `orders.status` → index for filtering orders
- `order_items.order_id` → index for fetching order details
- `order_items.product_id` → index for product history
- `payments.order_id` → index

Foreign keys should be added for data integrity.

---

### 3. Handling Product Price Changes

I would store the purchased product price inside `order_items`.

Example:

```
order_items

product_id | quantity | price
------------------------------
10         | 2        | 500
```

Even if the product price changes later from 500 to 700, the old order should still show the original purchase price.

This keeps order history accurate.

---

### Summary

- Use relationships: User → Orders → Order Items → Products.
- Add indexes on foreign keys and frequently searched columns.
- Store product price snapshots in `order_items` to maintain historical order data.