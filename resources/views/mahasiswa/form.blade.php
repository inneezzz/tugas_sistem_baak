@csrf

<div class="grid grid-cols-6 gap-6">
    <div class="col-span-6 sm:col-span-3">
        <label class="block text-sm font-medium text-emerald-800">Nama</label>
        <input type="text" name="name" value="{{ old('name', $mahasiswa->user->name ?? '') }}"
            class="mt-1 block w-full rounded-lg border-emerald-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm shadow-sm">
    </div>

    <div class="col-span-6 sm:col-span-3">
        <label class="block text-sm font-medium text-emerald-800">Email</label>
        <input type="email" name="email" value="{{ old('email', $mahasiswa->user->email ?? '') }}"
            class="mt-1 block w-full rounded-lg border-emerald-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm shadow-sm">
    </div>

    @if (!isset($edit))
        <div class="col-span-6 sm:col-span-3">
            <label class="block text-sm font-medium text-emerald-800">Password</label>
            <input type="password" name="password"
                class="mt-1 block w-full rounded-lg border-emerald-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm shadow-sm">
        </div>

        <div class="col-span-6 sm:col-span-3">
            <label class="block text-sm font-medium text-emerald-800">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                class="mt-1 block w-full rounded-lg border-emerald-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm shadow-sm">
        </div>
    @endif

    <div class="col-span-6 sm:col-span-3">
        <label class="block text-sm font-medium text-emerald-800">NIM</label>
        <input type="text" name="nim" value="{{ old('nim', $mahasiswa->nim ?? '') }}"
            class="mt-1 block w-full rounded-lg border-emerald-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm shadow-sm">
    </div>

    <div class="col-span-6 sm:col-span-3">
        <label class="block text-sm font-medium text-emerald-800">Jurusan</label>
        <input type="text" name="jurusan" value="{{ old('jurusan', $mahasiswa->jurusan ?? '') }}"
            class="mt-1 block w-full rounded-lg border-emerald-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm shadow-sm">
    </div>

    <div class="col-span-6 sm:col-span-3">
        <label class="block text-sm font-medium text-emerald-800">Angkatan</label>
        <input type="text" name="angkatan" value="{{ old('angkatan', $mahasiswa->angkatan ?? '') }}"
            class="mt-1 block w-full rounded-lg border-emerald-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm shadow-sm">
    </div>

    <div class="col-span-6">
        <label class="block text-sm font-medium text-emerald-800">Alamat</label>
        <textarea name="alamat" rows="3"
            class="mt-1 block w-full rounded-lg border-emerald-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm shadow-sm">{{ old('alamat', $mahasiswa->alamat ?? '') }}</textarea>
    </div>
</div>

<div class="flex justify-between items-center mt-6">
    <a href="{{ route('mahasiswa.index') }}" class="text-sm text-emerald-600 hover:underline">
        ← Kembali
    </a>

    <button type="submit"
        class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-lg font-semibold text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-400 text-sm shadow-sm">
        Simpan
    </button>
</div>
