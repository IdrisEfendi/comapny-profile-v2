# Admin Package

Admin panel dibuat sebagai package lokal Rakit di:

```txt
packages/admin/
```

## Registration

Package diregistrasikan di:

```txt
application/packages.php
```

Dengan konfigurasi:

```php
'admin' => ['handles' => 'admin', 'autoboot' => true]
```

## Routes

- `/admin` → redirect ke dashboard
- `/admin/login`
- `/admin/logout`
- `/admin/dashboard`
- `/admin/settings`
- `/admin/company-profile`
- `/admin/products`
- `/admin/management`

## Auth

Auth sementara memakai credential dari `.env`:

```env
ADMIN_USERNAME=admin
ADMIN_PASSWORD=change-me-admin
```

Catatan: ini cocok untuk development. Untuk production sebaiknya diganti menjadi user database + password hash.

## Settings

Halaman `/admin/settings` menyimpan data ke:

```txt
storage/admin/settings.json
```

Field awal:

- company_name
- tagline
- phone
- email
- address
- office_hours
- whatsapp
- google_maps_url

## Test Terakhir

- `/admin/login` → HTTP 200
- `/admin/dashboard` tanpa login → HTTP 302 ke login
- Login dengan credential `.env` → redirect ke `/admin/dashboard`
- `/admin/dashboard` setelah login → HTTP 200
- Submit `/admin/settings` → HTTP 302 dan file JSON ter-update

## Next Step

1. Ganti password default di `.env`.
2. Hubungkan website publik agar membaca `storage/admin/settings.json`.
3. Buat CRUD produk.
4. Buat CRUD pengurus.
5. Upgrade auth ke database + password hash sebelum production.
