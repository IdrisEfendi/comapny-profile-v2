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

function admin_list_users()
{
    $rows = \System\Database::connection()->query('SELECT id, username, name, is_active, last_login_at FROM admin_users ORDER BY id ASC');
    $users = [];

    foreach ($rows as $row) {
        $users[] = [
            'id' => (int) $row->id,
            'username' => $row->username,
            'name' => $row->name,
            'is_active' => (bool) $row->is_active,
            'last_login_at' => $row->last_login_at,
        ];
    }

    return $users;
}

function admin_find_user($id)
{
    $row = \System\Database::connection()->first('SELECT id, username, name, is_active, last_login_at FROM admin_users WHERE id = ? LIMIT 1', [(int) $id]);

    if (! $row) {
        return null;
    }

    return [
        'id' => (int) $row->id,
        'username' => $row->username,
        'name' => $row->name,
        'is_active' => (bool) $row->is_active,
        'last_login_at' => $row->last_login_at,
    ];
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
        'notification_email' => '',
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

function admin_list_products()
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

    return $products;
}

function admin_get_products()
{
    $products = admin_list_products();

    return count($products) ? $products : admin_default_products();
}

function admin_find_product_by_id($id)
{
    $row = \System\Database::connection()->first('SELECT id, slug, name, category, subtitle, summary, target, detail_label, is_featured FROM products WHERE id = ? LIMIT 1', [(int) $id]);

    if (! $row) {
        return null;
    }

    return [
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

function admin_list_management()
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
            'photo_path' => (string) $row->photo_path,
        ];
    }

    return $management;
}

function admin_get_management()
{
    $management = admin_list_management();

    return count($management) ? $management : admin_default_management();
}

function admin_find_management($id)
{
    $row = \System\Database::connection()->first('SELECT id, name, position, group_name, initials, bio, photo_path FROM management WHERE id = ? LIMIT 1', [(int) $id]);

    if (! $row) {
        return null;
    }

    return [
        'id' => (int) $row->id,
        'name' => $row->name,
        'position' => $row->position,
        'group' => $row->group_name,
        'initials' => $row->initials,
        'bio' => $row->bio,
        'photo_path' => (string) $row->photo_path,
    ];
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
        'users' => admin_list_users(),
        'currentId' => (int) \System\Session::get('admin_user_id', 0),
        'success' => \System\Session::get('admin_success'),
        'error' => \System\Session::get('admin_error'),
    ]);
});

Route::get('(:package)/account/create', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    return view('admin::account-form', [
        'title' => 'Tambah Akun',
        'active' => 'account',
        'user' => null,
        'error' => \System\Session::get('admin_error'),
    ]);
});

