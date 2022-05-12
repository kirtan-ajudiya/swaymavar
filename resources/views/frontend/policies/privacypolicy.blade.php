@extends('frontend.layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 section_privacypolicy">
            @php
                $policy = App\Policy::where('name', 'privacy_policy')->first();
            @endphp
            <p> {!! $policy->content !!}</p>
        </div>
    </div>
</div>

@endsection

<style>
    .section_privacypolicy ul {
        padding: 0 25px !important;
        margin: 10px 0 !important;
    }
</style>
