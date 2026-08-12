# What are `v-model`, `v-if` and `v-for`?

These are common **Vue directives** used in Vue 2.

## 1. `v-model`

`v-model` is used for **two-way data binding**, mainly with form inputs.

```vue
<input v-model="name">
```

If the user types:

```text
Rahul
```

The `name` variable automatically becomes:

```text
name = "Rahul"
```

### Simple Meaning

**`v-model` = Input ↔ Data**

---

## 2. `v-if`

`v-if` is used to **conditionally display an element**.

```vue
<p v-if="isLoggedIn">
  Welcome!
</p>
```

If `isLoggedIn` is `true`, the element is shown.

If it is `false`, the element is not rendered.

### Simple Meaning

**`v-if` = Show/Hide based on condition**

---

## 3. `v-for`

`v-for` is used to **loop through a list**.

```vue
<ul>
  <li v-for="user in users" :key="user.id">
    {{ user.name }}
  </li>
</ul>
```

If `users` contains:

```javascript
[
  { id: 1, name: 'John' },
  { id: 2, name: 'Rahul' }
]
```

Vue displays:

```text
John
Rahul
```

### Simple Meaning

**`v-for` = Loop through data**

---

## Quick Comparison

| Directive | Purpose               | Example                      |
| --------- | --------------------- | ---------------------------- |
| `v-model` | Two-way data binding  | `<input v-model="name">`     |
| `v-if`    | Conditional rendering | `<div v-if="loggedIn">`      |
| `v-for`   | Loop through data     | `<li v-for="user in users">` |

## Short Interview Answer

> **"`v-model` is used for two-way data binding, especially with form inputs. `v-if` is used for conditional rendering, and `v-for` is used to loop through arrays or lists and render multiple elements."**

## Remember

**`v-model` → Bind**

**`v-if` → Condition**

**`v-for` → Loop**