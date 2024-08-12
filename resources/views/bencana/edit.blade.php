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
                        <h4 class="card-title">Update Data Bencana</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('bencana.update', $bencana->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Kategori Bencana</label>
                                            <div class="form-group">
                                                <select class="choices form-select" name="kategori_bencana_id">
                                                    <option selected disabled value="">{{ __('Pilih...') }}</option>
                                                    @foreach ($kategoribencana as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ (old('kategori_bencana_id') ?? $bencana->kategori_bencana_id) == $item->id ? 'selected' : '' }}>
                                                            {{ $item->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Lokasi Kejadian</label>
                                            <input type="text" id="last-name-column" class="form-control" placeholder=""
                                                name="lokasi" value="{{ $bencana->lokasi }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Tanggal Mulai Bencana</label>
                                            <input type="date" id="last-name-column" class="form-control" placeholder=""
                                                name="tgl_mulai" value="{{ $bencana->tgl_mulai }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Tanggal Berakhir Bencana</label>
                                            <input type="date" id="last-name-column" class="form-control" placeholder=""
                                                name="tgl_selesai" value="{{ $bencana->tgl_selesai }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="company-column">Deskripsi</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="deskripsi"> {{ $bencana->deskripsi }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                                </div>
                            </form>
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
