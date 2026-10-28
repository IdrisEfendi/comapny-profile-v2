<?php

defined('DS') or exit('No direct access.');

class Seed_Company_Profile_Defaults
{
    public function up()
    {
        $db = \System\Database::connection();
        $now = date('Y-m-d H:i:s');

        $settings = [
            'company_name' => 'PT BPR Karawang Jabar (Perseroda)',
            'tagline' => 'Mitra Keuangan Masyarakat Karawang',
            'phone' => '(0264) 8380203',
            'email' => 'ptbptkarawang@gmail.com',
            'notification_email' => 'ptbprkarawangjabar@gmail.com',
            'address' => 'Jln Raya Cilamaya Komplek Kantor Kecamatan Cilamaya Wetan',
            'office_hours' => 'Senin - Jumat, 08:00 - 16:00',
            'google_maps_url' => 'https://maps.app.goo.gl/3mtmYGGbPXPn564z9',
            'whatsapp' => '',
        ];

        foreach ($settings as $key => $value) {
            $db->query('INSERT IGNORE INTO site_settings (`key`, `value`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?)', [$key, $value, $now, $now]);
        }

        $profile = [
            'hero_intro' => 'Profil PT BPR Karawang Jabar (Perseroda) sebagai BPR yang dekat dengan masyarakat Karawang, khususnya area Cilamaya dan sekitarnya.',
            'profile_heading' => 'BPR yang dekat dengan kebutuhan masyarakat Karawang',
            'profile_summary' => 'PT BPR Karawang Jabar (Perseroda) merupakan BPR yang berfokus melayani kebutuhan keuangan masyarakat Karawang. Website ini disiapkan sebagai media informasi publik agar profil perusahaan, produk, pengurus, dan kanal kontak dapat diakses dengan mudah.',
            'area_service' => 'Karawang dan sekitarnya, dengan informasi kantor yang merujuk ke area Cilamaya Wetan.',
            'information_focus' => 'Profil BPR, produk TAHARA, pengurus, alamat, telepon, email, dan jam layanan.',
            'vision' => 'Menjadi BPR daerah yang dikenal dekat dengan masyarakat, mudah diakses, dan mampu mendukung kebutuhan layanan keuangan masyarakat Karawang.',
            'mission' => 'Menyediakan informasi layanan yang jelas, membangun komunikasi yang terbuka, serta membantu masyarakat memperoleh akses informasi produk BPR dengan mudah.',
        ];

        foreach ($profile as $key => $value) {
            $db->query('INSERT IGNORE INTO company_profile (`key`, `value`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?)', [$key, $value, $now, $now]);
        }

        $db->query('INSERT IGNORE INTO products (slug, name, category, subtitle, summary, target, detail_label, is_featured, sort_order, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            'tahara', 'TAHARA', 'Tabungan', 'Tabungan Hari Raya', 'Produk tabungan untuk membantu perencanaan kebutuhan hari raya.', 'Masyarakat umum', 'Hubungi BPR', 1, 0, $now, $now,
        ]);

        $adminPassword = (string) env('ADMIN_PASSWORD', '');
        if ($adminPassword !== '') {
            $db->query('INSERT IGNORE INTO admin_users (username, password_hash, name, is_active, created_at, updated_at) VALUES (?, ?, ?, 1, ?, ?)', [
                (string) env('ADMIN_USERNAME', 'admin'), password_hash($adminPassword, PASSWORD_DEFAULT), (string) env('ADMIN_NAME', 'Administrator'), $now, $now,
            ]);
        }
    }

    public function down()
    {
        $db = \System\Database::connection();
        $db->query("DELETE FROM site_settings WHERE `key` IN ('company_name', 'tagline', 'phone', 'email', 'notification_email', 'address', 'office_hours', 'google_maps_url', 'whatsapp')");
        $db->query("DELETE FROM company_profile WHERE `key` IN ('hero_intro', 'profile_heading', 'profile_summary', 'area_service', 'information_focus', 'vision', 'mission')");
        $db->query("DELETE FROM products WHERE slug = 'tahara'");
    }
}
