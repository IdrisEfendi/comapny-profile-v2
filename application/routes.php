<?php

defined('DS') or exit('No direct script access.');

Route::get('/', function () {
    return view('home.index', ['title' => 'Home', 'active' => 'home']);
});

Route::get('tentang-kami', function () {
    return view('pages.about', ['title' => 'Tentang Kami', 'active' => 'about']);
});

Route::get('produk-layanan', function () {
    return view('pages.products', ['title' => 'Produk & Layanan', 'active' => 'products']);
});

Route::get('produk/tahara', function () {
    return view('products.tahara', ['title' => 'TAHARA', 'active' => 'products']);
});

Route::get('pengurus', function () {
    return view('pages.management', ['title' => 'Pengurus', 'active' => 'management']);
});

Route::get('kontak', function () {
    return view('pages.contact', [
        'title' => 'Kontak',
        'active' => 'contact',
        'success' => \System\Session::get('contact_success'),
        'error' => \System\Session::get('contact_error'),
    ]);
});

Route::post('kontak', function () {
    $name = trim((string) \System\Input::get('name'));
    $contact = trim((string) \System\Input::get('contact'));
    $subject = trim((string) \System\Input::get('subject'));
    $message = trim((string) \System\Input::get('message'));

    if ($name === '' || $contact === '' || $message === '') {
        \System\Session::flash('contact_error', 'Nama, email/telepon, dan pesan wajib diisi.');
        return redirect('kontak');
    }

    \System\Database::connection()->query('INSERT INTO contact_messages (name, contact, subject, message, ip_address, user_agent, is_read, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, 0, ?, ?)', [
        $name,
        $contact,
        $subject !== '' ? $subject : 'Pesan dari website',
        $message,
        $_SERVER['REMOTE_ADDR'] ?? null,
        substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255),
        date('Y-m-d H:i:s'),
        date('Y-m-d H:i:s'),
    ]);

    \System\Session::flash('contact_success', 'Pesan berhasil dikirim. Tim kami akan menindaklanjuti melalui kontak yang Anda cantumkan.');
    return redirect('kontak');
});
