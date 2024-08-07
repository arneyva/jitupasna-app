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
                        <h4 class="card-title">Tambah Data Bencana</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Tipe Bencana</label>
                                            <div class="form-group">
                                                <select class="choices form-select" name="">
                                                    <option selected disabled value="">{{ __('Choose...') }}</option>
                                                    @foreach ($kategoribencana as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ old('brand_id') == $item->id ? 'selected' : '' }}>
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
                                                name="lname-column">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Tanggal Mulai Bencana</label>
                                            <input type="date" id="last-name-column" class="form-control" placeholder=""
                                                name="lname-column">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Tanggal Berakhir Bencana</label>
                                            <input type="date" id="last-name-column" class="form-control" placeholder=""
                                                name="lname-column">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="company-column">Deskripsi</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                </div>
                            </form>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
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
