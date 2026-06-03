@layout('admin::layout')

@section('content')
<div class="grid gap-6 lg:grid-cols-3">
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5 lg:col-span-2">
        <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Ringkasan</p>
        <h2 class="mt-3 text-2xl font-bold text-slate-950">Admin panel sudah aktif</h2>
        <p class="mt-4 leading-7 text-slate-600">Gunakan halaman pengaturan untuk mengelola informasi dasar website seperti nama perusahaan, tagline, telepon, email, alamat, jam layanan, WhatsApp, dan Google Maps.</p>
    </div>
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5">
        <p class="text-sm font-semibold text-slate-500">Nama Website</p>
        <p class="mt-2 text-xl font-bold text-slate-950">{{ $settings['company_name'] }}</p>
        <a href="{{ url('admin/settings') }}" class="mt-6 inline-flex rounded-full bg-blue-800 px-5 py-3 text-sm font-bold text-white hover:bg-blue-950">Kelola Setting</a>
    </div>
</div>

<div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
    <a href="{{ url('admin/company-profile') }}" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5 hover:border-blue-300"><h3 class="font-bold text-slate-950">Profil</h3><p class="mt-2 text-sm text-slate-600">Kelola profil perusahaan.</p></a>
    <a href="{{ url('admin/products') }}" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5 hover:border-blue-300"><h3 class="font-bold text-slate-950">Produk</h3><p class="mt-2 text-sm text-slate-600">Kelola TAHARA dan produk lain.</p></a>
    <a href="{{ url('admin/management') }}" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5 hover:border-blue-300"><h3 class="font-bold text-slate-950">Pengurus</h3><p class="mt-2 text-sm text-slate-600">Kelola direksi dan komisaris.</p></a>
    <a href="{{ url('admin/settings') }}" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5 hover:border-blue-300"><h3 class="font-bold text-slate-950">Setting</h3><p class="mt-2 text-sm text-slate-600">Kelola data kontak dan brand.</p></a>
</div>
@endsection
