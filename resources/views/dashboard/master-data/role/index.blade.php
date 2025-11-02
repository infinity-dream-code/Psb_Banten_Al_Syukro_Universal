@extends('dashboard.template')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold text-gray-800">Master Role</h1>
        <a href="{{ route('master.role.add') }}" 
           class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
            <i class="fas fa-plus mr-2"></i> Tambah Role
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
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Menu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($roles as $key => $r)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ strtoupper($r->nama_role) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            @if(is_array($r->menu))
                                {{ implode(', ', $r->menu) }}
                            @else
                                {{ $r->menu }}
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('master.role.edit', $r->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('master.role.delete', $r->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin hapus role ini?')" 
                                        class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data role</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
