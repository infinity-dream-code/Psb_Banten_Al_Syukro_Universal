@extends('dashboard.template')

@section('content')
<div id="image-slider" class="tab-content opacity-100 p-4">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold text-gray-700">Image Slider</h3>
   <a href="{{ route('setting-slider.create') }}"
           class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium shadow">
            <i class="fas fa-plus mr-2"></i> Tambah Slider
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-green-600 text-white uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Preview</th>
                    <th class="px-4 py-3">User</th>
                    <th class="px-4 py-3">Tanggal Upload</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($sliders as $i => $s)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3">{{ $i+1 }}</td>
                    <td class="px-4 py-3">
                        <img src="{{ asset('storage/'.$s->image) }}" class="h-16 rounded shadow">
                    </td>
                    <td class="px-4 py-3">{{ $s->user->nama ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $s->tanggal_upload ? $s->tanggal_upload->format('d-m-Y') : '-' }}</td>
                    <td class="px-4 py-3 text-center">
                         <div class="flex justify-center space-x-3">
                            <a href="{{ route('setting-slider.edit', $s->id) }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('setting-slider.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus slider ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada image slider</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
