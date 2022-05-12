@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-lg-12 pull-right">
            <a href="{{ route('products.create') }}" class="btn btn-rounded btn-info pull-right">{{__('Add New Product')}}</a>
        </div>
    </div>

<br>

<div class="panel">
    <!--Panel heading-->
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{ __($type.' Products') }}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_products" action="" method="GET">
                @if($type == 'Seller')
                    <div class="box-inline pad-rgt pull-left">
                        <div class="select" style="min-width: 200px;">
                            <select class="form-control demo-select2" id="user_id" name="user_id" onchange="sort_products()">
                                <option value="">All Sellers</option>
                                @foreach (App\Seller::all() as $key => $seller)
                                    @if ($seller->user != null && $seller->user->shop != null)
                                        <option value="{{ $seller->user->id }}" @if ($seller->user->id == $seller_id) selected @endif>{{ $seller->user->shop->name }} ({{ $seller->user->name }})</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 200px;">
                        <select class="form-control demo-select2" name="type" id="type" onchange="sort_products()">
                            <option value="">Sort by</option>
                            <option value="rating,desc" @isset($col_name , $query) @if($col_name == 'rating' && $query == 'desc') selected @endif @endisset>{{__('Rating (High > Low)')}}</option>
                            <option value="rating,asc" @isset($col_name , $query) @if($col_name == 'rating' && $query == 'asc') selected @endif @endisset>{{__('Rating (Low > High)')}}</option>
                            <option value="num_of_sale,desc"@isset($col_name , $query) @if($col_name == 'num_of_sale' && $query == 'desc') selected @endif @endisset>{{__('Num of Sale (High > Low)')}}</option>
                            <option value="num_of_sale,asc"@isset($col_name , $query) @if($col_name == 'num_of_sale' && $query == 'asc') selected @endif @endisset>{{__('Num of Sale (Low > High)')}}</option>
                            <option value="unit_price,desc"@isset($col_name , $query) @if($col_name == 'unit_price' && $query == 'desc') selected @endif @endisset>{{__('Base Price (High > Low)')}}</option>
                            <option value="unit_price,asc"@isset($col_name , $query) @if($col_name == 'unit_price' && $query == 'asc') selected @endif @endisset>{{__('Base Price (Low > High)')}}</option>
                        </select>
                    </div>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type & Enter">
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="panel-body" id="thisid">
          <div class="clearfix">
            <div class="pull-left">
              <button class="btn btn-danger" type="button" onclick="delete_multi()" >
                                 {{__('Delete')}}
               </button>

            </div>
        </div>
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>#</th>
                    <th width="20%">{{__('Name')}}</th>
                    <th>{{__('Num of Sale')}}</th>
                    <th>{{__('Total Stock')}}</th>
                    <th>{{__('Base Price')}}</th> 
                    <th>{{__('Tax')}}</th> 
                    <th>{{__('Discount')}}</th>
                    <th>{{__('TotalPrice')}}</th>
                    <th>{{__('Upcomming')}}</th>
                    <th>{{__('Published')}}</th>
                    <th>{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $key => $product)
                    <tr>
                        <td>
                            <input type="checkbox" name="pro_id[]" class="pro_id" id="pro_id" value="{{$product->id}}">
                        </td>
                        <td>{{ ($key+1) + ($products->currentPage() - 1)*$products->perPage() }}</td>
                        <td>
                            <a href="{{ route('product', $product->slug) }}" target="_blank" class="media-block">
                                <div class="media-left">
                                    <img loading="lazy"  class="img-md" src="{{ asset($product->thumbnail_img)}}" alt="Image">
                                </div>
                                <div class="media-body">{{ __($product->name) }}</div>
                            </a>
                        </td>
                        @if($type == 'Seller')
                            <td>{{ $product->user->name }}</td>
                        @endif
                        <td>{{ $product->num_of_sale }} {{__('times')}}</td>
                        <td>
                            @php
                                $qty = 0;
                                if($product->variant_product){
                                    foreach ($product->stocks as $key => $stock) {
                                        $qty += $stock->qty;
                                    }
                                }
                                else{
                                    $qty = $product->current_stock;
                                }
                                echo $qty;
                            @endphp
                        </td>
                        <td>{{ $product->sub_total ?? '0' }}</td>
                        <td>{{ TotalTax($product->id) }}</td>
                        <td>{{ TotalDiscount($product->id) }}</td>
                        <td>{{ FrontTotalPrice($product->id) }}</td>
                        <!-- <td><label class="switch">
                                <input onchange="update_todays_deal(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->todays_deal == 1) echo "checked";?> >
                                <span class="slider round"></span></label></td>   -->
                        <td><label class="switch">
                                <input onchange="update_upcoming_deal(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->upcoming == 1) echo "checked";?> >
                                <span class="slider round"></span></label></td>  
                        <td><label class="switch">
                                <input onchange="update_published(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->published == 1) echo "checked";?> >
                                <span class="slider round"></span></label></td>

                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @if ($type == 'Seller')
                                        <li><a href="{{route('products.seller.edit', encrypt($product->id))}}">{{__('Edit')}}</a></li>
                                    @else
                                        <li><a href="{{route('products.admin.edit', encrypt($product->id))}}">{{__('Edit')}}</a></li>
                                    @endif
                                    <li><a onclick="confirm_modal('{{route('products.destroy', $product->id)}}');">{{__('Delete')}}</a></li>
                                    <li><a href="{{route('products.duplicate', $product->id)}}">{{__('Duplicate')}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $products->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
    <script type="text/javascript">

        $(document).ready(function(){
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

        function update_todays_deal(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.todays_deal') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Trending Deal updated successfully');
                }
                else{
                    showAlert('danger', 'Something went  ');
                }
            });
        }

        function update_upcoming_deal(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.upcoming_deal') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Upcoming Deal updated successfully');
                }
                else{
                    showAlert('danger', 'Something went  ');
                }
            });
        }

        function update_published(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Published products updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        

        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Featured products updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function sort_products(el){
            $('#sort_products').submit();
        }
       function delete_multi(){
        var nums = new Array();
            $(".pro_id:checked").each(function() {
              nums.push($(this).val());
            });
            if(nums.length > 0){
                if(confirm("Are you sure? You Want Delete This Product")){
                $.post('{{ route('products.multi_delete') }}', {_token:'{{ csrf_token() }}', pro_id:nums}, function(data){
                if(data == 1){
                    showAlert('success', 'Delete successfully');
                    $("#thisid").load(location.href + " #thisid");
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
             });
                }
            }else{
                showAlert('danger', 'Please select product');
            }
        }
        $('#select-all').click(function(event) {
          if(this.checked) {
              // Iterate each checkbox
              $('.pro_id:checkbox').each(function() {
                  this.checked = true;
              });
          } else {
              $('.pro_id:checkbox').each(function() {
                  this.checked = false;
              });
          }
      });
    </script>
@endsection
