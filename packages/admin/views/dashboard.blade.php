@layout('admin::layout')

@section('content')
<div class="mx-auto max-w-7xl">
    <section class="relative isolate overflow-hidden rounded-3xl bg-[#173f46] px-6 py-8 text-white shadow-xl shadow-slate-900/10 sm:px-9 sm:py-10">
        <div aria-hidden="true" class="absolute -right-16 -top-28 -z-10 h-80 w-80 rounded-full border border-white/10"></div>
        <div aria-hidden="true" class="absolute -right-6 -top-16 -z-10 h-60 w-60 rounded-full border border-white/10"></div>
        <div class="max-w-2xl">
            <p class="flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.2em] text-[#f0c66f]"><span class="h-2 w-2 rounded-full bg-[#f0c66f]"></span>Ruang kerja administrator</p>
            <h2 class="mt-4 text-3xl font-semibold tracking-tight sm:text-4xl">Selamat datang kembali.</h2>
            <p class="mt-4 max-w-xl text-sm leading-7 text-white/70 sm:text-base">Kelola informasi dan konten website BPR Karawang Jabar dari satu tempat.</p>
        </div>
        <a href="{{ url('admin/settings') }}" class="mt-7 inline-flex min-h-11 items-center justify-center gap-2 rounded-xl bg-[#f0c66f] px-5 py-3 text-sm font-semibold text-[#102b35] transition hover:bg-amber-200 focus:outline-none focus-visible:ring-4 focus-visible:ring-white/30 sm:mt-8">
            Pengaturan website
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.69L10.22 5.03a.75.75 0 1 1 1.06-1.06l5.5 5.5a.75.75 0 0 1 0 1.06l-5.5 5.5a.75.75 0 0 1-1.06-1.06l4.22-4.22H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd"/></svg>
        </a>
    </section>

    <section class="mt-8" aria-labelledby="quick-access-heading">
        <div class="mb-4 flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#9a742b]">Kelola konten</p>
                <h2 id="quick-access-heading" class="mt-1 text-xl font-semibold tracking-tight text-[#172b31]">Akses cepat</h2>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <a href="{{ url('admin/company-profile') }}" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-[#b9d0c8] hover:shadow-md focus:outline-none focus-visible:ring-4 focus-visible:ring-[#173f46]/15">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-800">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M3 4.75A1.75 1.75 0 0 1 4.75 3h10.5A1.75 1.75 0 0 1 17 4.75v10.5A1.75 1.75 0 0 1 15.25 17H4.75A1.75 1.75 0 0 1 3 15.25V4.75ZM6 6.5A.75.75 0 0 0 6 8h8a.75.75 0 0 0 0-1.5H6Zm0 3.5a.75.75 0 0 0 0 1.5h8a.75.75 0 0 0 0-1.5H6Zm0 3.5a.75.75 0 0 0 0 1.5h5a.75.75 0 0 0 0-1.5H6Z"/></svg>
                </span>
                <h3 class="mt-4 font-semibold text-[#172b31]">Profil perusahaan</h3>
                <p class="mt-1 text-sm leading-6 text-slate-500">Kelola cerita dan informasi perusahaan.</p>
                <span class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-[#34665d]">Buka profil <span aria-hidden="true" class="transition-transform group-hover:translate-x-1">&rarr;</span></span>
            </a>

            <a href="{{ url('admin/products') }}" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-[#b9d0c8] hover:shadow-md focus:outline-none focus-visible:ring-4 focus-visible:ring-[#173f46]/15">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-800">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 2.5a.75.75 0 0 1 .75.75v5.5h5.5a.75.75 0 0 1 0 1.5h-5.5v5.5a.75.75 0 0 1-1.5 0v-5.5h-5.5a.75.75 0 0 1 0-1.5h5.5v-5.5A.75.75 0 0 1 10 2.5Z" clip-rule="evenodd"/></svg>
                </span>
                <h3 class="mt-4 font-semibold text-[#172b31]">Produk</h3>
                <p class="mt-1 text-sm leading-6 text-slate-500">Atur TAHARA dan produk lainnya.</p>
                <span class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-[#34665d]">Buka produk <span aria-hidden="true" class="transition-transform group-hover:translate-x-1">&rarr;</span></span>
            </a>

            <a href="{{ url('admin/management') }}" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-[#b9d0c8] hover:shadow-md focus:outline-none focus-visible:ring-4 focus-visible:ring-[#173f46]/15">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-sky-50 text-sky-800">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.5 8a5.5 5.5 0 1 1 11 0v.25a.75.75 0 0 1-.75.75h-9.5a.75.75 0 0 1-.75-.75V17Z"/><path d="M15.5 6a2.5 2.5 0 0 1 1.75 4.285A4.99 4.99 0 0 1 19 14.25v.5a.75.75 0 0 1-.75.75h-1.02a7 7 0 0 0-2.11-5.39A4.46 4.46 0 0 0 15.5 6Z"/></svg>
                </span>
                <h3 class="mt-4 font-semibold text-[#172b31]">Pengurus</h3>
                <p class="mt-1 text-sm leading-6 text-slate-500">Perbarui informasi direksi dan komisaris.</p>
                <span class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-[#34665d]">Buka pengurus <span aria-hidden="true" class="transition-transform group-hover:translate-x-1">&rarr;</span></span>
            </a>

            <a href="{{ url('admin/settings') }}" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-[#b9d0c8] hover:shadow-md focus:outline-none focus-visible:ring-4 focus-visible:ring-[#173f46]/15">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-violet-800">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.84 2.45a2.25 2.25 0 0 1 4.32 0l.18.55a2.25 2.25 0 0 0 3.25 1.3l.51-.29a2.25 2.25 0 0 1 3.06 3.06l-.29.51a2.25 2.25 0 0 0 1.3 3.25l.55.18a2.25 2.25 0 0 1 0 4.32l-.55.18a2.25 2.25 0 0 0-1.3 3.25l.29.51a2.25 2.25 0 0 1-3.06 3.06l-.51-.29a2.25 2.25 0 0 0-3.25 1.3l-.18.55a2.25 2.25 0 0 1-4.32 0l-.18-.55a2.25 2.25 0 0 0-3.25-1.3l-.51.29a2.25 2.25 0 0 1-3.06-3.06l.29-.51a2.25 2.25 0 0 0-1.3-3.25l-.55-.18a2.25 2.25 0 0 1 0-4.32l.55-.18a2.25 2.25 0 0 0 1.3-3.25l-.29-.51a2.25 2.25 0 0 1 3.06-3.06l.51.29a2.25 2.25 0 0 0 3.25-1.3l.18-.55ZM10 13.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Z" clip-rule="evenodd"/></svg>
                </span>
                <h3 class="mt-4 font-semibold text-[#172b31]">Pengaturan</h3>
                <p class="mt-1 text-sm leading-6 text-slate-500">Nama, kontak, alamat, dan identitas brand.</p>
                <span class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-[#34665d]">Buka pengaturan <span aria-hidden="true" class="transition-transform group-hover:translate-x-1">&rarr;</span></span>
            </a>
        </div>
    </section>

    <section class="mt-8 grid gap-4 lg:grid-cols-[1fr_auto]">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 sm:p-6">
            <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-500">Website aktif</p>
            <p class="mt-2 text-lg font-semibold text-[#172b31]">{{ $settings['company_name'] }}</p>
            <p class="mt-1 text-sm text-slate-500">Nama perusahaan yang digunakan pada profil website.</p>
        </div>
        <a href="{{ url('admin/settings') }}" class="inline-flex min-h-12 items-center justify-center rounded-xl border border-[#cbd8d1] bg-white px-5 py-3 text-sm font-semibold text-[#28544c] transition hover:border-[#28544c] hover:bg-emerald-50 focus:outline-none focus-visible:ring-4 focus-visible:ring-[#173f46]/15">Kelola identitas website</a>
    </section>
</div>
@endsection
