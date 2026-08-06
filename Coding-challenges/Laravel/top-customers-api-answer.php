<?php

/**
 * ==========================================
 * Laravel Backend Interview Question
 * ==========================================
 *
 * Database Tables
 *
 * orders
 * +----+---------+--------------+-----------+
 * | id | user_id | total_amount | status    |
 * +----+---------+--------------+-----------+
 * | 1  |    1    |     500      | completed |
 * | 2  |    1    |     700      | pending   |
 * | 3  |    2    |     900      | completed |
 * +----+---------+--------------+-----------+
 *
 * users
 * +----+-------+
 * | id | name  |
 * +----+-------+
 * | 1  | John  |
 * | 2  | Alex  |
 * +----+-------+
 *
 * ------------------------------------------------------
 * API Requirement
 * ------------------------------------------------------
 *
 * Endpoint:
 * GET /api/users/top-customers
 *
 * Return only users who have completed orders.
 *
 * Expected Response:
 *
 * [
 *     {
 *         "id": 1,
 *         "name": "John",
 *         "total_orders": 1,
 *         "total_spent": 500
 *     },
 *     {
 *         "id": 2,
 *         "name": "Alex",
 *         "total_orders": 1,
 *         "total_spent": 900
 *     }
 * ]
 *
 * Sort the result by:
 * - total_spent DESC
 *
 * ------------------------------------------------------
 * Your Task
 * ------------------------------------------------------
 *
 * Write the following:
 *
 * 1. User model relationship.
 *
 * 2. Controller method.
 *
 * 3. An optimized Eloquent or Query Builder query that:
 *    - Returns only users with completed orders.
 *    - Calculates:
 *        - total_orders
 *        - total_spent
 *    - Sorts by total_spent in descending order.
 *
 * 4. Explain how your solution avoids the N+1 query problem.
 *
 * 5. List the database indexes you would create to optimize
 *    this endpoint for large datasets.
 *
 * 6. Mention the high-level Time Complexity of your approach.
 *
 * 7. Explain why your solution is production-ready for
 *    millions of records.
 *
 * Bonus (Optional):
 * - Add pagination.
 * - Discuss caching strategy.
 * - Explain whether Eloquent or Query Builder is preferable
 *   for this endpoint and why.
 */

/**
 * ==========================================
 * Answer
 * ==========================================
 */

/**
 * ------------------------------------------
 * 1. User Model Relationship
 * ------------------------------------------
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}


/**
 * ------------------------------------------
 * 2. Controller Method
 * ------------------------------------------
 */

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function topCustomers()
    {
        $users = User::whereHas('orders', function ($query) {
                $query->where('status', 'completed');
            })
            ->withCount([
                'orders as total_orders' => function ($query) {
                    $query->where('status', 'completed');
                }
            ])
            ->withSum([
                'orders as total_spent' => function ($query) {
                    $query->where('status', 'completed');
                }
            ], 'total_amount')
            ->select('id', 'name')
            ->orderByDesc('total_spent')
            ->get();

        return response()->json($users);
    }
}


/**
 * ------------------------------------------
 * 3. API Route
 * ------------------------------------------
 */

// routes/api.php

use App\Http\Controllers\UserController;

Route::get('/users/top-customers', [UserController::class, 'topCustomers']);


/**
 * ------------------------------------------
 * 4. Optimized Query
 * ------------------------------------------
 *
 * SELECT
 *      users.id,
 *      users.name,
 *      COUNT(orders.id) AS total_orders,
 *      SUM(orders.total_amount) AS total_spent
 * FROM users
 * JOIN orders
 *      ON users.id = orders.user_id
 * WHERE orders.status = 'completed'
 * GROUP BY users.id, users.name
 * ORDER BY total_spent DESC;
 */


/**
 * ------------------------------------------
 * 5. How N+1 Problem is Avoided
 * ------------------------------------------
 *
 * ❌ Bad:
 *
 * foreach ($users as $user) {
 *     $user->orders;
 * }
 *
 * This executes one query for users and one extra query
 * for every user.
 *
 * ✅ Good:
 *
 * We use a single JOIN with GROUP BY.
 * Everything is fetched in one database query.
 *
 * Total Queries = 1
 */


/**
 * ------------------------------------------
 * 6. Database Indexes
 * ------------------------------------------
 *
 * users
 * -----
 * PRIMARY KEY (id)
 *
 * orders
 * ------
 * PRIMARY KEY (id)
 * INDEX(user_id)
 * INDEX(status)
 * INDEX(user_id, status)
 *
 * These indexes speed up:
 * - JOIN
 * - WHERE status='completed'
 * - GROUP BY user_id
 */


/**
 * ------------------------------------------
 * 7. Time Complexity
 * ------------------------------------------
 *
 * Let:
 * U = Number of users
 * O = Number of orders
 *
 * Query Complexity:
 *
 * O(O)
 *
 * Database scans the orders table once
 * and groups the records efficiently using indexes.
 */


/**
 * ------------------------------------------
 * 8. Why Production Ready
 * ------------------------------------------
 *
 * ✅ Only one SQL query
 *
 * ✅ Uses database aggregation
 *
 * ✅ No N+1 problem
 *
 * ✅ Proper indexes improve JOIN and WHERE performance
 *
 * ✅ Database performs COUNT() and SUM()
 *    instead of PHP loops
 *
 * ✅ Can easily add pagination:
 *
 * ->paginate(20);
 *
 * ✅ Can cache results:
 *
 * Cache::remember(
 *     'top-customers',
 *     600,
 *     fn() => $query->get()
 * );
 *
 * ✅ Works efficiently even with millions of records.
 */


/**
 * ------------------------------------------
 * Expected JSON Response
 * ------------------------------------------
 *
 * [
 *     {
 *         "id": 2,
 *         "name": "Alex",
 *         "total_orders": 1,
 *         "total_spent": 900
 *     },
 *     {
 *         "id": 1,
 *         "name": "John",
 *         "total_orders": 1,
 *         "total_spent": 500
 *     }
 * ]
 */