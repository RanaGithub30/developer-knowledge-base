# Laravel Service Container

## Table of Contents

- [Introduction](#introduction)
- [Dependency Injection Example](#dependency-injection-example)
- [Automatic Resolution of Classes](#automatic-resolution-of-classes-in-laravel-service-container)
- [Example](#example)
- [Injecting Service into Route](#injecting-service-into-route)
- [How It Works](#how-it-works)
- [Binding in Laravel Service Container](#binding-in-laravel-service-container)
- [Creating a Binding](#creating-a-binding)
- [Injecting the Dependency](#injecting-the-dependency)
- [Binding Methods](#binding-methods)
  - [bind()](#bind)
  - [singleton()](#singleton)
  - [Simple Difference](#simple-difference)
- [make() Method in Laravel Service Container](#make-method-in-laravel-service-container)
  - [Example](#example-1)
  - [Using make() with Binding](#using-make-with-binding)
  - [Difference Between make() and new Keyword](#difference-between-make-and-new-keyword)
- [Summary](#summary)
---

## Introduction

The Laravel **service container** is a powerful tool for managing class dependencies and performing dependency injection.

**Dependency injection** means class dependencies are "injected" into the class via the constructor or, in some cases, "setter" methods.

---

## Dependency Injection Example

```php
<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    /**
     * Create a new controller instance.
     */

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function profile()
    {
        return $this->userService->profile();
    }
}
```

In this example, the `UserController` needs to retrieve user profile data. So, we inject a `UserService` that contains the logic required to handle user-related operations.

Since the service is injected through Laravel's service container, the controller remains focused only on handling requests and responses. This also makes the application easier to test because we can replace the `UserService` with a mock or dummy implementation when testing the controller.

---

## Automatic Resolution of Classes in Laravel Service Container

Laravel's service container can automatically resolve classes when they do not have any dependencies or when they only depend on other concrete classes.

In such cases, we do not need to manually register the class in the service container. Laravel uses **Reflection** to understand the class requirements and creates an object automatically.

---

## Example

Create a simple `UserService` class.

### UserService.php

```php
<?php

namespace App\Services;

class UserService
{
    public function profile()
    {
        return "User profile data";
    }
}
```

The `UserService` class does not depend on any other class, so Laravel can automatically create an instance of it.

---

## Injecting Service into Route

In `routes/web.php`:

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Services\UserService;

Route::get('/profile', function (UserService $userService) {
    return $userService->profile();
});
```

---

## How It Works

When Laravel sees:

```php
UserService $userService
```

it automatically resolves the dependency and creates an instance of `UserService`.

Internally, Laravel does something similar to:

```php
$userService = new UserService();
```

Then it passes the created object to the route function.

---

## Binding in Laravel Service Container

Laravel's service container allows us to define how classes should be created using **bindings**.

Binding is required when Laravel cannot automatically resolve a class, such as when a class depends on an **interface** or when we want to control how an object is created.

---

## Example

Suppose we have a `UserRepository` interface.

### UserRepository.php

```php
<?php

namespace App\Contracts;

interface UserRepository
{
    public function getUser();
}
```

Now create a class that implements this interface.

### DatabaseUserRepository.php

```php
<?php

namespace App\Repositories;

use App\Contracts\UserRepository;

class DatabaseUserRepository implements UserRepository
{
    public function getUser()
    {
        return "User data from database";
    }
}
```

The interface does not tell Laravel which class it should create. Therefore, we need to define a binding.

---

## Creating a Binding

Add the binding in `App\Providers\AppServiceProvider.php`:

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\UserRepository;
use App\Repositories\DatabaseUserRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            UserRepository::class,
            DatabaseUserRepository::class
        );
    }
}
```

This tells Laravel:

> Whenever `UserRepository` is requested, provide an instance of `DatabaseUserRepository`.

---

## Injecting the Dependency

Now we can inject the interface anywhere:

### UserController.php

```php
<?php

namespace App\Http\Controllers;

use App\Contracts\UserRepository;

class UserController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function profile()
    {
        return $this->repository->getUser();
    }
}
```

---

## How It Works

When Laravel sees:

```php
UserRepository $repository
```

it checks the service container.

The container finds the binding:

```
UserRepository
        |
        ↓
DatabaseUserRepository
```

and automatically creates and injects the required object.

---

## Binding Methods

Laravel provides two common methods for registering classes in the service container:

- `bind()`
- `singleton()`

The main difference is how many objects Laravel creates when the class is requested.

---

### bind()

The `bind()` method creates a **new object every time** we ask Laravel for that class.

Example:

```php
$this->app->bind(
    UserRepository::class,
    DatabaseUserRepository::class
);
```

Now, whenever we request `UserRepository`:

```php
$service1 = app(UserRepository::class);
$service2 = app(UserRepository::class);
```

Laravel creates two separate objects:

```
Request 1  →  New DatabaseUserRepository object ($service1)

Request 2  →  New DatabaseUserRepository object ($service2)
```

So:

```php
$service1 !== $service2
```

Both objects work independently.

**Use `bind()` when you need a fresh object every time.**

---

### singleton()

The `singleton()` method creates an object **only once** and reuses the same object whenever it is requested again.

Example:

```php
$this->app->singleton(
    UserRepository::class,
    DatabaseUserRepository::class
);
```

Now:

```php
$service1 = app(UserRepository::class);
$service2 = app(UserRepository::class);
```

Laravel creates only one object:

```
First request  →  Create DatabaseUserRepository object ($service1)

Second request →  Use the same object ($service2)
```

So:

```php
$service1 === $service2
```

Both variables point to the same object.

**Use `singleton()` when you want to share the same object throughout the application.**

---

### Simple Difference

| Method | Object Creation |
|--------|----------------|
| `bind()` | Creates a new object every time |
| `singleton()` | Creates one object and reuses it |

Example:

- `bind()` → Like buying a new notebook every time you need one.
- `singleton()` → Like using the same notebook throughout the day.


## make() Method in Laravel Service Container

The `make()` method is used to **create and retrieve an instance of a class from Laravel's service container**.

It tells Laravel:

> "Give me an object of this class."

Laravel will check the service container and create the required object automatically.

---

### Example

Suppose we have a `UserService` class:

```php
<?php

namespace App\Services;

class UserService
{
    public function profile()
    {
        return "User profile data";
    }
}
```

We can create an instance using the `make()` method:

```php
$userService = app()->make(UserService::class);

return $userService->profile();
```

Laravel will create an object of `UserService`:

```php
$userService = new UserService();
```

and return it.

---

### Using make() with Binding

If a class has a binding in the service container:

```php
$this->app->bind(
    UserRepository::class,
    DatabaseUserRepository::class
);
```

We can resolve it using `make()`:

```php
$repository = app()->make(UserRepository::class);

return $repository->getUser();
```

Laravel will look for the binding:

```
UserRepository
        |
        ↓
DatabaseUserRepository
```

and create an instance of `DatabaseUserRepository`.

---

### Difference Between make() and new Keyword

Using PHP `new`:

```php
$userService = new UserService();
```

- PHP directly creates the object.
- Laravel's service container is not involved.

Using `make()`:

```php
$userService = app()->make(UserService::class);
```

- Laravel creates the object.
- Laravel can automatically inject dependencies.
- Laravel uses container bindings if available.

---

# Summary

- The **Laravel service container** manages class dependencies and automatically resolves objects.
- **Dependency injection** allows required classes to be provided automatically instead of creating them manually.
- Classes with no dependencies or only concrete class dependencies can be resolved automatically by Laravel.
- **Binding** is required when Laravel needs instructions on how to create a class, especially when working with interfaces.
- Binding connects an interface with its concrete implementation.
- The `bind()` method creates a new instance every time the class is requested.
- The `singleton()` method creates one shared instance and reuses it for future requests.
- Service containers make applications easier to maintain by reducing tight coupling between classes.
- Dependency injection improves testability because dependencies can easily be replaced with mock implementations.
- Using the service container helps keep business logic separate from controllers and improves the overall structure of a Laravel application.
- `make()` is used to manually resolve a class from Laravel's service container.
- It creates and returns an instance of the requested class.
- It works with both automatically resolved classes and registered bindings.
- It is useful when you need to create a service dynamically instead of injecting it through a constructor.