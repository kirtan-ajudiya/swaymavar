@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <!-- <a href="{{ route('sellers.create')}}" class="btn btn-info pull-right">{{__('add_new')}}</a> -->
    </div>
</div>

<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Customers')}}</h3>
        <div class="clearfix" style="text-align: center;">
            <form class="" id="sort_customers" action="" method="GET">
                <div class="box-inline">
                    <div class="" style="min-width: 400px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder=" Type email or name & Enter">
                    </div>

                </div>
                                         <button class="btn btn-primary" type="button" onclick="sort_customers();">
                                        {{__('Search Customer')}}
                         </button>
            </form>
        </div>
    </div>
  <?php
    $affiliateUserId=array();
    
   foreach ($Affiliateusers as $value) {
       $affiliateUserId[]=$value->user_id;
   }
   // echo "<pre>";
   // print_r($affiliateUserId);
   // echo "<pre>";
  ?>  
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Email Address')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>@if(isset($customers))

                @foreach($customers as $key => $customer)
                    <tr>
                        <td>{{ ($key+1) + ($customers->currentPage() - 1)*$customers->perPage() }}</td>
                        <td>{{$customer->user->name}}</td>
                        <td>{{$customer->user->email}}</td>
                        <td> 
                           @if(!in_array($customer->user_id,$affiliateUserId))   
                            <a href="{{route('affiliate.admin_store', $customer->user_id)}}" class="btn btn-primary"  type="button">
                            {{__('Default Affiliate')}} 
                            </a>
                            @endif
                        </td>
                    </tr>
                @endforeach @endif
            </tbody>
        </table>
    </div>
    
</div>

 <!-- Basic Data Tables -->
    <!--===================================================-->
    <div class="panel">
        <div class="panel-heading bord-btm clearfix pad-all h-100">
            <h3 class="panel-title pull-left pad-no">{{__('Default Affiliate Users')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Phone')}}</th>
                    <th>{{__('Email Address')}}</th>
                    <th>{{ __('Due Amount') }}</th>
                    <th>{{ __('Option') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($affiliate_users as $key => $affiliate_user)
                    @if($affiliate_user->user != null)
                        <tr>
                            <td>{{ ($key+1) + ($affiliate_users->currentPage() - 1)*$affiliate_users->perPage() }}</td>
                            <td>{{$affiliate_user->user->name}}</td>
                            <td>{{$affiliate_user->user->phone}}</td>
                            <td>{{$affiliate_user->user->email}}</td>
                            <td>
                                @if ($affiliate_user->balance >= 0)
                                    {{ single_price($affiliate_user->balance) }}
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{route('affiliate.tree_view',$affiliate_user->user_id)}}">{{__('Tree View')}}</a>
                            </td>
                            
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                <div class="pull-right">
                    {{ $affiliate_users->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script type="text/javascript">
        function sort_customers(){
            $('#sort_customers').submit();
        }
    </script>
@endsection
