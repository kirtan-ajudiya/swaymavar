@extends('frontend.layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 section_teams">
            @php
                $policy = App\Policy::where('name', 'terms')->first();
            @endphp
            <p> {!! $policy->content !!}</p>
        </div>
    </div>
</div>

<style>
    .section_teams ul {
        padding: 0 25px !important;
        margin: 10px 0 !important;
    }
</style>

@endsection
