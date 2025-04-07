@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
    <div class="bg-white border border-emerald-200 rounded-xl shadow-lg m-10 transition duration-300">

        {{-- Header --}}
        <div class="flex items-start justify-between p-5 border-b border-emerald-100 rounded-t bg-emerald-50">
            <h3 class="text-xl font-bold text-emerald-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-emerald-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>
                Tambah Mahasiswa
            </h3>
            <a href="{{ route('mahasiswa.index') }}"
                class="text-gray-500 hover:text-emerald-600 hover:bg-emerald-100 rounded-full text-sm p-2 transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </div>

        {{-- Form --}}
        <div class="p-6 space-y-6">
            <form action="{{ route('mahasiswa.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Include form input --}}
                @include('mahasiswa.form')

                <div class="pt-6 border-t border-gray-200 flex justify-end">
                    
                </div>
            </form>
        </div>

    </div>
@endsection
