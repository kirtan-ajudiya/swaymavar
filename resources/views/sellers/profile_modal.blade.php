<div class="panel">
    <div class="panel-body">
        <div class="">
            <!-- Simple profile -->
            <div class="text-center">
                <div class="pad-ver">
                    <img src="{{ asset($seller->user->avatar_original) }}" class="img-lg img-circle" alt="Profile Picture">
                </div>
                <h4 class="text-lg text-overflow mar-no">{{ $seller->user->name }}</h4>
                <p class="text-sm text-muted">{{ $seller->user->shop->name }}</p>

                <div class="pad-ver btn-groups">
                    <a href="{{ $seller->user->shop->facebook }}" class="btn btn-icon demo-pli-facebook icon-lg add-tooltip" data-original-title="Facebook" data-container="body"></a>
                    <a href="{{ $seller->user->shop->twitter }}" class="btn btn-icon demo-pli-twitter icon-lg add-tooltip" data-original-title="Twitter" data-container="body"></a>
                    <a href="{{ $seller->user->shop->google }}" class="btn btn-icon demo-pli-google-plus icon-lg add-tooltip" data-original-title="Google+" data-container="body"></a>
                </div>
            </div>
            <hr>

            <!-- Profile Details -->
            <p class="pad-ver text-main text-sm text-uppercase text-bold">{{__('About')}} {{ $seller->user->name }}</p>
            <p><i class="demo-pli-map-marker-2 icon-lg icon-fw"></i>{{ $seller->user->shop->address }}</p>
            <p><a href="{{ route('shop.visit', $seller->user->shop->slug) }}" class="btn-link"><i class="demo-pli-internet icon-lg icon-fw"></i>{{ $seller->user->shop->name }}</a></p>
            <p><i class="demo-pli-old-telephone icon-lg icon-fw"></i>{{ $seller->user->phone }}</p>

            <p class="pad-ver text-main text-sm text-uppercase text-bold">{{__('Payout Info')}}</p>
            <p>{{__('Bank Name')}} : {{ $seller->bank_name }}</p>
            <p>{{__('Bank Acc Name')}} : {{ $seller->bank_acc_name }}</p>
            <p>{{__('Bank Acc Number')}} : {{ $seller->bank_acc_no }}</p>
            <p>{{__('Bank Routing Number')}} : {{ $seller->bank_routing_no }}</p>

            <br>
            <p class="pad-ver text-main text-sm text-uppercase text-bold">{{__('Document')}}</p>
            <hr>
            <div class="row">

                <p class="pad-ver text-main text-sm text-uppercase ">{{__('Adhar Card')}}</p>
                @if(isset($seller->adhar_front))
                <div class="col-sm-6">
                 <a href="{{asset($seller->adhar_front)}}" target="#">
                 <img src="{{asset($seller->adhar_front)}}" width="200px" height="100px">
                 </a>
                </div> 
                 <div class="col-sm-6">
                 <a href="{{asset($seller->adhar_back)}}" target="#">   
                 <img src="{{asset($seller->adhar_back)}}" width="200px" height="100px">
                 </a>
                </div> 
                @endif
                @if(isset($seller->adhar_no))
                <div class="col-sm-12" style="text-align: center;padding-top:20px;">
                     <p>{{__('Adhar Card Number')}} : <strong>{{ $seller->adhar_no }}</strong></p> 
                </div> 
                @endif
            </div>
            <div class="row">
                <p class="pad-ver text-main text-sm text-uppercase ">{{__('Pan Card')}}</p>
                @if(isset($seller->pan_front))
                <div class="col-sm-6">
                 <a href="{{asset($seller->pan_front)}}" target="#">   
                 <img src="{{asset($seller->pan_front)}}" width="200px" height="100px">
             </a>
                </div>
                @endif
                @if(isset($seller->pan_no)) 
                <div class="col-sm-6" style="margin-top: 50px;">
                     <p>{{__('Pan Card Number')}} : <strong>{{ $seller->pan_no }}</strong></p> 
                </div> 
                @endif
            </div>
               
            <div class="row">
                <p class="pad-ver text-main text-sm text-uppercase ">{{__('GST Document')}}</p>
                 @if(isset($seller->gst_pdf))
                <div class="col-sm-6">
                 <a href="{{asset($seller->gst_pdf)}}" target="#" class="label label-table label-info">GST DOCUMENT</a>
                </div>
                @endif
                @if(isset($seller->gst_no)) 
                <div class="col-sm-6">
                     <p>{{__('GST Number')}} : <strong>{{ $seller->gst_no }}</strong></p> 
                </div> 
                @endif
            </div>

            <br>
            <br>

            <div class="table-responsive">
                <table class="table table-striped mar-no">
                    <tbody>
                    <tr>
                        <td>Total Products</td>
                        <td>{{ App\Product::where('user_id', $seller->user->id)->get()->count() }}</td>
                    </tr>
                    <tr>
                        <td>Total Orders</td>
                        <td>{{ App\OrderDetail::where('seller_id', $seller->user->id)->get()->count() }}</td>
                    </tr>
                    <tr>
                        <td>Total Sold Amount</td>
                        @php
                            $orderDetails = \App\OrderDetail::where('seller_id', $seller->user->id)->get();
                            $total = 0;
                            foreach ($orderDetails as $key => $orderDetail) {
                                if($orderDetail->order->payment_status == 'paid'){
                                    $total += $orderDetail->price;
                                }
                            }
                        @endphp
                        <td>{{ single_price($total) }}</td>
                    </tr>
                    <tr>
                        <td>Wallet Balance</td>
                        <td>{{ single_price($seller->user->balance) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
