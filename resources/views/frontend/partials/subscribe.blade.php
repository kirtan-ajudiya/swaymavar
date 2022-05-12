@php
$bannera = App\Banner::where('published', 1)->where('position', 2)->first();
@endphp

<div class="footer-top-section bg-gray">
    <div class="container is-wide">
        <div class="col lg-3 md-6 sm-6 flex-align-middele no-margin-bottom-lg text-align-center" style="margin: 0 !important;">
            <div class="upper-footer flex-column-center">
                <div class="fa margin-right icon"></div>
                <div class="size-h4 text-with-icon margin-bottom-small text-align-center">FREE SHIPPING</div>
            </div>
        </div>
        <div class="col lg-3 md-6 sm-6 flex-align-middele no-margin-bottom-lg text-align-center" style="margin: 0 !important;">
            <div class="upper-footer flex-column-center">
                <div class="fa margin-right icon"></div>
                <div class="size-h4 text-with-icon margin-bottom-small text-align-center">SPECIAL OFFERS</div>
            </div>
        </div>
        <div class="col lg-3 md-6 sm-6 flex-align-middele no-margin-bottom-lg text-align-center" style="margin: 0 !important;">
            <div class="upper-footer flex-column-center">
                <div class="fa margin-right icon"></div>
                <div class="size-h4 text-with-icon margin-bottom-small text-align-center">ORDER PROTECTION</div>
            </div>
        </div>
        <div class="col lg-3 md-6 sm-6 flex-align-middele no-margin-bottom-lg text-align-center" style="margin: 0 !important;">
            <div class="upper-footer flex-column-center">
                <div class="fa margin-right icon"></div>
                <div class="size-h4 text-with-icon margin-bottom-small text-align-center">PROFESSIONAL SUPPORT</div>
            </div>
        </div>
    </div>
</div>
