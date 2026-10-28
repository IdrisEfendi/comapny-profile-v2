---
name: rakit-project
description: Project-specific guidance for developing the Rakit PHP web framework application in this repository.
---

# Rakit Project Skill

Gunakan skill ini ketika mengembangkan, memperbaiki bug, melakukan refactor, atau menambahkan fitur pada project ini.

## Project Identity

- Project ini adalah aplikasi/framework PHP bernama Rakit Web Framework.
- Rakit adalah framework PHP ringan dengan pola MVC, routing RESTful, Blade templating, konfigurasi berbasis file, ORM Facile, migration, authentication, jobs, cache, dan HTTP testing.
- Entry point HTTP adalah `index.php`; bootstrap runtime Rakit adalah `system/boot.php`, yang dipanggil dari front controller.
- Path framework dan direktori aplikasi didefinisikan di `paths.php`.
- Dependensi dikelola Composer melalui `composer.json`.
- Framework core memiliki sejarah kompatibilitas PHP lama, tetapi aplikasi dan lockfile dependency saat ini ditargetkan ke PHP 8.2+ (runtime terverifikasi: PHP 8.4). Jangan mengklaim dukungan PHP 5.4 untuk aplikasi ini sampai `composer.json`, lockfile, syntax aplikasi, dan CI benar-benar diuji ulang.

## Directory Map

- `application/`: kode aplikasi. Tempat utama untuk routes, controllers, models, views, config, migrations, jobs, tests, language, hooks, dan middleware.
- `application/routes.php`: definisi route aplikasi.
- `application/controllers/`: controller dengan konvensi nama class `*_Controller` dan method `action_*`.
- `application/models/`: model Facile ORM, biasanya mewarisi `Facile`.
- `application/views/`: native view dan Blade view; file Blade menggunakan ekstensi `.blade.php`.
- `application/config/`: konfigurasi aplikasi dan package.
- `application/migrations/`: migration database dengan nama berurutan berbasis timestamp.
- `application/tests/`: test aplikasi.
- `tests/`: smoke/deployment checks sederhana; bukan pengganti HTTP test Rakit di `application/tests/`.
- `packages/admin/`: package admin aplikasi, termasuk route, helper, dan Blade view admin.
- `application/boot.php`: konfigurasi package application bila ada; jangan menganggapnya sebagai front-controller bootstrap.
- `system/`: core framework. Hindari mengubahnya untuk kebutuhan fitur aplikasi; ubah hanya jika pekerjaan memang ditujukan untuk framework core.
- `packages/`: package terpasang, termasuk dokumentasi offline di `packages/docs/`.
- `assets/`: file publik seperti CSS, JavaScript, dan gambar.
- `storage/`: file runtime seperti cache, session, log, database SQLite, dan compiled Blade views. Harus writable oleh PHP.
- `index.php`: front controller dan deteksi worker mode.
- `paths.php`: definisi path, environment URL, helper `path()`, dan polyfill kompatibilitas.
- `sample.htaccess`: aturan Apache untuk front controller dan perlindungan direktori sensitif.

## Development Rules

1. Baca file terkait dan dokumentasi offline di `packages/docs/data/` sebelum mengubah perilaku framework.
2. Utamakan perubahan di `application/` untuk fitur aplikasi. Jangan menaruh business logic di `index.php`, `paths.php`, atau view.
3. Pertahankan guard `defined('DS') or exit('No direct access.');` pada file PHP aplikasi yang menggunakannya.
4. Ikuti gaya kode yang sudah ada: PHP procedural/framework conventions, class tanpa namespace pada application layer, dan indentasi 4 spasi.
5. Jangan memindahkan atau mengganti nama folder standar tanpa memperbarui `paths.php`, autoloader, dan konfigurasi yang relevan.
6. Jangan mengekspos `application`, `packages`, `storage`, `system`, `vendor`, `tests`, file konfigurasi, `key.php`, atau `composer.json` ke web server. Periksa `.htaccess` dan `sample.htaccess` bila menambah direktori sensitif.
7. Jangan menaruh secret, application key, credential database, atau token di source code, view, test, atau commit.
8. Gunakan helper dan API Rakit yang sudah tersedia sebelum membuat utilitas baru.
9. Hindari backward-compatibility shim baru kecuali ada kebutuhan nyata dari versi PHP atau data yang sudah tersimpan.
10. Jangan mengubah framework core hanya untuk menyelesaikan masalah yang dapat ditangani di application layer.

## Routing and Controllers

- Tambahkan route publik di `application/routes.php`; route admin berada di `packages/admin/routes.php` dan wajib melewati helper auth/CSRF package admin.
- Route closure cocok untuk endpoint kecil; gunakan controller untuk alur yang memiliki validasi, authorization, database, atau lebih dari satu langkah.
- Konvensi controller mengikuti contoh `Home_Controller` dengan method `action_index`.
- Kembalikan `View::make(...)` untuk HTML view dan gunakan response API yang sesuai untuk JSON atau status HTTP.
- Untuk endpoint health check atau response plain text, tetapkan content type dan cache header secara eksplisit.
- Middleware didefinisikan melalui mekanisme Rakit yang sudah ada; jangan menambahkan pemeriksaan authorization manual berulang di setiap action jika middleware dapat menangani kebutuhannya.

## Views and Frontend

