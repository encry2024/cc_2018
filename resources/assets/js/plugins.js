/**
 * Allows you to add data-method="METHOD to links to automatically inject a form
 * with the method on click
 *
 * Example: <a href="{{route('customers.destroy', $customer->id)}}"
 * data-method="delete" name="delete_item">Delete</a>
 *
 * Injects a form with that's fired on click of the link with a DELETE request.
 * Good because you don't have to dirty your HTML with delete forms everywhere.
 */
function addMethodForms() {
    $('[data-method]').append(function () {
        if (! $(this).find('form').length > 0)
            return "\n" +
                "<form action='" + $(this).attr('href') + "' method='POST' name='"+$(this).attr('data-method')+"_item' style='display:none'>\n" +
                "<input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n" +
                "<input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr('content') + "'>\n" +
                "</form>\n";
        else
            return "";
    })
        .removeAttr('href')
        .attr('style', 'cursor:pointer;')
        .attr('onclick', '$(this).find("form").submit();');
}

/**
 * Place any jQuery/helper plugins in here.
 */
$(function(){
    $("select").chosen();

    /**
     * Add the data-method="delete" forms to all delete links
     */
    addMethodForms();

    Array.prototype.count = function(array) {
        return this.length;
    };

    $(document).ajaxStart(function () {
        $("#ajaxSpinnerContainer").show();
    }).ajaxError(function (event, jqxhr, settings, thrownError) {
        $("#ajaxSpinnerContainer").hide();
    }).ajaxStop(function () {
        $("#ajaxSpinnerContainer").hide();
    });

    $('#add_payment_modal').on('shown.bs.modal', function () {
        $('#payment_dropdown', this).chosen('destroy').chosen();
    });

    /**
     * Bind all bootstrap tooltips & popovers
     */
    $("[data-toggle='tooltip']").tooltip({container: "body"});

    /**
     * Generic confirm form delete using Sweet Alert
     */
    $('body').on('submit', 'form[name=delete_item]', function(e){
        e.preventDefault();

        let form = this,
            link = $('a[data-method="delete"]'),
            cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : "Cancel",
            confirm = (link.attr('data-trans-button-confirm')) ? link.attr('data-trans-button-confirm') : "Yes, delete",
            title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : "Are you sure you want to delete this item?";

        swal({
            title: title,
            showCancelButton: true,
            confirmButtonText: confirm,
            cancelButtonText: cancel,
            type: 'warning'
        }).then((result) => {
            result.value && form.submit();
        });
    }).on('submit', 'form[name=patch_item]', function(e){
        e.preventDefault();

        let form = this,
            link = $('a[data-method="patch"]'),
            cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : "Cancel",
            confirm = (link.attr('data-trans-button-confirm')) ? link.attr('data-trans-button-confirm') : "Yes, delete",
            title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : "Are you sure you want to request a restock for this item?";

        swal({
            title: title,
            showCancelButton: true,
            confirmButtonText: confirm,
            cancelButtonText: cancel,
            type: 'warning'
        }).then((result) => {
            result.value && form.submit();
        });
    }).on('click', 'a[name=confirm_item]', function(e){
        /**
         * Generic 'are you sure' confirm box
         */
        e.preventDefault();

        let link = $(this),
            title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : "Are you sure you want to do this?",
            cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : "Cancel",
            confirm = (link.attr('data-trans-button-confirm')) ? link.attr('data-trans-button-confirm') : "Continue";

        swal({
            title: title,
            showCancelButton: true,
            confirmButtonText: confirm,
            cancelButtonText: cancel,
            type: 'info'
        }).then((result) => {
            result.value && window.location.assign(link.attr('href'));
        });
    }).on('click', 'a[name=order_btn]', function (e) {
        e.preventDefault();

        let link = $(this),
            credit_limit = link.attr('data-credit_limit'),
            current_credit = link.attr('data-current_credit');

            credit_limit = parseFloat(credit_limit);
            current_credit = parseFloat(current_credit);

        if (current_credit >= credit_limit) {
            swal({
                title: 'The customers credit limit has already reached',
                confirmButtonText: 'Ok',
                type: 'error'
            })
        } else {
            window.location = link.attr('href');
        }
    });

    $("#payment_dropdown").on('change', function () {
        let dropdown = $(this),
            html = "";

        $("#field_container").find("div.form-group").remove();
        $("#field_container").find("hr").remove();
        $("#payment_method_container").remove();

        if (dropdown.val() == "Check") {
            html = '<div class="form-group row">';
            html += '<label class="form-control-label col-sm-3">Type of Check</label>';
            html += '<div class="col-sm-9">';
            html += '<select name="check_type" id="check_type" class="form-control" data-placeholder="-- Select Payment Method --">';
            html += '<option value=""></option>';
            html += '<option value="dated">Dated Check</option>';
            html += '<option value="post-dated">Post-Dated Check</option>';
            html += '</select></div></div><hr>';


            $("#field_container").append(html).hide().slideDown();
            $("#container").append('<div id="payment_method_container"></div>');
            $("#check_type").chosen();

            const numericField = document.getElementsByClassName('numeric-input');

            for(let elementIndex=0; elementIndex<numericField.length; elementIndex++) {
                new Cleave(numericField[elementIndex], {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand'
                });
            }
        } else if (dropdown.val() == "Cash") {
            html = '<div id="payment_method_child_container"><div class="form-group row">';
            html += '<label class="form-control-label col-sm-3">Date</label>';
            html += '<div class="col-sm-9">';
            html += '<input class="form-control" type="text" value="'+moment().format("YYYY-MM-DD")+'" readonly name="date">'
            html += '</div></div>';

            html += '<div class="form-group row">';
            html += '<label class="form-control-label col-sm-3">Amount</label>';
            html += '<div class="input-group col-sm-9">';
            html += '<span class="input-group-text">PHP</span>';
            html += '<input class="form-control numeric-input" type="text" name="amount_received">'
            html += '</div></div></div>';

            $("#field_container").append(html).hide().slideDown();

            const numericField = document.getElementsByClassName('numeric-input');

            for(let elementIndex=0; elementIndex<numericField.length; elementIndex++) {
                new Cleave(numericField[elementIndex], {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand'
                });
            }
        }
    });

    $(document).on('change', '#check_type', function () {
        let html = "";
        $("#payment_method_child_container").remove();
        if ($(this).val() == "dated") {
            html = '<div id="payment_method_child_container"><div class="form-group row">';
            html += '<label class="form-control-label col-sm-3">Date</label>';
            html += '<div class="col-sm-9">';
            html += '<input class="form-control" type="text" value="'+moment().format("YYYY-MM-DD")+'" disabled name="date">'
            html += '</div></div>';

            html += '<div class="form-group row">';
            html += '<label class="form-control-label col-sm-3">Check Number</label>';
            html += '<div class="col-sm-9">';
            html += '<input class="form-control" type="text" name="account_number">'
            html += '</div></div>';

            html += '<div class="form-group row">';
            html += '<label class="form-control-label col-sm-3">Bank</label>';
            html += '<div class="col-sm-9">';
            html += '<input class="form-control" type="text" name="bank">'
            html += '</div>';
            html += '</div>';

            html += '<div class="form-group row">';
            html += '<label class="form-control-label col-sm-3">Amount</label>';
            html += '<div class="input-group col-sm-9">';
            html += '<span class="input-group-text">PHP</span>';
            html += '<input class="form-control numeric-input" type="text" name="amount_received">'
            html += '</div>';
            html += '</div>';
            html += '</div>';

            $("#payment_method_container").append(html).hide().slideDown();

            const numericField = document.getElementsByClassName('numeric-input');

            for(let elementIndex=0; elementIndex<numericField.length; elementIndex++) {
                new Cleave(numericField[elementIndex], {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand'
                });
            }
        } else {
            $("#payment_method_container").hide().slideUp();
            $("#payment_method_child_container").remove();
            html = '<div id="payment_method_child_container"><div class="form-group row">';
            html += '<label class="form-control-label col-sm-3">Date</label>';
            html += '<div class="col-sm-9">';
            html += '<input class="form-control" type="date" name="date">'
            html += '</div></div>';

            html += '<div class="form-group row">';
            html += '<label class="form-control-label col-sm-3">Check Number</label>';
            html += '<div class="col-sm-9">';
            html += '<input class="form-control" type="text" name="account_number">'
            html += '</div></div>';

            html += '<div class="form-group row">';
            html += '<label class="form-control-label col-sm-3">Bank</label>';
            html += '<div class="col-sm-9">';
            html += '<input class="form-control" type="text" name="bank">';
            html += '</div>';
            html += '</div>';

            html += '<div class="form-group row">';
            html += '<label class="form-control-label col-sm-3">Amount</label>';
            html += '<div class="input-group col-sm-9">';
            html += '<span class="input-group-text">PHP</span>';
            html += '<input class="form-control numeric-input" type="text" name="amount_received">'
            html += '</div>';
            html += '</div>';
            html += '</div>';

            $("#payment_method_container").append(html).hide().slideDown();

            const numericField = document.getElementsByClassName('numeric-input');

            for(let elementIndex=0; elementIndex<numericField.length; elementIndex++) {
                new Cleave(numericField[elementIndex], {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand'
                });
            }
        }
    });

    $("#close_add_payment_modal").on("click", function () {
        swal({
            title: "Are you sure you want to cancel add payment?",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            type: "warning"
        }).then(result => {
            if (result.value) {
                $("#add_payment_modal").modal("hide");
                $("#field_container").find("div.form-group").remove();
                $("#field_container").find("hr").remove();
                $("#payment_method_container").remove();
                $('#payment_dropdown').val("");
            }
        });
    })
});

