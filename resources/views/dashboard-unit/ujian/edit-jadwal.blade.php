@extends('dashboard-unit.template')
@section('content')
<div class="bg-white p-6 shadow rounded-lg">
    <h1 class="text-xl font-semibold mb-4">Edit Jadwal Ujian</h1>

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

        <input type="text" name="search" value="{{ request('search') }}" class="w-64 px-3 py-2 border rounded-lg" placeholder="Cari nama atau no pendaftaran...">

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Cari</button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="border px-3 py-2">#</th>
                    <th class="border px-3 py-2">Nama Peserta</th>
                    <th class="border px-3 py-2">No Pendaftaran</th>
                    <th class="border px-3 py-2">Sekolah</th>
                    <th class="border px-3 py-2">Jurusan</th>
                    <th class="border px-3 py-2">Jalur</th>
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
                        <td class="border px-3 py-2 text-center">
                            <input type="checkbox" class="ujian-checkbox"
                                value="{{ $peserta->id }}"
                                data-nama="{{ $peserta->nama_peserta }}"
                                data-ujian='@json($peserta->ujian)'>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pesertaList->withQueryString()->links() }}
    </div>

    <div class="mt-4 flex justify-end">
        <button type="button" id="btnEdit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Edit Jadwal Ujian</button>
    </div>
</div>

<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white w-full max-w-2xl rounded-xl shadow-xl p-6 relative">
        <div class="flex justify-between items-center border-b pb-3 mb-5">
            <h2 class="text-xl font-semibold text-gray-800">Edit Jadwal Ujian</h2>
            <button onclick="closeEditModal()" class="text-gray-500 hover:text-red-600 text-2xl font-bold">✖</button>
        </div>
        <form id="editForm" method="POST" action="{{ route('pmb.updateJadwalUjian1', str_replace(' ', '-', $role ?? 'admin')) }}">
            @csrf
            <div id="editContent" class="space-y-6"></div>
            <div class="flex justify-end gap-3 pt-4 border-t mt-6">
                <button type="button" onclick="closeEditModal()" class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Close</button>
                <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
const masterRuang = @json($masterRuangList);

document.getElementById('checkAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.ujian-checkbox');
    checkboxes.forEach(cb => cb.checked = this.checked);
});

document.getElementById('btnEdit').addEventListener('click', function() {
    let selected = [];
    document.querySelectorAll('.ujian-checkbox:checked').forEach(cb => {
        selected.push({
            id: cb.value,
            nama: cb.getAttribute('data-nama'),
            ujian: JSON.parse(cb.getAttribute('data-ujian'))
        });
    });

    if (selected.length === 0) {
        alert("Silakan pilih minimal 1 jadwal untuk diedit.");
        return;
    }

    let html = '';
    selected.forEach(item => {
        item.ujian.forEach(uji => {
            let ruangOptions = '<option value="">-- Pilih Ruang --</option>';
            masterRuang.forEach(r => {
                const selectedRuang = (uji.ruang && uji.ruang == r.ruang) ? 'selected' : '';
                ruangOptions += `<option value="${r.ruang}" ${selectedRuang}>${r.ruang}</option>`;
            });

            html += `
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Peserta : ${item.nama}<br>
                        Ujian : ${uji.master_ujian?.nama ?? 'Ujian'}
                    </label>
                    <div class="flex gap-3">
                        <input type="datetime-local" 
                            name="jadwal[${item.id}][${uji.id}][tanggal]"
                            value="${uji.tanggal ? new Date(uji.tanggal).toISOString().slice(0,16) : ''}"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <select 
                            name="jadwal[${item.id}][${uji.id}][ruang]"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            ${ruangOptions}
                        </select>
                    </div>
                </div>
            `;
        });
    });

    document.getElementById('editContent').innerHTML = html;
    document.getElementById('editModal').classList.remove('hidden');
});

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}
</script>
@endsection
