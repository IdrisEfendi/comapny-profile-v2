@layout('admin::layout')

@section('content')
@php
    $p = $product ? $product : ['id' => null, 'slug' => '', 'name' => '', 'category' => '', 'subtitle' => '', 'summary' => '', 'target' => '', 'detail_label' => 'Hubungi BPR', 'is_featured' => false];
    $isEdit = ! empty($p['id']);
@endphp

@if (! empty($error))
    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">{{ $error }}</div>
@endif

<div class="mx-auto max-w-2xl">
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5 sm:p-8">
        <p class="text-sm font-bold uppercase tracking-widest text-blue-700">{{ $isEdit ? 'Edit Produk' : 'Tambah Produk' }}</p>
        <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">{{ $isEdit ? 'Perbarui data produk' : 'Produk baru' }}</h2>

        <form action="{{ url('admin/products') }}" method="post" class="mt-8 space-y-5">
            @php echo csrf_field(); @endphp

            @if ($isEdit)
                <input type="hidden" name="original_id" value="{{ $p['id'] }}">
            @endif

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Nama Produk</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="name" type="text" value="{{ $p['name'] }}" placeholder="Nama produk" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Slug</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="slug" type="text" value="{{ $p['slug'] }}" placeholder="nama-produk">
                    <p class="mt-2 text-xs text-slate-500">Kosongkan untuk dibuat otomatis dari nama.</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Kategori</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="category" type="text" value="{{ $p['category'] }}" placeholder="Tabungan / Kredit / Layanan">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Subjudul</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="subtitle" type="text" value="{{ $p['subtitle'] }}" placeholder="Deskripsi singkat">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Target</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="target" type="text" value="{{ $p['target'] }}" placeholder="Calon nasabah">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Label Detail</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="detail_label" type="text" value="{{ $p['detail_label'] }}" placeholder="Hubungi BPR">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700">Ringkasan</label>
                <textarea class="mt-2 min-h-28 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="summary" placeholder="Ringkasan produk">{{ $p['summary'] }}</textarea>
            </div>

            <label class="flex items-center gap-3 text-sm font-semibold text-slate-700">
                <input name="is_featured" type="checkbox" value="1" {{ ! empty($p['is_featured']) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-blue-800 focus:ring-blue-700">
                Jadikan produk utama
            </label>

            <div class="flex flex-col gap-3 sm:flex-row">
                <button class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950" type="submit">Simpan Produk</button>
                <a href="{{ url('admin/products') }}" class="inline-flex items-center justify-center rounded-full border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 hover:border-slate-400">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
