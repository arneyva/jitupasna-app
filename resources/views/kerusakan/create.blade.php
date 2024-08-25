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
                                {{-- <div id="additional-details"></div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="button" id="add-detail-btn" class="btn btn-primary mr-1 mb-1">Tambah
                                        Detail</button>
                                </div> --}}
                                <div id="additional-details"></div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="button" id="add-detail-btn" class="btn btn-primary">Tambah
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
                                <select class="choices form-select tipe-select" name="details[${detailCount}][tipe]" id="tipe-${detailCount}">
                                    <option selected disabled value="">Pilih...</option>
                                    <option value="1">Bahan</option>
                                    <option value="2">Upah</option>
                                    <option value="3">Alat</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="nama-${detailCount}">Nama</label>
                                <select id="nama-${detailCount}" class="choices form-select nama-select" name="details[${detailCount}][nama]">
                                    <option selected disabled value="">Pilih Nama...</option>
                                </select>
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
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="satuan-${detailCount}">Satuan</label>
                                <input type="text" id="satuan-${detailCount}" class="form-control satuan" name="details[${detailCount}][satuan]" readonly>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="harga-${detailCount}" id="label-harga-${detailCount}">Harga per Satuan</label>
                                <input type="number" id="harga-${detailCount}" class="form-control harga" name="details[${detailCount}][harga]" readonly>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="kuantitas-${detailCount}" id="label-JumlahKuantitas-${detailCount}">Jumlah Kuantitas</label>
                                <input type="number" id="kuantitas-${detailCount}" class="form-control" name="details[${detailCount}][kuantitas]">
                            </div>
                        </div>
                        <div class="col-md-3 col-12" id="kuantitas-item-container-${detailCount}"></div>
                    </div>
                </div>
            </div>
        `;

            document.getElementById('additional-details').appendChild(newDetail);

            // Initialize Choices.js for Tipe and Nama dropdowns
            const tipeSelectElement = new Choices(document.getElementById(`tipe-${detailCount}`));
            const namaSelectElement = new Choices(document.getElementById(`nama-${detailCount}`));

            const tipeSelect = newDetail.querySelector('.tipe-select');
            const namaSelect = newDetail.querySelector('.nama-select');

            // Event listener for Tipe selection
            tipeSelect.addEventListener('change', function() {
                const tipe = this.value;
                const kuantitasItemContainer = newDetail.querySelector(
                    `#kuantitas-item-container-${detailCount}`);
                const hargaLabel = newDetail.querySelector(`#label-harga-${detailCount}`);
                const JumlahKuantitasLabel = newDetail.querySelector(
                    `#label-JumlahKuantitas-${detailCount}`);
                // Reset related fields when Tipe changes
                newDetail.querySelector(`#nama-${detailCount}`).value = '';
                newDetail.querySelector(`#satuan-${detailCount}`).value = '';
                newDetail.querySelector(`#harga-${detailCount}`).value = '';
                namaSelectElement.clearChoices();
                namaSelectElement.setChoices([{
                    value: '',
                    label: 'Pilih Nama...',
                    selected: true,
                    disabled: true
                }], 'value', 'label', true);
                if (tipe) {
                    namaSelectElement.clearChoices();
                    namaSelectElement.setChoices([{
                        value: '',
                        label: 'Pilih Nama...',
                        selected: true,
                        disabled: true
                    }], 'value', 'label', true);

                    fetch(`/get-nama-by-tipe/${tipe}`)
                        .then(response => response.json())
                        .then(data => {
                            const choices = data.map(item => ({
                                value: item.id,
                                label: item.nama,
                                customProperties: {
                                    satuan: item.satuan,
                                    harga: item.harga
                                }
                            }));
                            namaSelectElement.setChoices(choices, 'value', 'label');
                        })
                        .catch(error => console.error('Error:', error));

                    if (tipe == "2" || tipe == "3") {
                        if (tipe == "2") {
                            hargaLabel.textContent = 'Upah Tiap Satuan Dalam Rupiah';
                            JumlahKuantitasLabel.textContent = 'Jumlah Pekerja';
                        } else if (tipe == "3") {
                            hargaLabel.textContent = 'Harga Tiap Satuan Dalam Rupiah';
                            JumlahKuantitasLabel.textContent = 'Jumlah Alat';
                        }

                        if (!kuantitasItemContainer.innerHTML) {
                            kuantitasItemContainer.innerHTML = `
                            <div class="form-group">
                                <label for="kuantitas_item-${detailCount}" id="label-kuantitasItem-${detailCount}">Jumlah Kuantitas Item</label>
                                <input type="number" id="kuantitas_item-${detailCount}" class="form-control" name="details[${detailCount}][kuantitas_item]">
                            </div>
                        `;
                        }

                        const KuantitasItemLabel = newDetail.querySelector(
                            `#label-kuantitasItem-${detailCount}`);
                        KuantitasItemLabel.textContent = tipe == "2" ? 'Jumlah Hari' :
                            'Jumlah Berdasarkan Satuan';
                    } else {
                        hargaLabel.textContent = 'Harga Tiap Satuan Dalam Rupiah';
                        JumlahKuantitasLabel.textContent = 'Jumlah Kuantitas';
                        kuantitasItemContainer.innerHTML = '';
                    }
                } else {
                    namaSelectElement.clearChoices();
                    namaSelectElement.setChoices([{
                        value: '',
                        label: 'Pilih Nama...',
                        selected: true,
                        disabled: true
                    }], 'value', 'label', true);
                }
            });

            // Event listener for Nama selection
            // namaSelectElement.passedElement.addEventListener('change', function() {
            //     const selectedOption = this.querySelector('option:checked');
            //     if (selectedOption) {
            //         const satuan = selectedOption.dataset.satuan;
            //         const harga = selectedOption.dataset.harga;

            //         newDetail.querySelector(`#satuan-${detailCount}`).value = satuan;
            //         newDetail.querySelector(`#harga-${detailCount}`).value = harga;
            //     }
            // });
            // Event listener for Nama selection
            namaSelectElement.passedElement.element.addEventListener('change', function() {
                const selectedOption = namaSelectElement.getValue(true); // Get selected value (ID)
                const selectedItem = namaSelectElement.getValue(
                    true); // Get selected item with custom properties

                if (selectedItem) {
                    const selectedOptionElement = namaSelectElement._currentState.items.find(item => item
                        .value == selectedOption);

                    const satuan = selectedOptionElement.customProperties.satuan;
                    const harga = selectedOptionElement.customProperties.harga;

                    newDetail.querySelector(`#satuan-${detailCount}`).value = satuan;
                    newDetail.querySelector(`#harga-${detailCount}`).value = harga;
                }
            });

            // Set initial state for new card
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
{{-- @push('script')
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
                                <select class="choices form-select tipe-select" name="details[${detailCount}][tipe]" id="tipe-${detailCount}">
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
                                <select id="nama-${detailCount}" class="choices form-select nama-select" name="details[${detailCount}][nama]" >
                                    <option selected disabled value="">{{ __('Pilih Nama...') }}</option>
                                </select>
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
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="satuan_id-${detailCount}">Satuan</label>
                                <input type="text" id="satuan-${detailCount}" class="form-control satuan" name="details[${detailCount}][satuan]" readonly>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="harga-${detailCount}" id="label-harga-${detailCount}">Harga per Satuan</label>
                                <input type="number" id="harga-${detailCount}" class="form-control harga" name="details[${detailCount}][harga]" readonly>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="kuantitas-${detailCount}" id="label-JumlahKuantitas-${detailCount}">Jumlah Kuantitas</label>
                                <input type="number" id="kuantitas-${detailCount}" class="form-control" placeholder="" name="details[${detailCount}][kuantitas]">
                            </div>
                        </div>
                        <div class="col-md-3 col-12" id="kuantitas-item-container-${detailCount}"></div>
                    </div>
                </div>
            </div>
        `;

            document.getElementById('additional-details').appendChild(newDetail);

            // Initialize Choices.js for Tipe and Nama dropdowns
            const tipeSelectElement = document.querySelector(`#tipe-${detailCount}`);
            const namaSelectElement = document.querySelector(`#nama-${detailCount}`);
            new Choices(tipeSelectElement);
            new Choices(namaSelectElement);

            const tipeSelect = newDetail.querySelector('.tipe-select');
            const namaSelect = newDetail.querySelector('.nama-select');

            // Event listener for Tipe selection
            tipeSelect.addEventListener('change', function() {
                const tipe = this.value;
                const kuantitasItemContainer = document.getElementById(
                    `kuantitas-item-container-${detailCount}`);
                const hargaLabel = newDetail.querySelector(`#label-harga-${detailCount}`);
                const JumlahKuantitasLabel = newDetail.querySelector(
                    `#label-JumlahKuantitas-${detailCount}`);

                if (tipe) {
                    namaSelect.disabled = false;
                    namaSelect.innerHTML =
                        '<option selected disabled value="">{{ __('Pilih Namaaaaa...') }}</option>';

                    fetch(`/get-nama-by-tipe/${tipe}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            data.forEach(item => {
                                namaSelect.innerHTML +=
                                    data.forEach(item => {
                                        namaSelect.innerHTML +=
                                            `<option value="${item.id}" data-satuan="${item.satuan}" data-harga="${item.harga}">${item.nama}</option>`;
                                    });
                            });

                            // Ensure dropdown Nama is enabled after populating
                            namaSelect.disabled = false;
                        })
                        .catch(error => console.error('Error:', error));

                    // Adjust fields based on Tipe
                    if (tipe == "2" || tipe == "3") {
                        if (tipe == "2") {
                            hargaLabel.textContent = 'Upah Tiap Satuan Dalam Rupiah';
                            JumlahKuantitasLabel.textContent = 'Jumlah Pekerja';
                        } else if (tipe == "3") {
                            hargaLabel.textContent = 'Harga Tiap Satuan Dalam Rupiah';
                            JumlahKuantitasLabel.textContent = 'Jumlah Alat';
                        }

                        if (!kuantitasItemContainer.innerHTML) {
                            kuantitasItemContainer.innerHTML = `
                            <div class="form-group">
                                <label for="kuantitas_item-${detailCount}" id="label-kuantitasItem-${detailCount}">Jumlah Kuantitas Item</label>
                                <input type="number" id="kuantitas_item-${detailCount}" class="form-control" placeholder="" name="details[${detailCount}][kuantitas_item]">
                            </div>`;
                        }
                        const KuantitasItemLabel = newDetail.querySelector(
                            `#label-kuantitasItem-${detailCount}`);
                        if (tipe == "2") {
                            KuantitasItemLabel.textContent = 'Jumlah Hari';
                        } else if (tipe == "3") {
                            KuantitasItemLabel.textContent = 'Jumlah Berdasarkan Satuan';
                        }
                    } else {
                        hargaLabel.textContent = 'Harga Tiap Satuan Dalam Rupiah';
                        JumlahKuantitasLabel.textContent = 'Jumlah Kuantitas';
                        kuantitasItemContainer.innerHTML = '';
                    }
                } else {
                    namaSelect.disabled = true;
                }
            });

            // Event listener for Nama selection
            namaSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const satuan = selectedOption.getAttribute('data-satuan');
                const harga = selectedOption.getAttribute('data-harga');

                newDetail.querySelector(`#satuan-${detailCount}`).value = satuan;
                newDetail.querySelector(`#harga-${detailCount}`).value = harga;
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
@endpush --}}
{{-- @push('script')
    <script>
        document.getElementById('add-detail-button').addEventListener('click', function() {
            const card = document.createElement('div');
            card.className = 'card';
            card.innerHTML = `
            <div class="card-content" style="border: 4px solid #ddd; margin-top: 10px">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="tipe">Tipe</label>
                    <select class="form-control tipe" name="tipe[]">
                        <option value="">Pilih Tipe</option>
                        <option value="1">Bahan</option>
                        <option value="2">Upah</option>
                        <option value="3">Alat</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nama">Nama</label>
                    <select class="form-control nama" name="nama[]" disabled>
                        <option value="">Pilih Nama</option>
                        <!-- Nama akan diisi dinamis berdasarkan tipe -->
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="satuan">Satuan</label>
                    <input type="text" class="form-control satuan" name="satuan[]" readonly>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="harga">Harga per Satuan</label>
                    <input type="text" class="form-control harga" name="harga[]" readonly>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control jumlah" name="jumlah[]">
                </div>
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="button" class="btn btn-danger delete-icon">Hapus</button>
                </div>
            </div>
        </div>
        </div>
    `;

            document.getElementById('additional-details').appendChild(card);

            // Event listener untuk menghapus card
            card.querySelector('.delete-icon').addEventListener('click', function() {
                card.remove();
            });

            // Event listener untuk dropdown tipe
            card.querySelector('.tipe').addEventListener('change', function() {
                const tipe = this.value;
                const namaDropdown = card.querySelector('.nama');
                namaDropdown.disabled = false;
                namaDropdown.innerHTML = '<option value="">Pilih Nama</option>';

                if (tipe) {
                    // AJAX request untuk mendapatkan nama berdasarkan tipe
                    fetch(`/get-nama-by-tipe/${tipe}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(item => {
                                namaDropdown.innerHTML +=
                                    `<option value="${item.id}" data-satuan="${item.satuan}" data-harga="${item.harga}">${item.nama}</option>`;
                            });
                        });
                }
            });

            // Event listener untuk dropdown nama
            card.querySelector('.nama').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const satuan = selectedOption.getAttribute('data-satuan');
                const harga = selectedOption.getAttribute('data-harga');

                card.querySelector('.satuan').value = satuan;
                card.querySelector('.harga').value = harga;
            });
        });
    </script>
@endpush --}}
