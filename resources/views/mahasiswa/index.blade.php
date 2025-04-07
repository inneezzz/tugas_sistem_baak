<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-emerald-700 leading-tight">Data Mahasiswa</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-lg rounded-xl border border-emerald-100 transition duration-300">

                {{-- Flash Message --}}
                @if(session('success'))
                    <div class="flash-message bg-emerald-100 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-lg mb-5 shadow-sm animate-fade-in">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="flash-message bg-rose-100 border border-rose-300 text-rose-800 px-4 py-3 rounded-lg mb-5 shadow-sm animate-fade-in">
                        ❌ {{ session('error') }}
                    </div>
                @endif

                <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                    {{-- Formulir Pencarian --}}
                    <form action="{{ route('mahasiswa.index') }}" method="GET" class="w-full sm:w-auto">
                        <input type="text" name="search" placeholder="🔍 Cari mahasiswa..."
                            class="rounded-lg border border-emerald-300 focus:border-emerald-500 focus:ring-emerald-400 text-sm w-full sm:w-72 px-4 py-2 shadow-sm transition"
                            value="{{ request('search') }}">
                    </form>

                    {{-- Tombol Tambah Mahasiswa --}}
                    @can('create', App\Models\Mahasiswa::class)
                        <a href="{{ route('mahasiswa.create') }}"
                            class="flex items-center gap-2 px-5 py-3 bg-emerald-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-emerald-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Mahasiswa
                        </a>
                    @endcan
                </div>

                <div class="overflow-x-auto rounded-lg shadow">
                    <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-700">
                        <thead class="bg-emerald-50 text-emerald-800">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold">Nama</th>
                                <th class="px-6 py-3 text-left font-semibold">Email</th>
                                <th class="px-6 py-3 text-left font-semibold">NIM</th>
                                <th class="px-6 py-3 text-left font-semibold">Jurusan</th>
                                <th class="px-6 py-3 text-left font-semibold">Angkatan</th>
                                <th class="px-6 py-3 text-center font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($mahasiswas as $mhs)
                                <tr class="hover:bg-emerald-50/40 transition">
                                    <td class="px-6 py-4">{{ $mhs->user->name }}</td>
                                    <td class="px-6 py-4">{{ $mhs->user->email }}</td>
                                    <td class="px-6 py-4">{{ $mhs->nim }}</td>
                                    <td class="px-6 py-4">{{ $mhs->jurusan }}</td>
                                    <td class="px-6 py-4">{{ $mhs->angkatan }}</td>
                                    <td class="px-6 py-4 flex justify-center space-x-4">
                                        {{-- Tombol Edit --}}
                                        @can('update', $mhs)
                                            <a href="{{ route('mahasiswa.edit', $mhs->id) }}"
                                                class="text-indigo-600 hover:text-indigo-800 transform hover:scale-110 transition">
                                                ✏️
                                            </a>
                                        @endcan

                                        {{-- Tombol Hapus --}}
                                        @can('delete', $mhs)
                                            <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST"
                                                class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-rose-600 hover:text-rose-800 transform hover:scale-110 transition delete-btn">
                                                    🗑️
                                                </button>
                                            </form>
                                        @endcan

                                        {{-- Jika tidak memiliki izin --}}
                                        @unless(Gate::allows('update', $mhs) || Gate::allows('delete', $mhs))
                                            <span class="text-gray-400">-</span>
                                        @endunless
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center px-6 py-6 text-gray-500 italic">Data tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $mahasiswas->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Auto-hide flash message
            setTimeout(() => {
                document.querySelectorAll(".flash-message").forEach(msg => {
                    msg.style.transition = "opacity 0.5s ease-out";
                    msg.style.opacity = 0;
                    setTimeout(() => msg.remove(), 500);
                });
            }, 5000);

            // Konfirmasi hapus
            document.querySelectorAll(".delete-btn").forEach(button => {
                button.addEventListener("click", function (event) {
                    event.preventDefault();
                    let form = this.closest("form");
                    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
    </style>
</x-app-layout>
