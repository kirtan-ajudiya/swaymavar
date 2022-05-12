@extends('frontend.customer.inc.sidenav')
    @section('sidenavleft')
    @php
        $banner = \App\Banner::where('published', 1)->where('position', 6)->first();
    @endphp
    <div class="section first-section"
        style="background: url({{asset($banner->photo)}}) no-repeat;background-size: cover;background-position: center;">
        <div class="row">
            <div class="col lg-12 page-title">
                <h1 class="text-white margin-bottom text-uppercase text-center">Edit Address</h1>
                <div class="text-small text-align-center"><a href="{{route('home')}}" class="on-dark">Home</a> / <span
                        class="low-text-contrast text-white">Edit Address</span></div>
            </div>
        </div>
    </div>
        
    @endsection

    @section('sidenavright')
        
    <form action="{{route('addresses.update', $address->id)}}" method="POST">
        <input name="_method" type="hidden" value="PATCH">
        @csrf
    <div class="col lg-9 md-12 no-margin-bottom padding-top-bottom-double">
        <h3>Edit address</h3>
        <div class="container container-nested is-wrapping">
            <div class="col lg-6 md-6 sm-12 no-margin-bottom">
                <div class="input-set-group">
                    <label class="fw-500" for="first_name">First name&nbsp;<span class="required">*</span></label>
                    <input type="text" id="first_name" name="first_name"  value="{{$address->first_name ?? ""}}" placeholder="Enter First Name" />
                    @error('first_name')
                        <div style="color: red">{{ $message }}</div>
                    @enderror
                 </div>
            </div>
            <div class="col lg-6 md-6 sm-12 no-margin-bottom">
                <div class="input-set-group">
                    <label class="fw-500" for="last_name">Last name&nbsp;<span class="required">*</span></label>
                    <input type="text" id="last_name" name="last_name"  value="{{$address->last_name ?? ""}}" placeholder="Enter Last Name" />
                    @error('last_name')
                        <div style="color: red">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col lg-12 md-12 no-margin-bottom">
                <div class="input-set-group">
                    <label class="fw-500" for="company_name">Company name (optional)</label>
                    <input type="text" id="company_name" name="company_name"  value="{{$address->company_name ?? ""}}" placeholder="Enter Company Name" />
                </div>
            </div>
            <div class="col lg-12 md-12 no-margin-bottom">
                <div class="input-set-group">
                    <label class="fw-500" for="country_region">Country / Region&nbsp;<span
                            class="required">*</span></label>
                    <span class="drop-down-arrow"></span>
                    <select id="country_region" name="country">
                        <option disabled>Select Country / Region</option>
                        <option value="australia">Australia</option>
                        <option value="argentina">Argentina</option>
                        <option value="brazil">Brazil</option>
                        <option value="canada">Canada</option>
                        <option value="china">China</option>
                        <option value="india" selected>India</option>
                        <option value="kazakhstan">Kazakhstan</option>
                        <option value="russia">Russia</option>
                        <option value="sudan">Sudan</option>
                        <option value="us">United States</option>
                    </select>
                    @error('country')
                        <div style="color: red">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col lg-12 md-12 no-margin-bottom">
                <div class="input-set-group">
                    <label class="fw-500" for="street_address">Street address&nbsp;<span
                            class="required">*</span></label>
                    <input type="text" id="street_address" name="address" value="{{$address->address ?? ""}}" placeholder="Enter Street Address" />
                    @error('address')
                        <div style="color: red">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col lg-4 md-4 sm-12 no-margin-bottom">
                <div class="input-set-group">
                    <label class="fw-500" for="postcode_zip">Postcode / ZIP&nbsp;<span class="required">*</span></label>
                    <input type="text" id="postcode_zip" name="postal_code"  value="{{$address->postal_code ?? ""}}" placeholder="Enter Postcode / ZIP" />
                    @error('postal_code')
                        <div style="color: red">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col lg-4 md-4 sm-12 no-margin-bottom">
                <div class="input-set-group">
                    <label class="fw-500" for="town_city">Town / City&nbsp;<span class="required">*</span></label>
                    <input type="text" id="town_city" name="city"  value="{{$address->city ?? ""}}" placeholder="Enter Town / City" />
                    @error('city')
                        <div style="color: red">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col lg-4 md-4 sm-12 no-margin-bottom">
                <div class="input-set-group">
                    <label class="fw-500" for="province_state">Province / State&nbsp;<span
                            class="required">*</span></label>
                    <input type="text" id="province_state" name="state" value="{{$address->state ?? ""}}" placeholder="Enter Postcode / ZIP" />
                    @error('state')
                        <div style="color: red">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col lg-4 md-4 sm-12 no-margin-bottom">
                <div class="input-set-group">
                    <label class="fw-500" for="phone">Phone Number&nbsp;<span class="required">*</span></label>
                    <input type="text" id="phone" name="phone"  value="{{$address->phone ?? ""}}" placeholder="Enter Phone Number" readonly/>
                    @error('phone')
                        <div style="color: red">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col lg-4 md-4 sm-12 no-margin-bottom">
                <div class="input-set-group">
                    <label class="fw-500" for="email_address">Email address&nbsp;<span class="required">*</span></label>
                    <input type="text" id="email_address" name="email"  value="{{$address->email ?? ""}}" placeholder="Enter Email address" readonly/>
                    @error('email')
                        <div style="color: red">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col lg-4 md-4 no-margin-bottom">
                <div class="input-set-group">
                    <label class="fw-500" for="country_region">Address Type&nbsp;<span
                            class="required">*</span></label>
                    <span class="drop-down-arrow"></span>
                    <select id="country_region" name="type">
                        <option value="billing" @if(isset($address) && $address->type == "billing") selected @endif>Billing</option>
                        <option value="shipping" @if(isset($address) && $address->type == "shipping") selected @endif>Shipping</option>
                    </select>
                    @error('type')
                        <div style="color: red">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <button class="inline-button" style="width: auto !important;">Save Address</button>
    </div>
</form>

    @endsection
