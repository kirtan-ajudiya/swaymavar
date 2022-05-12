@extends('frontend.customer.inc.sidenav')
    @section('sidenavleft')
    @php
        $banner = \App\Banner::where('published', 1)->where('position', 6)->first();
    @endphp
    <div class="section first-section"
        style="background: url({{asset($banner->photo)}}) no-repeat;background-size: cover;background-position: center;">
        <div class="row">
            <div class="col lg-12 page-title">
                <h1 class="text-white margin-bottom text-uppercase text-center">Account Details</h1>
                <div class="text-small text-align-center"><a href="route('home')" class="on-dark">Home</a> / <span
                        class="low-text-contrast text-white">Account details</span></div>
            </div>
        </div>
    </div>
        
    @endsection

    @section('sidenavright')
        
        <div class="col lg-9 md-12 no-margin-bottom padding-top-bottom-double">
            <form action="{{route('customer.profile.update')}}" method="POST">
                @csrf
            <div class="container container-nested is-wrapping">
                <div class="col lg-12 md-12 sm-12 no-margin-bottom">
                    <h2>Edit Account</h2>
                </div>
                
                <div class="col lg-6 md-6 sm-12 no-margin-bottom">
                    <div class="input-set-group">
                        <label class="fw-500" for="first_name">First name&nbsp;<span class="required">*</span></label>
                        <input type="text" id="first_name" name="first_name" value="{{$user->name}}" placeholder="Enter First Name" />
                    </div>
                </div>
                <div class="col lg-6 md-6 sm-12 no-margin-bottom">
                    <div class="input-set-group">
                        <label class="fw-500" for="last_name">Last name&nbsp;<span class="required">*</span></label>
                        <input type="text" id="last_name" name="last_name" value="{{$user->last_name}}" placeholder="Enter Last Name" />
                    </div>
                </div>
                <div class="col lg-6 md-6 sm-12 no-margin-bottom">
                    <div class="input-set-group">
                        <label class="fw-500" for="phone">Phone Number&nbsp;<span class="required">*</span></label>
                        <input type="text" id="phone" name="phone" value="{{$user->phone}}" placeholder="Enter Phone Number" readonly/>
                    </div>
                </div>
                <div class="col lg-6 md-6 sm-12 no-margin-bottom">
                    <div class="input-set-group">
                        <label class="fw-500" for="email_address">Email address&nbsp;<span
                                class="required">*</span></label>
                        <input type="email" name="email" id="email_address" value="{{$user->email}}" placeholder="Enter Email address" readonly/>
                    </div>
                </div>
                <div class="col lg-6 md-6 sm-12 no-margin-bottom">
                    <div class="input-set-group">
                        <label class="fw-500" for="display_name">Display Name</label>
                        <input type="text" name="display_name" id="display_name" value="{{$user->display_name}}" placeholder="Enter Display Name" />
                        <p>This will be how your name will be displayed in the account section and in reviews</p>
                    </div>
                </div>
                <div class="col lg-12 md-12 sm-12 no-margin-bottom">
                    <h2>Password Change</h2>
                </div>
                <div class="col lg-6 md-6 sm-12 no-margin-bottom">
                    <div class="input-set-group">
                        <label class="fw-500" for="current_password">Current password (leave blank to leave
                            unchanged)</label>
                        <input type="password" id="current_password" name="current_password" placeholder="Enter Current password" />
                    </div>
                </div>
                <div class="col lg-6 md-6 sm-12 no-margin-bottom sm-hidden"></div>
                <div class="col lg-6 md-6 sm-12 no-margin-bottom">
                    <div class="input-set-group">
                        <label class="fw-500" for="new_password">New password (leave blank to leave unchanged)</label>
                        <input type="password" id="new_password" name="new_password" placeholder="Enter New password" />
                    </div>
                </div>
                <div class="col lg-6 md-6 sm-12 no-margin-bottom">
                    <div class="input-set-group">
                        <label class="fw-500" for="confirm_new_password">Confirm new password</label>
                        <input type="password" name="confirm_password" id="confirm_new_password" placeholder="Enter Confirm new password" />
                    </div>
                </div>
            </div>
            <button type="submit" class="inline-button" style="width: auto !important;">Save Changes</button>
        </form>
        </div>
    @endsection
