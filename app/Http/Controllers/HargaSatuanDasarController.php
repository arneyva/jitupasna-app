<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HargaSatuanDasarController extends Controller
{
    public function indexBahan()
    {
        return view('harga-satuan-dasar.bahan');
    }
    public function storeBahan(Request $request)
    {
        dd($request->all());
        // try {
        //     DB::beginTransaction();
        //     $validated = $request->validate([
        //         'nama' => [
        //             'required',
        //             Rule::unique(KategoriBangunan::class, 'nama')->whereNull('deleted_at'),
        //         ],
        //         'deskripsi' => [
        //             'nullable',
        //         ],
        //     ]);
        //     $KategoriBangunan = KategoriBangunan::create([
        //         'nama' => $validated['nama'],
        //         'deskripsi' => $validated['deskripsi'],
        //     ]);
        //     DB::commit();

        //     return redirect()->route('kategori-bangunan.index')->with('success', 'Kategori Bencana Sukses Ditambahkan');
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     DB::rollBack();

        //     return redirect()->back()->withErrors($e->errors())->withInput();
        // }
    }
}
