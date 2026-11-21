@layout('admin::layout')

@section('content')
@if (! empty($success))
    <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800" role="status">{{ $success }}</div>
@endif

@if (! empty($error))
    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-800" role="alert">{{ $error }}</div>
@endif

<div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#9a742b]">Organisasi</p>
        <h2 class="mt-2 text-2xl font-semibold tracking-tight text-[#172b31]">Kelola direksi dan komisaris</h2>
        <p class="mt-2 text-sm text-slate-500">Tersimpan di tabel database <code>management</code></p>
    </div>
    <a href="{{ url('admin/management/create') }}" class="inline-flex min-h-11 items-center justify-center rounded-xl bg-[#173f46] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#102b35] focus:outline-none focus-visible:ring-4 focus-visible:ring-[#173f46]/20">+ Tambah Pengurus</a>
</div>

<div class="mt-7 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-[#f8f8f4] text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                <tr>
                    <th class="px-5 py-3">Pengurus</th>
                    <th class="px-5 py-3">Jabatan</th>
                    <th class="px-5 py-3">Kelompok</th>
                    <th class="px-5 py-3">Inisial</th>
                    <th class="px-5 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($management as $person)
                    <tr class="transition hover:bg-[#fbfcfa]">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                @if (! empty($person['photo_path']))
                                    <img src="{{ asset($person['photo_path']) }}" alt="Foto {{ $person['name'] }}" class="h-11 w-11 rounded-xl object-cover">
                                @else
                                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#edf3ef] text-sm font-bold text-[#28544c]">{{ $person['initials'] }}</span>
                                @endif
                                <p class="font-semibold text-slate-950">{{ $person['name'] }}</p>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-slate-700">{{ $person['position'] }}</td>
                        <td class="px-5 py-4 text-slate-700">{{ $person['group'] }}</td>
                        <td class="px-5 py-4 text-slate-700">{{ $person['initials'] }}</td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ url('admin/management/'.$person['id'].'/edit') }}" class="rounded-lg border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:border-[#28544c] hover:text-[#28544c]">Edit</a>
                                <form action="{{ url('admin/management/delete') }}" method="post" onsubmit="return confirm('Hapus pengurus ini?')">
                                    @php echo csrf_field(); @endphp
                                    <input type="hidden" name="id" value="{{ $person['id'] }}">
                                    <button class="rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-50" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-5 py-10 text-center" colspan="5">
                            <p class="font-semibold text-slate-950">Belum ada data pengurus</p>
                            <p class="mt-2 text-sm text-slate-600">Klik "Tambah Pengurus" untuk menambahkan data pertama.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
