@php
$setting = App\GeneralSetting::first();
@endphp


<div class="collapse" id="searchform">
   <div class="gold-rate-panel">
     <div class="container">
       <div class="row">
       <form action="{{ route('search') }}" method="GET" style="width: 100%;">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <div class="search_form1">
                   <input type="text" name="q" id="search"  placeholder="search" class="text-capitalize" />
                   <button type="submit" class="vertical_middle"><i class="fa fa-search"></i></button>
             </div>
           </div>
            <!-- <div id="search-content"></div> -->
         </form>
       </div>
     </div>
   </div>
 </div>


<style media="screen">
    .gold-rate-panel {
      background-color: #262f40;
      padding: 20px;
    }
    .search_form1 input[type="text"] {
        border: 1px solid #aaa;
        padding: 13.5px 60px 13.5px 13.5px;
        width: 100%;
        background-color: #ffffff;
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        -ms-border-radius: 6px;
        border-radius: 6px;
        line-height: 0;
    }
    .text-capitalize {
        text-transform: capitalize!important;
    }

    .search_form1 button:before {
        content: '';
        width: 1px;
        height: 35px;
        background: #aaa;
        position: absolute;
        left: -20px;
        top: -8px;
    }

    .search_form1 button {
        background: transparent;
        padding: 0;
        border: 0;
        left: inherit;
        right: 30px;
    }
    .vertical_middle {
        bottom: auto;
        left: 0;
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        -webkit-transform: translateY(-50%);
        -moz-transform: translateY(-50%);
    }

</style>




<section class="top-section gap_section d-lg-block d-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="Login top-header">
                    <ul>
                        @if(Auth::check())
                          <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                        @else
                          <li><a href="{{route('user.login')}}">Login / Register</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="text-center logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('frontend/img/min-header-logo.png') }}" alt="" >
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="header-icon top-header">
                    <ul>
                      <li>
                        <a class="" data-toggle="collapse" href="#searchform" role="button" aria-expanded="false" aria-controls="collapseExample">
                          <i class="fas fa-search"></i>
                        </a>
                      </li>
                        <!-- <li><a href=""><i class="fas fa-search"></i></a></li> -->
                        <!-- <li><button class="openBtn" onclick="openSearch()"><i class="fa fa-search"></i></button></li> -->
                        @php
                            $cart_count = 0;
                            if(Session::has('cart')){
                                $cart_count= count(Session::get('cart'));
                            }
                        @endphp
                        <li id="shopping_bag">
                          <a href="{{ route('cart') }}"><i class="fas fa-shopping-bag"></i></a>
                          <span class="badgesc badge-dark" >{{$cart_count}}</span>
                        </li>
                        <!-- <li><a href=""><i class="fas fa-heart"></i></a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <div id="myOverlay" class="overlay">
  <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
  <div class="overlay-content">
    <form id="wf-form-Search" name="wf-form-Search" data-name="Search" method="get" action="{{route('search')}}">
        <input type="text" name="q" id="search" placeholder="Search here">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div> -->

