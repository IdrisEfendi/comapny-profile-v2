@layout('admin::layout')

@section('content')
@if (! empty($success))
    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">{{ $success }}</div>
@endif

<form action="{{ url('admin/company-profile') }}" method="post" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5">
    @php echo csrf_field(); @endphp
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Profil Perusahaan</p>
            <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">Kelola konten Tentang Kami</h2>
        </div>
        <p class="text-sm text-slate-500">Tersimpan di tabel database <code>company_profile</code></p>
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-2">
        <div class="lg:col-span-2">
            <label class="block text-sm font-semibold text-slate-700" for="hero_intro">Intro Hero</label>
            <textarea class="mt-2 min-h-24 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="hero_intro" name="hero_intro">{{ $profile['hero_intro'] }}</textarea>
        </div>

        <div class="lg:col-span-2">
            <label class="block text-sm font-semibold text-slate-700" for="profile_heading">Judul Profil</label>
            <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="profile_heading" name="profile_heading" type="text" value="{{ $profile['profile_heading'] }}">
        </div>

        <div class="lg:col-span-2">
            <label class="block text-sm font-semibold text-slate-700" for="profile_summary">Ringkasan Profil</label>
            <textarea class="mt-2 min-h-32 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="profile_summary" name="profile_summary">{{ $profile['profile_summary'] }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700" for="area_service">Area Layanan</label>
            <textarea class="mt-2 min-h-28 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="area_service" name="area_service">{{ $profile['area_service'] }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700" for="information_focus">Fokus Informasi</label>
            <textarea class="mt-2 min-h-28 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="information_focus" name="information_focus">{{ $profile['information_focus'] }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700" for="vision">Visi</label>
            <textarea class="mt-2 min-h-32 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="vision" name="vision">{{ $profile['vision'] }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700" for="mission">Misi</label>
            <textarea class="mt-2 min-h-32 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="mission" name="mission">{{ $profile['mission'] }}</textarea>
        </div>
    </div>

    <div class="mt-8 flex justify-end">
        <button class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950" type="submit">Simpan Profil</button>
    </div>
</form>
@endsection
