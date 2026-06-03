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
                    <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Daftar Pengurus</p>
                    <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">Kelola direksi dan komisaris</h2>
                </div>
                <p class="text-sm text-slate-500">Tersimpan di tabel database <code>management</code></p>
            </div>

            <div class="mt-8 space-y-6">
                @foreach ($management as $index => $person)
                    <article class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <form action="{{ url('admin/management') }}" method="post" enctype="multipart/form-data" class="grid gap-5 lg:grid-cols-2">
                            @php echo csrf_field(); @endphp
                            <input type="hidden" name="original_id" value="{{ $person['id'] }}">

                            <div>
                                <label class="block text-sm font-semibold text-slate-700">Nama</label>
                                <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="name" type="text" value="{{ $person['name'] }}" required>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700">Jabatan</label>
                                <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="position" type="text" value="{{ $person['position'] }}" required>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700">Kelompok</label>
                                <select class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="group">
                                    <option value="Direksi" {{ $person['group'] === 'Direksi' ? 'selected' : '' }}>Direksi</option>
                                    <option value="Komisaris" {{ $person['group'] === 'Komisaris' ? 'selected' : '' }}>Komisaris</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700">Inisial</label>
                                <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="initials" type="text" value="{{ $person['initials'] }}" maxlength="4">
                            </div>

                            <div class="lg:col-span-2">
                                <label class="block text-sm font-semibold text-slate-700">Bio / Keterangan</label>
                                <textarea class="mt-2 min-h-24 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="bio">{{ $person['bio'] }}</textarea>
                            </div>

                            <div class="lg:col-span-2">
                                <label class="block text-sm font-semibold text-slate-700">Foto Pengurus</label>
                                <div class="mt-2 flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-4 sm:flex-row sm:items-center">
                                    @if (! empty($person['photo_path']))
                                        <img src="{{ asset($person['photo_path']) }}" alt="Foto {{ $person['name'] }}" class="h-24 w-24 rounded-2xl object-cover">
                                        <label class="flex items-center gap-2 text-sm font-semibold text-red-700">
                                            <input type="checkbox" name="remove_photo" value="1" class="h-4 w-4 rounded border-slate-300 text-red-600">
                                            Hapus foto saat simpan
                                        </label>
                                    @else
                                        <div class="flex h-24 w-24 items-center justify-center rounded-2xl bg-blue-100 text-2xl font-bold text-blue-700">{{ $person['initials'] }}</div>
                                    @endif
                                    <div class="flex-1">
                                        <input class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="photo" type="file" accept="image/jpeg,image/png,image/webp">
                                        <p class="mt-2 text-xs text-slate-500">Format JPG, PNG, atau WEBP. Maksimal 2MB.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="lg:col-span-2">
                                <button class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950" type="submit">Simpan Pengurus</button>
                            </div>
                        </form>

                        <form action="{{ url('admin/management/delete') }}" method="post" class="mt-3">
                            @php echo csrf_field(); @endphp
                            <input type="hidden" name="id" value="{{ $person['id'] }}">
                            <button class="inline-flex items-center justify-center rounded-full border border-red-200 px-5 py-2 text-sm font-semibold text-red-700 hover:bg-red-50" type="submit">Hapus</button>
                        </form>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <aside>
        <form action="{{ url('admin/management') }}" method="post" enctype="multipart/form-data" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5">
            @php echo csrf_field(); @endphp
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Tambah Pengurus</p>
            <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">Data baru</h2>

            <div class="mt-6 space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Nama</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="name" type="text" placeholder="Nama lengkap" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Jabatan</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="position" type="text" placeholder="Direktur / Komisaris" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Kelompok</label>
                    <select class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="group">
                        <option value="Direksi">Direksi</option>
                        <option value="Komisaris">Komisaris</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Inisial</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="initials" type="text" placeholder="AB" maxlength="4">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Bio / Keterangan</label>
                    <textarea class="mt-2 min-h-28 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="bio" placeholder="Keterangan singkat"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Foto Pengurus</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="photo" type="file" accept="image/jpeg,image/png,image/webp">
                    <p class="mt-2 text-xs text-slate-500">Format JPG, PNG, atau WEBP. Maksimal 2MB.</p>
                </div>
            </div>

            <button class="mt-6 inline-flex w-full items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950" type="submit">Tambah Pengurus</button>
        </form>
    </aside>
</div>
@endsection
