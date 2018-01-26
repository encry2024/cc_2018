<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>{{ __('labels.backend.suppliers.tabs.content.overview.name') }}</th>
                <td>{{ $supplier->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.suppliers.tabs.content.overview.contact_person_first_name') }}</th>
                <td>{{ $supplier->contact_person_first_name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.suppliers.tabs.content.overview.contact_person_last_name') }}</th>
                <td>{{ $supplier->contact_person_last_name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.suppliers.tabs.content.overview.email') }}</th>
                <td>{{ $supplier->email }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.suppliers.tabs.content.overview.address') }}</th>
                <td>{{ $supplier->address }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.suppliers.tabs.content.overview.mobile_number') }}</th>
                <td>{{ $supplier->mobile_number }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.suppliers.tabs.content.overview.telephone_number') }}</th>
                <td>{{ $supplier->telephone_number }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.suppliers.tabs.content.overview.created_at') }}</th>
                <td>{{ $supplier->created_at->diffForHumans() }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.suppliers.tabs.content.overview.updated_at') }}</th>
                <td>{{ $supplier->updated_at->diffForHumans() }}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->