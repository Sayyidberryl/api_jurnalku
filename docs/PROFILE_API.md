# Profile Management API

API untuk mengelola profil pengguna dalam aplikasi Jurnalku.

## Endpoints

### 1. Get Profile
**GET** `/api/profile`

Mengambil informasi profil pengguna yang sedang login.

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
    "status": true,
    "message": "Profile berhasil diambil",
    "data": {
        "id": 1,
        "username": "johndoe",
        "name": "John Doe",
        "nis": 12345678,
        "rayon": "Rayon A",
        "romble": "XI RPL 1",
        "photo_profile": "http://localhost:8000/storage/profile_photos/photo.jpg",
        "created_at": "2025-12-12T06:59:20.000000Z",
        "updated_at": "2025-12-12T06:59:20.000000Z"
    }
}
```

### 2. Update Profile Photo
**POST** `/api/profile/photo`

Mengupdate foto profil pengguna.

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Body (Form Data):**
- `photo`: File gambar (JPEG, PNG, JPG, max 2MB)

**Response:**
```json
{
    "status": true,
    "message": "Foto profile berhasil diupdate",
    "data": {
        "photo_profile": "http://localhost:8000/storage/profile_photos/new_photo.jpg"
    }
}
```

### 3. Change Password
**POST** `/api/profile/password`

Mengubah password pengguna.

**Headers:**
```
Authorization: Bearer {token}
Content-Type: application/json
```

**Body:**
```json
{
    "current_password": "password123",
    "new_password": "newpassword123",
    "confirm_password": "newpassword123"
}
```

**Response:**
```json
{
    "status": true,
    "message": "Password berhasil diubah"
}
```

## Test Users

Untuk testing, gunakan user berikut:

1. **User 1:**
   - Auth: `johndoe` atau `12345678`
   - Password: `password123`

2. **User 2:**
   - Auth: `sayyidberryl` atau `12310041`
   - Password: `password123`

## Error Responses

Semua endpoint dapat mengembalikan error response berikut:

**400 Bad Request:**
```json
{
    "status": false,
    "message": "Error message"
}
```

**401 Unauthorized:**
```json
{
    "status": false,
    "message": "Unauthenticated."
}
```

**500 Internal Server Error:**
```json
{
    "status": false,
    "message": "Server error",
    "error": "Detailed error message"
}
```