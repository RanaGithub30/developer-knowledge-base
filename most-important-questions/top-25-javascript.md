# JavaScript Interview Questions & Answers

# var, let & const

## Q1. What is the difference between `var`, `let`, and `const` in JavaScript?

### Answer:

`var`, `let`, and `const` are keywords used to declare variables in JavaScript.

| Feature         | `var`                    | `let`                             | `const`                           |
| --------------- | ------------------------ | --------------------------------- | --------------------------------- |
| Scope           | Function scoped          | Block scoped                      | Block scoped                      |
| Re-declaration  | Allowed                  | Not allowed in same scope         | Not allowed in same scope         |
| Re-assignment   | Allowed                  | Allowed                           | Not allowed                       |
| Hoisting        | Hoisted with `undefined` | Hoisted but in Temporal Dead Zone | Hoisted but in Temporal Dead Zone |
| Must initialize | No                       | No                                | Yes                               |

Example:

```javascript
var a = 10;
let b = 20;
const c = 30;

a = 100; // Allowed
b = 200; // Allowed
c = 300; // Error
```

---

## Q2. What happens if we redeclare variables using `var`, `let`, and `const`?

### Answer:

### Using `var`:

```javascript
var name = "John";
var name = "Alex";

console.log(name); // Alex
```

Redeclaration is allowed.

### Using `let`:

```javascript
let age = 25;
let age = 30; // Error
```

Redeclaration in the same scope is not allowed.

### Using `const`:

```javascript
const country = "India";
const country = "USA"; // Error
```

Redeclaration is not allowed.

---

## Q3. What is the Temporal Dead Zone (TDZ)?

### Answer:

The Temporal Dead Zone is the time period between entering a block and initializing a `let` or `const` variable.

Example:

```javascript
{
    console.log(value); // ReferenceError

    let value = 100;
}
```

The variable exists but cannot be accessed before declaration.

---

## Q4. Can we change the value of a `const` variable?

### Answer:

No, a `const` variable cannot be reassigned.

Example:

```javascript
const price = 100;

price = 200; // Error
```

However, objects and arrays declared with `const` can be modified.

Example:

```javascript
const user = {
    name: "John"
};

user.name = "Alex";

console.log(user.name); // Alex
```

The reference cannot change, but the contents can.

---

## Q5. Why should we prefer `let` and `const` over `var`?

### Answer:

Modern JavaScript prefers `let` and `const` because:

* They provide block scope.
* They prevent accidental redeclaration.
* They reduce bugs caused by hoisting behavior.
* They make code easier to understand.

Example:

```javascript
const API_URL = "https://example.com";
let count = 0;
```

---

## Q6. What is the difference between `var` and `let` inside loops?

### Answer:

`var` creates one shared variable, while `let` creates a new variable for each iteration.

Example using `var`:

```javascript
for (var i = 0; i < 3; i++) {
    setTimeout(() => {
        console.log(i);
    }, 1000);
}
```

Output:

```
3
3
3
```

Example using `let`:

```javascript
for (let i = 0; i < 3; i++) {
    setTimeout(() => {
        console.log(i);
    }, 1000);
}
```

Output:

```
0
1
2
```

---

## Quick Interview Summary

| Question                   | Key Point                       |
| -------------------------- | ------------------------------- |
| `var` scope?               | Function scope                  |
| `let` scope?               | Block scope                     |
| `const` scope?             | Block scope                     |
| Can `var` be redeclared?   | Yes                             |
| Can `let` be redeclared?   | No                              |
| Can `const` be reassigned? | No                              |
| Are all hoisted?           | Yes, but `let`/`const` have TDZ |
| Modern preference?         | `const` → `let` → avoid `var`   |

---

# Hoisting

## Q7. What is Hoisting in JavaScript?

### Answer:

Hoisting is a JavaScript mechanism where variable and function declarations are moved to the top of their scope before the code is executed.

However, only the **declaration** is hoisted, not the **initialization**.

Example:

```javascript
console.log(name);

var name = "John";
```

Output:

```text
undefined
```

JavaScript internally treats it like:

```javascript
var name;

console.log(name);

name = "John";
```

---

