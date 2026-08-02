@layout('admin::layout')

@section('content')
@if (! empty($success))
    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">{{ $success }}</div>
@endif
@if (! empty($error))
    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">{{ $error }}</div>
@endif

<div class="grid gap-8 xl:grid-cols-3">
    <section class="xl:col-span-2">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Daftar Berita</p>
                    <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">Kelola berita dan pengumuman</h2>
                </div>
                <p class="text-sm text-slate-500">Tersimpan di tabel database <code>news</code></p>
            </div>

            <div class="mt-8 space-y-6">
                @forelse ($news as $item)
                    <article class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <form action="{{ url('admin/news') }}" method="post" class="grid gap-5">
                            @php echo csrf_field(); @endphp
                            <input type="hidden" name="original_slug" value="{{ $item['slug'] }}">
                            <input type="hidden" name="page" value="{{ $filters['page'] }}">

                            <div class="grid gap-5 lg:grid-cols-2">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700">Judul Berita</label>
                                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="title" type="text" value="{{ $item['title'] }}" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700">Slug</label>
                                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="slug" type="text" value="{{ $item['slug'] }}" placeholder="judul-berita">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700">Kategori</label>
                                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="category" type="text" value="{{ $item['category'] }}" placeholder="Pengumuman / Informasi">
                                </div>

                                <div class="flex items-end">
                                    <label class="flex items-center gap-3 text-sm font-semibold text-slate-700">
                                        <input name="is_published" type="checkbox" value="1" {{ ! empty($item['is_published']) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-blue-800 focus:ring-blue-700">
                                        Tampilkan di website
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700">Ringkasan</label>
                                <textarea class="mt-2 min-h-24 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="summary">{{ $item['summary'] }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700">Isi Berita</label>
                                <textarea class="mt-2 min-h-48 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="content">{{ $item['content'] }}</textarea>
                            </div>

                            <div class="flex flex-col gap-3 sm:flex-row">
                                <button class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950" type="submit">Simpan Berita</button>
                            </div>
                        </form>

                        <form action="{{ url('admin/news/delete') }}" method="post" class="mt-3">
                            @php echo csrf_field(); @endphp
                            <input type="hidden" name="slug" value="{{ $item['slug'] }}">
                            <input type="hidden" name="page" value="{{ $filters['page'] }}">
                            <button class="inline-flex items-center justify-center rounded-full border border-red-200 px-5 py-2 text-sm font-semibold text-red-700 hover:bg-red-50" type="submit">Hapus</button>
                        </form>
                    </article>
                @empty
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-8 text-center">
                        <p class="font-semibold text-slate-950">Belum ada berita</p>
                        <p class="mt-2 text-sm leading-6 text-slate-600">Gunakan form "Berita baru" untuk menambahkan berita atau pengumuman pertama.</p>
                    </div>
                @endforelse

                @if ($totalPages > 1)
                    <div class="flex flex-col gap-4 rounded-3xl border border-slate-200 bg-white p-5 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm text-slate-500">Halaman {{ $filters['page'] }} dari {{ $totalPages }} ({{ $total }} berita)</p>
                        <div class="flex gap-3">
                            @if ($filters['page'] > 1)
                                <a class="inline-flex items-center justify-center rounded-full border border-slate-300 px-5 py-2 text-sm font-semibold text-slate-700 hover:border-blue-700 hover:text-blue-800" href="{{ url('admin/news?page='.($filters['page'] - 1)) }}">Sebelumnya</a>
                            @endif
                            @if ($filters['page'] < $totalPages)
                                <a class="inline-flex items-center justify-center rounded-full bg-blue-800 px-5 py-2 text-sm font-bold text-white shadow-lg hover:bg-blue-950" href="{{ url('admin/news?page='.($filters['page'] + 1)) }}">Berikutnya</a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <aside>
        <form action="{{ url('admin/news') }}" method="post" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5">
            @php echo csrf_field(); @endphp
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Tambah Berita</p>
            <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">Berita baru</h2>

            <div class="mt-6 space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Judul Berita</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="title" type="text" placeholder="Judul berita" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Slug</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="slug" type="text" placeholder="judul-berita">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Kategori</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="category" type="text" placeholder="Pengumuman / Informasi">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Ringkasan</label>
                    <textarea class="mt-2 min-h-28 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="summary" placeholder="Ringkasan berita"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Isi Berita</label>
                    <textarea class="mt-2 min-h-40 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="content" placeholder="Isi lengkap berita"></textarea>
                </div>
                <label class="flex items-center gap-3 text-sm font-semibold text-slate-700">
                    <input name="is_published" type="checkbox" value="1" checked class="h-4 w-4 rounded border-slate-300 text-blue-800 focus:ring-blue-700">
                    Langsung tampilkan di website
                </label>
            </div>

            <button class="mt-6 inline-flex w-full items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950" type="submit">Tambah Berita</button>
        </form>
    </aside>
</div>
@endsection
