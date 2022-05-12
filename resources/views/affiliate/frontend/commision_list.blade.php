@extends('frontend.layouts.app')

@section('content')
<style type="text/css">
    table tbody td{
        color: black!important;
    } 
</style>
    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @if(Auth::user()->user_type == 'seller')
                        @include('frontend.inc.seller_side_nav')
                    @elseif(Auth::user()->user_type == 'customer')
                        @include('frontend.inc.customer_side_nav')
                    @endif
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Commision')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li><a href="{{ route('affiliate.user.index') }}">{{__('Affiliate System')}}</a></li>
                                            <li class="active"><a href="{{ route('affiliate.user.index') }}">{{__('Commision List')}}</a></li>
                                        </ul>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 offset-md-2">
                                <div class="dashboard-widget text-center green-widget text-white mt-4 c-pointer">
                                    <i class="fa fa-dollar"></i>
                                    <span class="d-block title heading-3 strong-400">{{ single_price(Auth::user()->affiliate_user->balance - $pendingAmt)  }}</span>
                                    <span class="d-block sub-title">{{ __('Affiliate Balance') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 offset-md-1">
                                <div class="dashboard-widget text-center yellow-widget text-white mt-4 c-pointer">
                                    <i class="fa fa-dollar"></i>
                                    <span class="d-block title heading-3 strong-400">{{ single_price($pendingAmt) }}</span>
                                    <span class="d-block sub-title">{{ __('Affiliate Pending Balance') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card no-border mt-5">
                            <div class="card-header py-3">
                                <h4 class="mb-0 h6">{{__('Commision List')}}</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-responsive-md mb-0">
                                    <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Date')}}</th>
                    <th>{{__('Message')}}</th>
                    <th>{{__('From User Name')}}</th>
                    <th>{{__('Amount')}}</th>
                    <th>{{__('Product Link')}}</th>
                </tr>
            </thead>
            <tbody style="color: black!important">
                @foreach($commision_list as $key => $commision)
                <?php
                     $flag=0;
                     $orederdate = date('m/d/Y',strtotime('+30 days',strtotime($commision->created_at))) . PHP_EOL;
                     if($orederdate < date('m/d/Y')){
                          $flag=1;
                     } 
                ?>
                    <tr style="background-color: @if($flag==0) #FFD04D @else #0ACF97 @endif;">
                        <td>{{ $key+1 }}</td>
                        <td>{{ $commision->created_at }}</td>
                        <td>{{ $commision->message }}</td>
                        <td>{{ $commision->user_name }}</td>
                        <td>
                            {{ single_price($commision->amount) }}
                        </td>
                        <td style="text-align: center!important;">
                            @if($commision->product_id != 0)
                                @if(isset($products_list[$commision->product_id]) && $products_list[$commision->product_id] != "" )
                                  <a target="#" href="{{route('product',$products_list[$commision->product_id])}}">
                                    <i class="fa fa-globe" style="font-size: 25px;"></i></a>
                                  @else
                                  <span>{{__('Product Link Deprecate')}}</span> 
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
                            </div>
                        </div>
                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $commision_list->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
@endsection
