@extends('dashboard.template')
@section('content')
<div class="max-w-2xl mx-auto mt-5">
  <div class="bg-white border rounded-xl">
    <div class="border-b px-6 py-4 text-base font-semibold">Tambah Jalur</div>
    <div class="p-6">
      @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-3">{{ session('success') }}</div>
      @endif
      @if($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 text-red-800 px-4 py-3">
          <ul class="list-disc list-inside">
            @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('master.jalur.store') }}">
        @csrf
        <div class="mb-5">
          <label class="block text-sm font-semibold text-gray-700 mb-3">Nama Jalur</label>
          <input type="text" name="nama" required placeholder="Contoh: Reguler"
                 value="{{ old('nama') }}"
                 class="input-focus w-full p-3 border-2 border-gray-200 rounded-lg 
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-gray-50 
                        hover:bg-white transition-colors">
        </div>

        <div class="mb-5 flex items-center space-x-6">
          <label class="inline-flex items-center">
            <input type="checkbox" name="is_active" value="1" class="form-checkbox h-5 w-5 text-green-600 rounded"
                   {{ old('is_active', true) ? 'checked' : '' }}>
            <span class="ml-2 text-gray-700">Aktif</span>
          </label>
          <label class="inline-flex items-center">
            <input type="checkbox" name="is_free" value="1" class="form-checkbox h-5 w-5 text-green-600 rounded"
                   {{ old('is_free') ? 'checked' : '' }}>
            <span class="ml-2 text-gray-700">Gratis?</span>
          </label>
        </div>

        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium">
          Simpan
        </button>
        <a href="{{ route('master.jalur') }}" 
           class="ml-2 inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium border border-gray-300 hover:bg-gray-50">
          Kembali
        </a>
      </form>
    </div>
  </div>
</div>
@endsection
