@extends('frontend.layouts.app')
@section('content')

@php
$setting = App\GeneralSetting::first();
@endphp

<div class="container">
  <div class="contact-us mt-4">

    <p>Swayamvar Jewellers is a company that offers you a piece of rich Indian tradition in jewelery. Swayamvar Jewellers is one of the reputed exclusive designer jewelery showrooms in South Gujarat. For the last several years Swayamvar Jewellers has earned a reputation for quality, selection, value and service which is the foundation of long lasting relationships with customers.</p>

    <p>Swayamvar Jewellers, a complete jewellery mall located in the Ghod Dod Road, Surat, Gujarat, India has maintained its reputation as an epitome of Trust, Quality and Diversity since its very inception.The company is run by a family who believe that with every jewellery they sell, they buy a share of trust. The company has always given the highest priority to quality and to provide a great customer experience by providing an Exhaustive Range of Products, Innovations in Designs, Quick Delivery and last but not the least, a Very Competitive Pricing Policy that fits everyone's budget.</p>


    <h5><strong>OUR MISSION</h5></strong>
    <p>Our mission is to make beautiful jewellery accessible. Jewellery that not only makes a woman look beautiful but also make her feel beautiful and loved.</p>

    <h5><strong>OUR PROMISE</strong></h5>
    <strong>We started our company on three simple premises:</strong>
    <p>Our style is relentlessly modern, yet intensely respectful of traditions.</p>
    <p>We always look for better and newer ways to do things; from the designs that we make to the experiences that we deliver.</p>
    <p>We are open in our interactions with our customers. Our prices and policies are always transparent.</p>

  </div>
</div>

@endsection
