<div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
    @if ($model->status == "PAID")
        <a href="#" class="btn btn-outline-light ml-1 btn-sm" style="font-weight: 500;"
        data-toggle="modal"
        data-target="#payment_history_modal"
        >Payment History</a>
    @else
        <a href="javascript:void(0)" class="btn btn-outline-primary ml-1 btn-sm" style="font-weight: 600;"
            data-toggle="modal"
            data-target="#add_payment_modal"
            data-backdrop="static"
            data-keyboard="false">Add Payment</a>
        <a href="#" class="btn btn-outline-primary ml-1 btn-sm" style="font-weight: 600;"
        data-toggle="modal"
        data-target="#payment_history_modal"
        >Payment History</a>
    @endif
</div><!--btn-toolbar-->