Route::get('(:package)/account/(:num)/edit', function ($id) {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    $user = admin_find_user($id);

    if (! $user) {
        \System\Session::flash('admin_error', 'Akun tidak ditemukan.');
        return redirect('admin/account');
    }

    return view('admin::account-form', [
        'title' => 'Edit Akun',
        'active' => 'account',
        'user' => $user,
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

    $conn = \System\Database::connection();
    $now = date('Y-m-d H:i:s');
    $originalId = (int) admin_post_value('original_id');
    $username = text_limit(admin_post_value('username'), 100);
    $name = text_limit(admin_post_value('name'), 190);
    $password = (string) admin_post_value('password');
    $confirmPassword = (string) admin_post_value('confirm_password');
    $formUrl = $originalId > 0 ? 'admin/account/'.$originalId.'/edit' : 'admin/account/create';
    $existing = $originalId > 0 ? $conn->first('SELECT * FROM admin_users WHERE id = ? LIMIT 1', [$originalId]) : null;

    if ($originalId > 0 && ! $existing) {
        \System\Session::flash('admin_error', 'Akun tidak ditemukan.');
        return redirect('admin/account');
    }

    if ($username === '') {
        \System\Session::flash('admin_error', 'Username wajib diisi.');
        return redirect($formUrl);
    }

    if ((int) $conn->only('SELECT COUNT(*) FROM admin_users WHERE username = ? AND id != ?', [$username, $originalId]) > 0) {
        \System\Session::flash('admin_error', 'Username "'.$username.'" sudah dipakai akun lain.');
        return redirect($formUrl);
    }

    if (! $existing && $password === '') {
        \System\Session::flash('admin_error', 'Password wajib diisi untuk akun baru.');
        return redirect($formUrl);
    }

    if ($password !== '' && $password !== $confirmPassword) {
        \System\Session::flash('admin_error', 'Konfirmasi password tidak sama.');
        return redirect($formUrl);
    }

    if ($password !== '' && strlen($password) < 8) {
        \System\Session::flash('admin_error', 'Password minimal 8 karakter.');
        return redirect($formUrl);
    }

    $displayName = $name !== '' ? $name : 'Administrator';

    if ($existing) {
        if ($password !== '') {
            $conn->query('UPDATE admin_users SET username = ?, name = ?, password_hash = ?, updated_at = ? WHERE id = ?', [$username, $displayName, password_hash($password, PASSWORD_DEFAULT), $now, $originalId]);
        } else {
            $conn->query('UPDATE admin_users SET username = ?, name = ?, updated_at = ? WHERE id = ?', [$username, $displayName, $now, $originalId]);
        }
    } else {
        $conn->query('INSERT INTO admin_users (username, password_hash, name, is_active, created_at, updated_at) VALUES (?, ?, ?, 1, ?, ?)', [$username, password_hash($password, PASSWORD_DEFAULT), $displayName, $now, $now]);
    }

    if ($existing && (int) \System\Session::get('admin_user_id', 0) === $originalId) {
        \System\Session::put('admin_username', $username);
    }

    \System\Session::flash('admin_success', 'Akun berhasil disimpan.');

    return redirect('admin/account');
});

Route::post('(:package)/account/delete', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    if ($redirect = admin_require_csrf('admin/account')) {
        return $redirect;
    }

    $id = (int) \System\Input::get('id');
    \System\Database::connection()->query('DELETE FROM admin_users WHERE id = ?', [$id]);
    \System\Session::flash('admin_success', 'Akun berhasil dihapus.');

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
        'products' => admin_list_products(),
        'success' => \System\Session::get('admin_success'),
        'error' => \System\Session::get('admin_error'),
    ]);
});

Route::get('(:package)/products/create', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    return view('admin::products-form', [
        'title' => 'Tambah Produk',
        'active' => 'products',
        'product' => null,
        'error' => \System\Session::get('admin_error'),
    ]);
});

Route::get('(:package)/products/(:num)/edit', function ($id) {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    $product = admin_find_product_by_id($id);

    if (! $product) {
        \System\Session::flash('admin_error', 'Produk tidak ditemukan.');
        return redirect('admin/products');
    }

    return view('admin::products-form', [
        'title' => 'Edit Produk',
        'active' => 'products',
        'product' => $product,
        'error' => \System\Session::get('admin_error'),
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
    $originalId = (int) admin_post_value('original_id');
    $name = text_limit(\System\Input::get('name'), 190);
    $slug = admin_product_slug(\System\Input::get('slug'), $name);
    $isFeatured = (bool) \System\Input::get('is_featured');
    $formUrl = $originalId > 0 ? 'admin/products/'.$originalId.'/edit' : 'admin/products/create';
    $existing = $originalId > 0 ? $conn->first('SELECT id FROM products WHERE id = ? LIMIT 1', [$originalId]) : null;

    if ($name === '') {
        \System\Session::flash('admin_error', 'Nama produk wajib diisi.');
        return redirect($formUrl);
    }

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

    if ($existing) {
        $conn->query('UPDATE products SET slug = ?, name = ?, category = ?, subtitle = ?, summary = ?, target = ?, detail_label = ?, is_featured = ?, updated_at = ? WHERE id = ?', array_merge($values, [$originalId]));
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
        'management' => admin_list_management(),
        'success' => \System\Session::get('admin_success'),
        'error' => \System\Session::get('admin_error'),
    ]);
});

Route::get('(:package)/management/create', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    return view('admin::management-form', [
        'title' => 'Tambah Pengurus',
        'active' => 'management',
        'person' => null,
        'error' => \System\Session::get('admin_error'),
    ]);
});

