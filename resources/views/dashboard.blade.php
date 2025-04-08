{{-- resources/views/dashboard.blade.php --}}
<x-app-layout :title="'Dashboard'" :header="'Dashboard'">
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 space-y-6 bg-white shadow-md rounded-md">

                <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-6">
                    <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-emerald-600">
                        <h2 class="text-lg font-semibold text-gray-800">Jumlah Mahasiswa</h2>
                        <p class="text-3xl font-bold text-emerald-600 mt-2">{{ $totalMahasiswa }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
