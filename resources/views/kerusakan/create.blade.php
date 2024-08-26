@extends('layouts.main')
<style>
    .row {
        margin-bottom: 20px;
    }

    #quill-deskripsi {
        width: 100% !important;
        height: 20px !important;
        min-height: 150px;
        /* Sesuaikan dengan tinggi minimal yang Anda inginkan */
        box-sizing: border-box;
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
                                    <th>Lokasi </th>
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
                                    <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="first-name-column">Tipe Bangunan</label>
                                            <select class="choices form-select" name="kategori_bangunan_id" required>
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
                                    <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="company-column">Deskripsi</label>
                                            <div id="quill-deskripsi" style="width: 100%;"></div>
                                            <input type="hidden" id="deskripsi" name="deskripsi">
                                        </div>
                                    </div>
                                </div>
                                <div id="additional-details"></div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="button" id="add-detail-btn" class="btn btn-primary">Tambah
                                        Detail</button>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-secondary mr-1 mb-1 mt-2">Submit</button>
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
    <script src="{{ asset('frontend/dist/assets/vendors/quill/quill.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function initializeQuill(selector) {
                return new Quill(selector, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{
                                font: []
                            }, {
                                size: []
                            }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{
                                color: []
                            }, {
                                background: []
                            }],
                            [{
                                script: 'super'
                            }, {
                                script: 'sub'
                            }],
                            [{
                                list: 'ordered'
                            }, {
                                list: 'bullet'
                            }, {
                                indent: '-1'
                            }, {
                                indent: '+1'
                            }],
                            ['direction', {
                                align: []
                            }],
                            // ['link', 'image', 'video'],
                            ['clean']
                        ]
                    }
                });
            }

            // Inisialisasi Quill untuk masing-masing editor
            const descriptionEditor = initializeQuill('#quill-deskripsi');
            const notesEditor = initializeQuill('#full-nama');

            // Mengatur nilai hidden input saat form disubmit
            document.querySelector('form').onsubmit = function() {
                document.querySelector('#deskripsi').value = descriptionEditor.root.innerHTML;
                document.querySelector('#nama').value = notesEditor.root.innerHTML;

                console.log('satuan:', descriptionEditor.root.innerHTML);
                console.log('Catatan:', notesEditor.root.innerHTML);
            };
        });
    </script>
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
                                <select class="choices form-select tipe-select" name="details[${detailCount}][tipe]" id="tipe-${detailCount}" required>
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
                                <input type="text" id="harga-${detailCount}" class="form-control harga" name="details[${detailCount}][harga]" readonly>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="kuantitas-${detailCount}" id="label-JumlahKuantitas-${detailCount}">Jumlah Kuantitas</label>
                                <input type="text" id="kuantitas-${detailCount}" class="form-control" name="details[${detailCount}][kuantitas]" required>
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

                    if (tipe == "2") {
                        if (tipe == "2") {
                            hargaLabel.textContent = 'Upah Tiap Satuan Dalam Rupiah';
                            JumlahKuantitasLabel.textContent = 'Kuantias Berdasarkan Satuan';
                        } else if (tipe == "3") {
                            hargaLabel.textContent = 'Harga Tiap Satuan Dalam Rupiah';
                            JumlahKuantitasLabel.textContent = 'Jumlah Alat';
                        }

                        if (!kuantitasItemContainer.innerHTML) {
                            kuantitasItemContainer.innerHTML = `
                            <div class="form-group">
                                <label for="kuantitas_item-${detailCount}" id="label-kuantitasItem-${detailCount}">Jumlah Kuantitas Item</label>
                                <input type="number" id="kuantitas_item-${detailCount}" class="form-control" name="details[${detailCount}][kuantitas_item]" required>
                            </div>
                        `;
                        }

                        const KuantitasItemLabel = newDetail.querySelector(
                            `#label-kuantitasItem-${detailCount}`);
                        KuantitasItemLabel.textContent = tipe == "2" ? 'Jumlah Pekerja' :
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
        document.getElementById(`kuantitas-${detailCount}`).addEventListener('blur', function(e) {
            let value = this.value.replace(',', '.');
            if (!isNaN(value) && parseFloat(value) === Number(value)) {
                this.value = parseFloat(value).toFixed(
                    2); // Convert to a number with two decimal places
            } else {
                alert("Please enter a valid value.");
            }
        });
    </script>
@endpush
