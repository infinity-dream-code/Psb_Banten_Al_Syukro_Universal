@extends('dashboard.template')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold text-gray-800 mb-4">Edit Unit</h1>

    <form action="{{ route('master.unit.update', $biaya->id) }}" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="fakultas" class="block text-sm font-medium text-gray-700 mb-2">Nama Unit</label>
            <input type="text" id="fakultas" name="fakultas" 
                   value="{{ old('fakultas', $biaya->fakultas) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500 text-sm"
                   required>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('master.unit') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm mr-2">
                Batal
            </a>
            <button type="submit" 
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
