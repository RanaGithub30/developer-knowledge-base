# PHP — Most Common Interview Questions & Answers

## Q1. What is the difference between `==` and `===` in PHP?

### Answer

`==` is a **loose comparison**, while `===` is a **strict comparison**.

* `==` compares values after type conversion if necessary.
* `===` compares both **value and data type**.

### Example

```php
var_dump(5 == "5");   // true
var_dump(5 === "5");  // false
```

### Interview Answer

> `==` compares values with type conversion, while `===` compares both value and type. In most cases, I prefer `===` because it avoids unexpected type conversion.

---

## Q2. What are the four pillars of OOP in PHP?

### Answer

The four pillars of Object-Oriented Programming are:

1. **Encapsulation** — Bundling data and methods together and controlling access using access modifiers.
2. **Inheritance** — Allowing a class to inherit properties and methods from another class.
3. **Polymorphism** — Allowing the same interface or method to behave differently depending on the object.
4. **Abstraction** — Hiding implementation details and exposing only the required functionality.

### Interview Answer

> The four pillars of OOP are Encapsulation, Inheritance, Polymorphism, and Abstraction. They help create reusable, maintainable, and loosely coupled code.

---

## Q3. What is the difference between an Abstract Class and an Interface?

### Answer

An **abstract class** can contain both implemented and abstract methods, while an **interface** mainly defines a contract that implementing classes must follow.

| Abstract Class                            | Interface                                              |
| ----------------------------------------- | ------------------------------------------------------ |
| Can contain concrete and abstract methods | Defines methods that implementing classes must provide |
| Can have properties                       | Can define constants and method contracts              |
| A class can extend only one class         | A class can implement multiple interfaces              |
| Used when classes share common behavior   | Used to define a common contract                       |

### Interview Answer

> I use an abstract class when related classes need to share common behavior or state. I use an interface when I want to define a contract that multiple unrelated classes can implement.

---

## Q4. What are Traits in PHP, and why are they used?

### Answer

A **Trait** is a PHP feature used to reuse methods and properties across multiple classes without inheritance.

### Example

```php
trait Logger
{
    public function log($message)
    {
        echo $message;
    }
}

class UserService
{
    use Logger;
}
```

Now `UserService` can use the `log()` method.

### Interview Answer

> Traits provide code reuse across multiple classes without requiring inheritance. They are useful when multiple unrelated classes need the same functionality.

---

## Q5. What is the difference between `public`, `protected`, and `private`?

### Answer

These are PHP **access modifiers**.

| Modifier    | Accessible From                    |
| ----------- | ---------------------------------- |
| `public`    | Anywhere                           |
| `protected` | The class and its child classes    |
| `private`   | Only the class where it is defined |

### Interview Answer

> `public` members can be accessed from anywhere, `protected` members can be accessed within the class and its child classes, and `private` members can only be accessed inside the class where they are defined.

---

## Q6. What is the difference between Method Overriding and Method Overloading in PHP?

### Answer

**Method Overriding** occurs when a child class provides its own implementation of a method inherited from its parent class.

```php
class Animal
{
    public function sound()
    {
        echo "Animal sound";
    }
}

class Dog extends Animal
{
    public function sound()
    {
        echo "Bark";
    }
}
```

PHP does **not support traditional method overloading** like Java or C++, where multiple methods have the same name but different parameter lists.

PHP can achieve similar dynamic behavior using techniques such as variadic parameters or magic methods.

### Interview Answer

> Method overriding is supported in PHP and occurs when a child class redefines a parent method. PHP does not support traditional method overloading based on different parameter lists.

---

## Q7. What is Dependency Injection in PHP?

### Answer

**Dependency Injection (DI)** means providing an object's dependencies from outside instead of creating them inside the class.

### Without Dependency Injection

```php
class OrderService
{
    public function __construct()
    {
        $this->payment = new PaymentService();
    }
}
```

This creates tight coupling.

### With Dependency Injection

```php
class OrderService
{
    public function __construct(
        private PaymentService $payment
    ) {}
}
```

Now the dependency is injected into the class.

### Interview Answer

> Dependency Injection means providing a class's dependencies from outside rather than creating them inside the class. It reduces tight coupling and makes code easier to test and maintain.

---

## Q8. What is the difference between `include`, `require`, `include_once`, and `require_once`?

### Answer

All four are used to include another PHP file.

| Statement      | Behavior                                                          |
| -------------- | ----------------------------------------------------------------- |
| `include`      | Includes the file; generates a warning if the file is missing     |
| `require`      | Includes the file; generates a fatal error if the file is missing |
| `include_once` | Includes the file only once                                       |
| `require_once` | Requires the file only once                                       |

### Interview Answer

> The main difference is how they handle errors and duplicate inclusion. `require` stops execution when the required file cannot be loaded, while `include` produces a warning and allows execution to continue. The `_once` versions prevent the same file from being included multiple times.

---

## Q9. What is the difference between `isset()`, `empty()`, and `array_key_exists()`?

### Answer

### `isset()`

Checks whether a variable exists and is **not `null`**.

```php
isset($name);
```

### `empty()`

Checks whether a value is considered empty.

