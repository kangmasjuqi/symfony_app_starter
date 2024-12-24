# Symfony App Starter Documentation

This document provides an overview of the available routes in the application, including GET and POST requests, along with sample usage.

---

## GET Requests

### 1. Regular Page: Hello

**URL**: `http://127.0.0.1:8001/hello`

- **Method**: GET
- **Description**: Displays a regular page (e.g., greeting or hello message).

---

### 2. Regular Page: Greet (with name)

**URL**: `http://127.0.0.1:8001/greet/{name}`

- **Method**: GET
- **Description**: Displays a greeting message with the provided name.
- **Example URL**: `http://127.0.0.1:8001/greet/marjuqi`

---

### 3. Regular Page: Users List

**URL**: `http://127.0.0.1:8001/users`

- **Method**: GET
- **Description**: Displays a list of users in a regular page.

---

### 4. API: Countries List

**URL**: `http://127.0.0.1:8001/countries`

- **Method**: GET
- **Description**: Returns a list of countries in JSON format.
- **Response**: JSON array with country data.

---

### 5. API: Projects List

**URL**: `http://127.0.0.1:8001/projects`

- **Method**: GET
- **Description**: Returns a list of projects in JSON format.
- **Response**: JSON array with project data.

---

### 6. API: Specific Project Details

**URL**: `http://127.0.0.1:8001/projects/{id}`

- **Method**: GET
- **Description**: Returns details of a specific project based on the provided project ID.
- **Example URL**: `http://127.0.0.1:8001/projects/1`
- **Response**: JSON object with project details.

---

## POST Request

### 1. Create a New Project

**URL**: `http://127.0.0.1:8001/projects`

- **Method**: POST
- **Description**: Creates a new project by sending a JSON request body.

#### Sample Request:

```bash
curl -X POST http://localhost:8001/projects \
  -H "Content-Type: application/json" \
  -d '{"name":"New Project","description":"This is a new project.","contractTypeId":101,"contractSignedOn":"2024-01-01","budget":50000,"isActive":1}'
```
