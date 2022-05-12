@extends('layouts.app')

@section('content')

<div class="row">
	<form class="form form-horizontal mar-top" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
		@csrf
		<input type="hidden" name="added_by" value="admin">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">{{__('Product Information')}}</h3>
			</div>
			<div class="panel-body">
				<div class="tab-base tab-stacked-left">
				    <!--Nav tabs-->
				    <ul class="nav nav-tabs">
				        <li class="active">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-1" aria-expanded="true">{{__('General')}}</a>
				        </li>
				        <li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-2" aria-expanded="false">{{__('Images')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-3" aria-expanded="false">{{__('Videos')}}</a>
				        </li>
				        <li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-4" aria-expanded="false">{{__('Meta Tags')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-5" aria-expanded="false">{{__('Customer Choice')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-6" aria-expanded="false">{{__('Price')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-7" aria-expanded="false">{{__('Description')}}</a>
				        </li>
						{{-- <li class="">
						<a data-toggle="tab" href="#demo-stk-lft-tab-8" aria-expanded="false">{{__('Display Settings')}}</a>
				        </li> --}}
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-9" aria-expanded="false">{{__('Shipping Info')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-10" aria-expanded="false">{{__('PDF Specification')}}</a>
				        </li>
				    </ul>

				    <!--Tabs Content-->
				    <div class="tab-content">
				        <div id="demo-stk-lft-tab-1" class="tab-pane fade active in">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Product Name')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="name" placeholder="{{__('Product Name')}}" onchange="update_sku()" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('SKU Code')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="sku_code" placeholder="{{__('SKU Code')}}" >
								</div>
							</div>
							<div class="form-group" id="category">
								<label class="col-lg-2 control-label">{{__('Category')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="category_id" id="category_id" required>
										@foreach($categories as $category)
											<option value="{{$category->id}}">{{__($category->name)}}</option>
										@endforeach
									</select>
								</div>
							</div>
							 <div class="form-group" id="subcategory">
								<label class="col-lg-2 control-label">{{__('Subcategory')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="subcategory_id" id="subcategory_id" >

									</select>
								</div>
							</div> 

							<!-- <div class="form-group" >
								<label class="col-lg-2 control-label">{{__('Fabric')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="fabric_id"  required>
										@foreach(App\Fabric::all() as $category)
											<option value="{{$category->id}}">{{__($category->name)}}</option>
										@endforeach
									</select>
								</div>
							</div> -->
							<!-- <div class="form-group" >
								<label class="col-lg-2 control-label">{{__('Occasion')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="occasion_id"  required>
										@foreach(App\Occasion::all() as $category)
											<option value="{{$category->id}}">{{__($category->name)}}</option>
										@endforeach
									</select>
								</div>
							</div> -->
							{{-- <div class="form-group" id="brand">
								<label class="col-lg-2 control-label">{{__('Brand')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="brand_id" id="brand_id">
										<option value="">{{ ('Select Brand') }}</option>
										@foreach (\App\Brand::all() as $brand)
											<option value="{{ $brand->id }}">{{ $brand->name }}</option>
										@endforeach
									</select>
								</div>
							</div> --}}
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Unit')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="unit" placeholder="Unit (e.g. KG, Pc etc)" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Tags')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="tags[]" placeholder="Type to add a tag" data-role="tagsinput">
								</div>
							</div>
							@php
							    $pos_addon = \App\Addon::where('unique_identifier', 'pos_system')->first();
							@endphp
							@if ($pos_addon != null && $pos_addon->activated == 1)
								<div class="form-group">
									<label class="col-lg-2 control-label">{{__('Barcode')}}</label>
									<div class="col-lg-7">
										<input type="text" class="form-control" name="barcode" placeholder="{{ ('Barcode') }}">
									</div>
								</div>
							@endif

							<!-- @php
							    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
							@endphp
							@if ($refund_request_addon != null && $refund_request_addon->activated == 1)
								<div class="form-group">
									<label class="col-lg-2 control-label">{{__('Refundable')}}</label>
									<div class="col-lg-7">
										<label class="switch" style="margin-top:5px;">
											<input type="checkbox" name="refundable" checked>
				                            <span class="slider round"></span></label>
										</label>
									</div>
								</div>
							@endif -->
				        </div>
				        <div id="demo-stk-lft-tab-2" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Main Images')}} </label>
								<div class="col-lg-7">
									<div id="photos">

									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Thumbnail Image')}} <small>(290x300)</small></label>
								<div class="col-lg-7">
									<div id="thumbnail_img">

									</div>
								</div>
							</div>
							<!-- <div class="form-group">
								<label class="col-lg-2 control-label">{{__('Featured')}} <small>(290x300)</small></label>
								<div class="col-lg-7">
									<div id="featured_img">

									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Flash Deal')}} <small>(290x300)</small></label>
								<div class="col-lg-7">
									<div id="flash_deal_img">

									</div>
								</div>
							</div> -->
				        </div>
				        <div id="demo-stk-lft-tab-3" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Video Provider')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="video_provider" id="video_provider">
										<option value="youtube">{{__('Youtube')}}</option>
										<option value="dailymotion">{{__('Dailymotion')}}</option>
										<option value="vimeo">{{__('Vimeo')}}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Video Link')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="video_link" placeholder="{{__('Video Link')}}">
								</div>
							</div>
				        </div>
						<div id="demo-stk-lft-tab-4" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Meta Title')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="meta_title" placeholder="{{__('Meta Title')}}">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Description')}}</label>
								<div class="col-lg-7">
									<textarea name="meta_description" rows="8" class="form-control"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{ __('Meta Image') }}</label>
								<div class="col-lg-7">
									<div id="meta_photo">

									</div>
								</div>
							</div>
				        </div>
						<div id="demo-stk-lft-tab-5" class="tab-pane fade">
							<div class="form-group">
								<div class="col-lg-2">
									<input type="text" class="form-control" value="{{__('Colors')}}" disabled>
								</div>
								<div class="col-lg-7">
									<select class="form-control color-var-select" name="colors[]" id="colors" multiple disabled>
										@foreach (\App\Color::orderBy('name', 'asc')->get() as $key => $color)
											<option value="{{ $color->code }}">{{ $color->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-lg-2">
									<label class="switch" style="margin-top:5px;">
										<input value="1" type="checkbox" name="colors_active">
										<span class="slider round"></span>
									</label>
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-2">
									<input type="text" class="form-control" value="{{__('Attributes')}}" disabled>
								</div>
			                    <div class="col-lg-7">
			                        <select name="choice_attributes[]" id="choice_attributes" class="form-control demo-select2" multiple data-placeholder="Choose Attributes">
										@foreach (\App\Attribute::all() as $key => $attribute)
											<option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
										@endforeach
			                        </select>
			                    </div>
			                </div>

							<div>
								<p>Choose the attributes of this product and then input values of each attribute</p>
								<br>
							</div>

							<div class="customer_choice_options" id="customer_choice_options">

							</div>

							{{-- <div class="customer_choice_options" id="customer_choice_options">

							</div>
							<div class="form-group">
								<div class="col-lg-2">
									<button type="button" class="btn btn-info" onclick="add_more_customer_choice_option()">{{ __('Add more customer choice option') }}</button>
								</div>
							</div> --}}
				        </div>
						<div id="demo-stk-lft-tab-6" class="tab-pane fade">
							<div class="row" style="margin-left: 30px;">
								<div class="col-lg-4">
									<div class="form-group">
										<label class="col-lg-3 control-label">{{__('Metal Type')}}</label>
										<div class="col-lg-6">
											<select class="form-control demo-select2-placeholder metal" name="metal_type" id="metaltype" onchange="MetalType();">
												@foreach(App\MetalType::where('status', 1)->get() as $metal_type)
													<option value="{{$metal_type->id}}">{{$metal_type->name}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label class="col-lg-3 control-label">{{__('Carat Type')}}</label>
										<div class="col-lg-6">
											<select class="form-control demo-select2-placeholder metal" name="carat_type" id="carattype" onchange="MetalPrice();">
												
											</select>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label class="col-lg-3 control-label">{{__('Metal Color')}}</label>
										<div class="col-lg-6">
											<select class="form-control demo-select2-placeholder metal" name="metal_color">
												@foreach(App\MetalColor::where('status', 1)->get() as $metal_color)
													<option value="{{$metal_color->id}}">{{$metal_color->color}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Gender')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="gender">
											<option value="0"> Men </option>
											<option value="1"> Women </option>
											<option value="2"> Kids </option>
											<option value="3"> Pair </option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Jewellary Type')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="jewellery_type">
										@foreach(App\JewelleryType::where('status', 1)->get() as $jewellery_type)
											<option value="{{$jewellery_type->id}}">{{ $jewellery_type->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Weight')}}</label>
								<div class="col-lg-7">
									<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Weight')}}" onkeyup="MtalWeight()" name="metal_weight" id="metal_weight" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Metal Rate')}}</label>
								<div class="col-lg-7">
									<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Metal Rate')}}"  name="metal_rate" id="metal_rate" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Select Diamond')}}</label>
								<div class="row" id="diamond_type" style="margin-left: 30px;">
									<div class="col-lg-7">
										<div class="col-lg-4">
											<div class="form-check control-label">
													<input type="checkbox" class="form-check-input"  id="diamond_1" name="single_diamond" value="1" >
													<label class="form-check-label" for="diamond_1">Diamond</label>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-check control-label">
													<input type="checkbox" class="form-check-input " id="diamond_2" name="choki_diamond" value="1" >
													<label class="form-check-label" for="diamond_2">Choki Diamond</label>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-check control-label">
													<input type="checkbox" class="form-check-input " id="diamond_3" name="solited_diamond" value="1" >
													<label class="form-check-label" for="diamond_3">Solited Diamond</label>
											</div>
										</div>
									</div>
								</div>
								<div id="diamond_1_diamond">
									<div class="row"  style="margin-left: 30px;">
										<div class="col-lg-4">
											<div class="form-group">
												<label class="col-lg-5 control-label">{{__('Diamond pieces')}}</label>
												<div class="col-lg-6">
														<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Diamond pieces')}}"  name="diamond_pieces" class="form-control" >
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="col-lg-5 control-label">{{__('Diamond Weigth')}}</label>
												<div class="col-lg-6">
														<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Diamond Weight')}}"  name="diamond_weight" class="form-control" >
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="col-lg-5 control-label">{{__('Diamond price')}}</label>
												<div class="col-lg-6">
														<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Diamond price')}}"  name="diamond_price" class="form-control" >
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label class="col-lg-2 control-label">{{__('Diamond Quality')}}</label>
											<div class="col-lg-7">
												<input type="text" placeholder="{{__('ex. FG-VS')}}" name="diamond_quality" class="form-control" >
											</div>
										</div>
									</div>
								</div>
								<div  id="diamond_2_diamond" >
									<div class="row" style="margin-left: 30px;">
										<div class="col-lg-4">
											<div class="form-group">
												<label class="col-lg-6 control-label">{{__('Choki Diamond pieces')}}</label>
												<div class="col-lg-6">
														<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Diamond pieces')}}"  name="choki_diamond_pieces" class="form-control" >
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="col-lg-6 control-label">{{__('Choki Diamond Weigth')}}</label>
												<div class="col-lg-6">
														<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Diamond Weight')}}"  name="choki_diamond_weight" class="form-control" >
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="col-lg-6 control-label">{{__('Choki Diamond price')}}</label>
												<div class="col-lg-6">
														<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Diamond price')}}"  name="choki_diamond_quality" class="form-control" >
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label class="col-lg-2 control-label">{{__('Diamond Quality')}}</label>
											<div class="col-lg-7">
												<input type="text" placeholder="{{__('ex. FG-VS')}}" name="choki_diamond_quality" class="form-control" >
											</div>
										</div>
									</div>
								</div>

								<div id="diamond_3_diamond">
									<div class="row"  style="margin-left: 30px;">
										<div class="col-lg-4">
											<div class="form-group">
												<label class="col-lg-6 control-label">{{__('Solited Diamond pieces')}}</label>
												<div class="col-lg-6">
														<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Diamond pieces')}}"  name="solited_diamond_pieces" class="form-control" >
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="col-lg-6 control-label">{{__('Solited Diamond Weight')}}</label>
												<div class="col-lg-6">
														<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Diamond Weight')}}"  name="solited_diamond_weight" class="form-control" >
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="col-lg-6 control-label">{{__('Solited Diamond price')}}</label>
												<div class="col-lg-6">
														<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Diamond price')}}"  name="solited_diamond_price" class="form-control" >
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label class="col-lg-2 control-label">{{__('Diamond Quality')}}</label>
											<div class="col-lg-7">
												<input type="text" placeholder="{{__('ex. FG-VS')}}" name="solited_diamond_quality" class="form-control" >
											</div>
										</div>
									</div>
								</div>
							</div>
			
				
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Purchase price')}}</label>
								<div class="col-lg-7">
									<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Purchase price')}}" name="purchase_price" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('GST Tax')}}</label>
								<div class="col-lg-7">
									<input type="number" min="0" value="0" step="0.01" onkeyup="subTotal()" placeholder="{{__('Tax')}}" name="tax" id="tax" class="form-control" required>
								</div>
								<div class="col-lg-1">
									<select class="demo-select2" id="tax_type" name="tax_type" onchange="subTotal()">
										<option value="amount">Rs</option>
										<option value="percent">%</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Discount')}}</label>
								<div class="col-lg-7">
									<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Discount')}}" name="discount" class="form-control" required>
								</div>
								<div class="col-lg-1">
									<select class="demo-select2" name="discount_type">
										<option value="amount">Rs</option>
										<!-- <option value="percent">%</option> -->
									</select>
								</div>
							</div>
							<div class="form-group" id="quantity">
								<label class="col-lg-2 control-label">{{__('Quantity')}}</label>
								<div class="col-lg-7">
									<input type="number" min="0" value="0" step="1" placeholder="{{__('Quantity')}}" name="current_stock" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Labour Charge')}}</label>
	                            <div class="col-lg-7">
	                                <input type="text" placeholder="{{__('Labour Charge')}}"  name="labor_charge"  class="form-control" >
	                            </div>
	                        </div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Sub Total')}}</label>
								<div class="col-lg-7">
									<input type="number" min="0" value="0" step="0.01" onkeyup="subTotal()" id="sub_total" placeholder="{{__('Sub Total')}}" name="sub_total" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('MRP')}}</label>
								<div class="col-lg-7">
									<input type="number" min="0" value="0" step="0.01" readonly  id="unit_price" placeholder="{{__('MRP')}}" name="unit_price" class="form-control" required>
								</div>
							</div>
							<br>
							<div class="sku_combination" id="sku_combination">

							</div>
				        </div>
						<div id="demo-stk-lft-tab-7" class="tab-pane fade">
							<div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Short Description')}}</label>
	                            <div class="col-lg-9">
	                                <textarea  class="form-control" name="short_description"></textarea>
	                            </div>
	                        </div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Description')}}</label>
								<div class="col-lg-9">
									<textarea class="editor" name="description"></textarea>
								</div>
							</div>
				        </div>
						{{-- <div id="demo-stk-lft-tab-8" class="tab-pane fade">
				        </div> --}}
						<div id="demo-stk-lft-tab-9" class="tab-pane fade">
							<div class="row bord-btm">
								<div class="col-md-2">
									<div class="panel-heading">
										<h3 class="panel-title">{{__('Free Shipping')}}</h3>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group">
										<label class="col-lg-2 control-label">{{__('Status')}}</label>
										<div class="col-lg-7">
											<label class="switch" style="margin-top:5px;">
												<input type="radio" name="shipping_type" value="free" checked>
												<span class="slider round"></span>
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<div class="panel-heading">
										<h3 class="panel-title">{{__('Flat Rate')}}</h3>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group">
										<label class="col-lg-2 control-label">{{__('Status')}}</label>
										<div class="col-lg-7">
											<label class="switch" style="margin-top:5px;">
												<input type="radio" name="shipping_type" value="flat_rate" checked>
												<span class="slider round"></span>
											</label>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">{{__('Shipping cost')}}</label>
										<div class="col-lg-7">
											<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Shipping cost')}}" name="flat_shipping_cost" class="form-control" required>
										</div>
									</div>
								</div>
							</div>

				        </div>
						<div id="demo-stk-lft-tab-10" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('PDF Specification')}}</label>
								<div class="col-lg-7">
									<input type="file" class="form-control" placeholder="{{__('PDF')}}" name="pdf" accept="application/pdf">
								</div>
							</div>
				        </div>
				    </div>
				</div>
			</div>
			<div class="panel-footer text-right">
				<button type="submit" name="button" class="btn btn-info">{{ __('Save') }}</button>
			</div>
		</div>
	</form>
</div>


@endsection

@section('script')

<script type="text/javascript">
	$("#diamond_1").click(function() {
		if(this.checked){
			$("#diamond_1_diamond").show();
		}
		if(!this.checked){
			$("#diamond_1_diamond").hide();
		}
	});
	$("#diamond_2").click(function() {
		if(this.checked){
			$("#diamond_2_diamond").show();
		}
		if(!this.checked){
			$("#diamond_2_diamond").hide();
		}
	});
	$("#diamond_3").click(function() {
		if(this.checked){
			$("#diamond_3_diamond").show();
		}
		if(!this.checked){
			$("#diamond_3_diamond").hide();
		}
	});
	function add_more_customer_choice_option(i, name){
		$('#customer_choice_options').append('<div class="form-group"><div class="col-lg-2"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="'+name+'" placeholder="Choice Title" readonly></div><div class="col-lg-7"><input type="text" id="choice_options" class="form-control" name="choice_options_'+i+'[]" placeholder="Enter choice values" data-role="tagsinput" onchange="update_sku()"></div></div>');

		$("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
	}

	$('input[name="colors_active"]').on('change', function() {
	    if(!$('input[name="colors_active"]').is(':checked')){
			$('#colors').prop('disabled', true);
		}
		else{
			$('#colors').prop('disabled', false);
		}
		update_sku();
	});

	$('#colors').on('change', function() {
	    update_sku();
	});

	$('input[name="unit_price"]').on('keyup', function() {
	    update_sku();
	});

	$('input[name="name"]').on('keyup', function() {
	    update_sku();
	});

	function delete_row(em){
		$(em).closest('.form-group').remove();
		update_sku();
	}

	function update_sku(){
		$.ajax({
		   type:"POST",
		   url:'{{ route('products.sku_combination') }}',
		   data:$('#choice_form').serialize(),
		   success: function(data){
			   $('#sku_combination').html(data);
			   if (data.length > 1) {
				   $('#quantity').hide();
			   }
			   else {
					$('#quantity').show();
			   }
		   }
	   });
	}

	function get_subcategories_by_category(){
		var category_id = $('#category_id').val();
		$.post('{{ route('subcategories.get_subcategories_by_category') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
		    $('#subcategory_id').html(null);
		    for (var i = 0; i < data.length; i++) {
		        $('#subcategory_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		        $('.demo-select2').select2();
		    }
		    // get_subsubcategories_by_subcategory();
		});
	}

	// function get_subsubcategories_by_subcategory(){
	// 	var subcategory_id = $('#subcategory_id').val();
	// 	$.post('{{ route('subsubcategories.get_subsubcategories_by_subcategory') }}',{_token:'{{ csrf_token() }}', subcategory_id:subcategory_id}, function(data){
	// 	    $('#subsubcategory_id').html(null);
	// 		$('#subsubcategory_id').append($('<option>', {
	// 			value: null,
	// 			text: null
	// 		}));
	// 	    for (var i = 0; i < data.length; i++) {
	// 	        $('#subsubcategory_id').append($('<option>', {
	// 	            value: data[i].id,
	// 	            text: data[i].name
	// 	        }));
	// 	        $('.demo-select2').select2();
	// 	    }
	// 	    //get_brands_by_subsubcategory();
	// 		//get_attributes_by_subsubcategory();
	// 	});
	// }

	function get_brands_by_subsubcategory(){
		var subsubcategory_id = $('#subsubcategory_id').val();
		$.post('{{ route('subsubcategories.get_brands_by_subsubcategory') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
		    $('#brand_id').html(null);
		    for (var i = 0; i < data.length; i++) {
		        $('#brand_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		        $('.demo-select2').select2();
		    }
		});
	}

	function get_attributes_by_subsubcategory(){
		var subsubcategory_id = $('#subsubcategory_id').val();
		$.post('{{ route('subsubcategories.get_attributes_by_subsubcategory') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
		    $('#choice_attributes').html(null);
		    for (var i = 0; i < data.length; i++) {
		        $('#choice_attributes').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		    }
			$('.demo-select2').select2();
		});
	}

	$(document).ready(function(){
		$('#diamond_1_diamond').hide();
		$('#diamond_2_diamond').hide();
		$('#diamond_3_diamond').hide();

		var mataltype = $("#metaltype").val();
		MetalType(mataltype);
		$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
	    get_subcategories_by_category();
		$("#photos").spartanMultiImagePicker({
			fieldName:        'photos[]',
			maxCount:         10,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#thumbnail_img").spartanMultiImagePicker({
			fieldName:        'thumbnail_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#featured_img").spartanMultiImagePicker({
			fieldName:        'featured_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#flash_deal_img").spartanMultiImagePicker({
			fieldName:        'flash_deal_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#meta_photo").spartanMultiImagePicker({
			fieldName:        'meta_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
	});

	$('#category_id').on('change', function() {
	    get_subcategories_by_category();
	});

	// $('#subcategory_id').on('change', function() {
	//     get_subsubcategories_by_subcategory();
	// });

	$('#subsubcategory_id').on('change', function() {
	    // get_brands_by_subsubcategory();
		//get_attributes_by_subsubcategory();
	});

	$('#choice_attributes').on('change', function() {
		$('#customer_choice_options').html(null);
		$.each($("#choice_attributes option:selected"), function(){
			//console.log($(this).val());
            add_more_customer_choice_option($(this).val(), $(this).text());
        });
		update_sku();
	});

	function MetalType() {
		var mataltype = $("#metaltype").val();
		$.post('{{ route('metal.carat.name') }}',{_token:'{{ csrf_token() }}', id:mataltype}, function(data){
			$('#carattype').html(null);
		    for (var i = 0; i < data.length; i++) {
                $('#carattype').append($('<option>', {
                    value: data[i].id,
					ref:data[i].metal_price,
                    text: data[i].name
                }));
            }
			var rate = $('#carattype').find(":selected").attr('ref');
			// $('#metal_rate').val(rate);
			FinalTotal();
		});
	}

	// function MetalPrice() {
	// 	var price = $("#carattype").find(":selected").attr('ref');
	// 	$('#metal_rate').val(price);
	// 	FinalTotal();
	// }

	function MtalWeight() {
		FinalTotal();
	}

	function FinalTotal() {
		var metal_rate = $("#metal_rate").val();
		var weight = $("#metal_weight").val();
		$("#unit_price").val(metal_rate * weight);
		update_sku();
	}

	function getVarient(val) {
		var metal_rate = $("#metal_rate").val();
		var size_val = $("#size_"+val).val();
		$("#price_"+val).val(size_val * metal_rate);
	}

	function subTotal() {
		var type = $("#tax_type").val();
		var price = $("#sub_total").val();
		var tax = $("#tax").val();
		var finalprice = "";
		if(type == 'percent'){
			var per = ((price*tax)/100) ;
			finalprice = parseInt(per) + parseInt(price);
		}else{
			finalprice = parseInt(price) + parseInt(tax);
		}
		$('#unit_price').val(finalprice);
	}


</script>

<style>
 #diamond_type{
	display:flex;
    justify-content: flex-start;
}
#diamond_1_diamond, #diamond_2_diamond, #diamond_3_diamond{
	margin-top: 15px;
    display: flex;
    justify-content: center;
    border: 1px solid;
    padding: 15px;
	flex-wrap: wrap;
}
</style>

@endsection