```php
empty($name);
```

Values such as `0`, `"0"`, `""`, `false`, `null`, and an empty array are considered empty.

### `array_key_exists()`

Checks whether a key exists in an array, even if its value is `null`.

```php
array_key_exists('name', $data);
```

### Important Difference

```php
$data = ['name' => null];

isset($data['name']);              // false
array_key_exists('name', $data);   // true
```

### Interview Answer

> `isset()` checks whether a value exists and is not null, `empty()` checks whether a value is considered empty, and `array_key_exists()` checks whether a key exists in an array even when its value is null.

---

## Q10. What are Namespaces in PHP, and why are they used?

### Answer

**Namespaces** are used to organize PHP classes, interfaces, functions, and constants and to prevent naming conflicts.

### Example

```php
namespace App\Services;

class PaymentService
{
}
```

We can then import the class using:

```php
use App\Services\PaymentService;
```

### Interview Answer

> Namespaces organize code and prevent naming conflicts between classes or other PHP elements with the same name. Laravel uses namespaces extensively to organize controllers, models, services, and other classes.

---

## Q11. What is Composer, and how does autoloading work in PHP?

### Answer

**Composer** is PHP's dependency management tool. It is used to install, update, and manage third-party PHP packages.

Composer also provides **autoloading**, so we don't have to manually include every PHP class file.

A common approach is **PSR-4 autoloading**.

Example:

```json
{
    "autoload": {
        "psr-4": {
            "App\\": "app/"
        }
    }
}
```

After changing the autoload configuration, we can run:

```bash
composer dump-autoload
```

### Interview Answer

> Composer manages PHP dependencies and also provides autoloading. With PSR-4 autoloading, a namespace is mapped to a directory, allowing PHP classes to be loaded automatically when they are used.

---

## Q12. What is the difference between Pass by Value and Pass by Reference?

### Answer

**Pass by Value** sends a copy of the variable to the function. Changes inside the function do not modify the original variable.

```php
function update($value)
{
    $value = 100;
}

$num = 10;

update($num);

echo $num; // 10
```

**Pass by Reference** uses `&`, so the function can modify the original variable.

```php
function update(&$value)
{
    $value = 100;
}

$num = 10;

update($num);

echo $num; // 100
```

### Interview Answer

> Pass by value passes a copy of the value, so changes do not affect the original variable. Pass by reference uses `&` and allows the function to modify the original variable.

---

## Q13. What is the difference between an Exception and an Error in PHP?

### Answer

Both **Exceptions** and **Errors** implement PHP's `Throwable` interface, but they represent different types of problems.

* **Exception** generally represents an exceptional condition that application code can catch and handle.
* **Error** represents serious problems in PHP execution, such as certain type or runtime errors.

Both can be handled using `try` and `catch` when appropriate.

### Example

```php
try {
    // Code that may throw
} catch (Exception $e) {
    echo $e->getMessage();
}
```

To catch both exceptions and errors:

```php
try {
    // Code
} catch (Throwable $e) {
    echo $e->getMessage();
}
```

### Interview Answer

> Exceptions generally represent conditions that application code can handle, while Errors represent more serious runtime or language-level problems. Both implement `Throwable`, so `Throwable` can be used when we need to catch both.

---

## Q14. What are SOLID principles in PHP?

### Answer

**SOLID** is a set of five object-oriented design principles that help create maintainable and loosely coupled applications.

### S — Single Responsibility Principle

A class should have **one primary responsibility**.

### O — Open/Closed Principle

A class should be **open for extension but closed for modification**.

### L — Liskov Substitution Principle

A child class should be usable wherever its parent class is expected without breaking the application's behavior.

### I — Interface Segregation Principle

Classes should not be forced to depend on methods they do not use.

### D — Dependency Inversion Principle

High-level code should depend on **abstractions**, not concrete implementations.

### Interview Answer

> SOLID consists of five principles: Single Responsibility, Open/Closed, Liskov Substitution, Interface Segregation, and Dependency Inversion. They help us write code that is easier to maintain, test, extend, and modify.

---

## Q15. What is the difference between Composition and Inheritance?

### Answer

**Inheritance** represents an **"is-a"** relationship, where a child class inherits behavior from a parent class.

```php
class Dog extends Animal
{
}
```

A Dog **is an** Animal.

**Composition** represents a **"has-a"** relationship, where a class uses another object as a dependency.

```php
class OrderService
{
    public function __construct(
        private PaymentService $payment
    ) {}
}
```

`OrderService` **has a** `PaymentService`.

### Key Difference

| Inheritance                          | Composition                                   |
| ------------------------------------ | --------------------------------------------- |
| "Is-a" relationship                  | "Has-a" relationship                          |
| Uses `extends`                       | Uses object dependencies                      |
| Creates tighter coupling             | Usually provides looser coupling              |
| Reuses behavior through parent class | Reuses behavior through collaborating objects |

### Interview Answer

> Inheritance is used for an "is-a" relationship and allows a class to inherit from another class. Composition is a "has-a" relationship where a class uses other objects as dependencies. In modern application design, composition is often preferred because it provides more flexibility and reduces tight coupling.
