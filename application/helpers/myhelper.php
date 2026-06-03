<?php

if (! function_exists('public_default_settings')) {
    /**
     * Default data website public. Disamakan dengan default admin agar public tetap aman
     * ketika file storage/admin/settings.json belum tersedia atau rusak.
     */
    function public_default_settings()
    {
        return [
            'company_name' => 'PT BPR Karawang Jabar (Perseroda)',
            'tagline' => 'Mitra Keuangan Masyarakat Karawang',
            'phone' => '(0264) 8380203',
            'email' => 'ptbptkarawang@gmail.com',
            'address' => 'Jln Raya Cilamaya Komplek Kantor Kecamatan Cilamaya Wetan',
            'office_hours' => 'Senin - Jumat, 08:00 - 14:00',
            'whatsapp' => '',
            'google_maps_url' => '',
        ];
    }
}

if (! function_exists('public_key_value_table')) {
    function public_key_value_table($table, array $defaults)
    {
        try {
            $rows = \System\Database::connection()->query("SELECT `key`, `value` FROM {$table}");

            foreach ($rows as $row) {
                $defaults[$row->key] = $row->value;
            }
        } catch (\Throwable $e) {
            // Fallback default agar public website tetap hidup jika database bermasalah.
        } catch (\Exception $e) {
            // Fallback untuk PHP lama.
        }

        return $defaults;
    }
}

if (! function_exists('public_settings')) {
    /**
     * Ambil seluruh setting public atau satu key tertentu dari database.
     */
    function public_settings($key = null, $default = null)
    {
        static $settings;

        if ($settings === null) {
            $settings = public_key_value_table('site_settings', public_default_settings());
        }

        if ($key === null) {
            return $settings;
        }

        return array_key_exists($key, $settings) && $settings[$key] !== '' ? $settings[$key] : $default;
    }
}

if (! function_exists('public_phone_href')) {
    function public_phone_href($phone = null)
    {
        $phone = $phone ?: public_settings('phone', '');
        $normalized = preg_replace('/[^0-9+]/', '', $phone);

        return $normalized !== '' ? 'tel:'.$normalized : '#';
    }
}

if (! function_exists('public_whatsapp_href')) {
    function public_whatsapp_href($whatsapp = null)
    {
        $whatsapp = $whatsapp ?: public_settings('whatsapp', '');
        $normalized = preg_replace('/[^0-9]/', '', $whatsapp);

        return $normalized !== '' ? 'https://wa.me/'.$normalized : '';
    }
}

if (! function_exists('public_safe_url')) {
    function public_safe_url($url)
    {
        $url = trim((string) $url);

        if ($url === '') {
            return '';
        }

        return preg_match('/^https?:\/\//i', $url) ? $url : '';
    }
}

if (! function_exists('public_default_products')) {
    function public_default_products()
    {
        return [
            [
                'slug' => 'tahara',
                'name' => 'TAHARA',
                'category' => 'Tabungan',
                'subtitle' => 'Tabungan Hari Raya',
                'summary' => 'Produk tabungan untuk membantu perencanaan kebutuhan hari raya.',
                'target' => 'Masyarakat umum',
                'detail_label' => 'Hubungi BPR',
                'is_featured' => true,
            ],
        ];
    }
}

if (! function_exists('public_products')) {
    function public_products()
    {
        static $products;

        if ($products !== null) {
            return $products;
        }

        try {
            $rows = \System\Database::connection()->query('SELECT id, slug, name, category, subtitle, summary, target, detail_label, is_featured FROM products ORDER BY sort_order ASC, id ASC');
            $products = [];

            foreach ($rows as $row) {
                $products[] = [
                    'id' => (int) $row->id,
                    'slug' => $row->slug,
                    'name' => $row->name,
                    'category' => $row->category,
                    'subtitle' => $row->subtitle,
                    'summary' => $row->summary,
                    'target' => $row->target,
                    'detail_label' => $row->detail_label,
                    'is_featured' => (bool) $row->is_featured,
                ];
            }

            if (count($products) === 0) {
                $products = public_default_products();
            }
        } catch (\Throwable $e) {
            $products = public_default_products();
        } catch (\Exception $e) {
            $products = public_default_products();
        }

        return $products;
    }
}

if (! function_exists('public_featured_product')) {
    function public_featured_product()
    {
        foreach (public_products() as $product) {
            if (! empty($product['is_featured'])) {
                return $product;
            }
        }

        $products = public_products();

        return count($products) ? $products[0] : null;
    }
}

