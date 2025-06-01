    <!-- ***** Header Area Start ***** -->
    <header class="header-area" style="z-index:1000">
        <div class="container">
            <nav class="main-nav flex justify-between">
                <!-- ***** Logo Start ***** -->
                <a href="/" class="logo fixed-logo h-[80px]">
                    <img src="{{ asset('assets/images/logos/leaves.jpg') }} " class="max-w-[100px] max-h-full">
                </a>
                <!-- ***** Logo End ***** -->
                <!-- ***** Menu Start ***** -->
                <ul class="nav">
                    <li class="scroll-to-section"><a href="/">Home</a></li>
                    <li class="scroll-to-section"><a href="/#about">About</a></li>

                    <li class="scroll-to-section"><a href="/#menu">Menu</a></li>

                    @if (Auth::user())
                        <li class="scroll-to-section"><a href="/trace-my-order">Trace Order</a></li>

                        <li class="scroll-to-section"><a href="/my-order">My Order</a></li>
                    @endif

                    {{-- <li class="scroll-to-section"><a href="/#chefs">Chefs</a></li> --}}
                    <li class="scroll-to-section"><a href="/#reservation">Contact Us</a></li>

                    <?php
                    
                    if (Auth::user()) {
                        // $cart_amount = DB::table('carts')
                        //     ->where('user_id', Auth::user()->id)
                        //     ->where('product_order', 'no')
                        //     ->count();
                        $cart_amount = 0;
                    } else {
                        $cart_amount = 0;
                    }
                    
                    ?>

                    @if (Auth::user())
                        <li><a href="/cart"><i class="fa fa-shopping-cart"></i></a></li>
                        <span class='badge badge-warning' id='lblCartCount'> {{ $cart_amount }} </span>
                    @endif

                    <style>
                        .badge {
                            padding-left: 9px;
                            padding-right: 9px;
                            padding-top: 10px;
                            -webkit-border-radius: 9px;
                            -moz-border-radius: 9px;
                            border-radius: 9px;
                            height: 16px;
                            text-align: center;
                        }

                        .label-warning[href],
                        .badge-warning[href] {
                            background-color: #c67605;
                        }

                        #lblCartCount {
                            font-size: 12px;
                            background: #ff0000;
                            color: #fff;
                            padding: 0 5px;
                            vertical-align: top;
                            margin-left: -10px;
                        }
                    </style>
                </ul>
                {{-- <ul class="nav">
                    @if (Route::has('login'))
                        <div class="hidden fixed flex-col top-0 right-0 px-6 py-4 sm:block">
                            @auth
                                <li style="margin-top:-13px;">
                                    <x-app-layout> </x-app-layout>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                                </li>
                                @if (Route::has('register'))
                                    <li>
                                        <a href="{{ route('register') }}"
                                            class="ml-4 text-sm text-gray-700 underline">Register</a>
                                    </li>
                                @endif
                            @endauth
                        </div>
                    @endif
                </ul> --}}
                <ul class="nav">
                    @if (Route::has('login'))
                        @auth
                            <li>
                                <a href="{{ route('profile.edit') }}" class="text-sm text-gray-700 underline">Profile</a>
                            </li>
                            <li class="pt-0.5">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                            </li>
                            <li>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 lg:px-5  sm:mr-2 lg:mr-0">Register</a>
                                @endif
                            </li>
                        @endauth
                    @endif
                </ul>


                <!-- ***** Menu End ***** -->
            </nav>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
