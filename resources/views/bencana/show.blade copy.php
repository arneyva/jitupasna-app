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
                    <div class="card-header">
                        <h4 class="card-title">Detail Data Bencana</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Kategori Bencana</label>
                                        <input type="text" id="last-name-column" class="form-control" placeholder=""
                                            name="lokasi" readonly value="{{ $bencana->kategori_bencana->nama }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Lokasi Kejadian</label>
                                        <input type="text" id="last-name-column" class="form-control" placeholder=""
                                            name="lokasi" readonly value="{{ $bencana->lokasi }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Tanggal Mulai Bencana</label>
                                        <input type="date" id="last-name-column" class="form-control" placeholder=""
                                            name="tgl_mulai" readonly value="{{ $bencana->tgl_mulai }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Tanggal Berakhir Bencana</label>
                                        <input type="date" id="last-name-column" class="form-control" placeholder=""
                                            name="tgl_selesai" readonly value="{{ $bencana->tgl_selesai }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="company-column">Deskripsi</label>
                                    {{-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="deskripsi" readonly> {{!! $bencana->deskripsi !! }}</textarea> --}}
                                    <div class="form-control" style="height: auto;">{!! $bencana->deskripsi !!}</div>

                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Jumlah Bangunan Rusak</label>
                                        <input type="text" id="last-name-column" class="form-control" placeholder=""
                                            name="lokasi" readonly value="{{ $totalKuantitas }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Estimasi Biaya Perbaikan</label>
                                        <input type="text" id="last-name-column" class="form-control" placeholder=""
                                            name="lokasi" readonly
                                            value="{{ 'Rp ' . number_format($totalBiayaPerbaikan, 2, ',', '.') }}">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-6 col-lg-6">
                                <div class="card">
                                    <table class="table mb-0 mt-1" role="grid">
                                        <tbody>
                                            <tr>
                                                <th>{{ __('Kerusakan') }}</th>
                                                <td>{{ 'Rp ' . number_format($totalBiayaPerbaikan, 2, ',', '.') }} ~
                                                    {{ $totalKuantitas }} Bangunan</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Kerugian') }}</th>
                                                <td>{{ 'Rp ' . number_format($totalKerugian, 2, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Kebutuhan') }}</th>
                                                <td>{{ 'Rp ' . number_format($kebutuhan, 2, ',', '.') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script></script>
@endpush
