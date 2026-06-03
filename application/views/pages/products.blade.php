@layout('layouts.app')

@php
    $products = public_products();
    $featuredProduct = public_featured_product();
@endphp

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-blue-950 via-blue-900 to-slate-950 py-20 text-white sm:py-24">
    <div class="absolute inset-0 bg-blue-900/20"></div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative grid gap-10 lg:grid-cols-2 lg:items-end">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-200">Produk & Layanan</p>
            <h1 class="mt-5 max-w-4xl text-4xl font-bold tracking-tight sm:text-5xl">Informasi produk BPR yang mudah dipahami</h1>
            <p class="mt-6 max-w-3xl text-lg leading-8 text-slate-300">Halaman ini menampilkan produk dan layanan PT BPR Karawang Jabar (Perseroda) dari data admin secara rapi, jelas, dan aman dari klaim yang belum terverifikasi.</p>
        </div>
        @if ($featuredProduct)
            <div class="rounded-3xl border border-white/10 bg-white/10 p-6 backdrop-blur">
                <p class="text-sm font-semibold text-blue-100">Produk Utama</p>
                <p class="mt-2 text-3xl font-bold text-white">{{ $featuredProduct['name'] }}</p>
                <p class="mt-2 leading-7 text-slate-300">{{ $featuredProduct['subtitle'] }}</p>
            </div>
        @endif
    </div>
</section>

<section class="py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Produk Utama</p>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl mt-3">Produk yang tersedia</h2>
            <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">Data produk pada halaman ini dapat dikelola dari admin panel.</p>
        </div>

        <div class="mt-10 grid gap-8 lg:grid-cols-2">
            @foreach ($products as $product)
                @php
                    $detailUrl = url('produk/'.$product['slug']);
                    $initial = public_product_initial($product);
                @endphp
                <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-lg shadow-slate-900/10">
                    <div class="bg-gradient-to-br from-blue-900 to-blue-700 p-8 text-white">
                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-2xl font-bold text-blue-800">{{ $initial }}</div>
                        <p class="mt-8 text-sm font-semibold text-blue-100">{{ $product['subtitle'] }}</p>
                        <h3 class="mt-2 text-3xl font-bold">{{ $product['name'] }}</h3>
                        <p class="mt-4 max-w-2xl leading-7 text-blue-50">{{ $product['summary'] }}</p>
                    </div>
                    <div class="grid gap-5 p-8 md:grid-cols-3">
                        <div class="rounded-2xl bg-slate-50 p-5">
                            <p class="font-bold text-slate-950">Kategori</p>
                            <p class="mt-2 text-sm leading-6 text-slate-600">{{ $product['category'] }}</p>
                        </div>
                        <div class="rounded-2xl bg-slate-50 p-5">
                            <p class="font-bold text-slate-950">Target</p>
                            <p class="mt-2 text-sm leading-6 text-slate-600">{{ $product['target'] }}</p>
                        </div>
                        <div class="rounded-2xl bg-slate-50 p-5">
                            <p class="font-bold text-slate-950">Informasi Detail</p>
                            <p class="mt-2 text-sm leading-6 text-slate-600">{{ $product['detail_label'] }}</p>
                        </div>
                    </div>
                    <div class="border-t border-slate-200 px-8 py-6">
                        <a href="{{ $detailUrl }}" class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950">Lihat Detail {{ $product['name'] }}</a>
                    </div>
                </article>
            @endforeach

            <aside class="space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                    <h3 class="text-xl font-bold text-slate-950">Prinsip penulisan produk</h3>
                    <p class="mt-4 leading-7 text-slate-600">Informasi produk keuangan disusun secara ringkas dan hati-hati. Untuk detail manfaat, biaya, jaminan, dan syarat, pengunjung diarahkan ke kanal kontak resmi BPR.</p>
                </div>
                <div class="rounded-3xl border border-amber-200 bg-amber-50 p-6">
                    <h3 class="text-xl font-bold text-amber-950">Informasi yang biasa ditanyakan</h3>
                    <ul class="mt-4 space-y-3 text-sm leading-6 text-amber-900">
                        <li>• Manfaat produk</li>
                        <li>• Syarat pembukaan rekening</li>
                        <li>• Minimal setoran</li>
                        <li>• Mekanisme penarikan</li>
                        <li>• Kanal kontak resmi</li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

<section class="bg-white py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-12 lg:grid-cols-2 lg:items-center">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Alur Informasi</p>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl mt-3">Cara pengunjung memahami produk</h2>
            <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">Halaman produk disusun supaya calon nasabah bisa memahami produk secara bertahap sebelum menghubungi BPR.</p>
        </div>
        <div class="grid gap-5 sm:grid-cols-2">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10"><span class="text-sm font-bold text-blue-700">01</span><h3 class="mt-3 font-bold text-slate-950">Baca ringkasan</h3><p class="mt-2 text-sm leading-6 text-slate-600">Pengunjung melihat nama, kategori, dan tujuan umum produk.</p></div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10"><span class="text-sm font-bold text-blue-700">02</span><h3 class="mt-3 font-bold text-slate-950">Lihat detail</h3><p class="mt-2 text-sm leading-6 text-slate-600">Pengunjung membuka halaman detail atau kontak untuk memahami informasi lebih lengkap.</p></div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10"><span class="text-sm font-bold text-blue-700">03</span><h3 class="mt-3 font-bold text-slate-950">Cek syarat</h3><p class="mt-2 text-sm leading-6 text-slate-600">Pengunjung dapat menanyakan syarat dan ketentuan melalui kanal kontak resmi BPR.</p></div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10"><span class="text-sm font-bold text-blue-700">04</span><h3 class="mt-3 font-bold text-slate-950">Hubungi BPR</h3><p class="mt-2 text-sm leading-6 text-slate-600">Pengunjung diarahkan ke halaman kontak untuk bertanya lebih lanjut.</p></div>
        </div>
    </div>
</section>

<section class="bg-blue-900 py-16 text-white sm:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-200">Butuh Informasi Produk?</p>
            <h2 class="mt-3 text-3xl font-bold tracking-tight">Hubungi kantor BPR pada jam layanan</h2>
            <p class="mt-3 max-w-2xl text-blue-100">Tim BPR dapat memberikan informasi resmi terkait produk, syarat, dan proses layanan.</p>
        </div>
        <a href="{{ url('kontak') }}" class="inline-flex rounded-full bg-white px-6 py-3 text-sm font-semibold text-blue-900 hover:bg-blue-50">Hubungi Kami</a>
    </div>
</section>
@endsection
