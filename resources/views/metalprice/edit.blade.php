@extends('layouts.app')

@section('content')

<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Metal Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('metalprices.update', $metal_prices->id) }}" method="POST" enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PATCH">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" class="form-control" value="{{$metal_prices->name}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Metal Type')}}</label>
                    <div class="col-sm-10">
                        <select name="metal_id" required class="form-control demo-select2">
                            @foreach($metal_type as $metal_types)
                                <option value="{{$metal_types->id}}" <?php if($metal_prices->metal_id == $metal_types->id) echo "selected";?> >{{__($metal_types->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{--<div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Price')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Metal Price')}}" id="price" name="price" value="{{$metal_prices->metal_price}}" class="form-control" required>
                    </div>
                </div>--}}
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

@endsection
