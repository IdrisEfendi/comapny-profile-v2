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

function admin_post_value($key, $default = null)
{
    return array_key_exists($key, $_POST) ? $_POST[$key] : \System\Input::get($key, $default);
}

function admin_require_csrf($redirect = 'admin/dashboard')
{
    if (! csrf_check((string) admin_post_value('_token'))) {
        \System\Session::flash('admin_error', 'Sesi form tidak valid. Silakan muat ulang halaman dan coba lagi.');
        return redirect($redirect);
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

function admin_contact_messages_url(array $params = [])
{
    $query = array_filter($params, function ($value) {
        return $value !== null && $value !== '';
    });

    return url('admin/contact-messages').(count($query) ? '?'.http_build_query($query) : '');
}

function admin_contact_message_filters()
{
    $q = text_limit(\System\Input::get('q'), 120);
    $status = text_limit(\System\Input::get('status'), 20);
    $allowedStatuses = ['all', 'unread', 'read'];

    if (! in_array($status, $allowedStatuses, true)) {
        $status = 'all';
    }

    $page = max(1, (int) \System\Input::get('page', 1));
    $perPage = 10;

    return compact('q', 'status', 'page', 'perPage');
}

function admin_contact_messages_where(array $filters, array &$bindings)
{
    $where = [];

    if ($filters['status'] === 'unread') {
        $where[] = 'is_read = 0';
    } elseif ($filters['status'] === 'read') {
        $where[] = 'is_read = 1';
    }

    if ($filters['q'] !== '') {
        $where[] = '(name LIKE ? OR contact LIKE ? OR subject LIKE ? OR message LIKE ?)';
        $keyword = '%'.$filters['q'].'%';
        $bindings[] = $keyword;
        $bindings[] = $keyword;
        $bindings[] = $keyword;
        $bindings[] = $keyword;
    }

    return count($where) ? ' WHERE '.implode(' AND ', $where) : '';
}

function admin_get_contact_messages(array $filters)
{
    $bindings = [];
    $where = admin_contact_messages_where($filters, $bindings);
    $offset = max(0, ($filters['page'] - 1) * $filters['perPage']);
    $sql = 'SELECT * FROM contact_messages'.$where.' ORDER BY created_at DESC, id DESC LIMIT '.(int) $filters['perPage'].' OFFSET '.(int) $offset;

    return \System\Database::connection()->query($sql, $bindings);
}

function admin_count_contact_messages(array $filters)
{
    $bindings = [];
    $where = admin_contact_messages_where($filters, $bindings);

    return (int) \System\Database::connection()->only('SELECT COUNT(*) FROM contact_messages'.$where, $bindings);
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
        ['id' => null, 'name' => 'Heri Heryanto SH, MM', 'position' => 'Direktur Utama', 'group' => 'Direksi', 'initials' => 'HH', 'bio' => 'Memimpin arah operasional dan pengelolaan perusahaan sesuai peran direktur utama dalam struktur organisasi.', 'photo_path' => ''],
        ['id' => null, 'name' => 'Atjeng Hadis Susanto SE', 'position' => 'Direktur', 'group' => 'Direksi', 'initials' => 'AH', 'bio' => 'Mendukung pengelolaan dan pelaksanaan operasional perusahaan sesuai peran direktur dalam struktur organisasi.', 'photo_path' => ''],
        ['id' => null, 'name' => 'Jaja Sumarna SE', 'position' => 'Komisaris Utama', 'group' => 'Komisaris', 'initials' => 'JS', 'bio' => 'Informasi jabatan ditampilkan sebagai bagian dari struktur pengurus PT BPR Karawang Jabar (Perseroda).', 'photo_path' => ''],
        ['id' => null, 'name' => 'Dikdik Kustiadi', 'position' => 'Komisaris', 'group' => 'Komisaris', 'initials' => 'DK', 'bio' => 'Informasi jabatan ditampilkan sebagai bagian dari struktur pengurus PT BPR Karawang Jabar (Perseroda).', 'photo_path' => ''],
    ];
}

function admin_get_management()
{
    $rows = \System\Database::connection()->query('SELECT id, name, position, group_name, initials, bio, photo_path FROM management ORDER BY sort_order ASC, id ASC');
    $management = [];

    foreach ($rows as $row) {
        $management[] = [
            'id' => (int) $row->id,
            'name' => $row->name,
            'position' => $row->position,
            'group' => $row->group_name,
            'initials' => $row->initials,
            'bio' => $row->bio,
            'photo_path' => $row->photo_path,
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

function admin_management_upload_dir()
{
    return path('assets').'uploads'.DS.'management';
}

function admin_store_management_photo($key = 'photo')
{
    if (empty($_FILES[$key]) || empty($_FILES[$key]['tmp_name'])) {
        return null;
    }

    if (! is_uploaded_file($_FILES[$key]['tmp_name'])) {
        return null;
    }

    if ((int) $_FILES[$key]['size'] > 2 * 1024 * 1024) {
        throw new \Exception('Ukuran foto maksimal 2MB.');
    }

    $info = getimagesize($_FILES[$key]['tmp_name']);
    $allowed = [
        IMAGETYPE_JPEG => 'jpg',
        IMAGETYPE_PNG => 'png',
        IMAGETYPE_WEBP => 'webp',
    ];

    if (! $info || ! isset($allowed[$info[2]])) {
        throw new \Exception('Format foto harus JPG, PNG, atau WEBP.');
    }

    $dir = admin_management_upload_dir();

    if (! is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    $filename = 'pengurus-'.date('YmdHis').'-'.bin2hex(random_bytes(4)).'.'.$allowed[$info[2]];
    $target = $dir.DS.$filename;

    if (! move_uploaded_file($_FILES[$key]['tmp_name'], $target)) {
        throw new \Exception('Foto gagal diunggah. Periksa permission folder upload.');
    }

    return 'uploads/management/'.$filename;
}

function admin_delete_management_photo($path)
{
    $path = trim((string) $path);

    if ($path === '' || strpos($path, 'uploads/management/') !== 0) {
        return;
    }

    $fullPath = path('assets').str_replace('/', DS, $path);

    if (is_file($fullPath)) {
        @unlink($fullPath);
    }
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
    if (! csrf_check((string) \System\Input::get('_token'))) {
        \System\Session::flash('admin_login_error', 'Sesi form tidak valid. Silakan muat ulang halaman dan coba lagi.');
        return redirect('admin/login');
    }

    $username = text_limit(\System\Input::get('username'), 100);
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

    if ($redirect = admin_require_csrf('admin/account')) {
        return $redirect;
    }

    $user = admin_current_user();
    $username = text_limit(\System\Input::get('username'), 100);
    $name = text_limit(\System\Input::get('name'), 190);
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

    $filters = admin_contact_message_filters();
    $total = admin_count_contact_messages($filters);
    $totalPages = max(1, (int) ceil($total / $filters['perPage']));

    if ($filters['page'] > $totalPages) {
        $filters['page'] = $totalPages;
    }

    return view('admin::contact-messages', [
        'title' => 'Pesan Kontak',
        'active' => 'messages',
        'messages' => admin_get_contact_messages($filters),
        'filters' => $filters,
        'total' => $total,
        'totalPages' => $totalPages,
        'unreadCount' => admin_count_unread_contact_messages(),
        'success' => \System\Session::get('admin_success'),
        'error' => \System\Session::get('admin_error'),
    ]);
});

Route::get('(:package)/contact-messages/(:num)', function ($id) {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    return view('admin::contact-message-detail', [
        'title' => 'Detail Pesan Kontak',
        'active' => 'messages',
        'message' => admin_get_contact_message($id),
    ]);
});

Route::post('(:package)/contact-messages/status', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    if ($redirect = admin_require_csrf('admin/contact-messages')) {
        return $redirect;
    }

    $id = (int) admin_post_value('id');
    $status = admin_post_value('status') === 'read' ? 1 : 0;
    \System\Database::connection()->query('UPDATE contact_messages SET is_read = ?, updated_at = ? WHERE id = ?', [$status, date('Y-m-d H:i:s'), $id]);
    \System\Session::flash('admin_success', $status ? 'Pesan ditandai sudah dibaca.' : 'Pesan ditandai belum dibaca.');

    return redirect(admin_post_value('back', 'admin/contact-messages'));
});

Route::post('(:package)/contact-messages/delete', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    if ($redirect = admin_require_csrf('admin/contact-messages')) {
        return $redirect;
    }

    $id = (int) admin_post_value('id');
    \System\Database::connection()->query('DELETE FROM contact_messages WHERE id = ?', [$id]);
    \System\Session::flash('admin_success', 'Pesan kontak berhasil dihapus.');

    return redirect(admin_post_value('back', 'admin/contact-messages'));
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

    if ($redirect = admin_require_csrf('admin/settings')) {
        return $redirect;
    }

    $settings = [];

    foreach (array_keys(admin_default_settings()) as $key) {
        $settings[$key] = text_limit(\System\Input::get($key), $key === 'address' ? 1000 : 190);
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

    if ($redirect = admin_require_csrf('admin/company-profile')) {
        return $redirect;
    }

    $profile = [];

    foreach (array_keys(admin_default_company_profile()) as $key) {
        $profile[$key] = text_limit(\System\Input::get($key), 5000);
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

    if ($redirect = admin_require_csrf('admin/products')) {
        return $redirect;
    }

    $conn = \System\Database::connection();
    $now = date('Y-m-d H:i:s');
    $originalSlug = text_limit(\System\Input::get('original_slug'), 160);
    $name = text_limit(\System\Input::get('name'), 190);
    $slug = admin_product_slug(\System\Input::get('slug'), $name);
    $isFeatured = (bool) \System\Input::get('is_featured');

    if ($isFeatured) {
        $conn->query('UPDATE products SET is_featured = 0');
    }

    $values = [
        $slug,
        $name !== '' ? $name : strtoupper($slug),
        text_limit(\System\Input::get('category'), 120),
        text_limit(\System\Input::get('subtitle'), 190),
        text_limit(\System\Input::get('summary'), 5000),
        text_limit(\System\Input::get('target'), 190),
        text_limit(\System\Input::get('detail_label'), 190),
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

    if ($redirect = admin_require_csrf('admin/products')) {
        return $redirect;
    }

    $slug = text_limit(\System\Input::get('slug'), 160);
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
        'error' => \System\Session::get('admin_error'),
    ]);
});

Route::post('(:package)/management', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    if ($redirect = admin_require_csrf('admin/management')) {
        return $redirect;
    }

    $conn = \System\Database::connection();
    $now = date('Y-m-d H:i:s');
    $originalId = (int) admin_post_value('original_id');
    $name = text_limit(admin_post_value('name'), 190);
    $position = text_limit(admin_post_value('position'), 190);
    $group = text_limit(admin_post_value('group'), 80);
    $initials = text_limit(admin_post_value('initials'), 10);

    if ($name === '' || $position === '' || $group === '') {
        \System\Session::flash('admin_error', 'Nama, jabatan, dan kelompok pengurus wajib diisi.');
        return redirect('admin/management');
    }
    $existing = $originalId > 0 ? $conn->first('SELECT * FROM management WHERE id = ? LIMIT 1', [$originalId]) : null;
    $photoPath = $existing ? (string) $existing->photo_path : '';

    if ((bool) admin_post_value('remove_photo')) {
        admin_delete_management_photo($photoPath);
        $photoPath = '';
    }

    try {
        $uploadedPhoto = admin_store_management_photo('photo');

        if ($uploadedPhoto) {
            admin_delete_management_photo($photoPath);
            $photoPath = $uploadedPhoto;
        }
    } catch (\Exception $e) {
        \System\Session::flash('admin_error', $e->getMessage());
        return redirect('admin/management');
    }

    $person = [
        $name,
        $position,
        $group,
        $initials !== '' ? strtoupper($initials) : admin_person_initials($name),
        text_limit(admin_post_value('bio'), 5000),
        $photoPath,
        $now,
    ];

    if ($existing) {
        $conn->query('UPDATE management SET name = ?, position = ?, group_name = ?, initials = ?, bio = ?, photo_path = ?, updated_at = ? WHERE id = ?', array_merge($person, [$originalId]));
    } else {
        $sortOrder = (int) $conn->only('SELECT COALESCE(MAX(sort_order), -1) + 1 FROM management');
        $conn->query('INSERT INTO management (name, position, group_name, initials, bio, photo_path, updated_at, sort_order, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', array_merge($person, [$sortOrder, $now]));
    }

    \System\Session::flash('admin_success', 'Data pengurus berhasil disimpan.');

    return redirect('admin/management');
});

Route::post('(:package)/management/delete', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    if ($redirect = admin_require_csrf('admin/management')) {
        return $redirect;
    }

    $id = (int) \System\Input::get('id');
    $person = \System\Database::connection()->first('SELECT photo_path FROM management WHERE id = ? LIMIT 1', [$id]);

    if ($person) {
        admin_delete_management_photo($person->photo_path);
    }

    \System\Database::connection()->query('DELETE FROM management WHERE id = ?', [$id]);
    \System\Session::flash('admin_success', 'Data pengurus berhasil dihapus.');

    return redirect('admin/management');
});
