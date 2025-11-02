@extends('dashboard.template')
@section('content')
<div class="max-w-3xl mx-auto mt-5">
  <div class="bg-white border rounded-xl">
    <div class="border-b px-6 py-4 text-base font-semibold">Tambah User</div>
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

      <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="mb-5">
          <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
          <input type="text" name="nama" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500" value="{{ old('nama') }}">
        </div>

        <div class="mb-5">
          <label class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
          <input type="text" name="username" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500" value="{{ old('username') }}">
        </div>

        <div class="mb-5">
          <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
          <input type="password" name="password" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500">
        </div>

        <div class="mb-5">
          <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
          <select name="role_id" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500">
            <option value="">-- Pilih Role --</option>
            @foreach($roles as $r)
              <option value="{{ $r->id }}">{{ $r->nama_role }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-5">
          <label class="block text-sm font-semibold text-gray-700 mb-2">Sekolah</label>
          <select id="fakultas" name="fakultas_id" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500">
            <option value="">-- Pilih Sekolah --</option>
            @foreach($fakultas as $f)
              <option value="{{ $f->id }}">{{ $f->fakultas }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-5" id="prodi-container" style="display: none;">
          <label class="block text-sm font-semibold text-gray-700 mb-2">Jurusan</label>
          <div id="prodi-checkboxes" class="border rounded-lg px-3 py-3 max-h-60 overflow-y-auto bg-gray-50">
            <div class="text-gray-500 text-sm">Memuat data Jurusan...</div>
          </div>
          <p class="text-xs text-gray-500 mt-1">*Pilih satu atau lebih Jurusan</p>
        </div>

        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium">Simpan</button>
        <a href="{{ url('PmbMstPendaftarans/users') }}" class="ml-2 inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium border border-gray-300 hover:bg-gray-50">Kembali</a>
      </form>
    </div>
  </div>
</div>

<script>
document.getElementById('fakultas').addEventListener('change', function() {
    const fakultasId = this.value;
    const prodiContainer = document.getElementById('prodi-container');
    const prodiCheckboxes = document.getElementById('prodi-checkboxes');
    if (fakultasId) {
        prodiContainer.style.display = 'block';
        prodiCheckboxes.innerHTML = '<div class="text-gray-500 text-sm">Memuat data Jurusan...</div>';
        fetch(`/api/get-prodi-by-fakultas/${fakultasId}`)
            .then(res => res.json())
            .then(data => {
                if (data.length > 0) {
                    prodiCheckboxes.innerHTML = '';
                    data.forEach(p => {
                        const checkboxDiv = document.createElement('div');
                        checkboxDiv.className = 'flex items-center mb-2';
                        checkboxDiv.innerHTML = `
                            <input type="checkbox" name="prodi_id[]" value="${p.id}" id="prodi_${p.id}" checked class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                            <label for="prodi_${p.id}" class="ml-2 text-sm text-gray-700 cursor-pointer">${p.nama}</label>
                        `;
                        prodiCheckboxes.appendChild(checkboxDiv);
                    });
                } else {
                    prodiCheckboxes.innerHTML = '<div class="text-gray-500 text-sm">Tidak ada Jurusan tersedia</div>';
                }
            })
            .catch(() => {
                prodiCheckboxes.innerHTML = '<div class="text-red-500 text-sm">Gagal memuat data Jurusan</div>';
            });
    } else {
        prodiContainer.style.display = 'none';
        prodiCheckboxes.innerHTML = '<div class="text-gray-500 text-sm">Memuat data Jurusan...</div>';
    }
});
</script>
@endsection
