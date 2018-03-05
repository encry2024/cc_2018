<!DOCTYPE html>
    @langrtl
        <html lang="{{ app()->getLocale() }}" dir="rtl">
    @else
        <html lang="{{ app()->getLocale() }}">
    @endlangrtl
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', app_name())</title>
        <meta name="description" content="@yield('meta_description', 'Laravel 5 Boilerplate')">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        <link rel="stylesheet" href="{{ asset('js/chosen_v1.8.3/chosen-bootstrap-css.css') }}">
        <link rel="stylesheet" href="{{ asset('js/chosen_v1.8.3/chosen.css') }}">
        <link rel="stylesheet" href="{{ asset('notific8/dist/notific8.css') }}">
        @yield('meta')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        {{ style(mix('css/backend.css')) }}

        @stack('after-styles')
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('notific8/src/js/notific8.js') }}"></script>
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>

    <body class="{{ config('backend.body_classes') }}" onload="get_cart_queues();">
        @include('backend.includes.header')

        <div class="app-body">
            @include('backend.includes.sidebar')

            <main class="main">
                @include('includes.partials.logged-in-as')
                {!! Breadcrumbs::render() !!}

                <div class="container-fluid">
                    <div class="animated fadeIn">
                        <div class="content-header">
                            @yield('page-header')
                        </div><!--content-header-->

                        @include('includes.partials.messages')
                        @yield('content')
                    </div><!--animated-->

                    <div class="modal fade" tabindex="-1" role="dialog" id="order-item-modal">
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
                                                            <label id="item-stocks" class="form-control-label"></label>
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

                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control input-sm">
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
                </div><!--container-fluid-->
            </main><!--main-->

            @include('backend.includes.aside')
        </div><!--app-body-->

        @include('backend.includes.footer')

        <!-- Scripts -->

        @stack('before-scripts')
        {!! script(mix('js/backend.js')) !!}
        @stack('after-scripts')
        <script>
            const cart_container = $("#cart-container");

            function get_cart_queues()
            {
                $.ajax({
                    type: 'GET',
                    url:  "{{ route('admin.supplier.queues') }}",
                    dataType: 'JSON',
                    success: function(data) {
                        $("#cart_queues_count").text(data);
                    }
                })
            }

            $("#cart-btn").click(function() {
                $.ajax({
                    type: 'GET',
                    url:  "{{ route('admin.cart.queues') }}",
                    dataType: 'JSON',
                    success: function(data) {
                        let url                      = '';
                        let notif_supplier_container = '';

                        cart_container.find('a').remove();

                        for(let i=0; i < data.length; i++) {
                            const supplier_name                 = data[i].name;
                            const item_id                       = data[i]['id'];
                            const item_queued_item_per_supplier = data[i]['queued_item_per_supplier'];

                            url = "{{ URL::to('/') }}/admin/cart?name=:supplier_name&status=QUEUE";
                            url = url.replace(':supplier_name', supplier_name);

                            notif_supplier_container += "<a class='dropdown-item' href='"+ url +"'>";
                            notif_supplier_container += "You have <strong> "+item_queued_item_per_supplier+" queued item(s)</strong>";
                            notif_supplier_container += " for <strong>"+ supplier_name +"</strong></a>";
                        }

                        cart_container.append(notif_supplier_container);
                    }
                })
            })

            $("#supplier-dropdown").chosen();

            const numericField = document.getElementsByClassName('numeric-input');

            for(let elementIndex=0; elementIndex<numericField.length; elementIndex++) {
                new Cleave(numericField[elementIndex], {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand'
                });
            }
        </script>
    </body>
</html>
