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
                                    <th>Ref</th>
                                    <th>Bencana</th>
                                    <th>Lokasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $bencana->Ref }}</td>
                                    <td>{{ $kerusakan->Ref }}</td>
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
                    <form class="form" id="kerusakan-form" action="{{ route('kerusakan.update', $kerusakan->id) }}"
                        method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Update Data Kerusakan</h4>
                            <div>
                                <button class="btn btn-danger">Petunjuk Penggunaan</button>
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
                                                        {{ (old('kategori_bangunan_id') ?? $kerusakan->kategori_bangunan_id) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="company-column">Deskripsi</label>
                                            <div id="quill-deskripsi" style="width: 100%;"></div>
                                            <input type="hidden" id="deskripsi" name="deskripsi">
                                        </div>
                                    </div>
                                </div>
                                @foreach ($kerusakan->detail as $details)
                                    <input type="hidden" name="details[{{ $loop->index }}][id]"
                                        value="{{ $details->id }}">
                                    <div class="card-content" style="border: 4px solid #ddd; margin-top: 10px">
                                        <div class="card-body">
                                            @if ($details->hsd->tipe == 1)
                                                <!-- Bahan -->
                                                <div class="row">
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="tipe-{{ $loop->index }}">Tipe</label>
                                                            <input type="text" id="tipe-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][tipe]" readonly
                                                                value="Bahan">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="nama-{{ $loop->index }}">Nama</label>
                                                            <input type="text" id="nama-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][nama]"
                                                                value="{{ $details->hsd->nama }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="satuan_id-{{ $loop->index }}">Satuan</label>
                                                            <input type="text" id="satuan-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][satuan]"
                                                                value="{{ $details->hsd->satuan }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="harga-{{ $loop->index }}">Harga Tiap
                                                                Satuan</label>
                                                            <input type="text" id="harga-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][harga]"
                                                                value="{{ 'Rp ' . number_format($details->hsd->harga, 2, ',', '.') }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="kuantitas-{{ $loop->index }}">Jumlah
                                                                Kuantitas</label>
                                                            <input type="text" id="kuantitas-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][kuantitas]"
                                                                value="{{ $details->kuantitas_per_satuan }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($details->hsd->tipe == 2)
                                                <!-- Upah -->
                                                <div class="row">
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="tipe-{{ $loop->index }}">Tipe</label>
                                                            <input type="text" id="tipe-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][tipe]" readonly
                                                                value="Upah">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="nama-{{ $loop->index }}">Nama</label>
                                                            <input type="text" id="nama-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][nama]"
                                                                value="{{ $details->hsd->nama }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="satuan_id-{{ $loop->index }}">Satuan</label>
                                                            <input type="text" id="satuan-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][satuan]"
                                                                value="{{ $details->hsd->satuan }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="upah-{{ $loop->index }}">Upah Tiap Satuan</label>
                                                            <input type="text" id="harga-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][harga]"
                                                                value="{{ 'Rp ' . number_format($details->hsd->harga, 2, ',', '.') }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="jumlah_hari-{{ $loop->index }}">Kuantias
                                                                Berdasarkan Satuan</label>
                                                            <input type="number" id="jumlah_hari-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][kuantitas]"
                                                                value="{{ $details->kuantitas_per_satuan }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="jumlah_pekerja-{{ $loop->index }}">Jumlah
                                                                Pekerja</label>
                                                            <input type="text" id="kuantitas-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][kuantitas_item]"
                                                                value="{{ $details->kuantitas_item }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($details->hsd->tipe == 3)
                                                <!-- Alat -->
                                                <div class="row">
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="tipe-{{ $loop->index }}">Tipe</label>
                                                            <input type="text" id="tipe-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][tipe]" readonly
                                                                value="Alat">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="nama-{{ $loop->index }}">Nama</label>
                                                            <input type="text" id="nama-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][nama]"
                                                                value="{{ $details->hsd->nama }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="satuan_id-{{ $loop->index }}">Satuan</label>
                                                            <input type="text" id="satuan-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][satuan]"
                                                                value="{{ $details->hsd->satuan }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="harga-{{ $loop->index }}">Harga Tiap
                                                                Satuan</label>
                                                            <input type="text" id="harga-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][harga]"
                                                                value="{{ 'Rp ' . number_format($details->hsd->harga, 2, ',', '.') }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="form-group">
                                                            <label for="jumlah_alat-{{ $loop->index }}">Kuantias</label>
                                                            <input type="number" id="jumlah_hari-{{ $loop->index }}"
                                                                class="form-control"
                                                                name="details[{{ $loop->index }}][kuantitas]"
                                                                value="{{ $details->kuantitas_per_satuan }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
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
        // document.addEventListener('DOMContentLoaded', function() {
        //     function initializeQuill(selector) {
        //         return new Quill(selector, {
        //             theme: 'snow',
        //             modules: {
        //                 toolbar: [
        //                     [{
        //                         font: []
        //                     }, {
        //                         size: []
        //                     }],
        //                     ['bold', 'italic', 'underline', 'strike'],
        //                     [{
        //                         color: []
        //                     }, {
        //                         background: []
        //                     }],
        //                     [{
        //                         script: 'super'
        //                     }, {
        //                         script: 'sub'
        //                     }],
        //                     [{
        //                         list: 'ordered'
        //                     }, {
        //                         list: 'bullet'
        //                     }, {
        //                         indent: '-1'
        //                     }, {
        //                         indent: '+1'
        //                     }],
        //                     ['direction', {
        //                         align: []
        //                     }],
        //                     // ['link', 'image', 'video'],
        //                     ['clean']
        //                 ]
        //             }
        //         });
        //     }

        //     // Inisialisasi Quill untuk masing-masing editor
        //     const descriptionEditor = initializeQuill('#quill-deskripsi');
        //     const notesEditor = initializeQuill('#full-nama');

        //     // Mengatur nilai hidden input saat form disubmit
        //     document.querySelector('form').onsubmit = function() {
        //         document.querySelector('#deskripsi').value = descriptionEditor.root.innerHTML;
        //         document.querySelector('#nama').value = notesEditor.root.innerHTML;

        //         console.log('satuan:', descriptionEditor.root.innerHTML);
        //         console.log('Catatan:', notesEditor.root.innerHTML);
        //     };
        // });
        document.addEventListener('DOMContentLoaded', function() {
            const descriptionEditor = new Quill('#quill-deskripsi', {
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
                        ['clean']
                    ]
                }
            });

            // Mengisi editor dengan data dari database
            descriptionEditor.root.innerHTML = `{!! $kerusakan->deskripsi !!}`;

            // Mengatur nilai hidden input saat form disubmit
            document.querySelector('form').onsubmit = function() {
                document.querySelector('#deskripsi').value = descriptionEditor.root.innerHTML;
            };
        });
    </script>
@endpush
