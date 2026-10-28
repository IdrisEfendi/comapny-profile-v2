# Company Profile V2

Website profil resmi PT BPR Karawang Jabar (Perseroda), dibangun dengan PHP Rakit, MySQL, Blade views, Tailwind CSS, dan JavaScript ringan.

## Kebutuhan

- PHP 8.2+ dengan ekstensi `json`, `mbstring`, `openssl`, dan `pdo_mysql`
- MySQL 8+
- Composer
- Node.js dan npm untuk build Tailwind CSS
- Laragon atau Apache dengan `mod_rewrite`

## Instalasi Laragon

1. Clone project ke `C:\laragon\www\company-profile`.
2. Buat database `db_cp` di MySQL.
3. Import database:
   ```bash
   mysql -u root -p db_cp < db_cp.sql
   ```
4. Salin `.env.example` menjadi `.env`, lalu sesuaikan:
   ```env
   APP_ENV=local
   APP_DEBUG=false
   APP_URL=http://company-profile.test
   APP_KEY=isi-dengan-key-acak-minimal-32-karakter
   DB_DATABASE=db_cp
   DB_USERNAME=root
   DB_PASSWORD=
   ```
5. Install dependency dan build CSS:
   ```bash
   composer install
   npm install
   npm run build
   ```
6. Klik **Start All** di Laragon dan buka `http://company-profile.test`.

Alternatif tanpa virtual host:

```bash
php -S localhost:8000
```

Buka `http://localhost:8000`.

## Development

Gunakan watcher Tailwind saat mengubah template:

```bash
npm run dev
```

Smoke test route publik:

```bash
php tests/smoke.php http://company-profile.test
```

Endpoint SEO tersedia di `/sitemap.xml` dan `/robots.txt`.

## Production Checklist

- Gunakan `APP_ENV=production` dan `APP_DEBUG=false`.
- Gunakan `APP_KEY` unik minimal 32 karakter dan jangan commit `.env`.
- Aktifkan HTTPS dan set `APP_SESSION_SECURE=true`.
- Isi kredensial SMTP production, jangan gunakan `EMAIL_DRIVER=dummy`.
- Pastikan folder `storage` tidak dapat diakses sebagai source atau executable.
- Jalankan `npm run build` sebelum deploy.

## Kontribusi
1. Fork repositori ini
2. Buat branch fitur baru (`git checkout -b fitur-baru`)
3. Lakukan perubahan dan commit (`git commit -m "Deskripsi perubahan"`)
4. Push ke fork Anda (`git push origin fitur-baru`)
5. Buat Pull Request dan jelaskan perubahan Anda

## Lisensi
Proyek ini dilisensikan di bawah **MIT License** – lihat berkas `LICENSE` untuk detail.

---
*Dibuat dengan ❤️ oleh **Idris Efendi**.*
