<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $satuan = Satuan::query()->where('deleted_at', null)->latest()->paginate(5);

        return view('satuan.index', [
            'satuan' => $satuan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validate([
                'nama' => [
                    'required',
                    Rule::unique(Satuan::class, 'nama')->whereNull('deleted_at'),
                ],
                'deskripsi' => [
                    'nullable',
                ],
            ]);
            $satuan = Satuan::create([
                'nama' => $validated['nama'],
                'deskripsi' => $validated['deskripsi'],
            ]);
            DB::commit();

            return redirect()->route('satuan.index')->with('success', 'Satuan Sukses Ditambahkan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();

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
        try {
            DB::beginTransaction();
            $validated = $request->validate([
                'nama' => [
                    'required',
                    Rule::unique(Satuan::class, 'nama')->whereNull('deleted_at')->ignore($id),
                ],
                'deskripsi' => [
                    'nullable',
                ],
            ]);
            $satuan = Satuan::where('id', $id)->update([
                'nama' => $validated['nama'],
                'deskripsi' => $validated['deskripsi'],
            ]);
            DB::commit();

            return redirect()->route('satuan.index')->with('success', 'Satuan Sukses Diperbarui');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();

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
