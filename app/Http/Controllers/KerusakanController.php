<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\DetailKerusakan;
use App\Models\HSD;
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
            'kategoribangunan' => $kategoriBangunan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $bencana = Bencana::where('id', $id)->with(['kategori_bencana', 'desa'])->first();
        $kategoriBangunan = KategoriBangunan::query()->get();
        $satuan = Satuan::query()->get();
        $hsd = HSD::query()->get();

        // dd($kategoriBangunan);
        return view('kerusakan.create', [
            'kategoribangunan' => $kategoriBangunan,
            'bencana' => $bencana,
            'satuan' => $satuan,
            'hsd' => $hsd,
        ]);
    }
    public function getRef()
    {
        // Ambil data terakhir dari tabel bencana
        $last = DB::table('kerusakan')->latest('id')->first();

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
    public function store(Request $request, $id)
    {
        // dd($request->all());
        $bencana = Bencana::where('id', $id)->first();
        try {
            DB::beginTransaction();
            $kerusakanRules = $request->validate([
                'kategori_bangunan_id' => 'required',
                'deskripsi' => 'nullable',
            ]);
            $kerusakan = new Kerusakan;
            $kerusakan->bencana_id = $bencana->id;
            $kerusakan->kategori_bangunan_id = $kerusakanRules['kategori_bangunan_id'];
            $kerusakan->deskripsi = $kerusakanRules['deskripsi'];
            $kerusakan->Ref = $this->getRef();
            $kerusakan->save();
            $biayaKeseluruhan = 0;
            $details_kerusakan = [];
            foreach ($request->details as $detail) {
                $dataHsd = HSD::where('id', $detail['nama'])->first();
                $kuantitasItem = $detail['kuantitas_item'] ?? 1; //untuk pekerja
                $kuantitas = str_replace(',', '.', $detail['kuantitas']); //untuk kuantitas persatuan
                $subtotal = $kuantitas * $dataHsd->harga * $kuantitasItem;
                $biayaKeseluruhan += $subtotal;
                $details_kerusakan[] = [
                    'kerusakan_id' => $kerusakan->id,
                    'hsd_id' => $detail['nama'],
                    'kuantitas_per_satuan' => $kuantitas, //kuantitas per satuan yang semua punya
                    'kuantitas_item' => $kuantitasItem,
                    'harga' => $subtotal,
                    'created_at' => now(),
                ];
            }
            $GrandTotal = $biayaKeseluruhan * ($kerusakanRules['kuantitas'] ?? 1);
            DetailKerusakan::insert($details_kerusakan); //memasukan data ke database
            // Perbarui kerusakan dengan total biaya keseluruhan
            $kerusakan->BiayaKeseluruhan = $GrandTotal;
            $kerusakan->save();
            DB::commit();

            return redirect()->route('kerusakan.index')->with('success', 'Data Kerusakan Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
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
        $kerusakan = Kerusakan::with('detail.hsd')->findOrFail($id);
        $bencana = Bencana::where('id', $kerusakan->bencana_id)->with(['kategori_bencana'])->first();
        $kategoribangunan = KategoriBangunan::query()->get();
        $satuan = Satuan::query()->get();

        return view('kerusakan.edit', [
            'kerusakan' => $kerusakan,
            'kategoribangunan' => $kategoribangunan,
            'satuan' => $satuan,
            'bencana' => $bencana,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $request->validate([
                'kategori_bangunan_id' => 'required|exists:kategori_bangunan,id',
                'deskripsi' => 'nullable|string',
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
                if ($kerusakanDetail) {
                    $kuantitas = str_replace(',', '.', $detail['kuantitas']);
                    $kerusakanDetail->kuantitas_per_satuan =  $kuantitas;
                    // Update fields based on 'tipe'
                    if ($kerusakanDetail->tipe == 2) {
                        $kerusakanDetail->kuantitas_item = $detail['kuantitas_item'];
                    } else {
                        $kerusakanDetail->kuantitas_item = 1;
                    }
                    // Hitung subtotal
                    $subtotal =  $kuantitas * $kerusakanDetail->hsd->harga * ($detail['kuantitas_item'] ?? 1);
                    $kerusakanDetail->harga = $subtotal;
                    $kerusakanDetail->save();
                    $biayaKeseluruhan += $subtotal;
                }
            }
            // Perbarui kerusakan dengan total biaya keseluruhan
            $kerusakan->BiayaKeseluruhan = $biayaKeseluruhan;
            $kerusakan->save();
            DB::commit();

            return redirect()->route('kerusakan.index')->with('success', 'Data kerusakan berhasil diperbarui');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
