@extends('layouts.main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
<style>
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
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <div>
                                <img id="image-preview" src="path/to/default/image.jpg" alt="Default Image"
                                    class="img-fluid">
                                <button type="button" class="btn btn-primary mt-2" data-toggle="modal"
                                    data-target="#imageModal">
                                    Upload Image
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel">Crop Image</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="img-container">
                                        <img id="image-to-crop" src="">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary" id="save-changes">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Modal for image preview and cropping -->


            </div>
    </section>
@endsection
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script>
        
    </script>
@endpush
