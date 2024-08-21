<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Voler Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/vendors/chartjs/Chart.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('frontend/dist/assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/vendors/choices.js/choices.min.css') }}" />
</head>

<body>
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
    <script src="{{ asset('frontend/dist/assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/js/app.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/js/main.js') }}"></script>
    <!-- Include Choices JavaScript -->
    <script src="{{ asset('frontend/dist/assets/vendors/choices.js/choices.min.js') }}"></script>
    {{-- sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    @stack('script')
</body>

</html>
