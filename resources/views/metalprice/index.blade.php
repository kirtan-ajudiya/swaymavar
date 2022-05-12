@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('metalprices.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Metal')}}</a>
    </div>
</div>

<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Metal')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_categories" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder=" Type name & Enter">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Metal Type')}}</th>
                   {{--<th>{{__('Metal Price')}}</th>--}} 
                   {{--<th>{{__('Status')}}</th>--}}
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($metal_prices as $key => $metal_price)
                    <tr>
                        <td>{{ ($key+1) + ($metal_prices->currentPage() - 1)*$metal_prices->perPage() }}</td>
                        <td>{{__($metal_price->name)}}</td>
                        <td>{{$metal_price->metaltype->name}}</td>
                        {{--<td>{{$metal_price->metal_price}}</td>--}}
                        <!-- <td><label class="switch">
                            <input onchange="update_featured(this)" value="{{ $metal_price->id }}" type="checkbox" <?php if($metal_price->status == 1) echo "checked";?> >
                            <span class="slider round"></span></label></td> -->
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('metalprices.edit', encrypt($metal_price->id))}}">{{__('Edit')}}</a></li>
                                    <!-- <li><a onclick="confirm_modal('{{route('metalprices.destroy', $metal_price->id)}}');">{{__('Delete')}}</a></li> -->
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('metalprices.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Metal Price Status updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