- Aktifkan dan gunakan Blade melalui konfigurasi existing; view aplikasi berada di `application/views/`.
- Escape data pengguna secara default. Hanya gunakan output raw jika konten sudah disanitasi dan alasan keamanannya jelas.
- Simpan asset browser di `assets/`, bukan di `system/` atau `storage/`.
- Gunakan helper `asset()` dan konfigurasi bahasa yang sudah dipakai oleh view existing.
- Pertahankan dukungan tampilan responsif dan theme behavior yang sudah ada pada `home.blade.php` jika mengubah halaman tersebut.

## Models, Database, and Migrations

- Model aplikasi mewarisi `Facile` dan mendeklarasikan `$fillable` serta `$hidden` sesuai kebutuhan.
- Jangan memasukkan field password, token, atau data sensitif ke serialization publik; gunakan `$hidden`.
- `database/schema.sql` dan `db_cp.sql` dipakai untuk fresh install/seed legacy. Perubahan schema production baru harus memakai migration di `application/migrations/` atau didokumentasikan sebagai migration aman untuk existing install.
- Periksa konfigurasi database di `application/config/database.php` dan dokumentasi `packages/docs/data/database/` sebelum memilih query API.
- Gunakan query builder, Facile, atau raw query Rakit yang sudah tersedia sesuai kompleksitas kebutuhan.
- Validasi input dan gunakan parameter binding/API database framework untuk mencegah SQL injection.
- Pertimbangkan transaksi untuk operasi multi-tabel atau operasi yang harus atomik.

## Configuration and Runtime

- Konfigurasi runtime berada di `application/config/`; jangan hard-code environment-specific values.
- Periksa pola environment URL di `paths.php` sebelum menambah environment baru.
- `storage/` harus writable oleh PHP dan tidak boleh dipakai sebagai tempat file publik.
- Bootstrap order di `system/boot.php` dan package application penting: config loader, aliases, autoload directories, view/language loaders, Blade, timezone, session, lalu Composer. Periksa file aktual sebelum mengubah urutan.
- Jangan menginisialisasi session untuk CLI secara manual jika konfigurasi framework sudah menanganinya.
- Worker mode dapat berjalan melalui FrankenPHP, RoadRunner, atau Swoole. Hindari state global mutable yang bocor antar-request.

## Security Checklist

- Validasi semua input eksternal menggunakan validation API Rakit.
- Terapkan CSRF untuk request yang mengubah data, terutama POST, PUT, PATCH, dan DELETE.
- Gunakan authentication dan authorization API Rakit, bukan pemeriksaan user ID yang tersebar.
- Escape output HTML dan validasi upload/file path.
- Jangan menampilkan stack trace atau konfigurasi sensitif pada production.
- Pastikan route dan file baru tidak melemahkan aturan proteksi di `sample.htaccess`.
- Untuk perubahan autentikasi, session, password, JWT, encryption, atau authorization, baca dokumentasi terkait di `packages/docs/data/auth/`, `hash.md`, `jwt.md`, dan `crypter.md`.

## Testing and Verification

- Test HTTP dapat menggunakan `System\\Testing\\Http` dan dijalankan dengan `php rakit test:run`.
- Test harus memeriksa status, redirect, body, JSON, header, cookie, session, validation error, dan authorization sesuai perilaku fitur.
- Gunakan request test seperti `get`, `post`, `put`, `patch`, `delete`, `json`, atau `call` sesuai endpoint.
- Gunakan `acting_as()` untuk skenario authenticated dan `with_headers()` untuk header seperti Bearer token.
- Setelah perubahan PHP, minimal jalankan lint pada file PHP yang berubah: `php -l path/to/file.php`.
- Jika perubahan menyentuh route, controller, view, migration, atau config, jalankan test relevan dan smoke test endpoint terkait.
- Untuk perubahan dependency, gunakan Composer dan pastikan kompatibilitas dengan PHP yang didukung project.
- Jangan menganggap halaman berhasil hanya karena file dapat diparse; verifikasi alur request melalui HTTP test atau request lokal jika tersedia.

## Useful Commands

```text
composer install
php rakit key:generate
php rakit test:run
php -l application/routes.php
```

Gunakan command generator Rakit yang tersedia untuk membuat artifact baru bila dokumentasi project mendukungnya, misalnya command untuk controller, model, migration, atau test. Periksa `php rakit` atau dokumentasi console sebelum menebak nama command.

## Change Workflow

1. Identifikasi apakah perubahan berada di application layer, framework core, package, atau runtime configuration.
2. Baca route, controller, model, view, config, migration, dan test yang terkait.
3. Baca dokumentasi offline Rakit untuk API yang akan dipakai.
4. Implementasikan perubahan terkecil yang konsisten dengan konvensi project.
5. Tambahkan atau sesuaikan test untuk perilaku baru dan kasus error.
6. Jalankan lint, test, dan smoke verification yang relevan.
7. Laporkan file yang berubah, command verifikasi, dan keterbatasan environment seperti dependency atau database yang tidak tersedia.

## Avoid

- Jangan mengasumsikan ini Laravel meskipun beberapa API dan Blade terlihat mirip.
- Target aplikasi saat ini PHP 8.2+; syntax modern boleh dipakai hanya jika kompatibel dengan seluruh runtime deployment yang didukung. Jangan menurunkan target ke PHP 5.4 hanya berdasarkan constraint legacy `composer.json`.
- Jangan membuat route, controller, model, atau migration di folder Laravel-style yang tidak digunakan project ini.
- Jangan mengedit file hasil generate di `storage/views/` sebagai source of truth.
- Jangan menghapus perubahan pengguna atau file yang tidak terkait dengan task.
