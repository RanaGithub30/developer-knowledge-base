# Laravel Interview Question: Redis Caching Strategy

## Question

Your Laravel application has a product listing page.

Current behavior:

- Every request queries MySQL.
- Product data changes only a few times per day.
- Traffic has increased 10x.
- Database CPU is reaching 90%.

**How would you use Redis to improve performance?**

Explain:

- Caching strategy.
- Cache invalidation approach.
- Possible problems you may face.

---

# Answer

I would implement Redis using the cache-aside pattern.

When a request comes, the application first checks Redis. If the product data exists, we return it directly, reducing database load.

If it is a cache miss, we fetch data from MySQL, store the result in Redis with an appropriate TTL, and return the response.

For product updates, I would invalidate or update the cache whenever product information changes.

I would also consider cache stampede prevention, monitoring cache hit ratio, and avoiding caching frequently changing data.