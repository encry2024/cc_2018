<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            {{-- <li class="nav-title">
                {{ __('menus.backend.sidebar.general') }}
            </li> --}}

            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/dashboard')) }}" href="{{ route('admin.dashboard') }}"><i class="icon-speedometer"></i> {{ __('menus.backend.sidebar.dashboard') }}</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/supplier*')) }}" href="{{ route('admin.supplier.index') }}"><i class="fa fa-truck"></i> {{ __('menus.backend.sidebar.supplier') }}</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/item*')) }}" href="{{ route('admin.item.index') }}"><i class="fa fa-archive" aria-hidden="true"></i> {{ __('menus.backend.sidebar.item') }}</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/customer*')) }}" href="{{ route('admin.customer.index') }}"><i class="fa fa-users"></i> {{ __('menus.backend.sidebar.customer') }}</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/order*')) }}" href="{{ route('admin.order.index') }}"><i class="fa fa-clipboard"></i> Orders</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/request*')) }}" href="{{ route('admin.request.index') }}"><i class="fa fa-refresh"></i> Requests</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/expense*')) }}" href="{{ route('admin.expense.index') }}"><i class="fa fa-google-wallet" aria-hidden="true"></i> Expenses</a>
            </li>

            <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/auth*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="icon-graph"></i> Account Report
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/report/receivable')) }}" href="{{ route('admin.report.receivable') }}">
                                Receivables
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/report/payable')) }}" href="{{ route('admin.report.payable') }}">
                                Payables
                            </a>
                        </li>
                    </ul>
                </li>

            {{-- <li class="nav-title">
                {{ __('menus.backend.sidebar.system') }}
            </li> --}}

            @if ($logged_in_user->isAdmin())
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/auth*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="icon-user"></i> {{ __('menus.backend.access.title') }}

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/user*')) }}" href="{{ route('admin.auth.user.index') }}">
                                {{ __('labels.backend.access.users.management') }}

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/role*')) }}" href="{{ route('admin.auth.role.index') }}">
                                {{ __('labels.backend.access.roles.management') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'open') }}">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="icon-list"></i> {{ __('menus.backend.log-viewer.main') }}
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer')) }}" href="{{ route('log-viewer::dashboard') }}">
                            {{ __('menus.backend.log-viewer.dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer/logs*')) }}" href="{{ route('log-viewer::logs.list') }}">
                            {{ __('menus.backend.log-viewer.logs') }}
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div><!--sidebar-->