if (! function_exists('public_default_management')) {
    function public_default_management()
    {
        return [
            [
                'name' => 'Heri Heryanto SH, MM',
                'position' => 'Direktur Utama',
                'group' => 'Direksi',
                'initials' => 'HH',
                'bio' => 'Memimpin arah operasional dan pengelolaan perusahaan sesuai peran direktur utama dalam struktur organisasi.',
            ],
            [
                'name' => 'Atjeng Hadis Susanto SE',
                'position' => 'Direktur',
                'group' => 'Direksi',
                'initials' => 'AH',
                'bio' => 'Mendukung pengelolaan dan pelaksanaan operasional perusahaan sesuai peran direktur dalam struktur organisasi.',
            ],
            [
                'name' => 'Jaja Sumarna SE',
                'position' => 'Komisaris Utama',
                'group' => 'Komisaris',
                'initials' => 'JS',
                'bio' => 'Informasi jabatan ditampilkan sebagai bagian dari struktur pengurus PT BPR Karawang Jabar (Perseroda).',
            ],
            [
                'name' => 'Dikdik Kustiadi',
                'position' => 'Komisaris',
                'group' => 'Komisaris',
                'initials' => 'DK',
                'bio' => 'Informasi jabatan ditampilkan sebagai bagian dari struktur pengurus PT BPR Karawang Jabar (Perseroda).',
            ],
        ];
    }
}

if (! function_exists('public_management')) {
    function public_management()
    {
        static $management;

        if ($management !== null) {
            return $management;
        }

        try {
            $rows = \System\Database::connection()->query('SELECT id, name, position, group_name, initials, bio FROM management ORDER BY sort_order ASC, id ASC');
            $management = [];

            foreach ($rows as $row) {
                $management[] = [
                    'id' => (int) $row->id,
                    'name' => $row->name,
                    'position' => $row->position,
                    'group' => $row->group_name,
                    'initials' => $row->initials,
                    'bio' => $row->bio,
                ];
            }

            if (count($management) === 0) {
                $management = public_default_management();
            }
        } catch (\Throwable $e) {
            $management = public_default_management();
        } catch (\Exception $e) {
            $management = public_default_management();
        }

        return $management;
    }
}

if (! function_exists('public_management_by_group')) {
    function public_management_by_group($group)
    {
        return array_values(array_filter(public_management(), function ($person) use ($group) {
            return isset($person['group']) && $person['group'] === $group;
        }));
    }
}

if (! function_exists('public_default_company_profile')) {
    function public_default_company_profile()
    {
        return [
            'hero_intro' => 'Profil PT BPR Karawang Jabar (Perseroda) sebagai BPR yang dekat dengan masyarakat Karawang, khususnya area Cilamaya dan sekitarnya.',
            'profile_heading' => 'BPR yang dekat dengan kebutuhan masyarakat Karawang',
            'profile_summary' => 'PT BPR Karawang Jabar (Perseroda) merupakan BPR yang berfokus melayani kebutuhan keuangan masyarakat Karawang. Website ini disiapkan sebagai media informasi publik agar profil perusahaan, produk, pengurus, dan kanal kontak dapat diakses dengan mudah.',
            'area_service' => 'Karawang dan sekitarnya, dengan informasi kantor yang merujuk ke area Cilamaya Wetan.',
            'information_focus' => 'Profil BPR, produk TAHARA, pengurus, alamat, telepon, email, dan jam layanan.',
            'vision' => 'Menjadi BPR daerah yang dikenal dekat dengan masyarakat, mudah diakses, dan mampu mendukung kebutuhan layanan keuangan masyarakat Karawang.',
            'mission' => 'Menyediakan informasi layanan yang jelas, membangun komunikasi yang terbuka, serta membantu masyarakat memperoleh akses informasi produk BPR dengan mudah.',
        ];
    }
}

if (! function_exists('public_company_profile')) {
    function public_company_profile()
    {
        static $profile;

        if ($profile !== null) {
            return $profile;
        }

        $profile = public_key_value_table('company_profile', public_default_company_profile());

        return $profile;
    }
}

if (! function_exists('env')) {
    /**
     * Ambil nilai environment variable dari .env / server environment.
     */
    function env($key, $default = null)
    {
        $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);

        if ($value === false || $value === null) {
            return $default;
        }

        switch (strtolower((string) $value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return null;
        }

        if (is_string($value) && strlen($value) >= 2) {
            $first = $value[0];
            $last = $value[strlen($value) - 1];

            if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                return substr($value, 1, -1);
            }
        }

        return $value;
    }
}
