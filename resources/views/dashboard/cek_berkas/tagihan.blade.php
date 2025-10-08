@extends('dashboard.template')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Daftar Tagihan</h1>

    <div class="mb-4 flex gap-4 items-center">
        <div class="flex-1">
            <input 
                type="text" 
                id="searchInput" 
                placeholder="Cari berdasarkan No Pendaftaran, Nama Peserta, atau Status..." 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
        </div>
        <div class="text-sm text-gray-600">
            <span id="resultCount">{{ $tagihan->total() }}</span> data ditemukan
        </div>
    </div>

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                <tr>
                    <th class="px-4 py-3 border text-left font-semibold">No</th>
                    <th class="px-4 py-3 border text-left font-semibold">No Pendaftaran</th>
                    <th class="px-4 py-3 border text-left font-semibold">Nama Peserta</th>
                    <th class="px-4 py-3 border text-right font-semibold">Biaya Daful</th>
                    <th class="px-4 py-3 border text-center font-semibold">Status</th>
                    <th class="px-4 py-3 border text-center font-semibold">Tanggal Pembayaran</th>
                    <th class="px-4 py-3 border text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse ($tagihan as $index => $item)
                    <tr class="hover:bg-blue-50 transition-colors duration-150 border-b border-gray-200 searchable-row" 
                        data-search="{{ strtolower($item->peserta->no_pendaftaran ?? '') }} {{ strtolower($item->peserta->nama_peserta ?? '') }} {{ $item->status === 1 ? 'lunas' : 'belum bayar' }}">
                        <td class="px-4 py-3 border text-gray-700">{{ $loop->iteration + ($tagihan->currentPage()-1)*$tagihan->perPage() }}</td>
                        <td class="px-4 py-3 border text-gray-700 font-medium">{{ $item->peserta->no_pendaftaran ?? '-' }}</td>
                        <td class="px-4 py-3 border text-gray-700">{{ $item->peserta->nama_peserta ?? '-' }}</td>
<td class="px-4 py-3 border text-right">
    {{ $item->biaya_daful ? number_format($item->biaya_daful, 0, ',', '.') : '-' }}
</td>

                        <td class="px-4 py-3 border text-center">
                            @if ($item->status == 1)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Lunas
                                </span>
                            @elseif ($item->status == 0)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    Belum Bayar
                                </span>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 border text-center text-gray-700 text-sm">
                            {{ $item->tanggal_pembayaran_daful ? \Carbon\Carbon::parse($item->tanggal_pembayaran_daful)->format('d-m-Y') : '-' }}
                        </td>
                        <td class="px-4 py-3 border text-center">
                            <div class="flex gap-2 justify-center">
                                <button 
                                    class="bg-blue-600 text-white px-3 py-1.5 rounded-lg hover:bg-blue-700 transition-colors duration-150 shadow-sm hover:shadow-md btn-detail text-sm font-medium"
                                    data-detail="{{ json_encode($item->detail ?? []) }}">
                                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Detail
                                </button>
                               
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr id="emptyRow">
                        <td colspan="8" class="px-4 py-8 border text-center text-gray-500">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            Tidak ada data tagihan
                        </td>
                    </tr>
                @endforelse
                <tr id="noResultRow" class="hidden">
                    <td colspan="8" class="px-4 py-8 border text-center text-gray-500">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Tidak ada data yang cocok dengan pencarian
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $tagihan->links() }}
    </div>
</div>

<div id="detailModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center z-50 backdrop-blur-sm">
    <div class="bg-white w-11/12 md:w-2/3 lg:w-1/2 rounded-2xl shadow-2xl p-6 relative transform transition-all">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Detail Tagihan
            </h2>
            <button onclick="closeDetail()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200 rounded-lg overflow-hidden" id="detailTable">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                    <tr>
                        <th class="border border-gray-300 px-4 py-3 text-left font-semibold">Nama Biaya</th>
                        <th class="border border-gray-300 px-4 py-3 text-right font-semibold">Nominal</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="mt-6 flex justify-end">
            <button onclick="closeDetail()" class="bg-gray-600 text-white px-6 py-2.5 rounded-lg hover:bg-gray-700 transition-colors duration-150 shadow-md hover:shadow-lg font-medium">
                Tutup
            </button>
        </div>
    </div>
</div>


<script>
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tableBody');
    const resultCount = document.getElementById('resultCount');
    const noResultRow = document.getElementById('noResultRow');
    const emptyRow = document.getElementById('emptyRow');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        const rows = tableBody.querySelectorAll('.searchable-row');
        let visibleCount = 0;
        
        rows.forEach(row => {
            const searchData = row.getAttribute('data-search');
            if (searchData.includes(searchTerm)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        
        if (emptyRow) {
            emptyRow.style.display = 'none';
        }
        
        if (visibleCount === 0 && searchTerm !== '') {
            noResultRow.classList.remove('hidden');
        } else {
            noResultRow.classList.add('hidden');
        }
        
        resultCount.textContent = visibleCount;
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-detail') || e.target.closest('.btn-detail')) {
            const btn = e.target.classList.contains('btn-detail') ? e.target : e.target.closest('.btn-detail');
            const detailData = btn.getAttribute('data-detail');
            const detail = JSON.parse(detailData || '[]');
            showDetail(detail);
        }
        
      
    });

    function showDetail(detail) {
        const modal = document.getElementById('detailModal');
        const tbody = document.querySelector('#detailTable tbody');
        tbody.innerHTML = '';
        
        if (detail && Array.isArray(detail) && detail.length > 0) {
            detail.forEach((item, index) => {
                const tr = document.createElement('tr');
                tr.className = index % 2 === 0 ? 'bg-gray-50' : 'bg-white';
                tr.innerHTML = `
                    <td class="border border-gray-300 px-4 py-3 text-gray-700">${item.nama_tagihan ?? '-'}</td>
                    <td class="border border-gray-300 px-4 py-3 text-right font-semibold text-gray-800">Rp ${new Intl.NumberFormat('id-ID').format(item.nominal ?? 0)}</td>
                `;
                tbody.appendChild(tr);
            });
        } else {
            const tr = document.createElement('tr');
            tr.innerHTML = `<td colspan="2" class="border border-gray-300 px-4 py-8 text-center text-gray-500">
                <svg class="w-12 h-12 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                Tidak ada detail tagihan
            </td>`;
            tbody.appendChild(tr);
        }
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeDetail() {
        document.getElementById('detailModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    

    document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDetail();
        }
    });

   
</script>
@endsection