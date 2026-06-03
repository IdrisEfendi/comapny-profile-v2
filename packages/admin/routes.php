<?php

defined('DS') or exit('No direct script access.');

function admin_is_logged_in()
{
    return (bool) \System\Session::get('admin_logged_in', false);
}

function admin_require_auth()
{
    if (! admin_is_logged_in()) {
        return redirect('admin/login');
    }

    return null;
}

function admin_find_user_by_username($username)
{
    return \System\Database::connection()->first('SELECT * FROM admin_users WHERE username = ? AND is_active = 1 LIMIT 1', [$username]);
}

function admin_current_user()
{
    $id = (int) \System\Session::get('admin_user_id', 0);

    if ($id <= 0) {
        return null;
    }

    return \System\Database::connection()->first('SELECT * FROM admin_users WHERE id = ? AND is_active = 1 LIMIT 1', [$id]);
}

function admin_update_current_user($username, $name, $password = null)
{
    $id = (int) \System\Session::get('admin_user_id', 0);
    $now = date('Y-m-d H:i:s');

    if ($password !== null && $password !== '') {
        \System\Database::connection()->query('UPDATE admin_users SET username = ?, name = ?, password_hash = ?, updated_at = ? WHERE id = ?', [
            $username,
            $name,
            password_hash($password, PASSWORD_DEFAULT),
            $now,
            $id,
        ]);
    } else {
        \System\Database::connection()->query('UPDATE admin_users SET username = ?, name = ?, updated_at = ? WHERE id = ?', [
            $username,
            $name,
            $now,
            $id,
        ]);
    }

    \System\Session::put('admin_username', $username);
}

function admin_get_contact_messages()
{
    return \System\Database::connection()->query('SELECT * FROM contact_messages ORDER BY created_at DESC, id DESC');
}

function admin_count_unread_contact_messages()
{
    return (int) \System\Database::connection()->only('SELECT COUNT(*) FROM contact_messages WHERE is_read = 0');
}

function admin_get_contact_message($id)
{
    return \System\Database::connection()->first('SELECT * FROM contact_messages WHERE id = ? LIMIT 1', [(int) $id]);
}

function admin_default_settings()
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

function admin_get_key_value_table($table, array $defaults)
{
    $rows = \System\Database::connection()->query("SELECT `key`, `value` FROM {$table}");

    foreach ($rows as $row) {
        $defaults[$row->key] = $row->value;
    }

    return $defaults;
}

function admin_save_key_value_table($table, array $values)
{
    $conn = \System\Database::connection();
    $now = date('Y-m-d H:i:s');

    foreach ($values as $key => $value) {
        $exists = $conn->only("SELECT COUNT(*) FROM {$table} WHERE `key` = ?", [$key]);

        if ((int) $exists > 0) {
            $conn->query("UPDATE {$table} SET `value` = ?, updated_at = ? WHERE `key` = ?", [(string) $value, $now, $key]);
        } else {
            $conn->query("INSERT INTO {$table} (`key`, `value`, created_at, updated_at) VALUES (?, ?, ?, ?)", [$key, (string) $value, $now, $now]);
        }
    }
}

function admin_get_settings()
{
    return admin_get_key_value_table('site_settings', admin_default_settings());
}

function admin_save_settings(array $settings)
{
    admin_save_key_value_table('site_settings', $settings);
}

function admin_default_products()
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

function admin_get_products()
{
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

    return count($products) ? $products : admin_default_products();
}

function admin_product_slug($name, $fallback = 'produk')
{
    $source = trim((string) $name);
    $slug = strtolower($source !== '' ? $source : $fallback);
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');

    return $slug !== '' ? $slug : $fallback;
}

function admin_default_management()
{
    return [
        ['id' => null, 'name' => 'Heri Heryanto SH, MM', 'position' => 'Direktur Utama', 'group' => 'Direksi', 'initials' => 'HH', 'bio' => 'Memimpin arah operasional dan pengelolaan perusahaan sesuai peran direktur utama dalam struktur organisasi.'],
        ['id' => null, 'name' => 'Atjeng Hadis Susanto SE', 'position' => 'Direktur', 'group' => 'Direksi', 'initials' => 'AH', 'bio' => 'Mendukung pengelolaan dan pelaksanaan operasional perusahaan sesuai peran direktur dalam struktur organisasi.'],
        ['id' => null, 'name' => 'Jaja Sumarna SE', 'position' => 'Komisaris Utama', 'group' => 'Komisaris', 'initials' => 'JS', 'bio' => 'Informasi jabatan ditampilkan sebagai bagian dari struktur pengurus PT BPR Karawang Jabar (Perseroda).'],
        ['id' => null, 'name' => 'Dikdik Kustiadi', 'position' => 'Komisaris', 'group' => 'Komisaris', 'initials' => 'DK', 'bio' => 'Informasi jabatan ditampilkan sebagai bagian dari struktur pengurus PT BPR Karawang Jabar (Perseroda).'],
    ];
}

function admin_get_management()
{
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

    return count($management) ? $management : admin_default_management();
}

