@extends('dashboard-unit.template')
@section('content')

<div class="bg-white p-6 shadow rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">User & Password</h1>

    <div class="flex justify-between items-center mb-4">
        <form method="GET" action="{{ url()->current() }}" class="flex gap-2 items-center">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari nama atau no pendaftaran"
                   class="border px-3 py-2 rounded-lg w-64">
            <button type="submit" 
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Cari
            </button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2">#</th>
                    <th class="border px-3 py-2">Full Name</th>
                    <th class="border px-3 py-2">Jurusan</th>
                    <th class="border px-3 py-2">Username/VA</th>
                    <th class="border px-3 py-2">Password</th>
                    <th class="border px-3 py-2">Group</th>
                    <th class="border px-3 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $i => $u)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-3 py-2 text-center">
                            {{ ($users->currentPage()-1)*$users->perPage() + $i + 1 }}
                        </td>
                        <td class="border px-3 py-2">{{ $u->nama }}</td>
                        <td class="border px-3 py-2">{{ $u->peserta->prodi ?? '-' }}</td>
                        <td class="border px-3 py-2">{{ $u->username }}</td>
                        <td class="border px-3 py-2">{{ $u->plain_password }}</td>
                        <td class="border px-3 py-2">{{ ucfirst($u->role) }}</td>
                        <td class="border px-3 py-2 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('users.edit1', ['role' => $role, 'id' => $u->id]) }}"
                                   class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs">
                                    Edit
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-gray-500">Tidak ada data pengguna</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $users->appends(['search' => request('search')])->links() }}
        </div>
    </div>
</div>

@endsection
