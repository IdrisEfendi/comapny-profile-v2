# Tailwind CSS Setup

Project ini menggunakan Tailwind CSS untuk styling frontend.

## Mode Saat Ini

Selama fase development halaman, project memakai **Tailwind CDN** di `application/views/layouts/app.blade.php` supaya perubahan class di view langsung terlihat tanpa perlu menjalankan build setiap kali.

Sesuai keputusan terbaru, view menggunakan **class Tailwind standar** saja:

- Tidak memakai custom color seperti `brand-*` atau `accent-*`.
- Tidak memakai helper class seperti `container-page`, `btn-primary`, `btn-secondary`, `section-title`, `section-subtitle`, atau `card-soft`.
- Tidak memakai arbitrary value seperti `tracking-[...]`, `rounded-[...]`, `grid-cols-[...]`, atau `bg-[...]`.

## Cara Pakai di View

Layout utama sudah memuat:

```html
<script src="https://cdn.tailwindcss.com"></script>
```

Gunakan class Tailwind standar langsung di HTML/Blade/PHP view:

```html
<section class="bg-white py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-slate-950">PT BPR Karawang Jabar (Perseroda)</h1>
    <p class="mt-4 text-slate-600">Mitra Keuangan Masyarakat Karawang</p>
  </div>
</section>
```

## Perintah Build Final

Saat semua halaman selesai dan desain sudah stabil, baru build CSS production:

```bash
npm run build
```

Lalu layout bisa diganti dari CDN ke file lokal:

```html
<link rel="stylesheet" href="/assets/css/app.css">
```

## Catatan

Untuk development saat ini, tidak perlu menjalankan `npm run build` setiap selesai edit view.
