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

<!-- Transaction -->
<div class="modal fade" tabindex="-1" role="dialog" id="deliver_item_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ITEM ORDER</h5>
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
                                        <input type="date" class="form-control input-sm" forma>
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