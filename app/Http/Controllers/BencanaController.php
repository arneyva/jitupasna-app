<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Desa;
use App\Models\KategoriBencana;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategoriBencana = KategoriBencana::query()->get();
        $bencanaQuery = Bencana::query()->latest();
        if ($request->filled('kategori_bencana_id')) {
            $bencanaQuery->where('kategori_bencana_id', '=', $request->input('kategori_bencana_id'));
        }
        $bencana = $bencanaQuery->paginate($request->input('limit', 5))->appends($request->except('page'));

        return view('bencana.index', [
            'bencana' => $bencana,
            'kategoribencana' => $kategoriBencana,
        ]);
    }
    // public function getDesa(Request $request, $id)
    // {
    //     $kecamatan = Kecamatan::findOrFail($id);
    //     $desaTerkait = Desa::where('kecamatan_id', $kecamatan->id)->get();

    //     return response()->json([
    //         'desaTerkait' => $desaTerkait,
    //     ]);
    // }
    public function getDesaByKecamatan($kecamatan_id)
    {
        $desa = Desa::where('kecamatan_id', $kecamatan_id)->get();
        return response()->json(['desaTerkait' => $desa]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriBencana = KategoriBencana::query()->get();
        $kecamatan = Kecamatan::query()->where('deleted_at', '=', null)->get();
        return view('bencana.create', [
            'kategoribencana' => $kategoriBencana,
            'kecamatan' => $kecamatan
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
        dd($request->all());
        try {
            DB::beginTransaction();
            $bencaRules = $request->validate([
                'kategori_bencana_id' => 'required',
                'tgl_mulai' => 'required',
                'kecamatan_id' => 'required',
                'desa_ids' => 'array',
                'deskripsi' => 'nullable',
                'image' => 'nullable',
            ]);
            $bencana = Bencana::create([
                'Ref' => $this->getRef(),
                'kategori_bencana_id' => $bencaRules['kategori_bencana_id'],
                'tgl_mulai' => $bencaRules['tgl_mulai'],
                'kecamatan_id' => $bencaRules['kecamatan_id'],
                'deskripsi' => $bencaRules['deskripsi'],
                'image' => $bencaRules['tgl_selesai'],
            ]);
            // Mengambil array ID desa
            $desaIds = $bencaRules['desa_ids'] ?? [];
            // Menyimpan data ke tabel pivot menggunakan foreach
            foreach ($desaIds as $desaId) {
                DB::table('wilayah_bencana')->insert([
                    'bencana_id' => $bencana->id,
                    'desa_id' => $desaId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            // dd($request->all());
            DB::commit();

            return redirect()->route('bencana.index')->with('success', 'Bencana Sukses Ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            // Menyimpan error ke log dan mengembalikan ke halaman sebelumnya dengan error message
            \Log::error('Error storing bencana: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Data bencana gagal ditambahkan');
        }
    }

    public function show(string $id)
    {
        $bencana = Bencana::with(['kerusakan.detail'])->findOrFail($id);

        // Hitung total jumlah kuantitas (bangunan rusak)
        $totalKuantitas = $bencana->kerusakan->sum('kuantitas');
        $totalBiayaPerbaikan = $bencana->kerusakan->sum('BiayaKeseluruhan');
        $totalKerugian = $bencana->kerugian->sum('BiayaKeseluruhan');
        $kebutuhan = $totalBiayaPerbaikan + $totalKerugian;

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
    public function edit($id)
    {
        $bencana = Bencana::findOrFail($id);
        $kategoriBencana = KategoriBencana::all();

        return view('bencana.edit', [
            'bencana' => $bencana,
            'kategoribencana' => $kategoriBencana,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $bencana = Bencana::findOrFail($id);

            $bencaRules = $request->validate([
                'kategori_bencana_id' => 'required',
                'lokasi' => 'required',
                'deskripsi' => 'required',
                'tgl_mulai' => 'required',
                'tgl_selesai' => 'required',
            ]);

            $bencana->update([
                'kategori_bencana_id' => $bencaRules['kategori_bencana_id'],
                'lokasi' => $bencaRules['lokasi'],
                'deskripsi' => $bencaRules['deskripsi'],
                'tgl_mulai' => $bencaRules['tgl_mulai'],
                'tgl_selesai' => $bencaRules['tgl_selesai'],
            ]);

            DB::commit();

            return redirect()->route('bencana.index')->with('success', 'Data bencana berhasil diperbarui');
        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::error('Error updating bencana: ' . $th->getMessage());

            return redirect()->back()->withErrors('Terjadi kesalahan, silakan coba lagi.');
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
