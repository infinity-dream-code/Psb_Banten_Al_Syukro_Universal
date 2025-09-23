@extends('dashboard.template')
@section('content')

<div class="p-4 lg:p-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6 lg:mb-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="w-14 h-14 lg:w-16 lg:h-16 bg-green-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                    <i class="fas fa-users text-white text-xl lg:text-2xl"></i>
                </div>
             <div class="flex-1 min-w-0">
    <div class="flex items-center mb-1">
        <span class="text-2xl lg:text-3xl font-bold text-gray-800">
            {{ $stats['total_pendaftar'] }}
        </span>
        <span class="ml-2 text-green-500 text-xs lg:text-sm font-medium">100%</span>
    </div>
    <p class="text-gray-600 text-xs lg:text-sm leading-tight">Total Mahasiswa Mendaftar</p>
    @if($activeGelombang)
        <p class="text-xs text-blue-600">Gelombang {{ $activeGelombang->gelombang }}</p>
    @endif
</div>

            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="w-14 h-14 lg:w-16 lg:h-16 bg-green-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                    <i class="fas fa-money-bill-wave text-white text-xl lg:text-2xl"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center mb-1">
                        <span class="text-2xl lg:text-3xl font-bold text-gray-800">{{ $stats['total_bayar'] }}</span>
                        <span class="ml-2 text-green-500 text-xs lg:text-sm font-medium">+{{ $stats['percent_bayar'] }}%</span>
                    </div>
                    <p class="text-gray-600 text-xs lg:text-sm leading-tight">Total Membayar Pendaftaran</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="w-14 h-14 lg:w-16 lg:h-16 bg-green-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                    <i class="fas fa-user text-white text-xl lg:text-2xl"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center mb-1">
                        <span class="text-2xl lg:text-3xl font-bold text-gray-800">{{ $stats['total_lulus'] }}</span>
                        <div class="flex items-center ml-2">
                            @if($stats['percent_lulus'] > 0)
                                <span class="text-green-500 text-xs lg:text-sm font-medium">+{{ $stats['percent_lulus'] }}%</span>
                                <i class="fas fa-arrow-up text-green-500 text-xs ml-1"></i>
                            @else
                                <span class="text-gray-400 text-xs lg:text-sm font-medium">0%</span>
                                <i class="fas fa-arrow-down text-red-500 text-xs ml-1"></i>
                            @endif
                        </div>
                    </div>
                    <p class="text-gray-600 text-xs lg:text-sm leading-tight">Total Mahasiswa di Nyatakan Lulus</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="w-14 h-14 lg:w-16 lg:h-16 bg-green-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-white text-xl lg:text-2xl"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center mb-1">
                        <span class="text-2xl lg:text-3xl font-bold text-gray-800">{{ $stats['total_registrasi'] }}</span>
                        <span class="ml-2 text-gray-400 text-xs lg:text-sm font-medium">{{ $stats['percent_registrasi'] }}%</span>
                    </div>
                    <p class="text-gray-600 text-xs lg:text-sm leading-tight">Total Mahasiswa Registrasi</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 lg:p-6 mt-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2 lg:mb-0">
                Jumlah Pendaftar dan Pembayaran Tahun {{ date('Y') }}
            </h3>
            <div class="flex items-center space-x-4 text-sm">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-green-500 rounded mr-2"></div>
                    <span class="text-gray-600">Pendaftar</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-blue-500 rounded mr-2"></div>
                    <span class="text-gray-600">Bayar</span>
                </div>
            </div>
        </div>
        <div class="relative h-72 lg:h-96">
            <canvas id="monthlyChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctxMonthly = document.getElementById('monthlyChart').getContext('2d');
    const monthlyChart = {!! json_encode($monthlyChart) !!};

    new Chart(ctxMonthly, {
        type: 'bar',
        data: {
            labels: monthlyChart.labels,
            datasets: [
                {
                    label: 'Pendaftar',
                    data: monthlyChart.pendaftar,
                    backgroundColor: 'rgba(16, 185, 129, 0.7)',
                    borderRadius: 4
                },
                {
                    label: 'Bayar',
                    data: monthlyChart.bayar,
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    stacked: false,
                    grid: { display: false }
                },
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 5, precision: 0 }
                }
            },
            plugins: {
                legend: { position: 'top' }
            }
        }
    });
});
</script>

@endsection
