@extends('layouts.app')

@section('content')

<div class="row">
	<form class="form form-horizontal mar-top" action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data" id="choice_form">
		<input name="_method" type="hidden" value="POST">
		<input type="hidden" name="id" value="{{ $product->id }}">
		@csrf
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
	                                <input type="text" class="form-control" name="name" placeholder="{{__('Product Name')}}" value="{{$product->name}}" required>
	                            </div>
	                        </div>
							<div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('SKU Code')}}</label>
	                            <div class="col-lg-7">
	                                <input type="text" class="form-control" name="sku_code" placeholder="{{__('SKU Code')}}" value="{{$product->sku_code}}" >
	                            </div>
	                        </div>
	                        <div class="form-group" id="category">
	                            <label class="col-lg-2 control-label">{{__('Category')}}</label>
	                            <div class="col-lg-7">
	                                <select class="form-control demo-select2-placeholder" name="category_id" id="category_id" required>
	                                	<option>Select an option</option>
	                                	@foreach($categories as $category)
	                                	    <option value="{{$category->id}}" <?php if($product->category_id == $category->id) echo "selected"; ?> >{{__($category->name)}}</option>
	                                	@endforeach
	                                </select>
	                            </div>
	                        </div>
	                        <div class="form-group" id="subcategory">
	                            <label class="col-lg-2 control-label">{{__('Subcategory')}}</label>
	                            <div class="col-lg-7">
	                                <select class="form-control demo-select2-placeholder" name="subcategory_id" id="subcategory_id">

	                                </select>
	                            </div>
	                        </div>
	                        {{-- <div class="form-group" id="subsubcategory">
	                            <label class="col-lg-2 control-label">{{__('Sub Subcategory')}}</label>
	                            <div class="col-lg-7">
	                                <select class="form-control demo-select2-placeholder" name="subsubcategory_id" id="subsubcategory_id">

	                                </select>
	                            </div>
	                        </div> --}}
							<!-- <div class="form-group" >
								<label class="col-lg-2 control-label">{{__('Fabric')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="fabric_id"  required>
										@foreach(App\Fabric::all() as $category)
											<option value="{{$category->id}}" <?php if($product->fabric_id == $category->id) echo "selected"; ?>>{{__($category->name)}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group" >
								<label class="col-lg-2 control-label">{{__('Occasion')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="occasion_id"  required>
										@foreach(App\Occasion::all() as $category)
											<option value="{{$category->id}}" <?php if($product->fabric_id == $category->id) echo "selected"; ?>>{{__($category->name)}}</option>
										@endforeach
									</select>
								</div>
							</div>
	                        <div class="form-group" id="brand">
	                            <label class="col-lg-2 control-label">{{__('Brand')}}</label>
	                            <div class="col-lg-7">
	                                <select class="form-control demo-select2-placeholder" name="brand_id" id="brand_id">
										<option value="">{{ ('Select Brand') }}</option>
										@foreach (\App\Brand::all() as $brand)
											<option value="{{ $brand->id }}" @if($product->brand_id == $brand->id) selected @endif>{{ $brand->name }}</option>
										@endforeach
	                                </select>
	                            </div>
	                        </div> -->
	                        <div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Unit')}}</label>
	                            <div class="col-lg-7">
	                                <input type="text" class="form-control" name="unit" placeholder="Unit (e.g. KG, Pc etc)" value="{{$product->unit}}" 	>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Tags')}}</label>
	                            <div class="col-lg-7">
	                                <input type="text" class="form-control" name="tags[]" id="tags" value="{{ $product->tags }}" placeholder="Type to add a tag" data-role="tagsinput">
	                            </div>
	                        </div>
							@php
							    $pos_addon = \App\Addon::where('unique_identifier', 'pos_system')->first();
							@endphp
							@if ($pos_addon != null && $pos_addon->activated == 1)
								<div class="form-group">
									<label class="col-lg-2 control-label">{{__('Barcode')}}</label>
									<div class="col-lg-7">
										<input type="text" class="form-control" name="barcode" placeholder="{{ ('Barcode') }}" value="{{ $product->barcode }}">
									</div>
								</div>
							@endif

							@php
							    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
							@endphp
							@if ($refund_request_addon != null && $refund_request_addon->activated == 1)
								<div class="form-group">
									<label class="col-lg-2 control-label">{{__('Refundable')}}</label>
									<div class="col-lg-7">
										<label class="switch" style="margin-top:5px;">
											<input type="checkbox" name="refundable" @if ($product->refundable == 1) checked @endif>
				                            <span class="slider round"></span></label>
										</label>
									</div>
								</div>
							@endif
				        </div>
				        <div id="demo-stk-lft-tab-2" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Main Images')}}</label>
								<div class="col-lg-7">
									<div id="photos">
										@if(is_array(json_decode($product->photos)))
											@foreach (json_decode($product->photos) as $key => $photo)
												<div class="col-md-4 col-sm-4 col-xs-6">
													<div class="img-upload-preview">
														<img loading="lazy"  src="{{ asset($photo) }}" alt="" class="img-responsive">
														<input type="hidden" name="previous_photos[]" value="{{ $photo }}">
														<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
													</div>
												</div>
											@endforeach
										@endif
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Thumbnail Image')}} <small>(290x300)</small></label>
								<div class="col-lg-7">
									<div id="thumbnail_img">
										@if ($product->thumbnail_img != null)
											<div class="col-md-4 col-sm-4 col-xs-6">
												<div class="img-upload-preview">
													<img loading="lazy"  src="{{ asset($product->thumbnail_img) }}" alt="" class="img-responsive">
													<input type="hidden" name="previous_thumbnail_img" value="{{ $product->thumbnail_img }}">
													<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
												</div>
											</div>
										@endif
									</div>
								</div>
							</div>
							<!-- <div class="form-group">
								<label class="col-lg-2 control-label">{{__('Featured')}} <small>(290x300)</small></label>
								<div class="col-lg-7">
									<div id="featured_img">
										@if ($product->featured_img != null)
											<div class="col-md-4 col-sm-4 col-xs-6">
												<div class="img-upload-preview">
													<img loading="lazy"  src="{{ asset($product->featured_img) }}" alt="" class="img-responsive">
													<input type="hidden" name="previous_featured_img" value="{{ $product->featured_img }}">
													<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
												</div>
											</div>
										@endif
									</div>
								</div>
							</div> -->
							<!-- <div class="form-group">
								<label class="col-lg-2 control-label">{{__('Flash Deal')}} <small>(290x300)</small></label>
								<div class="col-lg-7">
									<div id="flash_deal_img">
										@if ($product->flash_deal_img != null)
											<div class="col-md-4 col-sm-4 col-xs-6">
												<div class="img-upload-preview">
													<img loading="lazy"  src="{{ asset($product->flash_deal_img) }}" alt="" class="img-responsive">
													<input type="hidden" name="previous_flash_deal_img" value="{{ $product->flash_deal_img }}">
													<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
												</div>
											</div>
										@endif
									</div>
								</div>
							</div> -->
				        </div>
				        <div id="demo-stk-lft-tab-3" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Video Provider')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="video_provider" id="video_provider">
										<option value="youtube" <?php if($product->video_provider == 'youtube') echo "selected";?> >{{__('Youtube')}}</option>
										<option value="dailymotion" <?php if($product->video_provider == 'dailymotion') echo "selected";?> >{{__('Dailymotion')}}</option>
										<option value="vimeo" <?php if($product->video_provider == 'vimeo') echo "selected";?> >{{__('Vimeo')}}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Video Link')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="video_link" value="{{ $product->video_link }}" placeholder="Video Link">
								</div>
							</div>
				        </div>
						<div id="demo-stk-lft-tab-4" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Meta Title')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="meta_title" value="{{ $product->meta_title }}" placeholder="{{__('Meta Title')}}">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Description')}}</label>
								<div class="col-lg-7">
									<textarea name="meta_description" rows="8" class="form-control">{{ $product->meta_description }}</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{ __('Meta Image') }}</label>
								<div class="col-lg-7">
									<div id="meta_photo">
										@if ($product->meta_img != null)
											<div class="col-md-4 col-sm-4 col-xs-6">
												<div class="img-upload-preview">
													<img loading="lazy"  src="{{ asset($product->meta_img) }}" alt="" class="img-responsive">
													<input type="hidden" name="previous_meta_img" value="{{ $product->meta_img }}">
													<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
												</div>
											</div>
										@endif
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
									<select class="form-control color-var-select" name="colors[]" id="colors" multiple>
										@foreach (\App\Color::orderBy('name', 'asc')->get() as $key => $color)
											<option value="{{ $color->code }}" <?php if(in_array($color->code, json_decode($product->colors))) echo 'selected'?> >{{ $color->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-lg-2">
									<label class="switch" style="margin-top:5px;">
										<input value="1" type="checkbox" name="colors_active" <?php if(count(json_decode($product->colors)) > 0) echo "checked";?> >
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
											<option value="{{ $attribute->id }}" @if($product->attributes != null && in_array($attribute->id, json_decode($product->attributes, true))) selected @endif>{{ $attribute->name }}</option>
										@endforeach
			                        </select>
			                    </div>
			                </div>

							<div class="">
								<p>Choose the attributes of this product and then input values of each attribute</p>
								<br>
							</div>

							<div class="customer_choice_options" id="customer_choice_options">
								@foreach (json_decode($product->choice_options) as $key => $choice_option)
									<div class="form-group">
										<div class="col-lg-2">
											<input type="hidden" name="choice_no[]" value="{{ $choice_option->attribute_id }}">
											<input type="text" class="form-control" name="choice[]" value="{{ \App\Attribute::find($choice_option->attribute_id)->name }}" placeholder="Choice Title" disabled>
										</div>
										<div class="col-lg-7">
											<input type="text" class="form-control" name="choice_options_{{ $choice_option->attribute_id }}[]" id="choice_options" placeholder="Enter choice values" value="{{ implode(',', $choice_option->values) }}" data-role="tagsinput" onchange="update_sku()">
										</div>
										<div class="col-lg-2">
											<button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button>
										</div>
									</div>
								@endforeach
							</div>
							{{-- <div class="form-group">
								<div class="col-lg-2">
									<button type="button" class="btn btn-info" onclick="add_more_customer_choice_option()">{{ __('Add more customer choice option') }}</button>
								</div>
							</div> --}}
				        </div>
						<div id="demo-stk-lft-tab-6" class="tab-pane fade">
						
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Gender')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="gender">
											<option value="0"  @if(isset($product->gender) && $product->gender == 0 ) selected @endif> Men </option>
											<option value="1"  @if(isset($product->gender) && $product->gender == 0 ) selected @endif> Women </option>
											<option value="2"  @if(isset($product->gender) && $product->gender == 0 ) selected @endif> Kids </option>
											<option value="3"  @if(isset($product->gender) && $product->gender == 0 ) selected @endif> Pair </option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Jewellary Type')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="jewellery_type">
										@foreach(App\JewelleryType::where('status', 1)->get() as $jewellery_type)
											<option value="{{$jewellery_type->id}}" @if($product->jewellery_type == $jewellery_type->id) selected @endif>{{ $jewellery_type->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="row" style="margin-left: 30px;">
								<div class="col-lg-4">
									<div class="form-group">
										<label class="col-lg-3 control-label">{{__('Metal Type')}}</label>
										<div class="col-lg-6">
											<select class="form-control demo-select2-placeholder metal" name="metal_type" id="metaltype" onchange="MetalType();" >
												@foreach(App\MetalType::where('status', 1)->get() as $metal_type)
													<option value="{{$metal_type->id}}" @if(isset($product->metal_type) && $product->metal_type == $metal_type->id ) selected @endif>{{$metal_type->name}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label class="col-lg-3 control-label">{{__('Carat Type')}}</label>
										<div class="col-lg-6">
											<select class="form-control demo-select2-placeholder metal" name="carat_type" id="carattype" >
												
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
													<option value="{{$metal_color->id}}" @if(isset($product->metal_color) && $product->metal_color == $metal_color->id ) selected @endif>{{$metal_color->color}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Matel Weight')}}</label>
								<div class="col-lg-7">
									<input type="number" min="0" value="{{ $product->metal_weight }}" step="0.01" placeholder="{{__('Weight')}}"  name="metal_weight"  class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Metal Price')}}</label>
								<div class="col-lg-7">
									<input type="number" min="0" value="{{ $product->metal_rate }}" step="0.01" placeholder="{{__('Metal Rate')}}"  name="metal_rate"  class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Select Diamond')}}</label>
								<div class="row" id="diamond_type" style="margin-left: 30px;">
									<div class="col-lg-7">
										<div class="col-lg-4">
											<div class="form-check control-label">
													<input type="checkbox" class="form-check-input"  id="diamond_1" name="single_diamond" value="1" @if($product->single_diamond == 1) checked @endif >
													<label class="form-check-label" for="diamond_1">Diamond</label>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-check control-label">
													<input type="checkbox" class="form-check-input " id="diamond_2" name="choki_diamond" value="1" @if($product->choki_diamond == 1) checked @endif>
													<label class="form-check-label" for="diamond_2">Choki Diamond</label>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-check control-label">
													<input type="checkbox" class="form-check-input " id="diamond_3" name="solited_diamond" value="1" @if($product->solited_diamond == 1) checked @endif>
													<label class="form-check-label" for="diamond_3">Solited Diamond</label>
											</div>
										</div>
									</div>
								</div>
								<div id="diamond_1_diamond">
									<div class="row" style="margin-left: 30px;">
										<div class="col-lg-4">
											<div class="form-group">
												<label class="col-lg-5 control-label">{{__('Diamond pieces')}}</label>
												<div class="col-lg-6">
														<input type="number" min="0" step="0.01" placeholder="{{__('Diamond pieces')}}"  name="diamond_pieces" class="form-control" value="{{ $product->diamond_pieces }}">
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="col-lg-5 control-label">{{__('Diamond Weigth')}}</label>
												<div class="col-lg-6">
														<input type="number" min="0" step="0.01" placeholder="{{__('Diamond Weight')}}"  name="diamond_weight" class="form-control" value="{{ $product->diamond_weight }}">
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="col-lg-5 control-label">{{__('Diamond price')}}</label>
												<div class="col-lg-6">
														<input type="number" min="0" step="0.01" placeholder="{{__('Diamond price')}}"  name="diamond_price" class="form-control" value="{{ $product->diamond_price }}">
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

								<div  id="diamond_2_diamond">
									<div class="row"  style="margin-left: 30px;">
										<div class="col-lg-4">
											<div class="form-group">
												<label class="col-lg-6 control-label">{{__('Choki Diamond pieces')}}</label>
												<div class="col-lg-6">
														<input type="number" min="0" step="0.01" placeholder="{{__('Diamond pieces')}}"  name="choki_diamond_pieces" class="form-control" value="{{ $product->choki_diamond_pieces }}">
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="col-lg-6 control-label">{{__('Choki Diamond Weigth')}}</label>
												<div class="col-lg-6">
														<input type="number" min="0" step="0.01" placeholder="{{__('Diamond Weight')}}"  name="choki_diamond_weight" class="form-control" value="{{ $product->choki_diamond_weight }}">
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="col-lg-6 control-label">{{__('Choki Diamond price')}}</label>
												<div class="col-lg-6">
														<input type="number" min="0" step="0.01" placeholder="{{__('Diamond price')}}"  name="choki_diamond_price" class="form-control" value="{{ $product->choki_diamond_price }}">
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label class="col-lg-2 control-label">{{__('Choki Diamond Quality')}}</label>
											<div class="col-lg-7">
												<input type="text" placeholder="{{__('ex. FG-VS')}}" name="choki_diamond_quality" class="form-control" >
											</div>
										</div>
									</div>
								</div>

								<div id="diamond_3_diamond" >
									<div class="row"  style="margin-left: 30px;">
										<div class="col-lg-4">
											<div class="form-group">
												<label class="col-lg-6 control-label">{{__('Solited Diamond pieces')}}</label>
												<div class="col-lg-6">
														<input type="number" min="0" step="0.01" placeholder="{{__('Diamond pieces')}}"  name="solited_diamond_pieces" class="form-control" value="{{ $product->solited_diamond_pieces}}">
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="col-lg-6 control-label">{{__('Solited Diamond Weight')}}</label>
												<div class="col-lg-6">
														<input type="number" min="0" step="0.01" placeholder="{{__('Diamond Weight')}}"  name="solited_diamond_weight" class="form-control" value="{{ $product->solited_diamond_weight }}">
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="col-lg-6 control-label">{{__('Solited Diamond price')}}</label>
												<div class="col-lg-6">
														<input type="number" min="0" step="0.01" placeholder="{{__('Diamond price')}}"  name="solited_diamond_price" class="form-control" value="{{ $product->solited_diamond_price }}">
												</div>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label class="col-lg-2 control-label">{{__('Solited Diamond Quality')}}</label>
												<div class="col-lg-7">
													<input type="text" placeholder="{{__('ex. FG-VS')}}" name="solited_diamond_quality" class="form-control" value="{{ $product->solited_diamond_quality }}">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

	                        <div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Purchase price')}}</label>
	                            <div class="col-lg-7">
	                                <input type="number" min="0" step="0.01" placeholder="{{__('Purchase price')}}" name="purchase_price" class="form-control" value="{{$product->purchase_price}}" >
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('GST Tax')}}</label>
	                            <div class="col-lg-7">
	                                <input type="number" min="0" step="0.01" onkeyup="subTotal()" placeholder="{{__('tax')}}" name="tax"  id="tax" class="form-control" value="{{$product->tax}}" required>
	                            </div>
	                            <div class="col-lg-1">
	                                <select class="demo-select2" id="tax_type" name="tax_type" required onchange="subTotal()">
	                                	<option value="amount" <?php if($product->tax_type == 'amount') echo "selected";?> >Rs</option>
	                                	<option value="percent" <?php if($product->tax_type == 'percent') echo "selected";?> >%</option>
	                                </select>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Discount')}}</label>
	                            <div class="col-lg-7">
	                                <input type="number" min="0" step="0.01" placeholder="{{__('Discount')}}" name="discount" class="form-control" value="{{ $product->discount }}" required>
	                            </div>
	                            <div class="col-lg-1">
	                                <select class="demo-select2" name="discount_type" required>
	                                	<option value="amount" <?php if($product->discount_type == 'amount') echo "selected";?> >Rs</option>
	                                	<!-- <option value="percent" <?php if($product->discount_type == 'percent') echo "selected";?> >%</option> -->
	                                </select>
	                            </div>
	                        </div>
							<div class="form-group" id="quantity">
								<label class="col-lg-2 control-label">{{__('Quantity')}}</label>
								<div class="col-lg-7">
									<input type="number" min="0" value="{{ $product->current_stock }}" step="1" placeholder="{{__('Quantity')}}" name="current_stock" class="form-control" >
								</div>
							</div>
							<div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Labour Charge')}}</label>
	                            <div class="col-lg-7">
	                                <input type="text" placeholder="{{__('Labour Charge')}}"  name="labor_charge" value="{{$product->labor_charge}}" class="form-control" >
	                            </div>
	                        </div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Sub Total')}}</label>
								<div class="col-lg-7">
									<input type="number" min="0"  step="0.01" onkeyup="subTotal()" id="sub_total" placeholder="{{__('Sub Total')}}" value="{{$product->sub_total}}" name="sub_total" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('MRP')}}</label>
	                            <div class="col-lg-7">
	                                <input type="text" placeholder="{{__('MRP')}}" readonly id="unit_price" name="unit_price" value="{{$product->unit_price}}" class="form-control" required>
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
	                                <textarea  class="form-control"  name="short_description">{{$product->short_description}}</textarea>
	                            </div>
	                        </div>
							<div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Description')}}</label>
	                            <div class="col-lg-9">
	                                <textarea class="editor" name="description">{{$product->description}}</textarea>
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
												<input type="radio" name="shipping_type" value="free" @if($product->shipping_type == 'free') checked @endif>
												<span class="slider round"></span>
											</label>
										</div>
									</div>
								</div>
							</div>

							<div class="row bord-btm">
								<div class="col-md-2">
									<div class="panel-heading">
										<h3 class="panel-title">{{__('Local Pickup')}}</h3>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group">
										<label class="col-lg-2 control-label">{{__('Status')}}</label>
										<div class="col-lg-7">
											<label class="switch" style="margin-top:5px;">
												<input type="radio" name="shipping_type" value="local_pickup" @if($product->shipping_type == 'local_pickup') checked @endif>
												<span class="slider round"></span>
											</label>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">{{__('Shipping cost')}}</label>
										<div class="col-lg-7">
											<input type="number" min="0" step="0.01" placeholder="{{__('Shipping cost')}}" name="local_pickup_shipping_cost" class="form-control" value="{{ $product->shipping_cost }}" required>
										</div>
									</div>
								</div>
							</div>

							<div class="row bord-btm">
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
												<input type="radio" name="shipping_type" value="flat_rate" @if($product->shipping_type == 'flat_rate') checked @endif>
												<span class="slider round"></span>
											</label>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">{{__('Shipping cost')}}</label>
										<div class="col-lg-7">
											<input type="number" min="0" step="0.01" placeholder="{{__('Shipping cost')}}" name="flat_shipping_cost" class="form-control" value="{{ $product->shipping_cost }}" required>
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
						<div id="demo-stk-lft-tab-11" class="tab-pane fade">
						
				        </div>
				    </div>
				</div>
			</div>
			<div class="panel-footer text-right">
				<button type="submit" name="button" class="btn btn-purple">{{ __('Save') }}</button>
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
	// var i = $('input[name="choice_no[]"').last().val();
	// if(isNaN(i)){
	// 	i =0;
	// }

	function add_more_customer_choice_option(i, name){
		$('#customer_choice_options').append('<div class="form-group"><div class="col-lg-2"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="'+name+'" readonly></div><div class="col-lg-7"><input type="text" class="form-control" name="choice_options_'+i+'[]" placeholder="Enter choice values" data-role="tagsinput" onchange="update_sku()"></div><div class="col-lg-2"><button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button></div></div>');
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

	// $('input[name="unit_price"]').on('keyup', function() {
	//     update_sku();
	// });

	function delete_row(em){
		$(em).closest('.form-group').remove();
		update_sku();
	}

	function update_sku(){
		$.ajax({
		   type:"POST",
		   url:'{{ route('products.sku_combination_edit') }}',
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

	function getVarient(val) {
		var metal_rate = $("#metal_rate").val();
		var size_val = $("#size_"+val).val();
		$("#price_"+val).val(size_val * metal_rate);
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
		    }
		    $("#subcategory_id > option").each(function() {
		        if(this.value == '{{$product->subcategory_id}}'){
		            $("#subcategory_id").val(this.value).change();
		        }
		    });

		    $('.demo-select2').select2();

		    get_subsubcategories_by_subcategory();
		});
	}

	function get_subsubcategories_by_subcategory(){
		var subcategory_id = $('#subcategory_id').val();
		$.post('{{ route('subsubcategories.get_subsubcategories_by_subcategory') }}',{_token:'{{ csrf_token() }}', subcategory_id:subcategory_id}, function(data){
		    $('#subsubcategory_id').html(null);
			$('#subsubcategory_id').append($('<option>', {
				value: null,
				text: null
			}));
		    for (var i = 0; i < data.length; i++) {
		        $('#subsubcategory_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		    }
		    $("#subsubcategory_id > option").each(function() {
		        if(this.value == '{{$product->subsubcategory_id}}'){
		            $("#subsubcategory_id").val(this.value).change();
		        }
		    });

		    $('.demo-select2').select2();

		    //get_brands_by_subsubcategory();
			//get_attributes_by_subsubcategory();
		});
	}

	// function get_brands_by_subsubcategory(){
	// 	var subsubcategory_id = $('#subsubcategory_id').val();
	// 	$.post('{{ route('subsubcategories.get_brands_by_subsubcategory') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
	// 	    $('#brand_id').html(null);
	// 	    for (var i = 0; i < data.length; i++) {
	// 	        $('#brand_id').append($('<option>', {
	// 	            value: data[i].id,
	// 	            text: data[i].name
	// 	        }));
	// 	    }
	// 	    $("#brand_id > option").each(function() {
	// 	        if(this.value == '{{$product->brand_id}}'){
	// 	            $("#brand_id").val(this.value).change();
	// 	        }
	// 	    });
	//
	// 	    $('.demo-select2').select2();
	//
	// 	});
	// }

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
			$("#choice_attributes > option").each(function() {
				var str = @php echo $product->attributes @endphp;
		        $("#choice_attributes").val(str).change();
		    });

			$('.demo-select2').select2();
		});
	}



	$(document).ready(function(){
		<?php 
		if($product->solited_diamond == 1){ ?>
		 	$("#diamond_3_diamond").show();
		<?php } else { ?>
			$("#diamond_3_diamond").hide();
		<?php } ?>

		<?php 
		if($product->choki_diamond == 1){ ?>
		 	$("#diamond_2_diamond").show();
		<?php } else { ?>
			$("#diamond_2_diamond").hide();
		<?php } ?>

		<?php 
		if($product->single_diamond == 1){ ?>
		 	$("#diamond_1_diamond").show();
		<?php } else { ?>
			$("#diamond_1_diamond").hide();
		<?php } ?>

		var mataltype = $("#metaltype").val();
		MetalType(mataltype);
		FinalTotal();
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

		update_sku();

		$('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
        });
	});

	$('#category_id').on('change', function() {
	    get_subcategories_by_category();
	});

	$('#subcategory_id').on('change', function() {
	    get_subsubcategories_by_subcategory();
	});

	$('#subsubcategory_id').on('change', function() {
	    //get_brands_by_subsubcategory();
		//get_attributes_by_subsubcategory();
	});

	$('#choice_attributes').on('change', function() {
		//$('#customer_choice_options').html(null);
		$.each($("#choice_attributes option:selected"), function(j, attribute){
			flag = false;
			$('input[name="choice_no[]"]').each(function(i, choice_no) {
				if($(attribute).val() == $(choice_no).val()){
					flag = true;
				}
			});
            if(!flag){
				add_more_customer_choice_option($(attribute).val(), $(attribute).text());
			}
        });

		var str = @php echo $product->attributes @endphp;

		$.each(str, function(index, value){
			flag = false;
			$.each($("#choice_attributes option:selected"), function(j, attribute){
				if(value == $(attribute).val()){
					flag = true;
				}
			});
            if(!flag){
				//console.log();
				$('input[name="choice_no[]"][value="'+value+'"]').parent().parent().remove();
			}
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
		
		});
	}

	function subTotal() {
		console.log("hello");
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
