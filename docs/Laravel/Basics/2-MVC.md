## Laravel MVC

# How does Laravel follow the MVC architecture?

## Answer

Laravel follows the **Model-View-Controller (MVC)** architectural pattern by separating an application's logic into three main components:

- **Model** – Handles data and business logic.
- **View** – Handles the user interface (UI).
- **Controller** – Acts as the intermediary between the Model and the View.

This separation of concerns makes applications easier to develop, maintain, test, and scale.

---

## MVC Architecture

```text
                User Request
                     │
                     ▼
                  Route
                     │
                     ▼
               Controller
               /         \
              /           \
             ▼             ▼
         Model          View
            │              ▲
            │              │
            ▼              │
        Database ──────────┘
```

---

## 1. Model

The **Model** is responsible for interacting with the database and handling business logic.

In Laravel, models are created using **Eloquent ORM**.

Example:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'email'];
}
```

Responsibilities:
- Interact with the database
- Define relationships
- Handle business logic
- Perform CRUD operations

---

## 2. View

The **View** is responsible for displaying data to the user.

Laravel uses the **Blade** templating engine.

Example:

```blade
<h1>Welcome, {{ $user->name }}</h1>
```

Responsibilities:
- Display data
- Render HTML
- Keep presentation logic separate from business logic

---

## 3. Controller

The **Controller** receives requests, communicates with the model, and returns the appropriate response.

Example:

```php
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }
}
```

Responsibilities:
- Handle HTTP requests
- Validate user input
- Call models
- Return views or JSON responses

---

## Folder Structure

```text
app/
├── Http/
│   └── Controllers/
│       └── UserController.php
│
├── Models/
│   └── User.php
│
resources/
└── views/
    └── users/
        └── index.blade.php
```

---

## Why MVC?

- Separation of concerns
- Easier maintenance
- Better code organization
- Reusable components
- Easier testing
- Improved scalability
- Better collaboration between frontend and backend developers

---