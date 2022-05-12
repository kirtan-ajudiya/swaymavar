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
                    <li class="breadcrumb-item active" aria-current="page">Edit Personal Information</li>
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
        <hr>
        <form action="{{route('customer.profile.update')}}"  method="POST">
            @csrf
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h4 class="mb-4">Personal Details</h4>
                <div class="row mb-5">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <label><strong>Title <span>*</span></strong></label>
                        <div class="form-group">
                            <select class="form-control" name="title">
                                <option value="Mr" @if(isset($user->title) && $user->title == 'Mr') selected @endif>Mr.</option>
                                <option value="Mrs" @if(isset($user->title) && $user->title == 'Mrs') selected @endif>Mrs.</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <label><strong>Full Name <span>*</span></strong></label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="First Name">
                        </div>
                        @error('name')
                            <strong style="color: red">{{ $message }}</strong>
                        @enderror
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <label><strong>Phone number <span>*</span></strong></label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" value="{{$user->phone}}"  placeholder="Enter phone number" @if(isset($user) && $user->provider_id == "") readonly @endif>
                        </div>
                        @error('phone')
                            <strong style="color: red">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label><strong>Date of birth <span>*</span></strong></label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <select class="form-control" name="birth_date">
                                <option>DD</option>
                                <option value="01" @if(isset($user->birth_date) && $user->birth_date == '>0') selected @endif  >01</option>
                                <option value="02" @if(isset($user->birth_date) && $user->birth_date == '02') selected @endif >02</option>
                                <option value="03" @if(isset($user->birth_date) && $user->birth_date == '03') selected @endif >03</option>
                                <option value="04" @if(isset($user->birth_date) && $user->birth_date == '04') selected @endif >04</option>
                                <option value="05" @if(isset($user->birth_date) && $user->birth_date == '05') selected @endif >05</option>
                                <option value="06" @if(isset($user->birth_date) && $user->birth_date == '06') selected @endif >06</option>
                                <option value="07" @if(isset($user->birth_date) && $user->birth_date == '07') selected @endif >07</option>
                                <option value="08" @if(isset($user->birth_date) && $user->birth_date == '08') selected @endif >08</option>
                                <option value="09" @if(isset($user->birth_date) && $user->birth_date == '09') selected @endif >09</option>
                                <option value="10" @if(isset($user->birth_date) && $user->birth_date == '10') selected @endif >10</option>
                                <option value="11" @if(isset($user->birth_date) && $user->birth_date == '11') selected @endif >11</option>
                                <option value="12" @if(isset($user->birth_date) && $user->birth_date == '12') selected @endif >12</option>
                                <option value="13" @if(isset($user->birth_date) && $user->birth_date == '13') selected @endif >13</option>
                                <option value="14" @if(isset($user->birth_date) && $user->birth_date == '14') selected @endif >14</option>
                                <option value="15" @if(isset($user->birth_date) && $user->birth_date == '15') selected @endif >15</option>
                                <option value="16" @if(isset($user->birth_date) && $user->birth_date == '16') selected @endif >16</option>
                                <option value="17" @if(isset($user->birth_date) && $user->birth_date == '17') selected @endif >17</option>
                                <option value="18" @if(isset($user->birth_date) && $user->birth_date == '18') selected @endif >18</option>
                                <option value="19" @if(isset($user->birth_date) && $user->birth_date == '19') selected @endif >19</option>
                                <option value="20" @if(isset($user->birth_date) && $user->birth_date == '20') selected @endif >20</option>
                                <option value="21" @if(isset($user->birth_date) && $user->birth_date == '21') selected @endif >21</option>
                                <option value="22" @if(isset($user->birth_date) && $user->birth_date == '22') selected @endif >22</option>
                                <option value="23" @if(isset($user->birth_date) && $user->birth_date == '23') selected @endif >23</option>
                                <option value="24" @if(isset($user->birth_date) && $user->birth_date == '24') selected @endif >24</option>
                                <option value="25" @if(isset($user->birth_date) && $user->birth_date == '25') selected @endif >25</option>
                                <option value="26" @if(isset($user->birth_date) && $user->birth_date == '26') selected @endif >26</option>
                                <option value="27" @if(isset($user->birth_date) && $user->birth_date == '27') selected @endif >27</option>
                                <option value="28" @if(isset($user->birth_date) && $user->birth_date == '28') selected @endif >28</option>
                                <option value="29" @if(isset($user->birth_date) && $user->birth_date == '29') selected @endif >29</option>
                                <option value="30" @if(isset($user->birth_date) && $user->birth_date == '30') selected @endif >30</option>
                                <option value="31" @if(isset($user->birth_date) && $user->birth_date == '31') selected @endif >31</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <select class="form-control" name="birth_month">
                                <option>MMM</option>
                                <option value="Jan" @if(isset($user->birth_month) && $user->birth_month == 'Jan') selected @endif>Jan</option>
                                <option value="Feb" @if(isset($user->birth_month) && $user->birth_month == 'Feb') selected @endif>Feb</option>
                                <option value="Mar" @if(isset($user->birth_month) && $user->birth_month == 'Mar') selected @endif>Mar</option>
                                <option value="Apr" @if(isset($user->birth_month) && $user->birth_month == 'Apr') selected @endif>Apr</option>
                                <option value="May" @if(isset($user->birth_month) && $user->birth_month == 'May') selected @endif>May</option>
                                <option value="Jun" @if(isset($user->birth_month) && $user->birth_month == 'Jun') selected @endif>Jun</option>
                                <option value="Jul" @if(isset($user->birth_month) && $user->birth_month == 'Jul') selected @endif>Jul</option>
                                <option value="Aug" @if(isset($user->birth_month) && $user->birth_month == 'Aug') selected @endif>Aug</option>
                                <option value="Sep" @if(isset($user->birth_month) && $user->birth_month == 'Sep') selected @endif>Sep</option>
                                <option value="Oct" @if(isset($user->birth_month) && $user->birth_month == 'Oct') selected @endif>Oct</option>
                                <option value="Nov" @if(isset($user->birth_month) && $user->birth_month == 'Nov') selected @endif>Nov</option>
                                <option value="Dec" @if(isset($user->birth_month) && $user->birth_month == 'Dec') selected @endif>Dec</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <select class="form-control" name="birth_year">
                                <option>YYYY</option>
                                <option value="2010" @if(isset($user->birth_year) && $user->birth_year == '2010') selected @endif>2010</option>
                                <option value="2009" @if(isset($user->birth_year) && $user->birth_year == '2009') selected @endif>2009</option>
                                <option value="2008" @if(isset($user->birth_year) && $user->birth_year == '2008') selected @endif>2008</option>
                                <option value="2007" @if(isset($user->birth_year) && $user->birth_year == '2007') selected @endif>2007</option>
                                <option value="2006" @if(isset($user->birth_year) && $user->birth_year == '2006') selected @endif>2006</option>
                                <option value="2005" @if(isset($user->birth_year) && $user->birth_year == '2005') selected @endif>2005</option>
                                <option value="2004" @if(isset($user->birth_year) && $user->birth_year == '2004') selected @endif>2004</option>
                                <option value="2003" @if(isset($user->birth_year) && $user->birth_year == '2003') selected @endif>2003</option>
                                <option value="2002" @if(isset($user->birth_year) && $user->birth_year == '2002') selected @endif>2002</option>
                                <option value="2001" @if(isset($user->birth_year) && $user->birth_year == '2001') selected @endif>2001</option>
                                <option value="2000" @if(isset($user->birth_year) && $user->birth_year == '2000') selected @endif>2000</option>
                                <option value="1999" @if(isset($user->birth_year) && $user->birth_year == '1999') selected @endif>1999</option>
                                <option value="1998" @if(isset($user->birth_year) && $user->birth_year == '1998') selected @endif>1998</option>
                                <option value="1997" @if(isset($user->birth_year) && $user->birth_year == '1997') selected @endif>1997</option>
                                <option value="1996" @if(isset($user->birth_year) && $user->birth_year == '1996') selected @endif>1996</option>
                                <option value="1995" @if(isset($user->birth_year) && $user->birth_year == '1995') selected @endif>1995</option>
                                <option value="1994" @if(isset($user->birth_year) && $user->birth_year == '1994') selected @endif>1994</option>
                                <option value="1993" @if(isset($user->birth_year) && $user->birth_year == '1993') selected @endif>1993</option>
                                <option value="1992" @if(isset($user->birth_year) && $user->birth_year == '1992') selected @endif>1992</option>
                                <option value="1991" @if(isset($user->birth_year) && $user->birth_year == '1991') selected @endif>1991</option>
                                <option value="1990" @if(isset($user->birth_year) && $user->birth_year == '1990') selected @endif>1990</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label><strong>Anniversary date</strong></label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <select class="form-control" name="anniversary_date">
                                <option>DD</option>
                                <option value="01" @if(isset($user->anniversary_date) && $user->anniversary_date == '01') selected @endif>01</option>
                                <option value="02" @if(isset($user->anniversary_date) && $user->anniversary_date == '02') selected @endif>02</option>
                                <option value="03" @if(isset($user->anniversary_date) && $user->anniversary_date == '03') selected @endif>03</option>
                                <option value="04" @if(isset($user->anniversary_date) && $user->anniversary_date == '04') selected @endif>04</option>
                                <option value="05" @if(isset($user->anniversary_date) && $user->anniversary_date == '05') selected @endif>05</option>
                                <option value="06" @if(isset($user->anniversary_date) && $user->anniversary_date == '06') selected @endif>06</option>
                                <option value="07" @if(isset($user->anniversary_date) && $user->anniversary_date == '07') selected @endif>07</option>
                                <option value="08" @if(isset($user->anniversary_date) && $user->anniversary_date == '08') selected @endif>08</option>
                                <option value="09" @if(isset($user->anniversary_date) && $user->anniversary_date == '09') selected @endif>09</option>
                                <option value="10" @if(isset($user->anniversary_date) && $user->anniversary_date == '10') selected @endif>10</option>
                                <option value="11" @if(isset($user->anniversary_date) && $user->anniversary_date == '11') selected @endif>11</option>
                                <option value="12" @if(isset($user->anniversary_date) && $user->anniversary_date == '12') selected @endif>12</option>
                                <option value="13" @if(isset($user->anniversary_date) && $user->anniversary_date == '13') selected @endif>13</option>
                                <option value="14" @if(isset($user->anniversary_date) && $user->anniversary_date == '14') selected @endif>14</option>
                                <option value="15" @if(isset($user->anniversary_date) && $user->anniversary_date == '15') selected @endif>15</option>
                                <option value="16" @if(isset($user->anniversary_date) && $user->anniversary_date == '16') selected @endif>16</option>
                                <option value="17" @if(isset($user->anniversary_date) && $user->anniversary_date == '17') selected @endif>17</option>
                                <option value="18" @if(isset($user->anniversary_date) && $user->anniversary_date == '18') selected @endif>18</option>
                                <option value="19" @if(isset($user->anniversary_date) && $user->anniversary_date == '19') selected @endif>19</option>
                                <option value="20" @if(isset($user->anniversary_date) && $user->anniversary_date == '20') selected @endif>20</option>
                                <option value="21" @if(isset($user->anniversary_date) && $user->anniversary_date == '21') selected @endif>21</option>
                                <option value="22" @if(isset($user->anniversary_date) && $user->anniversary_date == '22') selected @endif>22</option>
                                <option value="23" @if(isset($user->anniversary_date) && $user->anniversary_date == '23') selected @endif>23</option>
                                <option value="24" @if(isset($user->anniversary_date) && $user->anniversary_date == '24') selected @endif>24</option>
                                <option value="25" @if(isset($user->anniversary_date) && $user->anniversary_date == '25') selected @endif>25</option>
                                <option value="26" @if(isset($user->anniversary_date) && $user->anniversary_date == '26') selected @endif>26</option>
                                <option value="27" @if(isset($user->anniversary_date) && $user->anniversary_date == '27') selected @endif>27</option>
                                <option value="28" @if(isset($user->anniversary_date) && $user->anniversary_date == '28') selected @endif>28</option>
                                <option value="29" @if(isset($user->anniversary_date) && $user->anniversary_date == '29') selected @endif>29</option>
                                <option value="30" @if(isset($user->anniversary_date) && $user->anniversary_date == '30') selected @endif>30</option>
                                <option value="31" @if(isset($user->anniversary_date) && $user->anniversary_date == '31') selected @endif>31</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <select class="form-control" name="anniversary_month">
                                <option>MMM</option>
                                <option value="Jan" @if(isset($user->anniversary_month) && $user->anniversary_month == 'Jan') selected @endif>Jan</option>
                                <option value="Feb" @if(isset($user->anniversary_month) && $user->anniversary_month == 'Feb') selected @endif>Feb</option>
                                <option value="Mar" @if(isset($user->anniversary_month) && $user->anniversary_month == 'Mar') selected @endif>Mar</option>
                                <option value="Apr" @if(isset($user->anniversary_month) && $user->anniversary_month == 'Apr') selected @endif>Apr</option>
                                <option value="May" @if(isset($user->anniversary_month) && $user->anniversary_month == 'May') selected @endif>May</option>
                                <option value="Jun" @if(isset($user->anniversary_month) && $user->anniversary_month == 'Jun') selected @endif>Jun</option>
                                <option value="Jul" @if(isset($user->anniversary_month) && $user->anniversary_month == 'Jul') selected @endif>Jul</option>
                                <option value="Aug" @if(isset($user->anniversary_month) && $user->anniversary_month == 'Aug') selected @endif>Aug</option>
                                <option value="Sep" @if(isset($user->anniversary_month) && $user->anniversary_month == 'Sep') selected @endif>Sep</option>
                                <option value="Oct" @if(isset($user->anniversary_month) && $user->anniversary_month == 'Oct') selected @endif>Oct</option>
                                <option value="Nov" @if(isset($user->anniversary_month) && $user->anniversary_month == 'Nov') selected @endif>Nov</option>
                                <option value="Dec" @if(isset($user->anniversary_month) && $user->anniversary_month == 'Dec') selected @endif>Dec</option>
                            </select>
                        </div>
                    </div>
            
                
                        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label><strong>Encircle ID</strong></label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="input-group mb-3">
                            <input type="text" class="form-control" name="encircle_id" value="{{$user->encircle_id}}" value="XXXXXXXX0000" disabled>
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">0 points</span>
                            </div>
                            </div>
                        </div> -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="custom-field">
                        <input type="checkbox" name="receive_newsletters" value="1" id="receive_newsletters" @if(isset($user->receive_newsletters) && $user->receive_newsletters == 1) checked @endif>
                            <label for="receive_newsletters">Receive our newsletters and special offers.</label>
                      </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="custom-field">
                        <input type="checkbox" name="get_updates" value="1" id="get_updates" @if(isset($user->get_updates) && $user->get_updates == 1) checked @endif>
                            <label for="get_updates">Get updates on <img src="{{asset('frontend/images/WhatsApp_Logo.png')}}" class="whatsAppIcon" alt=""> <span style="color:#25d366 !important;">whatsapp</span></label>
                      </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="big-black-flat-button" type="submit">Update Details</button>
                        <a href="{{route('dashboard')}}" class="big-black-flat-button">Cancel</a>
                    </div>
                </div>
                <h4 class="mb-4">Contact Details</h4>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"><p><strong>Phone Number *</strong></p></div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><p><img src="{{asset('frontend/images/india icon.png')}}" style="float: left;margin-right: 10px;width: fit-content !important;"> {{$user->phone}}</p></div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"><p><strong>Email Address *</strong></p></div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><p>{{$user->email}}</p></div>
                </div>
            </div>
        </div>
    </form>
    @endsection