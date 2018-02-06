@extends ('backend.layouts.app')

@section ('title', __('labels.backend.items.management') . ' | ' . __('labels.backend.items.create'))

@section('breadcrumb-links')
    @include('backend.item.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.item.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.items.management') }}
                        <small class="text-muted">{{ __('labels.backend.items.create') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.item.name'))
                        ->class('col-md-2 form-control-label')
                        ->for('name') }}

                        <div class="col-md-10">
                            {{
                                html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.item.name'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus()
                            }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.item.supplier'))->class('col-md-2 form-control-label')->for('supplier') }}

                        <div class="col-md-10">
                            <select name="supplier" id="supplier-dropdown" class="form-control chosen-select">
                                <option value=""></option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.item.selling_price'))->class('col-md-2 form-control-label')->for('selling_price') }}

                        <div class="input-group col-sm-10">
                            <span class="input-group-prepend input-group-text">PHP</span>
                            {{
                                html()->text('selling_price')
                                ->class('form-control numeric-input')
                                ->placeholder(__('validation.attributes.backend.item.selling_price'))
                                ->attribute('maxlength', 191)
                                ->required()
                            }}
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.item.buying_price'))->class('col-md-2 form-control-label')->for('buying_price') }}

                        <div class="input-group col-sm-10">
                            <span class="input-group-prepend input-group-text">PHP</span>
                            {{
                                html()->text('buying_price')
                                ->class('form-control numeric-input')
                                ->placeholder(__('validation.attributes.backend.item.buying_price'))
                                ->attribute('maxlength', 191)
                                ->required()
                            }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.item.initial_weight'))->class('col-md-2 form-control-label')->for('initial_weight') }}

                        <div class="input-group col-md-10">
                            <span class="input-group-prepend input-group-text">kg</span>
                            {{ html()->text('initial_weight')
                                ->class('form-control numeric-input')
                                ->placeholder(__('validation.attributes.backend.item.initial_weight'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.item.final_weight'))
                        ->class('col-md-2 form-control-label')
                        ->for('final_weight') }}

                        <div class="input-group col-md-10">
                            <span class="input-group-prepend input-group-text">kg</span>
                            {{ html()->text('final_weight')
                                ->class('form-control numeric-input')
                                ->placeholder(__('validation.attributes.backend.item.final_weight'))
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
                    {{ form_cancel(route('admin.item.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@endsection