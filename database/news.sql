-- Schema untuk fitur Berita & Pengumuman (Company Profile v2)
--
-- Dijalankan sekali pada environment yang belum memiliki tabel `news`.
-- Contoh: mysql -u <user> -p <nama_database> < database/news.sql

CREATE TABLE IF NOT EXISTS `news` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(160) NOT NULL,
  `title` varchar(190) NOT NULL,
  `category` varchar(120) NOT NULL DEFAULT '',
  `summary` text NOT NULL,
  `content` longtext NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
