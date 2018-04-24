<script>
    const stocks_field       = $("#stocks"),
    selling_price_field      = $("#selling_price"),
    total_price_field        = $("#total_price"),
    date_field               = $("#date"),
    total_cost_label         = $("#total_cost_label");
    customer_order_container = $("#customer_order_container"),
    payment_type             = $("#payment_type_dropdown"),
    requested_quantity_field = $("#requested_quantity");

    let item_weight     = 0,
    item_selling_price  = 0,
    requested_quantity  = 0,
    item_id             = 0,
    total_price         = 0,
    remaining_credit    = 0,
    customer_orders     = [],
    item_id_list        = [],
    selected_item       = [],
    date                = null,
    item_name           = null,
    html                = null,
    collection_date     = null,
    payment_value       = null;

    function getPaymentValue(value)
    {
        payment_value = value + " Day(s) Term";
        console.log(payment_value);
    }

    $(document).ready(function() {
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
            let discount        = $("#discount").val();

            requested_quantity = $(this).val();
            requested_quantity = requested_quantity.replace(",", "");

            total_price = computeTotalPrice(discount, item_selling_price, requested_quantity);

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
                total_cost_label.text(Number(displayTotalCost()).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));

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
                    title: 'There are no selected items to remove.',
                    confirmButtonText: 'Ok',
                    type: 'warning'
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
                        // Recompute total cost.
                        total_cost_label.text(Number(displayTotalCost()).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));

                        let credit_cost = displayTotalCost();
                        let usable_credit = "{{ number_format($customer->usable_credit, 2) }}";

                        if (credit_cost != 0) {
                            remaining_credit = parseFloat(usable_credit - credit_cost);

                            $("#usable_credit").val(Number(remaining_credit).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                        } else {
                            $("#usable_credit").val("{{ number_format($customer->usable_credit, 2) }}");
                        }

                        swal('Selected Items was successfully removed from the list.', '', 'success');
                        console.log("---------------DISPLAYING DATA FROM SELECTED ITEM ARRAY AFTER DELETION");
                        console.log(selected_item);
                        console.log("*************** REINITIALIZING DATA FROM SELECTED ITEM ARRAY ***************");
                        selected_item = [];
                        console.log("---------------VERIFYING SELECTED ITEM ARRAY AFTER REINITIALIZING THE ARRAY---------------");
                        console.log(selected_item);
                    }
                });
            }
        });

        $("#create_order_btn").click(function () {
            if (customer_orders.count() == 0) {
                swal({
                    title: "There are no customer orders to submit",
                    confirmButtonText: 'Ok',
                    type: 'warning'
                });
            } else {
                swal({
                    title: "Are you sure you want to create this order?",
                    confirmButtonText: 'Yes, Create Order',
                    cancelButtonText: 'No',
                    type: 'warning'
                }).then(result => {
                    if (result.value) {
                        const collection_date = $("#collection_date").val();

                        submitDataRequest(customer_orders, collection_date);
                    }
                })
            }
        });

        $("#payment_type_dropdown").on("change", function () {
            let type                    = $(this);
            const day_term_container    = $("#day_term_container");
            payment_value               = null;

            if (type.val() == "term") {
                day_term_container.append('<input type="text" class="form-control numeric-input col-sm-8" style="margin-left: 11.85rem; width: 65%;" placeholder="Day(s) Term" id="day_term" onkeyup="getPaymentValue($(this).val())">');
                day_term_container.hide().slideDown();
                reinitializeCleave();
            } else {
                if ( day_term_container.css('display', 'block;')) {
                    day_term_container.slideUp();
                    $("#day_term").val(null);
                    day_term_container.find('input.numeric-input').remove();
                }

                payment_value = type.val();
            }
        });

        // Get value from input#date
        date_field.on("change", function () {
            date = $(this).val();
        });

        $("#collection_date").on("change", function () {
            collection_date = $(this).val();
        })

        function computeTotalPrice(customerDiscount, selling_price, quantity)
        {
            let total_cost      = selling_price * quantity;
            let discount        = parseFloat(customerDiscount) / 100;
            let discounted_cost = 0;

            discount            = parseFloat(total_cost) * parseFloat(discount);
            discounted_cost     = total_cost - discount;

            return parseFloat(discounted_cost).toFixed(2);
        }

        // Validate Requests before adding an item
        function validateDataRequest()
        {
            if ($.inArray(item_id, item_id_list) != '-1') {
                swal({
                    title: '"'+ item_name +'" is already on the list.',
                    confirmButtonText: 'Ok',
                    type: 'warning'
                });
            } else {
                if (collection_date == null) {
                    swal({
                        title: 'Collection Date field is empty.',
                        confirmButtonText: 'Ok',
                        type: 'warning'
                    });
                } else if (payment_type.val() == "") {
                    swal({
                        title: 'You have not yet selected a payment method',
                        confirmButtonText: 'Ok',
                        type: 'warning'
                    });
                } else if ((payment_type.val() == "term" && $("#day_term").val() == "")) {
                    swal({
                        title: 'Day(s) Term field is empty.',
                        confirmButtonText: 'Ok',
                        type: 'warning'
                    });
                } else if (item_id == 0) {
                    swal({
                        title: 'There is no selected item to add.',
                        confirmButtonText: 'Ok',
                        type: 'warning'
                    });
                } else if (requested_quantity == 0) {
                    swal({
                        title: 'Requested Quantity field is empty.',
                        confirmButtonText: 'Ok',
                        type: 'warning'
                    });
                } else if (parseFloat(requested_quantity) > parseFloat(item_weight)) {
                    console.log("Requested Quantity:" + requested_quantity);
                    console.log("Current Stocks:" + item_weight);

                    swal({
                        title: 'Requested Quantity must not be greater than the item\'s stocks.',
                        confirmButtonText: 'Ok',
                        type: 'warning'
                    });
                } else if (date == null) {
                    swal({
                        title: 'Delivery Date field is empty.',
                        confirmButtonText: 'Ok',
                        type: 'warning'
                    });
                } else {
                    if (computeRemainingUsableCredit()) {
                        customer_orders.push({
                            item_id: item_id,
                            requested_quantity: requested_quantity,
                            total_cost: total_price,
                            delivery_date: date
                        });

                        item_id_list.push(
                            item_id
                        );

                        $("#usable_credit").val(Number(remaining_credit).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));

                        console.log("---------------AN ITEM WAS PUSHED TO THE CUSTOMER ORDERS ARRAY---------------");
                        console.log(customer_orders);

                        return true;
                    } else {
                        swal({
                            title: 'Insufficient Usable Credit.',
                            confirmButtonText: 'Ok',
                            type: 'warning'
                        });
                    }
                }
            }
        }

        // Clear all variables & input fields
        function clearRequestedData()
        {
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

        function submitDataRequest(requests, collection_date)
        {
            balance = total_cost_label.text(Number(displayTotalCost()).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));

            $.ajax({
                type: "POST",
                url: '{{ route("admin.customer.order.store", $customer->id) }}',
                data: {
                    _token: "{{ csrf_token() }}",
                    customer_orders: requests,
                    collection_date: collection_date,
                    balance: balance.text(),
                    payment_type: payment_value
                },
                dataType: "JSON",
                success: function (data) {
                    console.log('---------------RETURNED DATA---------------');
                    console.log(data);
                    if (data == true) {
                        swal({
                            title: "Order was successfully created.",
                            confirmButtonText: 'Ok',
                            type: 'success'
                        }).then(result => {
                            window.location.reload();
                        });
                    }
                },
                error: function () {
                    swal({
                        title: "Something went wrong while processing the customer's order. Please contact the developer.",
                        confirmButtonText: 'Ok',
                        type: 'error'
                    });
                }
            });
        }

        function displayTotalCost()
        {
            let total_cost = 0;

            for (let i=0 ; i<customer_orders.length ; i++) {
                let data = customer_orders[i];

                total_cost += parseFloat(data.total_cost);
            }

            return total_cost;
        }

        function computeRemainingUsableCredit()
        {
            let usable_credit = $("#usable_credit").val();

            remaining_credit = parseFloat(usable_credit - total_price);

            if (remaining_credit > 0) {
                return true;
            } else {
                return false;
            }
        }

        function reinitializeCleave()
        {
            for(let elementIndex=0; elementIndex<numericField.length; elementIndex++) {
                new Cleave(numericField[elementIndex], {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand'
                });
            }
        }
    });
</script>