<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEMO PMB - Penerimaan Mahasiswa Baru 2025/2026</title>
    <script src="https://cdn.tailwindcss.com"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'pmb-green': {
                            50: '#f0fdf4',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        ol {
    list-style: decimal !important;
    margin-left: 1.25rem;
}


    </style>
</head>
<body class="font-sans">
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="text-3xl font-bold text-pmb-green-700">DEMO PMB</div>
                <div class="hidden md:flex space-x-8">
                   <a href="/" 
   class="no-underline text-pmb-green-700 font-semibold border-b-2 border-pmb-green-700 pb-1">
   Home
</a>

<a href="/enroll" 
   class="no-underline text-gray-600 hover:text-pmb-green-700 transition-colors">
   Pendaftaran
</a>

                </div>
             <div class="flex items-center space-x-2 text-gray-600 hover:text-pmb-green-700 transition-colors cursor-pointer">
    @if(Auth::check())
        <a href="/pages/display/home" class="no-underline flex items-center space-x-1">
            <span class="font-medium">Dashboard</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </a>
    @else
        <a href="/ServiceLogin" class="no-underline flex items-center space-x-1">
            <span class="font-medium">Masuk</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </a>
    @endif
</div>


            </div>
        </div>
    </nav>

    <main>
      <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEMO PMB - Penerimaan Mahasiswa Baru 2025/2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen">
  

    <!-- Main Hero Section -->
    <section class="bg-gradient-to-br from-green-600 via-green-700 to-green-800 min-h-screen relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-green-600/90 to-green-800/90"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 py-12 min-h-screen flex items-center">
            <div class="grid lg:grid-cols-2 gap-12 items-center w-full">
                <div class="text-white space-y-8">
                    <div>
                        <div class="text-yellow-400 text-lg font-semibold mb-4 tracking-wide">Informasi</div>
                        <h1 class="text-5xl lg:text-6xl font-bold leading-tight mb-6">
                            <span class="block">Penerimaan</span>
                            <span class="block">Mahasiswa Baru</span>
                            <span class="block text-4xl lg:text-5xl mt-2">2025/2026</span>
                        </h1>
                        <div class="text-xl text-green-100 font-medium">DEMO PMB</div>
                    </div>
                    
                   <div class="flex flex-col sm:flex-row gap-4">
    <a href="/enroll" 
       class="no-underline bg-yellow-500 hover:bg-yellow-400 text-black font-bold px-8 py-4 rounded-lg shadow-lg transform hover:scale-105 transition-all duration-300 text-center">
        Daftar Sekarang
    </a>
    <a href="/ServiceLogin" 
       class="no-underline bg-blue-500 hover:bg-blue-400 text-white font-bold px-8 py-4 rounded-lg shadow-lg transform hover:scale-105 transition-all duration-300 text-center">
        Login Pendaftar
    </a>
</div>

                </div>

                <div class="relative flex justify-center lg:justify-end">
                    <div class="relative">
                        <div class="text-center mb-8 lg:text-right">
                            <div class="text-4xl lg:text-5xl font-bold">
                                <span class="text-white">LET'S </span>
                                <span class="text-yellow-400">JOIN </span>
                                <span class="text-white">US!</span>
                            </div>
                        </div>
                        
                        <div class="relative">
                            <div class="w-80 h-80 lg:w-96 lg:h-96 bg-green-600 rounded-full relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-t from-yellow-500/20 to-transparent"></div>
                                
                                <img src="https://demo.pmb.smartpayment.co.id/images/media/hero_image_2.png" 
                                     alt="Mahasiswa DEMO PMB" 
                                     class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-80 h-auto object-contain z-10"
                                     onerror="this.style.display='none'">
                                
                                <div class="absolute top-6 left-8 text-yellow-600 animate-bounce" style="animation-delay: 0.2s;">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
                                
                                <div class="absolute top-16 right-8 text-yellow-600 animate-bounce" style="animation-delay: 0.075s;">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                
                                <div class="absolute bottom-24 left-6 text-yellow-600 animate-bounce" style="animation-delay: 0.2s;">
                                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                    </svg>
                                </div>
                                
                                <div class="absolute bottom-32 right-4 text-yellow-600 animate-bounce" style="animation-delay: 0.2s;">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      
    </section>


        <section class="bg-gray-50 py-20">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid lg:grid-cols-2 gap-16">
                    <div>
                        <div class="text-pmb-green-600 font-semibold mb-4 text-lg">Alur</div>
                        <h2 class="text-4xl font-bold text-pmb-green-800 mb-10">Pendaftaran</h2>
                        
                        <div class="space-y-8">
                            <div class="flex items-start space-x-6">
                                <div class="w-12 h-12 bg-pmb-green-600 text-white rounded-full flex items-center justify-center font-bold text-lg flex-shrink-0">1</div>
                                <div>
                                    <div class="text-gray-800 text-lg">Mendaftar melalui link: <a href="https://demo.pmb.smartpayment.co.id" class="no-underline text-pmb-green-600 hover:text-pmb-green-700" target="_blank">pmb.demo.smartpayment.co.id</a></div>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-6">
                                <div class="w-12 h-12 bg-pmb-green-600 text-white rounded-full flex items-center justify-center font-bold text-lg flex-shrink-0">2</div>
                                <div class="text-gray-800 text-lg">Melakukan pembayaran pendaftaran di virtual account</div>
                            </div>
                            
                            <div class="flex items-start space-x-6">
                                <div class="w-12 h-12 bg-pmb-green-600 text-white rounded-full flex items-center justify-center font-bold text-lg flex-shrink-0">3</div>
                                <div class="text-gray-800 text-lg">Melengkapi data diri</div>
                            </div>
                            
                            <div class="flex items-start space-x-6">
                                <div class="w-12 h-12 bg-yellow-500 text-white rounded-full flex items-center justify-center font-bold text-lg flex-shrink-0">4</div>
                                <div class="text-gray-800 text-lg">Melakukan Daftar Ulang</div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="text-pmb-green-600 font-semibold mb-4 text-lg text-right">Tanggal</div>
                        <h2 class="text-4xl font-bold text-pmb-green-800 mb-10 text-right leading-tight">
                            Penerimaan<br>Mahasiswa<br>Baru
                        </h2>
                        
                     <div class="space-y-6">
    @forelse($gelombangTahunIni as $g)
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow">
            <div class="font-bold text-gray-800 text-lg mb-2">Gelombang {{ $g->gelombang }}</div>
            <div class="text-gray-600">
                {{ \Carbon\Carbon::parse($g->start)->format('d F Y') }}
                -
                {{ \Carbon\Carbon::parse($g->end)->format('d F Y') }}
            </div>
        </div>
    @empty
        <div class="p-6 bg-yellow-100 rounded-xl text-yellow-800">
            Belum ada gelombang di tahun ini.
        </div>
    @endforelse
</div>

                    </div>
                </div>
            </div>
        </section>

      <section class="bg-pmb-green-700 py-24">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <!-- Header -->
        <div class="text-yellow-400 font-semibold mb-8 text-lg">Kenapa harus DEMO PMB?</div>
        
        <!-- Visi Section -->
        <h2 class="text-5xl font-bold text-white mb-8">Visi</h2>
        <div class="bg-white/10 rounded-2xl p-8 mb-20 max-w-4xl mx-auto border border-white/20">
            <div class="text-2xl text-white leading-relaxed font-medium">
                Menjadi Perguruan Tinggi Riset Berbasis Nilai-nilai Pesantren Tahun 2025
            </div>
        </div>
        
        <!-- Misi Section -->
        <h2 class="text-5xl font-bold text-white mb-16">Misi</h2>
        
        <div class="grid md:grid-cols-2 gap-6 text-left max-w-5xl mx-auto">
            <div class="space-y-6">
                <div class="bg-white/5 rounded-xl p-6 border border-white/10 hover:bg-white/10 transition-all duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-green-300 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-pmb-green-700" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="text-white text-lg leading-relaxed">Memperkuat transformasi keilmuan, tradisi dan moralitas</div>
                    </div>
                </div>
                
                <div class="bg-white/5 rounded-xl p-6 border border-white/10 hover:bg-white/10 transition-all duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-green-300 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-pmb-green-700" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="text-white text-lg leading-relaxed">Melaksanakan pengabdian masyarakat</div>
                    </div>
                </div>
                
                <div class="bg-white/5 rounded-xl p-6 border border-white/10 hover:bg-white/10 transition-all duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-green-300 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-pmb-green-700" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="text-white text-lg leading-relaxed">Menjadi perguruan tinggi dengan budaya tata kelola yang baik</div>
                    </div>
                </div>
            </div>
            
            <div class="space-y-6">
                <div class="bg-white/5 rounded-xl p-6 border border-white/10 hover:bg-white/10 transition-all duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-green-300 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-pmb-green-700" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7-293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="text-white text-lg leading-relaxed">Melaksanakan kegiatan pendidikan dan pembelajaran</div>
                    </div>
                </div>
                
                <div class="bg-white/5 rounded-xl p-6 border border-white/10 hover:bg-white/10 transition-all duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-green-300 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-pmb-green-700" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="text-white text-lg leading-relaxed">Melaksanakan kajian dan riset</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

        <section id="registration" class="bg-gray-50 py-20">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-pmb-green-600 font-semibold mb-4 text-lg">Syarat & ketentuan</div>
                <h2 class="text-4xl font-bold text-pmb-green-800 mb-12">Seputar Pendaftaran</h2>
                
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="flex flex-wrap border-b border-gray-200" id="tabNavigation">
                        <button onclick="showTab('syarat')" id="tab-syarat" class="px-8 py-6 bg-pmb-green-600 text-white font-semibold hover:bg-pmb-green-700 transition-colors flex-1 min-w-max">
                            Syarat Pendaftaran
                        </button>
                        <button onclick="showTab('pembayaran')" id="tab-pembayaran" class="px-8 py-6 text-gray-600 hover:bg-gray-50 transition-colors flex-1 min-w-max">
                            Petunjuk Pembayaran
                        </button>
                        <button onclick="showTab('daftar-ulang')" id="tab-daftar-ulang" class="px-8 py-6 text-gray-600 hover:bg-gray-50 transition-colors flex-1 min-w-max">
                            Persyaratan Daftar Ulang
                        </button>
                    </div>
                    
                    <div class="p-8" id="tabContent">
                        <!-- Syarat Pendaftaran -->
                        <div id="content-syarat" class="tab-content">
                            <div class="space-y-6">
                                <div class="flex items-start space-x-4">
                                    <span class="text-pmb-green-600 font-bold text-lg flex-shrink-0">1.</span>
                                    <div class="text-gray-700 text-lg">Scan foto berseragam sekolah</div>
                                </div>
                                
                                <div class="flex items-start space-x-4">
                                    <span class="text-pmb-green-600 font-bold text-lg flex-shrink-0">2.</span>
                                    <div class="text-gray-700 text-lg">Mengisi formulir pendaftaran online</div>
                                </div>
                                
                                <div class="flex items-start space-x-4">
                                    <span class="text-pmb-green-600 font-bold text-lg flex-shrink-0">3.</span>
                                    <div class="text-gray-700 text-lg">Membayar biaya pendaftaran</div>
                                </div>
                                
                                <div class="flex items-start space-x-4">
                                    <span class="text-pmb-green-600 font-bold text-lg flex-shrink-0">4.</span>
                                    <div class="text-gray-700 text-lg leading-relaxed">
                                        Transaksi ke bank Muamalat baik teller, ATM, ibanking maupun sms banking, maka transaksinya (menu yang dipilih) adalah transaksi virtual akun. 
                                        <span class="font-bold text-red-600">dibayarkan non-tunai (langsung ke nomor virtual akun)</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-start space-x-4">
                                    <span class="text-pmb-green-600 font-bold text-lg flex-shrink-0">5.</span>
                                    <div class="text-gray-700 text-lg leading-relaxed">
                                        Transaksi melalui LINTAS BANK baik teller, ATM, ibanking maupun sms banking, maka transaksinya (menu yang dipilih) adalah transfer antar bank. 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Petunjuk Pembayaran -->
                        <div id="content-pembayaran" class="tab-content hidden">
                        
                        <div class="card card-body p-4 bg-white shadow-sm rounded">
    <p class="pb-3 fw-bold fs-5">
        Pembayaran melalui Payment Point / Teller Muamalat:
    </p>
    <ol class="ps-3">
        <li class="mb-2">Tunjukkan Nomor Pendaftaran / Virtual Akun (VA) anda ke teller</li>
        <li class="mb-2">
            Isi form pembayaran 
            <span class="text-danger fw-bold">
                (jumlah nominal pembayaran sesuai dengan informasi dari sistem PMB Online)
            </span>
        </li>
        <li class="mb-2">Selesai</li>
        <li class="mb-2">Simpan bukti struk sebagai bukti pembayaran yang sah</li>
    </ol>

    <p class="pb-3 fw-bold fs-5 mt-4">Pembayaran melalui ATM Muamalat:</p>
    <ol class="ps-3">
        <li class="mb-2">Masukan PIN</li>
        <li class="mb-2">Pilih Menu "Pembayaran"</li>
        <li class="mb-2">Pilih Menu "Universitas" kemudian cari kode universitas DEMO PMB</li>
        <li class="mb-2">
            Masukan "Nomor Pendaftaran / Virtual Akun (VA)" (10–11 digit angka)
            <span class="text-danger fw-bold"> contoh: 12345678901 </span>
        </li>
        <li class="mb-2">Pilih daftar tagihan yang ingin dibayarkan (Tagihan Pendaftaran)</li>
        <li class="mb-2">Selesai</li>
        <li class="mb-2">Simpan Bukti Struk sebagai bukti pembayaran yang sah</li>
    </ol>

    <p class="pb-3 fw-bold fs-5 mt-4">
        Pembayaran melalui Jaringan ATM BERSAMA, PRIMA (BCA, Mandiri, BNI, BRI, dll):
    </p>
    <ol class="ps-3">
        <li class="mb-2">Masukan PIN</li>
        <li class="mb-2">Pilih Menu "Transaksi Lainnya"</li>
        <li class="mb-2">Pilih Menu "Transfer"</li>
        <li class="mb-2">Pilih Menu "Ke Rek Bank Lain / Antar Bank Online"</li>
        <li class="mb-2 lh-lg">
            Masukan kode transaksi 751000 + Nomor Pendaftaran  
            <span class="text-danger fw-bold"> contoh: 75100012345678901 </span>
        </li>
        <li class="mb-2">Masukan jumlah sesuai tagihan</li>
        <li class="mb-2">Selesai</li>
        <li class="mb-2">Simpan bukti struk sebagai bukti pembayaran yang sah</li>
    </ol>

    <p class="pb-3 fw-bold fs-5 mt-4">
        Pembayaran melalui Internet Banking/Mobile Banking/SMS Banking (Realtime/Online Transfer):
    </p>
    <ol class="ps-3">
        <li class="mb-2">Login ke Internet Banking</li>
        <li class="mb-2">Pilih Menu "Transfer"</li>
        <li class="mb-2">Pilih Menu "Ke Rek Bank Lain / Realtime Transfer"</li>
        <li class="mb-2">Pilih “Seluruh Channel Bank” sebagai rekening tujuan</li>
        <li class="mb-2 lh-lg">
            Masukan kode transaksi 751000 + Nomor Pendaftaran 
            <span class="text-danger fw-bold"> contoh: 75100012345678901 </span>
        </li>
        <li class="mb-2">Masukan jumlah sesuai tagihan</li>
        <li class="mb-2">Selesai</li>
        <li class="mb-2">Simpan bukti struk sebagai bukti pembayaran yang sah</li>
    </ol>
</div>


                        </div>

                        <!-- Persyaratan Daftar Ulang -->
                        <div id="content-daftar-ulang" class="tab-content hidden">
                           <div class="card card-body p-4 bg-white shadow-sm rounded">
    <p class="pb-3 fw-bold fs-5">Syarat Daftar Ulang</p>
    <ol class="ps-3">
        <li class="mb-2">
            Lulus tes seleksi dibuktikan dengan Surat Keputusan Panitia PMB
        </li>
        <li class="mb-2">
            Membawa berkas sebagai berikut :
            <ol type="a" class="ps-3 mt-2">
                <li class="mb-1">Surat Keterangan Lulus dari Panitia PMB</li>
                <li class="mb-1">Scan KTP/KK</li>
                <li class="mb-1">Scan Ijazah SMA/SMK/MA beserta Transkrip Nilai</li>
            </ol>
        </li>
    </ol>
</div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white py-20">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-pmb-green-600 font-semibold mb-4 text-lg">Testimonial</div>
                <h2 class="text-4xl font-bold text-pmb-green-800 mb-16">Pesan & Kesan</h2>
                
                <div class="grid lg:grid-cols-2 gap-12">
                    <div class="bg-gray-50 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                        <div class="text-pmb-green-500 text-6xl mb-6 leading-none">"</div>
                        <p class="text-gray-700 text-lg leading-relaxed mb-8">
                            Di DEMO PMB tidak hanya belajar ilmu agama, mengaji, dan menghafal Al-Qur'an saja, tapi juga belajar ilmu umum layaknya kampus biasa. DEMO PMB juga tempat untuk melatih mental, kedisiplinan, kemandirian, dan kreativitas kita. Di sini jugalah saya mendapatkan teman-teman yang baik dan saling mensupport, para asatidzah yang sabar dan memiliki banyak ilmu, karyawan yang ramah-tamah, dan lingkungan yang baik, kondusif untuk menghafal Al-Qur'an, dan jauh dari hiruk-pikuk duniawi. Dan suatu kebanggaan tersendiri bagi saya karena bisa menjadi mahasiswa DEMO PMB. Alhamdulillah 'alaa kulli haal.
                        </p>
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-pmb-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-pmb-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-bold text-gray-800 text-lg">Ahmad Naufal Tsani</div>
                                <div class="text-gray-600">Manager Bisnis - PT. Inti Dana Mandiri</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                        <div class="text-pmb-green-500 text-6xl mb-6 leading-none">"</div>
                        <p class="text-gray-700 text-lg leading-relaxed mb-8">
                            Sebuah pengalaman berarti bagi saya bisa mendapatkan kesempatan untuk menuntut ilmu di DEMO PMB. Ilmu akademik serta agama digali secara bersamaan dengan hafalan Al-Qur'an. Hal itu menjadi daya tarik tersendiri yang membantu saya berkembang untuk menjadi pribadi Qur'aniy dan berintelektual. Dengan banyak cerita dan pengalaman yang saya dapatkan di DEMO PMB, saya menjadi sadar bahwa ihtirom terhadap asatidz ialah kunci keberhasilan. Selain itu, DEMO PMB juga berhasil mengantarkan saya meraih impian-impian yang saya idamkan sejak dulu. Syukur Alhamdulillah, Allah telah menjadikan saya salah satu orang yang diberi kesempatan belajar di DEMO PMB, saya sangat bangga.
                        </p>
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-pmb-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-pmb-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-bold text-gray-800 text-lg">Ahmad Yusuf Farhat</div>
                                <div class="text-gray-600">DIRUT - PT. BERKAH PRIMA</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@include('footer')

    <!-- WhatsApp Floating Button -->
    <div class="fixed bottom-6 right-6 z-50">
    <a href="https://wa.me/6288233952051?text=Halo%20DEMO%20PMB,%20saya%20ingin%20bertanya%20tentang%20pendaftaran%20mahasiswa%20baru" 
       target="_blank" 
       class="bg-green-500 hover:bg-green-600 text-white w-16 h-16 flex items-center justify-center rounded-full shadow-2xl transform hover:scale-110 transition-all duration-300 animate-pulse hover:animate-none group relative">
        
        <!-- Ikon WhatsApp -->
        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.106"/>
        </svg>

        <!-- Tooltip -->
        <div class="absolute -top-12 right-0 bg-gray-800 text-white text-sm px-3 py-1 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
            Chat WhatsApp
            <div class="absolute top-full right-3 w-0 h-0 border-l-4 border-r-4 border-t-4 border-l-transparent border-r-transparent border-t-gray-800"></div>
        </div>
    </a>
</div>


    <script>
        // Tab functionality
        function showTab(tabName) {
            // Hide all tab contents
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => {
                content.classList.add('hidden');
            });
            
            // Remove active style from all tabs
            const tabs = document.querySelectorAll('#tabNavigation button');
            tabs.forEach(tab => {
                tab.classList.remove('bg-pmb-green-600', 'text-white');
                tab.classList.add('text-gray-600', 'hover:bg-gray-50');
            });
            
            // Show selected tab content
            document.getElementById(`content-${tabName}`).classList.remove('hidden');
            
            // Add active style to selected tab
            const activeTab = document.getElementById(`tab-${tabName}`);
            activeTab.classList.remove('text-gray-600', 'hover:bg-gray-50');
            activeTab.classList.add('bg-pmb-green-600', 'text-white');
        }

        // Smooth scroll function
        function scrollToSection(sectionId) {
            document.getElementById(sectionId).scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Apply animation to elements
            const animatedElements = document.querySelectorAll('section > div > *');
            animatedElements.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(el);
            });

            // Add floating animation to WhatsApp button
            const waButton = document.querySelector('.fixed.bottom-6.right-6 a');
            if (waButton) {
                setInterval(() => {
                    waButton.style.transform = 'scale(1.1)';
                    setTimeout(() => {
                        waButton.style.transform = 'scale(1)';
                    }, 200);
                }, 3000);
            }

            // Add click tracking
            document.querySelectorAll('a[href^="tel:"], a[href^="https://wa.me/"]').forEach(link => {
                link.addEventListener('click', function() {
                    console.log('Contact clicked:', this.href);
                });
            });
        });

        // Add hover effects for cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.hover\\:shadow-xl');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });

        // Mobile menu functionality (if needed)
        function toggleMobileMenu() {
            // Add mobile menu toggle functionality here if needed
            console.log('Mobile menu toggled');
        }

        // Form validation (if forms are added later)
        function validateForm(formData) {
            // Add form validation logic here
            return true;
        }

        // Scroll to top functionality
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                // Show scroll to top button if needed
            }
        });
    </script>

    <style>
        /* Custom CSS for enhanced styling */
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        /* Smooth transitions */
        * {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #15803d;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #166534;
        }

        /* Loading animation for images */
        img {
            transition: opacity 0.3s ease;
        }

        img[src=""] {
            opacity: 0;
        }

        /* Enhanced button hover effects */
        button:hover {
            transform: translateY(-1px);
        }

        /* Tab content animation */
        .tab-content {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* WhatsApp button pulse animation */
        .animate-pulse-custom {
            animation: pulse-custom 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse-custom {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: .8;
                transform: scale(1.05);
            }
        }
    </style>
</body>
</html>