@layout('admin::layout')

@section('content')
@if (! $message)
    <div class="rounded-2xl border border-red-200 bg-red-50 p-6 text-red-800" role="alert">Pesan tidak ditemukan.</div>
@else
    <div class="max-w-4xl rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <div class="flex flex-wrap items-center gap-2">
                    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#9a742b]">Detail Pesan</p>
                    @if (! $message->is_read)
                        <span class="rounded-full bg-amber-100 px-2 py-1 text-xs font-bold text-amber-800">Belum dibaca</span>
                    @else
                        <span class="rounded-full bg-slate-100 px-2 py-1 text-xs font-bold text-slate-500">Sudah dibaca</span>
                    @endif
                </div>
                <h2 class="mt-2 text-2xl font-semibold tracking-tight text-[#172b31]">{{ $message->subject }}</h2>
                <p class="mt-2 text-sm text-slate-500">Dikirim pada {{ $message->created_at }}</p>
            </div>
            <a href="{{ url('admin/contact-messages') }}" class="inline-flex min-h-10 items-center rounded-xl border border-slate-300 px-5 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#28544c] hover:text-[#28544c]">Kembali</a>
        </div>

        <div class="mt-8 grid gap-5 sm:grid-cols-2">
            <div class="rounded-xl border border-slate-100 bg-[#f8f8f4] p-5">
                <p class="text-sm font-semibold text-slate-500">Nama</p>
                <p class="mt-1 font-bold text-slate-950">{{ $message->name }}</p>
            </div>
            <div class="rounded-xl border border-slate-100 bg-[#f8f8f4] p-5">
                <p class="text-sm font-semibold text-slate-500">Email / Telepon</p>
                <p class="mt-1 break-all font-bold text-slate-950">{{ $message->contact }}</p>
            </div>
            <div class="rounded-xl border border-slate-100 bg-[#f8f8f4] p-5">
                <p class="text-sm font-semibold text-slate-500">IP Address</p>
                <p class="mt-1 font-bold text-slate-950">{{ $message->ip_address }}</p>
            </div>
            <div class="rounded-xl border border-slate-100 bg-[#f8f8f4] p-5">
                <p class="text-sm font-semibold text-slate-500">User Agent</p>
                <p class="mt-1 break-all text-sm text-slate-700">{{ $message->user_agent }}</p>
            </div>
        </div>

        <div class="mt-6 rounded-xl border border-slate-200 p-5">
            <p class="text-sm font-semibold text-slate-500">Pesan</p>
            <p class="mt-3 whitespace-pre-line leading-7 text-slate-700">{{ $message->message }}</p>
        </div>

        <div class="mt-6 flex flex-wrap gap-3">
            <form action="{{ url('admin/contact-messages/status') }}" method="post">
                @php echo csrf_field(); @endphp
                <input type="hidden" name="id" value="{{ $message->id }}">
                <input type="hidden" name="status" value="{{ $message->is_read ? 'unread' : 'read' }}">
                <input type="hidden" name="back" value="admin/contact-messages/{{ $message->id }}">
                <button class="inline-flex min-h-10 items-center rounded-xl border border-slate-300 px-5 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#28544c] hover:text-[#28544c]" type="submit">Tandai {{ $message->is_read ? 'Belum Dibaca' : 'Sudah Dibaca' }}</button>
            </form>

            <form action="{{ url('admin/contact-messages/delete') }}" method="post">
                @php echo csrf_field(); @endphp
                <input type="hidden" name="id" value="{{ $message->id }}">
                <input type="hidden" name="back" value="admin/contact-messages">
                <button class="inline-flex min-h-10 items-center rounded-xl border border-red-200 px-5 py-2 text-sm font-semibold text-red-700 transition hover:bg-red-50" type="submit">Hapus Pesan</button>
            </form>
        </div>
    </div>
@endif
@endsection
