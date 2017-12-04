<div class='col-md-8'>

    <div class="row">

        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-dark bold uppercase">Personal Details</span>
                        <i class="icon-user shipping_user_icon font-dark"></i>
                    </div>
                </div>
                <div class="portlet-body">


                        @if(!$loggedUser)
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>First Name:</label>
                                    {!! Former::text('f_name')->label(false)->required('required') !!}
                                </div>
                                <div class="col-sm-6">
                                    <label>Last Name:</label>
                                    {!! Former::text('l_name')->label(false)->required('required') !!}
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>First Name:</label>
                                    {!! Former::text('fisrt_name')->forceValue( $loggedUser->f_name )->label(false)->disabled() !!}
                                </div>
                                <div class="col-sm-6">
                                    <label>Last Name:</label>
                                    {!! Former::text('last_name')->forceValue( $loggedUser->l_name )->label(false)->disabled() !!}
                                </div>
                            </div>
                        @endif


                        <div class="row">
                            <div class="col-sm-6">
                                <label>@if($loggedUser)  Invoice @endif Email:</label>
                                {!! Former::email('email')->label(false)->required('required') !!}
                            </div>
                            <div class="col-sm-6">
                                @if(! $loggedUser)
                                    <label>Contact Number:</label>
                                    {!! Former::text('phone')->label(false)->required('required') !!}
                                @else
                                    <label>Contact Number:</label>
                                    {!! Former::text('phone')->label(false)->forceValue( $loggedUser->mobile )->required('required') !!}
                                @endif
                            </div>
                        </div>


                    @if (!Auth::user())
                        <div class="row">
                            <div class='col-md-7 col-sm-6'>
                                <p><strong class="text-success">Create account on checkout </strong>  <input type="checkbox" onclick="ShopOrder.checkCreateAccount(this)"  name='register' /></p>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <p class="medium-margin-bottom pull-right">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#login-modal" data-backdrop="static">
                                        Have an account ?
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div style="display: none" class="clearfix row" id='create-account-password-wrapper'>
                            <div class='col-sm-6'>
                                <label>Password</label>
                                {!! Former::password('password')->label(false)->id('create-account-password') !!}
                            </div>
                            <div class='col-sm-6'>
                                <label>Confirm Password</label>
                                {!! Former::password('confirm_password')->label(false) !!}
                            </div>
                        </div>
                    @endif
                </div>  
            </div>  
        </div> 
        <div class="col-md-12">





            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-dark bold uppercase">Shipping Address</span>
                        <i class="fa fa-file-text-o shipping_user_icon font-dark"></i>
                    </div>
                </div>
                <div class="portlet-body" id="order-form-shipping-address">
                    <div class="row">
                        <div class="col-md-12">
                            <script type="text/javascript" src="{{asset('/modules/shop/js/countries.js') }}"></script>


                            <div class="row">
                                <div class="col-md-6">
                                    <label>Deliver To: (Receiver Name)</label>
                                    @if($loggedUser)
                                        {!! Former::text('customer_name')->label(false)->placeholder($loggedUser->fullname()) !!}
                                    @else
                                        {!! Former::text('customer_name')->placeholder('Optional')->label(false) !!}
                                    @endif
                                </div>
                            </div>
                            @if($loggedUser)
                                <div class="row">

                                    <ul id="addresses" class="col-md-12">
                                        <div class="temp"></div>
                                        @foreach($loggedUser->addresses()->orderBy('default','DESC')->get() as $address)
                                        <li data-address="{{$address->address}}"
                                            data-town="{{$address->town}}"
                                            data-city="{{$address->city}}"
                                            data-country="{{$address->country}}"
                                            data-zip_code="{{$address->zip_code}}"
                                            class="address-item">
                                            <div class="address_box">
                                                <input onchange="fillAddress()" type="radio" name="address" value="{{$address->country}}" @if($address->default) checked="checked" @endif >
                                                <h4 class="no-margin-top uppercase">{!! $address->name !!} @if($address->default) (DEFAULT) @endif</h4>
                                                {!! $address->address !!},
                                                {!! $address->town !!},
                                                {!! $address->city !!}, {!! $address->zip_code !!},
                                                {!! $address->country !!}
                                            </div>
                                        </li>
                                        @endforeach
                                        <li>
                                            <div id="address_box" class="address_box">
                                                <input type="radio" name="address" value="manual" class="manualAddress">
                                                <div id="address_title_box" class="visible">
                                                    <a href="javascript:void(0)">Manually enter address</a>
                                                </div>
                                                <!-- a href="{{ route('edit_account') }}">MANAGE ADDRESSES</a-->


                                                <div id="address_info" style="display:none;">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label>House Number / Name & Street Name:</label>
                                                            {!! Former::text('address')->label(false)->required('required') !!}
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label>Town:</label>
                                                            {!! Former::text('town')->label(false)->required('required') !!}
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label>City / State:</label>
                                                            {!! Former::text('city_state')->label(false)->required('required') !!}
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label>Post Code / Zip Code :</label>
                                                            {!! Former::text('zip_code')->label(false)->required('required') !!}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Region:</label>
                                                            <div class="form-group">
                                                                <select required='required' onchange="ShopCountries.setCountry(this, country); ShopShipping.reset();"
                                                                        class="form-control" name="region">
                                                                    <option value = "" selected = "selected"> SELECT REGION </option>
                                                                    <script type="text/javascript">
                                                                        ShopCountries.setRegions();
                                                                    </script>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Country:</label>
                                                            <div class="form-group">
                                                                <select required='required' id="ship-to-country" disabled="disabled" onchange="ShopShipping.getAllowedMethods(initDelivery)" 
                                                                        class="form-control" name="country">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class='col-sm-6'>
                                                            <fieldset class="question medium-margin-bottom">
                                                               <label for="save_address_question">Save Address?</label>
                                                               <input class="save_address_question" type="checkbox" name="save_address_question" value="1" />
                                                           </fieldset>

                                                           <fieldset class="save-address-box">
                                                               
                                                               <label>Address name:</label>
                                                               {!! Former::text('name')->label(false)->class('form-control')->placeholder('EG HOME / WORK') !!}
                                                           

                                                               <div class="medium-margin-top">
                                                                   <label for="make_default">Set as default address?</label>
                                                                   <input class="make_default" type="checkbox" name="make_default" value="1" />
                                                               </div>

                                                           </fieldset>
                                                        </div>

                                                    </div>
                                                </div>


                                            </div>
                                        </li>
                                        <div class="medium-margin-bottom">
                                            <small><a href="{{ route('edit_account') }}">Manage Addresses</a></small>
                                        </div>
                                    </ul>


                                    
                                    <div class="col-md-12">
                                        <hr class="dashed small-margin-top" />
                                    </div>
                                </div>

                            @else
                                <!--div class="row">

                                    <div class='col-sm-6'>
                                        <label>House Number/Name & Street Name:</label>
                                            {!! Former::text('address')->label(false)->class('form-control')->placeholder('Required') !!}
                                    </div>
                                    <div class='col-sm-6'>
                                        <label>Town:</label>
                                            {!! Former::text('town')->label(false)->class('form-control')->placeholder('Required') !!}
                                    </div>
                                    <div class='col-sm-6'>
                                        <label>City:</label>
                                            {!! Former::text('city')->label(false)->class('form-control')->placeholder('Required') !!}
                                    </div>
                                    <div class='col-sm-6'>
                                        <label>Post/Zip Code:</label>
                                            {!! Former::text('zip_code')->label(false)->class('form-control')->placeholder('Required') !!}
                                    </div>
                                    <div class='col-sm-6'>
                                        <label>Country:</label>
                                            {!! Former::select('country')->fromQuery( App\Country::orderBy('name','ASC')->get(),'name','name')->label(false)->class('form-control')->placeholder('Select Country') !!}
                                    </div>
                                    <div class='col-sm-6'>
                                        <label>Save Address As:</label>
                                            {!! Former::text('name')->label(false)->class('form-control')->placeholder('Required') !!}
                                    </div>
                                </div-->

                                <div id="address_info">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>House Number / Name & Street Name:</label>
                                            {!! Former::text('address')->label(false)->required('required') !!}
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Town:</label>
                                            {!! Former::text('town')->label(false)->required('required') !!}
                                        </div>
                                        <div class="col-sm-6">
                                            <label>City / State:</label>
                                            {!! Former::text('city_state')->label(false)->required('required') !!}
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Post Code / Zip Code :</label>
                                            {!! Former::text('zip_code')->label(false)->required('required') !!}
                                        </div>
                                        <div class="col-md-6">
                                            <label>Region:</label>
                                            <div class="form-group">
                                                <select required='required' onchange="ShopCountries.setCountry(this, country); ShopShipping.reset();"
                                                        class="form-control" name="region">
                                                    <option value = "" selected = "selected"> SELECT REGION </option>
                                                    <script type="text/javascript">
                                                        ShopCountries.setRegions();
                                                    </script>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Country:</label>
                                            <div class="form-group">
                                                <select required='required' id="ship-to-country" disabled="disabled" onchange="ShopShipping.getAllowedMethods(initDelivery)" 
                                                        class="form-control" name="country" >
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class='col-sm-6'>
                                            <label>Address name:</label>
                                                               {!! Former::text('name')->label(false)->class('form-control')->placeholder('EG HOME / WORK')->required('required') !!}
                                        </div>
                                        <div class="col-md-12">
                                            <hr class="dashed" />
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Delivery Note <i class="fa fa-pencil shipping_user_icon font-dark"></i> </label>
                                {!! Former::textarea('customer_note')->label(false)->rows(4) !!}
                            </div>
                        </div>
                        

                    </div>
                </div>
            </div> 





        </div>           
    </div>


</div><!-- close ./col-md-9 -->

<div id="shop-cart-summary-wraper" class="col-md-4">
    <div class="recipe-well" style="margin-top:0;">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-dark bold uppercase">Order Summary</span>
                <i class="icon-pencil shipping_user_icon font-dark"></i>
            </div>
            <hr class="small-margin-bottom">
        </div>
        <div class="shop-cart-summary">
            @include('shop::_partials.cart.orderSummary')
        </div>
    </div>
</div>
