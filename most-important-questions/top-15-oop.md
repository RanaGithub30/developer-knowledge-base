## Top Object-Oriented Programming (OOP) Interview Questions & Answers

# Q1. What is OOP?

**Answer:**

OOP stands for Object-Oriented Programming. It is a software design paradigm that organizes code around **objects** rather than just logic and functions. 

OOP helps in writing reusable, maintainable, and scalable code.

---

# Q2. What are the main principles of OOP?

**Answer:**

The four main principles of OOP are:

1. **Encapsulation**
2. **Abstraction**
3. **Inheritance**
4. **Polymorphism**

These are also known as the four pillars of OOP.

---

# Q3. What is a Class?

**Answer:**

A class is a blueprint or template used to create objects.

It defines:
- Variables (data members)
- Methods (functions)

### Example:

```php
<?php

class Car
{
    public $color;

    public function drive()
    {
        echo "Car is running";
    }
}

?>
```

# Q4. What is Encapsulation?

**Answer:**

**Encapsulation** is one of the four main principles of Object-Oriented Programming (OOP).

Encapsulation means **wrapping data (properties) and methods (functions) together inside a class** and restricting direct access to the data from outside the class.

In PHP, encapsulation is achieved using access modifiers:
- `public`
- `private`
- `protected`

It helps in **data hiding, security, and better code maintainability**.

---

## Real-World Example:

**Bank Account System**

A bank account is a real-world example of encapsulation. A customer cannot directly access or change their account balance. The balance is hidden and can only be modified through specific operations like depositing money, withdrawing money, or checking the balance.

This ensures that the account data remains secure and prevents unauthorized access or incorrect changes.

---

# Q5. What is Abstraction ?

**Answer:**

**Abstraction** is one of the four main principles of Object-Oriented Programming (OOP).

Abstraction means **hiding the internal implementation details and showing only the essential features to the user**.

In PHP, abstraction is achieved using:
- `abstract` classes
- `interfaces`

It helps in **reducing complexity, improving security, and making code easier to maintain**.

---

## Real-World Example:

**Car Driving System**

A driver can start the car, accelerate, and use the brakes without knowing how the engine, fuel system, or internal mechanisms work.

The driver only interacts with the essential features of the car while the complex internal implementation is hidden.

This is an example of abstraction.

---

# Q6. What is Inheritance ?

**Answer:**

**Inheritance** is one of the four main principles of Object-Oriented Programming (OOP).

Inheritance means **allowing one class (child class) to acquire the properties and methods of another class (parent class)**.

In PHP, inheritance is achieved using the `extends` keyword.

It helps in **code reusability, reducing code duplication, and improving maintainability**.

---

## Real-World Example:

**Vehicle System**

A car, bike, and truck are all types of vehicles. They share common features like speed, color, and the ability to start or stop.

Instead of writing the same code for each vehicle, we can create a common `Vehicle` class and allow `Car`, `Bike`, and `Truck` classes to inherit its properties and methods.

This is an example of inheritance.

---

# Q7. What is Polymorphism ?

**Answer:**

**Polymorphism** is one of the four main principles of Object-Oriented Programming (OOP).

Polymorphism means **the ability of an object or method to take multiple forms and perform different behaviors based on the situation**.

In PHP, polymorphism is achieved using:
- Method overriding
- Interfaces
- Abstract classes

It helps in **flexibility, code reusability, and easier maintenance**.

---

## Real-World Example:

**Payment System**

A payment system can support different payment methods like Credit Card, PayPal, and UPI.

All payment methods perform the same action (make payment), but each method has its own implementation.

For example, a credit card processes payment differently from PayPal or UPI, but the user only needs to call the payment function.

This is an example of polymorphism.

---

# Q8. What is the difference between Interface and Abstract Class in PHP?

**Answer:**

Both **Interface** and **Abstract Class** are used to achieve abstraction in PHP, but they have different purposes.

| Interface | Abstract Class |
|---|---|
| Defines a contract that classes must follow | Provides a base class with common functionality |
| Contains method declarations | Can contain both abstract and normal methods |
| A class can implement multiple interfaces | A class can extend only one abstract class |
| Uses `implements` keyword | Uses `extends` keyword |
| Does not contain method implementation (except default methods in modern PHP versions) | Can contain method implementations |
| Used when unrelated classes need to follow the same behavior | Used when related classes share common code |

---

## Real-World Example:

### Interface Example:

**Payment System**

Different payment methods like Credit Card, PayPal, and UPI can implement the same `Payment` interface. Each payment method must provide its own payment processing logic.

