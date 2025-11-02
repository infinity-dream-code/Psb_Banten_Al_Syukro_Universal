@extends('dashboard-unit.template')

@section('content')
<div class="bg-white p-6 shadow rounded-lg">
    <h1 class="text-xl font-semibold mb-4">Data Pendaftar</h1>

    <form method="GET" action="{{ url()->current() }}" class="mb-4 flex flex-wrap gap-2">
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
                    Gelombang {{ $gel->gelombang }} ({{ \Carbon\Carbon::parse($gel->start)->format('d M Y') }} -
                    {{ \Carbon\Carbon::parse($gel->end)->format('d M Y') }})
                </option>
            @endforeach
        </select>

        <input type="text" name="search" value="{{ request('search') }}" 
            class="w-64 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
            placeholder="Cari nama, VA, jurusan, sekolah...">

        <button type="submit" 
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Cari</button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="border px-3 py-2">#</th>
                    <th class="border px-3 py-2">Nama</th>
                    <th class="border px-3 py-2">No. Pend (VA)</th>
                    <th class="border px-3 py-2">Sekolah</th>
                    <th class="border px-3 py-2">Jurusan</th>
                    <th class="border px-3 py-2">Jalur</th>
                    <th class="border px-3 py-2">Kelengkapan Isian</th>
                    <th class="border px-3 py-2">Upload</th>
                    <th class="border px-3 py-2">Status Bayar Pendaftaran</th>
                    <th class="border px-3 py-2">Status Bayar Registrasi Daftar Ulang</th>
                    <th class="border px-3 py-2">Detail</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesertaList as $i => $peserta)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-3 py-2">{{ $pesertaList->firstItem() + $i }}</td>
                        <td class="border px-3 py-2">{{ $peserta->nama_peserta }}</td>
                        <td class="border px-3 py-2">{{ $peserta->no_pendaftaran ?? '-' }}</td>
                        <td class="border px-3 py-2">{{ $peserta->fakultas ?? '-' }}</td>
                        <td class="border px-3 py-2">{{ $peserta->prodi ?? '-' }}</td>
                        <td class="border px-3 py-2">{{ $peserta->jalur ?? '-' }}</td>
                        <td class="border px-3 py-2">
                            <div class="flex flex-wrap gap-1">
                                @php
                                    $kosong = [];
                                    foreach($fieldWajib as $field) {
                                        if(empty($peserta->$field)) {
                                            $kosong[] = ucfirst(str_replace('_',' ',$field));
                                        }
                                    }
                                @endphp
                                @if(count($kosong) > 0)
                                    @foreach($kosong as $field)
                                        <span class="bg-red-500 text-white text-xs px-2 py-1 rounded shadow">
                                            {{ $field }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="bg-green-500 text-white text-xs px-2 py-1 rounded shadow">Lengkap</span>
                                @endif
                            </div>
                        </td>
                        <td class="border px-3 py-2">
                            <div class="flex flex-wrap gap-1">
                                @php
                                    $kosongUpload = [];
                                    foreach($uploadWajib as $field) {
                                        if(empty($peserta->$field)) {
                                            $kosongUpload[] = strtoupper(str_replace(['dokumen_','_'],' ',$field));
                                        }
                                    }
                                @endphp
                                @if(count($kosongUpload) > 0)
                                    @foreach($kosongUpload as $field)
                                        <span class="bg-red-600 text-white text-xs px-2 py-1 rounded shadow">
                                            {{ $field }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="bg-green-500 text-white text-xs px-2 py-1 rounded shadow">Lengkap</span>
                                @endif
                            </div>
                        </td>
                        <td class="border px-3 py-2 text-center">
                            @if($peserta->status_paid == 1)
                                <span class="text-green-600 font-bold">✔</span>
                            @else
                                <span class="text-red-600 font-bold">✘</span>
                            @endif
                        </td>
                        <td class="border px-3 py-2 text-center">
                            @if($peserta->status_pembayaran_registrasi == 1)
                                <span class="text-green-600 font-bold">✔</span>
                            @else
                                <span class="text-red-600 font-bold">✘</span>
                            @endif
                        </td>
                        <td class="border px-3 py-2">
                            <button onclick="openModal({{ $peserta->id }})"
                                class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                Lihat
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center py-4">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pesertaList->withQueryString()->links() }}
    </div>
</div>

<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[9999]">
    <div class="bg-white w-3/4 max-h-[90vh] overflow-y-auto rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Detail Peserta</h2>
            <button onclick="closeModal()" class="text-gray-600">✖</button>
        </div>
        <div id="modalContent"></div>
    </div>
</div>

<script>
const baseUrl = window.location.origin;

window.openModal = async function(id) {
    const modalContent = document.getElementById('modalContent');
    const modal = document.getElementById('detailModal');
    modalContent.innerHTML = `<div class="text-center py-6 text-gray-500">Memuat data...</div>`;
    modal.classList.remove('hidden');
    try {
        const res = await fetch(`${baseUrl}/api/pesertaku/${id}`, {
            headers: {"X-Requested-With": "XMLHttpRequest"}
        });
        if (!res.ok) throw new Error(`HTTP error! Status: ${res.status}`);
        const html = await res.text();
        modalContent.innerHTML = html;
    } catch (err) {
        modalContent.innerHTML = `<div class="text-center py-6 text-red-600">Gagal memuat data peserta.<br><small>${err.message}</small></div>`;
    }
}

window.closeModal = function() {
    document.getElementById('detailModal').classList.add('hidden');
}
</script>
@endsection
