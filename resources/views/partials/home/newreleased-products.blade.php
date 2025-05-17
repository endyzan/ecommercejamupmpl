<!-- ***** Menu Area Starts ***** -->
<section class="section" id="offers">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 text-center">
                <div class="section-heading">
                    <h6>" PRODUK BARU "</h6>
                    {{-- <h2>  </h2> --}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="row" id="tabs">
                    <div class="col-lg-12">
                        <div class="heading-tabs">
                            <div class="row">
                                <div class="col-lg-6 offset-lg-3">
                                    <ul>

                                        <li><a href='#tabs-1'><img src="{{ asset('assets/images/tab-icon-01.png') }}"
                                                    alt="">Breakfast</a></li>
                                        <li><a href='#tabs-2'><img src="{{ asset('assets/images/tab-icon-02.png') }}"
                                                    alt="">Lunch</a></a></li>
                                        <li><a href='#tabs-3'><img src="{{ asset('assets/images/tab-icon-03.png') }}"
                                                    alt="">Dinner</a></a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="text-align:center;" class="col-lg-12">
                        <section class='tabs-content'>
                            <article id='tabs-1'>
                                <div class="row">

                                    {{-- @foreach ($breakfast as $item)
                                            <?php
                                            
                                            $total_rate = DB::table('rates')->where('product_id', $item->id)->sum('star_value');
                                            
                                            $total_voter = DB::table('rates')->where('product_id', $item->id)->count();
                                            
                                            if ($total_voter > 0) {
                                                $per_rate = $total_rate / $total_voter;
                                            } else {
                                                $per_rate = 0;
                                            }
                                            
                                            $per_rate = number_format($per_rate, 1);
                                            
                                            $whole = floor($per_rate); // 1
                                            $fraction = $per_rate - $whole;
                                            
                                            ?>

                                            @if ($item->id % 2 == 0)
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="left-list">

                                                            <div class="col-lg-12">
                                                                <div class="tab-item">
                                                                    <img src="{{ asset('assets/images/' . $item->image) }}"
                                                                        alt="">
                                                                    <h4>{{ $item->name }}</h4>
                                                                    <p>{{ $item->description }}</p>
                                                                    <div class="price">
                                                                        <h6>৳{{ $item->price }}</h6>
                                                                    </div>
                                                                    <span class="product_rating">
                                                                        @for ($i = 1; $i <= $whole; $i++)
                                                                            <i class="fa fa-star "></i>
                                                                        @endfor

                                                                        @if ($fraction != 0)
                                                                            <i class="fa fa-star-half"></i>
                                                                        @endif


                                                                        <span
                                                                            class="rating_avg">({{ $per_rate }})</span>
                                                                    </span>
                                                                    <br>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach --}}


                                    {{-- @foreach ($breakfast as $item)
                                            <?php
                                            
                                            $total_rate = DB::table('rates')->where('product_id', $item->id)->sum('star_value');
                                            
                                            $total_voter = DB::table('rates')->where('product_id', $item->id)->count();
                                            
                                            if ($total_voter > 0) {
                                                $per_rate = $total_rate / $total_voter;
                                            } else {
                                                $per_rate = 0;
                                            }
                                            
                                            $per_rate = number_format($per_rate, 1);
                                            
                                            $whole = floor($per_rate); // 1
                                            $fraction = $per_rate - $whole;
                                            
                                            ?>

                                            @if ($item->id % 2 != 0)
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="right-list">
                                                            <div class="col-lg-12">
                                                                <div class="tab-item">
                                                                    <img src="{{ asset('assets/images/' . $item->image) }}"
                                                                        alt="">
                                                                    <h4>{{ $item->name }}</h4>
                                                                    <p>{{ $item->description }}</p>
                                                                    <div class="price">
                                                                        <h6>৳{{ $item->price }}</h6>
                                                                    </div>
                                                                    <span class="product_rating">
                                                                        @for ($i = 1; $i <= $whole; $i++)
                                                                            <i class="fa fa-star "></i>
                                                                        @endfor

                                                                        @if ($fraction != 0)
                                                                            <i class="fa fa-star-half"></i>
                                                                        @endif


                                                                        <span
                                                                            class="rating_avg">({{ $per_rate }})</span>
                                                                    </span>
                                                                    <br>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach --}}


                                </div>
                            </article>
                            <article id='tabs-2'>
                                <div class="row">
                                    {{-- @foreach ($lunch as $item)
                                            <?php
                                            
                                            $total_rate = DB::table('rates')->where('product_id', $item->id)->sum('star_value');
                                            
                                            $total_voter = DB::table('rates')->where('product_id', $item->id)->count();
                                            
                                            if ($total_voter > 0) {
                                                $per_rate = $total_rate / $total_voter;
                                            } else {
                                                $per_rate = 0;
                                            }
                                            
                                            $per_rate = number_format($per_rate, 1);
                                            
                                            $whole = floor($per_rate); // 1
                                            $fraction = $per_rate - $whole;
                                            
                                            ?>

                                            @if ($item->id % 2 == 0)
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="left-list">

                                                            <div class="col-lg-12">
                                                                <div class="tab-item">
                                                                    <img src="{{ asset('assets/images/' . $item->image) }}"
                                                                        alt="">
                                                                    <h4>{{ $item->name }}</h4>
                                                                    <p>{{ $item->description }}</p>
                                                                    <div class="price">
                                                                        <h6>৳{{ $item->price }}</h6>
                                                                    </div>
                                                                    <span class="product_rating">
                                                                        @for ($i = 1; $i <= $whole; $i++)
                                                                            <i class="fa fa-star "></i>
                                                                        @endfor

                                                                        @if ($fraction != 0)
                                                                            <i class="fa fa-star-half"></i>
                                                                        @endif


                                                                        <span
                                                                            class="rating_avg">({{ $per_rate }})</span>
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach --}}

                                    {{-- @foreach ($lunch as $item)
                                            <?php
                                            
                                            $total_rate = DB::table('rates')->where('product_id', $item->id)->sum('star_value');
                                            
                                            $total_voter = DB::table('rates')->where('product_id', $item->id)->count();
                                            
                                            if ($total_voter > 0) {
                                                $per_rate = $total_rate / $total_voter;
                                            } else {
                                                $per_rate = 0;
                                            }
                                            
                                            $per_rate = number_format($per_rate, 1);
                                            
                                            $whole = floor($per_rate); // 1
                                            $fraction = $per_rate - $whole;
                                            
                                            ?>

                                            @if ($item->id % 2 != 0)
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="right-list">
                                                            <div class="col-lg-12">
                                                                <div class="tab-item">
                                                                    <img src="{{ asset('assets/images/' . $item->image) }}"
                                                                        alt="">
                                                                    <h4>{{ $item->name }}</h4>
                                                                    <p>{{ $item->description }}</p>
                                                                    <div class="price">
                                                                        <h6>৳{{ $item->price }}</h6>
                                                                    </div>
                                                                    <span class="product_rating">
                                                                        @for ($i = 1; $i <= $whole; $i++)
                                                                            <i class="fa fa-star "></i>
                                                                        @endfor

                                                                        @if ($fraction != 0)
                                                                            <i class="fa fa-star-half"></i>
                                                                        @endif


                                                                        <span
                                                                            class="rating_avg">({{ $per_rate }})</span>
                                                                    </span>
                                                                    <br>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach --}}

                                </div>
                            </article>
                            <article id='tabs-3'>
                                <div class="row">
                                    {{-- @foreach ($dinner as $item)
                                            <?php
                                            
                                            $total_rate = DB::table('rates')->where('product_id', $item->id)->sum('star_value');
                                            
                                            $total_voter = DB::table('rates')->where('product_id', $item->id)->count();
                                            
                                            if ($total_voter > 0) {
                                                $per_rate = $total_rate / $total_voter;
                                            } else {
                                                $per_rate = 0;
                                            }
                                            
                                            $per_rate = number_format($per_rate, 1);
                                            
                                            $whole = floor($per_rate); // 1
                                            $fraction = $per_rate - $whole;
                                            
                                            ?>

                                            @if ($item->id % 2 == 0)
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="left-list">

                                                            <div class="col-lg-12">
                                                                <div class="tab-item">
                                                                    <img src="{{ asset('assets/images/' . $item->image) }}"
                                                                        alt="">
                                                                    <h4>{{ $item->name }}</h4>
                                                                    <p>{{ $item->description }}</p>
                                                                    <div class="price">
                                                                        <h6>৳{{ $item->price }}</h6>
                                                                    </div>
                                                                    <span class="product_rating">
                                                                        @for ($i = 1; $i <= $whole; $i++)
                                                                            <i class="fa fa-star "></i>
                                                                        @endfor

                                                                        @if ($fraction != 0)
                                                                            <i class="fa fa-star-half"></i>
                                                                        @endif


                                                                        <span
                                                                            class="rating_avg">({{ $per_rate }})</span>
                                                                    </span>
                                                                    <br>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach --}}

                                    {{-- @foreach ($dinner as $item)
                                            <?php
                                            
                                            $total_rate = DB::table('rates')->where('product_id', $item->id)->sum('star_value');
                                            
                                            $total_voter = DB::table('rates')->where('product_id', $item->id)->count();
                                            
                                            if ($total_voter > 0) {
                                                $per_rate = $total_rate / $total_voter;
                                            } else {
                                                $per_rate = 0;
                                            }
                                            
                                            $per_rate = number_format($per_rate, 1);
                                            
                                            $whole = floor($per_rate); // 1
                                            $fraction = $per_rate - $whole;
                                            
                                            ?>

                                            @if ($item->id % 2 != 0)
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="right-list">
                                                            <div class="col-lg-12">
                                                                <div class="tab-item">
                                                                    <img src="{{ asset('assets/images/' . $item->image) }}"
                                                                        alt="">
                                                                    <h4>{{ $item->name }}</h4>
                                                                    <p>{{ $item->description }}</p>
                                                                    <div class="price">
                                                                        <h6>৳{{ $item->price }}</h6>
                                                                    </div>
                                                                    <span class="product_rating">
                                                                        @for ($i = 1; $i <= $whole; $i++)
                                                                            <i class="fa fa-star "></i>
                                                                        @endfor

                                                                        @if ($fraction != 0)
                                                                            <i class="fa fa-star-half"></i>
                                                                        @endif


                                                                        <span
                                                                            class="rating_avg">({{ $per_rate }})</span>
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach --}}

                                </div>
                            </article>
                        </section>
                        <br>
                        <a href="/menu"><input style="color:#fff; background-color:#FB5849; font-size:20px;"
                                class="btn" type="submit" value="Browse All"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Chefs Area Ends ***** -->
