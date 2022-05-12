@extends('frontend.layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 section_byuback">
            @php
                $policy = App\Policy::where('name', 'buyback_policy')->first();
            @endphp
            <p> {!! $policy->content !!}</p>
        </div>
    </div>
</div>

@endsection
<style>
    .section_byuback ul {
        padding: 0 35px !important;
        margin: 10px 0 !important;
    }
</style>
