@extends('dashboard-unit.template')

@section('content')
<div class="bg-white p-6 shadow rounded-lg">
    <h1 class="text-xl font-semibold mb-4">Cetak Kartu Ujian Reguler</h1>

    <form method="GET" action="{{ url()->current() }}" class="mb-4 flex flex-wrap gap-2 items-center">
        <select name="tahun_akademik" class="px-3 py-2 border rounded-lg" onchange="this.form.submit()">
            <option value="">--Pilih Tahun Akademik--</option>
            @foreach($tahunAkademikList as $th)
                <option value="{{ $th->tahun_akademik }}" {{ request('tahun_akademik') == $th->tahun_akademik ? 'selected' : '' }}>
                    {{ $th->tahun_akademik }}
                </option>
            @endforeach
        </select>

        <select name="gelombang_id" class="px-3 py-2 border rounded-lg" onchange="this.form.submit()">
            <option value="">--Pilih Gelombang--</option>
            @foreach($gelombangList as $gel)
                <option value="{{ $gel->id }}" {{ $idGelombang == $gel->id ? 'selected' : '' }}>
                    Gelombang {{ $gel->gelombang }} ({{ $gel->start->format('d M Y') }} - {{ $gel->end->format('d M Y') }})
                </option>
            @endforeach
        </select>

        <input type="text" name="search" value="{{ request('search') }}"
            class="w-64 px-3 py-2 border rounded-lg"
            placeholder="Cari nama atau no pendaftaran...">

        <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Cari</button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="border px-3 py-2">#</th>
                    <th class="border px-3 py-2">Nama Mahasiswa</th>
                    <th class="border px-3 py-2">No Pendaftaran</th>
                    <th class="border px-3 py-2">Sekolah</th>
                    <th class="border px-3 py-2">Unit</th>
                    <th class="border px-3 py-2">Jalur</th>
                    <th class="border px-3 py-2">Tahun Akademik</th>
                    <th class="border px-3 py-2 text-center"><input type="checkbox" id="checkAll"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesertaList as $i => $peserta)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-3 py-2">{{ $pesertaList->firstItem() + $i }}</td>
                        <td class="border px-3 py-2">{{ $peserta->nama_peserta }}</td>
                        <td class="border px-3 py-2">{{ $peserta->no_pendaftaran }}</td>
                        <td class="border px-3 py-2">{{ $peserta->fakultas }}</td>
                        <td class="border px-3 py-2">{{ $peserta->prodi }}</td>
                        <td class="border px-3 py-2">{{ $peserta->jalur }}</td>
                        <td class="border px-3 py-2">{{ $peserta->relasiGelombang->tahun_akademik ?? '-' }}</td>
                        <td class="border px-3 py-2 text-center">
                            <input type="checkbox" name="peserta[]" value="{{ $peserta->no_pendaftaran }}">
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pesertaList->withQueryString()->links() }}
    </div>

    <div class="mt-4 flex justify-end">
        <button type="button" id="btnCetak"
            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Cetak</button>
    </div>
</div>

<script>
document.getElementById('checkAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('input[name="peserta[]"]');
    checkboxes.forEach(cb => cb.checked = this.checked);
});

document.getElementById('btnCetak').addEventListener('click', function() {
    let selected = [];
    document.querySelectorAll('input[name="peserta[]"]:checked').forEach(cb => {
        selected.push(cb.value);
    });
    if (selected.length === 0) {
        alert("Silakan pilih minimal 1 peserta untuk dicetak.");
        return;
    }
    let ids = selected.join(',');
 window.open("{{ url('PmbMstPendaftarans/cetak_kartu') }}/" + ids, '_blank');

});
</script>
@endsection
