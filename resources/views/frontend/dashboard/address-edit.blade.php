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
                    <li class="breadcrumb-item active" aria-current="page">Edit Address</li>
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
                <div class="p-2">
                    <h2 class="h2 text-left">Edit  Address</h2>
                    <p>Please enter your address below and indicate if this is your default shipping address.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <h6 class="p-2">* Denotes mandatory field. </h6>
            </div>
        </div>
        <hr>
        <form action="{{route('addresses.update', encrypt($user->id))}}"  method="POST">
        	@csrf
            {{ method_field('PUT') }}
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row mb-5">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><strong>Title <span>*</span></strong></label>
                            <div class="form-group">
                                <select class="form-control" name="user_type">
                                    <option value="Mr." @if(isset($user->user_type) && $user->user_type == 'Mr') selected @endif>Mr.</option>
                                    <option alue="Mrs." @if(isset($user->user_type) && $user->user_type == 'Mrs') selected @endif>Mrs.</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><strong>First Name <span>*</span></strong></label>
                            <div class="form-group">
                                <input type="text" name="first_name" id="name" class="form-control" value="{{$user->first_name}}" placeholder="First Name">
                            </div>
                            @error('first_name')
                                <strong style="color: red">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><strong>Last Name <span>*</span></strong></label>
                            <div class="form-group">
                                <input type="text" name="last_name" id="last_name" value="{{$user->last_name}}" class="form-control" placeholder="Last Name">
                            </div>
                            @error('last_name')
                                <strong style="color: red">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><strong>Country <span>*</span></strong></label>
                            <div class="form-group">
                                <select class="form-control" id="country" name="country">
                                    <option class="disabled">-- Select Country --</option>
                                    <option value="Australia" label="Australia" @if(isset($user->country) && $user->country == 'Australia') selected @endif>Australia</option>
                                    <option value="Bahrain" label="Bahrain" @if(isset($user->country) && $user->country == 'Bahrain') selected @endif>Bahrain</option>
                                    <option value="Canada" label="Canada" @if(isset($user->country) && $user->country == 'Canada') selected @endif>Canada</option>
                                    <option value="Germany" label="Germany" @if(isset($user->country) && $user->country == 'Germany') selected @endif>Germany</option>
                                    <option value="India" label="India" @if(isset($user->country) && $user->country == 'India') selected @endif>India</option>
                                    <option value="Kenya" label="Kenya" @if(isset($user->country) && $user->country == 'Kenya') selected @endif>Kenya</option>
                                    <option value="Kuwait" label="Kuwait" @if(isset($user->country) && $user->country == 'Kuwait') selected @endif>Kuwait</option>
                                    <option value="Malaysia" label="Malaysia" @if(isset($user->country) && $user->country == 'Malaysia') selected @endif>Malaysia</option>
                                    <option value="Netherlands" label="Netherlands" @if(isset($user->country) && $user->country == 'Netherlands') selected @endif>Netherlands</option>
                                    <option value="New Zealand" label="New Zealand" @if(isset($user->country) && $user->country == 'New Zealand') selected @endif>New Zealand</option>
                                    <option value="Oman" label="Oman" @if(isset($user->country) && $user->country == 'Oman') selected @endif>Oman</option>
                                    <option value="Portugal" label="Portugal" @if(isset($user->country) && $user->country == 'Portugal') selected @endif>Portugal</option>
                                    <option value="Qatar" label="Qatar" @if(isset($user->country) && $user->country == 'Qatar') selected @endif>Qatar</option>
                                    <option value="Romania" label="Romania" @if(isset($user->country) && $user->country == 'Romania') selected @endif>Romania</option>
                                    <option value="Saudi Arabia" label="Saudi Arabia" @if(isset($user->country) && $user->country == 'Saudi Arabia') selected @endif>Saudi Arabia</option>
                                    <option value="Singapore" label="Singapore" @if(isset($user->country) && $user->country == 'Singapore') selected @endif>Singapore</option>
                                    <option value="Spain" label="Spain" @if(isset($user->country) && $user->country == 'Spain') selected @endif>Spain</option>
                                    <option value="United Arab Emirates" label="United Arab Emirates" @if(isset($user->country) && $user->country == 'United Arab Emirates') selected @endif>United Arab Emirates</option>
                                    <option value="United Kingdom" label="United Kingdom" @if(isset($user->country) && $user->country == 'United Kingdom') selected @endif>United Kingdom</option>
                                    <option value="United States" label="United States" @if(isset($user->country) && $user->country == 'United States') selected @endif>United States</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <label><strong>Phone Number <span>*</span></strong></label>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <select class="form-control" id="code" name="code">
                                            <option value="+91" @if(isset($user->code) && $user->code == "+91") selected @endif>+91 </option>
                                            <option value="+61" @if(isset($user->code) && $user->code == "+61") selected @endif>+61 </option>
                                            <option value="+1" @if(isset($user->code) && $user->code == "+1") selected @endif>+1 </option>
                                            <option value="+1" @if(isset($user->code) && $user->code == "+1") selected @endif>+1 </option>
                                            <option value="+65" @if(isset($user->code) && $user->code == "+65") selected @endif>+65 </option>
                                            <option value="+44" @if(isset($user->code) && $user->code == "+44") selected @endif>+44 </option>
                                            <option value="+971" @if(isset($user->code) && $user->code =="+971") selected @endif>+971 </option>
                                            <option value="+64" @if(isset($user->code) && $user->code == "+64") selected @endif>+64 </option>
                                            <option value="+60" @if(isset($user->code) && $user->code == "+60") selected @endif>+60 </option>
                                            <option value="+49" @if(isset($user->code) && $user->code == "+49") selected @endif>+49 </option>
                                            <option value="+40" @if(isset($user->code) && $user->code == "+40") selected @endif>+40 </option>
                                            <option value="+254" @if(isset($user->code) && $user->code =="+254") selected @endif>+254 </option>
                                            <option value="+34" @if(isset($user->code) && $user->code == "+34") selected @endif>+34 </option>
                                            <option value="+31" @if(isset($user->code) && $user->code == "+31") selected @endif>+31 </option>
                                            <option value="+351" @if(isset($user->code) && $user->code =="+351") selected @endif>+351 </option>
                                            <option value="+974" @if(isset($user->code) && $user->code =="+974") selected @endif>+974 </option>
                                            <option value="+968" @if(isset($user->code) && $user->code =="+968") selected @endif>+968 </option>
                                            <option value="+965" @if(isset($user->code) && $user->code =="+965") selected @endif>+965 </option>
                                            <option value="+973" @if(isset($user->code) && $user->code =="+973") selected @endif>+973 </option>
                                            <option value="+966" @if(isset($user->code) && $user->code =="+966") selected @endif>+966 </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="form-group">
                                        <input type="tel" name="phone" id="phone" value="{{$user->phone}}" maxlength="10" class="form-control" placeholder="Enter Mobile Number">
                                    </div>
                                    @error('phone')
                                        <strong style="color: red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><strong>Pin-code/Zip-code <span>*</span></strong></label>
                            <div class="form-group">
                                <input type="text" id="postal_code" onkeyup="myFunction()" name="postal_code" value="{{$user->postal_code}}" class="form-control" placeholder="6 Digit Pincode">
                            </div>
                            <strong id="error" style="color: red"></strong>
                            @error('postal_code')
                                <strong style="color: red">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><strong>State <span>*</span></strong></label>
                            <div class="form-group">
                                <input type="text" id="state" name="state" value="{{$user->state}}" readonly class="form-control">
                            </div>
                            @error('state')
                                <strong style="color: red">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><strong>City <span>*</span></strong></label>
                            <div class="form-group">
                                <input type="text" name="city" id="city" value="{{$user->city}}" readonly class="form-control">
                            </div>
                            @error('city')
                                <strong style="color: red">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><strong>Street Address/Building/Locality <span>*</span></strong></label>
                            <div class="form-group">
                                <input type="text" class="form-control" onkeyup="count();" maxlength="210" id="address" value="{{$user->address}}" name="address" placeholder="Flat no, House no, Street name">
                                <p>You have <span id="count"></span> characters left out of 210.</p>
                            </div>
                            @error('address')
                                <strong style="color: red">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            @php
                              if(isset($user->set_default) && $user->set_default==1){
                                 $check = 'checked';
                              }else{
                                 $check = '';
                              }
                              @endphp
                            <div class="custom-field">
                                <input type="checkbox"  value="1" id="set_default" {{$check}} name="set_default" >
                                <label for="set_default">Set as default shipping address.</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><strong>Nick Name</strong></label>
                            <div class="form-group">
                                <input type="text" name="nick_name" value="{{$user->nick_name}}" class="form-control" placeholder="Enter Nick Name">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><strong>Alternate Mobile Number (optional)</strong></label>
                            <div class="form-group">
                                <input type="text" name="alt_phone" maxlength="10" class="form-control" value="{{$user->alt_phone}}" placeholder="Enter Alternate Mobile Number">
                            </div>
                        </div>
                        <input type="hidden" name="updateaddrress" value="1" />
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button type="submit" class="big-black-flat-button">Update Address</button>
                            <button class="big-black-flat-button">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    @endsection

    @section('script')

    <script>
        $( document ).ready(function() { 
            count();
            myFunction();
        })

        function myFunction(){
          var tt = $('#postal_code').val();
          $.post('{{ route('pincode') }}', { _token:'{{ csrf_token() }}',code:tt}, function(data){
            if(data.status === true){
                $("#state").val(data.state);
                $("#city").val(data.district);
                $('#error').html('');
            }else{
                $("#state").val("");
                $("#city").val("");
                $('#error').html('Please enter valid Pincode');
            }
          });
        }
        var maxLength = 210;
        function count(){
            var add = $('#address').val();
            var textlen = maxLength - add.length;
            $('#count').text(textlen);
        }

    </script>

    @endsection