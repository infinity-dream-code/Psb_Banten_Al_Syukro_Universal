@extends('dashboard.template')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold text-gray-800">Tahun Akademik</h1>
        <a href="{{ url('/PmbMstPendaftarans/master-tahun-akademik/add') }}" 
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow">
            + Tambah Tahun Akademik
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Tahun Akademik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Tahun Mulai</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Tahun Selesai</th>
  
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($akademik as $index => $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $loop->iteration + ($akademik->currentPage() - 1) * $akademik->perPage() }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->tahun_akademik ?? '-' }}
                        </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->tahun_mulai ?? '-' }}
                        </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->tahun_selesai ?? '-' }}
                        </td>
                      
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                            Data belum tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $akademik->links() }}
    </div>
</div>
@endsection
