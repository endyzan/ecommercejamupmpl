   <!-- ***** Menu Area Starts ***** -->
   <section class="section" id="menu">
       <div class="container">
           <div class="row">
               <div class="col-lg-4">
                   <div class="section-heading">
                       <h6>PRODUK JAMU</h6>
                       <h2>Racikan Jamu Pilihan dengan Kualitas yang Terjaga</h2>
                   </div>
               </div>
           </div>
       </div>
       <div class="menu-item-carousel">
           <div class="col-lg-12" style="padding:0 5em 0 5em">
               <div class="owl-menu-item owl-carousel">

                   @foreach ($jamus as $jamu)
                       <div class="item">
                           @php
                               // Tentukan URL background, Code Untuk Menyesuaikan gambar dengan data dummy atau seeder
                               $bgUrl = filter_var($jamu->gambar, FILTER_VALIDATE_URL) // Jika pada gambar bukan path gambar lokal, maka gunakan URL langsung
                                   ? $jamu->gambar
                                   : asset('assets/images/products/' . $jamu->gambar); // Jika bukan URL maka diganti Path
                           @endphp

                           <div class="card" style="background-image: url('{{ $bgUrl }}')">
                               {{-- <div class="price">
                                   <h6>{{ rupiah($jamu->harga) }}</h6>
                                   @if ($jamu->stok < 1)
                                       <h4>Out Of Stock</h4>
                                   @endif
                               </div> --}}
                               <div
                                   class="absolute top-0 left-0 w-[100px] h-[70px] bg-[#fb5849] text-white text-[14px] font-bold rounded-[3px] flex flex-col items-center justify-center text-center px-1">
                                   <span class="text-lg">{{ rupiah($jamu->harga) }}</span>
                                   @if ($jamu->stok < 1)
                                       <span class="mt-1 text-[10px] bg-white text-[#fb5849] px-1 rounded-sm">Out of
                                           Stock</span>
                                   @endif
                               </div>


                               <div class='info'>
                                   <h1 class='title'>{{ $jamu->nama_jamu }}</h1>
                                   <p class='description'>{{ $jamu->deskripsi }}</p>

                                   <div class="main-text-button">
                                       <div class="scroll-to-section">
                                           <span class="product_rating">
                                               @for ($i = 1; $i <= $jamu->whole; $i++)
                                                   <i class="fa fa-star"></i>
                                               @endfor
                                               @if ($jamu->fraction != 0)
                                                   <i class="fa fa-star-half"></i>
                                               @endif
                                               @if ($jamu->rating == 0)
                                                   <span class="rating_avg">'There's No Rating Yet!'</span>
                                               @else
                                                   <span class="rating_avg">({{ $jamu->rating }})</span>
                                               @endif
                                           </span>
                                           <br>
                                           <a href="/rate/{{ $jamu->id }}" style="color:blue;">Rate this</a>
                                           <p>Quantity: </p>

                                           <form method="post" action="">
                                               @csrf
                                               <input type="number" name="number" style="width:50px;" id="myNumber"
                                                   value="1">
                                               <input type="submit" class="btn btn-success" value="Add Chart"
                                                   {{ $jamu->stok < 1 ? 'disabled' : '' }}>
                                           </form>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   @endforeach

               </div>
           </div>
       </div>
   </section>
   <!-- ***** Menu Area Ends ***** -->
