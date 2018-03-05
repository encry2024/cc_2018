<header class="app-header navbar" style="font-size: 0.875rem;">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">☰</button>
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler sidebar-minimizer d-md-down-none" type="button">☰</button>

    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link" href="{{ route('frontend.index') }}"><i class="icon-home"></i></a>
        </li>
    </ul>

    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item notifications-menu">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-controls="cart" aria-expanded="true" id="cart-btn"><i class="fa fa-cart-plus" aria-hidden="true"></i><span class="badge badge-pill badge-info" id="cart_queues_count"></span></a>

            <ul class="dropdown-menu dropdown-menu-right" style="font-size: 12px;">
                <div id="cart-container"></div>
                <a class="cart-footer" href="{{ route('admin.cart.index') }}">View My Cart</a>
            </ul>
        </li>

        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#"><i class="icon-list"></i></a>
        </li>
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#"><i class="icon-location-pin"></i></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img src="{{ $logged_in_user->picture }}" class="img-avatar" alt="{{ $logged_in_user->email }}">
                <span class="d-md-down-none">{{ $logged_in_user->full_name }}</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Heading</strong>
                </div>
                <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> Link<span class="badge badge-info">0</span></a>
                <a class="dropdown-item" href="#"><i class="fa fa-envelope-o"></i> Link</a>

                <div class="dropdown-header text-center">
                    <strong>Heading</strong>
                </div>
                <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Link</a>
                <a class="dropdown-item" href="#"><i class="fa fa-file"></i> Link<span class="badge badge-primary">0</span></a>
                <a class="dropdown-item" href="{{ route('frontend.auth.logout') }}"><i class="fa fa-lock"></i> {{ __('navs.general.logout') }}</a>
            </div>
        </li>
    </ul>
</header>