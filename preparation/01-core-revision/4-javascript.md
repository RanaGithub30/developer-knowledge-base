# JavaScript Interview — 15 Last-Minute Q&A

### 1. `var` vs `let` vs `const` ⭐

* `var` → function-scoped
* `let` / `const` → block-scoped
* `let` can be reassigned
* `const` cannot be reassigned
* Prefer `const` by default, then `let`; generally avoid `var`

---

### 2. What is hoisting? ⭐

JavaScript processes declarations before executing code.

```js
console.log(x); // undefined
var x = 10;
```

`let` and `const` are also hoisted, but accessing them before declaration causes a **Temporal Dead Zone (TDZ)** error.

---

### 3. `==` vs `===`?

* `==` → allows type coercion
* `===` → checks value **and type**

```js
5 == "5"   // true
5 === "5"  // false
```

**Prefer `===`.**

---

### 4. What is a closure? ⭐

A closure is when a function remembers variables from its outer scope even after the outer function has finished.

```js
function counter() {
  let count = 0;

  return () => ++count;
}

const c = counter();

c(); // 1
c(); // 2
```

---

### 5. What is `this`?

`this` generally depends on **how a function is called**.

```js
const user = {
  name: "John",
  sayHi() {
    console.log(this.name);
  }
};

user.sayHi(); // John
```

**Arrow functions don't have their own `this`; they inherit it lexically.**

---

### 6. Arrow function vs normal function?

```js
const add = (a, b) => a + b;
```

Main differences:

* Arrow functions have **lexical `this`**
* No own `arguments`
* Cannot be used with `new`
* Shorter syntax

---

### 7. What is a Promise? ⭐

A Promise represents the eventual result of an asynchronous operation.

States:

```text
pending → fulfilled
        → rejected
```

```js
fetch("/users")
  .then(res => res.json())
  .then(data => console.log(data))
  .catch(err => console.log(err));
```

---

### 8. What is async/await?

`async/await` is a cleaner way to work with Promises.

```js
async function getUsers() {
  try {
    const res = await fetch("/users");
    const data = await res.json();
    return data;
  } catch (err) {
    console.log(err);
  }
}
```

**Important:** An `async` function always returns a Promise.

---

### 9. Explain the Event Loop. ⭐

JavaScript executes synchronous code on the **call stack**.

Async operations are handled by the runtime, and their callbacks are queued for execution.

Simplified:

```text
Call Stack
    ↓
Runtime APIs
    ↓
Queues
    ↓
Event Loop
    ↓
Call Stack
```

**Important interview point:** Promise callbacks (microtasks) generally run before the next regular task such as a timer callback.

---

### 10. `map()` vs `filter()` vs `reduce()`?

```js
// map → transform
[1, 2, 3].map(x => x * 2);
// [2, 4, 6]

// filter → select
[1, 2, 3].filter(x => x > 1);
// [2, 3]

// reduce → combine
[1, 2, 3].reduce((sum, x) => sum + x, 0);
// 6
```

**Easy memory:**
`map = modify`, `filter = select`, `reduce = accumulate`

---

### 11. What is the difference between `null` and `undefined`?

* `undefined` → value is missing/not assigned
* `null` → intentional absence of a value

```js
let a;
let b = null;
```

---

### 12. Spread vs Rest operator?

Both use `...`.

**Spread → expands**

```js
const a = [1, 2];
const b = [...a, 3];
```

**Rest → collects**

```js
function sum(...nums) {
  return nums;
}
```

---

### 13. `call()` vs `apply()` vs `bind()`?

All can control `this`.

```js
fn.call(obj, 1, 2);
fn.apply(obj, [1, 2]);

const newFn = fn.bind(obj);
newFn(1, 2);
```

Remember:

```text
call  → arguments separately
apply → arguments as an array
bind  → returns a new function
```

---

### 14. Debouncing vs Throttling?

**Debouncing:** Run after the user stops triggering an event.

Example: **search input**

**Throttling:** Limit how often a function can run.

Example: **scroll/resize**

```text
Debounce  → wait for silence
Throttle  → limit frequency
```

---

### 15. What is shallow copy vs deep copy?

**Shallow copy:** Nested objects are still shared.

```js
const copy = { ...user };
```

**Deep copy:** Nested data is independently copied.

```js
const copy = structuredClone(user);
```

---

# ⚡ 2-Minute Revision

```text
var/let/const → scope + reassignment

Hoisting → declarations processed before execution

=== → strict equality

Closure → function remembers outer scope

this → depends on invocation
Arrow → lexical this

Promise → async result
async/await → Promise syntax

Event Loop → handles async callbacks
Microtasks → generally before next task

map → transform
filter → select
reduce → accumulate

null → intentional empty value
undefined → missing/unassigned

spread → expand
rest → collect

call → separate args
apply → array args
bind → new function

debounce → wait until activity stops
throttle → limit frequency

shallow → nested references shared
deep → nested data copied
```

### 🎯 If you can only study 5:

**Closure → `var/let/const` → Promise/async-await → Event Loop → `this` + Arrow Functions**
