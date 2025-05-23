@include('admin.partials_layout.head')

<body>
    <div class="container-scroller">

        <!-- partial:partials/_sidebar.html -->
        @include('admin.partials_layout.sidebar')


        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.partials_layout.navbar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">


                    @yield('container')



                </div>



                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                @include('admin.partials_layout.footer')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    {{-- Scripting --}}
    @include('admin.partials_layout.script')

</body>

</html>
