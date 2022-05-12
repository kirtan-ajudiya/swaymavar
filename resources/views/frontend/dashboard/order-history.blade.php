@extends('frontend.dashboard.inc.sidebar')
    @section('navbar')
        <section>
            <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="">My Account</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order History</li>
                    </ol>
                </div>
                </div>
            </div>
            </div>
        </section>
    @endsection
    @section('dashboard.content')
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="p-2">
                    <h2 class="h2 text-left">Order History</h2>
                    <p>This is your account order history. You can review and check the status of all your orders.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            </div>
        </div>
        <hr>
        <div class="row">
            @if($orders == "")
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h6 class="text-center">No records</h6>
            </div>
        @endif
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive order-history">
                    <table class="table table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th>ORDER</th>
                                <th>DATE</th>
                                <th>STATUS</th>
                                <th>TOTAL</th>
                                <th>ACTIONS</th>
                                <th>Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td><a href="{{route('order.view', encrypt($order->id))}}">#{{$order->code}}</a></td>
                                <td>{{ date("F j, Y", $order->date) }}</td>
                                <td>{{$order->payment_status}}</td>
                                <td>{{ format_price($order->orderDetails->sum('price'))}} for {{$order->orderDetails->count('order_id')}} items</td>
                                <td><a href="{{route('order.view', encrypt($order->id))}}" class="black-flat-button">View</a></td>
                                <td><a href="{{route('customer.invoice.download', $order->id)}}"><i class="fa fa-print print" aria-hidden="true"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @endsection
