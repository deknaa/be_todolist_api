<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# 📘 API Documentation – To Do List API

## 🔐 Authentication

### ✅ Register
- **Endpoint:** `POST /api/register`
- **Description:** Mendaftarkan user baru.
- **Request Body:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password",
  "password_confirmation": "password"
}
```
- **Response (201):**
```json
{
  "message": "User telah berhasil melakukan registrasi",
  "user": {
    "name": "John Doe",
    "email": "john@example.com",
    "updated_at": "2025-04-30T01:40:14.000000Z",
    "created_at": "2025-04-30T01:40:14.000000Z",
    "id": 2
  }
}
```

### 🔑 Login
- **Endpoint:** `POST /api/login`
- **Description:** Login dan mendapatkan token.
- **Request Body:**
```json
{
  "email": "john@example.com",
  "password": "password"
}
```
- **Response (200):**
```json
{
  "message": "Login berhasil",
  "token": "{id}|xxxxxxxxxxxxxxxxxxxxx"
}
```

### 🚪 Logout
- **Endpoint:** `POST /api/logout`
- **Description:** Logout dan mencabut token aktif.
- **Headers:**
```
Authorization: Bearer {token}
```
- **Response (200):**
```json
{
  "message": "Berhasil Logout"
}
```

## 📋 Task Management (Auth Required)

### 📄 Get All Tasks
- **Endpoint:** `GET /api/tasks`
- **Description:** Menampilkan semua task milik user yang login.
- **Headers:**
```
Authorization: Bearer {token}
```
- **Response (200):**
```json
[
  {
    "id": 1,
    "user_id": 1,
    "title": "Makan Siang",
    "description": "Jam Makan Siang",
    "completed": 0,
    "created_at": "2025-04-30T05:55:51.000000Z",
    "updated_at": "2025-04-30T05:55:51.000000Z"
  }
]
```

### ➕ Create Task
- **Endpoint:** `POST /api/tasks`
- **Description:** Menambahkan task baru.
- **Headers:**
```
Authorization: Bearer {token}
```
- **Request Body:**
```json
{
  "title": "Makan Siang",
  "description": "Jam Makan Siang"
}
```
- **Response (201):**
```json
{
  "message": "Task baru berhasil dibuat",
  "task": {
      "title": "Makan Siang",
      "description": "Jam Makan Siang",
      "user_id": 1,
      "updated_at": "2025-04-30T05:55:51.000000Z",
      "created_at": "2025-04-30T05:55:51.000000Z",
      "id": 1
  }
}
```

### 📄 Get Task By id
- **Endpoint:** `GET /api/tasks/{id}`
- **Description:** Menampilkan task berdasarkan id.
- **Headers:**
```
Authorization: Bearer {token}
```
- **Response (200):**
```json
{
  "message": "Berhasil mendapatkan task berdasarkan id",
  "task": {
      "id": 1,
      "user_id": 1,
      "title": "Makan Siang",
      "description": "Jam Makan Siang",
      "completed": 0,
      "created_at": "2025-04-30T05:55:51.000000Z",
      "updated_at": "2025-04-30T05:55:51.000000Z"
  }
}
```

### ✏️ Update Task
- **Endpoint:** `PUT /api/tasks/{id}`
- **Description:** Update task berdasarkan ID.
- **Headers:**
```
Authorization: Bearer {token}
```
- **Request Body:**
```json
{
  "message": "Sukses melakukan update data task",
  "task": {
      "id": 1,
      "user_id": 1,
      "title": "Belajar Membuat API",
      "description": "Belajar Membuat API dengan Laravel Sanctum",
      "completed": 0,
      "created_at": "2025-04-30T05:55:51.000000Z",
      "updated_at": "2025-04-30T06:32:33.000000Z"
  }
}
```

### ❌ Delete Task
- **Endpoint:** `DELETE /api/tasks/{id}`
- **Description:** Menghapus task berdasarkan ID.
- **Headers:**
```
Authorization: Bearer {token}
```
- **Response (200):**
```json
{
    "message": "Berhasil menghapus task",
    "task": {
        "id": 1,
        "user_id": 1,
        "title": "Belajar Membuat API",
        "description": "Belajar Membuat API dengan Laravel Sanctum",
        "completed": 0,
        "created_at": "2025-04-30T05:55:51.000000Z",
        "updated_at": "2025-04-30T06:32:33.000000Z"
    }
}
```

## 🧪 Tips Penggunaan dengan Postman
- Gunakan tab **Authorization > Bearer Token** saat testing endpoint yang membutuhkan autentikasi.
- Pastikan kamu sudah login dan menyimpan token dari response.
