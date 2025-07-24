# 🧪 Awesomic Task Manager API

This is a sample Laravel 12 project built as part of a technical task for Awesomic. It follows best practices for modern Laravel development, including API documentation, testing, containerization, and database setup.

## 🚀 Features

- Laravel 12 with Sail (Docker-based local environment)
- Fully tested RESTful API
- OpenAPI documentation using `l5-swagger`
- Modular route documentation (clean controller architecture)
- Database migrations & seeders

## 🛠️ Stack

- PHP 8.3
- Laravel 12
- Laravel Sail (Docker)
- PostgreSQL
- PHPUnit
- l5-swagger / Swagger UI

---

## 📦 Getting Started

### 1. Clone the repo

```bash
git clone https://github.com/your-username/awesomic-task.git
cd awesomic-task-manager
```

### 2. Copy .env

```bash
cp .env.example .env
```

You can keep the defaults if you’re using Sail.

### 3. Start Laravel Sail

```bash
./vendor/bin/sail up -d
```

If you’re using Windows:

```bash
vendor\bin\sail up -d
```

### 4. Install dependencies

```bash
./vendor/bin/sail composer install
```

### 5. Generate app key

```bash
./vendor/bin/sail artisan key:generate
```

### 6. Run migrations & seeders

```bash
./vendor/bin/sail artisan migrate --seed
```

## 🧪 Running Tests

```bash
./vendor/bin/sail test
```

All endpoints are covered with feature tests.

## 📚 API Documentation

The project uses Swagger UI via the [l5-swagger](https://github.com/DarkaOnLine/L5-Swagger) package.

After running the server, access the documentation at:

```bash
http://localhost/api/documentation
```

All routes are documented using separate OpenAPI PHP files to keep controllers clean.

## 📬 Sample API Requests

### ✅ Create a Task

```http
POST /api/tasks
```

Request:

```bash
curl -X POST http://localhost/api/tasks \
  -H "Content-Type: application/json" \
  -d '{
        "title": "Prepare Awesomic Task",
        "description": "Complete the technical assignment",
        "status": "pending"
      }'
```

Response:

```json
{
  "data": {
    "id": 1,
    "title": "Prepare Awesomic Task",
    "description": "Complete the technical assignment",
    "status": "pending",
    "created_at": "...",
    "updated_at": "..."
  }
}
```

### 📋 List All Tasks

```http
GET /api/tasks
```

Request:

```bash
curl -X GET http://localhost/api/tasks
```

Response:

```json
{
  "data": [
    {
      "id": 1,
      "title": "Prepare Awesomic Task",
      "description": "Complete the technical assignment",
      "status": "pending",
      "created_at": "...",
      "updated_at": "..."
    }
  ]
}
```

### 🔍 Get a Single Task

Endpoint:

```http
GET /api/tasks/{id}
```

Request:

```bash
curl -X GET http://localhost/api/tasks/1
```

Response:

```json
{
  "data": {
    "id": 1,
    "title": "Prepare Awesomic Task",
    "description": "Complete the technical assignment",
    "status": "pending",
    "created_at": "...",
    "updated_at": "..."
  }
}
```

### ✏️ Update a Task

Endpoint:

```http
PUT /api/tasks/{id}
```

Request:

```bash
curl -X PUT http://localhost/api/tasks/1 \
  -H "Content-Type: application/json" \
  -d '{
        "status": "done"
      }'
```

Response:

```json
{
  "data": {
    "id": 1,
    "title": "Prepare Awesomic Task",
    "description": "Complete the technical assignment",
    "status": "done",
    "created_at": "...",
    "updated_at": "..."
  }
}
```

### 🗑️ Delete a Task

Endpoint:

```http
DELETE /api/tasks/{id}
```

Request:

```bash
curl -X DELETE http://localhost/api/tasks/1
```

Response:
Responds with 204 No Content.

## 📁 Project Structure Highlights

```bash
app/
├── Actions/
├── DataTransferObjects/
├── Enums/
├── Http/
│   └── Controllers/
│       └── Api/
│   └── Requests/
│   └── Resources/
├── Models/
├── Providers/
├── Swagger/                  
│   └── Schemas/
│       └── TaskSchemas.php   # Schema definitions for model and endpoint request payloads
│   └── ApiDocumentation.php  # Contains OpenAPI annotations for endpoints
│   └── ApiSpec.php           # Contains OpenAPI general specs
routes/
├── api.php                   # Entry point for API routes 
tests/
├── Feature/                  # Feature tests for API endpoints      
```

## 🙌 Author

### Gianfranco Rocco

Laravel Developer – Interview candidate for *Awesomic*
[LinkedIn](https://www.linkedin.com/in/gianfranco-rocco/) • [GitHub](https://github.com/GianfrancoRocco)
