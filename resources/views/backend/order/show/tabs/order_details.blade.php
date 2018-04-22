<!-- ORDER DETAILS -->
<div class="row">
    <div class="col-lg-12">
        <h5 class="card-title">ORDER DETAILS</h5>
        <hr>
        <div class="form-group row">
            {{ html()->label('Issued By')->class('col-md-5 form-control-label')->for('issued_by') }}
            <div class="col-sm-7">
                <label class="form-control-label" id="issued_by">{{ $model->user->full_name }}</label>
            </div><!--col-sm-7-->
        </div><!--form-group-->

        <div class="form-group row">
            {{ html()->label('Date Issued')->class('col-md-5 form-control-label')->for('issued_by') }}
            <div class="col-sm-7">
                <label class="form-control-label" id="issued_by">{{ date('F d, Y', strtotime($model->created_at)) }}</label>
            </div><!--col-sm-7-->
        </div><!--form-group-->

        <div class="form-group row">
            {{ html()->label('Balance')->class('col-md-5 form-control-label')->for('balance') }}
            <div class="col-sm-7">
                <label class="form-control-label" id="balance">{{ $model->remaining_balance }}</label>
            </div><!--col-sm-7-->
        </div><!--form-group-->

        <div class="form-group row">
            {{ html()->label('Payment Method')->class('col-md-5 form-control-label')->for('payment_method') }}
            <div class="col-sm-7">
                <label class="form-control-label" id="payment_method">{{ $model->payment_method }}</label>
            </div><!--col-sm-7-->
        </div><!--form-group-->

        @if ($model->payment_method = "cod")
        <div class="form-group row">
            {{ html()->label('Due Date of Payment')->class('col-md-5 form-control-label')->for('due_date') }}
            <div class="col-sm-7">
                <label class="form-control-label" id="due_date">{{ $model->due_date }}</label>
            </div><!--col-sm-7-->
        </div><!--form-group-->
        @endif
    </div><!--col-lg-12-->
</div><!--row-->