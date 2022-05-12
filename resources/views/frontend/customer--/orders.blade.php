@extends('frontend.customer.inc.sidenav')
    @section('sidenavleft')
    @php
        $banner = \App\Banner::where('published', 1)->where('position', 6)->first();
    @endphp
    <div class="section first-section"
        style="background: url({{asset($banner->photo)}}) no-repeat;background-size: cover;background-position: center;">
        <div class="row">
            <div class="col lg-12 page-title">
                <h1 class="text-white margin-bottom text-uppercase text-center">Orders</h1>
                <div class="text-small text-align-center"><a href="{{route('home')}}" class="on-dark">Home</a> / <span
                        class="low-text-contrast text-white">Order List</span></div>
            </div>
        </div>
    </div>

    @section('sidenavright')
    <div class="col lg-9 md-12 no-margin-bottom padding-top-bottom-double">
        <h2>Recent Orders</h2>
        @if(count($orders) > 0)
        <div class="container d-grid">
            <div class="col lg-12 no-padding-lr">
                <div class="responsive-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Order</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Total</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $key=>$order)
                                <tr>
                                    <th scope="row"><a href="{{route('order.view', encrypt($order->id))}}" class="inline-link fw-800">#{{ $order->code }}</a>
                                    </th>
                                    <td>{{ date("F j, Y", $order->date) }}</td>
                                    <td>  {{ ucfirst(str_replace('_', ' ', $order->orderDetails->first()->delivery_status)) }}</td>
                                    <td>{{single_price($order->orderDetails->sum('price'))}} for {{$order->orderDetails->count('order_id')}} item</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</td>
                                    <td><a href="{{route('order.view', encrypt($order->id))}}" class="inline-link fw-500"><i
                                                class="fa is-24px mr-10"></i> View</a> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $orders->links() }}
            </div>
        </div>

        @else
            <p> No Record Found </p>
        @endif
    </div>
    @endsection

@endsection
