    <!-- ***** Main Banner Area Start ***** -->
    <div id="top" style="padding-top: 0; margin-top: 0;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="left-content">
                        <div class="inner-content">
                            <h3>- Produk Jamu Khas Madura -</h3>
                            <h4>Taneyan Jamu</h4>
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

                            @for ($i = 1; $i <= 4; $i++)
                                @php
                                    $banner = 'slide-' . str_pad($i, 2, '0', STR_PAD_LEFT) . '.jpg';
                                @endphp
                                <!-- Item -->
                                <div class="item">
                                    <div class="img-fill">
                                        <img class="w-full h-full object-cover object-center block"
                                            src="{{ asset('assets/images/banners/' . $banner) }}" alt="">
                                    </div>
                                </div>
                            @endfor
                            <!-- // Item -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->
