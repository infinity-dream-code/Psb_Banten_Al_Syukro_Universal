@extends('dashboard.template')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-900">Setting PMB</h1>
        </div>
        <div class="border-b border-gray-200">
            <nav class="flex space-x-8 px-6 overflow-x-auto" aria-label="Tabs">
                <button class="tab-btn border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap" data-tab="gelombang">Gelombang PMB</button>
                <button class="tab-btn border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap" data-tab="master-harga">Master Harga</button>
                <button class="tab-btn border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap" data-tab="on-off">On/Off Pendaftaran</button>
            </nav>
        </div>
        <div class="p-6">
            <div id="gelombang" class="tab-content hidden opacity-0 transition-opacity duration-300">
                <h3 class="text-lg font-semibold mb-4">Set Gelombang Pendaftaran</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gelombang</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tahun Akademik</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pengumuman</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aktifkan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($gelombangs as $i => $g)
                            <tr class="{{ $i % 2 == 0 ? 'bg-gray-50' : '' }}">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $i+1 }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $g->tahun }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">Gelombang {{ $g->gelombang }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $g->pengumuman->format('d-m-Y') }}</td>
                                <td class="px-6 py-4">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" {{ $g->is_active ? 'checked' : '' }} onchange="toggleGelombang({{ $g->id }})">
                                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-green-600 relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                    </label>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="master-harga" class="tab-content hidden">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Master Harga PMB</h3>
                    <a href="{{ url('PmbRefMasterHargaPendaftarans/add') }}" class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium"><i class="fas fa-plus mr-2"></i>Tambah Master Harga</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Jalur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gelombang</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sekolah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jurusan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Biaya Registrasi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Biaya Daftar Ulang</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aktif</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($masterHarga as $index => $mh)
                            <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}" data-jalur="{{ $mh->nama_jalur }}" data-prodi="{{ $mh->nama_prodi }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index+1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mh->nama_jalur }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Gelombang {{ $mh->nama_gelombang }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mh->nama_fakultas }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mh->nama_prodi }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($mh->harga_final, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($mh->harga_registrasi, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer toggle-harga" data-id="{{ $mh->id }}" {{ $mh->active ? 'checked' : '' }} onchange="toggleHargaActive({{ $mh->id }})">
                                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-green-600 relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                    </label>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('master-harga.edit', $mh->id) }}" class="text-blue-600 hover:text-blue-900"><i class="fas fa-edit"></i></a>
                                        
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="px-6 py-4 text-center text-gray-500">Belum ada data Master Harga</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="on-off" class="tab-content hidden">
                <h3 class="text-lg font-semibold mb-4">Set On/Off PMB</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aktif</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aktif/non Aktifkan pendaftaran</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($biaya as $i => $f)
                            <tr class="{{ $i % 2 == 0 ? 'bg-gray-50' : '' }}">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $i+1 }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ strtoupper($f->fakultas) }}</td>
                                <td class="px-6 py-4">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" {{ $f->aktif ? 'checked' : '' }} onchange="toggleFakultas({{ $f->id }})">
                                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-green-600 relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                    </label>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    const activeTabId = localStorage.getItem('activeTab');
    if (activeTabId) {
        showTab(activeTabId);
    } else if (tabButtons.length > 0) {
        showTab(tabButtons[0].getAttribute('data-tab'));
    }
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            showTab(tabId);
            localStorage.setItem('activeTab', tabId);
        });
    });
    function showTab(tabId) {
        tabButtons.forEach(btn => {
            btn.classList.remove('border-blue-500', 'text-blue-600');
            btn.classList.add('border-transparent', 'text-gray-500');
        });
        const activeBtn = document.querySelector(`.tab-btn[data-tab="${tabId}"]`);
        if (activeBtn) {
            activeBtn.classList.add('border-blue-500', 'text-blue-600');
            activeBtn.classList.remove('border-transparent', 'text-gray-500');
        }
        tabContents.forEach(content => {
            content.classList.add('hidden', 'opacity-0');
            content.classList.remove('opacity-100');
        });
        const activeContent = document.getElementById(tabId);
        if (activeContent) {
            activeContent.classList.remove('hidden');
            setTimeout(() => {
                activeContent.classList.add('opacity-100');
                activeContent.classList.remove('opacity-0');
            }, 50);
        }
    }
});
function toggleGelombang(id) {
    fetch("{{ url('gelombang/toggle') }}/" + id, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify({})
    })
    .then(res => res.json())
    .then(data => {
        if (!data.success) {
            alert("Update gagal!");
        }
    })
    .catch(err => console.error(err));
}
function toggleFakultas(id) {
    fetch("{{ url('fakultas/toggle') }}/" + id, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            "Accept": "application/json"
        }
    })
    .then(res => res.json())
    .then(data => {
        if(!data.success){
            alert("Update gagal!");
        }
    })
    .catch(err => console.error(err));
}
function toggleHargaActive(id) {
    const currentCheckbox = document.querySelector(`.toggle-harga[data-id="${id}"]`);
    const currentRow = currentCheckbox.closest('tr');
    const currentJalur = currentRow.getAttribute('data-jalur');
    const currentProdi = currentRow.getAttribute('data-prodi');
    const isActive = currentCheckbox.checked;
    
    fetch("{{ url('master-harga/toggle-active') }}/" + id, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            "Accept": "application/json"
        }
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            const allRows = document.querySelectorAll('tr[data-jalur][data-prodi]');
            allRows.forEach(row => {
                const jalur = row.getAttribute('data-jalur');
                const prodi = row.getAttribute('data-prodi');
                
                if (jalur === currentJalur && prodi === currentProdi) {
                    const checkbox = row.querySelector('.toggle-harga');
                    if (checkbox) {
                        checkbox.checked = isActive;
                    }
                }
            });
        } else {
            alert("Update gagal!");
            currentCheckbox.checked = !isActive;
        }
    })
    .catch(err => {
        console.error(err);
        alert("Update gagal!");
        currentCheckbox.checked = !isActive;
    });
}
</script>
@endsection
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
.form-checkbox {
    appearance: none;
    background-color: #fff;
    border: 1px solid #d1d5db;
    border-radius: 0.25rem;
    display: inline-block;
    vertical-align: middle;
    background-origin: border-box;
    user-select: none;
    flex-shrink: 0;
}
.form-checkbox:checked {
    background-color: #10b981;
    border-color: #10b981;
    background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='m13.854 3.646-7.5 7.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6 10.293l7.146-7.147a.5.5 0 0 1 .708.708z'/%3e%3c/svg%3e");
}
</style>