@layout('admin::layout')

@section('content')
@if (! empty($success))
    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">{{ $success }}</div>
@endif

<div class="grid gap-8 xl:grid-cols-3">
    <section class="xl:col-span-2">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Daftar Produk</p>
                    <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">Kelola produk public website</h2>
                </div>
                <p class="text-sm text-slate-500">Tersimpan di tabel database <code>products</code></p>
            </div>

            <div class="mt-8 space-y-6">
                @foreach ($products as $product)
                    <article class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <form action="{{ url('admin/products') }}" method="post" class="grid gap-5 lg:grid-cols-2">
                            @php echo csrf_field(); @endphp
                            <input type="hidden" name="original_slug" value="{{ $product['slug'] }}">

                            <div>
                                <label class="block text-sm font-semibold text-slate-700">Nama Produk</label>
                                <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="name" type="text" value="{{ $product['name'] }}" required>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700">Slug</label>
                                <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="slug" type="text" value="{{ $product['slug'] }}" placeholder="tahara">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700">Kategori</label>
                                <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="category" type="text" value="{{ $product['category'] }}" placeholder="Tabungan">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700">Subjudul</label>
                                <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="subtitle" type="text" value="{{ $product['subtitle'] }}" placeholder="Tabungan Hari Raya">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700">Target</label>
                                <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="target" type="text" value="{{ $product['target'] }}" placeholder="Masyarakat umum">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700">Label Detail</label>
                                <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="detail_label" type="text" value="{{ $product['detail_label'] }}" placeholder="Hubungi BPR">
                            </div>

                            <div class="lg:col-span-2">
                                <label class="block text-sm font-semibold text-slate-700">Ringkasan</label>
                                <textarea class="mt-2 min-h-24 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="summary">{{ $product['summary'] }}</textarea>
                            </div>

                            <div class="flex items-center gap-3 lg:col-span-2">
                                <input id="featured-{{ $product['slug'] }}" name="is_featured" type="checkbox" value="1" {{ ! empty($product['is_featured']) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-blue-800 focus:ring-blue-700">
                                <label for="featured-{{ $product['slug'] }}" class="text-sm font-semibold text-slate-700">Jadikan produk utama</label>
                            </div>

                            <div class="flex flex-col gap-3 sm:flex-row lg:col-span-2">
                                <button class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950" type="submit">Simpan Produk</button>
                            </div>
                        </form>

                        <form action="{{ url('admin/products/delete') }}" method="post" class="mt-3">
                            @php echo csrf_field(); @endphp
                            <input type="hidden" name="slug" value="{{ $product['slug'] }}">
                            <button class="inline-flex items-center justify-center rounded-full border border-red-200 px-5 py-2 text-sm font-semibold text-red-700 hover:bg-red-50" type="submit">Hapus</button>
                        </form>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <aside>
        <form action="{{ url('admin/products') }}" method="post" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5">
            @php echo csrf_field(); @endphp
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Tambah Produk</p>
            <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">Produk baru</h2>

            <div class="mt-6 space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Nama Produk</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="name" type="text" placeholder="Nama produk" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Slug</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="slug" type="text" placeholder="nama-produk">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Kategori</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="category" type="text" placeholder="Tabungan / Kredit / Layanan">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Subjudul</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="subtitle" type="text" placeholder="Deskripsi singkat">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Target</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="target" type="text" placeholder="Calon nasabah">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Label Detail</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="detail_label" type="text" value="Hubungi BPR">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Ringkasan</label>
                    <textarea class="mt-2 min-h-28 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="summary" placeholder="Ringkasan produk"></textarea>
                </div>
                <label class="flex items-center gap-3 text-sm font-semibold text-slate-700">
                    <input name="is_featured" type="checkbox" value="1" class="h-4 w-4 rounded border-slate-300 text-blue-800 focus:ring-blue-700">
                    Jadikan produk utama
                </label>
            </div>

            <button class="mt-6 inline-flex w-full items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950" type="submit">Tambah Produk</button>
        </form>
    </aside>
</div>
@endsection
