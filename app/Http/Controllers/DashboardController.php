<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $tahun = request('tahun');

        $query = Mahasiswa::query();

        if ($tahun) {
            $query->whereYear('tanggal_masuk', $tahun);
        }

        // cards
        $total = (clone $query)->count();
        $laki = (clone $query)->where('sex', 'L')->count();
        $perempuan = (clone $query)->where('sex', 'P')->count();

        // tabel per prodi
        $perProdi = (clone $query)
            ->select('prodi', DB::raw('count(*) as total'))
            ->groupBy('prodi')
            ->get();

        // dropdown tahun
        $tahunList = Mahasiswa::selectRaw('YEAR(tanggal_masuk) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // mahasiswa terbaru
        $terbaru = (clone $query)
            ->latest('tanggal_masuk')
            ->take(5)
            ->get(['nama', 'nim', 'prodi']);

        // 🔥 BAR CHART & TREND
        $perTahun = Mahasiswa::selectRaw('YEAR(tanggal_masuk) as tahun, COUNT(*) as total')
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();

        $chartLabels = $perTahun->pluck('tahun');
        $chartData = $perTahun->pluck('total');

        return view('dashboard', compact(
            'total',
            'laki',
            'perempuan',
            'perProdi',
            'tahunList',
            'tahun',
            'terbaru',
            'chartLabels',
            'chartData'
        ));
    }
}
