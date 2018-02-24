@extends ('backend.layouts.app')

@section ('title', __('labels.backend.customers.management') . ' | ' . __('labels.backend.customers.create'))

@section('breadcrumb-links')
    @include('backend.customer.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.customer.store'))->class('form-horizontal')->open() }}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.customers.management') }}
                    <small class="text-muted">{{ __('labels.backend.customers.create') }}</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <hr />

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.customer.name'))
                    ->class('col-md-2 form-control-label')
                    ->for('name') }}

                    <div class="col-md-10">
                        {{
                            html()->text('name')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.backend.customer.name'))
                            ->attribute('maxlength', 191)
                            ->required()
                            ->autofocus()
                        }}
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.customer.email'))->class('col-md-2 form-control-label')->for('email') }}

                    <div class="col-sm-10">
                        {{
                            html()->email('email')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.backend.customer.email'))
                            ->attribute('maxlength', 191)
                            ->required()
                        }}
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.customer.contact_number'))->class('col-md-2 form-control-label')->for('contact_number') }}

                    <div class="col-sm-10">
                        {{
                            html()->text('contact_number')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.backend.customer.contact_number'))
                            ->attribute('maxlength', 191)
                            ->required()
                        }}
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.customer.address'))->class('col-md-2 form-control-label')->for('address') }}

                    <div class="col-md-10">
                        {{ html()->text('address')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.backend.customer.address'))
                            ->attribute('maxlength', 191)
                            ->required() }}
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.customer.discount'))
                    ->class('col-md-2 form-control-label')
                    ->for('discount') }}

                    <div class="input-group col-md-10">
                        <span class="input-group-prepend input-group-text">%</span>
                        {{ html()->text('discount')
                            ->class('form-control numeric-input')
                            ->placeholder(__('validation.attributes.backend.customer.discount'))
                            ->attribute('maxlength', 191)
                            ->required() }}
                    </div><!--col-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.customer.credit_limit'))
                    ->class('col-md-2 form-control-label')
                    ->for('credit_limit') }}

                    <div class="input-group col-md-10">
                        <span class="input-group-prepend input-group-text">PHP</span>
                        {{ html()->text('credit_limit')
                            ->class('form-control numeric-input')
                            ->placeholder(__('validation.attributes.backend.customer.credit_limit'))
                            ->attribute('maxlength', 191)
                            ->required() }}
                    </div><!--col-->
                </div><!--form-group-->

            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer clearfix">
        <div class="row">
            <div class="col">
                {{ form_cancel(route('admin.customer.index'), __('buttons.general.cancel')) }}
            </div><!--col-->

            <div class="col text-right">
                {{ form_submit(__('buttons.general.crud.create')) }}
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
{{ html()->form()->close() }}
@endsection