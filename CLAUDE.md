# Backend Development Guidelines (Laravel)

## Architecture
- Follow **Clean Code** and **SOLID** principles.
- Use a layered architecture:
  - Controllers
  - Services
  - Models
  - Resources
  - Requests
  - Jobs
  - Notifications
  - Enums
- Keep Controllers thin. Business logic belongs inside Services.
- Never place business logic inside Controllers or Models.

---

# Database

## Migrations
- Create a separate migration for **every table**.
- Never combine multiple tables into one migration.
- Use proper foreign keys with cascading rules.
- Add indexes where appropriate.
- Use soft deletes when needed.
- Always use timestamps.

Every table must have:
- Migration
- Model
- Relationships

---

# Models

For every table create:

- Model
- Relationships
- Fillable properties
- Casts
- Scopes (when useful)

Always define relationships correctly.

Examples:

- hasOne
- hasMany
- belongsTo
- belongsToMany
- morphOne
- morphMany
- morphTo

Avoid duplicated relationship logic.

---

# Enums

Use PHP Enums whenever appropriate.

Examples:

- UserStatus
- OrderStatus
- PaymentStatus
- Gender
- NotificationType
- SubscriptionStatus

Never hardcode status strings.

Good:

```php
UserStatus::ACTIVE
```

Bad:

```php
"active"
```

---

# Validation

Always use Form Requests.

Examples:

- StoreUserRequest
- UpdateUserRequest

Never validate directly inside Controllers.

---

# API

The backend is built specifically for a Vue.js frontend.

Use:

- API Controllers
- API Resources
- Resource Collections

Never return raw Eloquent models.

Always return a consistent JSON structure.

Success:

```json
{
  "success": true,
  "message": "User created successfully.",
  "data": {}
}
```

Error:

```json
{
  "success": false,
  "message": "Validation failed.",
  "errors": {}
}
```

Use proper HTTP status codes.

---

# Resources

Always use Laravel API Resources.

Examples:

- UserResource
- ProductResource
- OrderResource

Never expose hidden or sensitive fields.

---

# Services

Every business process belongs inside a Service.

Examples:

- UserService
- OrderService
- PaymentService
- NotificationService

Controllers should only:

- Validate request
- Call service
- Return resource

---

# Authentication

Use Laravel Sanctum for API authentication unless otherwise specified.

---

# Roles & Permissions

Use **Spatie Laravel Permission**.

Requirements:

- Roles
- Permissions
- Middleware

Never build a custom role system.

---

# Queues & Jobs

Use Queue Jobs whenever work should run asynchronously.

Examples:

- Sending emails
- Notifications
- Image processing
- File uploads
- PDF generation
- Reports
- Import/Export
- Third-party API calls
- Long-running tasks

Do not create Jobs unnecessarily—only when they provide real performance or scalability benefits.

---

# Notifications

Use Laravel Notifications when appropriate.

Support:

- Mail
- Database
- Broadcast (if required)

---

# File Storage

Use Laravel Storage.

Never manipulate filesystem paths manually.

---

# Caching

Use caching where it provides clear performance benefits.

Examples:

- Settings
- Dashboard statistics
- Frequently accessed data

---

# Pagination

Always paginate API collections.

Never return thousands of records in a single response.

---

# Query Optimization

Avoid N+1 queries.

Use eager loading whenever appropriate.

Examples:

```php
with()
load()
```

Optimize queries for performance.

---

# Error Handling

Use proper exception handling.

Return standardized API responses.

Never expose stack traces or internal errors.

---

# Logging

Log only meaningful events.

Examples:

- Failed payments
- External API failures
- Critical application errors

Avoid unnecessary logging.

---

# Naming Conventions

Use singular names for Models.

Examples:

- User
- Order
- Product

Use plural names for database tables.

Examples:

- users
- orders
- products

---

# Folder Structure

```
app/
├── Enums
├── Http/
│   ├── Controllers/API
│   ├── Requests
│   └── Resources
├── Jobs
├── Models
├── Notifications
└── Services
```

---

# Frontend Compatibility

The backend is designed for a Vue.js frontend.

Requirements:

- RESTful APIs
- Consistent JSON responses
- API Resources
- Proper HTTP status codes
- Pagination
- Filtering
- Searching
- Sorting

---

# General Rules

For every feature, generate only what is necessary:

- Migration
- Model
- Relationships
- Form Request
- API Controller
- API Resource
- Service
- Routes
- Job (only if needed)
- Notification (only if needed)
- Enum (when applicable)

Use dependency injection.

Follow PSR-12 coding standards.

Write clean, maintainable, scalable, and production-ready Laravel code.

Always think like a senior Laravel architect before generating code.
