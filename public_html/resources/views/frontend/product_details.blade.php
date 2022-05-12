@extends('frontend.layouts.app')

@section('meta_title'){{ $detailedProduct->meta_title }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ asset($detailedProduct->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
@endsection

@section('content')

<main>

<form id="option-choice-form" >
  @csrf
  <input type="hidden" name="id" value="{{ $detailedProduct->id }}" />


<section style="margin-bottom: 0;padding-bottom: 0;">
  <div class="container" >

    <div class="row">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div aria-label="breadcrumb">

          <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

            <li class="breadcrumb-item"><a href="{{ route('products') }}">Product</a></li>

            <li class="breadcrumb-item active" aria-current="page">{{ $detailedProduct->name }}</li>

          </ol>

        </div>

      </div>

    </div>

  </div>

</section>

<section style="margin:0 !important;padding:0 !important; ">

  <div class="container is-width">

    <div class="row">

      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">


        <div class="product__carousel">

          <div class="gallery-parent">

            <div class="swiper-container gallery-top">

              <div class="swiper-wrapper">

                @php
                  $image = json_decode($detailedProduct->photos);
                @endphp
                @if(isset($image))
                  @foreach($image as $images)
                    <div class="swiper-slide easyzoom easyzoom--overlay"><img src="{{ asset($images) }}" alt="" /></div>
                  @endforeach
                @endif
              </div>

              <div class="swiper-button-next swiper-button-white"></div>

              <div class="swiper-button-prev swiper-button-white"></div>

            </div>

            <div class="swiper-container gallery-thumbs">

              <div class="swiper-wrapper">

                @php
                  $image = json_decode($detailedProduct->photos);
                @endphp
                @if(isset($image))
                  @foreach($image as $images)
                    <div class="swiper-slide">
                      <img src="{{ asset($images) }}" alt="" />
                    </div>
                  @endforeach
                @endif
              </div>

            </div>

          </div>

        </div>



      </div>

      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

        <p>{{ $detailedProduct->sku_code }}</p>

        <h2 class="product_details_hedding">{{ $detailedProduct->name }}</h2>

        <h4 class="product_details_PRICE">PRICE: ₹{{  FrontTotalPrice($detailedProduct->id) }}</h4>

        <p class="texes-note">(Incl. of all taxes) <a href="javascript:void(0)" onclick="pricebreakup()">Price Breakup</a></p>

        <p class="note">*Weight and Price may vary subject to the stock available.</p>

        <p class="short_description">{{ $detailedProduct->short_description}}</p>

        <!-- <p class="textcolor"><a href="javascript:void(0)" onclick="pricebreakup()"><strong>Product Details</strong></a></p> -->

        <div class="form-group">

          <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

              <label for="GrossWeight">Gross Weight</label>

              <div>

                <a href="" class="gross-weight-flat-button active">{{ $detailedProduct->metal_weight + $detailedProduct->choki_diamond_weight + $detailedProduct->solited_diamond_weight + $detailedProduct->diamond_weight }}g</a>

              </div>

              <div class="sher_icon">
                  <label class="sher_text" for="sher_icon">Share</label>
                  <ul class="icons">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('product', $detailedProduct->slug) }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?url={{ route('product', $detailedProduct->slug) }}" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/?url={{ route('product', $detailedProduct->slug) }}" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/?text={{ route('product', $detailedProduct->slug) }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://telegram.me/share/url?url={{ route('product', $detailedProduct->slug) }}" target="_blank"><i class="fab fa-telegram-plane"></i></a>
                  </ul>
              </div>

            </div>
            @if($detailedProduct->current_stock <= 0)
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

              <label for="NetQty">Net Qty</label>

              <div class="num-block skin-3">

                <div class="num-in">

                  <span class="minus dis"></span>

                  <input type="text" id="NetQty" name="quantity" class="in-num" value="1" readonly="">

                  <span class="plus"></span>

                </div>

              </div>

            </div>
            @endif
          </div>

        </div>


          @if($detailedProduct->current_stock <= 0)
              <a href="#" class="black-flat-button" onclick="showModel();">TRY ON</a>
          @else
            @if($detailedProduct->upcomming == 1 && $detailedProduct->published == 1)
              <button type="button" id="addtocart_hide" class="black-flat-button add_to_cart" onclick="addToCart()">ADD TO CART</button>
            @elseif($detailedProduct->published == 1)
              <button type="button" id="addtocart_hide" class="black-flat-button add_to_cart" onclick="addToCart()">ADD TO CART</button>
            @endif
          @endif

        <!-- <a href="" class="onlyborder-flat-button">Book an Appointment</a> -->

        {{--<div class="currency">

          <a href="" class="gross-weight-flat-button active"><i class="fas fa-rupee-sign"></i></a>

          <a href="" class="gross-weight-flat-button"><i class="fas fa-dollar-sign"></i></a>

        </div>--}}



      </div>

    </div>

  </div>
  <!-- <div class="modal fade" id="share_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 p-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                      <div class="modal-body share_popup p-0">
                          <p class="text-center">Share this link via</p>
                          <ul class="icons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('product', $detailedProduct->slug) }}" target="_blank"><i class="fab fa-facebook"></i></a>
                            <a href="https://twitter.com/intent/tweet?url={{ route('product', $detailedProduct->slug) }}" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.instagram.com/?url={{ route('product', $detailedProduct->slug) }}" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://wa.me/?text={{ route('product', $detailedProduct->slug) }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                            <a href="https://telegram.me/share/url?url={{ route('product', $detailedProduct->slug) }}" target="_blank"><i class="fab fa-telegram"></i></a>
                          </ul>
                          <div class="field">
                            <i class="fa fa-link"></i>
                            <input type="text" id="copyurl" readonly value="{{ route('product', $detailedProduct->slug) }}">
                            <button type="button" class="black-flat-button"  style="margin: 0;" onclick="CopyText()">Copy</button>
                          </div>
                      </div>
                </div>
            </div>
        </div> -->
</section>

<script>

$(document).ready(function() {


  $('.num-in span').click(function () {

      var $input = $(this).parents('.num-block').find('input.in-num');

    if($(this).hasClass('minus')) {

      var count = parseFloat($input.val()) - 1;

      count = count < 1 ? 1 : count;

      if (count < 2) {

        $(this).addClass('dis');

      }

      else {

        $(this).removeClass('dis');

      }

      $input.val(count);

    }

    else {

      var count = parseFloat($input.val()) + 1

      $input.val(count);

      if (count > 1) {

        $(this).parents('.num-block').find(('.minus')).removeClass('dis');

      }

    }



    $input.change();

    return false;

  });



});

</script>

<style>

.card-btn, .card-btn:hover, .card-btn:focus{color: #000 !important;}

</style>
<!--
<section>

  <div class="container">

    <div class="row">

      <div class="col-lg-3 col-md-3"></div>

      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

          <a class="card-btn" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><h5>Pincode / Zipcode Check <i class="fa fa-angle-down" aria-hidden="true"></i></h5></a>

          <div class="collapse" id="collapseExample">

            <div class="card card-body">

              <p>FREE SHIPPING & FREE RETURNS ON ALL ORDERS Find out more about our Delivery and Returns policy.</p>

              <div class="form-group">

            <div class="row">

              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left">

                <label for="Country">Country <span>*</span></label>

                <select id="Country" class="custom-select-new">

                  <option value="Afganistan">Afghanistan</option>

                  <option value="Albania">Albania</option>

                  <option value="Algeria">Algeria</option>

                  <option value="American Samoa">American Samoa</option>

                  <option value="Andorra">Andorra</option>

                  <option value="Angola">Angola</option>

                  <option value="Anguilla">Anguilla</option>

                  <option value="Antigua & Barbuda">Antigua & Barbuda</option>

                  <option value="Argentina">Argentina</option>

                  <option value="Armenia">Armenia</option>

                  <option value="Aruba">Aruba</option>

                  <option value="Australia">Australia</option>

                  <option value="Austria">Austria</option>

                  <option value="Azerbaijan">Azerbaijan</option>

                  <option value="Bahamas">Bahamas</option>

                  <option value="Bahrain">Bahrain</option>

                  <option value="Bangladesh">Bangladesh</option>

                  <option value="Barbados">Barbados</option>

                  <option value="Belarus">Belarus</option>

                  <option value="Belgium">Belgium</option>

                  <option value="Belize">Belize</option>

                  <option value="Benin">Benin</option>

                  <option value="Bermuda">Bermuda</option>

                  <option value="Bhutan">Bhutan</option>

                  <option value="Bolivia">Bolivia</option>

                  <option value="Bonaire">Bonaire</option>

                  <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>

                  <option value="Botswana">Botswana</option>

                  <option value="Brazil">Brazil</option>

                  <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>

                  <option value="Brunei">Brunei</option>

                  <option value="Bulgaria">Bulgaria</option>

                  <option value="Burkina Faso">Burkina Faso</option>

                  <option value="Burundi">Burundi</option>

                  <option value="Cambodia">Cambodia</option>

                  <option value="Cameroon">Cameroon</option>

                  <option value="Canada">Canada</option>

                  <option value="Canary Islands">Canary Islands</option>

                  <option value="Cape Verde">Cape Verde</option>

                  <option value="Cayman Islands">Cayman Islands</option>

                  <option value="Central African Republic">Central African Republic</option>

                  <option value="Chad">Chad</option>

                  <option value="Channel Islands">Channel Islands</option>

                  <option value="Chile">Chile</option>

                  <option value="China">China</option>

                  <option value="Christmas Island">Christmas Island</option>

                  <option value="Cocos Island">Cocos Island</option>

                  <option value="Colombia">Colombia</option>

                  <option value="Comoros">Comoros</option>

                  <option value="Congo">Congo</option>

                  <option value="Cook Islands">Cook Islands</option>

                  <option value="Costa Rica">Costa Rica</option>

                  <option value="Cote DIvoire">Cote DIvoire</option>

                  <option value="Croatia">Croatia</option>

                  <option value="Cuba">Cuba</option>

                  <option value="Curaco">Curacao</option>

                  <option value="Cyprus">Cyprus</option>

                  <option value="Czech Republic">Czech Republic</option>

                  <option value="Denmark">Denmark</option>

                  <option value="Djibouti">Djibouti</option>

                  <option value="Dominica">Dominica</option>

                  <option value="Dominican Republic">Dominican Republic</option>

                  <option value="East Timor">East Timor</option>

                  <option value="Ecuador">Ecuador</option>

                  <option value="Egypt">Egypt</option>

                  <option value="El Salvador">El Salvador</option>

                  <option value="Equatorial Guinea">Equatorial Guinea</option>

                  <option value="Eritrea">Eritrea</option>

                  <option value="Estonia">Estonia</option>

                  <option value="Ethiopia">Ethiopia</option>

                  <option value="Falkland Islands">Falkland Islands</option>

                  <option value="Faroe Islands">Faroe Islands</option>

                  <option value="Fiji">Fiji</option>

                  <option value="Finland">Finland</option>

                  <option value="France">France</option>

                  <option value="French Guiana">French Guiana</option>

                  <option value="French Polynesia">French Polynesia</option>

                 <option value="French Southern Ter">French Southern Ter</option>

                 <option value="Gabon">Gabon</option>

                 <option value="Gambia">Gambia</option>

                 <option value="Georgia">Georgia</option>

                 <option value="Germany">Germany</option>

                 <option value="Ghana">Ghana</option>

                 <option value="Gibraltar">Gibraltar</option>

                 <option value="Great Britain">Great Britain</option>

                 <option value="Greece">Greece</option>

                 <option value="Greenland">Greenland</option>

                 <option value="Grenada">Grenada</option>

                 <option value="Guadeloupe">Guadeloupe</option>

                 <option value="Guam">Guam</option>

                 <option value="Guatemala">Guatemala</option>

                 <option value="Guinea">Guinea</option>

                 <option value="Guyana">Guyana</option>

                 <option value="Haiti">Haiti</option>

                 <option value="Hawaii">Hawaii</option>

                 <option value="Honduras">Honduras</option>

                 <option value="Hong Kong">Hong Kong</option>

                 <option value="Hungary">Hungary</option>

                 <option value="Iceland">Iceland</option>

                 <option value="Indonesia">Indonesia</option>

                 <option value="India">India</option>

                 <option value="Iran">Iran</option>

                 <option value="Iraq">Iraq</option>

                 <option value="Ireland">Ireland</option>

                 <option value="Isle of Man">Isle of Man</option>

                 <option value="Israel">Israel</option>

                 <option value="Italy">Italy</option>

                 <option value="Jamaica">Jamaica</option>

                 <option value="Japan">Japan</option>

                 <option value="Jordan">Jordan</option>

                 <option value="Kazakhstan">Kazakhstan</option>

                 <option value="Kenya">Kenya</option>

                 <option value="Kiribati">Kiribati</option>

                 <option value="Korea North">Korea North</option>

                 <option value="Korea Sout">Korea South</option>

                 <option value="Kuwait">Kuwait</option>

                 <option value="Kyrgyzstan">Kyrgyzstan</option>

                 <option value="Laos">Laos</option>

                 <option value="Latvia">Latvia</option>

                 <option value="Lebanon">Lebanon</option>

                 <option value="Lesotho">Lesotho</option>

                 <option value="Liberia">Liberia</option>

                 <option value="Libya">Libya</option>

                 <option value="Liechtenstein">Liechtenstein</option>

                 <option value="Lithuania">Lithuania</option>

                 <option value="Luxembourg">Luxembourg</option>

                 <option value="Macau">Macau</option>

                 <option value="Macedonia">Macedonia</option>

                 <option value="Madagascar">Madagascar</option>

                 <option value="Malaysia">Malaysia</option>

                 <option value="Malawi">Malawi</option>

                 <option value="Maldives">Maldives</option>

                 <option value="Mali">Mali</option>

                 <option value="Malta">Malta</option>

                 <option value="Marshall Islands">Marshall Islands</option>

                 <option value="Martinique">Martinique</option>

                 <option value="Mauritania">Mauritania</option>

                 <option value="Mauritius">Mauritius</option>

                 <option value="Mayotte">Mayotte</option>

                 <option value="Mexico">Mexico</option>

                 <option value="Midway Islands">Midway Islands</option>

                 <option value="Moldova">Moldova</option>

                 <option value="Monaco">Monaco</option>

                 <option value="Mongolia">Mongolia</option>

                 <option value="Montserrat">Montserrat</option>

                 <option value="Morocco">Morocco</option>

                 <option value="Mozambique">Mozambique</option>

                 <option value="Myanmar">Myanmar</option>

                 <option value="Nambia">Nambia</option>

                 <option value="Nauru">Nauru</option>

                 <option value="Nepal">Nepal</option>

                 <option value="Netherland Antilles">Netherland Antilles</option>

                 <option value="Netherlands">Netherlands (Holland, Europe)</option>

                 <option value="Nevis">Nevis</option>

                 <option value="New Caledonia">New Caledonia</option>

                 <option value="New Zealand">New Zealand</option>

                 <option value="Nicaragua">Nicaragua</option>

                 <option value="Niger">Niger</option>

                 <option value="Nigeria">Nigeria</option>

                 <option value="Niue">Niue</option>

                 <option value="Norfolk Island">Norfolk Island</option>

                 <option value="Norway">Norway</option>

                 <option value="Oman">Oman</option>

                 <option value="Pakistan">Pakistan</option>

                 <option value="Palau Island">Palau Island</option>

                 <option value="Palestine">Palestine</option>

                 <option value="Panama">Panama</option>

                 <option value="Papua New Guinea">Papua New Guinea</option>

                 <option value="Paraguay">Paraguay</option>

                 <option value="Peru">Peru</option>

                 <option value="Phillipines">Philippines</option>

                 <option value="Pitcairn Island">Pitcairn Island</option>

                 <option value="Poland">Poland</option>

                 <option value="Portugal">Portugal</option>

                 <option value="Puerto Rico">Puerto Rico</option>

                 <option value="Qatar">Qatar</option>

                 <option value="Republic of Montenegro">Republic of Montenegro</option>

                 <option value="Republic of Serbia">Republic of Serbia</option>

                 <option value="Reunion">Reunion</option>

                 <option value="Romania">Romania</option>

                 <option value="Russia">Russia</option>

                 <option value="Rwanda">Rwanda</option>

                 <option value="St Barthelemy">St Barthelemy</option>

                 <option value="St Eustatius">St Eustatius</option>

                 <option value="St Helena">St Helena</option>

                 <option value="St Kitts-Nevis">St Kitts-Nevis</option>

                 <option value="St Lucia">St Lucia</option>

                 <option value="St Maarten">St Maarten</option>

                 <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>

                 <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>

                 <option value="Saipan">Saipan</option>

                 <option value="Samoa">Samoa</option>

                 <option value="Samoa American">Samoa American</option>

                 <option value="San Marino">San Marino</option>

                 <option value="Sao Tome & Principe">Sao Tome & Principe</option>

                 <option value="Saudi Arabia">Saudi Arabia</option>

                 <option value="Senegal">Senegal</option>

                 <option value="Seychelles">Seychelles</option>

                 <option value="Sierra Leone">Sierra Leone</option>

                 <option value="Singapore">Singapore</option>

                 <option value="Slovakia">Slovakia</option>

                 <option value="Slovenia">Slovenia</option>

                 <option value="Solomon Islands">Solomon Islands</option>

                 <option value="Somalia">Somalia</option>

                 <option value="South Africa">South Africa</option>

                 <option value="Spain">Spain</option>

                 <option value="Sri Lanka">Sri Lanka</option>

                 <option value="Sudan">Sudan</option>

                 <option value="Suriname">Suriname</option>

                 <option value="Swaziland">Swaziland</option>

                 <option value="Sweden">Sweden</option>

                 <option value="Switzerland">Switzerland</option>

                 <option value="Syria">Syria</option>

                 <option value="Tahiti">Tahiti</option>

                 <option value="Taiwan">Taiwan</option>

                 <option value="Tajikistan">Tajikistan</option>

                 <option value="Tanzania">Tanzania</option>

                 <option value="Thailand">Thailand</option>

                 <option value="Togo">Togo</option>

                 <option value="Tokelau">Tokelau</option>

                 <option value="Tonga">Tonga</option>

                 <option value="Trinidad & Tobago">Trinidad & Tobago</option>

                 <option value="Tunisia">Tunisia</option>

                 <option value="Turkey">Turkey</option>

                 <option value="Turkmenistan">Turkmenistan</option>

                 <option value="Turks & Caicos Is">Turks & Caicos Is</option>

                 <option value="Tuvalu">Tuvalu</option>

                 <option value="Uganda">Uganda</option>

                 <option value="United Kingdom">United Kingdom</option>

                 <option value="Ukraine">Ukraine</option>

                 <option value="United Arab Erimates">United Arab Emirates</option>

                 <option value="United States of America">United States of America</option>

                 <option value="Uraguay">Uruguay</option>

                 <option value="Uzbekistan">Uzbekistan</option>

                 <option value="Vanuatu">Vanuatu</option>

                 <option value="Vatican City State">Vatican City State</option>

                 <option value="Venezuela">Venezuela</option>

                 <option value="Vietnam">Vietnam</option>

                 <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>

                 <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>

                 <option value="Wake Island">Wake Island</option>

                 <option value="Wallis & Futana Is">Wallis & Futana Is</option>

                 <option value="Yemen">Yemen</option>

                 <option value="Zaire">Zaire</option>

                 <option value="Zambia">Zambia</option>

                 <option value="Zimbabwe">Zimbabwe</option>

                </select>

              </div>

              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left">

                <label for="NetQty">Pincode</label>

                <div class="input-group">

                  <input type="text" class="form-control" placeholder="Enter Your Pincode...">

                  <div class="input-group-append">

                    <button class="btn btn-outline-secondary" type="button" style="margin:0 !important;">Check</button>

                  </div>

                </div>

              </div>

            </div>

          </div>

            </div>

          </div>

        </div>

      </div>

      <div class="col-lg-3 col-md-3"></div>

    </div>

  </div>

</section> -->

<script>
    $('.card-btn').click(function() {
        $(this).find('i').toggleClass('fa fa-angle-down fa fa-angle-up')
    });
</script>



<div id="idpricebreakup"></div>

<section>

  <div class="container">

    <div class="row">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="tab_wrapper first_tab">

            <ul class="tab_list">

                <li class="active">PRODUCT DETAIL</li>

                <li id="pricebreakup">PRICE BREAKUP</li>

                <li>DESCRIPTION</li>

                <li>REVIEWS</li>

                <!-- <li>MORE INFO</li> -->

            </ul>

            <div class="content_wrapper">
              <div class="tab_content active">

                  <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                      <div class="table-responsive">

                        <table class="table table-sm">

                            <tr>

                              <td><strong>Purity</strong></td>

                              <td>{{ $detailedProduct->purity->name }}</td>

                              <td><strong> Brand </strong> </td>

                              <td>Swayamvar Jewellers</td>

                            </tr>

                            <tr>

                                <td><strong>Gender</strong></td>
                                @php
                                if($detailedProduct->gender == 0){
                                  $gender = "Men";
                                }else if($detailedProduct->gender == 1){
                                    $gender = "Women";
                                }elseif($detailedProduct->gender == 2){
                                  $gender = "Kids";
                                }else{
                                  $gender = "Unisex";
                                }
                                @endphp
                                <td>{{ $gender }}</td>

                                <td> <strong> Product </strong></td>
                                <td>{{ $detailedProduct->category->name }}</td>
                              </tr>
                              <tr>


                                <td><strong>Metal</strong></td>

                                <td>{{ $detailedProduct->mtype  ->name }}</td>

                                <td><strong>Jewellery Type</strong></td>

                                <td>{{ $detailedProduct->jewellery_types->name }}</td>

                              </tr>
                            <tr>


                              <td><strong>Metal</strong></td>

                              <td>{{ $detailedProduct->mtype  ->name }}</td>
@if(isset($detailedProduct->diamond_quality) && $detailedProduct->diamond_quality != "")
                              <td><strong>Diamond Quality</strong></td>

                              <td>{{ $detailedProduct->diamond_quality }}</td>
 @endif
                            </tr>

                            <tr>
                                  @if(isset($detailedProduct->choki_diamond_quality) && $detailedProduct->choki_diamond_quality != "")
                              <td><strong>Choki diamond quality</strong></td>

                              <td>{{ $detailedProduct->choki_diamond_quality }}</td>
                                    @endif
                              @if(isset($detailedProduct->solited_diamond_quality) && $detailedProduct->solited_diamond_qualitysolited_diamond_quality != "")
                              <td><strong>Solited Diamond Quality</strong></td>

                              <td>{{ $detailedProduct->solited_diamond_quality }}</td>
                            @endif

                            </tr>

                        </table>

                      </div>

                    </div>

                  </div>

                </div>

<style media="screen">
  .tab_content .table.full-border td, .tab_content .table.full-border th {
      border: 1px solid #ddd;
      padding: 5px 10px;
  }
</style>

                <div class="tab_content"  style="display: none;">

                  <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                      <div class="table-responsive">

                        <table class="table table-sm full-border">

                          <thead class="thead-light">

                            <tr>

                              <th scope="col">Component</th>

                              <th scope="col">Diamond Pieces</th>

                              <th scope="col">Metal Rate</th>

                              <th scope="col">Weight (ct)</th>

                              <th scope="col">Discount</th>

                              <th scope="col">Final Value</th>

                            </tr>

                          </thead>

                          <tbody>

                            <!-- <tr>
                              <td><strong> {{ $detailedProduct->purity->name }} {{ $detailedProduct->colorss->color }} <br> Diamond <br> Choki Diamond </br> Solited Diamond</strong></td>
                            <td>
                               - <br> @if($detailedProduct->diamond_pieces !="") {{ $detailedProduct->diamond_pieces }} @else - @endif <br>
                                @if($detailedProduct->choki_diamond_pieces !="") {{ $detailedProduct->choki_diamond_pieces }} @else - @endif <br>
                                @if($detailedProduct->solited_diamond_pieces !="") {{ $detailedProduct->solited_diamond_pieces }} @else - @endif
                            </td>
                              <td><i class="fa fa-inr" aria-hidden="true"></i>

                              {{ $detailedProduct->metal_rate }}/ct <br> @if($detailedProduct->diamond_price !="") {{ $detailedProduct->diamond_price }}/ct @else - @endif <br>
                                @if($detailedProduct->choki_diamond_price !="") {{ $detailedProduct->choki_diamond_price }}/ct @else - @endif <br>
                                @if($detailedProduct->solited_diamond_price !="") {{ $detailedProduct->solited_diamond_price }}/ct @else - @endif

                              </td>

                              <td>{{ $detailedProduct->metal_weight }}/ct  <br> @if($detailedProduct->diamond_weight !="") {{ $detailedProduct->diamond_weight }}/ct @else - @endif <br>
                                @if($detailedProduct->choki_diamond_weight !="") {{ $detailedProduct->choki_diamond_weight }}/ct @else - @endif <br>
                                @if($detailedProduct->solited_diamond_weight !="") {{ $detailedProduct->solited_diamond_weight }}/ct @else - @endif
                              </td>

                              <td>-</td>

                              <td><i class="fa fa-inr" aria-hidden="true"></i>
                                  ₹{{ $detailedProduct->metal_rate * $detailedProduct->metal_weight }} <br> ₹{{ $detailedProduct->diamond_price * $detailedProduct->diamond_weight }} <br>
                                  ₹{{ $detailedProduct->choki_diamond_price * $detailedProduct->choki_diamond_weight }} <br> ₹{{ $detailedProduct->solited_diamond_price * $detailedProduct->solited_diamond_weight }}
                                </td>
                            </tr> -->

                            <tr>
                              <td><strong> {{ $detailedProduct->purity->name }} {{ $detailedProduct->colorss->color }}</strong></td>
                            <td> - </td>
                              <td><i class="fa fa-inr" aria-hidden="true"></i>

                              {{ $detailedProduct->metal_rate }}/ct <br>
                                        </td>

                              <td>{{ $detailedProduct->metal_weight }}/ct </td>

                              <td>-</td>

                              <td><i class="fa fa-inr" aria-hidden="true"></i>
                                  ₹{{ $detailedProduct->metal_rate * $detailedProduct->metal_weight }}
                                </td>
                            </tr>

                            <tr>
                              <td><strong> Diamond </strong></td>
                            <td>
                               @if($detailedProduct->diamond_pieces !="") {{ $detailedProduct->diamond_pieces }} @else - @endif
                            </td>
                              <td><i class="fa fa-inr" aria-hidden="true"></i>
                                @if($detailedProduct->choki_diamond_price !="") {{ $detailedProduct->choki_diamond_price }}/ct @else - @endif
                               </td>

                              <td> @if($detailedProduct->diamond_weight !="") {{ $detailedProduct->diamond_weight }}/ct @else - @endif
                              </td>

                              <td>-</td>

                              <td><i class="fa fa-inr" aria-hidden="true"></i>
                                   ₹{{ $detailedProduct->diamond_price * $detailedProduct->diamond_weight }}
                                </td>
                            </tr>

                            <tr>
                              <td><strong>  Choki Diamond </strong></td>
                            <td>
                                                             @if($detailedProduct->choki_diamond_pieces !="") {{ $detailedProduct->choki_diamond_pieces }} @else - @endif
                            </td>
                              <td><i class="fa fa-inr" aria-hidden="true"></i>

                                @if($detailedProduct->choki_diamond_price !="") {{ $detailedProduct->choki_diamond_price }}/ct @else - @endif

                              </td>

                              <td>@if($detailedProduct->choki_diamond_weight !="") {{ $detailedProduct->choki_diamond_weight }}/ct @else - @endif </td>

                              <td>-</td>

                              <td><i class="fa fa-inr" aria-hidden="true"></i>
                                  ₹{{ $detailedProduct->choki_diamond_price * $detailedProduct->choki_diamond_weight }}
                                </td>
                            </tr>

                            <tr>
                              <td><strong> Solited Diamond</strong></td>
                            <td>@if($detailedProduct->solited_diamond_pieces !="") {{ $detailedProduct->solited_diamond_pieces }} @else - @endif
                            </td>
                              <td><i class="fa fa-inr" aria-hidden="true"></i>

                              @if($detailedProduct->solited_diamond_price !="") {{ $detailedProduct->solited_diamond_price }}/ct @else - @endif

                              </td>

                              <td>@if($detailedProduct->solited_diamond_weight !="") {{ $detailedProduct->solited_diamond_weight }}/ct @else - @endif</td>

                              <td>-</td>

                              <td><i class="fa fa-inr" aria-hidden="true"></i>
                                  ₹{{ $detailedProduct->solited_diamond_price * $detailedProduct->solited_diamond_weight }}
                                </td>
                            </tr>

                            <tr>

                              <td> <strong>Making Charges </strong></td>
                                 <td>-</td>

                              <td>-</td>

                              <td>-</td>

                              <td>-</td>

                              <td><i class="fa fa-inr" aria-hidden="true"></i>₹{{ $detailedProduct->labor_charge ?? '0.00' }}</td>

                            </tr>

                          </tbody>

                          <tfoot>


                            <tr>

                              <td> <strong> GST Tax </strong> </td>
 <td>-</td>
                              <td>-</td>

                              <td>-</td>

                              <td><i class="fa fa-inr" aria-hidden="true"></i>-</td>

                              <td>₹{{ totalTaxProduct($detailedProduct->id) ?? '0' }}</td>

                            </tr>

                            <tr>

                              <td> <strong>  Discount </strong> </td>
 <td>-</td>
                              <td>-</td>

                              <td>-</td>

                              <td>-</td>

                              <td><i class="fa fa-inr" aria-hidden="true"></i>   ₹{{ $detailedProduct->discount }} </td>

                            </tr>

                            <tr>

                              <td> <strong> Sub Total </strong> </td>
 <td>-</td>
                              <td>-</td>

                              <td>-</td>

                              <td>-</td>

                              <td><i class="fa fa-inr" aria-hidden="true"></i>₹{{ $detailedProduct->sub_total ?? '0' }}</td>

                            </tr>

                            <tr style="font-weight: 500;">

                              <td> <strong> Grand Total </strong> </td>
 <td>-</td>
                              <td>-</td>

                              <td>-</td>

                              <td>-</td>

                              <td><i class="fa fa-inr" aria-hidden="true"></i>  ₹{{ FrontTotalPrice($detailedProduct->id) }}<br>(MRP Incl. of all taxes)</td>

                            </tr>

                          </tfoot>

                        </table>

                      </div>

                    </div>

                  </div>

                </div>

                <div class="tab_content"  style="display: none;">

                  <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    @if(isset($detailedProduct->description))
                            <p>{!!$detailedProduct->description !!}</p>
                          @else
                            <p>Product Description is not available..</p>
                          @endif

                    </div>

                  </div>

                </div>

                <div class="tab_content"  style="display: none;">

                <style>
                            span.checked {color: #FBB202;}
                            .rating {width: 265px;position: relative;direction: rtl;}
                            .rating input {position: absolute;width: 15px;height: 24px;cursor: pointer;transform: translateX(52px);opacity: 0;z-index: 5;}
                            .rating input:nth-of-type(1) {right: 184px;}
                            .rating input:nth-of-type(2) {right: 212px;}
                            .rating input:nth-of-type(3) {right: 240px;}
                            .rating input:nth-of-type(4) {right: 270px;}
                            .rating input:nth-of-type(5) {right: 297px;}
                            .rating input:checked ~ .star:after, .rating input:hover ~ .star:after {content: '\f005';}
                            .rating .star {display: inline-block;font-family: FontAwesome;font-size: 20px;color: #FBB202;cursor: pointer;margin: 3px;}
                            .rating .star:after {content: '\f006';}
                            .rating .star:hover ~ .star:after, .rating .star:hover:after {content: '\f005';}
                            .customer-review{border-bottom: 1px solid #0000001a;margin-bottom: 1rem;padding-bottom: 1rem;}
                            .customer-review .pic{width: 90px;height: 90px;border-radius: 50%;border: 1px solid #fbc9be;background-color: #fbc9be;overflow: hidden;}
                            .customer-review .customer-description p:first-child{margin-bottom: 0;}
                        </style>
                          <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              @foreach ($detailedProduct->reviews as $key => $review)
                                @if($review->user != null)
                                <div class="row customer-review">
                                    <div class="col-lg-1 col-md-2 col-sm-12 col-xs-12">
                                      <div class="pic"><img src="{{ asset('frontend/images/testimonial-thumb.png')}}" alt=""></div>
                                    </div>
                                    <div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
                                        <div class="customer-description">
                                          <p><strong>{{ $review->user->name }}</strong></p>
                                          <div>
                                          @for ($i=0; $i < $review->rating; $i++)
                                              <span class="fa fa-star checked"></span>
                                          @endfor
                                          @for ($i=0; $i < 5-$review->rating; $i++)
                                                <span class="fa fa-star-o"></span>
                                          @endfor
                                          </div>
                                          <p>" {{ $review->comment }}"</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                              @endforeach
                            </div>

                            @if(count($detailedProduct->reviews) <= 0)
                              <div class="text-center">
                                  {{ __('There have been no reviews for this product yet.') }}
                              </div>
                            @endif

                            @if(Auth::check())
                              @php
                                  $commentable = false;
                              @endphp
                              @foreach ($detailedProduct->orderDetails as $key => $orderDetail)
                                  @if($orderDetail->order != null && $orderDetail->order->user_id == Auth::user()->id && $orderDetail->delivery_status == 'delivered' && \App\Review::where('user_id', Auth::user()->id)->where('product_id', $detailedProduct->id)->first() == null)
                                      @php
                                          $commentable = true;
                                      @endphp
                                  @endif
                              @endforeach
                              @if ($commentable)
                              <form class="form-default" role="form" action="{{ route('reviews.store') }}" method="POST">
                                @csrf
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h5>Write your review</h5>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label><strong>Full Name <span>*</span></strong></label>
                                                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" placeholder="Full Name" required>
                                                        <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label><strong>Email <span>*</span></strong></label>
                                                        <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label><strong>Your rating <span>*</span></strong></label>
                                                        <div class="rating">
                                                            <input type="radio" name="star"  value="5"  />
                                                            <span class="star"> </span>
                                                            <input type="radio" name="star" value="4"/>
                                                            <span class="star"> </span>
                                                            <input type="radio" name="star" value="3"/>
                                                            <span class="star"> </span>
                                                            <input type="radio" name="star" value="2"/>
                                                            <span class="star"> </span>
                                                            <input type="radio" name="star" value="1"/>
                                                            <span class="star"> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label><strong>Your review <span>*</span></strong></label>
                                                <textarea class="form-control" placeholder="Your review" name="comment" required
                                                    style="height:100px;"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group"> <button type="submit" class="black-flat-button">Submit your review</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </form>
                              @endif
                            @endif
                          </div>
                </div>

                <div class="tab_content"  style="display: none;">

                  <div class="row">

                    <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                      <p>Titan Company Limited,Jewellery Division 29,Sipcot Industrial Complex,Hosur - 635126, Krishnagiri District,Tamil Nadu.</p>

                      <p><strong>Country Of Origin - </strong> India</p>

                      <p><strong>Imported By - </strong> Titan Company Limited,Jewellery Division 29,Sipcot Industrial Complex,Hosur - 635126, Krishnagiri District,Tamil Nadu.</p>

                      <p><strong>Net Quantity: </strong> 1 N</p>

                      <p>Contact customer care executive at the manufacturing address above or call us at 1800-266-0123. Email us at customercare@dkjewel.com</p>

                    </div> -->

                  </div>

                </div>

            </div>

        </div>

      </div>

    </div>

  </div>

</section>

<!-- <section>

  <div id="div1"></div>

  <div id="image">

    <div class="container">

      <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

          <h3>BUYING GUIDES</h3>

        </div>

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

      <a href=""><img src="{{ asset('frontend/dk/images/the-diamond-guide.jpg') }}" /></a>

    </div>

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

      <a href=""><img src="{{ asset('frontend/dk/images/the-gemstone-guide.jpg') }}" /></a>

    </div>

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

      <a href=""><img src="{{ asset('frontend/dk/images/the-metal-guide.jpg') }}" /></a>

    </div>

  </div>

</div>

  </div>

  <style>

    #div1{width:100%;height:400px;background:#a08d5a;}

    #image{position:relative;margin-top:-330px;z-index:2}

  </style>

</section> -->

<section>
    @php
       $reletedproducts = \App\Product::where('category_id', $detailedProduct->category_id)->where('published', 1)->get();
      @endphp
  <div class="container">

    <div class="row">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

          <div class="title text-center">
                <h3>You May Also Like</h3>
            </div>

          <div class="you-may-also-like slider">
                @foreach($reletedproducts as $reletedproduct)
                  <div class="slide">

                    <div class="product-grid grid-1">

                      <div class="product-item">

                        <div class="product-single">

                          <div class="product-img">

                            <a href="{{route('product', $reletedproduct->slug)}}">
                              <img src="{{ asset($reletedproduct->thumbnail_img) }}" alt="Product Image"></a>

                          </div>

                          <div class="product-content">

                            <div class="product-title">

                              <h2><a href="{{route('product', $reletedproduct->slug)}}">{{$reletedproduct->name}}</a></h2>

                            </div>

                            <div class="product-price">
                              @if(isset($reletedproduct->discount_value) && $reletedproduct->discount_value != '0')
                              <div class="product_price_discount"><h2>{{format_price(FrontTotalPrice($reletedproduct->id))}}</h2> <span class="coma"> , </span> &nbsp; <h4>{{format_price(FrontTotalPrice($reletedproduct->id))}}</h4></div>
                              @else
                                  <h2>{{format_price(FrontTotalPrice($reletedproduct->id))}}</h2>
                              @endif
                            </div>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>
                @endforeach

        </div>

      </div>

    </div>

  </div>

</section>
<!--
<section>
@php
      $mostviewproducts = \App\Product::where('published', 1)->where('most_view','!=', 0)->orderBy('view', 'desc')->limit(4)->get();
     @endphp
  <div class="container">

    <div class="row">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

          <h3 class="text-center">Customers Who Viewed This Item Also Viewed</h3>

          <div class="product-grid grid-1">

              @foreach($mostviewproducts as $mostviewproduct)
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">

                  <div class="product-item">

                    <div class="product-single">

                      <div class="product-img">

                        <a href="{{route('product', $reletedproduct->slug)}}" >
                          <img src="{{ asset($mostviewproduct->thumbnail_img) }}" alt="Product Image" style="height:250px;object-fit:cover;"></a>

                      </div>

                      <div class="product-content">

                        <div class="product-title">

                          <h2><a href="">{{$mostviewproduct->name}}</a></h2>

                        </div>

                        <div class="product-price">

                          @if(isset($mostviewproduct->discount_value) && $mostviewproduct->discount_value != '0')
                              <div class="product_price_discount"><h2>{{format_price(FrontTotalPrice($mostviewproduct->id))}}</h2> <span class="coma"> , </span> &nbsp; <h4>{{format_price(FrontTotalPrice($mostviewproduct->id))}}</h4></div>
                          @else
                              <h2>{{format_price(FrontTotalPrice($mostviewproduct->id))}}</h2>
                          @endif
                        </div>

                      </div>

                    </div>

                  </div>

                </div>
                @endforeach

          </div>

        </div>

      </div>

    </div>

  </div>

</section> -->
</form>
</main>


<script>

$(document).ready(function(){

  $('.you-may-also-like').slick({

    slidesToShow: 4,

    slidesToScroll: 1,

    autoplay: true,

    autoplaySpeed: 2500,

    arrows: true,

    dots: false,

    pauseOnHover: true,

    responsive: [{

      breakpoint: 768,

      settings: {

        slidesToShow: 3

      }

    }, {

      breakpoint: 520,

      settings: {

        slidesToShow: 1

      }

    }]

  });

});

</script>

<script>

$(document).ready(function(){

    $("#testimonial-slider").owlCarousel({

        items:1,

        itemsDesktop:[1000,1],

        itemsDesktopSmall:[979,1],

        itemsTablet:[768,1],

        pagination:false,

        navigation:true,

        navigationText:["",""],

        autoPlay:true

    });

});





</script>



<style>

@media (min-width: 576px) {

  .modal-dialog {

    max-width: 400px;

  }

  .modal-dialog .modal-content {

    padding: 1rem;

  }

}

.modal-header .close {

  margin-top: -1.5rem;

}



.form-title {

  margin: -2rem 0rem 2rem;

}



.btn-round {

  border-radius: 3rem;

}



.delimiter {

  padding: 1rem;

}



.social-buttons .btn {

  margin: 0 0.5rem 1rem;

}



.signup-section {

  padding: 0.3rem 0rem;

}

</style>


<script type="text/javascript">

    function custom_template(obj){

            var data = $(obj.element).data();

            var text = $(obj.element).text();

            if(data && data['img_src']){

                img_src = data['img_src'];

                // template = $("<div><img src=\"" + img_src + "\" style=\"width:100%;height:150px;\"/><p style=\"font-weight: 700;font-size:14pt;text-align:center;\">" + text + "</p></div>");

                template = $("<p style='margin: 0;'><img src=\"" + img_src + "\"style=\"float: left;\"/> &nbsp;" + text + "</p>");

                return template;

            }

        }

    var options = {

        'templateSelection': custom_template,

        'templateResult': custom_template,

    }

    $('#id_select2_example').select2(options);

    $('#id_select3_example').select2(options);

    // $('.select2-container--default .select2-selection--single').css({'height': '220px'});





</script>


<style>

#searchForm{

  z-index: 1;

  position: absolute;

  top: 40px;

  right: 120px;

  background-color: #fcf7f0;

  padding: 10px;

}

.sticky {

  position: fixed;

  top: 0;

  width: 100%;

  z-index: 20;

  background-color: #fff;

  box-shadow: 0 0 10px 3px #0000001a;

}

</style>

<script>

$(document).ready(function(){

$ ("#searchForm"). hide ();

$("#searchButton").click(function(){

     $("#searchForm").show();

});

$("#closebutton").click(function(){

  $("#searchForm").hide();

});

});



</script>

<script>

window.onscroll = function() {myFunction()};



var header = document.getElementById("myHeader");

var sticky = header.offsetTop;



function myFunction() {

  if (window.pageYOffset > sticky) {

    header.classList.add("sticky");

    $('.menu-logo').show();

  } else {

    header.classList.remove("sticky");

    $('.menu-logo').hide();

  }

}

</script>


<script type="text/javascript">

    $(document).ready(function() {

        $(".first_tab").champ();

    });

</script>

<script type="text/javascript">

function pricebreakup(){

     $('html, body').animate({

        scrollTop: $("#idpricebreakup").offset().top - 150

    },1000);

$('.tab_list').on('click', '#pricebreakup', function(){

    $('.tab_list #pricebreakup').removeClass('active');

    $(this).addClass('active');

});

}



</script>

<style>

.product-grid .product-item{width: 100% !important;}

</style>


@endsection
