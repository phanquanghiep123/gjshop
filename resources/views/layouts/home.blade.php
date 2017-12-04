<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <!-- Meta tag for responsive -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Gabriel Job | Limited Edition Art & Accessories</title>
        <!-- Good meta tags for SEO -->
        <meta name="description" content="{{ $settings->meta_description }}" />
        <meta name="keywords" content="{{ $settings->meta_keywords }}" />
        <meta name="title" content="@yield('meta_title')" />
        <meta name="author" content="ambience">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('/assets/frontend/images/favicon.png')}}" />

        @include('_partials.frontend.styles')
        @yield('styles')
        <script> var baseUrl = "{{url('/')}}";</script>
    </head>
    <body class="homepage">
        <div class="se-pre-con"></div>

        @include('_partials.frontend.popup_search')

        <header class="fixed">    
            <div class="header-wrap container">
                <div class="logo_holder">
                    <a href="{!! url('/') !!}" id="logo">
                        <img src="{{asset('/assets/frontend/images/logo.png')}}" alt="=Nurtured For Living Logo" />
                    </a>  

                </div>
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
        <section id="home-content">
            <div class="slider-wrapper">
                <div id="banner-slider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach( $slides as $slide)

                        
                            <div class="item {{ $slide->order == 1 ? 'active' : ''}}" style="background: url('../{{ $slide->image }}') top center {{ $slide->bg_colour }} ;">
                                <a href="{!! $slide->slide_link !!}">
                                    <p class="align-center no-margin-bottom"><img src="{!! asset('/assets/frontend/images/filler.png') !!}"></p>
                                    <div class="carousel-caption {!! $slide->caption_position !!}" style="color:{{$slide->caption_colour}}">
                                        {!! $slide->caption !!}
                                    </div>
                                </a>
                            </div>
                        

                        @endforeach
                    </div>
                    @if(count($slides) > 1)
                        <a class="left carousel-control" href="#banner-slider" role="" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#banner-slider" role="" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    @endif
                </div>
            </div>
            @include('_partials.frontend.three_homepage_sections')
        </section>
        <section id="footer-area">
            <div class="container">
                @include('_partials.frontend.footer')
            </div>
        </section>
        @include('_partials.frontend.scripts')

    </body>
</html>