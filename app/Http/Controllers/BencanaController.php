<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Desa;
use App\Models\KategoriBencana;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class BencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategoriBencana = KategoriBencana::query()->get();
        $bencanaQuery = Bencana::query()->with('desa')->latest();
        if ($request->filled('kategori_bencana_id')) {
            $bencanaQuery->where('kategori_bencana_id', '=', $request->input('kategori_bencana_id'));
        }
        $bencana = $bencanaQuery->paginate($request->input('limit', 5))->appends($request->except('page'));

        return view('bencana.index', [
            'bencana' => $bencana,
            'kategoribencana' => $kategoriBencana,
        ]);
    }
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
        // dd($request->all());
        try {
            DB::beginTransaction();
            $bencaRules = $request->validate([
                'kategori_bencana_id' => 'required',
                'tanggal' => 'required',
                'kecamatan_id' => 'required',
                'desa_ids' => 'array',
                'latitude' => 'nullable',
                'longitude' => 'nullable',
                'deskripsi' => 'nullable',
                'gambar' => 'nullable',
            ]);
            //handle image
            if ($request->input('avatar') !== null) {

                $avatarBase64 = $request->input('avatar');

                $avatarBinaryData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $avatarBase64));
                $filename = $request['name'] . '_' . uniqid() . '.png';

                $tempFilePath = public_path('/frontend/dist/assets/images/avatar/temp/' . $filename);
                file_put_contents($tempFilePath, $avatarBinaryData);

                $image_resize = Image::make($tempFilePath);
                $image_resize->resize(305, 305);
                $image_resize->save(public_path('/frontend/dist/assets/images/avatar/' . $filename));
                unlink($tempFilePath);
            } else {
                $filename = 'no-image.png';
            }
            $bencana = Bencana::create([
                'Ref' => $this->getRef(),
                'kategori_bencana_id' => $bencaRules['kategori_bencana_id'],
                'tanggal' => $bencaRules['tanggal'],
                'kecamatan_id' => $bencaRules['kecamatan_id'],
                'latitude' => $bencaRules['latitude'],
                'longitude' => $bencaRules['longitude'],
                'deskripsi' => $bencaRules['deskripsi'],
                'gambar' => $filename,
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
            // } catch (\Throwable $th) {
            //     DB::rollBack();
            //     // Menyimpan error ke log dan mengembalikan ke halaman sebelumnya dengan error message
            //     \Log::error('Error storing bencana: ' . $th->getMessage());

            //     return redirect()->back()->with('error', $th->getMessage());
            // }
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();

            return redirect()->back()->withErrors($e->errors())->withInput();
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
        // dd($kebutuhan);
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
        $kecamatan = Kecamatan::query()->where('deleted_at', '=', null)->get();
        // $selectedKecamatan = Bencana::find($id)->kecamatan_id; // atau bagaimana cara Anda mendapatkan kecamatan terkait
        // $selectedDesaIds = Bencana::find($id)->desa->pluck('id')->toArray(); // array ID desa yang dipilih
        $desaTerkait = Desa::where('kecamatan_id', $bencana->kecamatan_id)->get(); // Desa berdasarkan Kecamatan yang sudah dipilih
        $selectedDesaIds = $bencana->desa->pluck('id')->toArray(); // ID desa yang sudah dipilih
        // dd($selectedDesaIds);
        return view('bencana.edit', [
            'bencana' => $bencana,
            'kategoribencana' => $kategoriBencana,
            'kecamatan' => $kecamatan,
            'desaTerkait' => $desaTerkait,
            'selectedDesaIds' => $selectedDesaIds
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $bencana = Bencana::findOrFail($id);

            $bencaRules = $request->validate([
                'kategori_bencana_id' => 'required',
                'tanggal' => 'required',
                // 'kecamatan_id' => 'required',
                // 'desa_ids' => 'array',
                'latitude' => 'nullable',
                'longitude' => 'nullable',
                'deskripsi' => 'nullable',
                'gambar' => 'nullable',
            ]);
            $currentAvatar = $bencana->gambar ?? 'no-image.png';
            if ($request->avatar != null) {

                $avatarBase64 = $request->input('avatar');

                $avatarBinaryData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $avatarBase64));
                $filename = $request['name'] . '_' . uniqid() . '.png';

                $tempFilePath = public_path('/frontend/dist/assets/images/avatar/temp/' . $filename);
                file_put_contents($tempFilePath, $avatarBinaryData);

                $image_resize = Image::make($tempFilePath);
                $image_resize->resize(305, 305);
                $image_resize->save(public_path('/frontend/dist/assets/images/avatar/' . $filename));
                unlink($tempFilePath);

                $path = public_path('/frontend/dist/assets/images/avatar/');
                $currentPhotoPath = $path . $currentAvatar;
                if (file_exists($currentPhotoPath)) {
                    if ($currentAvatar != 'no-image.png') {
                        @unlink($currentPhotoPath);
                    }
                }
            } else {
                $filename = $currentAvatar;
            }
            $bencana->update([
                'kategori_bencana_id' => $bencaRules['kategori_bencana_id'],
                'tanggal' => $bencaRules['tanggal'],
                // 'kecamatan_id' => $bencaRules['kecamatan_id'],
                'latitude' => $bencaRules['latitude'],
                'longitude' => $bencaRules['longitude'],
                'deskripsi' => $bencaRules['deskripsi'],
                'gambar' => $filename,
            ]);

            DB::commit();

            return redirect()->route('bencana.index')->with('success', 'Data bencana berhasil diperbarui');
        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::error('Error updating bencana: ' . $th->getMessage());
            return redirect()->back()->withErrors('Terjadi kesalahan, silakan coba lagi.');
        }
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     DB::rollBack();

        //     return redirect()->back()->withErrors($e->errors())->withInput();
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
