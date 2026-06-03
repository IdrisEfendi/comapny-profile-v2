@layout('layouts.app')

@section('content')
<section class="bg-gradient-to-br from-blue-50 via-white to-white py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <p class="text-sm font-semibold text-blue-700">PT BPR Karawang Jabar (Perseroda)</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight text-slate-950">{{ $heading }}</h1>
        <p class="mt-4 max-w-3xl text-lg leading-8 text-slate-600">{{ $description }}</p>
    </div>
</section>

<section class="py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
            @if (isset($type) && $type === 'about')
                <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">Profil Singkat</h2>
                <p class="mt-4 leading-7 text-slate-600">PT BPR Karawang Jabar (Perseroda) merupakan BPR yang berfokus melayani kebutuhan keuangan masyarakat Karawang. Informasi profil disajikan ringkas dan dapat diperbarui mengikuti kebutuhan perusahaan.</p>
            @elseif (isset($type) && $type === 'products')
                <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">TAHARA - Tabungan Hari Raya</h2>
                <p class="mt-4 leading-7 text-slate-600">Produk tabungan yang membantu perencanaan kebutuhan hari raya. Untuk manfaat, syarat, dan mekanisme produk, pengunjung dapat menghubungi BPR melalui kanal kontak resmi.</p>
                <a href="{{ url('produk/tahara') }}" class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950 mt-6">Lihat Detail TAHARA</a>
            @elseif (isset($type) && $type === 'management')
                <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">Direksi & Komisaris</h2>
                <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-2xl bg-slate-50 p-5"><p class="font-bold">Heri Heryanto SH, MM</p><p class="text-sm text-slate-500">Direktur Utama</p></div>
                    <div class="rounded-2xl bg-slate-50 p-5"><p class="font-bold">Atjeng Hadis Susanto SE</p><p class="text-sm text-slate-500">Direktur</p></div>
                    <div class="rounded-2xl bg-slate-50 p-5"><p class="font-bold">Jaja Sumarna SE</p><p class="text-sm text-slate-500">Komisaris Utama</p></div>
                    <div class="rounded-2xl bg-slate-50 p-5"><p class="font-bold">Dikdik Kustiadi</p><p class="text-sm text-slate-500">Komisaris</p></div>
                </div>
            @elseif (isset($type) && $type === 'contact')
                <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">Informasi Kontak</h2>
                <div class="mt-8 grid gap-5 md:grid-cols-2">
                    <div class="rounded-2xl bg-slate-50 p-5"><p class="font-bold">Alamat</p><p class="mt-2 text-slate-600">Jln Raya Cilamaya Komplek Kantor Kecamatan Cilamaya Wetan</p></div>
                    <div class="rounded-2xl bg-slate-50 p-5"><p class="font-bold">Telepon</p><p class="mt-2 text-slate-600">(0264) 8380203</p></div>
                    <div class="rounded-2xl bg-slate-50 p-5"><p class="font-bold">Email</p><p class="mt-2 text-slate-600">ptbptkarawang@gmail.com</p></div>
                    <div class="rounded-2xl bg-slate-50 p-5"><p class="font-bold">Jam Buka</p><p class="mt-2 text-slate-600">Senin - Jumat, 08:00 - 14:00</p></div>
                </div>
            @else
                <p class="leading-7 text-slate-600">Konten halaman sedang disiapkan.</p>
            @endif
        </div>
    </div>
</section>
@endsection
