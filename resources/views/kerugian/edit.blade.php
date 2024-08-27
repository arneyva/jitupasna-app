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
                                    <td>
                                        @foreach ($bencana->desa as $desa)
                                            <li> {{ $desa->nama }}</li>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <form class="form" id="kerusakan-form" action="{{ route('kerugian.update', ['id' => $kerugian->id]) }}"
                        method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Update Data Kerugian</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="card" style="border: 4px solid #ddd; margin-top: 10px">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="tipe-0">Sektor yang Terkena Dampak</label>
                                                        <input type="text"class="form-control" value="Pertanian"
                                                            disabled>
                                                        <input type="hidden" id="tipe-0" class="form-control"
                                                            placeholder="" name="tipe" value="2">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="nama-0">Nilai Ekonomi Rata-Rata</label>
                                                        <input type="text" id="nilai-ekonomi" class="form-control"
                                                            placeholder="" name="nilai_ekonomi"
                                                            value="{{ number_format($kerugian->nilai_ekonomi, 0, ',', '.') }}">
                                                        <input type="hidden" id="nilai-ekonomi-hidden"
                                                            name="nilai_ekonomi_hidden"
                                                            value="{{ $kerugian->nilai_ekonomi }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="satuan_id-0">Satuan</label>
                                                        <select class="choices form-select" name="satuan_id"
                                                            id="satuan_id-0">
                                                            <option selected disabled value="">
                                                                {{ __('Pilih...') }}</option>
                                                            @foreach ($satuan as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ (old('satuan_id') ?? $kerugian->satuan_id) == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="kuantitas-0">Jumlah Terkena Dampak</label>
                                                        <input type="number" id="kuantitas-0" class="form-control"
                                                            placeholder="" name="kuantitas"
                                                            value="{{ $kerugian->kuantitas }}" step="0.01"
                                                            min="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">Deskripsi</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="deskripsi">{{ $kerugian->deskripsi }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-secondary mr-1 mb-1">Submit</button>
                                </div>
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cleave = new Cleave('#nilai-ekonomi', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand',
                prefix: 'Rp ',
                rawValueTrimPrefix: true, // Trim the prefix when sending the data to the server
                numeralDecimalMark: ',',
                delimiter: '.',
            });

            // Update hidden input with raw value
            const hiddenInput = document.getElementById('nilai-ekonomi-hidden');
            hiddenInput.value = cleave.getRawValue();

            // Listen for changes and update the hidden input field
            document.getElementById('nilai-ekonomi').addEventListener('input', function() {
                hiddenInput.value = cleave.getRawValue();
            });
        });
    </script>
    {{-- <script>
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
    </script> --}}
@endpush
