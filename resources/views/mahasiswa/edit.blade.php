@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="bg-white border-4 border-gray-200 rounded-lg shadow relative m-10">

    {{-- Header Form --}}
    <div class="flex items-start justify-between p-5 border-b rounded-t bg-gray-50">
        <h3 class="text-xl font-semibold text-gray-900">
            Edit Mahasiswa
        </h3>
        <a href="{{ route('mahasiswa.index') }}"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293
                          4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10
                          4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </a>
    </div>

    {{-- Form Section --}}
    <div class="p-6 space-y-6">
        <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            @php($edit = true)
            @include('mahasiswa.form')
        </form>
    </div>

    {{-- Footer with Submit Button --}}
    <div class="p-6 border-t border-gray-200 rounded-b bg-gray-50">
        <button form="form-mahasiswa" type="submit"
            class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Simpan Perubahan
        </button>
    </div>

</div>
@endsection