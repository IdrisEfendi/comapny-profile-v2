@layout('admin::layout')

@section('content')
@php
    $p = $person ? $person : ['id' => null, 'name' => '', 'position' => '', 'group' => 'Direksi', 'initials' => '', 'bio' => '', 'photo_path' => ''];
    $isEdit = ! empty($p['id']);
@endphp

@if (! empty($error))
    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-800" role="alert">{{ $error }}</div>
@endif

<div class="mx-auto max-w-2xl">
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#9a742b]">{{ $isEdit ? 'Edit Pengurus' : 'Tambah Pengurus' }}</p>
        <h2 class="mt-2 text-2xl font-semibold tracking-tight text-[#172b31]">{{ $isEdit ? 'Perbarui data pengurus' : 'Data pengurus baru' }}</h2>

        <form action="{{ url('admin/management') }}" method="post" enctype="multipart/form-data" class="mt-8 space-y-5">
            @php echo csrf_field(); @endphp

            @if ($isEdit)
                <input type="hidden" name="original_id" value="{{ $p['id'] }}">
            @endif

            <div>
                <label class="block text-sm font-semibold text-slate-700">Nama</label>
                <input class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" name="name" type="text" value="{{ $p['name'] }}" placeholder="Nama lengkap" required>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Jabatan</label>
                    <input class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" name="position" type="text" value="{{ $p['position'] }}" placeholder="Direktur / Komisaris" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Kelompok</label>
                    <select class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" name="group">
                        <option value="Direksi" {{ $p['group'] === 'Direksi' ? 'selected' : '' }}>Direksi</option>
                        <option value="Komisaris" {{ $p['group'] === 'Komisaris' ? 'selected' : '' }}>Komisaris</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700">Inisial</label>
                <input class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" name="initials" type="text" value="{{ $p['initials'] }}" placeholder="AB" maxlength="4">
                <p class="mt-2 text-xs text-slate-500">Kosongkan untuk mengisi otomatis dari nama.</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700">Bio / Keterangan</label>
                <textarea class="mt-2 min-h-28 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" name="bio" placeholder="Keterangan singkat">{{ $p['bio'] }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700">Foto Pengurus</label>
                <div class="mt-2 flex flex-col gap-4 rounded-xl border border-slate-200 bg-[#f8f8f4] p-4 sm:flex-row sm:items-center">
                    @if (! empty($p['photo_path']))
                        <img src="{{ asset($p['photo_path']) }}" alt="Foto {{ $p['name'] }}" class="h-24 w-24 rounded-2xl object-cover">
                        <label class="flex items-center gap-2 text-sm font-semibold text-red-700">
                            <input type="checkbox" name="remove_photo" value="1" class="h-4 w-4 rounded border-slate-300 text-red-600">
                            Hapus foto saat simpan
                        </label>
                    @else
                        <div class="flex h-24 w-24 items-center justify-center rounded-2xl bg-[#edf3ef] text-2xl font-bold text-[#28544c]">{{ $p['initials'] !== '' ? $p['initials'] : '?' }}</div>
                    @endif
                    <div class="flex-1">
                        <input id="management-photo" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-[#edf3ef] file:px-3 file:py-2 file:text-sm file:font-semibold file:text-[#28544c]" name="photo" type="file" accept="image/jpeg,image/png,image/webp" aria-describedby="management-photo-help">
                        <p id="management-photo-help" class="mt-2 text-xs text-slate-500">Format JPG, PNG, atau WEBP. Maksimal 2MB.</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">
                <button class="inline-flex min-h-11 items-center justify-center rounded-xl bg-[#173f46] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#102b35] focus:outline-none focus-visible:ring-4 focus-visible:ring-[#173f46]/20" type="submit">Simpan Pengurus</button>
                <a href="{{ url('admin/management') }}" class="inline-flex min-h-11 items-center justify-center rounded-xl border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-[#28544c] hover:text-[#28544c]">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
