@layout('layouts.app')

@php
    $settings = public_settings();
    $initial = public_product_initial($product);
@endphp

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-amber-50 via-white to-blue-50 py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-10 lg:grid-cols-2 lg:items-center">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Detail Produk</p>
            <h1 class="mt-5 text-4xl font-bold tracking-tight text-slate-950 sm:text-5xl">{{ $product['name'] }} - {{ $product['subtitle'] }}</h1>
            <p class="mt-6 max-w-3xl text-lg leading-8 text-slate-600">{{ $product['summary'] }}</p>
            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                <a href="{{ url('kontak') }}" class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950">Tanya Produk</a>
                <a href="{{ url('produk-layanan') }}" class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-6 py-3 text-sm font-bold text-slate-700 hover:border-blue-700 hover:text-blue-800">Kembali ke Produk</a>
            </div>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-amber-500 text-2xl font-bold text-white">{{ $initial }}</div>
            <dl class="mt-8 space-y-5">
                <div><dt class="text-sm font-semibold text-slate-500">Nama Produk</dt><dd class="mt-1 text-lg font-bold text-slate-950">{{ $product['name'] }}</dd></div>
                <div><dt class="text-sm font-semibold text-slate-500">Kategori</dt><dd class="mt-1 text-lg font-bold text-slate-950">{{ $product['category'] }}</dd></div>
                <div><dt class="text-sm font-semibold text-slate-500">Target</dt><dd class="mt-1 text-lg font-bold text-slate-950">{{ $product['target'] }}</dd></div>
                <div><dt class="text-sm font-semibold text-slate-500">Informasi Detail</dt><dd class="mt-1 text-lg font-bold text-amber-700">{{ $product['detail_label'] }}</dd></div>
            </dl>
        </div>
    </div>
</section>

<section class="py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-8 lg:grid-cols-2">
        <div class="space-y-8">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Ringkasan</p>
                <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl mt-3">Tentang {{ $product['name'] }}</h2>
                <p class="mt-5 leading-7 text-slate-600">{{ $product['summary'] }}</p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Informasi Produk</p>
                <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl mt-3">Hal yang dapat ditanyakan</h2>
                <div class="mt-8 grid gap-5 sm:grid-cols-2">
                    <div class="rounded-2xl bg-slate-50 p-5"><h3 class="font-bold text-slate-950">Manfaat</h3><p class="mt-2 text-sm leading-6 text-slate-600">Keuntungan utama produk untuk nasabah.</p></div>
                    <div class="rounded-2xl bg-slate-50 p-5"><h3 class="font-bold text-slate-950">Syarat</h3><p class="mt-2 text-sm leading-6 text-slate-600">Dokumen dan ketentuan pembukaan/pengajuan produk.</p></div>
                    <div class="rounded-2xl bg-slate-50 p-5"><h3 class="font-bold text-slate-950">Biaya/Ketentuan</h3><p class="mt-2 text-sm leading-6 text-slate-600">Informasi biaya, setoran, bunga, atau ketentuan lain jika berlaku.</p></div>
                    <div class="rounded-2xl bg-slate-50 p-5"><h3 class="font-bold text-slate-950">Proses Layanan</h3><p class="mt-2 text-sm leading-6 text-slate-600">Mekanisme layanan dan langkah berikutnya dari pihak BPR.</p></div>
                </div>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="rounded-3xl border border-blue-100 bg-blue-50 p-6">
                <h3 class="text-xl font-bold text-slate-950">Ingin tahu detail {{ $product['name'] }}?</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600">Hubungi {{ $settings['company_name'] }} melalui kanal kontak resmi untuk mendapatkan informasi terbaru dan akurat.</p>
                <a href="{{ url('kontak') }}" class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950 mt-6 w-full">Hubungi Kami</a>
            </div>
            <div class="rounded-3xl border border-amber-200 bg-amber-50 p-6">
                <h3 class="font-bold text-amber-950">Informasi penting</h3>
                <p class="mt-3 text-sm leading-6 text-amber-900">Untuk informasi finansial seperti biaya, bunga, imbal hasil, jaminan, dan syarat produk, silakan konfirmasi langsung melalui kanal resmi BPR.</p>
            </div>
        </aside>
    </div>
</section>

<section class="bg-white py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Alur Calon Nasabah</p>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl mt-3">Langkah mendapatkan informasi produk</h2>
        </div>
        <div class="mt-12 grid gap-5 md:grid-cols-3">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10 text-center"><div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 font-bold text-blue-700">1</div><h3 class="mt-5 font-bold text-slate-950">Baca ringkasan</h3><p class="mt-2 text-sm leading-6 text-slate-600">Pahami gambaran umum produk.</p></div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10 text-center"><div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 font-bold text-blue-700">2</div><h3 class="mt-5 font-bold text-slate-950">Hubungi BPR</h3><p class="mt-2 text-sm leading-6 text-slate-600">Tanyakan detail resmi melalui telepon, pesan kontak, email, atau kantor.</p></div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10 text-center"><div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 font-bold text-blue-700">3</div><h3 class="mt-5 font-bold text-slate-950">Ikuti arahan</h3><p class="mt-2 text-sm leading-6 text-slate-600">Ikuti proses dan persyaratan resmi dari pihak BPR.</p></div>
        </div>
    </div>
</section>
@endsection
