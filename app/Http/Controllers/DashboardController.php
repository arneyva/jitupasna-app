<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    // public function index()
    // {

    //     return view('layouts.dashboard');
    // }
    public function index()
    {
        // Mendapatkan tanggal awal dan akhir tahun ini
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        // Mengambil data bencana dengan kategori bencana
        $bencanaData = Bencana::with(['kerugian', 'kerusakan', 'kategori_bencana'])
            ->whereBetween('tgl_mulai', [$startOfYear, $endOfYear])
            ->get();

        // Mengelompokkan bencana berdasarkan kategori
        $groupedByCategory = $bencanaData->groupBy(function ($item) {
            return $item->kategori_bencana->nama;
        });

        // Menyiapkan data untuk laporan
        $reportData = $groupedByCategory->map(function ($bencanas, $kategori) {
            // Menghitung jumlah kejadian dalam setahun
            $kejadianDalamSetahun = $bencanas->count();

            // Menghitung estimasi kebutuhan total
            $estimasiKebutuhanTotal = $bencanas->flatMap(function ($bencana) {
                return $bencana->kerugian->pluck('nilai_ekonomi')
                    ->merge($bencana->kerusakan->pluck('BiayaKeseluruhan'));
            })->sum();

            return [
                'kategori' => $kategori,
                'kejadian_dalam_setahun' => $kejadianDalamSetahun,
                'estimasi_kebutuhan_total' => $estimasiKebutuhanTotal,
            ];
        });

        return view('layouts.dashboard', compact('reportData'));
    }
}
