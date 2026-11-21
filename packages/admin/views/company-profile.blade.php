@layout('admin::layout')

@section('content')
@if (! empty($success))
    <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800" role="status">{{ $success }}</div>
@endif

<form action="{{ url('admin/company-profile') }}" method="post" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
    @php echo csrf_field(); @endphp
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#9a742b]">Profil Perusahaan</p>
            <h2 class="mt-2 text-2xl font-semibold tracking-tight text-[#172b31]">Kelola konten Tentang Kami</h2>
        </div>
        <p class="text-sm text-slate-500">Tersimpan di tabel database <code>company_profile</code></p>
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-2">
        <div class="lg:col-span-2">
            <label class="block text-sm font-semibold text-slate-700" for="hero_intro">Intro Hero</label>
            <textarea class="mt-2 min-h-24 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" id="hero_intro" name="hero_intro">{{ $profile['hero_intro'] }}</textarea>
        </div>

        <div class="lg:col-span-2">
            <label class="block text-sm font-semibold text-slate-700" for="profile_heading">Judul Profil</label>
            <input class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" id="profile_heading" name="profile_heading" type="text" value="{{ $profile['profile_heading'] }}">
        </div>

        <div class="lg:col-span-2">
            <label class="block text-sm font-semibold text-slate-700" for="profile_summary">Ringkasan Profil</label>
            <textarea class="mt-2 min-h-32 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" id="profile_summary" name="profile_summary">{{ $profile['profile_summary'] }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700" for="area_service">Area Layanan</label>
            <textarea class="mt-2 min-h-28 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" id="area_service" name="area_service">{{ $profile['area_service'] }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700" for="information_focus">Fokus Informasi</label>
            <textarea class="mt-2 min-h-28 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" id="information_focus" name="information_focus">{{ $profile['information_focus'] }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700" for="vision">Visi</label>
            <textarea class="mt-2 min-h-32 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" id="vision" name="vision">{{ $profile['vision'] }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700" for="mission">Misi</label>
            <textarea class="mt-2 min-h-32 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" id="mission" name="mission">{{ $profile['mission'] }}</textarea>
        </div>
    </div>

    <div class="mt-8 flex justify-end">
        <button class="inline-flex min-h-11 items-center justify-center rounded-xl bg-[#173f46] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#102b35] focus:outline-none focus-visible:ring-4 focus-visible:ring-[#173f46]/20" type="submit">Simpan Profil</button>
    </div>
</form>
@endsection
