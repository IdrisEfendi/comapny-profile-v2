@layout('admin::layout')

@section('content')
@if (! empty($success))
    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">{{ $success }}</div>
@endif

<div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Pesan Kontak</p>
            <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">Pesan masuk dari website</h2>
        </div>
        <p class="rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700">Belum dibaca: {{ $unreadCount }}</p>
    </div>

    <div class="mt-8 overflow-hidden rounded-2xl border border-slate-200">
        <div class="hidden grid-cols-12 gap-4 bg-slate-50 px-5 py-3 text-xs font-bold uppercase tracking-wider text-slate-500 md:grid">
            <div class="col-span-3">Pengirim</div>
            <div class="col-span-3">Kontak</div>
            <div class="col-span-3">Subjek</div>
            <div class="col-span-2">Tanggal</div>
            <div class="col-span-1 text-right">Aksi</div>
        </div>

        <div class="divide-y divide-slate-200">
            @forelse ($messages as $message)
                <article class="grid gap-3 px-5 py-4 md:grid-cols-12 md:items-center md:gap-4 {{ ! $message->is_read ? 'bg-amber-50/60' : 'bg-white' }}">
                    <div class="md:col-span-3">
                        <p class="font-semibold text-slate-950">{{ $message->name }}</p>
                        @if (! $message->is_read)
                            <span class="mt-1 inline-flex rounded-full bg-amber-100 px-2 py-1 text-xs font-semibold text-amber-800">Baru</span>
                        @endif
                    </div>
                    <div class="break-all text-sm text-slate-600 md:col-span-3">{{ $message->contact }}</div>
                    <div class="text-sm text-slate-600 md:col-span-3">{{ $message->subject }}</div>
                    <div class="text-sm text-slate-500 md:col-span-2">{{ $message->created_at }}</div>
                    <div class="flex gap-2 md:col-span-1 md:justify-end">
                        <a href="{{ url('admin/contact-messages/'.$message->id) }}" class="rounded-full bg-blue-800 px-4 py-2 text-xs font-bold text-white hover:bg-blue-950">Lihat</a>
                    </div>
                </article>
            @empty
                <div class="px-5 py-10 text-center text-sm text-slate-500">Belum ada pesan kontak.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
