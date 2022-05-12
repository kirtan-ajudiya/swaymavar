@extends('frontend.policies.inc.sidenav')
    @section('sidenavleft')
    @php
        $banner = \App\Banner::where('published', 1)->where('position', 6)->first();
    @endphp
    <div class="section first-section"
        style="background: url({{asset($banner->photo)}}) no-repeat;background-size: cover;background-position: center;">
        <div class="row">
            <div class="col lg-12 page-title">
              <h1 class="text-white margin-bottom text-uppercase text-center">Help and FAQ's</h1>
              <div class="text-small text-align-center"><a href="{{route('home')}}" class="on-dark">Home</a> / <span class="low-text-contrast text-white">Help and FAQ's</span></div>
            </div>
        </div>
    </div>
        
    @endsection

    @section('sidenavright')
        
    <div class="col lg-9 md-12 no-margin-bottom padding-top-bottom-double bg-white">
        <div class="container container-nested is-wrapping privacy-policy-text">
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Do all the sarees featured on your website come with an attached blouse piece/ blouse
                        material?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Most of the sarees featured on our website have attached un-stitched blouse pieces. Only some saree
                    categories do not have an accompanying blouse piece. This will be indicated when you click to see
                    the product details.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Do the shipping charges vary from country to country?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Yes, the shipping charges may vary from country to country. The shipping charges for your destination
                    will be indicated when you place the order.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Is there any shipping charge for deliveries within India?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Rhey Cart does not levy any shipment charges for deliveries within India, Free shipping throughout
                    India.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>How do I track the product once it has been shipped from India?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Yes, you would receive an email with the Airway Bill number of the courier once it is shipped. You
                    would be able to track it with the respective courier.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Do I need to register to shop?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>No, you don't have to be a registered user of Rhey Cart to shop with us. However, being a registered
                    user helps with faster checkouts and personalized recommendations. Keeping the many benefits of
                    registration in mind, we have made registration very simple.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Price of my ordered item has gone down / is now on sale after placing the order?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>For all items we offer the best value to our customers. In this case, it might happen due to various
                    factors like high demand of the item or low cost of the raw material.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>How do I know that my transaction has been successful?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>You would receive an order confirmation via email with the corresponding order number for your future
                    reference.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Do you accept payment via other methods?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>You can make your payment through Bank Transfer method. Please choose your preferred payment method
                    while making your purchases. If you choose the Bank Transfer method then we will send you an email
                    stating the Bank Payment details.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>How do I return a product, if I don’t like it?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Please report the return to us within 24 hours of receiving the product. You may call or email us to
                    process your request. Please note that the reverse pick up charges has to be borne by the customer.
                    The reverse pick up charge is Rs.250 .For the amount paid, we will issue you a credit note which you
                    may redeem in your next purchase.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Can the billing address and shipping address be different?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Yes, the billing address and shipping address can be different.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Will product that I get in hand, be similar to the product as seen on your website?</strong>
                </p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>While great effort has been made to accurately reproduce sarees in their original grandeur, there
                    might be minor variations in color of the actual product because of the color variations between the
                    actual product and that is displayed on the screen due to digital photography and color settings and
                    capabilities of monitors. We request you to place an order keeping in mind this minor variation in
                    color as seen on a computer screen against the actual color of the saree received.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>What is the procedure to return a product, if I don’t like it?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Please report the return to us within 24 hours of receiving the product. You may email us or call us
                    and inform us the same.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>I bought a saree with blouse stitched, Can I return it or exchange it?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Returns would not be accepted for custom made / stitched clothing, including for sarees where the
                    blouse is stitched, readymade stitched sarees or sarees stitched with custom blouse. However we
                    would accept returns if there are any faults from our end.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Will I get a full refund if I return the product?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>The value of refund varies from one case to another. It would be under the sole discretion of the
                    operations.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Are there any charges for refunds, if I return an item?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>There is an admin credit card commission cost of 10percentage of the final order value. We will not
                    refund the shipping charges paid by you while purchasing the item. We will not refund the customs
                    duties or taxes, if applicable, or paid by you at time of receiving the goods.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Can I pay using my Debit card?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Yes, we accept all major debit cards.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>How do I know that you have received my payments?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>You would receive an email confirmation that we have received your payments along with an order
                    number.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>My card is declined, what should I do?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Please recheck if you have given your card details correct. If so, please contact your banks and
                    explain them that you are trying to purchase from an online store. Your banks might block your cards
                    for security issues.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Do the shipping charges vary from country to country?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Yes, for some products, they vary from country to country.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Is the shipping charge calculated on weight of the package?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>The shipping charges are calculated on the number of products in your order. You can view the
                    shipping cost as you added product in cart.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Can I track the package once you ship it from India?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Yes, you would receive an email with the Airway Bill number of the courier once it is shipped. You
                    would be able to track it with the respective courier.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>What are your shipping charges for deliveries inside India?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Delivery inside India is free of cost in most cases, however if there is a change it can be verified
                    at the shipping policy link.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Can you deliver to any country in the world?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Yes, we deliver to almost all countries in the world.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>What is the procedure to return a product, if I don’t like it?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Please report the return to us within 24 hours of receiving the product. You may email us or call us
                    and inform us the same.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>I bought a saree with blouse stitched, Can I return it or exchange it?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Returns would not be accepted for custom made / stitched clothing, including for sarees where the
                    blouse is stitched, readymade stitched sarees or sarees stitched with custom blouse. However we
                    would accept returns if there are any faults from our end.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Will I get a full refund if I return the product?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>The value of refund varies from one case to another. It would be under the sole discretion of the
                    operations.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Will the out of stock item be available again?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Once an item is out of stock there is no certainty to provide that item in future. You can check the
                    similar items available on the website.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Are there any charges for refunds, if I return an item?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>There is an admin credit card commission cost of 10percentage of the final order. We will not refund
                    the shipping charges paid by you while purchasing the item. We will not refund the customs duties or
                    taxes, if applicable, or paid by you at time of receiving the goods.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>How do I know that you have received my payments?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>You would receive an email confirmation that we have received your payments along with an order
                    number.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>My card is declined, what should I do?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Please recheck if you have given your card details correct. If so, please contact your banks and
                    explain them that you are trying to purchase from an online store. Your banks might block your cards
                    for security issues.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>Can I pay using bank transfer? Where do I get details of your bank account?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Yes, you can pay through bank transfer. You would receive an email as soon as you choose pay by bank
                    transfer as your option of payment.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>I do not have a PayPal account, Can I still transfer money to your account?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>No, one needs to have a PayPal account to do PayPal transfer.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>There is a slight variation in the item color. I want to return it. How can I do it?</strong>
                </p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>We believe that all the customers who order online are aware that colors seen on a monitor will be
                    slightly different as compared to the actual outfits or accessories ordered.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>What is the procedure to return a product, if I don’t like it?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>Please report the return to us within 24 hours of receiving the product. You may email us or call us
                    and inform us the same.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>What is billing address?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>The address where you receive your card statements is called billing address.</p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p><strong>What is shipping address?</strong></p>
            </div>
            <div class="col lg-6 md-12 margin-bottom">
                <p>The address where you would like to deliver the goods is called the shipping address. Yes, you can
                    give a different shipping address.</p>
            </div>
        </div>
        <div class="privacy-policy-text margin-bottom">
            <div class="w-clearfix"></div>
        </div>
    </div>
    @endsection
