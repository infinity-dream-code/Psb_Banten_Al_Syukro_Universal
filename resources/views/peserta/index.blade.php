@extends('peserta.template')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Header Timeline -->
    <div class="bg-white px-6 py-6 border-b">
        <h1 class="text-3xl text-gray-400 font-light">Timeline <span class="text-lg text-gray-400 ml-2">View your Actions</span></h1>
    </div>
    
    <!-- Timeline Content -->
    <div class="px-6 py-8">
        <div class="max-w-5xl mx-auto">
            <div class="relative">
                <!-- Vertical Timeline Line -->
                <div class="absolute left-32 top-0 bottom-0 w-0.5 bg-blue-300 hidden md:block"></div>
                <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-blue-300 md:hidden"></div>
                
                <!-- INFO Section -->
                <div class="relative flex items-start mb-16">
                    <!-- Left Side - Date & Label (Desktop) -->
                    <div class="hidden md:block w-32 text-right pr-6 flex-shrink-0">
                        <div class="text-blue-400 font-medium text-lg mb-1">INFO</div>
                        <div class="text-gray-500 text-sm">
    {{ Auth::user()->peserta->created_at->translatedFormat('j F Y') }}
</div>

                    </div>
                    
                    <!-- Center - Circle -->
                    <div class="absolute left-6 md:relative md:left-0 z-10 w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg border-4 border-white flex-shrink-0">
                        i
                    </div>
                    
                    <!-- Right Side - Content -->
                    <div class="ml-16 md:ml-8 flex-1">
                        <!-- Mobile Date & Label -->
                        <div class="block md:hidden mb-4">
                            <div class="text-blue-400 font-medium text-lg mb-1 ml-4">INFO</div>
                             <div class="text-gray-500 text-sm ml-4">
    {{ Auth::user()->peserta->created_at->translatedFormat('j F Y') }}
</div>
                        </div>
                        
                        <div class="bg-blue-500 text-white px-5 py-3 rounded-t-lg">
                            <h3 class="font-semibold text-lg">Wajib Gabung Group</h3>
                        </div>
                        <div class="bg-white p-5 border border-gray-200 rounded-b-lg shadow-sm">
                            <p class="text-gray-700 mb-4 leading-relaxed">
                                Silahkan bagi seluruh calon siswa yang telah mendaftar dapat bertanya pada link dibawah ini :
                            </p>
                            <p class="text-blue-600 font-semibold mb-4">Gabung Group disini</p>
                            <p class="text-gray-700 mb-4 leading-relaxed">
                                untuk bergabung dengan group harap install aplikasi WhatsApp terlebih dahulu.
                            </p>
                            <p class="text-red-600 font-semibold mb-4 leading-relaxed">
                                Waspada terhadap segala jenis penipuan!. Pembayaran hanya dilakukan melalui VIRTUAL AKUN yang didapat setelah melakukan pendaftaran.
                            </p>
                            <p class="text-gray-700 leading-relaxed">
                                Penipuan sering terjadi lewat chating dengan modus membayarkan biaya registrasi dan ancaman terhadap kelulusan, pembayaran registrasi hanya di trasfer pada <strong>VIRTUAL AKUN ( {{ Auth::user()->peserta->va_number }} )</strong> bukan rekening yang lain.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- STEP 1 -->
                <div class="relative flex items-start mb-16">
                    <!-- Left Side - Date & Label (Desktop) -->
                    <div class="hidden md:block w-32 text-right pr-6 flex-shrink-0">
                        <div class="text-green-500 font-medium text-lg mb-1">STEP 1</div>
                       <div class="text-gray-500 text-sm ml-4">
    {{ $peserta->tgl_bayar_daftar ? \Carbon\Carbon::parse($peserta->tgl_bayar_daftar)->translatedFormat('d F Y') : '-' }}