<section class="top-section d-lg-none d-block bg-color">
    <div class="container">
        <div class="mobile-top-header">
            <div class="Login-top">
                <ul>
                    @if(Auth::check())
                      <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                    @else
                      <li><a href="{{route('user.login')}}">Login/Register</a></li>
                    @endif
                </ul>
            </div>


            <div class="header-icon">
                <ul>

                    <li><a href=""><i class="fas fa-search"></i></a></li>
                    @php
                        $cart_count = 0;
                        if(Session::has('cart')){
                            $cart_count= count(Session::get('cart'));
                        }
                    @endphp
                    <li><a href="{{ route('cart') }}"><i class="fas fa-shopping-bag"></i></a>  <span class="badgesc badge-dark" >{{$cart_count}}</span></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<header class="header" id="myHeader">
    <div class="container">
        <div class="wrapper">
            <div class="header-item-left">
                <a class="header-logo" href="{{ route('home') }}">
                    <img src="{{ asset('frontend/img/header-logo.png') }}" alt="header-logo">
                </a>
            </div>
            <div class="header-item-center">
                <div class="overlay"></div>
                <nav class="menu">
                    <div class="menu-mobile-header">
                        <button type="button" class="menu-mobile-arrow"><i class="fas fa-arrow-left"></i></button>
                        <div class="menu-mobile-title"></div>
                        <button type="button" class="menu-mobile-close"><i class="fas fa-times"></i></button>
                    </div>
                    <ul class="menu-section">
                        <li><a href="{{ route('products') }}">all jewellery</a></li>
                        <li><a href="{{ route('products.type', 'gold-jewellery') }}" @if(isset($_GET['type']) && $_GET['type'] == 'gold-jewellery') style="font-weight: 800;" @endif>gold</a></li>

                        <li><a href="{{ route('products') }}">earrings</a></li>
                        <li><a href="{{ route('products') }}">fingering</a></li>
                        <li><a href="{{ route('products') }}">bangles-bracelets</a></li>
                        <li><a href="{{ route('abouts') }}">about us</a></li>
                        <li><a href="{{ route('contactus') }}">contact us</a></li>
                        @php
                            $cart_count = 0;
                            if(Session::has('cart')){
                                $cart_count= count(Session::get('cart'));
                            }
                        @endphp
                        <li class="cart_icon d-lg-block d-none" id="shopping_bag_1"><a href="{{ route('cart') }}"><i class="fas fa-shopping-bag"></i></a> <span class="badgesc badge-dark" >{{$cart_count}}</span></li>
                    </ul>
                </nav>
            </div>
            <div class="header-item-right d-lg-none d-block">
                <button type="button" class="menu-mobile-trigger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </div>
</header>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-title text-center">
                        <h4>Login</h4>
                    </div>
                    <div class="alert alert-danger text-center" id="errors"> </div>
                    <div class="alert alert-success text-center" id="success"> </div>

                    <div class="d-flex flex-column text-center">
                        <form action="{{route('cart.login.submit')}}" method="POST">
                          @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your email address...">
                            <strong><span class="text-danger" id="phones_error"></span></strong>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Your password...">
                            <strong><span class="text-danger" id="password_error"></span></strong>
                        </div>
                        <button type="button" id="password_login" class="btn btn-base-1 btn-block fw-600">{{  __('Login') }}</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                <div class="signup-section">Not a member yet? <a href="{{route('user.registration')}}" class="text-info"> Sign Up</a>.</div>
                </div>
            </div>
        </div>
    </div>

<style>
    .badges {
    display: inline-block;
    padding: .25em .4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25rem;
    margin-left: -10px;
}
.badgesc {
    display: inline-block;
    padding: .25em .4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25rem;
}
</style>


<script type="text/javascript">
function openSearch() {
document.getElementById("myOverlay").style.display = "block";
}

function closeSearch() {
document.getElementById("myOverlay").style.display = "none";
}

</script>

<script type="text/javascript">
  $(document).ready(function(){
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
        $('#errors').hide();
        $('#success').hide();


        $('#password_login').on('click', function() {
        var phone = $('#email').val();
        var password = $('#password').val();
        $('#password_error').html('');
        $('#phones_error').html('');
        if(phone!=="" && password!=="" ){
            let phoneNo = '';
            var phonemain="+91"+phone;
            var password = $('#password').val();
            $.post('{{ route('login_with_password.submit') }}', { _token:'{{ csrf_token() }}',phone: phone, password:password}, function(data){
                if(data.status === true){
                  $('#success').show();
                  $('#success').html("Login Successfful.");
                  location.reload();
                }else{
                  $('#errors').show();
                  $('#errors').html("Plese enter valid credentials.");
                  //location.reload();
                }
            });
        }else{
            if(phone===""){
                $('#phones_error').html('Please enter email');
            }
            if(password===""){
                $('#password_error').html('Please enter password.');
            }

        }
    })

  })


</script>
