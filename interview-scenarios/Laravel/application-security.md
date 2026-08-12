# How do you secure a Laravel application?

## Details

To secure a Laravel application, I follow multiple security practices:

1. **Authentication & Authorization**

   * Use Laravel authentication mechanisms.
   * Use **Gates and Policies** to control access to resources.
   * Never rely only on frontend checks for authorization.

2. **CSRF Protection**

   * Laravel provides built-in CSRF protection.
   * Use `@csrf` in forms to prevent Cross-Site Request Forgery attacks.

3. **SQL Injection Protection**

   * Use Laravel's **Eloquent ORM** or Query Builder with parameter binding.
   * Avoid building SQL queries by directly concatenating user input.

4. **XSS Protection**

   * Use Blade's escaped output:

     ```blade
     {{ $user->name }}
     ```
   * Be careful when using `{!! !!}` because it outputs unescaped HTML.

5. **Input Validation**

   * Validate and sanitize user input using Laravel Form Requests or validation rules.
   * Never trust data received from users.

6. **Secure Passwords**

   * Store passwords using Laravel's hashing mechanisms such as `Hash::make()`.
   * Never store plain-text passwords.

7. **Environment & Configuration Security**

   * Never commit `.env` files or secrets to Git.
   * Set:

     ```env
     APP_ENV=production
     APP_DEBUG=false
     ```
   * Keep API keys, database credentials, and other secrets outside the source code.

8. **Secure File Uploads**

   * Validate file type, size, and extension.
   * Generate safe filenames instead of trusting user-provided filenames.
   * Store sensitive uploads outside the public directory when possible.

9. **HTTPS & Secure Cookies**

   * Use HTTPS in production.
   * Configure secure, HTTP-only, and appropriate SameSite cookies.

10. **Keep Laravel & Dependencies Updated**

    * Regularly update Laravel and Composer dependencies.
    * Monitor dependencies for known security vulnerabilities.

## Interview-Friendly Answer

> **"I secure a Laravel application using multiple layers. I use Laravel's authentication, Gates and Policies for authorization, CSRF protection for forms, and validation for all user input. For database queries, I use Eloquent or parameter binding to prevent SQL injection, and I use Blade's escaped output to prevent XSS. I hash passwords securely, keep secrets in environment variables, disable debug mode in production, use HTTPS and secure cookies, validate file uploads, and keep Laravel and Composer dependencies updated. I also follow the principle of least privilege and avoid exposing sensitive information in logs or error responses."**
