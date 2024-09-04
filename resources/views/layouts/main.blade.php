<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JITUPASNA</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/vendors/chartjs/Chart.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('frontend/dist/assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/vendors/choices.js/choices.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/vendors/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/vendors/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />

    <!-- Custom styles that might be added from other views -->
    @stack('style')
</head>

<body>
    <!-- Disclaimer Modal -->
    <div class="modal fade" id="disclaimerModal" tabindex="-1" aria-labelledby="disclaimerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="disclaimerModalLabel">Disclaimer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Website ini sedang dalam proses penyusunan. Isi dalam web ini hanya sebagai contoh uji coba
                        Jitupasna.
                    </p>
                    <p>
                        Data - Data seperti kejadian bencana, kerusakan dampak bencana, dan data lain terkait bencana
                        merupakan data contoh dan bukan merupakan data yang sebenarnya.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="app">
        @include('layouts.sidebar')
        <div id="main">
            @include('layouts.navbar')
            <div class="main-content container-fluid">
                @yield('content')
            </div>
            {{-- @include('layouts.footer') --}}
        </div>
    </div>

    <!-- jQuery should be loaded before Bootstrap and any script that uses it -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS (depends on jQuery) -->
    <script src="{{ asset('frontend/dist/assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/js/app.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/js/main.js') }}"></script>

    <!-- Cropper.js (depends on jQuery and Bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

    <!-- Include Choices.js -->
    <script src="{{ asset('frontend/dist/assets/vendors/choices.js/choices.min.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Session and Error Handling Scripts -->
    <script>
        @if (session('success'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    popup: 'my-custom-swal'
                },
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
        @endif
        @if ($errors->any())
            let errors = {!! json_encode($errors->all()) !!};
            let errorList = '<ol>' + errors.map(function(error) {
                return '<li style="text-align: start">' + error + '</li>';
            }).join('') + '</ol>';

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: errorList,
            });
        @endif
        @if (session('warning'))
            let error = '{{ session('warning') }}';
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error,
            });
        @endif
        @if (session('error'))
            let error = '{{ session('error') }}';
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error,
            });
        @endif
    </script>
    <script>
        $(document).ready(function() {
            // Show the disclaimer modal on page load
            $('#disclaimerModal').modal('show');
        });
    </script>
    <!-- Additional scripts that might be added from other views -->
    @stack('script')
</body>

</html>
