# Node.js API Debugging – Question & Answer

## Question

**You are debugging a Node.js API.**

Current behavior:

- The API becomes slow.
- CPU usage stays low.
- Memory keeps increasing until the server crashes.

**How would you investigate and fix this issue?**

---

## Answer

This sounds like a memory leak or poor resource handling. Since CPU is low, I would focus on memory growth, event loop delays, and slow I/O.

I would:

1. Monitor memory usage, GC behavior, and event loop lag.
2. Take heap snapshots to find objects that are not being released.
3. Check for common causes like global arrays, unbounded cache, event listener leaks, or leaked database connections.
4. Fix the root cause and test again under load.

Example:

```javascript
setInterval(() => {
    console.log(process.memoryUsage());
}, 10000);
```

Common fixes:

- Remove unused references.
- Use TTL-based caching.
- Remove event listeners after use.
- Release database connections properly.
- Use pagination instead of loading everything into memory.

In short, I would investigate the memory pattern, identify the leak, fix the underlying cause, and verify that memory stays stable after the change.