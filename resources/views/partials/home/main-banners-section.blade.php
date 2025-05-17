    <!-- ***** Main Banner Area Start ***** -->
    <div id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="left-content">
                        <div class="inner-content">
                            <h3>Taneyan Jamu</h3>
                            <h4>Madura</h4>
                            <div class="main-white-button scroll-to-section">
                                <a href="#">
                                    <h2>Pesan Jamu</h2>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="main-banner header-text">
                        <div class="Modern-Slider">

                            @foreach ($banners as $banner)
                                <!-- Item -->
                                <div class="item">
                                    <div class="img-fill">
                                        <img src="{{ asset('assets/images/banners/' . $banner) }}" alt="">
                                    </div>
                                </div>
                            @endforeach
                            <!-- // Item -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->
