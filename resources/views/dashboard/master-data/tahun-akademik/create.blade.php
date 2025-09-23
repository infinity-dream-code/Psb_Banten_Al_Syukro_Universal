@extends('dashboard.template')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold text-gray-800 mb-4">Tambah Tahun Akademik</h1>
@if ($errors->any())
    <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-400 text-red-700">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('master.tahun_akademik.store') }}" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf

        <div class="mb-4">
            <label for="tahun_akademik" class="block text-sm font-medium text-gray-700 mb-2">Tahun Akademik</label>
            <input type="text" id="tahun_akademik" name="tahun_akademik" 
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500 text-sm"
                   placeholder="Contoh: 2024/2025" required>
        </div>

        <div class="mb-4">
            <label for="tahun_mulai" class="block text-sm font-medium text-gray-700 mb-2">Tahun Mulai</label>
            <input type="number" id="tahun_mulai" name="tahun_mulai" 
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500 text-sm"
                   placeholder="Contoh: 2024" required>
        </div>

        <div class="mb-4">
            <label for="tahun_selesai" class="block text-sm font-medium text-gray-700 mb-2">Tahun Selesai</label>
            <input type="number" id="tahun_selesai" name="tahun_selesai" 
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500 text-sm"
                   placeholder="Contoh: 2025" required>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('master.tahun_akademik') }}" 
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

<script>
document.getElementById('tahun_akademik').addEventListener('input', function(e) {
    let val = e.target.value.replace(/\D/g, ''); // hanya angka
    if (val.length > 4) {
        e.target.value = val.substring(0, 4) + '/' + val.substring(4, 8);
    } else {
        e.target.value = val;
        if (val.length === 4) {
            e.target.value = val + '/';
        }
    }
});
</script>
@endsection
