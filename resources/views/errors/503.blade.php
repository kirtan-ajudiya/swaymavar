<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

	<!--- Basic Page Needs
   ================================================== -->
   <meta charset="utf-8">
	<title>Advent</title>
   <meta name="description" content="">  
   <meta name="author" content="">

   <!-- Mobile Specific Metas
   ================================================== -->
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

   <!-- Favicons
   =================================================== -->
   <link rel="shortcut icon" href="favicon.png" >
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
    
<body>
   <!-- content-wrap -->
   <div id="content-wrap">

      <!-- main  -->
      <main class="row">

            <header class="site-header">
               <div class="logo">
               <a href="{{route('home')}}" class="brand justify-left w-inline-block w--current"> <img
                        src="{{asset('frontend/images/logo/logo.png')}}" alt="" style="width: 100%;"> </a>
               </div> 
            </header>

            <div id="main-content" class="twelve columns">

               <h1>Maintenance mode</h1>

               <p> Sorry for the inconvenience but we're performing some maintenance at the moment. we'll be back online shortly !
               </p>

               <hr>

              

            </div><!-- /main-content form -->

      </main>	      

   </div><!-- /content-wrap --> 
    	

   @php
 $setting = App\GeneralSetting::first();   
@endphp

 	<!-- footer
   =================================================== -->
   <footer class="group">         

     	<ul class="footer-social">
         <li><a href="{{$setting->facebook}}"><i class="fa fa-facebook"></i></a></li>
         <li><a href="{{$setting->linkdin}}"><i class="fa fa-linkedin"></i></a></li>
         <li><a href="{{$setting->instagram}}"><i class="fa fa-instagram"></i></a></li>
         <li><a href="{{$setting->youtube}}"><i class="fa fa-youtube"></i></a></li>
     	</ul>   
        
   </footer> 

   <div id="preloader"> 
    	<div id="loader">
     	</div>
   </div> 
        
</body>
</html>



<style>
html {
	font-family: sans-serif;
	-ms-text-size-adjust: 100%;
	-webkit-text-size-adjust: 100%;
}


html {
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	font-size: 62.5%;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}

html,
body {
	height: 100%;
}

*,
*:before,
*:after {
	box-sizing: inherit;
}

body {
	font-weight: normal;
	line-height: 1;
	text-rendering: optimizeLegibility;
}
---------------------------------------------------------------------- */
a {
	text-decoration: none;
	line-height: inherit;
}

a img {
	border: none;
}

a:focus {
	outline: none;
}

p a,
p a:visited {
	line-height: inherit;
}

.row {
	width: 94%;
	max-width: 1024px;
	margin: 0 auto;
}

.ie8 .row {
	width: 1024px;
}

.narrow .row {
	max-width: 980px;
}



html,
body {
	height: 100%;
}

html {
	background: #161415 url({{asset('frontend/images/error2.png')}}) no-repeat center center fixed;
	-webkit-background-size: cover !important;
	-moz-background-size: cover !important;
	background-size: cover !important;
}

body {
	font: 15px/30px "montserrat-regular", sans-serif;
	font-weight: normal;
	color: #575859;
}


#content-wrap {
	min-height: 100%;
	padding-top: 6%;
}

/* main
------------------------------------------ */
main.row {
	max-width: 700px;
}

main {
	text-align: center;
}

main::after {
	content: "";
	display: block;
	height: 150px;
}

main h1 {
	font: 38px/1.2em "montserrat-bold", sans-serif;
	color: #fbca08;
	margin-bottom: 12px;
	padding: 0;
}

main p {
	font: 17px/36px "montserrat-regular", sans-serif;
	color: #fff;
	margin-bottom: 18px;
	padding: 0;
}

main hr {
	border: solid #fbca08;
	border-width: 5px 0 0;
	margin: 19px auto 12px;
	height: 0;
	width: 100px;
}

main .site-header .logo {
	display: inline-block;
	vertical-align: middle;
	margin: 0 0 36px 0;
	padding: 0;
}

main .site-header .logo a {
	display: block;
	margin: 0;
	padding: 0;
	border: none;
	outline: none;
	font: 0/0 a;
	text-shadow: none;
	color: transparent;
	width: 116px;
	height: 80px;
	background: url("../images/logo/logo@2x.png") no-repeat;
	background-size: contain;
}



/* 
/* 07. =footer
/* =================================================================== */
footer {
	clear: both;
	font: 12px/24px "montserrat-regular", sans-serif;
	background: #000;
	padding: 18px 30px;
	color: #303030;
	width: 100%;
	position: fixed;
	bottom: 0;
	left: 0;
	z-index: 999992;
}

footer a,
footer a:visited {
	color: #525252;
}

footer a:hover,
footer a:focus {
	color: #fff;
}

/* copyright 
------------------------------------------ */
.footer-copyright {
	margin: 0;
	padding: 0;
	float: left;
}

.footer-copyright li {
	display: inline-block;
	margin: 0;
	padding: 0;
	line-height: 24px;
}

.footer-copyright li::before {
	content: "|";
	padding-left: 6px;
	padding-right: 10px;
	color: #2c2c2c;
}

.footer-copyright li:first-child:before {
	display: none;
}

/* social links */
.footer-social {
	font-size: 18px;
	margin: 0;
	padding: 0;
	text-shadow: 0px 1px 2px rgba(0, 0, 0, 0.8);
	float: right;
}

.footer-social li {
	display: inline-block;
	margin: 0 10px;
	padding: 0;
}

.footer-social li a {
	color: #fbca08;
}

.footer-social li a:hover {
	color: white;
}

@media only screen and (max-width:768px) {
	footer {
		padding-top: 24px;
		text-align: center;
	}

	.footer-copyright {
		float: none;
	}

	.footer-social {
		float: none;
		margin-bottom: 15px;
	}

}

@media only screen and (max-width:600px) {
	footer {
		position: static;
		padding-bottom: 30px;
	}

	.footer-copyright li {
		display: block;
		margin: 0;
		padding: 0;
		line-height: 24px;
	}

	.footer-copyright li::before {
		content: none;
	}

}

@media only screen and (max-width:400px) {
	.footer-social {
		font-size: 17px;
	}

	.footer-social li {
		margin: 0 6px;
	}

}




</style>