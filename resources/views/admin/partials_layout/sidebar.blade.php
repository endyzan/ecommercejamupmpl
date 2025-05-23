<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        @if (Auth::user()->role == 1)
            <a class="sidebar-brand brand-logo" href="/redirects" style="color:white;text-decoration:none;">Admin
                Panel</a>
        @endif
        @if (Auth::user()->role == 2)
            <a class="sidebar-brand brand-logo" href="/redirects" style="color:white;text-decoration:none;">Manager
                Panel</a>
        @endif
        <a class="sidebar-brand brand-logo-mini" href="index.html"><img
                src="{{ asset('admin/assets//images/logo-mini.svg') }}" alt="logo" /></a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle " src="{{ asset('assets/images/admin/411928015.jpg') }}"
                            alt="">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">{{ Auth::user()->name }}</h5>
                        @if (Auth::user()->role == 1)
                            <span>Admin</span>
                        @endif
                        @if (Auth::user()->role == 2)
                            <span>Manager</span>
                        @endif
                    </div>
                </div>
                <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
                    aria-labelledby="profile-dropdown">
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-settings text-primary"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-onepassword  text-info"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-calendar-today text-success"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                        </div>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="/redirects">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if (Auth::user()->role == 1)
            <li class="nav-item menu-items">
                <a class="nav-link" href="/admin/food-menu">
                    <span class="menu-icon">
                        <i class="mdi mdi-food"></i>
                    </span>
                    <span class="menu-title">Food Menu</span>
                </a>
            </li>


            <li class="nav-item menu-items">
                <a class="nav-link" href="/admin/chefs">
                    <span class="menu-icon">
                        <i class="mdi mdi-food"></i>
                    </span>
                    <span class="menu-title">Chefs</span>
                </a>
            </li>
        @endif

        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-icon">
                    <i class="mdi mdi-file-document-box"></i>
                </span>
                <span class="menu-title">Orders</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="/admin/orders-incomplete">Pending Orders</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="/orders/process">Processing Order</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/orders-complete">Complete Orders</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/orders/cancel">Cancelled Order</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/order/location">Update Location</a></li>

                </ul>
            </div>
        </li>

        {{-- <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <span class="menu-icon">
                    <i class="mdi mdi-food"></i>
                </span>
                <span class="menu-title">Food Menu</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Add Menu</a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Update Menu</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Delete
                            Menu</a></li>
                </ul>
            </div>
        </li> --}}


        <li class="nav-item menu-items">
            <a class="nav-link" href="/admin/reservation">
                <span class="menu-icon">
                    <i class="mdi mdi-chart-bar"></i>
                </span>
                <span class="menu-title">Reservation</span>
            </a>
        </li>
        @if (Auth::user())
            <li class="nav-item menu-items">
                <a class="nav-link" href="/admin/customize">
                    <span class="menu-icon">
                        <i class="mdi mdi-settings"></i>
                    </span>
                    <span class="menu-title">Customize Template</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false"
                    aria-controls="ui-basic">
                    <span class="menu-icon">
                        <i class="mdi mdi-file-document-box"></i>
                    </span>
                    <span class="menu-title">Banners</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic2">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="/admin/add/banner">Add Banners</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="/admin/banner/all">All Banners</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="/admin/show">
                    <span class="menu-icon">
                        <i class="mdi mdi-account-multiple-plus"></i>
                    </span>
                    <span class="menu-title">Admin</span>
                </a>
            </li>
        @endif


        <li class="nav-item menu-items">
            <a class="nav-link" href="/customer">
                <span class="menu-icon">
                    <i class="mdi mdi-account-plus"></i>
                </span>
                <span class="menu-title">Customer</span>
            </a>
        </li>

        {{-- @if (Auth::user()->usertype == 1)
            <li class="nav-item menu-items">
                <a class="nav-link" href="/delivery-boy">
                    <span class="menu-icon">
                        <i class="mdi mdi-account-plus"></i>
                    </span>
                    <span class="menu-title">Delivery Boy</span>
                </a>
            </li>
        @endif


        @if (Auth::user()->usertype != 2)
            <li class="nav-item menu-items">
                <a class="nav-link" href="/admin/coupon">
                    <span class="menu-icon">
                        <i class="mdi mdi-account-card-details"></i>
                    </span>
                    <span class="menu-title">Coupon</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="/admin/charge">
                    <span class="menu-icon">
                        <i class="mdi mdi-bank"></i>
                    </span>
                    <span class="menu-title">Charge</span>
                </a>
            </li>
        @endif --}}



    </ul>
</nav>
