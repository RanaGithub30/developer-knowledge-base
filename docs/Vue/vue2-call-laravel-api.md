# How Do You Call a Laravel API from Vue 2?

## Answer

> "In Vue 2, I usually call Laravel APIs using Axios. Vue sends an HTTP request to the Laravel API, Laravel processes the request and returns JSON, and Vue uses that response to update the UI."

## Simple Flow

```text
Vue 2
  ↓
Axios HTTP Request
  ↓
Laravel API
  ↓
Database
  ↓
JSON Response
  ↓
Vue 2
```

## Example

### Vue 2

```javascript
import axios from 'axios'

export default {
  data() {
    return {
      users: []
    }
  },

  mounted() {
    axios.get('/api/users')
      .then(response => {
        this.users = response.data
      })
      .catch(error => {
        console.log(error)
      })
  }
}
```

### Laravel Route

```php
Route::get('/users', [UserController::class, 'index']);
```

### Laravel Controller

```php
public function index()
{
    return response()->json(User::all());
}
```

Laravel returns JSON:

```json
[
  {
    "id": 1,
    "name": "John"
  },
  {
    "id": 2,
    "name": "Rahul"
  }
]
```

Vue receives the response and stores it in `users`.

## POST Example

```javascript
axios.post('/api/users', {
  name: 'Rahul',
  email: 'rahul@example.com'
})
.then(response => {
  console.log(response.data)
})
.catch(error => {
  console.log(error)
})
```

## With Authentication

If the Laravel API requires authentication, I would send the required authentication token with the request.

```javascript
axios.get('/api/profile', {
  headers: {
    Authorization: `Bearer ${token}`
  }
})
```

## Short Interview Answer

> **"I use Axios in Vue 2 to call Laravel APIs. Vue sends GET, POST, PUT, or DELETE requests to Laravel. Laravel processes the request, interacts with the database, and returns JSON. Vue receives that JSON response and updates the UI. For protected APIs, I also send the required authentication token."**

## Remember

**Vue 2 → Axios → Laravel API → Database → JSON → Vue**
