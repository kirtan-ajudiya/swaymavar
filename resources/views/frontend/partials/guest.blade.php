<div class="container container-nested is-wrapping">
    <div class="col lg-6 md-6 sm-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="first_name">First name&nbsp;<span class="required">*</span></label>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name" />
        </div>
        @error('first_name')
            <span style="color:red"><b>{{ $message }}</b></span>
        @enderror
    </div>
 
    <div class="col lg-6 md-6 sm-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="last_name">Last name&nbsp;<span class="required">*</span></label>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name" />
        </div>
        @error('last_name')
            <span style="color:red"><b>{{ $message }}</b></span>
        @enderror
    </div>
    <div class="col lg-12 md-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="company_name">Company name (optional)</label>
            <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" placeholder="Enter Company Name" />
        </div>
    </div>
    <div class="col lg-12 md-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="country_region">Country / Region&nbsp;<span class="required">*</span></label>
            <span class="drop-down-arrow"></span>
            <select id="country_region" name="country_region" required>
                <option disabled>Select Country / Region</option>
                <option>Australia</option>
                <option>Argentina</option>
                <option>Brazil</option>
                <option>Canada</option>
                <option>China</option>
                <option>India</option>
                <option>Kazakhstan</option>
                <option>Russia</option>
                <option>Sudan</option>
                <option>United States</option>
            </select>
        </div>
        @error('country_region')
            <span style="color:red"><b>{{ $message }}</b></span>
        @enderror
    </div>
    <div class="col lg-12 md-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="street_address">Street address&nbsp;<span class="required">*</span></label>
            <input type="text" id="street_address" value="{{ old('street_address') }}" name="street_address" placeholder="Enter Street Address"/>
        </div>
        @error('street_address')
            <span style="color:red"><b>{{ $message }}</b></span>
        @enderror
    </div>
    <div class="col lg-4 md-4 sm-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="postcode_zip">Postcode / ZIP&nbsp;<span class="required">*</span></label>
            <input type="text" id="postcode_zip" value="{{ old('postcode_zip') }}" placeholder="Enter Postcode / ZIP" name="postcode_zip"/>
        </div>
        @error('postcode_zip')
            <span style="color:red"><b>{{ $message }}</b></span>
        @enderror
    </div>
    <div class="col lg-4 md-4 sm-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="town_city">Town / City&nbsp;<span class="required">*</span></label>
            <input type="text" id="town_city" value="{{ old('town_city') }}" placeholder="Enter Town / City" name="town_city"/>
        </div>
        @error('town_city')
            <span style="color:red"><b>{{ $message }}</b></span>
        @enderror
    </div>
    <div class="col lg-4 md-4 sm-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="province_state">Province / State&nbsp;<span class="required">*</span></label>
            <input type="text" id="province_state" value="{{ old('province_state') }}" placeholder="Enter Postcode / ZIP" name="province_state" />
        </div>
        @error('province_state')
            <span style="color:red"><b>{{ $message }}</b></span>
        @enderror
    </div>
    <div class="col lg-6 md-6 sm-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="phone">Phone Number&nbsp;<span class="required">*</span></label>
            <input type="text" id="phone" value="{{ old('phone') }}" placeholder="Enter Phone Number" name="phone" name="phone" />
        </div>
        @error('phone')
            <span style="color:red"><b>{{ $message }}</b></span>
        @enderror
    </div>
    <div class="col lg-6 md-6 sm-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="email_address">Email address&nbsp;<span class="required">*</span></label>
            <input type="text" id="email_address" value="{{ old('email_address') }}" placeholder="Enter Email address" name="email_address" />
        </div>
        @error('email_address')
            <span style="color:red"><b>{{ $message }}</b></span>
        @enderror
    </div>
    <div class="col lg-12 md-12 no-margin-bottom">
        <div class="custom-field">
            <input type="checkbox" id="Shiping_different_address" name="Shiping_different_address" value="1" onclick="myFunction1()">
            <label class="fw-500" for="Shiping_different_address">Ship to a different address?</label>
        </div>
    </div>
