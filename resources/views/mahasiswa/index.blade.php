<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Mahasiswa</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                {{-- Flash Message --}}
                @if(session('success'))
                    <div class="flash-message bg-green-100 text-green-700 p-3 rounded-md mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="flash-message bg-red-100 text-red-700 p-3 rounded-md mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    {{-- Formulir Pencarian --}}
                    <form action="{{ route('mahasiswa.index') }}" method="GET">
                        <input type="text" name="search" placeholder="Cari mahasiswa..."
                            class="rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm w-64"
                            value="{{ request('search') }}">
                    </form>

                    {{-- Tombol Tambah Mahasiswa --}}
                    @can('create', App\Models\Mahasiswa::class)
                        <a href="{{ route('mahasiswa.create') }}"
                            class="px-6 py-3 bg-blue-600 text-gray-100 text-sm font-medium rounded-lg shadow-md border border-blue-700 hover:bg-blue-800 transition">
                            Tambah Mahasiswa
                        </a>
                    @endcan
                </div>

                <div class="overflow-x-auto rounded">
                    <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-700">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left font-medium">Nama</th>
                                <th class="px-6 py-3 text-left font-medium">Email</th>
                                <th class="px-6 py-3 text-left font-medium">NIM</th>
                                <th class="px-6 py-3 text-left font-medium">Jurusan</th>
                                <th class="px-6 py-3 text-left font-medium">Angkatan</th>
                                <th class="px-6 py-3 text-center font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($mahasiswas as $mhs)
                                <tr class="hover:bg-gray-100 transition">
                                    <td class="px-6 py-4">{{ $mhs->user->name }}</td>
                                    <td class="px-6 py-4">{{ $mhs->user->email }}</td>
                                    <td class="px-6 py-4">{{ $mhs->nim }}</td>
                                    <td class="px-6 py-4">{{ $mhs->jurusan }}</td>
                                    <td class="px-6 py-4">{{ $mhs->angkatan }}</td>
                                    <td class="px-6 py-4 flex justify-center space-x-4">
                                        {{-- Tombol Edit --}}
                                        @can('update', $mhs)
                                            <a href="{{ route('mahasiswa.edit', $mhs->id) }}"
                                                class="text-blue-600 hover:text-blue-800 transform hover:scale-110 transition">
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                        @endcan

                                        {{-- Tombol Hapus --}}
                                        @can('delete', $mhs)
                                            <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST"
                                                class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-800 transform hover:scale-110 transition delete-btn">
                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endcan

                                        {{-- Jika tidak memiliki izin untuk edit atau delete --}}
                                        @unless(Gate::allows('update', $mhs) || Gate::allows('delete', $mhs))
                                            <span>-</span>
                                        @endunless
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center px-6 py-4">Data tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $mahasiswas->links() }}
                </div>

            </div>
        </div>
    </div>

    {{-- JavaScript untuk Flash Message & Konfirmasi Hapus --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Flash message auto-hide
            setTimeout(() => {
                document.querySelectorAll(".flash-message").forEach(msg => msg.style.display = "none");
            }, 5000);

            // Konfirmasi sebelum hapus
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

</x-app-layout>