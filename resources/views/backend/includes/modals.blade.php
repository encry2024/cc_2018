@if (Route::currentRouteName() == "admin.supplier.show")
<!-- Supplier - Order Item -->
<div class="modal fade in" tabindex="-1" role="dialog" id="order_item_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="POST">
                    {{ csrf_field() }}
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6" style="border-right: 1px dashed #DDD;">
                                <div class="form-group row">
                                    <label class="col-md-4 form-control-label">ITEM NAME:</label>

                                    <div class="col-sm-5">
                                        <label id="item-name" class="form-control-label"></label>
                                    </div><!--col-->
                                </div><!--form-group-->

                                <div class="form-group row">
                                    <label class="col-md-4 form-control-label">SELLING PRICE:</label>

                                    <div class="col-sm-5">
                                        <label id="item-selling-price" class="form-control-label"></label>
                                    </div>
                                </div><!--form-group-->
                            </div><!--col-->

                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-md-5 form-control-label">QUANTITY:</label>

                                    <div class="input-group col-sm-7">
                                        <input type="text" class="form-control input-sm numeric-input" name="requested_quantity">
                                        <span class="input-group-prepend input-group-text" id="weight_label"></span>
                                    </div>
                                </div><!--form-group-->

                                <div class="form-group row">
                                    <label class="col-md-5 form-control-label">TOTAL COST:</label>

                                    <div class="col-sm-7">
                                        <label class="form-control-label" id="total_cost">PHP 0.00</label>
                                    </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" name="add_to_cart">Add To Cart</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif


<!-- Transaction -->
<div class="modal fade" tabindex="-1" role="dialog" id="deliver_item_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ITEM ORDER</h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" action="" method="POST">
                    {{ csrf_field() }}
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6" style="border-right: 1px dashed #DDD;">
                                <div class="form-group row">
                                    <label class="col-md-4 form-control-label">ITEM NAME:</label>

                                    <div class="col-sm-5">
                                        <label id="item-name" class="form-control-label"></label>
                                    </div><!--col-->
                                </div><!--form-group-->

                                <div class="form-group row">
                                    <label class="col-md-4 form-control-label">STOCKS:</label>

                                    <div class="col-sm-5">
                                        <label id="item-stocks" class="form-control-label numeric-input"></label>
                                    </div>
                                </div><!--form-group-->

                                <div class="form-group row">
                                    <label class="col-md-4 form-control-label">BUYING PRICE:</label>

                                    <div class="col-sm-5">
                                        <label id="item-buying-price" class="form-control-label"></label>
                                    </div>
                                </div><!--form-group-->

                                <div class="form-group row">
                                    <label class="col-md-4 form-control-label">SUPPLIER:</label>

                                    <div class="col-sm-8">
                                        <label id="item-supplier" class="form-control-label"></label>
                                    </div>
                                </div><!--form-group-->
                            </div><!--col-->

                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-md-5 form-control-label">QUANTITY:</label>

                                    <div class="input-group col-sm-7">
                                        <input type="text" class="form-control input-sm numeric-input" name="requested_quantity">
                                        <span class="input-group-prepend input-group-text" id="weight_label">kg</span>
                                    </div>
                                </div><!--form-group-->

                                <div class="form-group row">
                                    <label class="col-md-5 form-control-label">DELIVERY DATE:</label>

                                    <div class="col-sm-7">
                                        <input type="date" class="form-control input-sm">
                                    </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-dark">ADD TO TRAY</button>
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

@if (Route::currentRouteName() == "admin.order.show")
<!-- Payment History -->
<div class="modal fade" tabindex="-1" role="dialog" id="payment_history_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <th>Added by</th>
                        <th>Amount Received</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Date Added</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        @foreach ($payments as $payment)
                            @if (count($payment->paymentable) != 0)
                            <tr>
                                <td>{{ $payment->paymentable->user->full_name }}</td>
                                <td>PHP {{ number_format($payment->amount_paid, 2) }}</td>
                                <td>{{ class_basename($payment->paymentable) }}</td>
                                <td>{{ class_basename($payment->paymentable) == "Cash" ? "RECEIVED" : $payment->paymentable->status }}</td>
                                <td>{{ date('F d, Y (h:i A)', strtotime($payment->created_at)) }}</td>
                                <td>
                                    @if (class_basename($payment->paymentable) != "Cash")
                                        @if (($payment->paymentable->type == "post-dated" && $payment->paymentable->status == "PENDING"))
                                            <a class="btn btn-sm btn-success text-white" data-toggle="tooltip" title="Received" name="receive_payment_btn"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('admin.order.update_check', ['payment' => $payment->id, 'check' => $payment->paymentable->id]) }}" method="POST" id="check_status_form">
                                                {{ method_field("PATCH") }}
                                                {{ csrf_field() }}
                                            </form>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Payment Modal -->
<form class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="add_payment_modal" action="{{ route('admin.order.add_payment', $model->id) }}" method="POST">
    {{ csrf_field() }}
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Customer Payment</h4>
            </div>

            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="form-group row">
                        <label class="form-control-label col-sm-3">Payment Method</label>

                        <div class="col-sm-9">
                            <select name="payment_dropdown" id="payment_dropdown" class="form-control" data-placeholder="-- Select Payment Method --">
                                <option value=""></option>
                                <option value="Cash">Cash</option>
                                <option value="Check">Check</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div id="container">
                        <div id="field_container" style="display: none;">

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Confirm</button>
                <a class="btn btn-danger" id="close_add_payment_modal">Cancel</a>
            </div>
        </div>
    </div>
</form>
@endif