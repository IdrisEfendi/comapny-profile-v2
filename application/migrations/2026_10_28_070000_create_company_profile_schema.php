<?php

defined('DS') or exit('No direct access.');

class Create_Company_Profile_Schema
{
    public function up()
    {
        $db = \System\Database::connection();

        $tables = [
            "CREATE TABLE IF NOT EXISTS `site_settings` (`key` varchar(100) NOT NULL, `value` text NOT NULL, `created_at` datetime DEFAULT NULL, `updated_at` datetime DEFAULT NULL, PRIMARY KEY (`key`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
            "CREATE TABLE IF NOT EXISTS `company_profile` (`key` varchar(100) NOT NULL, `value` text NOT NULL, `created_at` datetime DEFAULT NULL, `updated_at` datetime DEFAULT NULL, PRIMARY KEY (`key`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
            "CREATE TABLE IF NOT EXISTS `products` (`id` int unsigned NOT NULL AUTO_INCREMENT, `slug` varchar(160) NOT NULL, `name` varchar(190) NOT NULL, `category` varchar(120) NOT NULL DEFAULT '', `subtitle` varchar(190) NOT NULL DEFAULT '', `summary` text NOT NULL, `target` varchar(190) NOT NULL DEFAULT '', `detail_label` varchar(190) NOT NULL DEFAULT '', `is_featured` tinyint(1) NOT NULL DEFAULT '0', `sort_order` int NOT NULL DEFAULT '0', `created_at` datetime DEFAULT NULL, `updated_at` datetime DEFAULT NULL, PRIMARY KEY (`id`), UNIQUE KEY `slug` (`slug`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
            "CREATE TABLE IF NOT EXISTS `management` (`id` int unsigned NOT NULL AUTO_INCREMENT, `name` varchar(190) NOT NULL, `position` varchar(190) NOT NULL, `group_name` varchar(80) NOT NULL, `initials` varchar(10) NOT NULL DEFAULT '', `bio` text NOT NULL, `photo_path` varchar(255) DEFAULT NULL, `sort_order` int NOT NULL DEFAULT '0', `created_at` datetime DEFAULT NULL, `updated_at` datetime DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
            "CREATE TABLE IF NOT EXISTS `news` (`id` int unsigned NOT NULL AUTO_INCREMENT, `slug` varchar(160) NOT NULL, `title` varchar(190) NOT NULL, `category` varchar(120) NOT NULL DEFAULT '', `summary` text NOT NULL, `content` longtext NOT NULL, `image_path` varchar(255) DEFAULT NULL, `pdf_path` varchar(255) DEFAULT NULL, `is_published` tinyint(1) NOT NULL DEFAULT '1', `published_at` datetime DEFAULT NULL, `created_at` datetime DEFAULT NULL, `updated_at` datetime DEFAULT NULL, PRIMARY KEY (`id`), UNIQUE KEY `slug` (`slug`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
            "CREATE TABLE IF NOT EXISTS `admin_users` (`id` int unsigned NOT NULL AUTO_INCREMENT, `username` varchar(100) NOT NULL, `password_hash` varchar(255) NOT NULL, `name` varchar(190) NOT NULL DEFAULT 'Administrator', `is_active` tinyint(1) NOT NULL DEFAULT '1', `last_login_at` datetime DEFAULT NULL, `created_at` datetime DEFAULT NULL, `updated_at` datetime DEFAULT NULL, PRIMARY KEY (`id`), UNIQUE KEY `username` (`username`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
            "CREATE TABLE IF NOT EXISTS `contact_messages` (`id` int unsigned NOT NULL AUTO_INCREMENT, `name` varchar(190) NOT NULL, `contact` varchar(190) NOT NULL, `subject` varchar(190) NOT NULL, `message` text NOT NULL, `ip_address` varchar(45) DEFAULT NULL, `user_agent` varchar(255) DEFAULT NULL, `is_read` tinyint(1) NOT NULL DEFAULT '0', `created_at` datetime DEFAULT NULL, `updated_at` datetime DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
        ];

        foreach ($tables as $sql) {
            $db->query($sql);
        }
    }

    public function down()
    {
        $db = \System\Database::connection();

        foreach (['contact_messages', 'admin_users', 'news', 'management', 'products', 'company_profile', 'site_settings'] as $table) {
            $db->query('DROP TABLE IF EXISTS `'.$table.'`');
        }
    }
}
