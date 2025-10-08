@extends('dashboard.template')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow rounded-lg p-6 mt-5">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold text-gray-700">Daftar Brosur</h3>
        <a href="{{ route('setting-brosur.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium shadow">
            + Tambah Brosur
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-600 border">
            <thead class="bg-green-600 text-white uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama User</th>
                    <th class="px-4 py-3">File Brosur</th>
                    <th class="px-4 py-3">Tanggal Upload</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($brosurs as $i => $b)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $i+1 }}</td>
                    <td class="px-4 py-3">{{ $b->user->nama ?? '-' }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ asset('storage/'.$b->brosur) }}" target="_blank" class="text-blue-600 hover:underline">
                            Lihat Brosur
                        </a>
                    </td>
                    <td class="px-4 py-3">{{ $b->tanggal_upload ? $b->tanggal_upload->format('d-m-Y H:i') : '-' }}</td>
                    <td class="px-4 py-3 text-center flex justify-center space-x-3">
                        <a href="{{ route('setting-brosur.edit', $b->id) }}" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('setting-brosur.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Hapus brosur ini?')">
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
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada brosur</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