## Q8. Are all variables hoisted in JavaScript?

### Answer:

Yes, `var`, `let`, and `const` variables are hoisted, but they behave differently.

| Keyword | Hoisting Behavior                                |
| ------- | ------------------------------------------------ |
| `var`   | Hoisted and initialized with `undefined`         |
| `let`   | Hoisted but not initialized (Temporal Dead Zone) |
| `const` | Hoisted but not initialized (Temporal Dead Zone) |

Example:

```javascript
console.log(a);
var a = 10;
```

Output:

```text
undefined
```

---

## Q9. Are function declarations hoisted?

### Answer:

Yes, function declarations are completely hoisted.

Example:

```javascript
sayHello();

function sayHello() {
    console.log("Hello World");
}
```

Output:

```text
Hello World
```

JavaScript moves the complete function declaration to the top.

---

## Q10. Are function expressions hoisted?

### Answer:

Function expressions are not completely hoisted.

Example using `var`:

```javascript
hello();

var hello = function() {
    console.log("Hello");
};
```

Output:

```text
TypeError: hello is not a function
```

Reason:

```javascript
var hello; // undefined

hello();
```

Only the variable declaration is hoisted, not the function assignment.

---

## Q11. What is the difference between hoisting and initialization?

### Answer:

**Hoisting:**

* Moving declarations to the top of the scope.

**Initialization:**

* Assigning a value to the variable.

Example:

```javascript
var age = 25;
```

Internally:

```javascript
var age;   // Hoisting
age = 25;  // Initialization
```
---

# Quick Interview Summary

| Concept                | Behavior                                 |
| ---------------------- | ---------------------------------------- |
| `var` hoisting         | Declaration hoisted, value = `undefined` |
| `let` hoisting         | Hoisted but TDZ applies                  |
| `const` hoisting       | Hoisted but TDZ applies                  |
| Function declaration   | Fully hoisted                            |
| Function expression    | Not fully hoisted                        |
| Class declaration      | Hoisted but TDZ applies                  |
| Hoisting happens when? | During memory creation phase             |

---

## One-Line Interview Answer

**"Hoisting is JavaScript's behavior of moving variable and function declarations to the top of their scope during the creation phase before execution. Function declarations are fully hoisted, while `var` variables are initialized as `undefined` and `let`/`const` remain in the Temporal Dead Zone until initialized."**

---

# Closure

## Q12. What is a Closure in JavaScript?

**Answer:**

A **closure** is a function that remembers and can access variables from its **lexical scope**, even after the outer function has finished executing.

In simple words, a closure allows an inner function to "remember" variables from its parent function.

**Example:**

```javascript
function outer() {
    let count = 0;

    function inner() {
        count++;
        console.log(count);
    }

    return inner;
}

const counter = outer();

counter(); // 1
counter(); // 2
counter(); // 3
```

Here, `inner()` forms a closure over the `count` variable.

---

## Q13. What is Lexical Scope?

**Answer:**

Lexical scope means a function can access variables defined in its parent scope based on where the function is written, not where it is called.

```javascript
let name = "John";

function outer() {
    let city = "London";

    function inner() {
        console.log(name);
        console.log(city);
    }

    inner();
}

outer();
```

Output:

```
John
London
```
---

# Promise

## Q14. What is a Promise in JavaScript?

**Answer:**

A **Promise** is an object that represents the eventual completion (or failure) of an asynchronous operation and its resulting value.

Instead of using nested callbacks, Promises provide a cleaner way to handle asynchronous code.

**Example:**

```javascript
const promise = new Promise((resolve, reject) => {
    const success = true;

    if (success) {
        resolve("Operation successful");
    } else {
        reject("Operation failed");
    }
});

promise.then(console.log).catch(console.error);
```

Output:

```
Operation successful
```
---

## Q15. What Are `resolve()` and `reject()`?

**Answer:**

- `resolve(value)` marks the Promise as fulfilled.
- `reject(error)` marks the Promise as rejected.

```javascript
new Promise((resolve, reject) => {
    resolve("Success");
});

new Promise((resolve, reject) => {
    reject("Something went wrong");
});
```
---

