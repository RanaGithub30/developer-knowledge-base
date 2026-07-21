## Top PHP Interview Questions & Answer

## Table of Contents

- [Basic](#basic)
- [Variable Scope](#variable-scope)
- [Exception Handling](#exception-handling)
- [Namespace](#namespace)
- [Composer](#composer)
- [Security](#security)
- [Sessions](#sessions)

# Basic

## Q1: What is the difference between `==` and `===`?

## Answer

- `==` (Loose Comparison) compares **only the values** after type conversion.
- `===` (Strict Comparison) compares **both value and data type** without type conversion.

**Example:**
```php
$a = 5;
$b = "5";

var_dump($a == $b);   // true
var_dump($a === $b);  // false
```
---

## Q2. What is the difference between `include` and `require`?

## Short Interview Answer

- `include` gives a **warning** if the file is not found, and the script **continues execution**.
- `require` gives a **fatal error** if the file is not found, and the script **stops execution**.

**Example:**
```php
include 'header.php';   // Warning if file is missing, script continues.

require 'config.php';   // Fatal error if file is missing, script stops.
```
---

## Q3. What is the difference between `include_once` and `require_once`?

## Short Interview Answer

- `include_once` includes a file **only once**. If the file is missing, it shows a **warning** and the script continues.
- `require_once` includes a file **only once**. If the file is missing, it throws a **fatal error** and stops the script.

**Example:**
```php
include_once 'header.php';
require_once 'config.php';
```
---

## Q4. What is the difference between `echo` and `print`?

## Answer

- `echo` can output **one or more strings** and does not return any value.
- `print` outputs **only one string** and returns `1`.

**Example:**

```php
<?php
echo "Hello", " World";

print "Hello PHP";
?>
```

**Output:**
```
Hello World
Hello PHP
```
---

## Q5. What is the difference between `isset()` and `empty()`?

## Answer

- `isset()` checks whether a variable **exists and is not NULL**. It returns `true` or `false`.
- `empty()` checks whether a variable is **empty** (like `0`, `""`, `false`, `NULL`, or not set). It returns `true` or `false`.

**Example:**

```php
<?php
$name = "John";
$age = 0;

var_dump(isset($name));
var_dump(empty($name));

var_dump(isset($age));
var_dump(empty($age));
?>
```

**Output:**
```
bool(true)
bool(false)

bool(true)
bool(true)
```
---

## Q6. What is `unset()`?

## Answer

- `unset()` is used to **remove a variable or array element from memory**.
- After using `unset()`, the variable no longer exists.

**Example:**

```php
<?php
$name = "John";

unset($name);

var_dump(isset($name));
?>
```

**Output:**
```
bool(false)
```
---

## Q7. How does PHP execute?

## Answer

- PHP is a **server-side scripting language**.
- When a user requests a PHP page, the **web server sends the PHP file to the PHP interpreter**.
- The PHP interpreter executes the code and generates **HTML output**.
- The web server sends the final output to the browser.

**Execution Flow:**

```
User Request → Web Server → PHP Interpreter → HTML Output → Browser
```
---

# Variable Scope

## Q8. What is Variable Scope?

## Answer

Variable scope defines where a variable can be accessed in a PHP script.

PHP has mainly three types of variable scopes:

1. **Local Scope**  
   - A variable declared inside a function can be accessed only inside that function.

2. **Global Scope**  
   - A variable declared outside a function is global and can be accessed outside functions.
   - To access it inside a function, use the `global` keyword.

3. **Static Scope**  
   - A static variable inside a function keeps its value even after the function execution ends.

**Example:**

```php
<?php

$name = "John"; // Global variable

function test() {
    global $name;
    echo $name;

    static $count = 0;
    $count++;
    echo $count;
}

test();
test();

?>
```

**Output:**
```
John
1
John
2
```
---

# Global keyword

## Q9. What is the use of the `global` keyword?

## Answer

- The `global` keyword is used to **access global variables inside a function**.
- By default, variables declared outside a function cannot be accessed inside it.

**Example:**

```php
<?php

$name = "John";

function showName() {
    global $name;
    echo $name;
}

showName();

?>
```

**Output:**
```
John
```
---

# Static variable

## Q10.  What is a static variable?

## Answer

- A `static` variable is a variable inside a function that **retains its value even after the function execution ends**.
- It is initialized only once and keeps its previous value on the next function call.

**Example:**

```php
<?php

function counter() {
    static $count = 0;
    $count++;
    echo $count . "<br>";
}

counter();
counter();
counter();

?>
```

**Output:**
```
1
2
3
```
---

# Constant vs Variable

## Q11. What is the difference between Constant and Variable?

## Answer

- A **variable** stores a value that can be changed during script execution.
- A **constant** stores a value that cannot be changed once defined.

| Variable | Constant |
|----------|-----------|
| Value can be changed | Value cannot be changed |
| Declared using `$` symbol | Declared using `define()` or `const` |
| Variable names are case-sensitive | Constants are case-sensitive by default |
| Can be reassigned | Cannot be reassigned |

**Example:**

```php
<?php

$name = "John";
$name = "David";

define("SITE_NAME", "My Website");

echo $name;
echo SITE_NAME;

?>
```

**Output:**
```
David
My Website
```
---

# Exception Handling

## Q12.  What are `try`, `catch`, and `finally`?

## Answer

- `try` block contains code that may throw an exception.
- `catch` block handles the exception thrown by the `try` block.
- `finally` block always executes whether an exception occurs or not.

**Example:**

```php
<?php

try {
    $num = 10;

    if ($num > 5) {
        throw new Exception("Error occurred");
    }

    echo "No Error";
}
catch (Exception $e) {
    echo $e->getMessage();
}
finally {
    echo " Finally block executed";
}

?>
```

**Output:**
```
Error occurred Finally block executed
```
---

## Q13. Can we write multiple `try-catch` blocks within a `try` block?

## Answer

- Yes, we can write a **nested `try-catch` block** inside another `try` block.
- The inner `try-catch` handles its own exceptions, and the outer `try-catch` handles exceptions that are not caught inside.

**Example:**

```php
<?php

try {

    try {
        throw new Exception("Inner Exception");
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }

}
catch (Exception $e) {
    echo "Outer Exception";
}

?>
```

**Output:**
```
Inner Exception
```
---

## Q14. Can we write a nested `try-catch` block inside a `catch` block?

## Answer

- Yes, we can write a **`try-catch` block inside a `catch` block** in PHP.
- It is used when we want to handle another exception while handling the first exception.

**Example:**

```php
<?php

try {
    throw new Exception("Main Exception");
}
catch (Exception $e) {

    echo $e->getMessage();

    try {
        throw new Exception("Nested Exception");
    }
    catch (Exception $e) {
        echo "<br>" . $e->getMessage();
    }
}

?>
```

**Output:**
```
Main Exception
Nested Exception
```
----

## Q15. Can we write multiple `catch` blocks for a single `try` block?

## Answer

- Yes, we can write **multiple `catch` blocks** for a single `try` block.
- Each `catch` block can handle a **different type of exception**.
- PHP executes the **first matching `catch` block**.

**Example:**

```php
<?php

try {
    throw new DivisionByZeroError("Division by zero error");
}
catch (DivisionByZeroError $e) {
    echo $e->getMessage();
}
catch (Exception $e) {
    echo "General Exception";
}

?>
```

**Output:**
```
Division by zero error
```
---

## Q16. Can we write multiple `finally` blocks for a single `try` block?

## Answer

- No, we **cannot write multiple `finally` blocks** for a single `try` block in PHP.
- A `try` block can have **only one `finally` block**.
- The `finally` block always executes after `try` or `catch`.

**Example:**

```php
<?php

try {
    echo "Try block";
}
catch (Exception $e) {
    echo "Catch block";
}
finally {
    echo "Finally block";
}

?>
```

**Output:**
```
Try block
Finally block
```
---

## Q17. Can we write `try-catch` or nested `try-catch` inside a `finally` block?

## Answer

- Yes, we can write a **`try-catch` block inside a `finally` block** in PHP.
- A nested `try-catch` can also be written inside the `finally` block.
- It is used to handle exceptions that may occur during cleanup operations.

**Example:**

```php
<?php

try {
    echo "Main Try<br>";
}
finally {

    try {
        throw new Exception("Exception in Finally");
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }

}

?>
```

**Output:**
```
Main Try
Exception in Finally
```
---

## Q18. What is the use of `throw`?

## Answer

- `throw` is used to **manually create and throw an exception**.
- It transfers control from the current code block to the nearest matching `catch` block.

**Example:**

```php
<?php

try {
    $age = 15;

    if ($age < 18) {
        throw new Exception("Age must be 18 or above");
    }

    echo "Eligible";
}
catch (Exception $e) {
    echo $e->getMessage();
}

?>
```

**Output:**
```
Age must be 18 or above
```
---

## Q19. What is a Custom Exception?

## Answer

- A **Custom Exception** is a user-defined exception class created by extending PHP's built-in `Exception` class.
- It is used to create custom error handling messages based on application requirements.

**Example:**

```php
<?php

class MyException extends Exception {}

try {
    $age = 15;

    if ($age < 18) {
        throw new MyException("Age is not valid");
    }
}
catch (MyException $e) {
    echo $e->getMessage();
}

?>
```

**Output:**
```
Age is not valid
```
---

# Namespace

## Q20.  What is a Namespace?

## Answer

- A **namespace** is used to organize PHP code and avoid **name conflicts** between classes, functions, or constants with the same name.
- It allows multiple classes with the same name to exist in different namespaces.

**Example:**

```php
<?php

namespace App;

class User {
    public function show() {
        echo "App User";
    }
}

$user = new User();
$user->show();

?>
```

**Output:**
```
App User
```
---

## Q21. Why do we use namespaces?

## Answer

- Namespace is used to **avoid naming conflicts** between classes, functions, or constants.
- It helps to **organize code** into logical groups.
- It allows using the **same class name in different parts of an application**.

**Example:**

```php
<?php

namespace App;

class User {
    public function show() {
        echo "App User";
    }
}

namespace Admin;

class User {
    public function show() {
        echo "Admin User";
    }
}

?>
```

**Output:**
```
Both App\User and Admin\User can exist without conflict.
```
---

# Composer

## Q22. What is Composer?

## Answer

- **Composer** is a dependency management tool for PHP.
- It is used to **install, manage, and update external libraries/packages** required in a PHP project.
- It also provides **autoloading** for classes.

**Example:**

```bash
composer require monolog/monolog
```

**Output:**
```
Package installed successfully
```
---

## Q23. What is PSR-4?

## Answer

- **PSR-4 (PHP Standard Recommendation 4)** is an autoloading standard defined by PHP-FIG.
- It defines how **namespace names map to directory and file structures**.
- It allows Composer to automatically load classes without manually including files.

**Example:**

Namespace:
```php
App\Models\User
```

Directory Structure:
```
project/
 ├── app/
 │    └── Models/
 │         └── User.php
```

`composer.json`:

```json
{
    "autoload": {
        "psr-4": {
            "App\\": "app/"
        }
    }
}
```

After running:

```bash
composer dump-autoload
```

Class can be used directly:

```php
use App\Models\User;

$user = new User();
```

**Output:**
```
Class loaded automatically
```
---

## Q24. What is Autoloading?

## Answer

- **Autoloading** is a feature in PHP that automatically loads class files when a class is used.
- It eliminates the need to manually write `include` or `require` for every class file.
- Composer uses autoloading with standards like **PSR-4**.

**Example:**

```php
<?php

require "vendor/autoload.php";

$user = new User();

?>
```

**Output:**
```
Class loaded automatically
```
---

# Security

## Q25. What is SQL Injection?

## Answer

- **SQL Injection** is a security vulnerability where an attacker inserts malicious SQL queries through user input to access or modify database data.
- It happens when user input is directly concatenated into SQL queries.
- It can be prevented by using **prepared statements** and **parameterized queries**.

**Example (Unsafe):**

```php
$username = $_POST['username'];

$sql = "SELECT * FROM users WHERE username='$username'";
```

**Attack Input:**
```
' OR '1'='1
```

**Prevention Example:**

```php
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
```

**Output:**
```
User data fetched safely
```
---

## Q26. What is XSS (Cross-Site Scripting)?

## Answer

- **XSS** is a security vulnerability where an attacker injects malicious JavaScript code into a web page.
- It can steal user data, cookies, or perform actions on behalf of the user.
- It can be prevented by **validating input** and **escaping output** using functions like `htmlspecialchars()` in PHP.

**Example (Unsafe):**

```php
<?php

echo $_GET['name'];

?>
```

**Attack Input:**
```
<script>alert('Hacked')</script>
```

**Prevention Example:**

```php
<?php

echo htmlspecialchars($_GET['name']);

?>
```

**Output:**
```
<script>alert('Hacked')</script>
```
---

## Q27. What is CSRF?

## Answer

- **CSRF** is a security attack where an attacker tricks a logged-in user into performing an unwanted action on a website without their knowledge.
- It usually targets requests like **money transfer, password change, or form submission**.
- It can be prevented by using **CSRF tokens** to verify that the request comes from the actual website.

**Example (Unsafe):**

```html
<form action="transfer.php" method="POST">
    <input type="text" name="amount">
    <button type="submit">Transfer</button>
</form>
```

**Prevention Example:**

```php
<input type="hidden" name="csrf_token" value="random_token">
```

```php
if ($_POST['csrf_token'] == $_SESSION['csrf_token']) {
    // Process request
}
```

**Output:**
```
Request verified successfully
```
---

## Q28. What is Password Hashing?

## Answer

- **Password hashing** is the process of converting a password into a secure encrypted string before storing it in the database.
- It protects user passwords even if the database is compromised.
- PHP provides built-in functions like `password_hash()` and `password_verify()` for secure password handling.

**Example:**

```php
<?php

$password = "mypassword";

$hash = password_hash($password, PASSWORD_DEFAULT);

echo $hash;

?>
```

**Output:**
```
$2y$10$eF7x9... (hashed password)
```

**Verify Password:**

```php
<?php

if (password_verify("mypassword", $hash)) {
    echo "Password matched";
}

?>
```

**Output:**
```
Password matched
```
---

# Sessions

## Q29. What is a Session?

## Answer

- A **session** is used to store user data on the **server** across multiple pages.
- It helps maintain user information like login status, user ID, and preferences.
- Session data is stored until the session is destroyed or expires.

**Example:**

```php
<?php

session_start();

$_SESSION['username'] = "John";

echo $_SESSION['username'];

?>
```

**Output:**
```
John
```
---

## Q30. What is a Cookie?

## Answer

- A **cookie** is a small piece of data stored on the **client's browser**.
- It is used to remember user information like preferences, login details, and settings.
- Cookies are sent with every request to the server.

**Example:**

```php
<?php

setcookie("username", "John", time()+3600);

echo $_COOKIE['username'];

?>
```

**Output:**
```
John
```
---

## Q31. What is JWT?

## Answer

- **JWT (JSON Web Token)** is a secure token-based authentication method used to exchange information between client and server.
- It is commonly used for **API authentication** and is **stateless** (server does not store session data).
- JWT contains three parts: **Header, Payload, and Signature**.

**Example:**

```
xxxxx.yyyyy.zzzzz
```

**JWT Flow:**

```
User Login → Server Generates JWT Token → Client Stores Token → Token Sent with Requests → Server Verifies Token
```

**Output:**
```
User authenticated successfully
```