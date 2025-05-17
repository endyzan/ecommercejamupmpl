   <!-- ***** Menu Area Starts ***** -->
   <section class="section" id="menu">
       <div class="container">
           <div class="row">
               <div class="col-lg-4">
                   <div class="section-heading">
                       <h6>PRODUK JAMU</h6>
                       <h2>Our selection of cakes with quality taste</h2>
                   </div>
               </div>
           </div>
       </div>
       <div class="menu-item-carousel">
           <div class="col-lg-12">
               <div class="owl-menu-item owl-carousel">

                   @foreach ($jamus as $jamu)
                       <div class="item">
                           <div class='card'
                               style="background-image: url('{{ asset('assets/images/jamu-madura.jpg') }}')">
                               <div class="price">
                                   <h6>{{ rupiah($jamu->harga) }}</h6>
                                   @if ($jamu->stok < 1)
                                       <h4>Out Of Stock</h4>
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
