<h5 class="card-title">
    CUSTOMER ORDERS
    <button class="btn btn-danger pull-right btn-sm" title="Remove Item" data-toggle="tooltip" id="remove_btn"><i class="fa fa-trash"></i></button>
</h5>
<hr>
<table class="table table-sm table-striped order-table">
    <thead>
        <th style="width: 20%;">Item</th>
        <th style="width: 15%;">Price/kg</th>
        <th style="width: 13%;">Quantity</th>
        <th style="width: 15%;">Cost</th>
        <th style="width: 17%;">Delivery Date</th>
    </thead>
    <tfoot>
        <tr>
            <td>TOTAL ITEMS: <span id="item_count">0</span></td>
            <td></td>
            <td>TOTAL COST:</td>
            <td colspan="2">PHP <span id="total_cost_label">0.00</span></td>
        </tr>
    </tfoot style="border-top: 1px solid #ddd;">
    <tbody id="customer_order_container">
    </tbody>
</table>