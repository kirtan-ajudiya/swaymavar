@extends('layouts.app')

@section('content')

<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Metal Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('metalprices.store') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Metal Type')}}</label>
                    <div class="col-sm-10">
                        <select name="metal_id" required class="form-control demo-select2-placeholder">
                            @foreach($metal_type as $metal_types)
                                <option value="{{$metal_types->id}}">{{__($metal_types->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{--<div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Price')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Metal Price')}}" id="price" name="price" class="form-control" required>
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
