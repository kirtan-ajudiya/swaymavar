@extends('frontend.layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 section_retumpolicy">
            @php
                $policy = App\Policy::where('name', 'return_policy')->first();
            @endphp
            <p> {!! $policy->content !!}</p>
        </div>
    </div>
</div>

@endsection

<style>
    .section_retumpolicy ul {
        padding: 0 25px !important;
        margin: 10px 0 !important;
    }
</style>
