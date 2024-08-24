@extends('layouts.main')

@section('content')
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Harga Satuan Dasar</h4>
                    <div>
                        <button class="btn btn-danger" type="button" data-toggle="modal"
                            data-target="#FormUntukUpdate">Filter</button>
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#inlineForm">
                            Tambah Data
                        </button>
                    </div>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Tipe</th>
                                    <th>Nama</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hsd as $item)
                                    <tr>
                                        @if ($item->tipe == 1)
                                            <td><span class="badge bg-danger">Bahan</span></td>
                                        @elseif ($item->tipe == 2)
                                            <td><span class="badge bg-success">Upah</span></td>
                                        @elseif ($item->tipe == 3)
                                            <td><span class="badge bg-warning">Alat</span></td>
                                        @endif
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->satuan }}</td>
                                        <td>{{ 'Rp ' . number_format($item->harga, 2, ',', '.') }}</td>

                                        <td>Aksi</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="bd-example" style="margin-left: 10px; margin-top:10px; margin-right:10px">
                            {{ $hsd->links() }}
                        </div>
                    </div>
                </div>
                <!--login form Modal -->
                <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Form Kategori Bangunan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form action="#" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <label>Nama: </label>
                                    <div class="form-group">
                                        <select class="choices form-select" name="tipe" id="">
                                            <option value="1">Bahan</option>
                                            <option value="2">Upah</option>
                                            <option value="3">Alat</option>
                                        </select>
                                    </div>
                                    <label>Nama: </label>
                                    <div class="form-group">
                                        <div id="full-nama"></div>
                                        <input type="hidden" name="nama" id="nama">
                                    </div>
                                    <label>Satuan: </label>
                                    <div class="form-group">
                                        <div id="full"></div>
                                        <input type="hidden" name="satuan" id="satuan">
                                    </div>
                                    <label>Harga: </label>
                                    <div class="form-group">
                                        <input type="text" id="harga" placeholder="Masukkan harga"
                                            class="form-control">
                                        <input type="hidden" name="harga" id="harga-hidden">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade text-left" id="FormUntukUpdate" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Filter</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form action="{{ route('hsd.index') }}" method="GET" id="filterForm">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="first-name-column">Cari</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                value="{{ request()->input('nama') }}"
                                                placeholder="masukan nama/satuan ....">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Cari</label>
                                        <div class="form-group">
                                            <select class="form-select" name="tipe" id="tipe">
                                                <option selected disabled value="">{{ __('Pilih...') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" onclick="resetFilters()"
                                        data-dismiss="modal">{{ __('Reset') }}</button>
                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
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
                        // ['direction', {
                        //     align: []
                        // }],
                        // ['link', 'image', 'video'],
                        ['clean']
                    ]
                }
            });
        }

        // Inisialisasi Quill untuk masing-masing editor
        const descriptionEditor = initializeQuill('#full');
        const notesEditor = initializeQuill('#full-nama');

        // Mengatur nilai hidden input saat form disubmit
        document.querySelector('form').onsubmit = function() {
            document.querySelector('#satuan').value = descriptionEditor.root.innerHTML;
            document.querySelector('#nama').value = notesEditor.root.innerHTML;

            console.log('satuan:', descriptionEditor.root.innerHTML);
            console.log('Catatan:', notesEditor.root.innerHTML);
        };
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi Cleave.js untuk input harga
        const cleave = new Cleave('#harga', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            delimiter: '.',
            numeralDecimalMark: ',',
            prefix: 'Rp '
        });

        // Fungsi untuk mengupdate nilai tersembunyi sebelum formulir disubmit
        document.querySelector('form').onsubmit = function() {
            // Ambil nilai yang diformat dari Cleave
            const formattedValue = cleave.getRawValue();

            // Simpan nilai asli (numerik) ke input tersembunyi
            document.querySelector('#harga-hidden').value = formattedValue;

            console.log(formattedValue); // Debug untuk memastikan nilai asli
        };
    });
</script>
