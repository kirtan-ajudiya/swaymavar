@extends('frontend.layouts.app')

@section('content')

@php 
    $banner = App\Banner::where('position', 7)->where('published', 1)->first();
@endphp

    <main>
    <form class="" id="search-form" action="" method="POST">
    <input type="hidden" name="type" value="@if(isset($_GET['type'] )){{$_GET['type']}}@else{{null}}@endif"/>
    <input type="hidden" name="category" value="@if(isset($_GET['category'] )){{$_GET['category']}}@else{{null}}@endif"/>
    <input type="hidden" name="q" value="@if(isset($_GET['q'] )){{$_GET['q']}}@else{{null}}@endif"/>

        <section class="gap_section">
            <div class="container" id="all_product">
             
            </div>
            <div class="text-center" >
                <p id="total_product"></p>
            </div>
            <!-- <div class="text-center"  id="hide"> -->
            <!-- <input type="hidden" name="page" value="1" id="page" /> -->
                <!-- <a href="javascript:void(0)" id="load-more" class="black-flat-button">Load More</a> -->
            <!-- </div> -->
        </section>
    </form>
    </main>

@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script> 
    $( document ).ready(function() {
        lode_more();
    });


    function lode_more(){
        var formData = $('#search-form').serialize();
        $.ajax({
            type: 'GET',
            url:  "{{ route('more.product') }}",
            data: formData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function (data) {
                $('#all_product').html(data.html);
                // if(data.page_flag == true){
                //     $('#hide').hide();
                // }else{
                //     $('#hide').show();
                // }
                $('#total_product').html(data.product_string);
            },
            error: function (xhr, type) {
                console.log(type)
            }
        });
    }

    function filter(sort){
        $('#sort').val(sort);
        lode_more();
    }

    // $("#load-more").on("click", function(){
    //     var page =  $('#page').val();
    //     page = parseInt(page) + 1;
    //     $('#page').val(page);
    //     lode_more();
    // })

</script>

@endsection