Route::get('(:package)/management/(:num)/edit', function ($id) {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    $person = admin_find_management($id);

    if (! $person) {
        \System\Session::flash('admin_error', 'Data pengurus tidak ditemukan.');
        return redirect('admin/management');
    }

    return view('admin::management-form', [
        'title' => 'Edit Pengurus',
        'active' => 'management',
        'person' => $person,
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

    $formUrl = $originalId > 0 ? 'admin/management/'.$originalId.'/edit' : 'admin/management/create';

    if ($name === '' || $position === '' || $group === '') {
        \System\Session::flash('admin_error', 'Nama, jabatan, dan kelompok pengurus wajib diisi.');
        return redirect($formUrl);
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
        return redirect($formUrl);
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

function admin_news_upload_dir()
{
    return path('assets').'uploads'.DS.'news';
}

function admin_store_news_upload($key = 'file')
{
    if (empty($_FILES[$key]) || ! isset($_FILES[$key]['error'])) {
        throw new \Exception('Tidak ada file yang diunggah.');
    }

    $error = (int) $_FILES[$key]['error'];

    if ($error === UPLOAD_ERR_INI_SIZE || $error === UPLOAD_ERR_FORM_SIZE) {
        throw new \Exception('Ukuran file melebihi batas server (maksimal sekitar 2MB).');
    }

    if ($error === UPLOAD_ERR_NO_FILE) {
        throw new \Exception('Tidak ada file yang dipilih.');
    }

    if ($error !== UPLOAD_ERR_OK) {
        throw new \Exception('File gagal diunggah. Silakan coba lagi.');
    }

    $size = (int) $_FILES[$key]['size'];

    if ($size <= 0) {
        throw new \Exception('File tidak valid atau kosong.');
    }

    if ($size > 2 * 1024 * 1024) {
        throw new \Exception('Ukuran file maksimal 2MB.');
    }

    $tmp = (string) $_FILES[$key]['tmp_name'];

    if (! is_uploaded_file($tmp)) {
        throw new \Exception('File tidak valid.');
    }

    $original = (string) $_FILES[$key]['name'];
    $extension = strtolower(pathinfo($original, PATHINFO_EXTENSION));
    $imageTypes = [
        'jpg' => IMAGETYPE_JPEG,
        'jpeg' => IMAGETYPE_JPEG,
        'png' => IMAGETYPE_PNG,
        'webp' => IMAGETYPE_WEBP,
        'gif' => IMAGETYPE_GIF,
    ];

    $type = null;
    $storedExtension = null;
    $info = @getimagesize($tmp);

    if ($info && isset($imageTypes[$extension]) && $imageTypes[$extension] === $info[2]) {
        $type = 'image';
        $storedExtension = ($extension === 'jpeg') ? 'jpg' : $extension;
    } elseif ($extension === 'pdf') {
        $mime = class_exists('finfo') ? (new \finfo(FILEINFO_MIME_TYPE))->file($tmp) : '';
        $head = (string) @file_get_contents($tmp, false, null, 0, 5);

        if ($mime === 'application/pdf' && strncmp($head, '%PDF-', 5) === 0) {
            $type = 'pdf';
            $storedExtension = 'pdf';
        }
    }

    if ($type === null) {
        throw new \Exception('Tipe file tidak didukung. Gunakan gambar (JPG, PNG, WEBP, GIF) atau PDF.');
    }

    $dir = admin_news_upload_dir();

    if (! is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    $filename = 'berita-'.date('YmdHis').'-'.bin2hex(random_bytes(4)).'.'.$storedExtension;
    $target = $dir.DS.$filename;

    if (! move_uploaded_file($tmp, $target)) {
        throw new \Exception('File gagal disimpan. Periksa permission folder upload.');
    }

    return [
        'type' => $type,
        'name' => $original,
        'path' => 'uploads/news/'.$filename,
        'url' => asset('uploads/news/'.$filename),
    ];
}

function admin_news_filters()
{
    $page = max(1, (int) \System\Input::get('page', 1));

    return ['page' => $page, 'perPage' => 10];
}

function admin_get_news(array $filters)
{
    try {
        $offset = max(0, ($filters['page'] - 1) * $filters['perPage']);
        $rows = \System\Database::connection()->query('SELECT id, slug, title, category, summary, content, is_published, published_at FROM news ORDER BY published_at DESC, id DESC LIMIT '.(int) $filters['perPage'].' OFFSET '.(int) $offset);
        $news = [];

        foreach ($rows as $row) {
            $news[] = [
                'id' => (int) $row->id,
                'slug' => $row->slug,
                'title' => $row->title,
                'category' => $row->category,
                'summary' => $row->summary,
                'content' => $row->content,
                'is_published' => (bool) $row->is_published,
                'published_at' => $row->published_at,
            ];
        }

        return $news;
    } catch (\Throwable $e) {
        return [];
    } catch (\Exception $e) {
        return [];
    }
}

function admin_find_news_by_id($id)
{
    try {
        $row = \System\Database::connection()->first('SELECT id, slug, title, category, summary, content, is_published, published_at FROM news WHERE id = ? LIMIT 1', [(int) $id]);
    } catch (\Throwable $e) {
        return null;
    } catch (\Exception $e) {
        return null;
    }

    if (! $row) {
        return null;
    }

    return [
        'id' => (int) $row->id,
        'slug' => $row->slug,
        'title' => $row->title,
        'category' => $row->category,
        'summary' => $row->summary,
        'content' => $row->content,
        'is_published' => (bool) $row->is_published,
        'published_at' => $row->published_at,
    ];
}

function admin_count_news()
{
    try {
        return (int) \System\Database::connection()->only('SELECT COUNT(*) FROM news');
    } catch (\Throwable $e) {
        return 0;
    } catch (\Exception $e) {
        return 0;
    }
}

function admin_news_slug($slug, $fallback = 'berita')
{
    $source = trim((string) $slug);
    $slug = strtolower($source !== '' ? $source : $fallback);
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');

    return $slug !== '' ? $slug : 'berita';
}

Route::get('(:package)/news', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    $filters = admin_news_filters();
    $total = admin_count_news();
    $totalPages = max(1, (int) ceil($total / $filters['perPage']));

    if ($filters['page'] > $totalPages) {
        $filters['page'] = $totalPages;
    }

    return view('admin::news', [
        'title' => 'Berita & Pengumuman',
        'active' => 'news',
        'news' => admin_get_news($filters),
        'filters' => $filters,
        'total' => $total,
        'totalPages' => $totalPages,
        'success' => \System\Session::get('admin_success'),
        'error' => \System\Session::get('admin_error'),
    ]);
});

Route::get('(:package)/news/create', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    return view('admin::news-form', [
        'title' => 'Tambah Berita',
        'active' => 'news',
        'item' => null,
        'error' => \System\Session::get('admin_error'),
    ]);
});

Route::get('(:package)/news/(:num)/edit', function ($id) {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    $item = admin_find_news_by_id($id);

    if (! $item) {
        \System\Session::flash('admin_error', 'Berita tidak ditemukan.');
        return redirect('admin/news');
    }

    return view('admin::news-form', [
        'title' => 'Edit Berita',
        'active' => 'news',
        'item' => $item,
        'error' => \System\Session::get('admin_error'),
    ]);
});

Route::post('(:package)/news/upload', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    if ($redirect = admin_require_csrf('admin/news')) {
        return $redirect;
    }

    try {
        $file = admin_store_news_upload('file');

        return \System\Response::json([
            'ok' => true,
            'type' => $file['type'],
            'name' => $file['name'],
            'url' => $file['url'],
        ]);
    } catch (\Throwable $e) {
        return \System\Response::json(['ok' => false, 'error' => $e->getMessage()], 422);
    } catch (\Exception $e) {
        return \System\Response::json(['ok' => false, 'error' => $e->getMessage()], 422);
    }
});

Route::post('(:package)/news', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    if ($redirect = admin_require_csrf('admin/news')) {
        return $redirect;
    }

    $conn = \System\Database::connection();
    $now = date('Y-m-d H:i:s');
    $page = max(1, (int) \System\Input::get('page', 1));
    $originalId = (int) admin_post_value('original_id');
    $title = text_limit(\System\Input::get('title'), 190);
    $slug = admin_news_slug(\System\Input::get('slug'), $title);
    $category = text_limit(\System\Input::get('category'), 120);
    $summary = text_limit(\System\Input::get('summary'), 5000);
    $content = text_limit(\System\Input::get('content'), 50000);
    $isPublished = (bool) \System\Input::get('is_published');
    $redirectTo = $page > 1 ? 'admin/news?page='.$page : 'admin/news';
    $formUrl = $originalId > 0 ? 'admin/news/'.$originalId.'/edit' : 'admin/news/create';

    if ($title === '') {
        \System\Session::flash('admin_error', 'Judul berita wajib diisi.');
        return redirect($formUrl);
    }

    try {
        $bindings = $originalId > 0 ? [$slug, $originalId] : [$slug];
        $checkSlug = $originalId > 0 ? 'SELECT COUNT(*) FROM news WHERE slug = ? AND id != ?' : 'SELECT COUNT(*) FROM news WHERE slug = ?';

        if ((int) $conn->only($checkSlug, $bindings) > 0) {
            \System\Session::flash('admin_error', 'Slug "'.$slug.'" sudah dipakai berita lain. Gunakan slug yang berbeda.');
            return redirect($formUrl);
        }

        $existing = $originalId > 0 ? $conn->first('SELECT id, published_at FROM news WHERE id = ? LIMIT 1', [$originalId]) : null;
        $publishedAt = $existing ? $existing->published_at : null;

        if ($isPublished) {
            if (! $publishedAt) {
                $publishedAt = $now;
            }
        } else {
            $publishedAt = null;
        }

        if ($existing) {
            $conn->query('UPDATE news SET slug = ?, title = ?, category = ?, summary = ?, content = ?, is_published = ?, published_at = ?, updated_at = ? WHERE id = ?', [
                $slug, $title, $category, $summary, $content, $isPublished ? 1 : 0, $publishedAt, $now, $existing->id,
            ]);
        } else {
            $conn->query('INSERT INTO news (slug, title, category, summary, content, is_published, published_at, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $slug, $title, $category, $summary, $content, $isPublished ? 1 : 0, $publishedAt, $now, $now,
            ]);
        }

        \System\Session::flash('admin_success', 'Berita berhasil disimpan.');
    } catch (\Throwable $e) {
        \System\Session::flash('admin_error', 'Gagal menyimpan berita. Periksa database dan skema tabel news.');
        return redirect($formUrl);
    } catch (\Exception $e) {
        \System\Session::flash('admin_error', 'Gagal menyimpan berita. Periksa database dan skema tabel news.');
        return redirect($formUrl);
    }

    return redirect($redirectTo);
});

Route::post('(:package)/news/delete', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    if ($redirect = admin_require_csrf('admin/news')) {
        return $redirect;
    }

    $page = max(1, (int) \System\Input::get('page', 1));
    $redirectTo = $page > 1 ? 'admin/news?page='.$page : 'admin/news';

    try {
        $slug = text_limit(\System\Input::get('slug'), 160);
        \System\Database::connection()->query('DELETE FROM news WHERE slug = ?', [$slug]);
        \System\Session::flash('admin_success', 'Berita berhasil dihapus.');
    } catch (\Throwable $e) {
        \System\Session::flash('admin_error', 'Gagal menghapus berita.');
    } catch (\Exception $e) {
        \System\Session::flash('admin_error', 'Gagal menghapus berita.');
    }

    return redirect($redirectTo);
});
