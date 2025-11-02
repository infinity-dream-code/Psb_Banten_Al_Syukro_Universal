@extends('dashboard-unit.template')
@section('content')

<div class="bg-white p-6 shadow rounded-lg max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit User</h1>

    <form method="POST" action="{{ route('users.update1', ['role' => $role, 'id' => $user->id]) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">Fullname</label>
            <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" 
                   class="w-full border px-3 py-2 rounded-lg">
        </div>

        <div>
            <label class="block text-sm font-medium">Username</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}" 
                   class="w-full border px-3 py-2 rounded-lg">
        </div>

        <div>
            <label class="block text-sm font-medium">Password (kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="w-full border px-3 py-2 rounded-lg">
        </div>

        <div>
            <label class="block text-sm font-medium">Group</label>
            <select name="role" class="w-full border px-3 py-2 rounded-lg">
                <option value="{{ $user->role }}" selected>{{ ucfirst($user->role) }}</option>
              
                @if($user->role !== 'peserta')
                    <option value="peserta">Peserta</option>
                @endif
            </select>
        </div>

        <button type="submit" 
                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
            Simpan
        </button>
    </form>
</div>

@endsection
