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
                    <form class="form" id="kerusakan-form" action="{{ route('kerugian.store', ['id' => $bencana->id]) }}"
                        method="POST">
                        @csrf
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Tambah Data Kerugian</h4>

                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                {{-- <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Kategori Bencana</label>
                                            <input type="text" id="last-name-column" class="form-control" placeholder=""
                                                name="lokasi" readonly value="{{ $bencana->kategori_bencana->nama }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Lokasi Kejadian</label>
                                            <input type="text" id="last-name-column" class="form-control" placeholder=""
                                                name="lokasi" readonly value="{{ $bencana->lokasi }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Estimasi Waktu</label>
                                            <input type="text" id="last-name-column" class="form-control" placeholder=""
                                                name="lokasi" readonly value="{{ $jumlahHari }} Hari">
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="button" id="add-detail-btn" class="btn btn-primary mr-1 mb-1">Tambah
                                        Detail</button>
                                    <button type="submit" class="btn btn-secondary mr-1 mb-1">Submit</button>
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
            // Mendapatkan jumlah detail kerusakan yang ada saat ini
            const detailCount = document.querySelectorAll('#additional-details .card').length;

            // Membuat elemen baru untuk detail kerusakan
            const newDetail = document.createElement('div');
            newDetail.classList.add('card');
            newDetail.innerHTML = `
            <div class="card-content"  style="border: 4px solid #ddd; margin-top: 10px">
            <div class="card-body">
            <div class="row">
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="tipe-${detailCount}">Sektor yang Terkena Dampak</label>
                        <select class="choices form-select" name="details[${detailCount}][tipe]" id="tipe-${detailCount}">
                            <option selected disabled value="">{{ __('Pilih...') }}</option>
            
                            <option value="2">Pertanian</option>
                         
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="nama-${detailCount}">Nilai Ekonomi Rata-Rata</label>
                        <input type="number" id="nama-${detailCount}" class="form-control" placeholder="" name="details[${detailCount}][nilai_ekonomi]">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="satuan-${detailCount}">Satuan</label>
                       <select class="choices form-select" name="details[${detailCount}][satuan_id]"
                        id="satuan_id-${detailCount}">
                        <option selected disabled value="">{{ __('Pilih...') }}</option>
                        @foreach ($satuan as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-md-2 col-12">
                    <div class="form-group">
                        <label for="kuantitas-${detailCount}">Jumlah Terkena Dampak</label>
                        <input type="number" id="kuantitas-${detailCount}" class="form-control" placeholder="" name="details[${detailCount}][kuantitas]">
                    </div>
                </div>
                <div class="col-md-1 col-12 d-flex align-items-center">
                    <div class="form-group mb-0">
                        <svg class="delete-icon" xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" viewBox="0 0 48 48" style="cursor: pointer;">
                            <g fill="none" stroke="#d51515" stroke-linejoin="round" stroke-width="4">
                                <path stroke-linecap="round" d="M8 11h32M18 5h12"/>
                                <path d="M12 17h24v23a3 3 0 0 1-3 3H15a3 3 0 0 1-3-3z"/>
                                <path stroke-linecap="round" d="m20 25l8 8m0-8l-8 8"/>
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="company-column">Deskripsi</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="details[${detailCount}][deskripsi]"></textarea>
                                    </div>
                </div>
            </div>
        </div>
    </div>
    `;

            // Menambahkan elemen baru ke dalam div dengan id "additional-details"
            document.getElementById('additional-details').appendChild(newDetail);
            new Choices(`#tipe-${detailCount}`);
            new Choices(`#satuan_id-${detailCount}`);
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
