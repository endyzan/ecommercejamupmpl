<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel</title>
    {{-- @if (Auth::user()->usertype != 2)
        <title>Admin Panel</title>
    @endif
    @if (Auth::user()->usertype == 2)
        <title>User Panel</title>
    @endif --}}
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/assets//vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets//vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/assets//vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets//vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets//vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets//vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('admin/assets//css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('admin/assets//images/favicon.png') }}" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
