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

Route::get('produk/(:any)', function ($slug) {
    $product = public_product_by_slug($slug);

    if (! $product) {
        return \System\Event::first('404');
    }

    return view('products.detail', [
        'title' => $product['name'],
        'active' => 'products',
        'product' => $product,
    ]);
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
    if (! csrf_check((string) \System\Input::get('_token'))) {
        \System\Session::flash('contact_error', 'Sesi form tidak valid. Silakan muat ulang halaman dan kirim kembali.');
        return redirect('kontak');
    }

    $lastSubmit = (int) \System\Session::get('contact_last_submit_at', 0);

    if ($lastSubmit > 0 && (time() - $lastSubmit) < 30) {
        \System\Session::flash('contact_error', 'Mohon tunggu sebentar sebelum mengirim pesan lagi.');
        return redirect('kontak');
    }

    $name = text_limit(\System\Input::get('name'), 190);
    $contact = text_limit(\System\Input::get('contact'), 190);
    $subject = text_limit(\System\Input::get('subject'), 190);
    $message = text_limit(\System\Input::get('message'), 5000);

    if ($name === '' || $contact === '' || $message === '') {
        \System\Session::flash('contact_error', 'Nama, email/telepon, dan pesan wajib diisi.');
        return redirect('kontak');
    }

    if (mb_strlen($message) < 10) {
        \System\Session::flash('contact_error', 'Pesan minimal 10 karakter.');
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

    \System\Session::put('contact_last_submit_at', time());
    \System\Session::flash('contact_success', 'Pesan berhasil dikirim. Tim kami akan menindaklanjuti melalui kontak yang Anda cantumkan.');
    return redirect('kontak');
});
