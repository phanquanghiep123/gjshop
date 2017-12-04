<div class='col-md-8'>
    <div class="row">
        <div class='col-md-6'>
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-dark bold uppercase">Personal Details</span>
                        <i class="icon-user shipping_user_icon font-dark"></i>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if(!$loggedUser)
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>First Name (*)</label>
                                    {!! Former::text('f_name')->label(false)->required('required') !!}
                                </div>
                                <div class="col-sm-6">
                                    <label>Last Name (*)</label>
                                    {!! Former::text('l_name')->label(false)->required('required') !!}
                                </div>
                            </div>
                            @else
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>First Name (*)</label>
                                    {!! Former::text('fisrt_name')->forceValue( $loggedUser->f_name )->label(false)->disabled() !!}
                                </div>
                                <div class="col-sm-6">
                                    <label>Last Name (*)</label>
                                    {!! Former::text('last_name')->forceValue( $loggedUser->l_name )->label(false)->disabled() !!}
                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                <label>@if($loggedUser)  Invoice @endif Email:</label>
                                {!! Former::email('email')->label(false)->required('required') !!}
                            </div>
                            @if(! $loggedUser)
                                <div class="form-group">
                                    <label>Contact Number (*)</label>
                                    {!! Former::text('phone')->label(false)->required('required') !!}
                                </div>
                            @else
                                <div class="form-group">
                                    <label>Contact Number (*)</label>
                                    {!! Former::text('phone')->label(false)->forceValue( $loggedUser->mobile )->required('required') !!}
                                </div>
                            @endif


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
            </div> 
        </div><!-- close col-md-6 -->
        <div class='col-md-6'>
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



                            <div class="form-group">
                                <label>Deliver To: (Receiver Name)</label>
                                <div class="form-group">
                                    @if($loggedUser)
                                        {!! Former::text('customer_name')->label(false)->placeholder($loggedUser->fullname()) !!}
                                    @else
                                        {!! Former::text('customer_name')->placeholder('Optional')->label(false) !!}
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label>Post Code / Zip Code (*)</label>
                                        {{-- Former::text('zip_code')->label(false)->required('required')->class('form-control uppercase') --}}
                                        <input class="form-control uppercase error" required="required" id="zip_code" type="text" name="zip_code" aria-required="true" data-lastval="" aria-invalid="true">
                                        <small v-show="showManuallyEnterAdressButton"><a href="javascript:void(0)" v-on:click="showManuallyEnterAddress()">Manually enter address</a></small>
                                    </div>
                                    <div class="col-md-5">
                                        <button type="button" style="position: relative;top:25px"
                                                v-on:click="findAddress()"
                                                v-on:keypres="keypressHandle()"
                                                class="find-address btn btn-md dark spin">
                                            Find address
                                        </button>
                                    </div>
                                </div> 
                            </div>



                            <div id="address_info" style="display: none">
                                <div class="form-group">
                                    <label>Region (*)</label>
                                    <div class="form-group">
                                        <select required='required' onchange="ShopCountries.setCountry(this, country, city_state);
                                                ShopShipping.reset();"
                                                class="form-control" name="region">
                                            <option value = "" selected = "selected"> SELECT REGION </option>
                                            <script type="text/javascript">
                                                ShopCountries.setRegions();
                                            </script>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Door Number / House Name (*)</label>
                                    {!! Former::text('door')->label(false)->required('required') !!}
                                </div>
                                <div class="form-group">
                                    <label>Address (*)</label>
                                    {!! Former::text('address')->label(false)->required('required') !!}
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country (*)</label>
                                            <div class="form-group">
                                                <select required='required' id="ship-to-country" disabled="disabled" onchange="ShopCountries.setCityState(this, city_state);
                                                        ShopShipping.getAllowedMethods(initDelivery)" 
                                                        class="form-control" name="country">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City/State (*)</label>
                                            <div class="form-group">
                                                {!! Former::text('city_state')->label(false)->required('required') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr class="dashed small-margin-top" />
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
        </div><!-- close ./col-md-6 -->

    </div><!-- close ./row -->
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
