<?php

namespace App\Http\Controllers;

use App\Models\KategoriBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class KategoriBencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategoriBencanaQuery = KategoriBencana::query()->where('deleted_at', null)->latest();
        if ($request->filled('nama')) {
            $kategoriBencanaQuery->where('nama', 'like', '%'.$request->input('nama').'%');
        }
        $kategoriBencana = $kategoriBencanaQuery->paginate($request->input('limit', 5))->appends($request->except('page'));

        return view('kategori-bencana.index', [
            'kategoriBencana' => $kategoriBencana,
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
                    Rule::unique(KategoriBencana::class, 'nama')->whereNull('deleted_at'),
                ],
                'deskripsi' => [
                    'nullable',
                ],
            ]);
            $kategoriBencana = KategoriBencana::create([
                'nama' => $validated['nama'],
                'deskripsi' => $validated['deskripsi'],
            ]);
            DB::commit();

            return redirect()->route('kategori-bencana.index')->with('success', 'Kategori Bencana Sukses Ditambahkan');
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
                    Rule::unique(KategoriBencana::class, 'nama')->whereNull('deleted_at')->ignore($id),
                ],
                'deskripsi' => [
                    'nullable',
                ],
            ]);
            $kategoriBencana = KategoriBencana::where('id', $id)->update([
                'nama' => $validated['nama'],
                'deskripsi' => $validated['deskripsi'],
            ]);
            DB::commit();

            return redirect()->route('kategori-bencana.index')->with('success', 'Kategori Bencana Sukses Diperbarui');
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
