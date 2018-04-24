@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-white">
                    <h5>Dashboard</h5>
                </div><!--card-header-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-white">
                    <h5>Post-Dated Checks</h5>
                </div><!--card-header-->

                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            @foreach ()
                            <tr>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--card-->
        </div><!--col-->

        <div class="col">
            <div class="card">
                <div class="card-header bg-white">
                    <h5>Terms</h5>
                </div><!--card-header-->

                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            @foreach ()
                            <tr>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--card-->
        </div><!--col-->
    </div>
@endsection
