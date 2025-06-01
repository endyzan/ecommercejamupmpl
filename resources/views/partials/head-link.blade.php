<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/logos/leaves.jpg') }}">
<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
    rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">



<!-- Additional CSS Files -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/css-library.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/owl-carousel.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/lightbox.css') }}">

{{-- <script src="{{ asset('assets/js/angular.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/bKash-checkout.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/bKash-checkout-sandbox.js') }}"></script> --}}

<!-- Flowbite -->
<link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
    .fixed-logo {
        bottom: 0 !important;
        left: 0 !important;
        /* z-index: 1000; */
        /* padding-left: 10%; */
    }

    .animation-easeinout {
        transition: all 0.8s ease-in-out !important;
    }

    @media (min-width: 1024px) {
        .centered_navigation_bar {
            padding-right: 10% !important;
        }
    }
</style>
