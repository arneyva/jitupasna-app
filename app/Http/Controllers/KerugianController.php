<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\KategoriBangunan;
use App\Models\Kerugian;
use App\Models\Satuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KerugianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $kategoriBangunan = KategoriBangunan::query()->get();
        $kerugian = Kerugian::query()->with(['bencana'])->get();
        // if ($request->filled('kategori_bangunan_id')) {
        //     $kerugianQuery->where('kategori_bangunan_id', '=', $request->input('kategori_bangunan_id'));
        // }
        // $kerugian = $kerugianQuery->paginate($request->input('limit', 5))->appends($request->except('page'));
        return view('kerugian.index', [
            'kerugian' => $kerugian,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $bencana = Bencana::where('id', $id)->with(['kategori_bencana'])->first();
        // $kategoriBangunan = KategoriBangunan::query()->get();

        // dd($kategoriBangunan);
        // Menghitung jumlah hari
        $tglMulai = Carbon::parse($bencana->tgl_mulai);
        $tglSelesai = Carbon::parse($bencana->tgl_selesai);
        $jumlahHari = $tglMulai->diffInDays($tglSelesai);
        $satuan = Satuan::query()->get();

        return view('kerugian.create', [
            // 'kategoribangunan' => $kategoriBangunan,
            'bencana' => $bencana,
            'jumlahHari' => $jumlahHari, // Kirim jumlah hari ke view
            'satuan' => $satuan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $bencana = Bencana::where('id', $id)->first();
        try {
            DB::beginTransaction();
            $request->validate([
                // 'bencana_id' => 'required|exists:bencana,id',
                // 'details.*.tipe' => 'required|string',
                // 'details.*.nilai_ekonomi' => 'required|numeric',
                // 'details.*.satuan' => 'required|string',
                // 'details.*.kuantitas' => 'required|numeric',
                // 'details.*.deskripsi' => 'nullable|string',
            ]);

            // Mengambil data bencana_id dari request
            $bencana_id = $bencana->id;

            // Loop melalui setiap detail kerugian yang ada
            foreach ($request->details as $detail) {
                $biayaKeseluruhan = $detail['kuantitas'] * $detail['nilai_ekonomi'];
                // Buat record kerugian baru di database
                Kerugian::create([
                    'bencana_id' => $bencana_id,
                    'tipe' => $detail['tipe'],
                    'nilai_ekonomi' => $detail['nilai_ekonomi'],
                    'satuan_id' => $detail['satuan_id'],
                    'kuantitas' => $detail['kuantitas'],
                    'deskripsi' => $detail['deskripsi'] ?? null,
                    'created_at' => now(),
                    'BiayaKeseluruhan' => $biayaKeseluruhan,

                ]);
            }
            DB::commit();

            // Redirect ke halaman yang sesuai setelah penyimpanan sukses
            return redirect()->route('bencana.index')->with('success', 'Data kerugian berhasil disimpan.');
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
