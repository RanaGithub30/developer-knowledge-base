# How Does Parent-Child Communication Work in Vue 2?

## Answer

> "In Vue 2, parent-to-child communication is done using **props**, and child-to-parent communication is done using **events with `$emit`**."

## 1. Parent → Child: Props

The parent passes data using props:

```vue
<!-- Parent -->
<user-card :name="userName"></user-card>
```

The child receives it:

```javascript
// Child
props: ['name']
```

```text
Parent
  |
  | props
  ↓
Child
```

---

## 2. Child → Parent: `$emit`

The child sends an event to the parent using `$emit`:

```javascript
// Child
this.$emit('user-selected', this.user)
```

The parent listens for that event:

```vue
<!-- Parent -->
<user-card @user-selected="handleUser"></user-card>
```

```text
Parent
  ↑
  | $emit / event
  |
Child
```

---

## Simple Example

### Parent

```vue
<user-card
  :name="name"
  @change-name="updateName">
</user-card>
```

### Child

```javascript
props: ['name'],

methods: {
  changeName() {
    this.$emit('change-name', 'Rahul')
  }
}
```

The child doesn't directly change the parent's data. It **emits an event**, and the parent handles it.

## Simple Flow

```text
Parent → props → Child
Parent ← event ← Child
```

## Short Interview Answer

> **"In Vue 2, data flows down from parent to child through props. Events flow up from child to parent using `$emit`. So, the parent passes data with props, and the child communicates changes by emitting events."**

## Remember

**Parent → Child = Props**

**Child → Parent = `$emit` Events**
