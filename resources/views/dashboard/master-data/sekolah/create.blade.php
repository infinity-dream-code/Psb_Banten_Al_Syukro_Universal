@extends('dashboard.template')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold text-gray-800 mb-4">Tambah Master Sekolah</h1>

    <form action="{{ route('master.sekolah.store') }}" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label for="id_fakultas" class="block text-sm font-medium text-gray-700 mb-2">Unit</label>
            <select name="id_fakultas" id="id_fakultas"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500 text-sm"
                    required>
                <option value="">-- Pilih Unit --</option>
                @foreach ($fakultas as $f)
                    <option value="{{ $f->id }}" {{ old('id_fakultas') == $f->id ? 'selected' : '' }}>
                        {{ $f->fakultas }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Sekolah</label>
            <input type="text" id="nama" name="nama" 
                   value="{{ old('nama') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500 text-sm"
                   placeholder="Contoh: Teknik Informatika" required>
        </div>


        <div class="flex justify-end">
            <a href="{{ route('master.sekolah') }}" 
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
