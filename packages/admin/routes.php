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

function admin_settings_path()
{
    return path('storage').'admin'.DS.'settings.json';
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

function admin_get_settings()
{
    $path = admin_settings_path();
    $defaults = admin_default_settings();

    if (! is_file($path)) {
        return $defaults;
    }

    $json = json_decode(file_get_contents($path), true);

    return is_array($json) ? array_merge($defaults, $json) : $defaults;
}

function admin_save_settings(array $settings)
{
    $dir = dirname(admin_settings_path());

    if (! is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    file_put_contents(admin_settings_path(), json_encode($settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
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

    $validUsername = env('ADMIN_USERNAME', 'admin');
    $validPassword = env('ADMIN_PASSWORD', 'change-me-admin');

    if (hash_equals($validUsername, $username) && hash_equals($validPassword, $password)) {
        \System\Session::put('admin_logged_in', true);
        \System\Session::put('admin_username', $username);

        return redirect('admin/dashboard');
    }

    \System\Session::flash('admin_login_error', 'Username atau password tidak sesuai.');

    return redirect('admin/login');
});

Route::get('(:package)/logout', function () {
    \System\Session::forget('admin_logged_in');
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

    return view('admin::placeholder', [
        'title' => 'Profil Perusahaan',
        'active' => 'company',
        'heading' => 'Profil Perusahaan',
        'description' => 'Kelola ringkasan profil, visi, misi, dan informasi perusahaan dari halaman ini pada tahap berikutnya.',
    ]);
});

Route::get('(:package)/products', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    return view('admin::placeholder', [
        'title' => 'Produk',
        'active' => 'products',
        'heading' => 'Produk',
        'description' => 'Kelola daftar produk seperti TAHARA, detail manfaat, syarat, dan CTA produk pada tahap berikutnya.',
    ]);
});

Route::get('(:package)/management', function () {
    if ($redirect = admin_require_auth()) {
        return $redirect;
    }

    return view('admin::placeholder', [
        'title' => 'Pengurus',
        'active' => 'management',
        'heading' => 'Pengurus',
        'description' => 'Kelola nama, jabatan, foto, dan biodata pengurus pada tahap berikutnya.',
    ]);
});
