<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
        @yield('page-content')
    </div>

    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-xs-12">
                    <div class="right-text-content">
                        <ul class="social-icons">
                            <li><a href="https://web.facebook.com/rahathosenmanik/"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="https://twitter.com/rahathosenmanik"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.linkedin.com/in/rahathossenmanik/"><i
                                        class="fa fa-linkedin"></i></a></li>
                            <li><a href="https://www.instagram.com/rahathossenmanik/?hl=en"><i
                                        class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    {{-- <div class="logo">
                        <a href="{{ url('home') }}"><img class="max-w-[170px] max-h-[50px]" src="{{ asset('assets/images/logos/leaves.jpg') }}"
                                alt=""></a>
                    </div> --}}
                </div>
                <div class="col-lg-4 col-xs-12">
                    <div class="left-text-content">
                        <p>© Copyright Taneyan Jamu
                            <br>Since 2025
                        </p>
                        <p>© Credit for templates:
                            <br><a href="https://github.com/SajeebChakraborty">SajeebChakraborty</a>
                            <br><a
                                href="https://github.com/SajeebChakraborty/Restaurant_Ecommerce_System_Laravel/tree/master">Midway
                                Dine 2022</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    @include('partials.script-bottom')
</body>

</html>
