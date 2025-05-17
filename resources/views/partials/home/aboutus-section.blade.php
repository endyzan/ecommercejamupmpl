   <!-- ***** About Area Starts ***** -->
   <section class="section" id="about">
       <div class="container">
           <div class="row">
               <div class="col-lg-6 col-md-6 col-xs-12">
                   <div class="left-text-content">
                       <div class="section-heading">
                           <h6>About Us</h6>
                           <h2>Toko Jamu Madura Terpercaya</h2>
                       </div>
                       <p>Kami adalah e-commerce yang menyediakan berbagai jenis jamu tradisional Madura berkualitas
                           tinggi. Dengan bahan-bahan alami pilihan dan proses pembuatan yang higienis, kami berkomitmen
                           untuk menjaga warisan leluhur dalam bentuk jamu yang aman dan berkhasiat.
                       </p>
                       <div class="row">
                           @for ($index = 1; $index <= 3; $index++)
                               <div class="col-4">
                                   <img src="{{ asset('assets/images/abouts/about-thumb-0' . $index . '.jpg') }}"
                                       alt="Jamu Madura {{ $index }}">
                               </div>
                           @endfor
                       </div>
                   </div>
               </div>
               <div class="col-lg-6 col-md-6 col-xs-12">
                   <div class="right-content">
                       <div class="thumb">
                           <a rel="nofollow" href="https://www.youtube.com/@naplive7" target="_blank">
                               <i class="fa fa-play"></i>
                           </a>
                           <img src="{{ asset('assets/images/abouts/about-video-bg.jpg') }}"
                               alt="Video Tentang Jamu Madura">
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>
   <!-- ***** About Area Ends ***** -->