function admin_person_initials($name)
{
    $words = preg_split('/\s+/', trim((string) $name));
    $initials = '';

    foreach ($words as $word) {
        if ($word !== '') {
            $initials .= strtoupper(substr($word, 0, 1));
        }

        if (strlen($initials) >= 2) {
            break;
        }
    }

    return $initials !== '' ? $initials : 'PG';
}

function admin_default_company_profile()
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

function admin_get_company_profile()
{
    return admin_get_key_value_table('company_profile', admin_default_company_profile());
}

function admin_save_company_profile(array $profile)
{
    admin_save_key_value_table('company_profile', $profile);
}

Route::get('(:package)', function () {
    return redirect('admin/dashboard');
});

Route::get('(:package)/login', function () {
    if (admin_is_logged_in()) {
        return redirect('admin/dashboard');
    }

    return view('admin::login', [
        'title' => 'Login Admin',
        'error' => \System\Session::get('admin_login_error'),
    ]);
});

Route::post('(:package)/login', function () {
    $username = trim((string) \System\Input::get('username'));
    $password = (string) \System\Input::get('password');
    $user = admin_find_user_by_username($username);

    if ($user && password_verify($password, $user->password_hash)) {
        \System\Session::put('admin_logged_in', true);
        \System\Session::put('admin_user_id', (int) $user->id);
        \System\Session::put('admin_username', $user->username);
        \System\Database::connection()->query('UPDATE admin_users SET last_login_at = ? WHERE id = ?', [date('Y-m-d H:i:s'), (int) $user->id]);

        return redirect('admin/dashboard');
    }

    \System\Session::flash('admin_login_error', 'Username atau password tidak sesuai.');

    return redirect('admin/login');
});

Route::get('(:package)/logout', function () {
    \System\Session::forget('admin_logged_in');
    \System\Session::forget('admin_user_id');
    \System\Session::forget('admin_username');

    return redirect('admin/login');
});

Route::get('(:package)/dashboard', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    return view('admin::dashboard', [
        'title' => 'Dashboard Admin',
        'active' => 'dashboard',
        'settings' => admin_get_settings(),
    ]);
});

Route::get('(:package)/account', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    return view('admin::account', [
        'title' => 'Akun Admin',
        'active' => 'account',
        'user' => admin_current_user(),
        'success' => \System\Session::get('admin_success'),
        'error' => \System\Session::get('admin_error'),
    ]);
});

Route::post('(:package)/account', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    $user = admin_current_user();
    $username = trim((string) \System\Input::get('username'));
    $name = trim((string) \System\Input::get('name'));
    $currentPassword = (string) \System\Input::get('current_password');
    $newPassword = (string) \System\Input::get('new_password');
    $confirmPassword = (string) \System\Input::get('confirm_password');

    if (! $user || ! password_verify($currentPassword, $user->password_hash)) {
        \System\Session::flash('admin_error', 'Password saat ini tidak sesuai.');
        return redirect('admin/account');
    }

    if ($username === '') {
        \System\Session::flash('admin_error', 'Username wajib diisi.');
        return redirect('admin/account');
    }

    if ($newPassword !== '' && $newPassword !== $confirmPassword) {
        \System\Session::flash('admin_error', 'Konfirmasi password baru tidak sama.');
        return redirect('admin/account');
    }

    if ($newPassword !== '' && strlen($newPassword) < 8) {
        \System\Session::flash('admin_error', 'Password baru minimal 8 karakter.');
        return redirect('admin/account');
    }

    admin_update_current_user($username, $name !== '' ? $name : 'Administrator', $newPassword !== '' ? $newPassword : null);
    \System\Session::flash('admin_success', 'Akun admin berhasil diperbarui.');

    return redirect('admin/account');
});

Route::get('(:package)/contact-messages', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    return view('admin::contact-messages', [
        'title' => 'Pesan Kontak',
        'active' => 'messages',
        'messages' => admin_get_contact_messages(),
        'unreadCount' => admin_count_unread_contact_messages(),
        'success' => \System\Session::get('admin_success'),
    ]);
});

Route::get('(:package)/contact-messages/(:num)', function ($id) {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    \System\Database::connection()->query('UPDATE contact_messages SET is_read = 1, updated_at = ? WHERE id = ?', [date('Y-m-d H:i:s'), (int) $id]);

    return view('admin::contact-message-detail', [
        'title' => 'Detail Pesan Kontak',
        'active' => 'messages',
        'message' => admin_get_contact_message($id),
    ]);
});

Route::post('(:package)/contact-messages/delete', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    $id = (int) \System\Input::get('id');
    \System\Database::connection()->query('DELETE FROM contact_messages WHERE id = ?', [$id]);
    \System\Session::flash('admin_success', 'Pesan kontak berhasil dihapus.');

    return redirect('admin/contact-messages');
});

Route::get('(:package)/settings', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    return view('admin::settings', [
        'title' => 'Pengaturan Website',
        'active' => 'settings',
        'settings' => admin_get_settings(),
        'success' => \System\Session::get('admin_success'),
    ]);
});

