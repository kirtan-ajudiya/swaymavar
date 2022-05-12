@extends('frontend.layouts.app')


@section('content')

@php
$slider = App\Slider::where('published', 1)->first();
@endphp
    <section class="top_banner gap_section" style="background-image: url({{ asset($slider->photo) }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12">
                    <div class="content_banner">
                        <h1>{{ $slider->text_one }}</h1>
                        <!-- <p>{{ $slider->text_two }}</p> -->
                        <a href="{{ $slider->url}}" class="btn_button01">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
        $banner = App\Banner::where('position', 1)->where('published', 1)->get();
    @endphp
    @if(count($banner) > 0)
    <section class="Next_section gap_section Banner_bottom">
        <div class="container">
            <div class="row">
                @foreach($banner as $item)
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <a href="{{ $item->url }}">
                        <div class="single-post-box">
                            <div class="post-thumb">
                                <img src="{{ asset($item->photo) }}" width="100%" alt="">
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @php
        $products = App\Product::where('upcoming', 1)->where('published', 1)->get();
    @endphp

    @if(count($products) > 0)
        <section class="owl-slider gap_section">
            <div class="container">
                <div class="title text-left">
                    <h4>new arrival</h4>
                </div>
                <div class="row">
                    <div class="col-12 text-right border_bottom"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="Arrival-slider" class="owl-carousel">
                            @foreach($products as $product)
                            <div class="post-slide">
                                <div class="card_img text-center">
                                    <a href="{{ route('product', $product->slug) }}"><img class="img-fluid" src="{{ asset($product->thumbnail_img) }}" alt="Carousel 1"></a>
                                </div>
                                <div class="c-product__price-wrapper text-center">
                                <a style="color:#000" href="{{ route('product', $product->slug) }}"><h5>{{ $product->name }}</h5></a>
                                    <div class="c-product__price margin-right-small">₹{{FrontTotalPrice($product->id ?? 0) }}</div>
                                    <!-- <div class="c-product__price is-slashed">₹1,56,005.23</div> -->
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @php
        $banner = App\Banner::where('position', 3)->where('published', 1)->get();
    @endphp
    @if(count($banner) > 0)
        <section class="banner_section gap_section blog-loop grid-blog">
            <div class="container">
                <div class="row">
                    @foreach($banner as $item)
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <a href="{{ $item->url }}">
                            <div class="single-post-box">
                                <div class="post-thumb">
                                    <img src="{{ asset($item->photo) }}" width="100%" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @php
        $products = App\Product::where('upcoming', 0)->where('published', 1)->get();
    @endphp

    @if(count($products) > 0)
        <section class="owl-slider gap_section">
            <div class="container">
                <div class="title text-left">
                    <h4>new products</h4>
                </div>
                <div class="row">
                    <div class="col-12 text-right border_bottom"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="products-slider" class="owl-carousel">
                            @foreach($products as $product)
                            <div class="post-slide">
                                <div class="card_img">
                                   <a href="{{ route('product', $product->slug) }}"> <img class="img-fluid" src="{{ asset($product->thumbnail_img) }}" alt="Carousel 1"></a>
                                </div>
                                <div class="c-product__price-wrapper text-center">
                                <a style="color:#000" href="{{ route('product', $product->slug) }}">  <h5>{{ $product->name }}</h5> </a>
                                    <div class="c-product__price margin-right-small">₹{{ FrontTotalPrice($product->id ?? 0)  }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @php
        $banner = App\Banner::where('position', 5)->where('published', 1)->first();
    @endphp
    <section class="banner_section gap_section">
        <div class="container">
            <div class="title text-center">
                <h3>deal of the day</h3>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <a href="{{ $banner->url }}">
                        <img src="{{ asset($banner->photo) }}" width="100%" alt="">
                    </a>
                    <div class="text-center">
                        <a href="" class="btn button_05">Show more <i class="fas fa-arrow-right"></i> </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="text-center content_text">
                        <h2><strong>{{ $banner->title }}</strong></h2>
                        <p style="text-align: left;">{{ $banner->description }}</p>
                        <a href="{{$banner->url1}}" class="btn button04"> Buy Now </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <a href="{{$banner->url2}}">
                        <img src="{{ asset($banner->photo1) }}" width="100%" alt="">
                    </a>
                    <div class="text-center">
                        <a href="{{$banner->url2}}" class="btn button_05">Show more <i class="fas fa-arrow-right"></i> </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        a.button_05 {
            color: #121212 !important;
            font-size: 20px;
            font-style: normal;
            font-weight: 500;
            line-height: 50px;
            letter-spacing: 0.12em;
            background-color: #ffff;
        }
        a.btn.button04 {
            background: #F2E5DD;
            color: #121212 !important;
            font-size: 15px;
            font-style: normal;
            font-weight: 500;
            letter-spacing: 0.12em;
        }
        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem !important;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
    </style>
<!--
    <section class="owl-slider gap_section">
        <div class="container">
            <div class="title text-left">
                <h4>best seller</h4>
            </div>
            <div class="row">
                <div class="col-12 text-right border_bottom"></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="Seller-slider" class="owl-carousel">
                        <div class="post-slide">
                            <div class="card_img">
                                <img class="img-fluid" src="./img/slider-01.svg" alt="Carousel 1">
                            </div>
                            <div class="c-product__price-wrapper text-center">
                                <h5>lakshmi Gold coin</h5>
                                <div class="c-product__price margin-right-small">₹6,005.23</div>
                            </div>
                        </div>
                        <div class="post-slide">
                            <div class="card_img">
                                <img class="img-fluid" src="./img/slider-02.svg" alt="Carousel 1">
                            </div>
                            <div class="c-product__price-wrapper text-center">
                                <h5>Kasu Pendant</h5>
                                <div class="c-product__price margin-right-small">₹26,005.00</div>
                            </div>
                        </div>
                        <div class="post-slide">
                            <div class="card_img">
                                <img class="img-fluid" src="./img/slider-03.svg" alt="Carousel 1">
                            </div>
                            <div class="c-product__price-wrapper text-center">
                                <h5>Diamond Gold set</h5>
                                <div class="c-product__price margin-right-small">₹55,005.02</div>
                            </div>
                        </div>
                        <div class="post-slide">
                            <div class="card_img">
                                <img class="img-fluid" src="./img/slider-04.svg" alt="Carousel 1">
                            </div>
                            <div class="c-product__price-wrapper text-center">
                                <h5>Weeding Rings</h5>
                                <div class="c-product__price margin-right-small">₹5,736.00</div>
                            </div>
                        </div>
                        <div class="post-slide">
                            <div class="card_img">
                                <img class="img-fluid" src="./img/slider-05.svg" alt="Carousel 1">
                            </div>
                            <div class="c-product__price-wrapper text-center">
                                <h5>Rose Diamond</h5>
                                <div class="c-product__price margin-right-small">₹50,915.00</div>
                            </div>
                        </div>
                        <div class="post-slide">
                            <div class="card_img">
                                <img class="img-fluid" src="./img/slider-01.svg" alt="Carousel 1">
                            </div>
                            <div class="c-product__price-wrapper text-center">
                                <h5>lakshmi Gold coin</h5>
                                <div class="c-product__price margin-right-small">₹6,005.23</div>
                            </div>
                        </div>
                        <div class="post-slide">
                            <div class="card_img">
                                <img class="img-fluid" src="./img/slider-02.svg" alt="Carousel 1">
                            </div>
                            <div class="c-product__price-wrapper text-center">
                                <h5>Kasu Pendant</h5>
                                <div class="c-product__price margin-right-small">₹26,005.00</div>
                            </div>
                        </div>
                        <div class="post-slide">
                            <div class="card_img">
                                <img class="img-fluid" src="./img/slider-03.svg" alt="Carousel 1">
                            </div>
                            <div class="c-product__price-wrapper text-center">
                                <h5>Diamond Gold set</h5>
                                <div class="c-product__price margin-right-small">₹55,005.02</div>
                            </div>
                        </div>
                        <div class="post-slide">
                            <div class="card_img">
                                <img class="img-fluid" src="./img/slider-04.svg" alt="Carousel 1">
                            </div>
                            <div class="c-product__price-wrapper text-center">
                                <h5>Weeding Rings</h5>
                                <div class="c-product__price margin-right-small">₹5,736.00</div>
                            </div>
                        </div>
                        <div class="post-slide">
                            <div class="card_img">
                                <img class="img-fluid" src="./img/slider-05.svg" alt="Carousel 1">
                            </div>
                            <div class="c-product__price-wrapper text-center">
                                <h5>Rose Diamond</h5>
                                <div class="c-product__price margin-right-small">₹50,915.00</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

@endsection
