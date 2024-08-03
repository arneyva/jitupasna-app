@extends('layouts.main')

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Jumlah Data Dasar Sebelum Bencana</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form">
                                <span class="badge bg-primary" style="margin-bottom: 20px;">Penduduk Wilayah</span>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Laki-Laki</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="First Name" name="fname-column">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Perempuan</label>
                                            <input type="text" id="last-name-column" class="form-control"
                                                placeholder="Last Name" name="lname-column">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Rumah Tangga</label>
                                            <input type="text" id="city-column" class="form-control" placeholder="City"
                                                name="city-column">
                                        </div>
                                    </div>
                                </div>
                                <span class="badge bg-primary" style="margin-bottom: 20px;margin-top: 20px">Sarana
                                    Kesehatan</span>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Rumah Sakit</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="First Name" name="fname-column">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Puskesmas</label>
                                            <input type="text" id="last-name-column" class="form-control"
                                                placeholder="Last Name" name="lname-column">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Puskesmas Pembantu</label>
                                            <input type="text" id="city-column" class="form-control" placeholder="City"
                                                name="city-column">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="city-column">POLINDES</label>
                                            <input type="text" id="city-column" class="form-control" placeholder="City"
                                                name="city-column">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="city-column">POSYANDU</label>
                                            <input type="text" id="city-column" class="form-control" placeholder="City"
                                                name="city-column">
                                        </div>
                                    </div>
                                </div>
                                <span class="badge bg-primary" style="margin-bottom: 20px;margin-top: 20px">Tenaga
                                    Kesehatan</span>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Dokter</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="First Name" name="fname-column">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Paramedis</label>
                                            <input type="text" id="last-name-column" class="form-control"
                                                placeholder="Last Name" name="lname-column">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Bidan</label>
                                            <input type="text" id="city-column" class="form-control"
                                                placeholder="City" name="city-column">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Kader Kesehatan</label>
                                            <input type="text" id="city-column" class="form-control"
                                                placeholder="City" name="city-column">
                                        </div>
                                    </div>
                                </div>
                                <span class="badge bg-primary" style="margin-bottom: 20px;margin-top: 20px">Tenaga
                                    Kesehatan</span>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Dokter</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="First Name" name="fname-column">
                                        </div>
                                    </div>
                                </div>
                                <span class="badge bg-primary" style="margin-bottom: 20px;margin-top: 20px">Balita</span>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Balita</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="First Name" name="fname-column">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Balita Gizi Buruk</label>
                                            <input type="text" id="last-name-column" class="form-control"
                                                placeholder="Last Name" name="lname-column">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Balita Gizi Kurang</label>
                                            <input type="text" id="city-column" class="form-control"
                                                placeholder="City" name="city-column">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Ditimbang di Posyandu</label>
                                            <input type="text" id="city-column" class="form-control"
                                                placeholder="City" name="city-column">
                                        </div>
                                    </div>
                                </div>
                                <span class="badge bg-primary" style="margin-bottom: 20px;margin-top: 20px">Tenaga
                                    Kesehatan</span>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Dokter</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="First Name" name="fname-column">
                                        </div>
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
