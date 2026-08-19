# Interview Scenarios

This folder contains **real-world engineering, debugging, production, architecture, and project-based scenarios**.

The purpose is to prepare for questions that test how I think and solve problems rather than simply testing definitions.

## 🎯 Purpose

- Improve practical problem-solving
- Prepare for senior-level interviews
- Develop structured debugging approaches
- Improve production troubleshooting skills
- Connect theoretical knowledge with real projects

## 📚 Scenario Categories

### Production & Debugging

Examples:

- Production website is down
- Laravel application returns 500 errors
- API suddenly becomes slow
- Database query becomes extremely slow
- Server CPU/memory usage is high
- Queue jobs are failing

### Laravel

Examples:

- Laravel application is slow
- N+1 query problem in production
- Queue backlog is increasing
- Cache is not behaving correctly
- Authentication issue after deployment

### Database

Examples:

- Slow MySQL query
- Missing/incorrect indexes
- Deadlocks
- Large table performance problems
- Database connection exhaustion

### API

Examples:

- API response time suddenly increases
- Third-party API is unavailable
- API rate limiting
- Duplicate requests
- Idempotency problems

### Architecture & Scaling

Examples:

- Application receives 10x traffic
- How to scale a Laravel application
- Redis caching strategy
- Queue-based architecture
- Horizontal scaling

### Project

Questions related to my own projects:

- Why was a particular technology selected?
- What was the hardest technical problem?
- How was it solved?
- What would I change now?
- How would I scale the system?

## 🧠 Scenario Answer Framework

Use this structure whenever possible:

### 1. Clarify

Understand the problem and scope.

### 2. Reproduce

Try to reproduce the issue if possible.

### 3. Observe

Check:

- Logs
- Metrics
- Database
- Server
- Network
- Application behaviour

### 4. Identify

Find the actual root cause.

### 5. Fix

Implement the safest appropriate solution.

### 6. Verify

Confirm that the issue is actually resolved.

### 7. Prevent

Add monitoring, tests, alerts, documentation, or architectural improvements.

## 🎤 Interview Rule

Do not memorize scenario answers.

Instead, practice explaining:

> **What I would check → Why I would check it → What I expect to find → What I would do next**

## ⭐ Priority

Scenario questions should receive higher priority when they:

- Match my real experience
- Appear frequently in interviews
- Test multiple concepts
- Require debugging
- Involve production systems
- Test senior-level decision making

## 🔗 Related Sections

- [Core Revision](../01-core-revision/README.md)
- [Interview Ready](../02-interview-ready/README.md)
- [Project](../06-project/README.md)
- [Mistakes](../07-mistakes/README.md)