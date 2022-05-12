@extends('layouts.app')

@section('content')

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{ __('Commision Log')}} : <b style="font-size: 16px;">{{$comm_name}}-( {{$comm_email}})</b></h3></h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Date')}}</th>
                    <th>{{__('Message')}}</th>
                    <th>{{__('From User Name')}}</th>
                    <th>{{__('Amount')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('Product Link')}}</th>
                </tr>
            </thead>
            <tbody>
               @php
                $clearedamt=0;
                $pending=0;
               @endphp
                @foreach($commision_list as $key => $commision)
                <?php
                     $flag=0;
                     $orederdate = date('m/d/Y',strtotime('+30 days',strtotime($commision->created_at))) . PHP_EOL;
                     $pending=$pending+$commision->amount;
                     if($orederdate < date('m/d/Y')){
                          $flag=1;
                          $clearedamt=$clearedamt+$commision->amount;
                     } 
                ?>
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $commision->created_at }}</td>
                        <td>{{ $commision->message }}</td>
                        <td>{{ $commision->user_name }}</td>
                        <td>
                            {{ single_price($commision->amount) }}
                        </td>
                        @if($flag == 0)
                        <td style="color:goldenrod"> 
                             Pending
                        </td>
                        
                        @else
                        <td style="color:green">
                             Cleared 
                        </td>
                        
                        @endif
                        
                        <td>
                            @if($commision->product_id != 0)
                                @if(isset($products_list[$commision->product_id]) && $products_list[$commision->product_id] != "" )
                                  <a class="btn btn-primary" target="#" href="{{route('product',$products_list[$commision->product_id])}}">{{__('Product Link')}}</a>
                                  @else
                                  <a class="btn btn-primary" disabled >{{__('Product Link Deprecate')}}</a>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="width: 250px;height: 30px;background-color: green;color:white;padding: 5px">
                Total Cleared Amount : {{single_price($clearedamt)}}</div>     
        <div style="width: 250px;height: 30px;background-color: gold;margin-top: 10px;color:white;padding: 5px">
                Total Pending Amount : {{single_price($pending)}}</div>
 
    </div>
</div>

@endsection
