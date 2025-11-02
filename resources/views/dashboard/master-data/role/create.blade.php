@extends('dashboard.template')
@section('content')
<div class="max-w-2xl mx-auto mt-5">
  <div class="bg-white border rounded-xl">
    <div class="border-b px-6 py-4 text-base font-semibold">Tambah Role</div>
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

      <form method="POST" action="{{ route('master.role.store') }}">
        @csrf
        <div class="mb-5">
          <label class="block text-sm font-semibold text-gray-700 mb-3">Nama Role</label>
          <input type="text" name="nama_role" required placeholder="Contoh: Admin Unit"
                 value="{{ old('nama_role') }}"
                 class="input-focus w-full p-3 border-2 border-gray-200 rounded-lg 
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-gray-50 
                        hover:bg-white transition-colors">
        </div>

        <div class="mb-5">
          <label class="block text-sm font-semibold text-gray-700 mb-3">Pilih Menu</label>
          <div class="grid grid-cols-2 gap-2">
            @php
              $menus = ['dashboard', 'master data', 'setting psb', 'kelengkapan', 'ujian', 'kelulusan', 'registrasi', 'report', 'group & pengguna', 'kelola peserta'];
            @endphp
            @foreach($menus as $menu)
              <label class="inline-flex items-center space-x-2">
                <input type="checkbox" name="menu[]" value="{{ $menu }}" class="form-checkbox h-5 w-5 text-green-600 rounded"
                       {{ is_array(old('menu')) && in_array($menu, old('menu')) ? 'checked' : '' }}>
                <span class="text-gray-700 capitalize">{{ $menu }}</span>
              </label>
            @endforeach
          </div>
        </div>

        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium">
          Simpan
        </button>
        <a href="{{ route('master.role') }}" 
           class="ml-2 inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium border border-gray-300 hover:bg-gray-50">
          Kembali
        </a>
      </form>
    </div>
  </div>
</div>
@endsection
