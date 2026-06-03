@layout('layouts.app')

@php
    $settings = public_settings();
    $profile = public_company_profile();
@endphp

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-blue-950 via-blue-900 to-slate-950 py-20 text-white sm:py-24">
    <div class="absolute inset-0 bg-blue-900/20"></div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative">
        <p class="text-sm font-bold uppercase tracking-widest text-blue-200">Tentang Kami</p>
        <div class="mt-5 grid gap-8 lg:grid-cols-2 lg:items-end">
            <div>
                <h1 class="max-w-4xl text-4xl font-bold tracking-tight sm:text-5xl">{{ $settings['company_name'] }}</h1>
                <p class="mt-6 max-w-3xl text-lg leading-8 text-slate-300">{{ $profile['hero_intro'] }}</p>
            </div>
            <div class="rounded-3xl border border-white/10 bg-white/10 p-6 backdrop-blur">
                <p class="text-sm font-semibold text-blue-100">Profil Singkat</p>
                <p class="mt-2 leading-7 text-white">Halaman ini menyajikan ringkasan profil, nilai layanan, informasi kantor, dan arah komunikasi perusahaan secara ringkas.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-12 lg:grid-cols-2 lg:items-start">
        <div class="lg:sticky lg:top-32">
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Profil Perusahaan</p>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl mt-3">{{ $profile['profile_heading'] }}</h2>
            <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">Halaman ini dirancang untuk menjelaskan identitas, area layanan, nilai, dan informasi penting {{ $settings['company_name'] }} secara lebih terstruktur.</p>
        </div>

        <div class="space-y-6">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                <h3 class="text-xl font-bold text-slate-950">Ringkasan</h3>
                <p class="mt-4 leading-7 text-slate-600">{{ $profile['profile_summary'] }}</p>
            </div>
            <div class="grid gap-6 sm:grid-cols-2">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                    <h3 class="text-lg font-bold text-slate-950">Area Layanan</h3>
                    <p class="mt-3 leading-7 text-slate-600">{{ $profile['area_service'] }}</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                    <h3 class="text-lg font-bold text-slate-950">Fokus Informasi</h3>
                    <p class="mt-3 leading-7 text-slate-600">{{ $profile['information_focus'] }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Nilai Utama</p>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl mt-3">Fondasi komunikasi website</h2>
            <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600 mx-auto">Nilai berikut menjadi dasar penyajian informasi agar website tetap profesional, jelas, dan mudah dipahami pengunjung.</p>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">01</div>
                <h3 class="mt-5 font-bold text-slate-950">Profesional</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600">Tampilan dan informasi disusun rapi agar mudah dipahami oleh masyarakat dan stakeholder.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">02</div>
                <h3 class="mt-5 font-bold text-slate-950">Terbuka</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600">Informasi kontak, pengurus, dan jam layanan ditampilkan jelas untuk memudahkan akses.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-700">03</div>
                <h3 class="mt-5 font-bold text-slate-950">Lokal</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600">Komunikasi website menonjolkan kedekatan dengan masyarakat Karawang.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-700">04</div>
                <h3 class="mt-5 font-bold text-slate-950">Hati-hati</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600">Informasi layanan ditampilkan secara hati-hati agar tetap jelas, akurat, dan tidak menimbulkan salah pemahaman.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-8 lg:grid-cols-2">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Visi</p>
            <h2 class="mt-3 text-2xl font-bold text-slate-950">Arah Visi</h2>
            <p class="mt-4 leading-7 text-slate-600">{{ $profile['vision'] }}</p>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Misi</p>
            <h2 class="mt-3 text-2xl font-bold text-slate-950">Arah Misi</h2>
            <p class="mt-4 leading-7 text-slate-600">{{ $profile['mission'] }}</p>
        </div>
    </div>
</section>

<section class="bg-slate-950 py-16 text-white sm:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-10 lg:grid-cols-2 lg:items-center">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-200">Informasi Kantor</p>
            <h2 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">Kunjungi atau hubungi kantor BPR</h2>
            <p class="mt-4 max-w-2xl leading-7 text-slate-300">Informasi kantor berikut menjadi kanal utama bagi pengunjung yang ingin menghubungi atau mengunjungi BPR.</p>
        </div>
        <div class="rounded-3xl bg-white p-6 text-slate-800 shadow-lg shadow-slate-900/10">
            <div class="space-y-4">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Alamat</p>
                    <p class="mt-1 font-semibold leading-6 text-slate-950">{{ $settings['address'] }}</p>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl bg-slate-50 p-4"><p class="text-sm font-semibold text-slate-500">Telepon</p><p class="mt-1 font-bold text-slate-950">{{ $settings['phone'] }}</p></div>
                    <div class="rounded-2xl bg-slate-50 p-4"><p class="text-sm font-semibold text-slate-500">Jam Buka</p><p class="mt-1 font-bold text-slate-950">{{ $settings['office_hours'] }}</p></div>
                </div>
                <a href="{{ url('kontak') }}" class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950 w-full">Lihat Kontak Lengkap</a>
            </div>
        </div>
    </div>
</section>
@endsection
