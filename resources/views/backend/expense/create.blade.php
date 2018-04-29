@extends ('backend.layouts.app')

@section ('title', __('labels.backend.expenses.management') . ' | ' . __('labels.backend.expenses.create'))

@section('breadcrumb-links')
    @include('backend.item.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.expense.store'))->class('form-horizontal')->open() }}
    <div class="card">

        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.expenses.management') }}
                        <small class="text-muted">{{ __('labels.backend.expenses.create') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">
                <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.expense.requested_by'))
                        ->class('col-md-2 form-control-label')
                        ->for('requested_by') }}

                        <div class="col-md-10">
                            {{
                                html()->text('requested_by')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.expense.requested_by'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus()
                            }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.expense.code'))
                        ->class('col-md-2 form-control-label')
                        ->for('code') }}

                        <div class="col-md-10">
                            {{
                                html()->text('code')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.expense.code'))
                                ->attribute('maxlength', 191)
                                ->autofocus()
                            }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.expense.amount'))->class('col-md-2 form-control-label')->for('amount') }}

                        <div class="input-group col-sm-10">
                            <span class="input-group-prepend input-group-text">PHP</span>
                            {{
                                html()->text('amount')
                                ->class('form-control numeric-input')
                                ->placeholder(__('validation.attributes.backend.expense.amount'))
                                ->attribute('maxlength', 191)
                                ->required()
                            }}
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.expense.cause'))
                        ->class('col-md-2 form-control-label')
                        ->for('cause') }}

                        <div class="col-md-10">
                            {{
                                html()->text('cause')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.expense.cause'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus()
                            }}
                        </div><!--col-->
                    </div><!--form-group-->

                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer clearfix">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.expense.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@endsection