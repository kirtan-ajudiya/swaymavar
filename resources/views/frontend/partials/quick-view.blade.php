
<div class="c-overlay__modal">
    <div class="container">
        <div class="col no-margin-bottom lg-5 sm-12 sm-margin-bottom">
          <div class="product-slider-container">
                <div class="product-slider-mySlides">
                  <img src="http://rheycart.codealphainfotech.com/public/uploads/products/photos/eG6jLMETJA24U26uabaUK4LFaXwSV5J3TQH6h5v7.jpeg" sizes="(max-width: 479px) 90vw, (max-width: 752px) 93vw, (max-width: 991px) 700px, 45vw"  alt="">
                </div>
                <div class="product-slider-mySlides">
                  <img src="http://rheycart.codealphainfotech.com/public/uploads/products/photos/BWdGDo8Ejetjr2uOZY8vvr4JMaxfsQcr64l3X3xc.jpeg" sizes="(max-width: 479px) 90vw, (max-width: 752px) 93vw, (max-width: 991px) 700px, 45vw"  alt="">
                </div>
      <a class="product-slider-prev" onclick="plusSlides(-1)">❮</a>
      <a class="product-slider-next" onclick="plusSlides(1)">❯</a>
          <div class="product-slider-row" style="margin-top:10px;">
              <div class="product-slider-column">
                <img class="product-slider-demo product-slider-cursor" src="http://rheycart.codealphainfotech.com/public/uploads/products/photos/eG6jLMETJA24U26uabaUK4LFaXwSV5J3TQH6h5v7.jpeg" sizes="(max-width: 479px) 23vw, (max-width: 991px) 24vw, 11vw" onclick="currentSlide(1)" alt="">
              </div>
              <div class="product-slider-column">
                <img class="product-slider-demo product-slider-cursor" src="http://rheycart.codealphainfotech.com/public/uploads/products/photos/BWdGDo8Ejetjr2uOZY8vvr4JMaxfsQcr64l3X3xc.jpeg" sizes="(max-width: 479px) 23vw, (max-width: 991px) 24vw, 11vw" onclick="currentSlide(2)" alt="">
              </div>
          </div>
    </div>
            <!-- <div data-animation="slide" data-duration="500" data-infinite="1" class="c-slider w-slider">
                <div class="w-slider-mask">
                    @if(is_array(json_decode($product->photos)) && count(json_decode($product->photos)) > 0)
                        @foreach (json_decode($product->photos) as $key => $photo)
                            <div class="w-slide"><img src="{{ asset($photo) }}" sizes="100vw" alt=""></div>
                        @endforeach
                    @endif
                </div>
                <div class="c-slider__left-arrow w-slider-arrow-left">
                    <div class="w-icon-slider-left"></div>
                </div>
                <div class="c-slider__right-arrow w-slider-arrow-right">
                    <div class="w-icon-slider-right"></div>
                </div>
                @if(is_array(json_decode($product->photos)) && count(json_decode($product->photos)) > 0)
                    @foreach (json_decode($product->photos) as $key => $photo)
                        <div class="c-slider__nav w-slider-nav w-slider-nav-invert w-round"></div>
                    @endforeach
                @endif

            </div> -->
        </div>
        <div class="col lg-1"></div>
        <div class="col no-margin-bottom lg-6 sm-12">
            <div class="size-h3 margin-bottom-small">{{$product->name}}</div>
            <div class="c-product__rating margin-bottom">
                @php
                    $total = 0;
                    $total += $product->reviews->count();
                @endphp
                {{ renderStarRating($product->rating) }}
            </div>

            @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                <div class="size-h2 margin-bottom">{{ home_discounted_base_price($product->id) }}</div>
            @else
                <div class="size-h2 margin-bottom">{{ home_discounted_base_price($product->id) }}</div>
            @endif

            <p>{!! $product->description !!}</p>
            <div class="w-form">
                <form id="wf-form-Add-to-cart" name="wf-form-Add-to-cart" data-name="Add to cart" method="post">
                    <div class="flexh-align-center" style="flex-direction: column !important;align-items: flex-start !important;">
                        <!-- <div class="flexh-align-center margin-right"> <a href="#" class="quantity-button is-minus">–</a>
                            <input type="text" maxlength="256" value="1" name="field" data-name="Field" required=""
                                class="quantity-input w-input">
                            <a href="#" class="quantity-button is-plus">+</a> </div> -->
                            <div class="num-block skin-3" style="margin-bottom:20px;">
                                <div class="num-in"> <span class="minus dis"></span>
                                  <input type="text" id="NetQty" name="quantity" class="in-num" value="1" readonly="">
                                  <span class="plus"></span> </div>
                              </div>
                          <a href="javascript:void(0)" onclick="addtocartbtn()" class="button-primary is-small w-inline-block"><div class="button-primary-text">add to cart</div></a>
                    </div>
                </form>
                <div class="w-form-done">
                    <div>Thank you! Your submission has been received!</div>
                </div>
                <div class="w-form-fail">
                    <div>Oops! Something went wrong while submitting the form.</div>
                </div>
            </div>
        </div>
    </div>
    <a data-w-id="202df1b2-468b-88dd-04a0-44fffda14bc3" href="#" onclick="closetest()" class="c-close-btn w-inline-block">
        <div class="iconfont" ><em class="iconfont__no-italize"></em></div>
    </a>
    <div id="snackbar">
        <p>{{ __($product->name) }} <a href="{{ route('cart') }}" class="animation-underline-link">click here</a> to continue check out.</p>
      </div>
</div>

<input type="hidden" name="id" value="{{ $product->id }}">

</form>

<script>
$(document).ready(function() {
  $('.num-in span').click(function () {
      var $input = $(this).parents('.num-block').find('input.in-num');
    if($(this).hasClass('minus')) {
      var count = parseFloat($input.val()) - 1;
      count = count < 1 ? 1 : count;
      if (count < 2) {
        $(this).addClass('dis');
      }
      else {
        $(this).removeClass('dis');
      }
      $input.val(count);
    }
    else {
      var count = parseFloat($input.val()) + 1
      $input.val(count);
      if (count > 1) {
        $(this).parents('.num-block').find(('.minus')).removeClass('dis');
      }
    }
    $input.change();
    return false;
  });
});
</script>
