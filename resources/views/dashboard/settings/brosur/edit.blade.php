@extends('dashboard.template')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-lg rounded-xl p-8 mt-5">
    <h3 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Edit Brosur
    </h3>

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-lg border border-red-300 bg-red-50 text-red-700">
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach ($errors->all() as $err)
                    <li>⚠ {{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Edit --}}
    <form action="{{ route('setting-brosur.update', $setting_brosur->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Brosur Saat Ini --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Brosur Saat Ini</label>
            <div class="p-4 bg-gray-50 border rounded-lg shadow-sm">
                <a href="{{ asset('storage/'.$setting_brosur->brosur) }}" target="_blank"
                   class="text-green-600 font-medium hover:underline flex items-center gap-2">
                    📄 Lihat Brosur
                </a>
            </div>
        </div>

        {{-- Upload Brosur Baru --}}
        <div>
            <label for="brosur" class="block text-sm font-medium text-gray-700 mb-2">Upload Brosur Baru (Opsional)</label>
            <input type="file" name="brosur" id="brosur"
                   class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg shadow-sm 
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-md file:border-0 file:text-sm file:font-semibold
                          file:bg-green-50 file:text-green-700 hover:file:bg-green-100
                          focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex items-center justify-between border-t pt-6">
            <a href="{{ route('setting-brosur.index') }}"
               class="inline-flex items-center text-sm text-gray-600 hover:text-green-700 transition">
                ← Kembali
            </a>
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium shadow-md transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
