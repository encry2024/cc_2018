<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('menus.backend.expenses.main') }}</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.expense.index') }}">{{ __('menus.backend.expenses.all') }}</a>
                <a class="dropdown-item" href="{{ route('admin.expense.create') }}">{{ __('menus.backend.expenses.create') }}</a>
                <a class="dropdown-item" href="{{ route('admin.expense.deleted') }}">{{ __('menus.backend.expenses.deleted') }}</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>