Route::post('(:package)/settings', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    $settings = [];

    foreach (array_keys(admin_default_settings()) as $key) {
        $settings[$key] = trim((string) \System\Input::get($key));
    }

    admin_save_settings($settings);
    \System\Session::flash('admin_success', 'Pengaturan berhasil disimpan.');

    return redirect('admin/settings');
});

Route::get('(:package)/company-profile', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    return view('admin::company-profile', [
        'title' => 'Profil Perusahaan',
        'active' => 'company',
        'profile' => admin_get_company_profile(),
        'success' => \System\Session::get('admin_success'),
    ]);
});

Route::post('(:package)/company-profile', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    $profile = [];

    foreach (array_keys(admin_default_company_profile()) as $key) {
        $profile[$key] = trim((string) \System\Input::get($key));
    }

    admin_save_company_profile($profile);
    \System\Session::flash('admin_success', 'Profil perusahaan berhasil disimpan.');

    return redirect('admin/company-profile');
});

Route::get('(:package)/products', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    return view('admin::products', [
        'title' => 'Produk',
        'active' => 'products',
        'products' => admin_get_products(),
        'success' => \System\Session::get('admin_success'),
    ]);
});

Route::post('(:package)/products', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    $conn = \System\Database::connection();
    $now = date('Y-m-d H:i:s');
    $originalSlug = trim((string) \System\Input::get('original_slug'));
    $name = trim((string) \System\Input::get('name'));
    $slug = admin_product_slug(\System\Input::get('slug'), $name);
    $isFeatured = (bool) \System\Input::get('is_featured');

    if ($isFeatured) {
        $conn->query('UPDATE products SET is_featured = 0');
    }

    $values = [
        $slug,
        $name !== '' ? $name : strtoupper($slug),
        trim((string) \System\Input::get('category')),
        trim((string) \System\Input::get('subtitle')),
        trim((string) \System\Input::get('summary')),
        trim((string) \System\Input::get('target')),
        trim((string) \System\Input::get('detail_label')),
        $isFeatured ? 1 : 0,
        $now,
    ];

    if ($originalSlug !== '' && (int) $conn->only('SELECT COUNT(*) FROM products WHERE slug = ?', [$originalSlug]) > 0) {
        $conn->query('UPDATE products SET slug = ?, name = ?, category = ?, subtitle = ?, summary = ?, target = ?, detail_label = ?, is_featured = ?, updated_at = ? WHERE slug = ?', array_merge($values, [$originalSlug]));
    } else {
        $sortOrder = (int) $conn->only('SELECT COALESCE(MAX(sort_order), -1) + 1 FROM products');
        $conn->query('INSERT INTO products (slug, name, category, subtitle, summary, target, detail_label, is_featured, updated_at, sort_order, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', array_merge($values, [$sortOrder, $now]));
    }

    \System\Session::flash('admin_success', 'Produk berhasil disimpan.');

    return redirect('admin/products');
});

Route::post('(:package)/products/delete', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    $slug = trim((string) \System\Input::get('slug'));
    \System\Database::connection()->query('DELETE FROM products WHERE slug = ?', [$slug]);
    \System\Session::flash('admin_success', 'Produk berhasil dihapus.');

    return redirect('admin/products');
});

Route::get('(:package)/management', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    return view('admin::management', [
        'title' => 'Pengurus',
        'active' => 'management',
        'management' => admin_get_management(),
        'success' => \System\Session::get('admin_success'),
    ]);
});

Route::post('(:package)/management', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    $conn = \System\Database::connection();
    $now = date('Y-m-d H:i:s');
    $originalId = (int) \System\Input::get('original_id');
    $name = trim((string) \System\Input::get('name'));
    $initials = trim((string) \System\Input::get('initials'));
    $person = [
        $name,
        trim((string) \System\Input::get('position')),
        trim((string) \System\Input::get('group')),
        $initials !== '' ? strtoupper($initials) : admin_person_initials($name),
        trim((string) \System\Input::get('bio')),
        $now,
    ];

    if ($originalId > 0 && (int) $conn->only('SELECT COUNT(*) FROM management WHERE id = ?', [$originalId]) > 0) {
        $conn->query('UPDATE management SET name = ?, position = ?, group_name = ?, initials = ?, bio = ?, updated_at = ? WHERE id = ?', array_merge($person, [$originalId]));
    } else {
        $sortOrder = (int) $conn->only('SELECT COALESCE(MAX(sort_order), -1) + 1 FROM management');
        $conn->query('INSERT INTO management (name, position, group_name, initials, bio, updated_at, sort_order, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', array_merge($person, [$sortOrder, $now]));
    }

    \System\Session::flash('admin_success', 'Data pengurus berhasil disimpan.');

    return redirect('admin/management');
});

Route::post('(:package)/management/delete', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    $id = (int) \System\Input::get('id');
    \System\Database::connection()->query('DELETE FROM management WHERE id = ?', [$id]);
    \System\Session::flash('admin_success', 'Data pengurus berhasil dihapus.');

    return redirect('admin/management');
});
