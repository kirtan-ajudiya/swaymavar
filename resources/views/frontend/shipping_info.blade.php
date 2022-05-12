@extends('frontend.layouts.app')
    @section('content')
    <main>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item"><a href="">Checkout</a></li>
              <li class="breadcrumb-item active" aria-current="page">Shipping Info</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container" style="max-width: 2000px;!important">
      <div class="row">
        <div class="col-xl-8 mx-auto">
          <div class="row aiz-steps arrow-divider">
            <div class="col done">
              <div class="text-center success-step"> <i class="la-3x mb-2 fa fa-shopping-cart"></i>
                <h3 class="fs-14 fw-600 d-none d-lg-block">1. My Cart</h3>
              </div>
            </div>
            <div class="col active">
              <div class="text-center active-step"> <i class="la-3x mb-2 fa fa-map"></i>
                <h3 class="fs-14 fw-600 d-none d-lg-block">2. Shipping info</h3>
              </div>
            </div>
            <div class="col">
              <div class="text-center"> <i class="la-3x mb-2 opacity-50 fa fa-truck"></i>
                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">3. Delivery info</h3>
              </div>
            </div>
            <div class="col">
              <div class="text-center"> <i class="la-3x mb-2 opacity-50 fa fa-credit-card"></i>
                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">4. Payment</h3>
              </div>
            </div>
            <div class="col">
              <div class="text-center"> <i class="la-3x mb-2 opacity-50 fa fa-check-circle"></i>
                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">5. Confirmation</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="mb-4">
    <div class="container" style="max-width: 2000px !important;">
    <form class="form-default" data-toggle="validator" action="{{ route('checkout.store_shipping_infostore') }}" role="form" method="POST">
    @csrf
      <div class="row">
        <div class="col-xxl-8 col-xl-10 mx-auto">
            <div class="shadow-sm bg-white p-3 p-lg-4 rounded text-left">
            <h2> Shipping Address :- </h2>
                <div class="row mb-5">
                @if(Auth::check())
                    @php 
                        $addresss = App\Address::where('user_id', Auth::user()->id)->get();
                    @endphp
                    @if(count($addresss) > 0)
                        @foreach ($addresss as $key => $address)
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 n-css">
                            <input class="form-check-input customize-radio-checkbox-input" id="shipping_info_{{$key}}" name="address_id" type="radio" value="{{ $address->id }}" @if ($address->set_default)
                                                            checked
                                                        @endif required>
                            <label class="form-check-label customize-radio-checkbox-label" for="shipping_info_{{$key}}">
                            <h6><strong>{{$address->user_type}}. {{$address->first_name}} @if(isset($address->set_default) && $address->set_default == 1)(Default)@endif</strong></h6>
                            <hr>
                            <h6>{{$address->phone}}</h6>
                            <h6 style="margin: 0;">{{$address->address}}, {{$address->city}} - {{$address->postal_code}}, {{$address->state}}, {{$address->country}}</h6>
                            <hr>
                            <a href="#" onclick="edit_address('{{$address->id}}')">Edit</a>&nbsp;&nbsp; |
                            <a href="{{route('addresses.set_default', $address->id)}}" class="@if(isset($address->set_default) && $address->set_default == 1) active @endif">Default</a>
                            </label>
                        </div>
                        @endforeach
                    @endif
                @endif
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                    <a href=" " data-toggle="modal" data-target="#AddAddressModal" class="address-list-item text-center h-100 d-flex flex-column justify-content-center"> <i class="fa fa-plus la-2x mb-3"></i>
                    <div class="alpha-7">Add New Address</div>
                    </a>
                </div>
                </div>

                <h2> Billing Address :- </h2>
                <div class="row mb-5">
                @if(Auth::check())
                    @php 
                        $addresss = App\Address::where('user_id', Auth::user()->id)->get();
                    @endphp
                    @if(count($addresss) > 0)
                        @foreach ($addresss as $key => $address)
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 n-css">
                            <input class="form-check-input customize-radio-checkbox-input" id="billing_info_{{$key}}" name="billing_id" type="radio" value="{{ $address->id }}" @if ($address->set_default)
                                                            checked
                                                        @endif required>
                            <label class="form-check-label customize-radio-checkbox-label" for="billing_info_{{$key}}">
                            <h6><strong>{{$address->user_type}}. {{$address->first_name}} @if(isset($address->set_default) && $address->set_default == 1)(Default)@endif</strong></h6>
                            <hr>
                            <h6>{{$address->phone}}</h6>
                            <h6 style="margin: 0;">{{$address->address}}, {{$address->city}} - {{$address->postal_code}}, {{$address->state}}, {{$address->country}}</h6>
                            <hr>
                            <a href="#" onclick="edit_address('{{$address->id}}')">Edit</a>&nbsp;&nbsp; |
                            <a href="{{route('addresses.set_default', $address->id)}}" class="@if(isset($address->set_default) && $address->set_default == 1) active @endif">Default</a>
                            </label>
                        </div>
                        @endforeach
                        @endif
                @endif
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                    <a href="#" data-toggle="modal" data-target="#AddBillingAddressModal" class="address-list-item text-center h-100 d-flex flex-column justify-content-center"> <i class="fa fa-plus la-2x mb-3"></i>
                    <div class="alpha-7">Add New Address</div>
                    </a>
                </div>
                </div>

                <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-left order-1 order-md-0"> <a href="{{ route('cart') }}" class="inline-link"> <i class="fa fa-arrow-left"></i>&nbsp; Back </a> </div>
                <div class="col-md-6 text-center text-md-right"> <button type="submit"  class="black-flat-button">Continue to Delivery Info</button> </div>
                </div>
            </div>
          </div>
      </div>


      </form>

    </div>
  </section>

  <div class="modal fade" id="AddAddressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width: 800px;">
          <div class="modal-content">
              <div class="modal-header border-bottom-0">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                          aria-hidden="true">&times;</span> </button>
              </div>
              <form action="{{route('addresses.store')}}"  method="POST">
                @csrf
              <div class="modal-body">
                  <div class="form-title text-center">
                      <h4>Add Address</h4>
                  </div>
                  <div class="d-flex flex-column">
                      <div class="row">
                          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <label><strong>Title <span>*</span></strong></label>
                              <div class="form-group">
                                  <select class="form-control"  name="user_type">
                                      <option value="mr" >Mr.</option>
                                      <option value="mrs">Mrs.</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <label><strong>First Name <span>*</span></strong></label>
                              <div class="form-group">
                                  <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                              </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <label><strong>Last Name <span>*</span></strong></label>
                              <div class="form-group">
                                  <input type="text"  name="last_name"  class="form-control" placeholder="Last Name">
                              </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <label><strong>Country <span>*</span></strong></label>
                              <div class="form-group">
                                  <select class="form-control" id="country" name="country">
                                      <option disabled class="">-- Select Country --</option>
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
                                            <option value=">+91">+91 </option>
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
                                          <input type="tel" name="phone" maxlength="10" class="form-control" placeholder="Enter Mobile Number">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <label><strong>Pin-code/Zip-code <span>*</span></strong></label>
                              <div class="form-group">
                                  <input type="text" class="form-control" onkeyup="myFunction()" name="postal_code" id="postal_code"  placeholder="6 Digit Pincode">
                              </div>
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
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <label><strong>Street Address/Building/Locality <span>*</span></strong></label>
                              <div class="form-group">
                                <input type="text" class="form-control" id="address" name="address" placeholder="Flat no, House no, Street name">
                                  <p>You have 210 characters left out of 210.</p>
                              </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label><strong>Nick Name</strong></label>
                              <div class="form-group">
                                <input type="text" name="nick_name"  class="form-control" placeholder="Enter Nick Name">
                              </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label><strong>Alternate Mobile Number (optional)</strong></label>
                              <div class="form-group">
                                <input type="text" name="alt_phone" maxlength="10" class="form-control" placeholder="Enter Alternate Mobile Number">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer d-flex justify-content-center">
                  <button type="submit" class="black-flat-button">Add Address</button>
                  <button class="black-flat-button">Cancel</button>
              </div>
        </form>

          </div>
      </div>
  </div>

  <div class="modal fade" id="edit-address-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width: 800px;">
      <div class="modal-content">
          <div class="modal-header border-bottom-0">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                      aria-hidden="true">&times;</span> </button>
          </div>
          <div id="edit_modal_body"></div>
      </div>
  </div>
