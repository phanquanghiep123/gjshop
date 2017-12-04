<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <!-- Meta tag for responsive -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Gabriel Job - @yield('title')</title>
        <!-- Good meta tags for SEO -->
        <meta name="description" content="@yield('meta_description')" />
        <meta name="keywords" content="@yield('meta_keywords')" />
        <meta name="title" content="@yield('meta_title')" />
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('/assets/frontend/images/favicon.png')}}" />
        <!-- Custom css -->
        @include('_partials.frontend.styles')
        @yield('styles')
        <style type="text/css">
            @yield('css')
        </style>
        <script> var baseUrl = "{{url('/')}}";</script>
    </head>
    <body>
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
                                $customerServiceMenu = App\Engine\Menu::get('customer_service');
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
                        <div class="col-md-12">
                            @yield('breadcrumb')
                        </div>
                        
                        <main class="col-md-9 col-sm-8">
                            @yield('content')
                        </main>
                        <nav class="col-md-3 col-sm-4 sidebar-main" id="cs_sidebar">
                            <div class="recipe-well"> 
                                <h3 class="cs_header">Customer Service</h3>
                                <?php echo $customerServiceMenu; ?>
                            </div>
                            @include('_partials.frontend.sidebar')
                        </nav>
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