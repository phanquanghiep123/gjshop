
<script type="text/javascript">
    var isLoggedIn = {{Auth::check() ? 'true' : 'false'}};
</script>

@include('_partials.frontend.login_modal')
@include('_partials.frontend.stock_notification_email_modal')

@if( config('shop.currency_baseon_region') )
    @include('_partials.frontend.choose_shop_modal')
@endif

<footer id="footer">
    <div class="holder">
        <div class="copyright">
            <div class="row">
                @if($settings->show_socials == 1)
                    <div class="col-md-12 visible-xs">
                        <ul class="list-inline social-links align-center">
                            @if($settings->facebook)
                                <li><a href="{!! $settings->facebook !!}"><i class="fa fa-facebook"></i></a></li>
                            @endif
                            @if($settings->pinterest)
                                <li><a href="{!! $settings->pinterest !!}"><i class="fa fa-pinterest"></i></a></li>
                            @endif
                            @if($settings->instagram)
                                <li><a href="{!! $settings->instagram !!}"><i class="fa fa-instagram"></i></a></li>
                            @endif
                            @if($settings->youtube)
                                <li><a href="{!! $settings->youtube !!}"><i class="fa fa-youtube"></i></a></li>
                            @endif
                            @if($settings->twitter)
                                <li><a href="{!! $settings->twitter !!}"><i class="fa fa-twitter"></i></a></li>
                            @endif
                        </ul>
                    </div>
                @endif

                <div class="col-md-5 privacy no-print">
                    <?php echo $footerPrivacyMenu; ?>
                </div>
                
                <div class="col-md-5">
                    <p style="font-weight: bold">© {!! date('Y') !!} {!! $settings->copyright !!}</p>
                </div>
                <div class="col-md-2 col-sm-12">
                    <p style="text-align:center; float:none !important;"><img src="{{ asset('/assets/frontend/images/paypal-logo-flat.png')}}"></p>
                </div>
            </div>
        </div>  
    </div>
</footer>