</div>

<div class="modal fade" id="AddBillingAddressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">&times;</span> </button>
            </div>
            <form action="{{route('addresses.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-title text-center">
                        <h4>Add Address</h4>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label><strong>Title <span>*</span></strong></label>
                                <div class="form-group">
                                    <select class="form-control" name="user_type">
                                        <option value="mr">Mr.</option>
                                        <option value="mrs">Mrs.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label><strong>First Name <span>*</span></strong></label>
                                <div class="form-group">
                                    <input type="text" name="first_name" class="form-control" placeholder="First Name"
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label><strong>Last Name <span>*</span></strong></label>
                                <div class="form-group">
                                    <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label><strong>Country <span>*</span></strong></label>
                                <div class="form-group">
                                    <select class="form-control" id="country" name="country">
                                        <option disabled class="">-- Select Country --</option>
                                        <option value="Australia" label="Australia">Australia</option>
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
                                        <option value="United Arab Emirates" label="United Arab Emirates">United Arab
                                            Emirates</option>
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
                                                <option value=">+91">+91 </option>
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
                                            <input type="tel" name="phone" maxlength="10" class="form-control"
                                                placeholder="Enter Mobile Number">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label><strong>Pin-code/Zip-code <span>*</span></strong></label>
                                <div class="form-group">
                                    <input type="text" class="form-control" onkeyup="myFunction()" name="postal_code" id="postal_code"
                                        placeholder="6 Digit Pincode">
                                </div>
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
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label><strong>Street Address/Building/Locality <span>*</span></strong></label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="address" name="billing_address"
                                        placeholder="Flat no, House no, Street name">
                                    <p>You have 210 characters left out of 210.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label><strong>Nick Name</strong></label>
                                <div class="form-group">
                                    <input type="text" name="nick_name" class="form-control"
                                        placeholder="Enter Nick Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label><strong>Alternate Mobile Number (optional)</strong></label>
                                <div class="form-group">
                                    <input type="text" name="alt_phone" maxlength="10" class="form-control"
                                        placeholder="Enter Alternate Mobile Number">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="black-flat-button">Add Address</button>
                    <button class="black-flat-button">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-address-modal-billing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">&times;</span> </button>
            </div>
            <div id="edit_modal_body_billing"></div>
        </div>
    </div>
</div>

</main>
    @endsection


    @section('script')

    <script>

        function myFunction(){
          var code = $('#postal_code').val();
          console.log(code);
          $.post('{{ route('pincode') }}', { _token:'{{ csrf_token() }}',code:code}, function(data){
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

      function edit_address(address) {
        var url = '{{ route("address.shipping.edit", ":id") }}';
        url = url.replace(':id', address);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'GET',
            success: function (response) {
                $('#edit_modal_body_billing').html(response);
                $('#edit-address-modal-billing').modal('show');

            }
        });
      }


      function edit_address_billing(address) {
        var url = '{{ route("address.billing.edit", ":id") }}';
        url = url.replace(':id', address);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'GET',
            success: function (response) {
                $('#edit_modal_body').html(response);
                $('#edit-address-modal').modal('show');

            }
        });
      }

    </script>

    @endsection
