<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPeserta;
use App\Models\MasterGelombang;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\ImageSlider;
use App\Models\Brosur;
use App\Models\Informasi;

class DashboardController extends Controller
{

public function index1()
{
    $today = Carbon::today();
    $tahunIni = Carbon::now()->year;

    $gelombangTahunIni = MasterGelombang::where(function($q) use ($tahunIni) {
            $q->whereYear('start', $tahunIni)
              ->orWhereYear('end', $tahunIni);
        })
        ->whereDate('end', '>=', $today)
        ->orderBy('start', 'asc')
        ->get();

    $sliders = ImageSlider::orderByDesc('tanggal_upload')->get();
    $brosurs = Brosur::orderByDesc('tanggal_upload')->get();
    $informasi = Informasi::with('user')->latest()->get();

    return view('index', compact('gelombangTahunIni', 'sliders', 'brosurs', 'informasi'));
    }

    public function index()
    {
        $today = Carbon::today();

        $activeGelombang = MasterGelombang::where('start', '<=', $today)
            ->where('end', '>=', $today)
            ->where('is_active', true)
            ->first();

        if (!$activeGelombang) {
            $activeGelombang = MasterGelombang::where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->first();
        }

        $stats = $this->calculateStats($activeGelombang);
        $year = date('Y');
        $monthlyChart = $this->getMonthlyChart($year);

        return view('dashboard.index', compact('stats', 'activeGelombang', 'monthlyChart'));
    }

  private function calculateStats($gelombang)
{
    if (!$gelombang) {
        return [
            'total_pendaftar' => 0,
            'total_bayar' => 0,
            'total_lulus' => 0,
            'total_registrasi' => 0,
            'percent_bayar' => 0,
            'percent_lulus' => 0,
            'percent_registrasi' => 0
        ];
    }

    $totalPendaftar = DataPeserta::where('id_gelombang', $gelombang->id)
        ->whereYear('created_at', date('Y'))
        ->count();

    $totalBayar = DataPeserta::where('id_gelombang', $gelombang->id)
        ->whereYear('created_at', date('Y'))
        ->where('status_paid', 1)
        ->count();

    $totalLulus = DataPeserta::where('id_gelombang', $gelombang->id)
        ->whereYear('created_at', date('Y'))
        ->where('status_ujian', 'lulus')
        ->count();

    $totalRegistrasi = DataPeserta::where('id_gelombang', $gelombang->id)
        ->whereYear('created_at', date('Y'))
        ->where('status_pembayaran_registrasi', 1)
        ->count();

    $percentBayar = $totalPendaftar > 0 ? round(($totalBayar / $totalPendaftar) * 100) : 0;
    $percentLulus = $totalPendaftar > 0 ? round(($totalLulus / $totalPendaftar) * 100) : 0;
    $percentRegistrasi = $totalPendaftar > 0 ? round(($totalRegistrasi / $totalPendaftar) * 100) : 0;

    return [
        'total_pendaftar' => $totalPendaftar,
        'total_bayar' => $totalBayar,
        'total_lulus' => $totalLulus,
        'total_registrasi' => $totalRegistrasi,
        'percent_bayar' => $percentBayar,
        'percent_lulus' => $percentLulus,
        'percent_registrasi' => $percentRegistrasi
    ];
}


    private function getMonthlyChart($year)
    {
        $pendaftar = DataPeserta::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupBy('bulan')
            ->pluck('total','bulan');

        $bayar = DataPeserta::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->where('status_paid', 1)
            ->groupBy('bulan')
            ->pluck('total','bulan');

        $labels = [];
        $dataPendaftar = [];
        $dataBayar = [];

        foreach (range(1,12) as $m) {
            $labels[] = date('M', mktime(0,0,0,$m,1));
            $dataPendaftar[] = $pendaftar[$m] ?? 0;
            $dataBayar[] = $bayar[$m] ?? 0;
        }

        return [
            'labels' => $labels,
            'pendaftar' => $dataPendaftar,
            'bayar' => $dataBayar
        ];
    }
}
