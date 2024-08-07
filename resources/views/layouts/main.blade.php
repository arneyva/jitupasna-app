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
    @stack('script')
</body>

</html>
