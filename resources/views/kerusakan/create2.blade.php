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
                    <form class="form" id="kerusakan-form" action="{{ route('kerusakan.store', ['id' => $bencana->id]) }}"
                        method="POST">
                        @csrf
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Tambah Data Kerusakan</h4>
                            <div>
                                {{-- <button class="btn btn-danger">Petunjuk Penggunaan</button> --}}
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
                                                        {{ old('kategori_bangunan_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="company-column">Deskripsi</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="deskripsi"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div id="additional-details"></div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="button" id="add-detail-btn" class="btn btn-primary mr-1 mb-1">Tambah
                                        Detail</button>
                                </div>
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
@push('script')
    <script>
        document.getElementById('add-detail-btn').addEventListener('click', function() {
            const detailCount = document.querySelectorAll('#additional-details .card').length;

            const newDetail = document.createElement('div');
            newDetail.classList.add('card');
            newDetail.innerHTML = `
   <div class="card-content" style="border: 4px solid #ddd; margin-top: 10px">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="tipe-${detailCount}">Tipe</label>
                    <select class="choices form-select tipe-select" name="details[${detailCount}][tipe]"
                        id="tipe-${detailCount}">
                        <option selected disabled value="">{{ __('Pilih...') }}</option>
                        <option value="1">Bahan</option>
                        <option value="2">Upah</option>
                        <option value="3">Alat</option>
                    </select>
                </div>
            </div>
            <div class="col-md-5 col-12">
                <div class="form-group">
                    <label for="nama-${detailCount}">Nama</label>
                    <input type="text" id="nama-${detailCount}" class="form-control" placeholder=""
                        name="details[${detailCount}][nama]">
                </div>
            </div>
            <div class="col-md-1 col-12 d-flex align-items-center">
                <div class="form-group mb-0">
                    <svg class="delete-icon" xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem"
                        viewBox="0 0 48 48" style="cursor: pointer;">
                        <g fill="none" stroke="#d51515" stroke-linejoin="round" stroke-width="4">
                            <path stroke-linecap="round" d="M8 11h32M18 5h12" />
                            <path d="M12 17h24v23a3 3 0 0 1-3 3H15a3 3 0 0 1-3-3z" />
                            <path stroke-linecap="round" d="m20 25l8 8m0-8l-8 8" />
                        </g>
                    </svg>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-12">
                <div class="form-group">
                    <label for="satuan_id-${detailCount}">Satuan</label>
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
            <div class="col-md-3 col-12">
                <div class="form-group">
                    <label for="harga-${detailCount}" id="label-harga-${detailCount}">Harga</label>
                    <input type="number" id="harga-${detailCount}" class="form-control" placeholder=""
                        name="details[${detailCount}][harga]">
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="form-group">
                    <label for="kuantitas-${detailCount}" id="label-JumlahKuantitas-${detailCount}">Jumlah
                        Kuantitas</label>
                    <input type="number" id="kuantitas-${detailCount}" class="form-control" placeholder=""
                        name="details[${detailCount}][kuantitas]">
                </div>
            </div>

            <!-- Container for additional kuantitas item -->
            <div class="col-md-3 col-12" id="kuantitas-item-container-${detailCount}"></div>
        </div>
    </div>
</div>

    `;

            document.getElementById('additional-details').appendChild(newDetail);

            new Choices(`#tipe-${detailCount}`);
            new Choices(`#satuan_id-${detailCount}`);

            const tipeSelect = newDetail.querySelector('.tipe-select');
            const hargaLabel = newDetail.querySelector(`#label-harga-${detailCount}`);
            const JumlahKuantitasLabel = newDetail.querySelector(`#label-JumlahKuantitas-${detailCount}`);
            tipeSelect.addEventListener('change', function() {
                const kuantitasItemContainer = document.getElementById(
                    `kuantitas-item-container-${detailCount}`);

                if (this.value == "2" || this.value == "3") {
                    if (this.value == "2") {
                        hargaLabel.textContent = 'Upah Tiap Satuan Dalam Rupiah';
                        JumlahKuantitasLabel.textContent = 'Jumlah Pekerja';
                    } else if (this.value == "3") {
                        hargaLabel.textContent = 'Harga Tiap Satuan Dalam Rupiah';
                        JumlahKuantitasLabel.textContent = 'Jumlah Alat';
                    }

                    if (!kuantitasItemContainer.innerHTML) {
                        kuantitasItemContainer.innerHTML = `
                <div class="form-group">
                    <label for="kuantitas_item-${detailCount}" id="label-kuantitasItem-${detailCount}">Jumlah Kuantitas Item</label>
                    <input type="number" id="kuantitas_item-${detailCount}" class="form-control" placeholder="" name="details[${detailCount}][kuantitas_item]">
                </div>
            `;
                    }
                    // Sekarang elemen sudah ada di DOM, kita bisa mengaksesnya
                    const KuantitasItemLabel = newDetail.querySelector(
                        `#label-kuantitasItem-${detailCount}`);
                    if (this.value == "2") {
                        KuantitasItemLabel.textContent = 'Jumlah Hari';
                    } else if (this.value == "3") {
                        KuantitasItemLabel.textContent = 'Jumlah Berdasarkan Satuan';
                    }
                } else {
                    hargaLabel.textContent = 'Harga Tiap Satuan Dalam Rupiah';
                    JumlahKuantitasLabel.textContent = 'Jumlah Kuantitas';
                    kuantitasItemContainer.innerHTML = '';
                }
            });
            // Set kuantitas input visibility based on initial selection
            tipeSelect.dispatchEvent(new Event('change'));

            // Event listener for delete icon
            newDetail.querySelector('.delete-icon').addEventListener('click', function() {
                newDetail.remove();
            });
        });

        // Event listener for existing delete icons
        document.querySelectorAll('.delete-icon').forEach(function(icon) {
            icon.addEventListener('click', function() {
                icon.closest('.card').remove();
            });
        });
    </script>
@endpush
