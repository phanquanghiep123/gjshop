<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <!-- Meta tag for responsive -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Gabriel Job - @yield('title')</title>
        <!-- Good meta tags for SEO -->

        <meta property="fb:app_id"                      content="1045973748864272" /> 
        <meta property="og:type"                        content="product" /> 
        <meta property="og:url"                         content="@yield('og_url')" /> 
        <meta property="og:title"                       content="@yield('og_title')" /> 
        <meta property="og:description"                 content="@yield('og_description')" />
        <meta property="og:image"                       content="@yield('og_image')" /> 
        <meta property="product:retailer_item_id"       content="@yield('og_ean')" /> 
        <meta property="product:price:amount"           content="@yield('og_price')" /> 
        <meta property="product:price:currency"         content="GBP" />  
        <meta property="product:condition"              content="New" /> 

        <meta name="description" content="@yield('meta_description')" />
        <meta name="keywords" content="@yield('meta_keywords')" />
        <meta name="title" content="@yield('meta_title')" />

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('/assets/frontend/images/favicon.png')}}" />
        <!-- Custom css -->
        @include('_partials.frontend.styles')
        @yield('styles')
        <script> var baseUrl = "{{url('/')}}";</script>
    </head>
    <body>
        <!-- script async defer data-pin-hover="true" data-pin-tall="true" data-pin-round="true" data-pin-save="false" src="//assets.pinterest.com/js/pinit.js"></script-->
        <div class="se-pre-con"></div>

        @include('_partials.frontend.popup_search')
                
        <header class="fixed">    
            <div class="header-wrap container">
                <a href="{!! url('/') !!}" id="logo"><img src="{{asset('/assets/frontend/images/logo.png')}}" alt="logo of nurtured" /></a>  
                <div class="nav-wrap">
                    <div class="top-menu-wrap">
                        <nav id="top-menu">
                            <?php
                                $mainMenu = App\Engine\Menu::get('main_menu');
                                $footerPrivacyMenu = App\Engine\Menu::get('privacy');
                            ?>
                        </nav> <!-- end top-menu -->
                        
                        @include('_partials.frontend.acount_social_links')
                        
                    </div> <!-- end wrap-top-menu -->
                    <div class="bottom-menu-wrap">
                        <nav id="bottom-menu">
                            <?php echo $mainMenu; ?>
                        </nav> <!-- end bottom-menu -->
                        <form action="" id="searchForm" class="activesearch responsive">
                            <input class="form-control" type="text" name="s" placeholder="Search" />
                            <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </div>  <!-- end bottom-menu-wrap -->
                </div>  <!-- end nav-wrap -->
                <div class="nav-mobile">
                    <i class="fa fa-close"></i>
                    <div class="bottom-menu-wrap">
                        <nav id="bottom-menu">
                            <?php echo $mainMenu; ?>
                        </nav> <!-- end bottom-menu -->
                    </div>  <!-- end bottom-menu-wrap -->
                </div>
                <!--end nav mobile -->
                @include('_partials.frontend.toggle_search')
                <div class="clear-fix"></div>
            </div>
        </header>
        <section id="content" class="page-content @yield('contentClass')">
            <div class="main-content">
                <div class="container">
                    <div class="row">
                        <nav class="col-md-3 sidebar-main">
                            @include('shop::_partials.sidebar_categories')
                        </nav>
                        <main class="col-md-9">
                            @yield('content')
                        </main>
                        
                    </div>
                </div>
            </div>
        </section>
        <section id="footer-area">
            <div class="container">
                @include('_partials.frontend.footer')
            </div>
        </section>


        <!-- Custom jquery -->
        @include('_partials.frontend.scripts')
        @yield('scripts')
        @yield('js')
    </body>
</html>