</div>
                    </div>
                    
                    <!-- Center - Circle -->
                    <div class="absolute left-6 md:relative md:left-0 z-10 w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white shadow-lg border-4 border-white flex-shrink-0">
                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                        </svg>
                    </div>
                    
                    <!-- Right Side - Content -->
                    <div class="ml-16 md:ml-8 flex-1">
                        <!-- Mobile Date & Label -->
                        <div class="block md:hidden mb-4">
                            <div class="text-green-500 font-medium text-lg mb-1 ml-4">STEP 1</div>
                           <div class="text-gray-500 text-sm ml-4">
    {{ $peserta->tgl_bayar_daftar ? \Carbon\Carbon::parse($peserta->tgl_bayar_daftar)->translatedFormat('d F Y') : '-' }}
</div>

                        </div>
                        
                        <div class="bg-green-500 text-white px-5 py-3 rounded-t-lg">
                            <h3 class="font-semibold text-lg">Notifikasi Pembayaran</h3>
                        </div>
                        <div class="bg-white p-5 border border-gray-200 rounded-b-lg shadow-sm">
                            <p class="text-gray-700 mb-2">Yth. <span class="text-blue-600 font-medium"> {{ Auth::user()->peserta->nama_peserta }}</span></p>
                            <p class="text-gray-700">Status Pembayaran Pendaftaranmu Berhasil.</p>
                        </div>
                    </div>
                </div>
                
                <!-- STEP 2 -->
                <div class="relative flex items-start mb-16">
                    <!-- Left Side - Date & Label (Desktop) -->
                    <div class="hidden md:block w-32 text-right pr-6 flex-shrink-0">
                        <div class="text-red-500 font-medium text-lg mb-1">STEP 2</div>
                        <div class="text-gray-500 text-sm ">1 September 2025</div>
                    </div>
                    
                    <!-- Center - Circle -->
                    <div class="absolute left-6 md:relative md:left-0 z-10 w-12 h-12 bg-red-500 rounded-full flex items-center justify-center text-white shadow-lg border-4 border-white flex-shrink-0">
                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    
                    <!-- Right Side - Content -->
                    <div class="ml-16 md:ml-8 flex-1">
                        <!-- Mobile Date & Label -->
                        <div class="block md:hidden mb-4">
                            <div class="text-red-500 font-medium text-lg mb-1 ml-4">STEP 2</div>
                            <div class="text-gray-500 text-sm ml-4">1 September 2025</div>
                        </div>
                        
                        <div class="bg-red-500 text-white px-5 py-3 rounded-t-lg">
                            <h3 class="font-semibold text-lg">Kelengkapan Info Pendaftaran</h3>
                        </div>
                        <div class="bg-white p-5 border border-gray-200 rounded-b-lg shadow-sm">
                            <p class="text-gray-700 mb-4">Lengkapilah isian berikut :</p>
                            <div class="text-gray-700 mb-4 space-y-1">
                                <div>1. Data Pribadi</div>
                                <div>2. Data Tempat Tinggal dan Orangtua</div>
                                <div>3. Data Sekolah</div>
                            </div>
                            <p class="text-gray-600 text-sm mb-1">* Lengkapilah Isian tersebut termasuk Upload File FOTO</p>
                            <p class="text-gray-600 text-sm mb-4">** Foto wajib di upload.</p>
                            <p class="text-red-600 text-sm font-semibold mb-4">Data kamu belum lengkap. Silahkan cek dan lengkapi.</p>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded text-sm font-medium transition-colors duration-200">
                                Yuk Lengkapi
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- STEP 3 -->
                <div class="relative flex items-start mb-16">
                    <!-- Left Side - Date & Label (Desktop) -->
                    <div class="hidden md:block w-32 text-right pr-6 flex-shrink-0">
                        <div class="text-red-500 font-medium text-lg mb-1">STEP 3</div>
                      <div class="text-gray-500 text-sm">
    @if($peserta?->ujian?->isNotEmpty() && $peserta->ujian->first()->tanggal)
        {{ $peserta->ujian->first()->tanggal->translatedFormat('j F Y') }}
    @else
        -
    @endif
