<?php

defined('DS') or exit('No direct script access.');

Route::get('/', function () {
    return view('home.index', [
        'title' => '',
        'active' => 'home',
        'description' => 'Website resmi PT BPR Karawang Jabar (Perseroda): profil perusahaan, produk TAHARA, pengurus, serta kanal kontak BPR di Karawang.',
    ]);
});

Route::get('tentang-kami', function () {
    return view('pages.about', [
        'title' => 'Tentang Kami',
        'active' => 'about',
        'description' => 'Profil, visi, misi, dan area layanan PT BPR Karawang Jabar (Perseroda), BPR yang dekat dengan masyarakat Karawang.',
    ]);
});

Route::get('produk-layanan', function () {
    return view('pages.products', [
        'title' => 'Produk & Layanan',
        'active' => 'products',
        'description' => 'Daftar produk dan layanan PT BPR Karawang Jabar (Perseroda), termasuk TAHARA (Tabungan Hari Raya).',
    ]);
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
        'description' => text_limit($product['summary'], 160),
    ]);
});

Route::get('pengurus', function () {
    return view('pages.management', [
        'title' => 'Pengurus',
        'active' => 'management',
        'description' => 'Daftar direksi dan komisaris PT BPR Karawang Jabar (Perseroda).',
    ]);
});

Route::get('berita', function () {
    return view('pages.news', [
        'title' => 'Berita & Pengumuman',
        'active' => 'news',
        'description' => 'Berita dan pengumuman terbaru dari PT BPR Karawang Jabar (Perseroda).',
    ]);
});

Route::get('berita/(:any)', function ($slug) {
    $item = public_news_by_slug($slug);

    if (! $item) {
        return \System\Event::first('404');
    }

    return view('news.detail', [
        'title' => $item['title'],
        'active' => 'news',
        'item' => $item,
        'description' => text_limit($item['summary'], 160),
        'og_type' => 'article',
    ]);
});

Route::get('kontak', function () {
    return view('pages.contact', [
        'title' => 'Kontak',
        'active' => 'contact',
        'description' => 'Alamat, telepon, email, dan jam layanan PT BPR Karawang Jabar (Perseroda) di Cilamaya Wetan, Karawang.',
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

    if ($subject === '') {
        $subject = 'Pesan dari website';
    }

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
        $subject,
        $message,
        $_SERVER['REMOTE_ADDR'] ?? null,
        substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255),
        date('Y-m-d H:i:s'),
        date('Y-m-d H:i:s'),
    ]);

    send_contact_notification_email([
        'name' => $name,
        'contact' => $contact,
        'subject' => $subject,
        'message' => $message,
    ]);

    \System\Session::put('contact_last_submit_at', time());
    \System\Session::flash('contact_success', 'Pesan berhasil dikirim. Tim kami akan menindaklanjuti melalui kontak yang Anda cantumkan.');
    return redirect('kontak');
});

Route::get('sitemap.xml', function () {
    $request = \System\Request::foundation();
    $base = $request->getScheme().'://'.$request->getHttpHost();

    $urls = [
        ['loc' => $base.'/', 'lastmod' => date('Y-m-d'), 'freq' => 'daily', 'priority' => '1.0'],
        ['loc' => $base.'/tentang-kami', 'freq' => 'monthly', 'priority' => '0.8'],
        ['loc' => $base.'/produk-layanan', 'freq' => 'weekly', 'priority' => '0.8'],
        ['loc' => $base.'/pengurus', 'freq' => 'monthly', 'priority' => '0.6'],
        ['loc' => $base.'/berita', 'freq' => 'weekly', 'priority' => '0.7'],
        ['loc' => $base.'/kontak', 'freq' => 'monthly', 'priority' => '0.7'],
    ];

    foreach (public_products() as $product) {
        $urls[] = ['loc' => $base.'/produk/'.$product['slug'], 'freq' => 'monthly', 'priority' => '0.7'];
    }

    foreach (public_news() as $item) {
        $lastmod = (isset($item['published_at']) && $item['published_at'] !== '') ? substr($item['published_at'], 0, 10) : date('Y-m-d');
        $urls[] = ['loc' => $base.'/berita/'.$item['slug'], 'lastmod' => $lastmod, 'freq' => 'monthly', 'priority' => '0.6'];
    }

    $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

    foreach ($urls as $url) {
        $xml .= "\t".'<url>'."\n";
        $xml .= "\t\t".'<loc>'.htmlspecialchars($url['loc'], ENT_XML1, 'UTF-8').'</loc>'."\n";

        if (! empty($url['lastmod'])) {
            $xml .= "\t\t".'<lastmod>'.$url['lastmod'].'</lastmod>'."\n";
        }

        if (! empty($url['freq'])) {
            $xml .= "\t\t".'<changefreq>'.$url['freq'].'</changefreq>'."\n";
        }

        $xml .= "\t\t".'<priority>'.$url['priority'].'</priority>'."\n";
        $xml .= "\t".'</url>'."\n";
    }

    $xml .= '</urlset>';

    return \System\Response::make($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
});
