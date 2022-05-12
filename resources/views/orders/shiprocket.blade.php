@extends('layouts.app')

@section('content')

<div class="col-sm-12">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Send Shiprocket')}}</h3>
        </div>
        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('orders.send_shiprocket.admin') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <input type="hidden" name="orderid" value="{{$order}}">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="subject">{{__('Length')}}</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="Length" id="Length" placeholder="Enter Length" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="subject">{{__('Width')}}</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="Width" id="Width" placeholder="Enter Width" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="subject">{{__('Height')}}</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="Height" id="Height" placeholder="Enter Height" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="subject">{{__('Weight')}}</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="Weight" placeholder="Enter Weight" id="Weight" required>
                    </div>
                    <span class="col-sm-2 control-label">Volumetric Weight (Kg)  0.600</span>
                </div>
               <div class="form-group">
               <label class="col-sm-2 control-label" for="subject">{{__('Pickup Location')}}</label>
               <div class="col-sm-6">                  
                <select name="pick_loc" id="pick_loc" class="form-control" required="">
                                   @foreach($pick_poin as $value)                         
                                   <option value="<?php echo $value ?>"><?php echo $value ?></option>
                                   @endforeach
                </select>
              </div>
              </div>     
               
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Send')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

@endsection
