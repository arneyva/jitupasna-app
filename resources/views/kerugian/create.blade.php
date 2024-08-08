@extends('layouts.main')
<style>
    .row {
        margin-bottom: 20px;
    }
</style>
@section('content')
    {{-- <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Data Kerusakan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Tipe Bangunan</label>
                                            <div class="form-group">
                                                <select class="choices form-select" name="">
                                                    <option selected disabled value="">{{ __('Pilih...') }}</option>
                                                    @foreach ($kategoribangunan as $item)
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
                                            <label for="last-name-column">Jumlah Kuantitas</label>
                                            <input type="number" id="last-name-column" class="form-control" placeholder=""
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
                                <button type="button" class="btn btn-primary mr-1 mb-1">Tambah Detail</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Data Kerusakan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Tipe Bangunan</label>
                                        <select class="choices form-select" name="">
                                            <option selected disabled value="">{{ __('Pilih...') }}</option>
                                            <option value="1">Bahan</option>
                                            <option value="2">Upah</option>
                                            <option value="3">Alat</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Nama</label>
                                        <input type="number" id="last-name-column" class="form-control" placeholder=""
                                            name="lname-column">
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Jumlah Kuantitas</label>
                                        <input type="number" id="last-name-column" class="form-control" placeholder=""
                                            name="lname-column">
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Satuan</label>
                                        <input type="number" id="last-name-column" class="form-control" placeholder=""
                                            name="lname-column">
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Harga</label>
                                        <input type="number" id="last-name-column" class="form-control" placeholder=""
                                            name="lname-column">
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem"
                                            viewBox="0 0 48 48">
                                            <g fill="none" stroke="#d51515" stroke-linejoin="round" stroke-width="4">
                                                <path stroke-linecap="round" d="M8 11h32M18 5h12" />
                                                <path d="M12 17h24v23a3 3 0 0 1-3 3H15a3 3 0 0 1-3-3z" />
                                                <path stroke-linecap="round" d="m20 25l8 8m0-8l-8 8" />
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Data Kerusakan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" id="kerusakan-form">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Tipe Bangunan</label>
                                            <select class="choices form-select" name="">
                                                <option selected disabled value="">{{ __('Pilih...') }}</option>
                                                @foreach ($kategoribangunan as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('brand_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Jumlah Kuantitas</label>
                                            <input type="number" id="last-name-column" class="form-control" placeholder=""
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
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="button" id="add-detail-btn" class="btn btn-primary mr-1 mb-1">Tambah
                                        Detail</button>
                                </div>
                                <div id="additional-details"></div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        document.getElementById('add-detail-btn').addEventListener('click', function() {
            // Membuat elemen baru untuk detail kerusakan
            const newDetail = document.createElement('div');
            newDetail.classList.add('card');
            newDetail.innerHTML = `
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="first-name-column">Tipe</label>
                                <select class="choices form-select" name="">
                                    <option selected disabled value="">{{ __('Pilih...') }}</option>
                                    <option value="1">Bahan</option>
                                    <option value="2">Upah</option>
                                    <option value="3">Alat</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="last-name-column">Nama</label>
                                <input type="text" id="last-name-column" class="form-control" placeholder="" name="lname-column">
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="last-name-column">Jumlah Kuantitas</label>
                                <input type="number" id="last-name-column" class="form-control" placeholder="" name="lname-column">
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="last-name-column">Satuan</label>
                                <input type="text" id="last-name-column" class="form-control" placeholder="" name="lname-column">
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="last-name-column">Harga</label>
                                <input type="number" id="last-name-column" class="form-control" placeholder="" name="lname-column">
                            </div>
                        </div>
                        <div class="col-md-2 col-12 d-flex align-items-center">
                <div class="form-group mb-0">
                    <svg class="delete-icon" xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" viewBox="0 0 48 48" style="cursor: pointer;">
                        <g fill="none" stroke="#d51515" stroke-linejoin="round" stroke-width="4">
                            <path stroke-linecap="round" d="M8 11h32M18 5h12" />
                            <path d="M12 17h24v23a3 3 0 0 1-3 3H15a3 3 0 0 1-3-3z" />
                            <path stroke-linecap="round" d="m20 25l8 8m0-8l-8 8" />
                        </g>
                    </svg>
                </div>
            </div>
                    </div>
                </div>
            </div>
        `;

            // Menambahkan elemen baru ke dalam div dengan id "additional-details"
            document.getElementById('additional-details').appendChild(newDetail);

            // Tambahkan event listener untuk menghapus baris ketika ikon diklik
            newDetail.querySelector('.delete-icon').addEventListener('click', function() {
                newDetail.remove();
            });
        });

        // Tambahkan event listener untuk ikon delete pada elemen yang sudah ada
        document.querySelectorAll('.delete-icon').forEach(function(icon) {
            icon.addEventListener('click', function() {
                icon.closest('.card').remove();
            });
        });
    </script>
@endpush
