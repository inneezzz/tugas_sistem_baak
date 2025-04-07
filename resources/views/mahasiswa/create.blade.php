@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
    <div class="bg-white border border-4 rounded-lg shadow relative m-10">

        <div class="flex items-start justify-between p-5 border-b rounded-t">
            <h3 class="text-xl font-semibold">
                Tambah Mahasiswa
            </h3>
            <a href="{{ route('mahasiswa.index') }}"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>

        <div class="p-6 space-y-6">
            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf
                @include('mahasiswa.form')

                <div class="pt-6 border-t border-gray-200 flex justify-end">
                    
                </div>
            </form>
        </div>

    </div>
@endsection