                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 sidebar_sticky">
                        <div class="clear-filter-box">
                            <p style="font-size: 17px;font-weight: 600;">Filter By</p>
                            <p>
                                <a href="{{ route('products') }}">CLEAR ALL</a>
                            </p>
                        </div>

                        <div class="accordion" id="accordionExample">
                            <div class="card" id="headingOne">
                              <div class="card-header">
                                <h2 class="mb-0">
                                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <h4 class="accordion-title js-accordion-title">category</h4>
                                    <div class="icon_right"></div>
                                  </button>
                                </h2>
                              </div>
                              <div id="collapseOne" class="collapse @if($categories) show @endif " aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="accordion-content">
                                        <ul class="filter-section">
                                            @foreach (App\Category::all() as $key=>$item)
                                            <li>
                                                <input type="checkbox" id="category_{{$key}}" name="category[]" value="{{$item->id}}" onchange="lode_more();" @if($categories && in_array($item->id, $categories)) checked @endif>
                                                <label for="category_{{$key}}">{{ $item->name }}</label>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="card" id="headingTwo">
                              <div class="card-header">
                                <h2 class="mb-0">
                                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <h4 class="accordion-title js-accordion-title">jewellery type</h4>
                                    <div class="icon_right"></div>
                                  </button>
                                </h2>
                              </div>
                              <div id="collapseTwo" class="collapse @if($jewellery_type) show @endif" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="accordion-content">
                                        <ul class="filter-section">
                                            @foreach(App\JewelleryType::all() as $key=>$type)
                                                <li><input type="checkbox" name="jewellery_type[]" onchange="lode_more();" value="{{$type->id}}" id="type_{{$key}}"  @if($jewellery_type && in_array($type->id, $jewellery_type)) checked @endif>
                                                <label for="type_{{$key}}">{{$type->name}}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="card" id="headingThree">
                                <div class="card-header">
                                  <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                      <h4 class="accordion-title js-accordion-title">price</h4>
                                      <div class="icon_right"></div>
                                    </button>
                                  </h2>
                                </div>
                                <div id="collapseThree" class="collapse @if($frice) show @endif" aria-labelledby="headingThree" data-parent="#accordionExample">
                                  <div class="card-body">
                                      <div class="accordion-content">
                                          <ul class="filter-section">
                                                <li><input type="checkbox" id="Lessthan10000" name="price[]" value="0-5000" onchange="lode_more();" @if($frice && in_array("0-5000", $frice)) checked @endif>
                                                <label for="Lessthan10000">Less than <i class="fa fa-inr"></i> 5000 </label></li>

                                                <li><input type="checkbox" id="Between10000" name="price[]" value="5000-10000" onchange="lode_more();" @if($frice && in_array("5000-10000", $frice)) checked @endif>
                                                <label for="Between10000">Between <i class="fa fa-inr"></i> 5000 and <i class="fa fa-inr"></i> 10000 </label></li>

                                                <li><input type="checkbox" id="Between25000" name="price[]" value="10000-20000" onchange="lode_more();" @if($frice && in_array("10000-20000", $frice)) checked @endif>
                                                <label for="Between25000">Between <i class="fa fa-inr"></i> 10000 and <i class="fa fa-inr"></i> 20000 </label></li>

                                                <li><input type="checkbox" id="Between50000" name="price[]" value="20000-30000" onchange="lode_more();" @if($frice && in_array("20000-30000", $frice)) checked @endif>
                                                <label for="Between50000">Between <i class="fa fa-inr"></i> 20000 and <i class="fa fa-inr"></i> 30000 </label></li>

                                                <li><input type="checkbox" id="Between100000" name="price[]" value="30000-40000" onchange="lode_more();" @if($frice && in_array("30000-40000", $frice)) checked @endif>
                                                <label for="Between100000">Between <i class="fa fa-inr"></i> 30000 and <i class="fa fa-inr"></i> 40000 </label></li>

                                                <li><input type="checkbox" id="Between200000" name="price[]" value="40000-50000" onchange="lode_more();" @if($frice && in_array("40000-50000", $frice)) checked @endif>
                                                <label for="Between200000">Between <i class="fa fa-inr"></i> 40000 and <i class="fa fa-inr"></i> 50000 </label></li>

                                                <li><input type="checkbox" id="More50000" name="price[]" value="50000-1000000" onchange="lode_more();" @if($frice && in_array("50000-1000000", $frice)) checked @endif>
                                                <label for="More50000">Between <i class="fa fa-inr"></i> 50000 and More </label></li>
                                          </ul>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            <div class="card" id="headingfor">
                              <div class="card-header">
                                <h2 class="mb-0">
                                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsefor" aria-expanded="false" aria-controls="collapsefor">
                                    <h4 class="accordion-title js-accordion-title">metal color</h4>
                                    <div class="icon_right"></div>
                                  </button>
                                </h2>
                              </div>
                              <div id="collapsefor" class="collapse @if($colors) show @endif" aria-labelledby="collapsefor" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="accordion-content" style="">
                                        <ul class="filter-section">
                                        @foreach(App\MetalColor::all() as $key=>$color)
                                            <li><input type="checkbox" name="color[]" onchange="lode_more();" value="{{$color->id}}" id="colors_{{$key}}" @if($colors && in_array($color->id, $colors)) checked @endif>
                                                <label for="colors_{{$key}}">{{$color->color}}</label>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="card" id="headingfive">
                                <div class="card-header">
                                  <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                                      <h4 class="accordion-title js-accordion-title">gender</h4>
                                      <div class="icon_right"></div>
                                    </button>
                                  </h2>
                                </div>
                                <div id="collapsefive" class="collapse @if($filtered_array) show @endif" aria-labelledby="collapsefive" data-parent="#accordionExample">
                                  <div class="card-body">
                                      <div class="accordion-content">
                                          <ul class="filter-section">
                                              <li>
                                                  <input type="checkbox" onchange="lode_more();" name="gender[]" value="0" @if($filtered_array && in_array('0', $filtered_array)) checked @endif>
                                                  <label for="Men"><i class="fa fa-inr"></i> Men</label>
                                              </li>
                                              <li>
                                                  <input type="checkbox" id="Women" onchange="lode_more();" name="gender[]" value="1" @if($filtered_array && in_array('1', $filtered_array)) checked @endif>
                                                  <label for="Women"><i class="fa fa-inr"></i> Women</label>
                                              </li>
                                              <li>
                                                  <input type="checkbox" id="Kids" onchange="lode_more();" name="gender[]" value="2" @if($filtered_array && in_array('2', $filtered_array)) checked @endif>
                                                  <label for="Kids"> <i class="fa fa-inr"></i> Kids</label>
                                              </li>
                                              <li>
                                                  <input type="checkbox" id="pair" onchange="lode_more();" name="gender[]" value="3" @if($filtered_array && in_array('3', $filtered_array)) checked @endif>
                                                  <label for="pair"> <i class="fa fa-inr"></i> pair</label>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            <div class="card" id="headingsix">
                                <div class="card-header">
                                  <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
                                      <h4 class="accordion-title js-accordion-title">purity</h4>
                                      <div class="icon_right"></div>
                                    </button>
                                  </h2>
                                </div>
                                <div id="collapsesix" class="collapse @if($purityies) show @endif" aria-labelledby="collapsesix" data-parent="#accordionExample">
                                  <div class="card-body">
                                      <div class="accordion-content">
                                          <ul class="filter-section">
                                            @foreach (App\MetalPrice::where('status',1)->get() as $key=>$purity)
                                                <li><input type="checkbox" name="purity[]" onchange="lode_more();" value="{{$purity->id}}" id="purity_{{$key}}" @if(isset($purityies) && in_array($purity->id, $purityies)) checked @endif>
                                                    <label for="purity_{{$key}}">{{$purity->name}}  ({{$purity->metaltype->name}})</label>
                                                </li>
                                              @endforeach
                                          </ul>
                                      </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div class="shortby text-right">
                            <p>Short By</p>
                            <ul>
                                <li>
                                    <a href="javascript:void(0)" onclick="filter(1)"  class="@if(isset($sort_by) && $sort_by == 1) active @endif">New Arrivals</a>
                                    <input type="hidden" name="sort" id="sort" value="@if(isset($sort_by)) {{$sort_by}} @endif" />
                                </li>
                                <li>
                                    <a href="javascript:void(0)" onclick="filter(2)" class="@if(isset($sort_by) && $sort_by == 2) active @endif">Popularity</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" onclick="filter({{$discount_filter}})" class="@if(isset($sort_by) && $sort_by == 3 || $sort_by == 4 ) active @endif" style="margin-right: 9px;">Discount
                                        <span class="arrowPosition">
                                            <i class="discount-up-arrow @if(isset($sort_by) && $sort_by == 3) active @endif" ></i>
                                            <i class="discount-down-arrow @if(isset($sort_by) && $sort_by == 4) active @endif"></i>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="@if(isset($sort_by) && $sort_by == 5 || $sort_by == 6) active @endif" onclick="filter({{$price_filter}})" style="margin-right: 9px;">Price
                                        <span class="arrowPosition">
                                            <i class="discount-up-arrow @if(isset($sort_by) && $sort_by == 5) active @endif"></i>
                                            <i class="discount-down-arrow @if(isset($sort_by) && $sort_by == 6) active @endif"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="product-grid grid-1" id="product_listing">
                          @if($count_product > 0)
                            @foreach($products as $product)
                            <div class="product-item">
                                <div class="product-single">
                                    <div class="product-img">
                                        <a href="{{route('product', $product->slug)}}"><img src="{{ asset($product->thumbnail_img) }}" alt="Product Image" style="height:270px"></a>
                                    </div>
                                    <!-- <div class="product-compare">
                                        <a href="{{route('product', $product->slug)}}"><img src="{{ asset($product->thumbnail_img) }}"></a>
                                    </div> -->
                                    <div class="product-content">
                                        <div class="product-title">
                                            <h2>
                                                <a href="{{route('product', $product->slug)}}">{{ $product->name }}</a>
                                            </h2>
                                        </div>
                                        <div class="product-price">
                                          @if($product->discount && $product->discount != '' && $product->discount != '0' && !empty($product->discount))
                                            <h2> ₹{{ FrontdiscountTotalPrice($product->id) }} <span>,</span> <del> ₹{{ FrontTotalPrice($product->id) }} </del></h2>
                                          @else
                                            <h2> ₹{{ FrontTotalPrice($product->id) }} </h2>
                                          @endif
                                        </div>
                                        @if($product->stock == '0')
                                            <div class="tags text-center"><span class="text-center">TRY ON AVAILABLE</span></div>
                                        @else
                                            <div class="tags text-center"><span class="text-center" style="background-color:#28a745;"> ON AVAILABLE</span></div>
                                        @endif
                                        <div class="product-action">
                                          <a href="{{route('product', $product->slug)}}">Quick View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                          @else
                            <h1> No Product FOund </h1>
                          @endif
                        </div>

                    </div>
                </div>
