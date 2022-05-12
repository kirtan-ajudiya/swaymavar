@extends('frontend.layouts.app')

@section('content')
<main>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Forgot Password</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4"></div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div class="row login-signup">
            <form  role="form"action="{{route('user.newpassword')}}" method="post" style="width:100%;">
            @csrf
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <label for="EmailID">Enter Password</label>
              <div class="form-group">
                <input type="text" class="form-control" id="newpassword" name="newpassword" placeholder="Enter Your Password...">
              </div>
              <div class="form-group">
                <label for="EmailID">Conform Password</label>
                <input type="password" class="form-control" id="newcpassword" name="newcpassword" placeholder="Enter your Conform Password...">
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="margin: 20px 0;">
              <button type="submit" class="black-flat-button">{{  __('Submit') }}</a>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

