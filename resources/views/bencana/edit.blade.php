@extends('layouts.main')
<style>
    .row {
        margin-bottom: 20px;
    }

    /* Adjust the width of the Quill editor */
    .ql-container {
        width: 100% !important;
        /* or specify a fixed width like 300px */
        max-width: 100%;
        height: 300px !important;
        /* ensures it doesn't exceed its container's width */
    }

    .background {
        position: fixed;
        /* atau 'absolute', tergantung kebutuhan */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Warna gelap dengan transparansi */
        z-index: 1;
        /* Pastikan lebih tinggi dari elemen lain kecuali modal */
    }

    .overlay {
        z-index: 2;
        /* Pastikan lebih tinggi dari elemen lain kecuali modal */
    }

    img {
        display: block;
        max-width: 100%;
    }

    .image-container {
        overflow: hidden;
        max-width: 510px !important;
        max-height: 370px !important;
    }

    .preview {
        display: none;
    }

    @media (min-width: 768px) {

        /* Adjust the large (lg) screen breakpoint */
        .modal-lg {
            --bs-modal-width: 700px;
            /* Set your desired minimum width for large screens (lg) */
        }

        .preview {
            display: block;
            overflow: hidden;
            width: 210px;
            height: 210px;
            border: 1px solid red;
        }
    }

    .select2-container .select2-selection--single {
        height: 38px !important;
        /* Atur tinggi sesuai kebutuhan */
        display: flex;
        align-items: center;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px !important;
        /* Sesuaikan dengan tinggi yang diatur */
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px !important;
        /* Sesuaikan dengan tinggi yang diatur - 2px untuk padding */
    }

    .select2-container .select2-dropdown .select2-results__options {
        max-height: 220px;
        /* Atur tinggi maksimum sesuai kebutuhan */
    }
