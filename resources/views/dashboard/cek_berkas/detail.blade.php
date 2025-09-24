
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            {{-- Header --}}
            <div class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold text-gray-800">Data Calon Siswa</h1>
               
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- Kolom Kiri - Data Utama --}}
                    <div class="lg:col-span-2">
                        {{-- Nama dan NIS --}}
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-bold text-gray-600 uppercase tracking-wide mb-2">
                                {{ $peserta->nama_peserta }}
                            </h2>
                            <h3 class="text-3xl font-bold text-gray-800 mb-1">
                                {{ $peserta->no_pendaftaran }}
                            </h3>
                            <span class="text-gray-500 text-sm">(Jalur {{ $peserta->jalur ?? 'Panti' }})</span>
                        </div>

                        {{-- Informasi Kontak --}}
                        <div class="mb-6">
                            <h4 class="text-lg font-semibold text-blue-600 mb-3">Email, Telpon</h4>
                            <div class="text-blue-600 hover:text-blue-800">
                                <a href="tel:{{ $peserta->no_hp }}" class="underline">
                                    {{ $peserta->no_hp ?? '-' }}
                                </a>
                            </div>
                        </div>

                        {{-- Informasi Sekolah --}}
                        <div class="mb-6">
                            <h4 class="text-lg font-semibold text-gray-800 mb-3">Pilihan Sekolah</h4>
                            <div class="space-y-2">
                                <p><span class="font-medium">Pilihan :</span></p>
                                <p class="ml-4">{{ $peserta->fakultas ?? 'MAS AL-FALAH KURIKULUM MERDEKA' }}</p>
                                <p class="mt-3"><span class="font-medium">Program :</span></p>
                                <p class="ml-4">{{ $peserta->prodi ?? '-' }}</p>
                            </div>
                        </div>

                        {{-- Tabel Detail Data --}}
                        <div class="overflow-x-auto">
                            <table class="w-full border border-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="border border-gray-300 px-3 py-2 text-left font-medium text-gray-700 w-12">No</th>
                                        <th class="border border-gray-300 px-3 py-2 text-left font-medium text-gray-700 w-32">Isian</th>
                                        <th class="border border-gray-300 px-3 py-2 text-left font-medium text-gray-700">Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-3 py-2">1</td>
                                        <td class="border border-gray-300 px-3 py-2 font-medium">No KTP</td>
                                        <td class="border border-gray-300 px-3 py-2">{{ $peserta->nik ?? '-' }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-3 py-2">2</td>
                                        <td class="border border-gray-300 px-3 py-2 font-medium">No KK</td>
                                        <td class="border border-gray-300 px-3 py-2">{{ $peserta->no_kk ?? '-' }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-3 py-2">3</td>
                                        <td class="border border-gray-300 px-3 py-2 font-medium">Tempat Lahir</td>
                                        <td class="border border-gray-300 px-3 py-2">{{ $peserta->tempat_lahir ?? '-' }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-3 py-2">4</td>
                                        <td class="border border-gray-300 px-3 py-2 font-medium">Tanggal Lahir</td>
                                        <td class="border border-gray-300 px-3 py-2">{{ $peserta->tanggal_lahir ? date('Y-m-d', strtotime($peserta->tanggal_lahir)) : '2009-06-14' }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-3 py-2">5</td>
                                        <td class="border border-gray-300 px-3 py-2 font-medium">Agama</td>
                                        <td class="border border-gray-300 px-3 py-2">{{ $peserta->agama ?? '-' }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-3 py-2">6</td>
                                        <td class="border border-gray-300 px-3 py-2 font-medium">Gender</td>
                                        <td class="border border-gray-300 px-3 py-2">{{ $peserta->gender ?? '-' }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-3 py-2">7</td>
                                        <td class="border border-gray-300 px-3 py-2 font-medium">Kewarganegaraan</td>
                                        <td class="border border-gray-300 px-3 py-2">{{ $peserta->kewarganegaraan ?? '-' }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-3 py-2">8</td>
                                        <td class="border border-gray-300 px-3 py-2 font-medium">Alamat Pendaftar</td>
                                        <td class="border border-gray-300 px-3 py-2">{{ $peserta->alamat_lengkap ?? '-' }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-3 py-2">9</td>
                                        <td class="border border-gray-300 px-3 py-2 font-medium">Kota</td>
                                        <td class="border border-gray-300 px-3 py-2">{{ $peserta->kabupaten ?? '-' }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-3 py-2">10</td>
                                        <td class="border border-gray-300 px-3 py-2 font-medium">Kecamatan</td>
                                        <td class="border border-gray-300 px-3 py-2">{{ $peserta->kecamatan ?? '-' }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-3 py-2">11</td>
                                        <td class="border border-gray-300 px-3 py-2 font-medium">Kode Pos</td>
                                        <td class="border border-gray-300 px-3 py-2">{{ $peserta->kode_pos ?? '-' }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-3 py-2">12</td>
                                        <td class="border border-gray-300 px-3 py-2 font-medium">Data Ibu</td>
                                        <td class="border border-gray-300 px-3 py-2">
                                            <div class="space-y-1">
                                                <div>{{ $peserta->ibu_nama ?? '-' }}</div>
                                                <div>{{ $peserta->ibu_alamat ?? '-' }}</div>
                                                <div>{{ $peserta->ibu_no_tlp ?? '-' }}</div>
                                                <div>{{ $peserta->ibu_pekerjaan ?? '-' }}</div>
                                                <div>{{ $peserta->ibu_penghasilan ?? '-' }}</div>
                                                <div>{{ $peserta->ibu_pendidikan ?? '-' }}</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-3 py-2">13</td>
                                        <td class="border border-gray-300 px-3 py-2 font-medium">Data Ayah</td>
                                        <td class="border border-gray-300 px-3 py-2">
                                            <div class="space-y-1">
                                                <div>{{ $peserta->ayah_nama ?? '-' }}</div>
                                                <div>{{ $peserta->ayah_alamat ?? '-' }}</div>
                                                <div>{{ $peserta->ayah_no_tlp ?? '-' }}</div>
                                                <div>{{ $peserta->ayah_pekerjaan ?? '-' }}</div>
                                                <div>{{ $peserta->ayah_penghasilan ?? '-' }}</div>
                                                <div>{{ $peserta->ayah_pendidikan ?? '-' }}</div>
                                            </div>
                                        </td>
                                    </tr>
                              <tr class="hover:bg-gray-50">
    <td class="border border-gray-300 px-3 py-2">14</td>
    <td class="border border-gray-300 px-3 py-2 font-medium">Upload KTP</td>
    <td class="border border-gray-300 px-3 py-2">
        @if($peserta->dokumen_ktp_ortu)
            <a href="{{ asset(\Storage::url($peserta->dokumen_ktp_ortu)) }}" 
               download="ktp-{{ \Str::slug($peserta->nama_peserta, '-') }}-{{ $peserta->no_pendaftaran }}.{{ pathinfo($peserta->dokumen_ktp_ortu, PATHINFO_EXTENSION) }}"
               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm inline-flex items-center gap-1 transition-colors">
                <i class="fas fa-download"></i>
                Download
            </a>
        @else
            <span class="text-gray-500 text-sm">Tidak ada file</span>
        @endif
    </td>
</tr>


<tr class="hover:bg-gray-50">
    <td class="border border-gray-300 px-3 py-2">15</td>
    <td class="border border-gray-300 px-3 py-2 font-medium">Upload KK</td>
    <td class="border border-gray-300 px-3 py-2">
        @if($peserta->dokumen_kk)
            <a href="{{ asset(\Storage::url($peserta->dokumen_kk)) }}" 
               download="kk-{{ \Str::slug($peserta->nama_peserta, '-') }}-{{ $peserta->no_pendaftaran }}.{{ pathinfo($peserta->dokumen_kk, PATHINFO_EXTENSION) }}"
               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm inline-flex items-center gap-1 transition-colors">
                <i class="fas fa-download"></i>
                Download
            </a>
        @else
            <span class="text-gray-500 text-sm">Tidak ada file</span>
        @endif
    </td>
</tr>

<tr class="hover:bg-gray-50">
    <td class="border border-gray-300 px-3 py-2">16</td>
    <td class="border border-gray-300 px-3 py-2 font-medium">Upload AKTE</td>
    <td class="border border-gray-300 px-3 py-2">
        @if($peserta->dokumen_akte_kelahiran)
            <a href="{{ asset(\Storage::url($peserta->dokumen_akte_kelahiran)) }}" 
               download="akte-{{ \Str::slug($peserta->nama_peserta, '-') }}-{{ $peserta->no_pendaftaran }}.{{ pathinfo($peserta->dokumen_akte_kelahiran, PATHINFO_EXTENSION) }}"
               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm inline-flex items-center gap-1 transition-colors">
                <i class="fas fa-download"></i>
                Download
            </a>
        @else
            <span class="text-gray-500 text-sm">Tidak ada file</span>
        @endif
    </td>
</tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Kolom Kanan - Photo dan Status --}}
                    <div class="lg:col-span-1">
                        <div class="text-center">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4">Photo Siswa</h4>
                            
                            {{-- Foto Siswa --}}
                            <div class="mb-6 flex justify-center">
                                @if($peserta->foto)
                                  <img src="{{ asset(Storage::url($peserta->foto)) }}" 
     alt="Foto {{ $peserta->nama_peserta }}" 
     class="w-48 h-60 object-cover rounded border-2 border-gray-300 shadow-sm">

                                @else
                                    <div class="w-48 h-60 bg-gray-100 rounded border-2 border-gray-300 flex items-center justify-center">
                                        <i class="fas fa-user text-6xl text-gray-400"></i>
                                    </div>
                                @endif
                            </div>
                            
                            {{-- Status Kelengkapan --}}
                            <div class="mb-6">
                                <h5 class="font-semibold text-gray-800 mb-3">Status Kelengkapan Dokumen</h5>
                                <div class="space-y-2 text-left">
                                    <div class="flex items-center gap-2">
                                        <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-white {{ $peserta->foto ? 'bg-green-500' : 'bg-red-500' }}">
                                            {{ $peserta->foto ? '✓' : '✗' }}
                                        </span>
                                        <span class="text-sm">Foto</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-white {{ $peserta->dokumen_kk ? 'bg-green-500' : 'bg-red-500' }}">
                                            {{ $peserta->dokumen_kk ? '✓' : '✗' }}
                                        </span>
                                        <span class="text-sm">Kartu Keluarga</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-white {{ $peserta->dokumen_ktp_ortu ? 'bg-green-500' : 'bg-red-500' }}">
                                            {{ $peserta->dokumen_ktp_ortu ? '✓' : '✗' }}
                                        </span>
                                        <span class="text-sm">KTP Orang Tua</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-white {{ $peserta->dokumen_akte_kelahiran ? 'bg-green-500' : 'bg-red-500' }}">
                                            {{ $peserta->dokumen_akte_kelahiran ? '✓' : '✗' }}
                                        </span>
                                        <span class="text-sm">Akta Kelahiran</span>
                                    </div>
                                </div>
                            </div>

                        
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>

    {{-- Print Styles --}}
    <style>
    @media print {
        .no-print, button {
            display: none !important;
        }
        
        body {
            background: white;
            font-size: 12px;
        }
        
        .shadow-lg {
            box-shadow: none !important;
        }
        
        table {
            font-size: 11px;
        }
        
        .container {
            max-width: none;
            padding: 0;
        }
    }
    </style>
