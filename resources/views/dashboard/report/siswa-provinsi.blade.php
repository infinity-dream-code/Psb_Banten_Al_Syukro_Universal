@extends('dashboard.template')
@section('content')

<div class="bg-white p-6 shadow rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">
        Cama Per Provinsi Th Akademik {{ $tahunSekarang }}
    </h1>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2">#</th>
                    <th class="border px-3 py-2">Nama Provinsi</th>
                    <th class="border px-3 py-2">Tahun Akademik</th>
                    <th class="border px-3 py-2">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @forelse($rekap as $i => $r)
                    @php $total += $r->jumlah; @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="border px-3 py-2 text-center">{{ $i+1 }}</td>
                        <td class="border px-3 py-2">{{ $r->provinsi ?? '-' }}</td>
                        <td class="border px-3 py-2 text-center">{{ $tahunSekarang }}</td>
                        <td class="border px-3 py-2 text-center">{{ $r->jumlah }} Pendaftar</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-500">Tidak ada data</td>
                    </tr>
                @endforelse
                <tr class="font-semibold bg-gray-50">
                    <td colspan="3" class="border px-3 py-2 text-right">Total</td>
                    <td class="border px-3 py-2 text-center">{{ $total }} Pendaftar</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
