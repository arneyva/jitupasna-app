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
