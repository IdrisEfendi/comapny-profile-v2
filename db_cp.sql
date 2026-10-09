-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 09, 2026 at 08:18 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Administrator',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_login_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password_hash`, `name`, `is_active`, `last_login_at`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$cEPH/gc4QOf77hbJNOP7BOuYJROMQgxz4fC1/9zrKroVmBJARh0Wu', 'Administrator', 1, '2026-10-09 08:47:08', '2026-06-03 20:15:23', '2026-08-02 14:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `company_profile`
--

CREATE TABLE `company_profile` (
  `key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_profile`
--

INSERT INTO `company_profile` (`key`, `value`, `created_at`, `updated_at`) VALUES
('area_service', 'Karawang dan sekitarnya, dengan informasi kantor yang merujuk ke area Cilamaya Wetan.', '2026-06-03 20:06:11', '2026-06-03 20:10:24'),
('hero_intro', 'Profil PT BPR Karawang Jabar (Perseroda) sebagai BPR yang dekat dengan masyarakat Karawang, khususnya area Cilamaya dan sekitarnya.', '2026-06-03 20:06:11', '2026-06-03 20:10:24'),
('information_focus', 'Profil BPR, produk TAHARA, pengurus, alamat, telepon, email, dan jam layanan.', '2026-06-03 20:06:11', '2026-06-03 20:10:24'),
('mission', 'Menyediakan informasi layanan yang jelas, membangun komunikasi yang terbuka, serta membantu masyarakat memperoleh akses informasi produk BPR dengan mudah.', '2026-06-03 20:06:11', '2026-06-03 20:10:24'),
('profile_heading', 'BPR yang dekat dengan kebutuhan masyarakat Karawang', '2026-06-03 20:06:11', '2026-06-03 20:10:24'),
('profile_summary', 'PT BPR Karawang Jabar (Perseroda) merupakan BPR yang berfokus melayani kebutuhan keuangan masyarakat Karawang. Website ini disiapkan sebagai media informasi publik agar profil perusahaan, produk, pengurus, dan kanal kontak dapat diakses dengan mudah.', '2026-06-03 20:06:11', '2026-06-03 20:10:24'),
('vision', 'Menjadi BPR daerah yang dikenal dekat dengan masyarakat, mudah diakses, dan mampu mendukung kebutuhan layanan keuangan masyarakat Karawang.', '2026-06-03 20:06:11', '2026-06-03 20:10:24');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `management`
--

CREATE TABLE `management` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initials` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `bio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `management`
--

INSERT INTO `management` (`id`, `name`, `position`, `group_name`, `initials`, `bio`, `photo_path`, `sort_order`, `created_at`, `updated_at`) VALUES
(6, 'Heri Heryanto SH, MM', 'Direktur Utama', 'Direksi', 'HH', 'Memimpin arah operasional dan pengelolaan perusahaan sesuai tata kelola dan ketentuan yang berlaku.', NULL, 0, '2026-10-09 02:08:22', '2026-10-09 02:08:22'),
(7, 'Atjeng Hadis Susanto SE', 'Direktur', 'Direksi', 'AH', 'Mendukung pengelolaan operasional dan pengembangan layanan perusahaan secara profesional.', NULL, 1, '2026-10-09 02:08:22', '2026-10-09 02:08:22'),
(9, 'Dikdik Kustiadi', 'Komisaris', 'Komisaris', 'DK', 'Mendukung fungsi pengawasan perusahaan dan penerapan tata kelola yang baik.', NULL, 3, '2026-10-09 02:08:22', '2026-10-09 02:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int UNSIGNED NOT NULL,
  `slug` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `slug`, `title`, `category`, `summary`, `content`, `image_path`, `pdf_path`, `is_published`, `published_at`, `created_at`, `updated_at`) VALUES
(20, 'layanan-informasi-digital-bpr-karawang', 'Layanan Informasi Digital BPR Karawang', 'Informasi', 'summary', '<p>content</p>', 'uploads/news/berita-20261009105836-daf4f3c2.jpg', 'uploads/news/berita-20261009102322-1a23b432.pdf', 1, '2026-10-09 08:00:00', '2026-10-09 02:08:22', '2026-10-09 10:58:36'),
(21, 'mengenal-tabungan-hari-raya-tahara', 'Mengenal Tabungan Hari Raya TAHARA', 'Produk', 'TAHARA merupakan produk tabungan yang membantu masyarakat mempersiapkan kebutuhan hari raya.', 'TAHARA ditujukan untuk membantu perencanaan kebutuhan hari raya. Informasi mengenai manfaat, setoran, persyaratan, dan ketentuan dapat dikonfirmasi langsung kepada petugas BPR melalui kanal resmi.', NULL, NULL, 1, '2026-10-08 08:00:00', '2026-10-09 02:08:22', '2026-10-09 02:08:22'),
(22, 'komitmen-pelayanan-masyarakat-karawang', 'Komitmen Pelayanan untuk Masyarakat Karawang', 'Pengumuman', 'BPR Karawang berkomitmen memberikan informasi layanan yang jelas dan mudah diakses oleh masyarakat.', 'PT BPR Karawang Jabar (Perseroda) terus berupaya menjaga komunikasi yang terbuka dengan masyarakat Karawang. Pengunjung dapat menggunakan halaman kontak untuk menyampaikan pertanyaan atau kebutuhan informasi layanan.', NULL, NULL, 1, '2026-10-07 08:00:00', '2026-10-09 02:08:22', '2026-10-09 02:08:22'),
(23, 'transformasi-layanan-digital-dan-komitmen-bpr-karawang', 'Transformasi Layanan Digital dan Komitmen BPR Karawang untuk Masyarakat', 'Informasi Perusahaan', 'PT BPR Karawang Jabar (Perseroda) terus memperkuat kualitas informasi dan pelayanan untuk mendukung kebutuhan masyarakat Karawang melalui komunikasi yang lebih terbuka, mudah diakses, dan berorientasi pada kebutuhan nasabah.', '<h2>Membangun layanan yang lebih dekat dengan masyarakat</h2><p>\r\n</p><p>PT BPR Karawang Jabar (Perseroda) merupakan lembaga keuangan yang tumbuh bersama masyarakat Karawang. Dalam menjalankan perannya, BPR tidak hanya berfokus pada penyediaan produk dan layanan keuangan, tetapi juga berupaya memastikan setiap informasi dapat diterima masyarakat secara jelas, benar, dan mudah dipahami.</p><p>\r\n</p><p>Perubahan kebiasaan masyarakat dalam mencari informasi mendorong perusahaan untuk memperkuat kanal komunikasi digital. Melalui website resmi, masyarakat dapat mengenal profil perusahaan, melihat produk dan layanan, mengetahui struktur pengurus, membaca berita terbaru, serta menemukan alamat dan kontak resmi BPR dalam satu tempat.</p><p>\r\n</p><h2>Informasi yang mudah diakses</h2><p>\r\n</p><p>Ketersediaan informasi yang lengkap menjadi bagian penting dalam membangun kepercayaan. Masyarakat membutuhkan penjelasan yang sederhana mengenai produk, persyaratan, mekanisme layanan, jam operasional, serta cara menghubungi petugas yang dapat memberikan informasi lanjutan.</p><p>\r\n</p><p>Karena itu, setiap informasi pada kanal resmi disusun dengan memperhatikan ketepatan isi dan kemudahan akses. Pengunjung dapat menggunakan halaman kontak untuk menyampaikan pertanyaan mengenai produk, layanan, dokumen yang diperlukan, maupun kebutuhan informasi lainnya.</p><p>\r\n</p><p><br></p><p>\r\n</p><h2>Komitmen terhadap pelayanan</h2><p>\r\n</p><p>Pelayanan yang baik dibangun melalui komunikasi yang terbuka dan sikap yang responsif. BPR Karawang berkomitmen untuk terus menjaga kualitas interaksi dengan masyarakat, baik melalui kunjungan langsung ke kantor maupun melalui kanal komunikasi yang tersedia.</p><p>\r\n</p><p>Komitmen tersebut mencakup upaya memberikan informasi sesuai ketentuan yang berlaku, mengarahkan masyarakat kepada petugas yang tepat, serta membantu calon nasabah memahami tahapan layanan sebelum mengambil keputusan. Setiap kebutuhan nasabah dapat memiliki karakteristik yang berbeda, sehingga konsultasi langsung tetap menjadi bagian penting dalam proses pelayanan.</p><p>\r\n</p><h2>Mengenal produk secara bertanggung jawab</h2><p>\r\n</p><p>Salah satu informasi yang tersedia pada website adalah produk TAHARA atau Tabungan Hari Raya. Produk ini ditujukan untuk membantu masyarakat merencanakan kebutuhan hari raya secara lebih teratur. Informasi yang ditampilkan pada website merupakan gambaran umum, sedangkan manfaat, persyaratan, setoran, mekanisme pencairan, biaya, dan ketentuan lainnya perlu dikonfirmasi langsung kepada pihak BPR.</p><p>\r\n</p><p>Penyampaian informasi secara hati-hati diperlukan agar masyarakat memperoleh pemahaman yang sesuai dan tidak mengambil kesimpulan berdasarkan informasi yang belum lengkap. BPR mengajak masyarakat untuk menggunakan kanal resmi ketika membutuhkan penjelasan yang lebih rinci.</p><p>\r\n</p><h2>Kolaborasi dengan masyarakat Karawang</h2><p>\r\n</p><p>Sebagai bagian dari lingkungan masyarakat Karawang, BPR memahami bahwa keberlanjutan layanan tidak dapat dipisahkan dari kepercayaan dan masukan masyarakat. Pertanyaan, saran, serta tanggapan dari pengunjung menjadi bahan penting untuk meningkatkan kualitas komunikasi dan pelayanan.</p><p>\r\n</p><p>Melalui hubungan yang baik dengan masyarakat, perusahaan dapat memahami kebutuhan yang berkembang dan menyesuaikan cara penyampaian informasi. Pendekatan ini diharapkan dapat menciptakan pengalaman yang lebih nyaman, terutama bagi masyarakat yang baru mengenal produk dan layanan perbankan.</p><p>\r\n</p><h2>Ajakan untuk menggunakan kanal resmi</h2><p>\r\n</p><p>Masyarakat yang membutuhkan informasi lebih lanjut dipersilakan menghubungi PT BPR Karawang Jabar (Perseroda) melalui nomor telepon, email, atau datang langsung ke kantor pada jam layanan. Pastikan selalu menggunakan informasi kontak resmi dan berhati-hati terhadap pihak yang mengatasnamakan perusahaan di luar kanal yang telah ditetapkan.</p><p>\r\n</p><p>Dengan dukungan teknologi, informasi yang terkelola dengan baik, serta komitmen pelayanan yang berkelanjutan, PT BPR Karawang Jabar (Perseroda) akan terus berupaya menjadi mitra keuangan yang dekat, mudah diakses, dan bermanfaat bagi masyarakat Karawang.</p>', 'uploads/news/berita-20261009112139-e5a857c9.jpg', 'uploads/news/berita-20261009112139-107af01a.pdf', 1, '2026-10-09 03:59:57', '2026-10-09 03:59:57', '2026-10-09 11:21:39');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int UNSIGNED NOT NULL,
  `slug` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `subtitle` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `detail_label` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `slug`, `name`, `category`, `subtitle`, `summary`, `target`, `detail_label`, `is_featured`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'tahara', 'TAHARA', 'Tabungan', 'Tabungan Hari Raya', 'Produk tabungan untuk membantu perencanaan kebutuhan hari raya.', 'Masyarakat umum', 'Hubungi BPR', 1, 0, '2026-06-03 20:06:11', '2026-06-03 20:06:11');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`key`, `value`, `created_at`, `updated_at`) VALUES
