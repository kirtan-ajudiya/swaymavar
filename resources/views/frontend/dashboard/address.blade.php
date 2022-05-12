@extends('frontend.dashboard.inc.sidebar')
    @section('navbar')
    <section>
        <div class="container" style="width:100%; margin-left:0px; margin-right:0px; max-width: 2000px !important;">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="">My Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Address Book</li>
                </ol>
            </div>
            </div>
        </div>
        </div>
    </section>
    @endsection
    @section('dashboard.content')
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="p-2">
                    <h2 class="h2 text-left">Address Book</h2>
                    <p>This is your account address book. You can review and update your address details.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="p-2 text-right">
                    <a href="{{route('addresses.create')}}" class="big-black-flat-button">Create New Address</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h4 class="mb-4">Your address</h4>
                <div class="row mb-5">
                    @if(isset($users))
                        @foreach($users as $user)
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="address-list-item @if(isset($user->set_default) && $user->set_default == 1) default @endif">
                                <h6><strong>@if(isset($user->nick_name)){{$user->nick_name}} @else{{$user->first_name}}@endif @if(isset($user->set_default) && $user->set_default == 1)(Default)@endif</strong></h6>
                                <p>{{$user->phone}}</p>
                                <hr>
                                <h6>{{$user->user_type}} {{$user->first_name}} {{$user->last_name}}</h6>
                                <p style="margin: 0;">{{$user->address}}</p>
                                <p style="margin: 0;">Surat - {{$user->postal_code}}</p>
                                <p>Gujarat, India</p>
                                <hr>
                                <a href="{{route('addresses.edit', encrypt($user->id))}}">Edit</a>&nbsp; | &nbsp;<a href="{{route('addresses.destroy', encrypt($user->id))}}">Remove</a>
                                &nbsp; | &nbsp;<a href="{{route('addresses.set_default', $user->id)}}" class="@if(isset($user->set_default) && $user->set_default == 1) active @endif">Default</a>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

    @endsection