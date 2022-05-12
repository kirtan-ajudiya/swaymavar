@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @if(Auth::user()->user_type == 'seller')
                        @include('frontend.inc.seller_side_nav')
                    @elseif(Auth::user()->user_type == 'customer')
                        @include('frontend.inc.customer_side_nav')
                    @endif
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Manage Documents')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('profile') }}">{{__('Manage Documents')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <form method="POST" action="{{ route('seller.upload_doc') }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('My Documnet')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>{{__('AdharCard Front Image')}}<span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" name="adharfront" id="file-3" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" required="" />
                                            <label for="file-3" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    {{__('Choose image')}}
                                                </strong>
                                            </label>
                                             @if(Auth::user()->seller->adhar_front)
                                           <img src="<?php echo asset(Auth::user()->seller->adhar_front) ;?>" height="100px" width="100px" style="margin-bottom: 20px;">
                                            @endif
                                      </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>{{__('Adhar Card Back Image')}}<span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" name="adharback" id="file-4" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" required="" />
                                            <label for="file-4" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    {{__('Choose image')}}
                                                </strong>
                                            </label>
                                             @if(Auth::user()->seller->adhar_back)
                                           <img src="<?php echo asset(Auth::user()->seller->adhar_back) ;?>" height="100px" width="100px" style="margin-bottom: 20px;">
                                            @endif
                                        </div>
                                    </div>    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>{{__('Adhar Card Number')}}<span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('Adhar Card Number')}}" name="adharno" value="{{ Auth::user()->seller->adhar_no }}" required="">
                                        </div>
                                    </div>
                                    <div class="row">  
                                    <div class="col-md-3">
                                            <label>{{__('Pan Card Front Image')}}<span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" name="panfront" id="file-5" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" required=""/>
                                            <label for="file-5" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    {{__('Choose image')}}
                                                </strong>
                                            </label>
                                        @if(Auth::user()->seller->pan_front)
                                           <img src="<?php echo asset(Auth::user()->seller->pan_front) ;?>" height="100px" width="100px" style="margin-bottom: 20px;">
                                            @endif
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-md-3">
                                            <label>{{__('Pan Card Back Image')}}<span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" name="panback" id="file-6" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" required=""/>
                                            <label for="file-6" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    {{__('Choose image')}}
                                                </strong>
                                            </label>
                                         @if(Auth::user()->seller->pan_back)
                                           <img src="<?php echo asset(Auth::user()->seller->pan_back) ;?>" height="100px" width="100px" style="margin-bottom: 20px;">
                                            @endif
                                        </div>
                                    </div> -->    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>{{__('Pan Card Number')}}<span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('Pan Card Number')}}" name="panno" value="{{ Auth::user()->seller->pan_no }}" required="">
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Your Email')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="email" class="form-control mb-3" placeholder="{{__('Your Email')}}" name="email" value="{{ Auth::user()->email }}" disabled>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>{{__('GST PDF')}}<span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" name="gstpdf" id="file-7" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept=".pdf" required=""/>
                                            <label for="file-7" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    {{__('Choose PDF')}}
                                                </strong>
                                            </label>
                                           @if(Auth::user()->seller->gst_pdf)
                                           <a class="btn btn-base-1" target="#" href="<?php echo asset(Auth::user()->seller->gst_pdf) ;?>"  style="margin-bottom: 20px;">GST Certificate</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>{{__('GST Number')}}<span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('GST Number')}}" name="gstno" value="{{ Auth::user()->seller->gst_no }}" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-styled btn-base-1">{{__('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
