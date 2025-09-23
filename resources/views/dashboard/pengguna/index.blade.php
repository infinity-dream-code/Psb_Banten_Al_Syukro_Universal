@extends('dashboard.template')
@section('content')

<div class="bg-white p-6 shadow rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">User & Password</h1>

    <form method="GET" action="{{ url()->current() }}" class="mb-4 flex gap-2">
        <input type="text" name="search" value="{{ $search ?? '' }}" 
               placeholder="Cari nama atau no pendaftaran"
               class="border px-3 py-2 rounded-lg w-64">
        <button type="submit" 
                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
            Cari
        </button>
    </form>

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
                @foreach($users as $i => $u)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-3 py-2 text-center">
                            {{ ($users->currentPage()-1)*$users->perPage() + $i + 1 }}
                        </td>
                        <td class="border px-3 py-2">{{ $u->nama }}</td>
                        <td class="border px-3 py-2">{{ $u->peserta->jurusan ?? '-' }}</td>
                        <td class="border px-3 py-2">{{ $u->username }}</td>
                        <td class="border px-3 py-2">{{ $u->plain_password }}</td>
                        <td class="border px-3 py-2">{{ $u->role }}</td>
                        <td class="border px-3 py-2 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ url('PmbMstPendaftarans/users/'.$u->id.'/edit') }}"
                                   class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs">
                                    Edit
                                </a>
                                <form action="{{ url('PmbMstPendaftarans/users/'.$u->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $users->appends(['search' => $search])->links() }}
        </div>
    </div>
</div>

@endsection
