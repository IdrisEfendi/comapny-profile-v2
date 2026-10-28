@layout('admin::layout')

@section('content')
<div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-lg shadow-slate-900/5">
    <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Modul Admin</p>
    <h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-950">{{ $heading }}</h2>
    <p class="mt-4 max-w-3xl leading-7 text-slate-600">{{ $description }}</p>
    <div class="mt-8 rounded-2xl border border-amber-200 bg-amber-50 p-5 text-sm leading-6 text-amber-900">
        Modul ini sudah disiapkan sebagai struktur awal. Implementasi CRUD lengkap bisa dibuat setelah schema konten final diputuskan.
    </div>
</div>
@endsection
