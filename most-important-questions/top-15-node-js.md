# Node.js Interview Q&A

## 1. What is Node.js?

Node.js is a **JavaScript runtime built on Chrome's V8 engine** that allows us to run JavaScript outside the browser. It is mainly used for building APIs, web servers, and real-time applications.

---

## 2. Why is Node.js called non-blocking?

Node.js is called non-blocking because **I/O operations don't block the main JavaScript thread**. It starts the operation and continues executing other code, then handles the result when it is ready.

---

## 3. Explain the Node.js Event Loop.

The Event Loop is responsible for **handling asynchronous operations** in Node.js. It continuously checks for completed operations and executes their callbacks when the JavaScript thread is available.

---

## 4. What is asynchronous programming?

Asynchronous programming means **starting an operation without waiting for it to finish**. The application can continue doing other work while waiting for the result.

---

## 5. Callback vs Promise vs async/await?

* **Callback:** A function executed after an operation completes.
* **Promise:** Represents the future result of an asynchronous operation.
* **async/await:** A cleaner and easier-to-read way of working with Promises.

```js
async function getData() {
  const data = await fetchData();
}
```

---

## 6. What happens when you use `await`?

`await` **pauses the execution of the current async function** until the Promise settles. It does not block the Node.js main thread.

```js
const result = await getData();
```

---

## 7. Difference between synchronous and asynchronous code?

**Synchronous code** waits for each operation to complete before moving to the next.

**Asynchronous code** starts an operation and allows other code to execute while waiting for the result.

---

## 8. What is EventEmitter?

`EventEmitter` is a Node.js class used to **create, emit, and listen for events**.

```js
emitter.on("login", handler);
emitter.emit("login");
```

It is commonly used by Node.js APIs such as streams.

---

## 9. Difference between `process.nextTick()` and `setImmediate()`?

`process.nextTick()` runs the callback **before the event loop continues to its next phase**.

`setImmediate()` runs the callback in the **check phase of the event loop**.

**Short answer:** `nextTick()` generally has higher scheduling priority than `setImmediate()`.

---

## 10. What are streams?

Streams allow us to **process data in small chunks instead of loading everything into memory at once**.

They are useful for large files, HTTP requests, video, and other large data sources.

---

## 11. What is a Buffer?

A Buffer is a Node.js object used to **store and manipulate raw binary data**, such as file contents, images, and network data.

```js
const buffer = Buffer.from("Hello");
```

---

## 12. CommonJS vs ES Modules?

**CommonJS** uses `require()` and `module.exports`.

```js
const express = require("express");
```

**ES Modules** use `import` and `export`.

```js
import express from "express";
```

ES Modules are the standard JavaScript module system.

---

## 13. What is npm?

npm stands for **Node Package Manager**. It is used to install and manage packages, dependencies, and project scripts.

Example:

```bash
npm install express
```

---

## 14. `package.json` vs `package-lock.json`?

`package.json` contains **project information, scripts, and dependency declarations**.

`package-lock.json` records the **exact resolved dependency versions and dependency tree**.

**Short answer:** `package.json` defines what we need; `package-lock.json` locks what was actually installed.

---

## 15. How do you manage environment variables?

We use environment variables to store **configuration and sensitive values outside the source code**.

```js
const port = process.env.PORT || 3000;
```

They can be provided through the environment or a `.env` file. Sensitive `.env` files should not be committed to Git.

---

# ⭐ One-Line Revision

| Question              | Interview Answer                          |
| --------------------- | ----------------------------------------- |
| Node.js               | JavaScript runtime built on V8            |
| Non-blocking          | I/O doesn't block the main thread         |
| Event Loop            | Handles asynchronous operations           |
| Async programming     | Work continues without waiting            |
| Callback              | Function called after an operation        |
| Promise               | Represents future async result            |
| async/await           | Cleaner syntax for Promises               |
| `await`               | Pauses the async function, not the thread |
| Sync vs Async         | Sync waits; async doesn't                 |
| EventEmitter          | Used to handle events                     |
| `nextTick`            | Runs with very high scheduling priority   |
| `setImmediate`        | Runs in the check phase                   |
| Streams               | Process data chunk by chunk               |
| Buffer                | Handles raw binary data                   |
| CommonJS              | `require` / `module.exports`              |
| ES Modules            | `import` / `export`                       |
| npm                   | Manages Node.js packages                  |
| `package.json`        | Project/dependency definition             |
| `package-lock.json`   | Locks resolved dependency versions        |
| Environment variables | Manage configuration outside code         |
