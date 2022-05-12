@extends('frontend.dashboard.inc.sidebar')
    @section('navbar')
        <section>
            <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="">My Account</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                    </ol>
                </div>
                </div>
            </div>
            </div>
        </section>
    @endsection
    @section('dashboard.content')
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="p-2">
                    <h2 class="h2 text-left">Wishlist</h2>
                    <p>This is your account wishlist. You can review or share a wishlist and also create new ones.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="p-2 text-right">
                    <a href="#" data-toggle="modal" data-target="#create_wishlist_modal" class="big-black-flat-button">Create New Wishlist</a>
                </div>
            </div>
        </div>
        <hr>
        @if(isset($wishlists) && $wishlists != "[]")

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="mb-3 mt-3">
                    <div class="form-group">
                        <select class="form-control" onChange="WhishList();" name="whishlist" id="whishlist">
                            @if(isset($wishlists))
                                @foreach($wishlists as $wishlist)
                                    <option value="{{$wishlist->id}}">{{$wishlist->name}} <span id="count"></span></option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
                <div class="mb-3 mt-3 wishlist-links">
                    <a href="javascript:void(0)" onClick="GetName();">Rename</a>
                    <a href="javascript:void(0)" onClick="GetShare();">Share</a>
                    <a href="#" data-toggle="modal" data-target="#delete_modal">Delete</a>
                </div>
            </div>
            <div id="all_product"></div>

            </div>
        </div>
        @else
            <h2> No Product Found </h2>
        @endif

        <div class="modal fade" id="rename_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-title text-center">
                            <h2 class="text-uppercase"><strong>Rename your wishlist</strong></h2>
                        </div>
                        <form action="{{route('wishlist.rename.store')}}" method="POST">
                            @csrf
                            <div class="d-flex flex-column">
                                <p class="text-center"><strong>You can rename your wishlist below</strong></p>
                                <label><strong>Wishlist Name <span>*</span></strong></label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="wishlist_name" id="wishlist_name" placeholder="Enter Wishlist Name">
                                    <input type="hidden" name="wishlist_id" id="wishlist_id" />
                                </div>
                                @error('wishlist_name')
                                    <strong style="color: red">{{ $message }}</strong>
                                @enderror
                                <button type="submit" class="black-flat-button">Rename wishlist</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="share_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width: 800px;">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-title text-center">
                            <h2 class="text-uppercase"><strong>Share your wishlist</strong></h2>
                        </div>
                        <form action="{{route('whishlist.share')}}" method="POST">
                            @csrf
                        <div class="d-flex flex-column">
                            <p class="text-center"><strong>You can share your wishlist by entering a friend's or family member's email address below - you can separate multiple recipients with a semicolon (;) for example: info@store.xxx; wcs@store.xxx</strong></p>
                            <label><strong>Email address <span>*</span></strong></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="Enter Email address">
                            </div>
                            <label><strong>Additional Message</strong></label>
                            <div class="form-group">
                                <textarea class="form-control" name="message" maxlength="250" style="height: 80px;"></textarea>
                                <p><strong>You have 250 characters left out of 250.</strong></p>
                            </div>
                            <input type="hidden" name="wishlist_slug"  id="wishlist_slug" />

                            <button type="submit" class="black-flat-button">Share wishlist</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-title text-center">
                            <h2 class="text-uppercase"><strong>Delete your wishlist</strong></h2>
                            <input type="hidden" name="wishlist_id" id="wishlist_delete_id" />

                        </div>
                        <div class="d-flex flex-column">
                            <p class="text-center"><strong>Are you sure you want to delete this wishlist with name "Wishlist Name" ?</strong></p>
                            <div style="margin-top: 1rem;margin-bottom: 1rem;border: 0;border-top: 1px solid rgba(0,0,0,.1);"></div>
                            <button onClick="DeleteWishlist();" class="black-flat-button">Delete wishlist</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="create_wishlist_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-title text-center">
                            <h2 class="text-uppercase"><strong>Create a New Wishlist</strong></h2>
                        </div>
                        <form action="{{route('wishlists.new')}}"  method="POST">
                            @csrf
                            <div class="d-flex flex-column">
                                <p class="text-center"><strong>Please give a name to your new wishlist</strong></p>
                                <label><strong>Wishlist Name <span>*</span></strong></label>
                                <div class="form-group">
                                    <input type="text" name="wishlist_name" class="form-control" placeholder="Enter Wishlist Name">
                                </div>
                                <button type="submit" class="black-flat-button">Create wishlist</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endsection

@section('script')
    <script>
        $( document ).ready(function() {
            WhishList();
        });
        function GetName(){
            var id = $('#whishlist').val();
            $.post('{{ route('wishlists.rename') }}',
                {_token:'{{ csrf_token() }}',
                id:id, 
                num:1
                }, function(data){
                if(data.status == true && data.type == 1){
                    $("#rename_modal").modal('show');
                    $("#wishlist_name").val(data.name);
                    $("#wishlist_id").val(data.id);
                }
            });
        }

        function GetShare(){
            var id = $('#whishlist').val();
            $.post('{{ route('wishlists.rename') }}',
                {_token:'{{ csrf_token() }}',
                id:id, 
                num:0
                }, function(data){
                if(data.status == true && data.type == 2){
                    $("#share_modal").modal('show');
                    $("#wishlist_slug").val(data.slug);
                }
            });
        }

        function DeleteWishlist(){
            var id = $('#whishlist').val();
            $.post('{{ route('wishlists.remove') }}',
                {_token:'{{ csrf_token() }}',
                id:id, 
                }, function(data){
                if(data.status == true ){
                    showFrontendAlert('success', 'Wishlist has been Deleted successfully!');
                    location.reload();
                }else{
                    showFrontendAlert('warning', 'Somthing Wrong!');
                }
            });
        }

        function WhishList(){
            var id = $('#whishlist').val();
            $.post('{{ route('wishlists.data') }}',
                {_token:'{{ csrf_token() }}',
                id:id, 
                }, function(data){
                if(data.status == true ){
                    $("#count").html(data.count);
                    $('#all_product').html(data.html);
                }
            });
        }
      </script>
@endsection