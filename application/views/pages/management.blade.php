@layout('layouts.app')

@php
    $directors = public_management_by_group('Direksi');
    $commissioners = public_management_by_group('Komisaris');
@endphp

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-blue-950 via-blue-900 to-slate-950 py-20 text-white sm:py-24">
    <div class="absolute inset-0 bg-blue-900/20"></div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative grid gap-10 lg:grid-cols-2 lg:items-end">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-200">Pengurus</p>
            <h1 class="mt-5 max-w-4xl text-4xl font-bold tracking-tight sm:text-5xl">Direksi dan Komisaris PT BPR Karawang Jabar</h1>
            <p class="mt-6 max-w-3xl text-lg leading-8 text-slate-300">Informasi pengurus ditampilkan dari data admin untuk mendukung transparansi profil PT BPR Karawang Jabar (Perseroda).</p>
        </div>
        <div class="rounded-3xl border border-white/10 bg-white/10 p-6 backdrop-blur">
            <p class="text-sm font-semibold text-blue-100">Komposisi Pengurus</p>
            <div class="mt-5 grid grid-cols-2 gap-4">
                <div class="rounded-2xl bg-white/10 p-4"><p class="text-3xl font-bold">{{ count($directors) }}</p><p class="text-sm text-slate-300">Direksi</p></div>
                <div class="rounded-2xl bg-white/10 p-4"><p class="text-3xl font-bold">{{ count($commissioners) }}</p><p class="text-sm text-slate-300">Komisaris</p></div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Direksi</p>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl mt-3">Pengelola Operasional Perusahaan</h2>
            <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600 mx-auto">Informasi berikut disusun untuk memperjelas struktur pengurus perusahaan kepada pengunjung website.</p>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2">
            @foreach ($directors as $index => $person)
                <article class="rounded-3xl border border-slate-200 bg-white shadow-lg shadow-slate-900/10 overflow-hidden">
                    <div class="{{ $index % 2 === 0 ? 'bg-gradient-to-br from-blue-900 to-blue-700' : 'bg-gradient-to-br from-slate-900 to-blue-800' }} p-8 text-white">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-white text-2xl font-bold text-blue-800">{{ $person['initials'] }}</div>
                        <h3 class="mt-6 text-2xl font-bold">{{ $person['name'] }}</h3>
                        <p class="mt-2 text-blue-100">{{ $person['position'] }}</p>
                    </div>
                    <div class="p-8">
                        <p class="leading-7 text-slate-600">{{ $person['bio'] }}</p>
                        <div class="mt-6 rounded-2xl bg-slate-50 p-5">
                            <p class="text-sm font-semibold text-slate-500">Peran dalam Struktur</p>
                            <p class="mt-1 text-sm text-slate-600">Informasi jabatan ditampilkan sebagai bagian dari transparansi profil perusahaan.</p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-white py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Komisaris</p>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl mt-3">Fungsi Pengawasan Perusahaan</h2>
            <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600 mx-auto">Bagian komisaris disajikan untuk memperjelas struktur pengawasan dalam profil perusahaan.</p>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2">
            @foreach ($commissioners as $person)
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                    <div class="flex items-start gap-5">
                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-amber-100 text-xl font-bold text-amber-700">{{ $person['initials'] }}</div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-950">{{ $person['name'] }}</h3>
                            <p class="mt-1 text-sm font-semibold text-blue-700">{{ $person['position'] }}</p>
                            <p class="mt-4 leading-7 text-slate-600">{{ $person['bio'] }}</p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-8 lg:grid-cols-2 lg:items-center">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Akurasi Data</p>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl mt-3">Data pengurus perlu dijaga tetap akurat</h2>
            <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">Informasi nama, gelar, dan jabatan pengurus perlu dijaga akurat agar profil perusahaan tetap terpercaya.</p>
        </div>
        <div class="grid gap-5 sm:grid-cols-3">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10"><h3 class="font-bold text-slate-950">Nama & Gelar</h3><p class="mt-2 text-sm leading-6 text-slate-600">Pastikan penulisan sesuai dokumen resmi.</p></div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10"><h3 class="font-bold text-slate-950">Jabatan</h3><p class="mt-2 text-sm leading-6 text-slate-600">Perbarui jika ada perubahan struktur.</p></div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10"><h3 class="font-bold text-slate-950">Foto</h3><p class="mt-2 text-sm leading-6 text-slate-600">Gunakan foto resmi bila tersedia.</p></div>
        </div>
    </div>
</section>

<section class="bg-blue-900 py-16 text-white sm:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-200">Butuh Informasi Resmi?</p>
            <h2 class="mt-3 text-3xl font-bold tracking-tight">Hubungi PT BPR Karawang Jabar</h2>
            <p class="mt-3 max-w-2xl text-blue-100">Untuk konfirmasi struktur pengurus atau informasi perusahaan, gunakan kanal kontak resmi.</p>
        </div>
        <a href="{{ url('kontak') }}" class="inline-flex rounded-full bg-white px-6 py-3 text-sm font-semibold text-blue-900 hover:bg-blue-50">Ke Halaman Kontak</a>
    </div>
</section>
@endsection
