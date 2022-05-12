@extends('frontend.customer.inc.sidenav')
    @section('sidenavleft')

    <div class="section first-section"
        style="background: url('images/banner-product-listing.jpg') no-repeat;background-size: cover;background-position: center;">
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
                            <tr>
                                <th scope="row"><a href="order-detail-page.html" class="inline-link fw-800">#00001</a>
                                </th>
                                <td>30, Sep</td>
                                <td>On hold</td>
                                <td>₹ 404.00 for 1 item</td>
                                <td>Cash on delivery</td>
                                <td><a href="order-detail-page.html" class="inline-link fw-500"><i
                                            class="fa is-24px mr-10"></i> View</a></td>
                            </tr>
                            <tr>
                                <th scope="row"><a href="order-detail-page.html" class="inline-link fw-800">#00002</a>
                                </th>
                                <td>30, Sep</td>
                                <td>On hold</td>
                                <td>₹ 404.00 for 1 item</td>
                                <td>Cash on delivery</td>
                                <td><a href="order-detail-page.html" class="inline-link fw-500"><i
                                            class="fa is-24px mr-10"></i> View</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection

@endsection