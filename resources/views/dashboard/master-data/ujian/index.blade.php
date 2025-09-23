@extends('dashboard.template')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold text-gray-800">Master Ujian</h1>
        <a href="{{ route('master.ujian.add') }}" 
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow">
            + Tambah Ujian
        </a>
    </div>

  
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


    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase">No</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase">Nama Ujian</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($ujian as $index => $item)
                    <tr>
                        <td class="px-6 py-4">{{ $loop->iteration + ($ujian->currentPage() - 1) * $ujian->perPage() }}</td>
                        <td class="px-6 py-4">{{ $item->nama }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('master.ujian.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                            <form action="{{ route('master.ujian.delete', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus ujian ini?')" 
                                        class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">Belum ada data ujian</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $ujian->links() }}
    </div>
</div>
@endsection
