<?php

namespace App\Http\Controllers;

use App\Models\HSD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class HargaSatuanDasarController extends Controller
{
    public function index()
    {
        $hsd = HSD::query()->where('deleted_at', null)
            ->orderBy('nama', 'asc')->paginate(10);
        return view('harga-satuan-dasar.index', [
            'hsd' => $hsd
        ]);
    }
    public function store(Request $request)
    {
        dd($request->all());
        try {
            DB::beginTransaction();
            $validated = $request->validate([
                'nama' => [
                    'nullable',
                    Rule::unique(HSD::class, 'nama')->whereNull('deleted_at'),
                ],
                'satuan' => [
                    'nullable',
                ],
                'harga' => [
                    'nullable',
                ],
            ]);
            $bahan = HSD::create([
                'tipe' => 1,
                'nama' => $validated['nama'],
                'satuan' => $validated['satuan'],
                'harga' => $validated['harga'],
            ]);
            DB::commit();

            return redirect()->route('hsd.bahan.index')->with('success', 'HSD Sukses Ditambahkan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();

            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
}
