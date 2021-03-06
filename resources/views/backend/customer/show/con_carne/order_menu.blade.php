<div class="row">
    <div class="col-lg-12">
    <h5 class="card-title">CUSTOMER CURRENT USABLE CREDIT</h5>
        <hr>
        <div class="form-group row">
            {{ html()->label('USABLE CREDIT')->class('col-md-4 form-control-label')->for('usable_credit') }}
            <div class="input-group-prepend col-sm-8">
                <span class="input-group-text">PHP</span>
                <input type="string" class="form-control" value="{{ number_format($customer->usable_credit, 2) }}" id="usable_credit" disabled>
            </div><!--col-sm-8-->
        </div><!--form-group-->
        <br>
        <h5 class="card-title">MENU</h5>
        <hr>
        <div class="form-group row">
            {{ html()->label('COLLECTION DATE')->class('col-md-4 form-control-label')->for('collection_date') }}
            <div class="col-sm-8">
                <input type="date" class="form-control" id="collection_date">
            </div><!--col-sm-8-->
        </div><!--form-group-->

        <div class="form-group row">
            {{ html()->label('PAYMENT TYPE')->class('col-md-4 form-control-label')->for('payment_type') }}
            <div class="col-sm-8">
                <select name="payment_type" id="payment_type_dropdown" class="form-control" data-placeholder="-- Select Payment Type --">
                    <option value=""></option>
                    <option value="term">Term Payment</option>
                    <option value="cod">Cash On Delivery</option>
                </select>
            </div><!--col-sm-8-->
        </div><!--form-group-->

        <div id="day_term_container" style="display: none;"></div>

        <hr>

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    {{ html()->label('ITEM NAME')->class('col-md-4 form-control-label')->for('item-dropdown') }}
                    <div class="col-sm-8">
                        <select name="product-category" id="item_dropdown" class="form-control" data-placeholder="-- Select Item --">
                            <option value=""></option>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div><!--col-sm-8-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label('STOCKS')->class('col-md-4 form-control-label')->for('stocks') }}
                    <div class="input-group col-sm-8">
                        <input type="text" class="form-control" id="stocks" disabled>
                        <span class="input-group-prepend input-group-text">KG</span>
                    </div><!--input-group col-sm-8-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label('SELLING PRICE')->class('col-md-4 form-control-label')->for('selling_price') }}
                    <div class="input-group col-sm-8">
                        <input type="text" class="form-control" id="selling_price" disabled>
                        <span class="input-group-prepend input-group-text">PHP</span>
                    </div><!--input-group col-sm-8-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label('DISCOUNT')->class('col-md-4 form-control-label')->for('discount') }}
                    <div class="input-group col-sm-8">
                        <input type="text" class="form-control" id="discount" disabled value="{{ $customer->discount }}">
                        <span class="input-group-prepend input-group-text">%</span>
                    </div><!--input-group col-sm-8-->
                </div><!--form-group-->

                <hr>

                <div class="form-group row">
                    {{ html()->label('REQUESTED QUANTITY')->class('col-md-4 form-control-label')->for('requested_quantity') }}
                    <div class="input-group col-sm-8">
                        <input type="text" class="form-control numeric-input" id="requested_quantity" disabled>
                        <span class="input-group-prepend input-group-text">KG</span>
                    </div><!--input-group col-sm-8-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label('DELIVERY DATE')->class('col-md-4 form-control-label')->for('date') }}
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="date" disabled>
                    </div><!--col-sm-8-->
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label('TOTAL PRICE')->class('col-md-4 form-control-label')->for('total_price') }}
                    <div class="input-group col-sm-8">
                        <input type="text" class="form-control numeric-input" id="total_price" disabled value="0.00">
                        <span class="input-group-prepend input-group-text">PHP</span>
                    </div><!--input-group col-sm-8-->
                </div><!--form-group-->

                <button class="btn btn-dark pull-right" id="add_item_btn">ADD ITEM</button>
            </div><!--col-->
        </div><!--row-->
    </div><!--col-lg-12-->
</div><!--row-->