@extends('dashboard.template')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-lg rounded-xl p-8 mt-5">
    <h3 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Informasi
    </h3>

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-lg border border-red-300 bg-red-50 text-red-700">
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach ($errors->all() as $err)
                    <li>⚠ {{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('informasi.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="informasi" class="block text-sm font-medium text-gray-700 mb-2">Informasi</label>
            <textarea name="informasi" id="informasi" rows="6"
                      class="block w-full border border-gray-300 rounded-lg px-3 py-3 shadow-sm text-gray-700 text-base
                             focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ old('informasi') }}</textarea>
        </div>

        <div class="flex items-center justify-between border-t pt-6">
            <a href="{{ route('informasi.index') }}"
               class="inline-flex items-center text-sm text-gray-600 hover:text-green-700 transition">
                ← Kembali
            </a>
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium shadow-md transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
