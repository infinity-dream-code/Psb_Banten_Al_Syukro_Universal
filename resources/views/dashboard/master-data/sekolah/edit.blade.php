@extends('dashboard.template')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold text-gray-800 mb-4">Edit Master Jurusan</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('master.sekolah.update', $prodi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="id_fakultas" class="block text-sm font-medium text-gray-700 mb-2">Sekolah</label>
                <select name="id_fakultas" id="id_fakultas"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500 text-sm"
                        required>
                    @foreach ($fakultas as $f)
                        <option value="{{ $f->id }}" {{ $prodi->id_fakultas == $f->id ? 'selected' : '' }}>
                            {{ $f->fakultas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Jurusan</label>
                <input type="text" id="nama" name="nama"
                       value="{{ old('nama', $prodi->nama) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500 text-sm"
                       required>
            </div>

            <div class="flex justify-end">
                <a href="{{ url('PmbMstPendaftarans/master-sekolah') }}" 
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
</div>


@endsection
