@layout('admin::layout')

@section('content')
@php
    $p = $product ? $product : ['id' => null, 'slug' => '', 'name' => '', 'category' => '', 'subtitle' => '', 'summary' => '', 'target' => '', 'detail_label' => 'Hubungi BPR', 'is_featured' => false];
    $isEdit = ! empty($p['id']);
@endphp

@if (! empty($error))
    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-800" role="alert">{{ $error }}</div>
@endif

<div class="mx-auto max-w-2xl">
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#9a742b]">{{ $isEdit ? 'Edit Produk' : 'Tambah Produk' }}</p>
        <h2 class="mt-2 text-2xl font-semibold tracking-tight text-[#172b31]">{{ $isEdit ? 'Perbarui data produk' : 'Produk baru' }}</h2>

        <form action="{{ url('admin/products') }}" method="post" class="mt-8 space-y-5">
            @php echo csrf_field(); @endphp

            @if ($isEdit)
                <input type="hidden" name="original_id" value="{{ $p['id'] }}">
            @endif

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Nama Produk</label>
                    <input class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" name="name" type="text" value="{{ $p['name'] }}" placeholder="Nama produk" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Slug</label>
                    <input class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" name="slug" type="text" value="{{ $p['slug'] }}" placeholder="nama-produk">
                    <p class="mt-2 text-xs text-slate-500">Kosongkan untuk dibuat otomatis dari nama.</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Kategori</label>
                    <input class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" name="category" type="text" value="{{ $p['category'] }}" placeholder="Tabungan / Kredit / Layanan">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Subjudul</label>
                    <input class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" name="subtitle" type="text" value="{{ $p['subtitle'] }}" placeholder="Deskripsi singkat">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Target</label>
                    <input class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" name="target" type="text" value="{{ $p['target'] }}" placeholder="Calon nasabah">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Label Detail</label>
                    <input class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" name="detail_label" type="text" value="{{ $p['detail_label'] }}" placeholder="Hubungi BPR">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700">Ringkasan</label>
                <textarea class="mt-2 min-h-28 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" name="summary" placeholder="Ringkasan produk">{{ $p['summary'] }}</textarea>
            </div>

            <label class="flex items-center gap-3 text-sm font-semibold text-slate-700">
                <input name="is_featured" type="checkbox" value="1" {{ ! empty($p['is_featured']) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-[#173f46] focus:ring-[#173f46]">
                Jadikan produk utama
            </label>

            <div class="flex flex-col gap-3 sm:flex-row">
                <button class="inline-flex min-h-11 items-center justify-center rounded-xl bg-[#173f46] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#102b35] focus:outline-none focus-visible:ring-4 focus-visible:ring-[#173f46]/20" type="submit">Simpan Produk</button>
                <a href="{{ url('admin/products') }}" class="inline-flex min-h-11 items-center justify-center rounded-xl border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-[#28544c] hover:text-[#28544c]">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
