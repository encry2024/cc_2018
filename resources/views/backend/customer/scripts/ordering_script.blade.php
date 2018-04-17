<script>
    $(document).ready(function() {
        const stocks_field           = $("#stocks"),
            selling_price_field      = $("#selling_price"),
            total_price_field        = $("#total_price"),
            date_field               = $("#date"),
            customer_order_container = $("#customer_order_container"),
            requested_quantity_field = $("#requested_quantity");

        let item_weight         = 0,
            item_selling_price  = 0,
            requested_quantity  = 0,
            item_id             = 0,
            total_price         = 0,
            date                = null,
            item_name           = null,
            html                = null,
            customer_orders     = [],
            item_id_list        = [],
            selected_item       = [];

        // Get item's data
        $("#item_dropdown").on("change", function () {
            item_id = $(this).val();

            $.ajax({
                method: "POST",
                url: "{{ route('admin.item.get_data') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    item_id: item_id
                },
                dataType: "JSON",
                success: function (data) {
                    clearRequestedData();

                    item_weight         = parseFloat(data.final_weight).toFixed(2);
                    item_selling_price  = parseFloat(data.selling_price).toFixed(2);
                    item_name           = data.name;
                    item_id             = data.id;

                    stocks_field.val(Number(data.final_weight).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                    selling_price_field.val(Number(data.selling_price).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                    requested_quantity_field.removeAttr('disabled');
                }
            });
        });

        // Validate, and compute requested quantity
        $("#requested_quantity").on("keyup", function(e) {
            requested_quantity = $(this).val();
            requested_quantity = requested_quantity.replace(",", "");

            total_price = (parseFloat(item_selling_price) * parseFloat(requested_quantity)).toFixed(2);

            if ( ! isNaN(total_price)) {
                total_price_field.val(Number(total_price).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                date_field.removeAttr('disabled');
            } else {
                total_price_field.val("0.00");
                date_field.val("");
                date = null;
                date_field.attr('disabled', true);
            }
        });

        // Add item to table
        $("#add_item_btn").click(function() {
            if (validateDataRequest()) {
                html = "<tr class='item' data-item-id='"+item_id+"'>";
                html += "<td>"+item_name+"</td>";
                html += "<td>PHP "+Number(item_selling_price).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})+"</td>";
                html += "<td>"+Number(requested_quantity).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})+" kg</td>";
                html += "<td>PHP "+Number(total_price).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})+"</td>";
                html += "<td>"+date+"</td>";
                html += "</tr>";

                $("#item_count").text(item_id_list.count());

                customer_order_container.append(html);
                html = "";
            }
        });

        // Select item on table
        customer_order_container.on("click", "tr", function () {
            let order = $(this);

            if (order.hasClass('selected_order')) {
                console.log('---------------THE SELECTED ITEM WAS REMOVED---------------')
                order.removeClass('selected_order');
                _.remove(selected_item, function(value) {
                    return value == order[0];
                });
            } else {
                console.log('---------------AN ITEM WAS SELECTED---------------')
                order.addClass('selected_order');
                selected_item.push(order[0]);
            }

            console.log(selected_item);
        });

        // Remove selected item
        $("#remove_btn").on("click", function () {
            if (selected_item.count() == 0) {
                swal({
                    title: 'There are no selected items.',
                    confirmButtonText: 'Ok',
                    type: 'info'
                });
            } else {
                swal({
                title: 'Are you sure you want to remove the selected items in the list?',
                showCancelButton: true,
                confirmButtonText: 'Remove',
                cancelButtonText: 'Cancel',
                type: 'warning'
            }).then(result => {
                if (result.value) {
                    for(let i=0; i<selected_item.length; i++) {
                        item = selected_item[i];
                        // Remove selected item from item_id_list array
                        let itemIdListArray = _.remove(item_id_list, function(value) { return value === parseInt(item.dataset.itemId); });
                        // Remove selected item from customer_orders
                        let customerOrdersArray = _.remove(customer_orders, customer_order => customer_order.item_id === parseInt(item.dataset.itemId));
                        // Remove selected item from selected_item
                        let selectedItemArray = _.remove(selected_item, item => item.dataset.itemId === parseInt(item.dataset.itemId));
                        // Remove item from the customer's order table
                        item.remove();
                        $("#item_count").text(item_id_list.count());
                        console.log("---------------AN ITEM WAS REMOVED FROM ITEM ID LIST ARRAY---------------");
                        console.log(itemIdListArray);
                        console.log("---------------AN ITEM WAS REMOVED FROM CUSTOMER ORDERS ARRAY---------------");
                        console.log(customerOrdersArray);
                        console.log("---------------AN ITEM WAS REMOVED FROM SELECTED ITEM ARRAY---------------");
                        console.log(selectedItemArray);
                    }
                    swal('Selected Items was successfully removed from the list.', '', 'success');
                    console.log("---------------DISPLAYING DATA FROM SELECTED ITEM ARRAY AFTER DELETION");
                    console.log(selected_item);
                    console.log("*************** DELETING DATA FROM SELECTED ITEM ARRAY ***************");
                    selected_item = [];
                    console.log("---------------VERIFYING SELECTED ITEM ARRAY AFTER REINITIALIZING THE ARRAY---------------");
                    console.log(selected_item);
                }
            });
            }
        });

        // Get value from input#date
        date_field.on("change", function () {
            date = $(this).val();
        });

        // Validate Requests before adding an item
        function validateDataRequest() {
            if ($.inArray(item_id, item_id_list) != '-1') {
                swal({
                    title: '"'+ item_name +'" is already on the list.',
                    confirmButtonText: 'Ok',
                    type: 'info'
                });
            } else {
                if (item_id == 0) {
                    swal({
                        title: 'There is no selected item to add.',
                        confirmButtonText: 'Ok',
                        type: 'info'
                    });
                } else if (requested_quantity == 0) {
                    swal({
                        title: 'Requested Quantity field is empty.',
                        confirmButtonText: 'Ok',
                        type: 'info'
                    });
                } else if (date == null) {
                    swal({
                        title: 'Delivery Date field is empty.',
                        confirmButtonText: 'Ok',
                        type: 'info'
                    });
                } else if (parseFloat(requested_quantity) > parseFloat(item_weight)) {
                    console.log("Requested Quantity:" + requested_quantity);
                    console.log("Current Stocks:" + item_weight);

                    swal({
                        title: 'Requested Quantity must not be greater than the item\'s stocks.',
                        confirmButtonText: 'Ok',
                        type: 'info'
                    });
                } else {
                    customer_orders.push({
                        item_id: item_id,
                        item_name: item_name,
                        price: item_selling_price,
                        quantity: requested_quantity,
                        cost: total_price,
                        delivery_date: date
                    });

                    item_id_list.push(
                        item_id
                    );

                    console.log("---------------AN ITEM WAS PUSHED TO THE CUSTOMER ORDERS ARRAY---------------");
                    console.log(customer_orders);

                    return true;
                }
            }
        }

        // Clear all variables & input fields
        function clearRequestedData() {
            // Clear Variables
            requested_quantity  = 0;
            item_id             = 0;
            total_price         = 0;
            item_name           = null;
            html                = null;
            item_weight         = 0;
            item_selling_price  = 0;
            date                = null;


            // Clear Input Fields
            stocks_field.val("");
            selling_price_field.val("");
            requested_quantity_field.val("");
            date_field.val("");
            date_field.attr('disabled', true);
            total_price_field.val("0.00");
        }
    });
</script>