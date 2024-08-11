<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\DetailKerusakan;
use App\Models\KategoriBangunan;
use App\Models\Kerusakan;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KerusakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kerusakan = Kerusakan::query()->with(['bencana', 'kategori_bangunan','detail.satuan'])->latest()->get();

        return view('kerusakan.index', [
            'kerusakan' => $kerusakan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $bencana = Bencana::where('id', $id)->first();
        $kategoriBangunan = KategoriBangunan::query()->get();
        $satuan = Satuan::query()->get();

        // dd($kategoriBangunan);
        return view('kerusakan.create', [
            'kategoribangunan' => $kategoriBangunan,
            'bencana' => $bencana,
            'satuan' => $satuan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        // dd($request->all());
        $bencana = Bencana::where('id', $id)->first();
        try {
            DB::beginTransaction();
            $kerusakanRules = $request->validate([
                'kategori_bangunan_id' => 'required',
                'kuantitas' => 'required',
                'deskripsi' => 'required',
            ]);
            $kerusakan = new Kerusakan;
            $kerusakan->bencana_id = $bencana->id;
            $kerusakan->kategori_bangunan_id = $kerusakanRules['kategori_bangunan_id'];
            $kerusakan->kuantitas = $kerusakanRules['kuantitas'];
            $kerusakan->deskripsi = $kerusakanRules['deskripsi'];
            $kerusakan->save();
            // simpan detail kerusakan
            $biayaKeseluruhan = 0;
            $details_kerusakan = [];
            foreach ($request->details as $detail) {
                $subtotal = $detail['kuantitas'] * $detail['harga'];
                $biayaKeseluruhan += $subtotal;
                $details_kerusakan[] = [
                    'kerusakan_id' => $kerusakan->id,
                    'tipe' => $detail['tipe'],
                    'nama' => $detail['nama'],
                    'kuantitas' => $detail['kuantitas'],
                    'satuan_id' => $detail['satuan_id'],
                    'harga' => $detail['harga'],
                    'created_at' => now(),
                ];
            }
            $GrandTotal = $biayaKeseluruhan * $kerusakanRules['kuantitas'];
            // dd($request->all());
            DetailKerusakan::insert($details_kerusakan); //memasukan data ke database
            // Perbarui kerusakan dengan total biaya keseluruhan
            $kerusakan->BiayaKeseluruhan = $GrandTotal;
            $kerusakan->save();
            DB::commit();

            return redirect()->route('kerusakan.index')->with('success', 'Sale created successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
