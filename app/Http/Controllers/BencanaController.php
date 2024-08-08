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
        $bencana = Bencana::query()->get();
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
