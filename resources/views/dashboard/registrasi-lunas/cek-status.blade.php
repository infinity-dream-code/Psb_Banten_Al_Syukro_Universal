@extends('dashboard.template')

@section('content')
<div class="bg-white p-6 shadow rounded-lg">
    @if (session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 border border-green-400 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-400 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold">Cek Status Registrasi</h1>
    </div>

    <div class="mb-4 flex flex-wrap gap-2 items-center">
        <form method="GET" action="{{ url()->current() }}" class="flex flex-wrap gap-2 items-center" id="filterForm">
            <select name="tahun_akademik" class="px-3 py-2 border rounded-lg" onchange="this.form.submit()">
                <option value="">--Pilih Tahun Akademik--</option>
                @foreach($tahunList as $th)
                    <option value="{{ $th->tahun_akademik }}" {{ request('tahun_akademik') == $th->tahun_akademik ? 'selected' : '' }}>
                        {{ $th->tahun_akademik }}
                    </option>
                @endforeach
            </select>

            <select name="gelombang_id" class="px-3 py-2 border rounded-lg" onchange="this.form.submit()">
                <option value="">--Pilih Gelombang--</option>
                @foreach($gelombangList as $gel)
                    <option value="{{ $gel->id }}" {{ request('gelombang_id') == $gel->id ? 'selected' : '' }}>
                        Gelombang {{ $gel->gelombang }} ({{ \Carbon\Carbon::parse($gel->start)->format('d M Y') }} -
                        {{ \Carbon\Carbon::parse($gel->end)->format('d M Y') }})
                    </option>
                @endforeach
            </select>

            <div class="relative">
                <input type="text" id="liveSearchInput" value="{{ request('search') }}"
                    class="w-64 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Cari nama, VA, prodi, fakultas...">
                <input type="hidden" name="search" id="searchHidden">
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Cari</button>
        </form>

        <form id="cekStatusForm" action="{{ route('registrasi.cekStatus') }}" method="POST" class="ml-auto">
            @csrf
            <input type="hidden" name="no_pendaftaran" id="selectedNoPendaftaran">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Cek Status</button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 text-sm" id="pesertaTable">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="border px-3 py-2">#</th>
                    <th class="border px-3 py-2">Nama</th>
                    <th class="border px-3 py-2">No. Pend (VA)</th>
                    <th class="border px-3 py-2">Sekolah</th>
                    <th class="border px-3 py-2">Jurusan</th>
                    <th class="border px-3 py-2">Jalur</th>
                    <th class="border px-3 py-2">Status Daful</th>
                    <th class="border px-3 py-2"><input type="checkbox" id="checkAll"></th>
                </tr>
            </thead>
            <tbody id="pesertaTbody">
                @forelse($pesertaList as $i => $peserta)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-3 py-2">{{ $pesertaList->firstItem() + $i }}</td>
                        <td class="border px-3 py-2" data-col="nama">{{ $peserta->nama_peserta }}</td>
                        <td class="border px-3 py-2" data-col="va">{{ $peserta->no_pendaftaran ?? '-' }}</td>
                        <td class="border px-3 py-2" data-col="fak">{{ $peserta->fakultas ?? '-' }}</td>
                        <td class="border px-3 py-2" data-col="prodi">{{ $peserta->prodi ?? '-' }}</td>
                        <td class="border px-3 py-2" data-col="jalur">{{ $peserta->jalur ?? '-' }}</td>
                        <td class="border px-3 py-2 text-center">
                            @if($peserta->status_pembayaran_registrasi == 1)
                                <span class="text-green-600 font-bold">✔</span>
                            @else
                                <span class="text-red-600 font-bold">✘</span>
                            @endif
                        </td>
                        <td class="border px-3 py-2 text-center">
                            <input type="checkbox" class="checkItem" value="{{ $peserta->no_pendaftaran }}">
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

    <div class="mt-4" id="paginationWrap">
        {{ $pesertaList->links() }}
    </div>
</div>

<script>
    const input = document.getElementById('liveSearchInput');
    const tbody = document.getElementById('pesertaTbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const searchHidden = document.getElementById('searchHidden');

    function normalize(s){
        return (s || '').toString().toLowerCase().normalize('NFKD').replace(/[\u0300-\u036f]/g, '');
    }

    function matchRow(tr, q){
        if (!q) return true;
        const cols = [
            tr.querySelector('[data-col="nama"]')?.textContent,
            tr.querySelector('[data-col="va"]')?.textContent,
            tr.querySelector('[data-col="fak"]')?.textContent,
            tr.querySelector('[data-col="prodi"]')?.textContent,
            tr.querySelector('[data-col="jalur"]')?.textContent
        ].map(normalize).join(' ');
        return cols.includes(q);
    }

    let debounceTimer;
    input.addEventListener('input', function(){
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            const q = normalize(input.value.trim());
            rows.forEach(tr => {
                tr.style.display = matchRow(tr, q) ? '' : 'none';
            });
            searchHidden.value = input.value;
        }, 150);
    });

    input.addEventListener('keydown', function(e){
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('filterForm').submit();
        }
    });

    document.getElementById('checkAll').addEventListener('change', function() {
        document.querySelectorAll('.checkItem').forEach(cb => {
            if (cb.closest('tr').style.display !== 'none') cb.checked = this.checked;
        });
    });

    document.getElementById('cekStatusForm').addEventListener('submit', function(e) {
        const selected = [];
        document.querySelectorAll('.checkItem:checked').forEach(cb => {
            if (cb.closest('tr').style.display !== 'none') selected.push(cb.value);
        });
        if (selected.length === 0) {
            e.preventDefault();
            alert('Pilih minimal satu peserta terlebih dahulu');
            return;
        }
        document.getElementById('selectedNoPendaftaran').value = JSON.stringify(selected);
    });
</script>
@endsection
