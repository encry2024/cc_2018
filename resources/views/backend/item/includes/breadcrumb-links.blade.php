<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('menus.backend.items.main') }}</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.item.index') }}">{{ __('menus.backend.items.all') }}</a>
                <a class="dropdown-item" href="{{ route('admin.item.create') }}">{{ __('menus.backend.items.create') }}</a>
                <a class="dropdown-item" href="{{ route('admin.item.deleted') }}">{{ __('menus.backend.items.deleted') }}</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>