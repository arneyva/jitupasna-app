<?php

namespace App\Http\Controllers;

use App\Models\KategoriBangunan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class KategoriBangunanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $KategoriBangunanQuery = KategoriBangunan::query()->where('deleted_at', null)->latest();
        if ($request->filled('nama')) {
            $KategoriBangunanQuery->where('nama', 'like', '%' . $request->input('nama') . '%');
        }
        $KategoriBangunan = $KategoriBangunanQuery->paginate($request->input('limit', 5))->appends($request->except('page'));

        return view('kategori-bangunan.index', [
            'KategoriBangunan' => $KategoriBangunan,
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
        dd($request->all());
        try {
            DB::beginTransaction();
            $validated = $request->validate([
                'nama' => [
                    'required',
                    Rule::unique(KategoriBangunan::class, 'nama')->whereNull('deleted_at'),
                ],
                'deskripsi' => [
                    'nullable',
                ],
            ]);
            $KategoriBangunan = KategoriBangunan::create([
                'nama' => $validated['nama'],
                'deskripsi' => $validated['deskripsi'],
            ]);
            DB::commit();

            return redirect()->route('kategori-bangunan.index')->with('success', 'Kategori Bencana Sukses Ditambahkan');
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
                    Rule::unique(KategoriBangunan::class, 'nama')->whereNull('deleted_at')->ignore($id),
                ],
                'deskripsi' => [
                    'nullable',
                ],
            ]);
            $KategoriBangunan = KategoriBangunan::where('id', $id)->update([
                'nama' => $validated['nama'],
                'deskripsi' => $validated['deskripsi'],
            ]);
            DB::commit();

            return redirect()->route('kategori-bangunan.index')->with('success', 'Kategori Bencana Sukses Diperbarui');
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
