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
        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#9a742b]">Publikasi</p>
        <h2 class="mt-2 text-2xl font-semibold tracking-tight text-[#172b31]">Kelola berita dan pengumuman</h2>
        <p class="mt-2 text-sm text-slate-500">Tersimpan di tabel database <code>news</code></p>
    </div>
    <a href="{{ url('admin/news/create') }}" class="inline-flex min-h-11 items-center justify-center rounded-xl bg-[#173f46] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#102b35] focus:outline-none focus-visible:ring-4 focus-visible:ring-[#173f46]/20">+ Tambah Berita</a>
</div>

<div class="mt-7 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-[#f8f8f4] text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                <tr>
                    <th class="px-5 py-3">Judul</th>
                    <th class="px-5 py-3">Kategori</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3">Tanggal Terbit</th>
                    <th class="px-5 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($news as $item)
                    <tr class="transition hover:bg-[#fbfcfa]">
                        <td class="px-5 py-4">
                            <p class="font-semibold text-slate-950">{{ $item['title'] }}</p>
                            <p class="text-xs text-slate-500">{{ $item['slug'] }}</p>
                        </td>
                        <td class="px-5 py-4 text-slate-700">{{ $item['category'] !== '' ? $item['category'] : '-' }}</td>
                        <td class="px-5 py-4">
                            @if (! empty($item['is_published']))
                                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-800">Tampil</span>
                            @else
                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">Draft</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-slate-700">{{ ! empty($item['published_at']) ? $item['published_at'] : '-' }}</td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-2">
                                @if (! empty($item['is_published']))
                                    <a href="{{ url('berita/'.$item['slug']) }}" target="_blank" rel="noopener" class="rounded-lg border border-[#cbd8d1] px-3 py-2 text-xs font-semibold text-[#28544c] transition hover:bg-emerald-50">Lihat Website</a>
                                @endif
                                <a href="{{ url('admin/news/'.$item['id'].'/edit') }}" class="rounded-lg border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:border-[#28544c] hover:text-[#28544c]">Edit</a>
                                <form action="{{ url('admin/news/delete') }}" method="post" onsubmit="return confirm('Hapus berita ini?')">
                                    @php echo csrf_field(); @endphp
                                    <input type="hidden" name="slug" value="{{ $item['slug'] }}">
                                    <input type="hidden" name="page" value="{{ $filters['page'] }}">
                                    <button class="rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-50" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-5 py-10 text-center" colspan="5">
                            <p class="font-semibold text-slate-950">Belum ada berita</p>
                            <p class="mt-2 text-sm text-slate-600">Klik "Tambah Berita" untuk menambahkan berita atau pengumuman pertama.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if (isset($totalPages) && $totalPages > 1)
        <div class="flex flex-col gap-4 border-t border-slate-200 bg-[#fbfcfa] p-5 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-slate-500">Halaman {{ $filters['page'] }} dari {{ $totalPages }} ({{ $total }} berita)</p>
            <div class="flex gap-3">
                @if ($filters['page'] > 1)
                    <a class="inline-flex items-center justify-center rounded-xl border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-700 hover:border-[#28544c] hover:text-[#28544c]" href="{{ url('admin/news?page='.($filters['page'] - 1)) }}">Sebelumnya</a>
                @endif
                @if ($filters['page'] < $totalPages)
                    <a class="inline-flex items-center justify-center rounded-xl bg-[#173f46] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#102b35]" href="{{ url('admin/news?page='.($filters['page'] + 1)) }}">Berikutnya</a>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
