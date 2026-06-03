# Sitemap & Wireframe - PT BPR Karawang Jabar (Perseroda)

## 1. Tujuan Dokumen

Dokumen ini menjadi blueprint struktur halaman dan susunan section sebelum proses development UI dimulai. Fokus utama adalah memastikan alur informasi website mudah dipahami oleh calon nasabah, nasabah existing, dan stakeholder.

## 2. Sitemap Website

```txt
/
├── /tentang-kami
├── /produk-layanan
│   └── /produk/tahara
├── /pengurus
└── /kontak
```

## 3. Navigasi Utama

Menu utama:

- Home
- Tentang Kami
- Produk & Layanan
- Pengurus
- Kontak

CTA utama di navbar:

- Hubungi Kami

Jika nomor WhatsApp resmi tersedia, CTA dapat diarahkan ke WhatsApp. Jika belum, arahkan ke halaman `/kontak`.

## 4. Wireframe Global

Struktur global semua halaman:

```txt
[Top Bar: Telepon | Email | Jam Layanan]
[Navbar: Logo | Menu | CTA]
[Main Content]
[Footer: Profil Singkat | Menu | Kontak | Jam Layanan]
[Floating Contact Button - optional]
```

## 5. Wireframe Halaman Home (`/`)

### 5.1 Hero Section

Tujuan: memberikan kesan pertama yang kuat dan menjelaskan siapa BPR Karawang.

Konten:

- Label kecil: PT BPR Karawang Jabar (Perseroda)
- Headline: Mitra Keuangan Masyarakat Karawang
- Subheadline: Layanan perbankan BPR yang dekat, mudah diakses, dan berorientasi pada kebutuhan masyarakat Karawang.
- CTA utama: Hubungi Kami
- CTA sekunder: Lihat Produk
- Visual: foto kantor / ilustrasi layanan keuangan / placeholder

Wireframe:

```txt
[Text: Label]
[Headline besar]
[Deskripsi singkat]
[Button Hubungi Kami] [Button Lihat Produk]

[Visual / Image]
```

### 5.2 Profil Singkat

Konten:

- Ringkasan PT BPR Karawang Jabar (Perseroda)
- Fokus pada layanan keuangan lokal
- Link ke Tentang Kami

Wireframe:

```txt
[Judul: Tentang BPR Karawang]
[Paragraf profil singkat]
[3 poin ringkas: Lokal | Terpercaya | Mudah Dijangkau]
[Button Selengkapnya]
```

### 5.3 Produk Unggulan

Produk awal:

- TAHARA (Tabungan Hari Raya)

Konten card:

- Nama produk
- Deskripsi singkat
- Manfaat utama
- CTA: Lihat Detail

Wireframe:

```txt
[Judul: Produk & Layanan]
[Intro singkat]

[Card TAHARA]
  [Icon]
  [Nama Produk]
  [Deskripsi]
  [Button Lihat Detail]
```

### 5.4 Keunggulan Layanan

Poin awal:

- Dekat dengan masyarakat Karawang
- Informasi layanan mudah diakses
- Pengurus dan kontak ditampilkan jelas
- Jam layanan terstruktur

Wireframe:

```txt
[Judul: Mengapa Memilih Kami]
[Grid 4 card keunggulan]
```

### 5.5 Pengurus Singkat

Konten:

- Heri Heryanto SH, MM - Direktur Utama
- Atjeng Hadis Susanto SE - Direktur
- Jaja Sumarna SE - Komisaris Utama
- Dikdik Kustiadi - Komisaris

Wireframe:

```txt
[Judul: Pengurus]
[4 Card nama + jabatan]
[Button Lihat Pengurus]
```

### 5.6 Kontak Cepat

Konten:

- Alamat
- Telepon
- Email
- Jam buka

Wireframe:

```txt
[Judul: Hubungi Kami]
[Alamat] [Telepon] [Email] [Jam Layanan]
[Button Ke Halaman Kontak]
```

## 6. Wireframe Halaman Tentang Kami (`/tentang-kami`)

Section:

1. Page Header
   - Judul: Tentang Kami
   - Breadcrumb

2. Profil Perusahaan
   - Deskripsi PT BPR Karawang Jabar (Perseroda)
   - Area layanan Karawang/Cilamaya

3. Visi & Misi
   - Placeholder sampai data resmi tersedia

4. Nilai Perusahaan
   - Profesional
   - Terpercaya
   - Dekat dengan masyarakat
   - Transparan

5. Informasi Kantor
   - Alamat
   - Jam layanan

Wireframe:

```txt
[Page Header]
[Profil + Image]
[Visi Misi]
[Nilai Perusahaan Grid]
[Info Kantor]
```

## 7. Wireframe Halaman Produk & Layanan (`/produk-layanan`)

Section:

1. Page Header
2. Intro produk BPR
3. Card produk
4. CTA konsultasi produk

Produk awal:

- TAHARA (Tabungan Hari Raya)

Wireframe:

```txt
[Page Header]
[Intro]
[Product Card: TAHARA]
[CTA: Butuh Informasi Produk? Hubungi Kami]
```

## 8. Wireframe Detail Produk TAHARA (`/produk/tahara`)

Section:

1. Page Header
2. Deskripsi produk
3. Manfaat
4. Syarat & ketentuan placeholder
5. Cara mendapatkan informasi
6. CTA kontak

Wireframe:

```txt
[Page Header: TAHARA]
[Deskripsi Produk]
[Manfaat Grid]
[Syarat & Ketentuan]
[CTA Hubungi Kami]
```

Catatan: detail produk harus dikonfirmasi dari sumber resmi sebelum ditulis lengkap.

## 9. Wireframe Halaman Pengurus (`/pengurus`)

Section:

1. Page Header
2. Intro transparansi pengurus
3. Card direksi
4. Card komisaris

Wireframe:

```txt
[Page Header]
[Intro]
[Direksi]
  [Card Direktur Utama]
  [Card Direktur]
[Komisaris]
  [Card Komisaris Utama]
  [Card Komisaris]
```

## 10. Wireframe Halaman Kontak (`/kontak`)

Section:

1. Page Header
2. Informasi kontak
3. Form kontak / CTA WhatsApp
4. Map embed

Wireframe:

```txt
[Page Header]
[Contact Info Cards]
[Form Kontak]
[Google Maps]
```

Field form kontak:

- Nama
- Email / Telepon
- Subjek
- Pesan

## 11. Komponen UI yang Dibutuhkan

- TopBar
- Navbar
- Footer
- PageHeader
- SectionTitle
- Button
- Card
- ProductCard
- ManagementCard
- ContactInfoCard
- ContactForm
- FloatingContactButton

## 12. Konten Dummy Aman untuk Development

Konten dummy boleh digunakan selama belum ada data resmi, dengan prinsip:

- Tidak menambahkan klaim legalitas yang belum terverifikasi.
- Tidak menyebut produk selain TAHARA sebagai produk aktif kecuali sudah dikonfirmasi.
- Tidak menampilkan syarat produk yang belum tersedia.
- Tidak membuat klaim seperti “terbaik”, “paling aman”, atau “dijamin” tanpa dasar resmi.

## 13. Rekomendasi Tahap Development Berikutnya

Setelah sitemap dan wireframe ini disetujui, tahap development yang disarankan:

1. Buat route semua halaman.
2. Buat layout utama.
3. Buat partial navbar/footer.
4. Buat CSS dasar dan desain responsif.
5. Implementasi halaman Home terlebih dahulu.
6. Lanjut halaman Tentang, Produk, Pengurus, Kontak.
7. Testing route dan responsive.
