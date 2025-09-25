@extends('dashboard.template')
@section('content')

<div class="bg-white p-6 shadow rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Rekap Lunas Pendaftaran</h1>

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

    <div class="flex justify-between items-center mb-3">
        <h2 class="text-lg font-semibold">Data Peserta Lunas Pendaftaran</h2>
        @if(count($peserta) > 0)
            @php
                $ids = $peserta->pluck('id')->join(',');
            @endphp
            <a href="{{ url('PmbMstPendaftarans/print_lp004/'.$ids) }}" 
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
                    <th class="border px-3 py-2">Nama Peserta</th>
                    <th class="border px-3 py-2">Jurusan</th>
                    <th class="border px-3 py-2">Jalur</th>
                    <th class="border px-3 py-2">Tanggal</th>
                    <th class="border px-3 py-2 text-right">Biaya Registrasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peserta as $i => $p)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-3 py-2 text-center">{{ $i+1 }}</td>
                        <td class="border px-3 py-2">{{ $p->no_pendaftaran }}</td>
                        <td class="border px-3 py-2">{{ $p->nama_peserta }}</td>
                        <td class="border px-3 py-2">{{ $p->prodi }}</td>
                        <td class="border px-3 py-2">{{ $p->jalur }}</td>
                        <td class="border px-3 py-2">{{ \Carbon\Carbon::parse($p->updated_at)->format('d M Y H:i') }}</td>
                        <td class="border px-3 py-2 text-right">
                            Rp {{ number_format($p->masterHarga->harga_final ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-6 text-gray-500">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
