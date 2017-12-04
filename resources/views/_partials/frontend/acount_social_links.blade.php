
<div class="acount_social_links no-print">
   
    
    <ul class="list-inline social-links">
        @if($loggedUser && ( $loggedUser->is('admin') || $loggedUser->is('main-admin') ) )
            <li><a class="account_link" href="{!! route('dashboard') !!}" target="_blank" data-toggle="tooltip" data-placement="left" title="Admin Area"> <i class="fa fa-cog"></i></a></li>
        @endif

        @if($loggedUser)
            <li><a class="account_link" href="{!! route('my_account') !!}" data-toggle="tooltip" data-placement="left" title="My Account"> <i class="icon-user"></i></a></li>
            <li><a class="account_link" href="{!! url('logout') !!}" data-toggle="tooltip" data-placement="left" title="Logout"> <i class="icon-logout"></i></a></li>
        @else
            <li>
                <a class="login_link signin" data-toggle="modal" href="#login-modal" data-backdrop="static"> 
                    <i class="fa fa-sign-in" data-toggle="tooltip" data-placement="left" title="Login"></i>
                </a>
            </li>
            <li><a class="login_link" href="{!! url('register') !!}" data-toggle="tooltip" data-placement="left" title="Register"> <i class="icon-user"></i></a></li>
        @endif
        
        <li class="cart-link" style="<?php echo $settings->show_socials == 1 ? 'border-right: 1px solid #8F8F8F;' : '' ?>">{!! view('shop::_partials.cart.quickView') !!}</li>

        @if($settings->show_socials == 1)
            @if($settings->facebook)
                <li class="social-link"><a href="https://facebook.com/{!! $settings->facebook !!}" target="_blank"><i class="fa fa-facebook"></i></a></li>
            @endif
            @if($settings->pinterest)
                <li class="social-link"><a href="https://pinterest.com/{!! $settings->pinterest !!}" target="_blank"><i class="fa fa-pinterest"></i></a></li>
            @endif
            @if($settings->instagram)
                <li class="social-link"><a href="https://instagram.com/{!! $settings->instagram !!}" target="_blank"><i class="fa fa-instagram"></i></a></li>
            @endif
            @if($settings->youtube)
                <li class="social-link"><a href="https://youtube.com/{!! $settings->youtube !!}" target="_blank"><i class="fa fa-youtube"></i></a></li>
            @endif
            @if($settings->twitter)
                <li class="social-link"><a href="https://twitter.com/{!! $settings->twitter !!}" target="_blank"><i class="fa fa-twitter"></i></a></li>
            @endif
        @endif
        <li class="hidden-xs hidden-sm"><i class="fa fa-phone"></i> +44(0)207 993 6881</li>
    </ul>
</div>
