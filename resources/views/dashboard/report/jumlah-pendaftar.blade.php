@extends('dashboard.template')
@section('content')

<div class="bg-white p-6 shadow rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Rekap Jumlah Pendaftar</h1>

    <form method="GET" action="{{ url()->current() }}" class="mb-6 flex gap-3">
        <select name="tahun" class="px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" onchange="this.form.submit()">
            @foreach($tahunList as $t)
                <option value="{{ $t->tahun_akademik }}" {{ $tahun == $t->tahun_akademik ? 'selected' : '' }}>
                    {{ $t->tahun_akademik }}
                </option>
            @endforeach
        </select>

        <select name="gelombang_id" class="px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" onchange="this.form.submit()">
            @foreach($gelombangList as $g)
                <option value="{{ $g->id }}" {{ $gelombangId == $g->id ? 'selected' : '' }}>
                    Gelombang {{ $g->gelombang }} 
                    ({{ \Carbon\Carbon::parse($g->start)->format('d M Y') }} -
                     {{ \Carbon\Carbon::parse($g->end)->format('d M Y') }})
                </option>
            @endforeach
        </select>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
            Cari
        </button>
    </form>

    <div class="mb-4 border-b">
        <nav class="flex gap-6">
            <button class="tab-btn text-sm font-medium py-2 border-b-2 border-blue-600 text-blue-600" data-tab="grafik">Grafik</button>
            <button class="tab-btn text-sm font-medium py-2 border-b-2 border-transparent text-gray-500 hover:text-blue-600" data-tab="tabel">Tabel</button>
        </nav>
    </div>

    <div id="grafik">
        <div class="max-w-4xl mx-auto">
            <canvas id="chartPendaftar" class="w-full {{ count($rekap) <= 3 ? 'h-48' : 'h-80' }}"></canvas>
        </div>
    </div>

    <div id="tabel" class="hidden">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-lg font-semibold">Data Jumlah Pendaftar Keseluruhan</h2>
            @if(count($peserta) > 0)
                @php
                    $ids = $peserta->pluck('id')->join(',');
                @endphp
                <a href="{{ url('PmbMstPendaftarans/print_lp003/'.$ids) }}" 
                   target="_blank"
                   class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Cetak
                </a>
            @endif
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-3 py-2">#</th>
                        <th class="border px-3 py-2">No Pendaftaran</th>
                        <th class="border px-3 py-2">Nama Siswa</th>
                        <th class="border px-3 py-2">No Tlp/HP</th>
                        <th class="border px-3 py-2">Asal Sekolah</th>
                        <th class="border px-3 py-2">Jurusan</th>
                        <th class="border px-3 py-2">Kota/Kab</th>
                        <th class="border px-3 py-2">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peserta as $i => $p)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-3 py-2 text-center">{{ $i+1 }}</td>
                            <td class="border px-3 py-2">{{ $p->no_pendaftaran }}</td>
                            <td class="border px-3 py-2">{{ $p->nama_peserta }}</td>
                            <td class="border px-3 py-2">{{ $p->no_hp }}</td>
                            <td class="border px-3 py-2">{{ $p->nama_sekolah }}</td>
                            <td class="border px-3 py-2">{{ $p->prodi }}</td>
                            <td class="border px-3 py-2">{{ $p->kabupaten }}</td>
                            <td class="border px-3 py-2">{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartPendaftar').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($rekap->pluck('kota')),
        datasets: [{
            label: 'Jumlah Pendaftar',
            data: @json($rekap->pluck('jumlah')),
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true, ticks: { precision:0 } } }
    }
});

document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const tab = this.dataset.tab;
        document.querySelectorAll('.tab-btn').forEach(b => {
            b.classList.remove('border-blue-600','text-blue-600');
            b.classList.add('border-transparent','text-gray-500');
        });
        this.classList.add('border-blue-600','text-blue-600');
        this.classList.remove('border-transparent','text-gray-500');
        document.getElementById('grafik').classList.add('hidden');
        document.getElementById('tabel').classList.add('hidden');
        document.getElementById(tab).classList.remove('hidden');
    });
});
</script>

@endsection

