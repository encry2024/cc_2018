<!-- CUSTOMER INFORMATION -->
<div class="row">
    <div class="col-lg-12">
        <h5 class="card-title">CUSTOMER INFORMATION</h5>
        <hr>
        <div class="form-group row">
            {{ html()->label('CUSTOMER NAME')->class('col-md-5 form-control-label')->for('customer_name') }}
            <div class="col-sm-7">
                <label class="form-control-label" id="customer_name">{{ $model->customer->name }}</label>
            </div><!--col-sm-7-->
        </div><!--form-group-->

        <div class="form-group row">
            {{ html()->label('CUSTOMER ADDRESS')->class('col-md-5 form-control-label')->for('customer_address') }}
            <div class="col-sm-7">
                <label class="form-control-label" id="customer_address">{{ $model->customer->address }}</label>
            </div><!--col-sm-7-->
        </div><!--form-group-->

        <div class="form-group row">
            {{ html()->label('CUSTOMER CONTACT NUMBER')->class('col-md-5 form-control-label')->for('customer_name') }}
            <div class="col-sm-7">
                <label class="form-control-label" id="customer_contact_number">{{ $model->customer->contact_number }}</label>
            </div><!--col-sm-7-->
        </div><!--form-group-->

        <div class="form-group row">
            {{ html()->label('CUSTOMER E-MAIL')->class('col-md-5 form-control-label')->for('customer_email') }}
            <div class="col-sm-7">
                <label class="form-control-label" id="customer_email">{{ $model->customer->email }}</label>
            </div><!--col-sm-7-->
        </div><!--form-group-->

        <div class="form-group row">
            {{ html()->label('CUSTOMER DISCOUNT')->class('col-md-5 form-control-label')->for('customer_dscount') }}
            <div class="col-sm-7">
                <label class="form-control-label" id="customer_dscount">{{ $model->customer->discount }} %</label>
            </div><!--col-sm-7-->
        </div><!--form-group-->

        <div class="form-group row">
            {{ html()->label('CUSTOMER CREDIT LIMIT')->class('col-md-5 form-control-label')->for('customer_credit_limit') }}
            <div class="col-sm-7">
                <label class="form-control-label" id="customer_dscount">PHP {{ number_format($model->customer->credit_limit, 2) }}</label>
            </div><!--col-sm-7-->
        </div><!--form-group-->
    </div><!--col-lg-12-->
</div><!--row-->