@extends('dashboard.template')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold text-gray-800 mb-4">Edit Ruang</h1>

    <form action="{{ route('master.ruang.update', $data->id) }}" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="ruang" class="block text-sm font-medium text-gray-700 mb-2">Nama Ruang</label>
            <input type="text" id="ruang" name="ruang"
                   value="{{ old('ruang', $data->ruang) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500 text-sm"
                   required>
        </div>

        <div class="mb-4">
            <label for="kapasitas" class="block text-sm font-medium text-gray-700 mb-2">Kapasitas</label>
            <input type="number" id="kapasitas" name="kapasitas"
                   value="{{ old('kapasitas', $data->kapasitas) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500 text-sm"
                   required>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('master.ruang') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm mr-2">Batal</a>
            <button type="submit" 
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">Update</button>
        </div>
    </form>
</div>
@endsection