### Abstract Class Example:

**Vehicle System**

A `Vehicle` abstract class can contain common properties and methods like speed, color, and start(). Classes like Car and Bike can extend it and add their own specific features.

---

## Interview Short Answer:

**Interface defines what a class must do, while an Abstract Class defines what a class is and can provide common functionality.**

---

# Q9.  What is Method Overloading ?

**Answer:**

**Method Overloading** is an **OOP concept** where multiple methods have the **same name but different parameters**.

It allows a method to perform different operations based on the number or type of arguments passed.

**Important Note:**  
PHP does not support traditional method overloading like Java or C++. In PHP, similar functionality can be achieved using:

- Default parameters
- Variable-length arguments (`...$args`)
- Magic method `__call()`

---

## Code Example:

```php
<?php

class Calculator
{
    public function add(...$numbers)
    {
        return array_sum($numbers);
    }
}

$calc = new Calculator();

echo $calc->add(10, 20);

echo "<br>";

echo $calc->add(10, 20, 30);

?>
```
---

# Q10. What is Method Overriding ?

**Answer:**

**Method Overriding** is an **OOP concept** where a **child class provides its own implementation of a method that already exists in the parent class**.

It is achieved through **inheritance** using the `extends` keyword.

Method overriding allows a child class to **modify or customize the behavior** of the parent class method.

### Key Points:
- It requires a parent-child class relationship.
- The method name and parameters should be the same.
- It is an example of **runtime polymorphism**.
- It helps in code flexibility and reusability.

---

## Code Example:

```php
<?php

class Animal
{
    public function sound()
    {
        echo "Animal makes a sound";
    }
}

class Dog extends Animal
{
    public function sound()
    {
        echo "Dog barks";
    }
}

$dog = new Dog();

$dog->sound();

?>
```
---

# Q11. What is the Final Keyword ?

**Answer:**

The **`final` keyword** is an **OOP concept in PHP** that is used to prevent inheritance and method overriding.

A class declared as `final` cannot be extended by another class, and a method declared as `final` cannot be overridden by a child class.

It helps to **protect important functionality and maintain code consistency**.

---

## Uses of Final Keyword:

### 1. Final Class

A final class cannot be inherited by another class.

### Example:

```php
<?php

final class Database
{
    public function connect()
    {
        echo "Database connected";
    }
}

// Cannot extend final class
// class MySQL extends Database {}

?>
```
---

# Q12. What is a Static Method in PHP?

**Answer:**

A **static method** is an **OOP concept in PHP** that belongs to the **class itself rather than an object of the class**.

A static method can be called directly using the class name without creating an object.

Static methods are declared using the `static` keyword.

---

## Code Example:

```php
<?php

class Calculator
{
    public static function add($a, $b)
    {
        return $a + $b;
    }
}

echo Calculator::add(10, 20);

?>
```
---

# Q13. What is Late Static Binding in PHP?

**Answer:**

**Late Static Binding** is an **OOP concept in PHP** that allows a static method or property to refer to the **class that was called at runtime instead of the class where the method was originally defined**.

It is used with the `static` keyword to achieve dynamic resolution of static properties and methods in inheritance.

---

## Code Example:

```php
<?php

class ParentClass
{
    protected static $name = "Parent";

    public static function show()
    {
        echo static::$name;
    }
}

class ChildClass extends ParentClass
{
    protected static $name = "Child";
}

ChildClass::show();

?>
```
---

# Q14. What is a Constructor in PHP?

**Answer:**

A **Constructor** is a special method in PHP that is automatically called when an object of a class is created.

In PHP, a constructor is defined using the `__construct()` magic method.

It is mainly used to **initialize object properties, set default values, and perform setup tasks when an object is created**.

---

## Code Example:

```php
<?php

class User
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function showName()
    {
        echo $this->name;
    }
}

$user = new User("John");

$user->showName();

?>
```
---

# Q15. What is a Destructor in PHP?

**Answer:**

A **Destructor** is a special method in PHP that is automatically called when an object is destroyed or when the script execution ends.

In PHP, a destructor is defined using the `__destruct()` magic method.

It is mainly used to **perform cleanup tasks**, such as closing database connections, releasing resources, or performing final operations before an object is removed from memory.

---

## Code Example:

```php
<?php

class Database
{
    public function __construct()
    {
        echo "Database connection opened";
    }

    public function __destruct()
    {
        echo "Database connection closed";
    }
}

$db = new Database();

?>
```