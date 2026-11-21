@layout('admin::layout')

@section('content')
<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#9a742b]">Modul Admin</p>
    <h2 class="mt-3 text-3xl font-semibold tracking-tight text-[#172b31]">{{ $heading }}</h2>
    <p class="mt-4 max-w-3xl leading-7 text-slate-600">{{ $description }}</p>
    <div class="mt-8 rounded-xl border border-amber-200 bg-amber-50 p-5 text-sm leading-6 text-amber-950">
        Modul ini sudah disiapkan sebagai struktur awal. Implementasi CRUD lengkap bisa dibuat setelah schema konten final diputuskan.
    </div>
</div>
@endsection
