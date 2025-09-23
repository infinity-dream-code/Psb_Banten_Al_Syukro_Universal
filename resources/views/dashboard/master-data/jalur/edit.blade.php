@extends('dashboard.template')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold text-gray-800 mb-4">Edit Jalur</h1>

    <form action="{{ route('master.jalur.update', $masterJalur->id) }}" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Jalur</label>
            <input type="text" id="nama" name="nama" 
                   value="{{ old('nama', $masterJalur->nama) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500 text-sm"
                   required>
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center mr-4">
                <input type="checkbox" name="is_active" value="1" 
                       class="form-checkbox h-5 w-5 text-green-600" 
                       {{ $masterJalur->is_active ? 'checked' : '' }}>
                <span class="ml-2">Aktif</span>
            </label>
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_free" value="1" 
                       class="form-checkbox h-5 w-5 text-green-600" 
                       {{ $masterJalur->is_free ? 'checked' : '' }}>
                <span class="ml-2">Gratis?</span>
            </label>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('master.jalur') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm mr-2">Batal</a>
            <button type="submit" 
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">Update</button>
        </div>
    </form>
</div>
@endsection
