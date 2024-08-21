@extends('layouts.main')

@section('content')
<form action="{{ route('hsd.bahan.store') }}" method="POST">
    @csrf
    <div class="modal-body">
        <label>Nama: </label>
        <div class="form-group">
            <input type="text" id="nama" placeholder="" class="form-control" name="nama" required>
        </div>
        <label>Deskripsi: </label>
        <div class="form-group">
            <div id="full"></div>
            <input type="hidden" name="deskripsi" id="deskripsi">
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

<script src="{{ asset('frontend/dist/assets/vendors/quill/quill.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi Quill editor
        const quill = new Quill("#full", {
            bounds: "#full-container .editor",
            modules: {
                toolbar: [
                    [{
                        font: []
                    }, {
                        size: []
                    }],
                    ["bold", "italic", "underline", "strike"],
                    [{
                            color: []
                        },
                        {
                            background: []
                        }
                    ],
                    [{
                            script: "super"
                        },
                        {
                            script: "sub"
                        }
                    ],
                    [{
                            list: "ordered"
                        },
                        {
                            list: "bullet"
                        },
                        {
                            indent: "-1"
                        },
                        {
                            indent: "+1"
                        }
                    ],
                    ["direction", {
                        align: []
                    }],
                    ["link", "image", "video"],
                    ["clean"]
                ]
            },
            theme: "snow"
        })

        document.querySelector('form').onsubmit = function() {
            // Ambil data HTML dari Quill
            const deskripsi = quill.root.innerHTML;

            // Simpan data ke input hidden sebelum form disubmit
            document.querySelector('#deskripsi').value = deskripsi;

            console.log(deskripsi); // Debug untuk memastikan data tidak null
        };
    });
</script>
@endsection