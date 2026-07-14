# Laravel MongoDB - Interview Questions & Answers

## Q1. What is MongoDB?

### Answer

**MongoDB** is a **NoSQL, document-oriented database** that stores data in **JSON-like BSON (Binary JSON) documents** instead of rows and tables.

Unlike relational databases such as MySQL or PostgreSQL, MongoDB stores flexible documents, making it suitable for applications with dynamic or rapidly changing data.

Laravel can work with MongoDB using the official MongoDB Laravel integration package.

---

## Q2. Why do we use MongoDB with Laravel?

### Answer

MongoDB is used when applications require:

- Flexible schema
- High performance
- Horizontal scalability
- Large volumes of data
- Fast development
- JSON-like document storage

It is commonly used for real-time applications, analytics, and content management systems.

---

## Q3. What is the difference between SQL and MongoDB?

### Answer

| SQL Database | MongoDB |
|--------------|----------|
| Relational database | NoSQL document database |
| Uses tables | Uses collections |
| Uses rows | Uses documents |
| Fixed schema | Flexible schema |
| SQL queries | JSON-like queries |

---

## Q4. How does MongoDB store data?

### Answer

MongoDB stores data as **documents** inside **collections**.

Example document:

```json
{
    "_id": "6657ab123",
    "name": "John",
    "email": "john@example.com",
    "age": 28
}
```

Unlike SQL tables, documents in the same collection can have different fields.

---

## Q5. What are Collections in MongoDB?

### Answer

A **Collection** is a group of related documents.

Example:

```text
users
products
orders
categories
```

A collection is similar to a table in a relational database.

---

## Q6. What is a Document in MongoDB?

### Answer

A **Document** is a single record stored in a collection.

Example:

```json
{
    "name": "Laptop",
    "price": 50000,
    "brand": "Dell"
}
```

A document is similar to a row in a relational database.

---

## Q7. How do you use MongoDB with Laravel?

### Answer

Install the official MongoDB Laravel package using Composer.

Example:

```bash
composer require mongodb/laravel-mongodb
```

Then configure the MongoDB connection in your application.

---

## Q8. Where is the MongoDB connection configured?

### Answer

MongoDB connections are configured in:

```text
config/database.php
```

Connection details are typically stored in the `.env` file.

Example:

```env
DB_CONNECTION=mongodb
MONGODB_URI=mongodb://127.0.0.1:27017
MONGODB_DATABASE=laravel_db
```

---

## Q9. How do you create a MongoDB model?

### Answer

Example:

```php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class User extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'users';

    protected $fillable = [
        'name',
        'email'
    ];
}
```

The model interacts with the MongoDB collection instead of a SQL table.

---

## Q10. How do you insert a document?

### Answer

Using Eloquent:

```php
User::create([

    'name' => 'John',

    'email' => 'john@example.com'

]);
```

Laravel stores the data as a MongoDB document.

---

## Q11. How do you retrieve documents?

### Answer

Retrieve all documents:

```php
$users = User::all();
```

Retrieve the first document:

```php
$user = User::first();
```

Retrieve by condition:

```php
$user = User::where(
    'email',
    'john@example.com'
)->first();
```

---

## Q12. How do you update a document?

### Answer

Example:

```php
$user = User::find($id);

$user->name = 'Peter';

$user->save();
```

The document is updated in the MongoDB collection.

---

## Q13. How do you delete a document?

### Answer

Example:

```php
User::find($id)->delete();
```

Laravel removes the document from the collection.

---

## Q14. What are the advantages of MongoDB?

### Answer

MongoDB provides several benefits:

- Flexible schema
- High performance
- Easy horizontal scaling
- Stores nested data
- JSON-like document format
- Suitable for large datasets
- Rapid application development

---

## Q15. What are the disadvantages of MongoDB?

### Answer

Some limitations include:

- Less suitable for complex relational data
- Limited support for joins compared to SQL databases
- Data duplication may occur
- Schema validation is optional
- Some ACID features differ from relational databases

---

## Q16. What are some real-world uses of MongoDB?

### Answer

MongoDB is commonly used for:

- Content Management Systems (CMS)
- E-commerce applications
- Social media platforms
- Real-time chat applications
- Analytics platforms
- IoT applications
- Product catalogs
- Logging systems

---

## Q17. What is the difference between Eloquent for SQL and MongoDB?

### Answer

| SQL Eloquent | MongoDB Eloquent |
|--------------|------------------|
| Uses database tables | Uses collections |
| Rows represent records | Documents represent records |
| Auto-increment IDs | ObjectId by default |
| Relational schema | Flexible document schema |

---

## Q18. Can Laravel relationships be used with MongoDB?

### Answer

Yes.

The MongoDB Laravel package supports relationship methods similar to Eloquent, including:

- `hasOne()`
- `hasMany()`
- `belongsTo()`
- `belongsToMany()`

However, since MongoDB is a document database, developers often use **embedded documents** or references depending on the application's needs.

---

## Q19. What is the difference between MySQL and MongoDB?

### Answer

| MySQL | MongoDB |
|--------|----------|
| Relational database | NoSQL database |
| Fixed schema | Flexible schema |
| Tables and rows | Collections and documents |
| SQL language | JSON-like queries |
| Best for structured data | Best for semi-structured or unstructured data |

---

## Q20. Give a real-world example of MongoDB.

### Answer

Consider an e-commerce application.

```text
Products Collection
        │
        ├── Product Document
        ├── Product Document
        ├── Product Document
        └── Product Document
```

Each product can have different attributes.

Example:

```json
{
    "name": "Laptop",
    "brand": "Dell",
    "price": 50000,
    "specifications": {
        "ram": "16 GB",
        "storage": "512 GB SSD"
    }
}
```

MongoDB easily stores nested and varying product information without requiring a fixed table structure.

---

## Q21. Why is MongoDB important for Laravel developers?

### Answer

MongoDB is a valuable database option for Laravel applications that require flexibility and scalability.

It:

- Handles dynamic data efficiently
- Supports high-performance applications
- Stores JSON-like documents
- Scales horizontally
- Integrates with Laravel through the official MongoDB package
- Is well suited for modern applications with evolving data models