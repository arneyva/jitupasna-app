<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\KategoriBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bencana = Bencana::query()->latest()->paginate('3');

        return view('bencana.index', [
            'bencana' => $bencana,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriBencana = KategoriBencana::query()->get();

        return view('bencana.create', [
            'kategoribencana' => $kategoriBencana,
        ]);
    }

    public function getRef()
    {
        // Ambil data terakhir dari tabel bencana
        $last = DB::table('bencana')->latest('id')->first();

        if ($last) {
            // Ambil referensi terakhir
            $item = $last->Ref;
            // Konversi nomor terakhir menjadi integer dan tambahkan 1
            $nextNumber = intval($item) + 1;
            // Format nomor dengan nol di depan, menjadi tiga digit
            $code = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika tidak ada data, mulai dari 001
            $code = '001';
        }

        return $code;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $bencaRules = $request->validate([
                'kategori_bencana_id' => 'required',
                'lokasi' => 'required',
                'deskripsi' => 'required',
                'tgl_mulai' => 'required',
                'tgl_selesai' => 'required',
            ]);
            $bencana = Bencana::create([
                // 'user_id' => auth()->user()->id,
                'kategori_bencana_id' => $bencaRules['kategori_bencana_id'],
                'lokasi' => $bencaRules['lokasi'],
                'Ref' => $this->getRef(),
                'deskripsi' => $bencaRules['deskripsi'],
                'tgl_mulai' => $bencaRules['tgl_mulai'],
                'tgl_selesai' => $bencaRules['tgl_selesai'],
            ]);
            // dd($request->all());
            DB::commit();

            return redirect()->route('bencana.index')->with('success', 'Sale created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            // Menyimpan error ke log dan mengembalikan ke halaman sebelumnya dengan error message
            \Log::error('Error storing bencana: ' . $th->getMessage());

            return redirect()->back()->withErrors('Terjadi kesalahan, silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $bencana = Bencana::query()->where('id', $id)->with(['kerusakan'])->first();
    //     // Hitung total jumlah bangunan rusak (kuantitas)
    //     $totalKuantitas = $bencana->kerusakan->sum('kuantitas');

    //     // Hitung estimasi biaya perbaikan
    //     $totalBiayaPerbaikan = $bencana->kerusakan->detail->sum(function ($kerusakan) {
    //         return $kerusakan->kuantitas * $kerusakan->harga;
    //     });
    //     return view('bencana.show', [
    //         'bencana' => $bencana,
    //         'totalKuantitas' => $totalKuantitas,
    //         'totalBiayaPerbaikan' => $totalBiayaPerbaikan,
    //     ]);
    // }
    public function show(string $id)
    {
        $bencana = Bencana::with(['kerusakan.detail'])->findOrFail($id);

        // Hitung total jumlah kuantitas (bangunan rusak)
        $totalKuantitas = $bencana->kerusakan->sum('kuantitas');
        $totalBiayaPerbaikan = $bencana->kerusakan->sum('BiayaKeseluruhan');
        $totalKerugian = $bencana->kerugian->sum('BiayaKeseluruhan');
        $kebutuhan = $totalBiayaPerbaikan + $totalKerugian;

        // // Hitung estimasi total biaya perbaikan dari DetailKerusakan
        // $totalBiayaPerbaikan = $bencana->kerusakan->sum(function ($kerusakan) {
        //     return $kerusakan->detail->sum(function ($detail) {
        //         return $detail->kuantitas * $detail->harga ;
        //     });
        // });

        return view('bencana.show', [
            'bencana' => $bencana,
            'totalKuantitas' => $totalKuantitas,
            'totalBiayaPerbaikan' => $totalBiayaPerbaikan,
            'totalKerugian' => $totalKerugian,
            'kebutuhan' => $kebutuhan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