</style>
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Data Bencana</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('bencana.update', ['id' => $bencana->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Kategori Bencana</label>
                                            <div class="form-group">
                                                <select class="choices form-select" name="kategori_bencana_id">
                                                    <option selected disabled value="">{{ __('Pilih...') }}</option>
                                                    @foreach ($kategoribencana as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ (old('kategori_bencana_id') ?? $bencana->kategori_bencana_id) == $item->id ? 'selected' : '' }}>
                                                            {{ $item->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Tanggal Bencana</label>
                                            <input type="date" id="last-name-column" class="form-control" placeholder=""
                                                name="tanggal" value="{{ $bencana->tanggal }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    {{-- <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="kecamatan">Kecamatan</label>
                                            <select class="choices form-select" name="kecamatan_id" id="kecamatan">
                                                <option disabled value="">{{ __('Pilih...') }}</option>
                                                @foreach ($kecamatan as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $bencana->kecamatan_id ? 'selected' : '' }}>
                                                        {{ $item->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Desa</label>
                                            <div class="form-group">
                                                <select id="desa" multiple="multiple-remove" name="desa_ids[]">
                                                    <!-- Options will be populated by JavaScript -->
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column">Lattitude</label>
                                                <input type="number" id="last-name-column" class="form-control"
                                                    placeholder="" name="latitude" step="0.00000001"
                                                    value="{{ $bencana->latitude }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column">longitude</label>
                                                <input type="number" id="last-name-column" class="form-control"
                                                    placeholder="" name="longitude" step="0.00000001"
                                                    value="{{ $bencana->longitude }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="company-column">Deskripsi</label>
                                                <div id="full"></div>
                                                <input type="hidden" name="deskripsi" id="deskripsi">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="card-header pb-4 border-dashed rounded"
                                                            style="border: 1px dashed rgb(94, 87, 87);">
                                                            <div
                                                                class="profile-img-edit position-relative d-flex justify-content-center align-items-center">
                                                                <img src="{{ asset('/frontend/dist/assets/images/avatar/' . $bencana->gambar) }}"
                                                                    id="firstImage" alt="profile-pic"
                                                                    class="theme-color-default-img profile-pic rounded avatar-100">
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="croppedImageData" name="avatar">
                                                        <div class="img-extension mt-3">
                                                            <div class="row">
                                                                <div>
                                                                    <div class="d-inline-block align-items-center py-1">
                                                                        <span>Only</span>
                                                                        <a href="#">.jpg</a>
                                                                        <a href="#">.png</a>
                                                                        <a href="#">.jpeg</a>
                                                                        <span>allowed</span>
                                                                    </div>
                                                                    <div class="d-inline-block align-items-center">
                                                                        <span>Max. File size</span>
                                                                        <a href="#">10 MB</a>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <button type="button" id="chooseImageButton">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="2rem" height="2rem"
                                                                            viewBox="0 0 24 24">
                                                                            <path fill="#5A8DEE"
                                                                                d="M11 16V7.85l-2.6 2.6L7 9l5-5l5 5l-1.4 1.45l-2.6-2.6V16zm-5 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z" />
                                                                        </svg>
                                                                        <input type="file" name="image" class="image"
                                                                            id="imageInput" style="display: none;">
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal for image preview and cropping -->
            <div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Crop Image</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="docs-demo">
                                        <div class="image-container">
                                            <img id="image" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 px-0">
                                    <div class="preview"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="crop">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        var bs_modal = $('#modal');
        var image = document.getElementById('image');
        var cropper, reader, file;

        $("body").on("change", ".image", function(e) {
            var files = e.target.files;
            var maxFileSizeInBytes = 10 * 1024 * 1024;
            var allowedExtensions = ['jpg', 'jpeg', 'png'];

            if (files && files.length > 0) {
                file = files[0];

                var fileExtension = file.name.split('.').pop().toLowerCase();

                if (!allowedExtensions.includes(fileExtension)) {
                    // Display an error message
                    alert("Only .jpg, .jpeg, and .png files are allowed.");

                    // Optionally, clear the file input
                    $(this).val('');
                    return; // Exit the function early
                }

                if (file.size > maxFileSizeInBytes) {
                    // Display an error message
                    alert("File size exceeds the maximum allowed size.");

                    // Optionally, clear the file input
                    $(this).val('');
                    return; // Exit the function early
                }


                var done = function(url) {
                    image.src = url;
                    bs_modal.modal('show');
                };


                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
            // Reset the value of the file input to trigger change event even if the same file is selected again
            $(this).val('');
        });

        bs_modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1,
                dragMode: 'move',
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 300, // Lebar canvas yang diinginkan
                height: 300 // Tinggi canvas yang diinginkan
            });
            var croppedImage = canvas.toDataURL(); // Get the cropped image as base64 data URL
            $("#firstImage").attr("src",
                croppedImage); // Set the src attribute of the image element on the main page
            $("#croppedImageData").val(
                croppedImage); // Set the cropped image data to a hidden input field in the form
            bs_modal.modal('hide'); // Close the modal
            // $("#mainPage").show(); // Show the submit button on the main page
        });

        document.getElementById('chooseImageButton').addEventListener('click', function() {
            document.getElementById('imageInput').click();
        })
    </script>
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
                            ['link', 'image', 'video'],
                            ['clean']
                        ]
                    }
                });
            }

            // Inisialisasi Quill untuk masing-masing editor
            const descriptionEditor = initializeQuill('#full');
            const notesEditor = initializeQuill('#full-nama');
            descriptionEditor.root.innerHTML = `{!! $bencana->deskripsi !!}`;
            // Mengatur nilai hidden input saat form disubmit
            document.querySelector('form').onsubmit = function() {
                document.querySelector('#deskripsi').value = descriptionEditor.root.innerHTML;
                document.querySelector('#nama').value = notesEditor.root.innerHTML;

                console.log('satuan:', descriptionEditor.root.innerHTML);
                console.log('Catatan:', notesEditor.root.innerHTML);
            };
        });
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Choices for Kecamatan
            var choicesKecamatan = new Choices('#kecamatan');

            // Initialize Choices for Desa with multiple selection
            var choicesDesa = new Choices('#desa', {
                removeItemButton: true,
                maxItemCount: -1, // Unlimited items
                placeholder: true,
                placeholderValue: 'Select Desa...',
                searchResultLimit: 5,
                renderChoiceLimit: 5
            });

            // Event listener for Kecamatan change
            document.getElementById('kecamatan').addEventListener('change', function() {
                var kecamatanId = this.value;

                if (kecamatanId) {
                    fetch(`/bencana/get-desa/${kecamatanId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Clear previous options
                            choicesDesa.clearStore();

                            // Add new options
                            choicesDesa.setChoices(
                                data.desaTerkait.map(desa => ({
                                    value: desa.id,
                                    label: desa.nama,
                                    selected: false,
                                    disabled: false
                                })),
                                'value',
                                'label',
                                false
                            );
                        })
                        .catch(error => console.error('Error fetching desa:', error));
                } else {
                    // Clear options if no Kecamatan is selected
                    choicesDesa.clearStore();
                }
            });
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var choicesKecamatan = new Choices('#kecamatan');
            var choicesDesa = new Choices('#desa', {
                removeItemButton: true,
                maxItemCount: -1, // Unlimited items
                placeholder: true,
                placeholderValue: 'Select Desa...',
                searchResultLimit: 5,
                renderChoiceLimit: 5
            });

            var selectedDesaIds = @json($selectedDesaIds); // Desa yang sudah terpilih

            // Load desa options pada halaman load
            function loadInitialDesa(kecamatanId, selectedDesaIds) {
                if (kecamatanId) {
                    fetch(`/bencana/get-desa/${kecamatanId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Clear previous options
                            choicesDesa.clearStore();

                            // Add new options and select previously selected ones
                            choicesDesa.setChoices(
                                data.desaTerkait.map(desa => ({
                                    value: desa.id,
                                    label: desa.nama,
                                    selected: selectedDesaIds.includes(desa.id.toString()),
                                    disabled: false
                                })),
                                'value',
                                'label',
                                false
                            );
                        })
                        .catch(error => console.error('Error fetching desa:', error));
                }
            }

            var kecamatanId = document.getElementById('kecamatan').value;
            loadInitialDesa(kecamatanId, selectedDesaIds);

            // Event listener for Kecamatan change
            document.getElementById('kecamatan').addEventListener('change', function() {
                var kecamatanId = this.value;
                choicesDesa.clearStore();

                if (kecamatanId) {
                    fetch(`/bencana/get-desa/${kecamatanId}`)
                        .then(response => response.json())
                        .then(data => {
                            choicesDesa.setChoices(
                                data.desaTerkait.map(desa => ({
                                    value: desa.id,
                                    label: desa.nama,
                                    selected: false,
                                    disabled: false
                                })),
                                'value',
                                'label',
                                false
                            );
                        })
                        .catch(error => console.error('Error fetching desa:', error));
                }
            });
        });
    </script>
@endpush
