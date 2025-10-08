@extends('dashboard.template')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow rounded-lg p-6 mt-5">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold text-gray-700">Daftar Informasi</h3>
        <a href="{{ route('informasi.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium shadow">
            + Tambah Informasi
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-600 border">
            <thead class="bg-green-600 text-white uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama User</th>
                    <th class="px-4 py-3">Informasi</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $i => $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $i+1 }}</td>
                    <td class="px-4 py-3">{{ $item->user->nama ?? '-' }}</td>
                    <td class="px-4 py-3">{{ \Illuminate\Support\Str::limit($item->informasi, 30, '...') }}</td>
                    <td class="px-4 py-3 text-center flex justify-center space-x-3">
                        <a href="{{ route('informasi.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('informasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus informasi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">Belum ada informasi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