</div>
<div class="container container-nested is-wrapping display-none" id="shipping_details">
    <div class="col lg-12 md-12 no-margin-bottom">
        <h3 class="margin-bottom">Shipping Details</h3>
    </div>
    <div class="col lg-6 md-6 sm-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="first_name">First name&nbsp;<span class="required">*</span></label>
            <input type="text" id="first_name" value="{{ old('ship_first_name') }}" placeholder="Enter First Name"  name="ship_first_name" />
        </div>
        @error('ship_first_name')
            <span style="color:red"><b>{{ $message }}</b></span>
        @enderror
    </div>
    <div class="col lg-6 md-6 sm-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="last_name">Last name&nbsp;<span class="required">*</span></label>
            <input type="text" id="last_name" value="{{ old('ship_last_name') }}" placeholder="Enter Last Name" name="ship_last_name" />
        </div>
        @error('ship_last_name')
            <span style="color:red"><b>{{ $message }}</b></span>
        @enderror
    </div>
    <div class="col lg-12 md-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="company_name">Company name (optional)</label>
            <input type="text" id="company_name" value="{{ old('ship_company_name') }}" placeholder="Enter Company Name" name="ship_company_name" />
        </div>
    </div>
    <div class="col lg-12 md-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="country_region">Country / Region&nbsp;<span class="required">*</span></label>
            <span class="drop-down-arrow"></span>
            <select id="country_region" name="ship_country_region">
                <option disabled>Select Country / Region</option>
                <option>Australia</option>
                <option>Argentina</option>
                <option>Brazil</option>
                <option>Canada</option>
                <option>China</option>
                <option>India</option>
                <option>Kazakhstan</option>
                <option>Russia</option>
                <option>Sudan</option>
                <option>United States</option>
            </select>
        </div>
        @error('ship_country_region')
            <span style="color:red"><b>{{ $message }}</b></span>
        @enderror
    </div>
    <div class="col lg-12 md-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="street_address">Street address&nbsp;<span class="required">*</span></label>
            <input type="text" id="street_address" value="{{ old('ship_street_address') }}" placeholder="Enter Street Address" name="ship_street_address" />
        </div>
        @error('ship_street_address')
            <span style="color:red"><b>{{ $message }}</b></span>
        @enderror
    </div>
    <div class="col lg-4 md-4 sm-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="postcode_zip">Postcode / ZIP&nbsp;<span class="required">*</span></label>
            <input type="text" id="postcode_zip" value="{{ old('ship_postcode_zip') }}" placeholder="Enter Postcode / ZIP" name="ship_postcode_zip"/>
        </div>
        @error('ship_postcode_zip')
            <span style="color:red"><b>{{ $message }}</b></span>
        @enderror
    </div>
    <div class="col lg-4 md-4 sm-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="town_city">Town / City&nbsp;<span class="required">*</span></label>
            <input type="text" id="town_city" value="{{ old('ship_town_city') }}" placeholder="Enter Town / City" name="ship_town_city" />
        </div>
        @error('ship_town_city')
            <span style="color:red"><b>{{ $message }}</b></span>
        @enderror
    </div>
    <div class="col lg-4 md-4 sm-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="province_state">Province / State&nbsp;<span class="required">*</span></label>
            <input type="text" id="province_state" value="{{ old('ship_province_state') }}" placeholder="Enter Postcode / ZIP" name="ship_province_state" />
        </div>
        @error('ship_province_state')
            <span style="color:red"><b>{{ $message }}</b></span>
        @enderror
    </div>
    <div class="col lg-6 md-6 sm-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="phone">Phone Number&nbsp;<span class="required">*</span></label>
            <input type="text" id="phone" value="{{ old('ship_phone') }}" placeholder="Enter Phone Number" name="ship_phone"/>
        </div>
        @error('ship_phone')
            <span style="color:red"><b>{{ $message }}</b></span>
        @enderror
    </div>
    <div class="col lg-6 md-6 sm-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="email_address">Email address&nbsp;<span class="required">*</span></label>
            <input type="text" id="email_address" value="{{ old('ship_email_address') }}" placeholder="Enter Email address" name="ship_email_address"/>
        </div>
        @error('ship_email_address')
            <span style="color:red"><b>{{ $message }}</b></span>
        @enderror
    </div>
</div>
<div class="container container-nested is-wrapping">
    <div class="col lg-12 md-12 no-margin-bottom">
        <div class="input-set-group">
            <label class="fw-500" for="order_notes">Order Notes (optional)</label>
            <textarea id="order_notes" placeholder="Enter Order Notes" name="order_notes"></textarea>
        </div>
    </div>
</div>