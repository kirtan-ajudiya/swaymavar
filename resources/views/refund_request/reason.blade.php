@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{__('Reason For Refund Request')}}</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-lg-2 control-label">{{__('Reason')}}</label>
                    <div class="col-lg-10">
                        <p class="bord-all pad-all">{{ $refund->reason }}</p>
                    </div>
                </div>
              
               @if(isset($refund->photos) && $refund->photos !="" && $refund->photos!="[]")
               <div class="form-group">
                    <label class="col-lg-2 control-label">{{__('Photos')}}</label>
                    <div class="col-lg-10">
                        <div class="row">
                      @foreach (json_decode($refund->photos) as $key => $photo)
                      <div class="col-lg-2">
                            <a href="{{ asset($photo) }}" target="#">
                          <img src="{{ asset($photo) }}" style="width: 100px;height: 100px;" >
                       </a>
            </div>
                     @endforeach
        </div>
                    
    </div>
                </div>
               @endif


            </div>
        </div>
    </div>

@endsection
