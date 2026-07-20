# Node.js Interview Question: Designing a Production-Ready File Upload System

## Question

You are designing a REST API using Node.js and Express.

A user uploads a large **500MB video file**.

The API currently receives the file and processes it before returning a response, causing:

- Request timeout
- High memory usage
- Server crashes

**How would you redesign this file upload system for a production environment?**

---

# Answer

For a **500MB video upload**, I would not process the file inside the Express request lifecycle.

First, I would generate a **pre-signed S3 upload URL** from the backend. The client uploads the video directly to S3, which reduces the load on the Node.js server and avoids memory issues.

After a successful upload, S3 can trigger an event that sends a message to a queue such as **Redis BullMQ** or **AWS SQS**.

A background worker processes the video asynchronously:

- Compression
- Format conversion
- Thumbnail generation
- Metadata extraction

The API remains fast because video processing happens in the background instead of blocking the HTTP request.

I would also implement:

- **File size validation**
- **File type validation**
- **Authentication and authorization**
- **Upload progress tracking**
- **Retry mechanism for failed processing**

This architecture improves scalability, prevents request timeouts, reduces server resource usage, and provides a more reliable production-ready upload system.