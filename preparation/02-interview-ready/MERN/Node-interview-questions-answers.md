# Node.js Interview — Must-Know Questions & Answers

# 1. What is Node.js? How is it different from PHP?

## Answer:

Node.js is a JavaScript runtime environment that allows us to run JavaScript outside the browser, mainly on the server side. It is built on Chrome’s V8 JavaScript engine and is commonly used to build fast, scalable web applications and APIs.

The main difference between Node.js and PHP is that Node.js uses JavaScript, while PHP is a server-side scripting language commonly used for backend development.

In terms of use cases, Node.js is popular for APIs, real-time applications, and microservices, whereas PHP is widely used for websites, content management systems like WordPress, and frameworks like Laravel.

So, both are useful for backend development. The choice depends on the project requirements, performance needs, and the existing technology stack.

# 2. What is the difference between synchronous and asynchronous programming?

## Answer:

Synchronous and asynchronous programming differ in how tasks are executed and how the program handles waiting.

Synchronous programming means tasks are executed one after another. The next task waits until the current task is completed. For example, if a function takes 5 seconds to execute, the program waits for that function to finish before moving to the next task.

Asynchronous programming allows the program to continue doing other tasks while waiting for a time-consuming operation, like an API call, to finish.

Real-life example: In synchronous execution, you wait at a restaurant counter until your order is ready before doing anything else. In asynchronous execution, you place your order, receive a token, and do other things while your food is being prepared.

In my experience as a Laravel/PHP and MERN developer, asynchronous programming is useful for API calls, background jobs, sending emails, and processing large tasks. In Laravel, we can use Queues and Jobs, while in Node.js, we use Promises and async/await.

# 3. What is the Event Loop in Node.js?

## Answer:

The Event Loop in Node.js is a mechanism that allows Node.js to handle asynchronous operations without blocking the main thread.

When Node.js executes code, synchronous tasks run first. If an asynchronous operation, such as a timer or file operation, needs to wait, Node.js can continue executing other tasks. Once the operation is ready, its callback is processed through the Event Loop when appropriate.

Example: If we call an API that takes 2 seconds to respond, Node.js can handle other tasks while waiting for the response instead of blocking the main thread.

# 4. What is the difference between callbacks, Promises and async/await?

## Answer: 

Callbacks, Promises, and async/await are three ways to handle asynchronous operations in JavaScript.
- Callback: A function passed to another function that is called when a task is completed.
- Promise: An object that represents the future result of an asynchronous operation. It can be pending, fulfilled, or rejected.
- Async/await: A simpler way to work with Promises that makes asynchronous code easier to read and understand.

# 5. What is the difference between CommonJS (require) and ES Modules (import)?

## Answer: 

CommonJS and ES Modules are two ways to import and export code between files in JavaScript.
- CommonJS: Uses require() to import and module.exports to export. It is traditionally used in Node.js.
- ES Modules (ESM): Uses import to import and export to export. It is the standard JavaScript module system used in modern JavaScript applications.

# 6. What are package.json, package-lock.json and node_modules?

## Answer:

- package.json: Contains project information, dependencies, scripts, and project configuration.
- package-lock.json: Stores the exact versions of installed dependencies so the project can install consistent versions across different environments.
- node_modules: The folder where installed packages and their dependencies are stored.