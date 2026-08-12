# What Are Vue Components and Props?

## Answer

> "A Vue component is a reusable part of the UI, such as a button, navbar, form, or user profile. Props are used to pass data from a parent component to a child component."

## 1. What is a Component?

A component is a **reusable UI block**.

For example:

```text
App
 ├── Navbar
 ├── UserList
 │    └── UserCard
 └── Footer
```

A component can contain:

* HTML/template
* JavaScript logic
* CSS/style

Example:

```vue
<template>
  <button>Save</button>
</template>
```

We can reuse this component wherever we need a Save button.

---

## 2. What are Props?

**Props** allow a parent component to send data to a child component.

### Parent

```vue
<UserCard name="John" />
```

### Child

```vue
<script setup>
defineProps({
  name: String
})
</script>

<template>
  <h3>{{ name }}</h3>
</template>
```

The output will be:

```text
John
```

### Simple Flow

```text
Parent Component
       |
       | props
       ↓
Child Component
```

## Important Point

Props are generally **read-only in the child**.

If the child needs to change something in the parent, it can emit an **event** to the parent.

```text
Parent
  ↓ props
Child
  ↑ event
Parent
```

## Real-World Example

```vue
<UserCard
  name="Rahul"
  email="rahul@example.com"
/>
```

Here:

* `UserCard` → Component
* `name` → Prop
* `email` → Prop

## Short Interview Answer

> **"A Vue component is a reusable piece of UI. Props are a way to pass data from a parent component to a child component. Props are read-only inside the child, so if the child needs to communicate back to the parent, we normally use events."**

## Remember

**Component = Reusable UI**

**Props = Parent → Child Data**