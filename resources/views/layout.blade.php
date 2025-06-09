<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Taneyan Jamu</title>

    @include('partials.head-link')
</head>

<body ng-app="">

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Navigation Bar ***** -->
    @include('partials.layouts-partials.navbar-beranda')


    <div style="min-height:750px">
        {{-- @include('components.flowbite-alert') --}}
        @yield('page-content')
    </div>

    <!-- ***** Footer Start ***** -->
    @include('partials.layouts-partials.footer-beranda')


    @include('partials.script-bottom')
</body>

</html>
