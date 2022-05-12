
@if(isset($countProduct) && $countProduct > 0)
    @foreach($products as $product)
        <div class="product-item">
            <div class="product-single">
                <div class="product-img">
                    <img src="{{ asset($product->thumbnail_img) }}" alt="Product Image">
                </div>
                <div class="product-compare">
                    <a href=""><img src="{{ asset($product->thumbnail_img) }}"></a>
                </div>
                <div class="product-content">
                    <div class="product-title">
                        <h2>
                            <a href="">{{ $product->name }}</a>
                        </h2>
                    </div>
                    <div class="product-price">
                        <h2>{{ home_discounted_base_price($product->id) }}</h2>
                    </div>
                    @if($product->stock == '0')
                        <div class="tags text-center"><span class="text-center">TRY ON AVAILABLE</span></div>
                    @else
                        <div class="tags text-center"><span class="text-center" style="background-color:#28a745;"> ON AVAILABLE</span></div>
                    @endif
                    <div class="product-action">
                        <a href="">Quick View</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @else
    <div class="product-item">
        <h2> No Product Founds. </h2>
    </div>

@endif
