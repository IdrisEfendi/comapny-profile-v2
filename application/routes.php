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
    return view('pages.contact', ['title' => 'Kontak', 'active' => 'contact']);
});
