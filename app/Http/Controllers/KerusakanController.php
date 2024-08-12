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
    public function index(Request $request)
    {
        $kategoriBangunan = KategoriBangunan::query()->get();
        $kerusakanQuery = Kerusakan::query()->with(['bencana', 'kategori_bangunan', 'detail.satuan'])->latest();
        if ($request->filled('kategori_bangunan_id')) {
            $kerusakanQuery->where('kategori_bangunan_id', '=', $request->input('kategori_bangunan_id'));
        }
        $kerusakan = $kerusakanQuery->paginate($request->input('limit', 5))->appends($request->except('page'));
        return view('kerusakan.index', [
            'kerusakan' => $kerusakan,
            'kategoribangunan' => $kategoriBangunan
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
                'kategori_bangunan_id' => 'nullable',
                'kuantitas' => 'nullable',
                'deskripsi' => 'nullable',
            ]);
            $kerusakan = new Kerusakan;
            $kerusakan->bencana_id = $bencana->id;
            $kerusakan->kategori_bangunan_id = $kerusakanRules['kategori_bangunan_id'];
            $kerusakan->kuantitas = $kerusakanRules['kuantitas'] ?? 1;
            $kerusakan->deskripsi = $kerusakanRules['deskripsi'];
            $kerusakan->save();
            // simpan detail kerusakan
            $biayaKeseluruhan = 0;
            $details_kerusakan = [];
            foreach ($request->details as $detail) {
                $kuantitasItem = $detail['kuantitas_item'] ?? 1;
                $subtotal = $detail['kuantitas'] * $detail['harga'] *  $kuantitasItem;
                $biayaKeseluruhan += $subtotal;
                $details_kerusakan[] = [
                    'kerusakan_id' => $kerusakan->id,
                    'tipe' => $detail['tipe'],
                    'nama' => $detail['nama'],
                    'kuantitas' => $detail['kuantitas'],
                    'kuantitas_item' => $kuantitasItem,
                    'satuan_id' => $detail['satuan_id'],
                    'harga' => $detail['harga'],
                    'created_at' => now(),
                ];
            }
            // dd($biayaKeseluruhan);
            $GrandTotal = $biayaKeseluruhan * ($kerusakanRules['kuantitas'] ?? 1);
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
        // dd($id);
        $kerusakan = Kerusakan::with('detail')->findOrFail($id);
        $bencana = Bencana::where('id', $kerusakan->bencana_id)->with(['kategori_bencana'])->first();
        $kategoribangunan = KategoriBangunan::query()->get();
        $satuan = Satuan::query()->get();
        return view('kerusakan.edit', [
            'kerusakan' => $kerusakan,
            'kategoribangunan' => $kategoribangunan,
            'satuan' => $satuan,
            'bencana' => $bencana
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'kategori_bangunan_id' => 'required|exists:kategori_bangunan,id',
            'deskripsi' => 'required|string',
            'details.*.nama' => 'required|string',
            'details.*.satuan_id' => 'required|exists:satuan,id',
            'details.*.harga' => 'required|numeric',
            'details.*.kuantitas' => 'required|numeric',
            // Jika ada field lain yang perlu divalidasi, tambahkan di sini
        ]);

        // Dapatkan model kerusakan berdasarkan id
        $kerusakan = Kerusakan::with('detail')->findOrFail($id);

        // Perbarui data kerusakan
        $kerusakan->kategori_bangunan_id = $request->kategori_bangunan_id;
        $kerusakan->deskripsi = $request->deskripsi;
        $kerusakan->save();
        // simpan detail kerusakan
        $biayaKeseluruhan = 0;
        // Perbarui detail kerusakan
        foreach ($request->details as $index => $detail) {
            $kerusakanDetail = $kerusakan->detail()->find($detail['id']);

            // Jika detail ditemukan, perbarui detail tersebut
            if ($kerusakanDetail) {
                $kerusakanDetail->nama = $detail['nama'];
                $kerusakanDetail->satuan_id = $detail['satuan_id'];
                $kerusakanDetail->harga = $detail['harga'];
                $kerusakanDetail->kuantitas = $detail['kuantitas'];


                // Update fields based on 'tipe'
                if ($kerusakanDetail->tipe == 2) {
                    // $kerusakanDetail->kuantitas = $detail['kuantitas'];
                    $kerusakanDetail->kuantitas_item = $detail['kuantitas_item'];
                    // $kerusakanDetail->harga = $detail['harga'];
                } elseif ($kerusakanDetail->tipe == 3) {
                    // $kerusakanDetail->kuantitas = $detail['jumlah_alat'];
                    // $kerusakanDetail->kuantitas_item = $detail['jumlah_kuantitas'];
                    $kerusakanDetail->kuantitas_item = $detail['kuantitas_item'];
                }

                $kerusakanDetail->save();
                // Hitung subtotal
                $subtotal = $detail['kuantitas'] * $detail['harga'] * ($detail['kuantitas_item'] ?? 1);
                $biayaKeseluruhan += $subtotal;
            }
        }
        // Perbarui kerusakan dengan total biaya keseluruhan
        $kerusakan->BiayaKeseluruhan = $biayaKeseluruhan;
        $kerusakan->save();

        return redirect()->route('kerusakan.index')->with('success', 'Data kerusakan berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
