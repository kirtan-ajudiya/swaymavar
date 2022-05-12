@extends('frontend.dashboard.inc.sidebar')
    @section('navbar')
    <section>
        <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="">My Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Personal Information</li>
                </ol>
            </div>
            </div>
        </div>
        </div>
    </section>
    @endsection
    @section('dashboard.content')
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="p-2"><h2 class="h2 text-left">Personal Information</h2>
                <p>This is your account personal information. You can review your information and update your details.</p></div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <h6 class="p-2">* Denotes mandatory field. </h6>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h4 class="mb-4">Personal Details</h4>
                <div class="row mb-5">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"><p><strong>Full Name</strong></p></div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><p>{{$user->title}}. {{$user->name}}</p></div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"><p><strong>Date of Birth</strong></p></div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><p>{{$user->birth_date}}-{{$user->birth_month}}-{{$user->birth_year}}</p></div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"><p><strong>Anniversary Date</strong></p></div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><p>{{$user->anniversary_date}}-{{$user->anniversary_month}}</p></div>
                    <!-- <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"><p><strong>Encircle ID</strong></p></div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><p>XXXXXXXX0000 | 0 points</p></div> -->
                </div>
                <h4 class="mb-4">Contact Details</h4>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"><p><strong>Phone Number</strong></p></div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><p><img src="{{asset('frontend/images/india icon.png')}}" style="float: left;margin-right: 10px;width: fit-content !important;"> {{$user->phone}}</p></div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"><p><strong>Email Address</strong></p></div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><p>{{$user->email}}</p></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="{{route('user.profile.edit')}}" class="big-black-flat-button">Update Details</a>
            </div>
        </div>
    @endsection
