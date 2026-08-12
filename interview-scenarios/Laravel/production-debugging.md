# How do you debug a production issue in Laravel?

## Details

When debugging a production issue in **Laravel**, I follow a systematic approach:

1. **Understand the issue**

   * Check what users are experiencing.
   * Identify when the issue started and whether it affects all users or specific users.

2. **Check Laravel logs**

   * Check `storage/logs/laravel.log`.
   * Look for exceptions, stack traces, database errors, and timestamps.

3. **Check server logs**

   * Check Nginx/Apache logs.
   * Check PHP-FPM, queue worker, and system logs if required.

4. **Check recent changes**

   * Review recent deployments.
   * Check configuration changes, database migrations, and dependency updates.

5. **Check database and queues**

   * Investigate database connection issues and slow queries.
   * Check failed queue jobs using:

     ```bash
     php artisan queue:failed
     ```

6. **Reproduce the issue safely**

   * Try to reproduce the problem in a staging environment.
   * Avoid making risky changes directly in production.

7. **Fix and verify**

   * Identify the root cause.
   * Apply the smallest safe fix.
   * Test the fix and deploy it carefully.
   * Monitor the application after deployment.

## Interview-Friendly Answer

> **"When I debug a production issue in Laravel, I first understand the impact and identify when the issue started. Then I check Laravel and server logs for exceptions, stack traces, and database errors. I also check recent deployments, configuration changes, queues, and database issues. If possible, I reproduce the issue in staging instead of making direct changes in production. Once I identify the root cause, I apply a minimal and safe fix, test it, deploy it carefully, and monitor the application to make sure the issue is completely resolved."**