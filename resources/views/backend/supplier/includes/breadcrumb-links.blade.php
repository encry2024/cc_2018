<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('menus.backend.suppliers.main') }}</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.supplier.index') }}">{{ __('menus.backend.suppliers.all') }}</a>
                <a class="dropdown-item" href="{{ route('admin.supplier.create') }}">{{ __('menus.backend.suppliers.create') }}</a>
                <a class="dropdown-item" href="{{ route('admin.supplier.deleted') }}">{{ __('menus.backend.suppliers.deleted') }}</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>