</div>

                    </div>
                    
                    <!-- Center - Circle -->
                    <div class="absolute left-6 md:relative md:left-0 z-10 w-12 h-12 bg-red-500 rounded-full flex items-center justify-center text-white shadow-lg border-4 border-white flex-shrink-0">
                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    
                    <!-- Right Side - Content -->
                    <div class="ml-16 md:ml-8 flex-1">
                        <!-- Mobile Date & Label -->
                        <div class="block md:hidden mb-4">
                            <div class="text-red-500 font-medium text-lg mb-1 ml-4">STEP 3</div>
                         <div class="text-gray-500 text-sm ml-4">
    @if($peserta?->ujian?->isNotEmpty() && $peserta->ujian->first()?->tanggal)
        {{ $peserta->ujian->first()->tanggal->translatedFormat('j F Y') }}
    @else
        -
    @endif
</div>


                        </div>
                        
                        <div class="bg-red-500 text-white px-5 py-3 rounded-lg">
                            <h3 class="font-semibold text-lg">TES SELEKSI</h3>
                        </div>
                        @php
    $ujianTerbaru = $peserta->ujian->sortByDesc('tanggal')->first();
@endphp

@if($ujianTerbaru)
    <div class="mb-3 mt-4">
        <p class="text-gray-700 text-sm">Nomor Pendaftaran:
            <span class="font-semibold">{{ $peserta->no_pendaftaran }}</span>
        </p>
      
    </div>

    <a href="{{ route('ujian.showKartu', $peserta->no_pendaftaran) }}" 
       target="_blank"
       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-blue-700 transition">
       <i class="fas fa-id-card mr-2"></i> Cetak Kartu Ujian
    </a>
@else
    <p class="text-gray-700 italic">Menunggu jadwal ujian.</p>
@endif


                    </div>
                </div>
                
                <!-- STEP 4 -->
                <div class="relative flex items-start">
                    <!-- Left Side - Date & Label (Desktop) -->
                    <div class="hidden md:block w-32 text-right pr-6 flex-shrink-0">
                        <div class="text-red-500 font-medium text-lg mb-1">STEP 4</div>
                  <div class="text-gray-500 text-sm">
    {{ $peserta?->relasiGelombang?->pengumuman
        ? $peserta->relasiGelombang->pengumuman->translatedFormat('j F Y')
        : '-' }}
</div>



                    </div>
                    
                    <!-- Center - Circle -->
                    <div class="absolute left-6 md:relative md:left-0 z-10 w-12 h-12 bg-red-500 rounded-full flex items-center justify-center text-white shadow-lg border-4 border-white flex-shrink-0">
                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.75 2.524z"></path>
                        </svg>
                    </div>
                    
                    <!-- Right Side - Content -->
                    <div class="ml-16 md:ml-8 flex-1">
                        <!-- Mobile Date & Label -->
                        <div class="block md:hidden mb-4">
                            <div class="text-red-500 font-medium text-lg mb-1 ml-4">STEP 4</div>
                         <div class="text-gray-500 text-sm ml-4">
    {{ optional($peserta?->relasiGelombang?->pengumuman)->translatedFormat('j F Y') ?? '-' }}
</div>


                        </div>
                        
                       <div class="bg-red-500 text-white px-5 py-3 rounded-t-lg">
    <h3 class="font-semibold text-lg">Pengumuman Kelulusan</h3>
</div>
<div class="bg-white p-5 border border-gray-200 rounded-b-lg shadow-sm">
    @if($peserta && $peserta->ujian)
        @if($peserta->status_ujian == 'lulus')
            <p class="text-green-600 font-semibold">Selamat, Anda dinyatakan LULUS 🎉</p>
        @elseif($peserta->status_ujian == 'gagal')
            <p class="text-red-600 font-semibold">Maaf, Anda dinyatakan TIDAK LULUS.</p>
        @else
            <p class="text-gray-700">Menunggu Pengumuman.</p>
        @endif
    @else
        <p class="text-gray-700">Menunggu Pengumuman.</p>
    @endif
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection