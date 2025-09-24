@extends('dashboard.template')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold text-gray-800 mb-4">Tambah Unit</h1>
@if(session('error'))
    <div class="p-3 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="p-3 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
        {{ session('success') }}
    </div>
@endif

    <form action="{{ route('master.unit.store') }}" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf

        <div class="mb-4">
            <label for="fakultas" class="block text-sm font-medium text-gray-700 mb-2">Nama Unit</label>
            <input type="text" id="fakultas" name="fakultas" 
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500 text-sm"
                   placeholder="Contoh: Fakultas Teknik" required>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('master.unit') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm mr-2">
                Batal
            </a>
            <button type="submit" 
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
