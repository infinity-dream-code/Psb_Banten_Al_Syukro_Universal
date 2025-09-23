@extends('dashboard.template')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold text-gray-800 mb-4">Tambah Ujian</h1>

    <form action="{{ route('master.ujian.store') }}" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ujian</label>
            <input type="text" name="nama" value="{{ old('nama') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-green-500 focus:border-green-500"
                   required>
            @error('nama')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <a href="{{ route('master.ujian') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm mr-2">Batal</a>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">Simpan</button>
        </div>
    </form>
</div>
@endsection
