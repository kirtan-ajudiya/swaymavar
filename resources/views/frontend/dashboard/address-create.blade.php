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
                    <li class="breadcrumb-item active" aria-current="page">Create New Address</li>
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
                    <h2 class="h2 text-left">Create a New Address</h2>
                    <p>Please enter your address below and indicate if this is your default shipping address.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <h6 class="p-2">* Denotes mandatory field. </h6>
            </div>
        </div>
        <hr>
        <form action="{{route('addresses.store')}}"  method="POST">
        	@csrf
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row mb-5">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><strong>Title <span>*</span></strong></label>
                            <div class="form-group">
                                <select class="form-control" name="user_type">
                                    <option value="Mr." >Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><strong>First Name <span>*</span></strong></label>
                            <div class="form-group">
                                <input type="text" name="first_name" id="name" class="form-control" placeholder="First Name">
                            </div>
                            @error('first_name')
                                <strong style="color: red">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><strong>Last Name <span>*</span></strong></label>
                            <div class="form-group">
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
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
                                    <option value="Australia" label="Australia" >Australia</option>
                                    <option value="Bahrain" label="Bahrain">Bahrain</option>
                                    <option value="Canada" label="Canada">Canada</option>
                                    <option value="Germany" label="Germany">Germany</option>
                                    <option value="India" label="India" selected="selected">India</option>
                                    <option value="Kenya" label="Kenya">Kenya</option>
                                    <option value="Kuwait" label="Kuwait">Kuwait</option>
                                    <option value="Malaysia" label="Malaysia">Malaysia</option>
                                    <option value="Netherlands" label="Netherlands">Netherlands</option>
                                    <option value="New Zealand" label="New Zealand">New Zealand</option>
                                    <option value="Oman" label="Oman">Oman</option>
                                    <option value="Portugal" label="Portugal">Portugal</option>
                                    <option value="Qatar" label="Qatar">Qatar</option>
                                    <option value="Romania" label="Romania">Romania</option>
                                    <option value="Saudi Arabia" label="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Singapore" label="Singapore">Singapore</option>
                                    <option value="Spain" label="Spain">Spain</option>
                                    <option value="United Arab Emirates" label="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom" label="United Kingdom">United Kingdom</option>
                                    <option value="United States" label="United States">United States</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <label><strong>Phone Number <span>*</span></strong></label>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <select class="form-control" id="code" name="code">
                                            <option value="+91">+91 </option>
                                            <option value="+61">+61 </option>
                                            <option value="+1">+1 </option>
                                            <option value="+1">+1 </option>
                                            <option value="+65">+65 </option>
                                            <option value="+44">+44 </option>
                                            <option value="+971">+971 </option>
                                            <option value="+64">+64 </option>
                                            <option value="+60">+60 </option>
                                            <option value="+49">+49 </option>
                                            <option value="+40">+40 </option>
                                            <option value="+254">+254 </option>
                                            <option value="+34">+34 </option>
                                            <option value="+31">+31 </option>
                                            <option value="+351">+351 </option>
                                            <option value="+974">+974 </option>
                                            <option value="+968">+968 </option>
                                            <option value="+965">+965 </option>
                                            <option value="+973">+973 </option>
                                            <option value="+966">+966 </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="form-group">
                                        <input type="tel" name="phone" id="phone" class="form-control" maxlength="10" placeholder="Enter Mobile Number">
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
                                <input type="text" id="postal_code" onkeyup="myFunction()" name="postal_code" class="form-control" placeholder="6 Digit Pincode">
                            </div>
                            <strong id="error" style="color: red"></strong>
                            @error('postal_code')
                                <strong style="color: red">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><strong>State <span>*</span></strong></label>
                            <div class="form-group">
                                <input type="text" id="state" name="state" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><strong>City <span>*</span></strong></label>
                            <div class="form-group">
                                <input type="text" name="city" id="city" disabled class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><strong>Street Address/Building/Locality <span>*</span></strong></label>
                            <div class="form-group">
                                <input type="text" class="form-control" maxlength="210" id="address" name="address" placeholder="Flat no, House no, Street name">
                                <p>You have <span id="count">210</span> characters left out of 210.</p>
                            </div>
                            @error('address')
                                <strong style="color: red">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="custom-field">
                                <input type="checkbox" checked value="1" id="receive_newsletters" name="set_default" >
                                <label for="receive_newsletters">Set as default shipping address.</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><strong>Nick Name</strong></label>
                            <div class="form-group">
                                <input type="text" name="nick_name"  class="form-control" placeholder="Enter Nick Name">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label><strong>Alternate Mobile Number (optional)</strong></label>
                            <div class="form-group">
                                <input type="text" name="alt_phone" maxlength="10" class="form-control" placeholder="Enter Alternate Mobile Number">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button type="submit" class="big-black-flat-button">Create Address</button>
                            <a href="{{ route('addresses.index') }}" class="big-black-flat-button">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endsection

    @section('script')

    <script>

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
        $('#address').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#count').text(textlen);
        });

    </script>

    @endsection