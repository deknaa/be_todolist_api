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