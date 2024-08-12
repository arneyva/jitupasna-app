@extends('layouts.main')
<style>
    .row {
        margin-bottom: 20px;
    }
</style>
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Informasi Bencana</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Bencana Ref</th>
                                    <th>Bencana</th>
                                    <th>Lokasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $bencana->Ref }}</td>
                                    <td>{{ $bencana->kategori_bencana->nama }}</td>
                                    <td>{{ $bencana->lokasi }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <form class="form" id="kerusakan-form" action="{{ route('kerusakan.update', $kerusakan->id) }}"
                        method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Tambah Data Kerusakan</h4>
                            <div>
                                <button class="btn btn-danger">Petunjuk Penggunaan</button>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Tipe Bangunan</label>
                                            <select class="choices form-select" name="kategori_bangunan_id">
                                                <option selected disabled value="">{{ __('Pilih...') }}</option>
                                                @foreach ($kategoribangunan as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ (old('kategori_bangunan_id') ?? $kerusakan->kategori_bangunan_id) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="company-column">Deskripsi</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="deskripsi">{{ $kerusakan->deskripsi }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($kerusakan->detail as $details)
                                    <input type="hidden" name="details[{{ $loop->index }}][id]"
                                        value="{{ $details->id }}">
                                    <div class="card-content" style="border: 4px solid #ddd; margin-top: 10px">
                                        <div class="card-body">
                                            @if ($details->tipe == 1)
                                                <!-- Bahan -->
                                                <div class="row">
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="tipe-{{ $loop->index }}">Tipe</label>
                                                            <input type="text" id="tipe-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][tipe]" readonly
                                                                value="Bahan">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="nama-{{ $loop->index }}">Nama</label>
                                                            <input type="text" id="nama-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][nama]"
                                                                value="{{ $details->nama }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="satuan_id-{{ $loop->index }}">Satuan</label>
                                                            <select class="choices form-select"
                                                                name="details[{{ $loop->index }}][satuan_id]"
                                                                id="satuan_id-{{ $loop->index }}">
                                                                <option selected disabled value="">
                                                                    {{ __('Pilih...') }}</option>
                                                                @foreach ($satuan as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ (old('satuan_id') ?? $details->satuan_id) == $item->id ? 'selected' : '' }}>
                                                                        {{ $item->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="harga-{{ $loop->index }}">Harga Tiap
                                                                Satuan</label>
                                                            <input type="number" id="harga-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][harga]"
                                                                value="{{ $details->harga }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="kuantitas-{{ $loop->index }}">Jumlah
                                                                Kuantitas</label>
                                                            <input type="number" id="kuantitas-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][kuantitas]"
                                                                value="{{ $details->kuantitas }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($details->tipe == 2)
                                                <!-- Upah -->
                                                <div class="row">
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="tipe-{{ $loop->index }}">Tipe</label>
                                                            <input type="text" id="tipe-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][tipe]" readonly
                                                                value="Upah">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="nama-{{ $loop->index }}">Nama</label>
                                                            <input type="text" id="nama-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][nama]"
                                                                value="{{ $details->nama }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="satuan_id-{{ $loop->index }}">Satuan</label>
                                                            <select class="choices form-select"
                                                                name="details[{{ $loop->index }}][satuan_id]"
                                                                id="satuan_id-{{ $loop->index }}">
                                                                <option selected disabled value="">
                                                                    {{ __('Pilih...') }}</option>
                                                                @foreach ($satuan as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ (old('satuan_id') ?? $details->satuan_id) == $item->id ? 'selected' : '' }}>
                                                                        {{ $item->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="upah-{{ $loop->index }}">Upah Tiap Satuan</label>
                                                            <input type="number" id="upah-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][harga]"
                                                                value="{{ $details->harga }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="jumlah_pekerja-{{ $loop->index }}">Jumlah
                                                                Pekerja</label>
                                                            <input type="number" id="jumlah_pekerja-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][kuantitas]"
                                                                value="{{ $details->kuantitas }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="jumlah_hari-{{ $loop->index }}">Jumlah
                                                                Hari</label>
                                                            <input type="number" id="jumlah_hari-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][kuantitas_item]"
                                                                value="{{ $details->kuantitas_item }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($details->tipe == 3)
                                                <!-- Alat -->
                                                <div class="row">
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="tipe-{{ $loop->index }}">Tipe</label>
                                                            <input type="text" id="tipe-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][tipe]" readonly
                                                                value="Alat">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="nama-{{ $loop->index }}">Nama</label>
                                                            <input type="text" id="nama-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][nama]"
                                                                value="{{ $details->nama }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="satuan_id-{{ $loop->index }}">Satuan</label>
                                                            <select class="choices form-select"
                                                                name="details[{{ $loop->index }}][satuan_id]"
                                                                id="satuan_id-{{ $loop->index }}">
                                                                <option selected disabled value="">
                                                                    {{ __('Pilih...') }}</option>
                                                                @foreach ($satuan as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ (old('satuan_id') ?? $details->satuan_id) == $item->id ? 'selected' : '' }}>
                                                                        {{ $item->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="harga-{{ $loop->index }}">Harga Tiap
                                                                Satuan</label>
                                                            <input type="number" id="harga-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][harga]"
                                                                value="{{ $details->harga }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="jumlah_alat-{{ $loop->index }}">Jumlah
                                                                Alat</label>
                                                            <input type="number" id="jumlah_alat-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][kuantitas]"
                                                                value="{{ $details->kuantitas }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="jumlah_kuantitas-{{ $loop->index }}">Jumlah
                                                                Kuantitas Berdasarkan Satuan</label>
                                                            <input type="number"
                                                                id="jumlah_kuantitas-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][kuantitas_item]"
                                                                value="{{ $details->kuantitas_item }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-secondary mr-1 mb-1 mt-2">Submit</button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
