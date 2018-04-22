<h5 class="card-title">ORDER LIST</h5>
<hr>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped" style="font-size: 12px; font-weight: 600;">
            <thead>
                <td>Item Name</td>
                <td>Price/kg</td>
                <td>Quantity</td>
                <td>Total Cost</td>
                <td>Delivery Date</td>
            </thead>

            <tbody>
                @foreach($model->item_orders as $item_order)
                <tr>
                    <td>{{ $item_order->item->name }}</td>
                    <td>{{ number_format($item_order->item->selling_price, 2) }}</td>
                    <td>{{ $item_order->ordered_quantity }}</td>
                    <td>PHP {{ number_format($item_order->total_cost, 2) }}</td>
                    <td>{{ date('F d, Y', strtotime($item_order->delivery_date)) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div><!--col-lg-12-->
</div><!--row-->