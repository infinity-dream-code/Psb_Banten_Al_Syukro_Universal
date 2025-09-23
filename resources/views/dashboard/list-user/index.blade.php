@extends('dashboard.template')
@section('content')

<div class="bg-white p-6 shadow rounded-lg">
    <h1 class="text-xl font-semibold mb-4">List Pendaftar</h1>

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
                    Gelombang {{ $gel->gelombang }}
                    ({{ \Carbon\Carbon::parse($gel->start)->format('d M Y') }} -
                     {{ \Carbon\Carbon::parse($gel->end)->format('d M Y') }})
                </option>
            @endforeach
        </select>

        <input type="text" name="search" value="{{ request('search') }}"
               class="w-64 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
               placeholder="Cari nama, VA, prodi, fakultas...">

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
                    <th class="border px-3 py-2">Fakultas</th>
                    <th class="border px-3 py-2">Prodi</th>
                    <th class="border px-3 py-2">Jalur</th>
                    <th class="border px-3 py-2">Bayar Pendaftaran</th>
                    <th class="border px-3 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peserta as $i => $p)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-3 py-2">{{ $peserta->firstItem() + $i }}</td>
                        <td class="border px-3 py-2">{{ $p->nama_peserta }}</td>
                        <td class="border px-3 py-2">{{ $p->no_pendaftaran ?? '-' }}</td>
                        <td class="border px-3 py-2">{{ $p->fakultas ?? '-' }}</td>
                        <td class="border px-3 py-2">{{ $p->prodi ?? '-' }}</td>
                        <td class="border px-3 py-2">{{ $p->jalur ?? '-' }}</td>
                        <td class="border px-3 py-2 text-center">
                            @if($p->status_paid == 1)
                                <span class="text-green-600 font-bold">✔</span>
                            @else
                                <span class="text-red-600 font-bold">✘</span>
                            @endif
                        </td>
                        <td class="border px-3 py-2 text-center">
                            <div class="flex justify-center gap-2">
                                <button type="button"
                                        class="lihat-btn px-3 py-1 bg-indigo-600 text-white rounded text-xs"
                                        data-id="{{ $p->id }}">
                                    Lihat
                                </button>
<a href="{{ route('detail.registrasi', base64_encode($p->no_pendaftaran)) }}"
   class="px-3 py-1 bg-purple-600 text-white rounded text-xs">Surat Registrasi</a>

<a href="{{ route('cetak.formulir', base64_encode($p->no_pendaftaran)) }}"
   class="px-3 py-1 bg-green-600 text-white rounded text-xs">Formulir</a>

<a href="{{ route('cetak.info.enroll', [$p->nama_peserta, $p->no_pendaftaran, $p->jalur]) }}"
   class="px-3 py-1 bg-gray-600 text-white rounded text-xs">Info</a>

                             <a href="{{ route('peserta.edit', $p->id) }}" 
   class="px-3 py-1 bg-yellow-500 text-white rounded text-xs">
   Edit
</a>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $peserta->withQueryString()->links() }}
    </div>
</div>

<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white w-11/12 md:w-3/4 lg:w-1/2 mx-auto my-10 p-6 rounded shadow-lg overflow-y-auto max-h-[90vh]">
        <button id="closeModal" class="text-gray-500 hover:text-gray-700 float-right">✖</button>
        <div id="modalContent" class="mt-6"></div>
    </div>
</div>

<script>
document.querySelectorAll('.lihat-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        let id = this.dataset.id;
        fetch(`/PmbMstPendaftarans/users/${id}/detail`)
            .then(res => res.text())
            .then(html => {
                document.getElementById('modalContent').innerHTML = html;
                document.getElementById('detailModal').classList.remove('hidden');
            });
    });
});
document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('detailModal').classList.add('hidden');
});
</script>

@endsection