## Q16. What Does `.then()` Do?

**Answer:**

`.then()` handles the fulfilled value of a Promise.

```javascript
Promise.resolve(100)
    .then(result => {
        console.log(result);
    });
```

Output:

```
100
```
---

## Q17. What Is Promise Chaining?

**Answer:**

The result of one `.then()` can be passed to the next.

```javascript
Promise.resolve(5)
    .then(num => num * 2)
    .then(num => num + 3)
    .then(console.log);
```

Output:

```
13
```
---

## Q18. What Is Callback Hell?

**Answer:**

Callback hell occurs when multiple asynchronous callbacks are nested, making code difficult to read and maintain.

**Example:**

```javascript
login(function(user) {
    getProfile(user, function(profile) {
        getOrders(profile, function(orders) {
            console.log(orders);
        });
    });
});
```

Promises help flatten this structure.

---

# async/await

## Q19. What is `async/await` in JavaScript?

**Answer:**

The `async/await` syntax in JavaScript is a modern feature built on top of Promises that allows you to write asynchronous code in a clean, synchronous-looking manner.

**Example:**

```javascript
async function greet() {
    return "Hello";
}

greet().then(console.log);
```

Output:

```
Hello
```

> **Note:** An `async` function always returns a Promise.

---

## Q20. What Does the `async` Keyword Do?

**Answer:**

The `async` keyword declares a function as asynchronous. It automatically wraps the returned value in a Promise.

```javascript
async function getNumber() {
    return 10;
}

getNumber().then(console.log);
```

Output:

```
10
```

Equivalent to:

```javascript
function getNumber() {
    return Promise.resolve(10);
}
```
---

## Q21. What Does the `await` Keyword Do?

**Answer:**

`await` pauses the execution of an `async` function until the Promise settles.

```javascript
function fetchData() {
    return new Promise(resolve => {
        setTimeout(() => resolve("Data Loaded"), 1000);
    });
}

async function main() {
    const result = await fetchData();
    console.log(result);
}

main();
```

Output after 1 second:

```
Data Loaded
```
---

## Q22. How Do You Handle Errors with `async/await`?

Use `try...catch`.

```javascript
async function demo() {
    try {
        throw new Error("Something went wrong");
    } catch (error) {
        console.log(error.message);
    }
}

demo();
```

Output:

```
Something went wrong
```
---

# Event Loop

## Q23. What is the Event Loop in JavaScript?

**Answer:**

The **Event Loop** is a mechanism that allows JavaScript to perform **non-blocking asynchronous operations** even though JavaScript is **single-threaded**.

It continuously checks whether the **Call Stack** is empty. If it is, the Event Loop moves ready tasks from the **Microtask Queue** or **Task (Callback) Queue** to the Call Stack for execution.

> **Interview Definition:**  
> The Event Loop continuously monitors the Call Stack and executes queued asynchronous callbacks when the stack becomes empty.

---

## Q24. What Is the Call Stack?

**Answer:**

The **Call Stack** keeps track of function execution.

Functions are pushed onto the stack when called and popped off when they finish.

---

# Arrow Function

## Q25.  What is an Arrow Function in JavaScript?

**Answer:**

An **Arrow Function** is a shorter syntax for writing function expressions, introduced in **ES6 (ECMAScript 2015)**.

It provides:

- Concise syntax
- Lexical `this` binding
- Implicit return for single expressions

**Syntax:**

```javascript
const add = (a, b) => {
    return a + b;
};
```

Or:

```javascript
const add = (a, b) => a + b;
```
---

## Q26. What Is the Syntax of an Arrow Function?

### No Parameters

```javascript
const greet = () => {
    console.log("Hello");
};
```

### One Parameter

```javascript
const square = x => x * x;
```

### Multiple Parameters

```javascript
const sum = (a, b) => a + b;
```

### Multiple Statements

```javascript
const multiply = (a, b) => {
    const result = a * b;
    return result;
};
```
---

## Q27. What Is the Difference Between Function Declaration and Arrow Function?

### Function Declaration

```javascript
function add(a, b) {
    return a + b;
}
```

### Arrow Function

```javascript
const add = (a, b) => a + b;
```
---