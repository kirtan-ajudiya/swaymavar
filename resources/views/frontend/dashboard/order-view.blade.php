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
                    <li class="breadcrumb-item active" aria-current="page">Order Details</li>
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
                    <h2 class="h2 text-left">Order Details</h2>
                    <p>Order <strong>#{{$orders->code}}</strong> was placed on <strong>{{ date("F j, Y", $orders->date) }}</strong> and is currently <strong>{{$orders->payment_status}}</strong>.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive order-history">
                    <table class="table table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th>PRODUCTS</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders->orderDetails as $order)
                            <tr>
                                <td><a href="{{route('product', $order->product->slug)}}">{{$order->product_name}}</a> x 1</td>
                                <td>{{ format_price($order->price)}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td class="colored-td">SUBTOTAL:</td>
                                <td> {{ format_price($orders->orderDetails->sum('price'))}} </td>
                            </tr>
                            <tr>
                                <td class="colored-td">SHIPPING:</td>
                                <td>{{$order->shipping_cost}}</td>
                            </tr>
                            @php
                                $type = trim($orders->payment_type, '_');
                            @endphp
                            <tr>
                                <td class="colored-td">PAYMENT METHOD:</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $orders->payment_type)) }}</td>
                            </tr>
                            <tr>
                                <td class="colored-td">TOTAL:</td>
                                <td> {{ format_price($orders->orderDetails->sum('price'))}} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @php
            $address = json_decode($orders->shipping_address);
            $baddress = json_decode($orders->billing_address);

            @endphp
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <h4 class="mb-4">Billing address</h4>
                <div class="shipping-address">
                    <h6>{{$baddress->name}}</h6>
                    <p style="margin: 0;">{{$baddress->address}}</p>
                    <p style="margin: 0;">{{$baddress->city}} - {{$baddress->postal_code}}</p>
                    <p style="margin: 0;">{{$baddress->state}}, {{$baddress->country}}</p>
                    <p>{{$baddress->phone}}</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <h4 class="mb-4">Shipping address</h4>
                <div class="shipping-address">
                    <h6>{{$address->name}}</h6>
                    <p style="margin: 0;">{{$address->address}}</p>
                    <p style="margin: 0;">{{$address->city}} - {{$address->postal_code}}</p>
                    <p style="margin: 0;">{{$address->state}}, {{$address->country}}</p>
                    <p>{{$address->phone}}</p>
                </div>
            </div>

        </div>
        <div class="text-right mt-4">
            <a href="{{route('customer.invoice.download', $orders->id)}}" class="black-flat-button invoice"><i class="fa fa-download" aria-hidden="true"></i> Download Invoice </a>
        </div>
    @endsection

    <style>

    </style>