('address', 'Jln Raya Cilamaya Komplek Kantor Kecamatan Cilamaya Wetan', '2026-06-03 20:06:11', '2026-10-08 17:08:56'),
('company_name', 'PT BPR Karawang Jabar (Perseroda)', '2026-06-03 20:06:11', '2026-10-08 17:08:56'),
('email', 'ptbptkarawang@gmail.com', '2026-06-03 20:06:11', '2026-10-08 17:08:56'),
('google_maps_url', 'https://maps.app.goo.gl/3mtmYGGbPXPn564z9', '2026-06-03 20:06:11', '2026-10-08 17:08:56'),
('notification_email', 'ptbprkarawangjabar@gmail.com', '2026-10-08 17:01:19', '2026-10-08 17:08:56'),
('office_hours', 'Senin - Jumat, 08:00 - 16:00', '2026-06-03 20:06:11', '2026-10-08 17:08:56'),
('phone', '(0264) 8380203', '2026-06-03 20:06:11', '2026-10-08 17:08:56'),
('tagline', 'Mitra Keuangan Masyarakat Karawang', '2026-06-03 20:06:11', '2026-10-08 17:08:56'),
('whatsapp', '', '2026-06-03 20:06:11', '2026-10-08 17:08:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `company_profile`
--
ALTER TABLE `company_profile`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `management`
--
ALTER TABLE `management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `management`
--
ALTER TABLE `management`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
