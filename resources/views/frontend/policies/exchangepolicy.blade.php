@extends('frontend.layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 section_exchenge">
            @php
                $policy = App\Policy::where('name', 'shipping_policy')->first();
            @endphp
            <p> {!! $policy->content !!}</p>
        </div>
    </div>
</div>

@endsection

<style>
    .section_exchenge ul {
        padding: 0 25px !important;
        margin: 10px 0 !important;
    }
</style>
