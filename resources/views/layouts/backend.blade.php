<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Gabriel Job | Administration | @yield('title') </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <?php if (env('APP_ENV') != 'local'): ?>
            <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <?php endif; ?>

        <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600'>
        <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/vendor/plugins/datatables/media/css/dataTables.bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/vendor/plugins/datatables/media/css/dataTables.plugins.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/vendor/plugins/colorbox/colorbox.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/vendor/plugins/summernote/summernote.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/vendor/plugins/summernote/summernote-bs3.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/assets/skin/default_skin/css/theme.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/assets/admin-tools/admin-forms/css/admin-forms.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/assets/skin/default_skin/css/custom.css')}}">
        <link rel="stylesheet/less" type="text/css" href="{{asset('/modules/media/css/media.less')}}">
        @yield('styles')

        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="{{asset('/assets/frontend/images/favicon.png')}}" /> 
        <script type="text/javascript">
            var baseUrl = "{{url('/')}}";
        </script>

        <script type="text/javascript" src="{{asset('/assets/frontend/js/less.min.js') }}"></script>
    </head>
    <!-- END HEAD -->

    <body class="dashboard-page sb-l-o sb-r-c">

        <!--  
          <body> Helper Classes: 
        
          '.sb-l-o' - Sets Left Sidebar to "open"
          '.sb-l-m' - Sets Left Sidebar to "minified"
          '.sb-l-c' - Sets Left Sidebar to "closed"
        
          '.sb-r-o' - Sets Right Sidebar to "open"
          '.sb-r-c' - Sets Right Sidebar to "closed"
        
         Example: <body class="example-page sb-l-o sb-r-c">
         Results: Sidebar left Open, Sidebar right Closed
        
        
          < For Demo Purposes - Theme Settings Pane -->
        <div id="skin-toolbox" class="no-print">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-icon">
                        <i class="fa fa-gear text-primary"></i>
                    </span>
                    <span class="panel-title"> Theme Options</span>
                </div>
                <div class="panel-body pn">
                    <ul class="nav nav-list nav-list-sm pl15 pt10" role="tablist">
                        <li class="active">
                            <a href="#toolbox-header" role="tab" data-toggle="tab">Navbar</a>
                        </li>
                        <li>
                            <a href="#toolbox-sidebar" role="tab" data-toggle="tab">Sidebar</a>
                        </li>
                        <li>
                            <a href="#toolbox-settings" role="tab" data-toggle="tab">Misc</a>
                        </li>
                    </ul>
                    <div class="tab-content p20 ptn pb15">
                        <div role="tabpanel" class="tab-pane active" id="toolbox-header">
                            <form id="toolbox-header-skin">
                                <h4 class="mv20">Header Skins</h4>
                                <div class="skin-toolbox-swatches">
                                    <div class="checkbox-custom checkbox-disabled fill mb5">
                                        <input type="radio" name="headerSkin" id="headerSkin8" checked value="">
                                        <label for="headerSkin8">Light</label>
                                    </div>
                                    <div class="checkbox-custom fill checkbox-primary mb5">
                                        <input type="radio" name="headerSkin" id="headerSkin1" value="bg-primary">
                                        <label for="headerSkin1">Primary</label>
                                    </div>
                                    <div class="checkbox-custom fill checkbox-info mb5">
                                        <input type="radio" name="headerSkin" id="headerSkin3" value="bg-info">
                                        <label for="headerSkin3">Info</label>
                                    </div>
                                    <div class="checkbox-custom fill checkbox-warning mb5">
                                        <input type="radio" name="headerSkin" id="headerSkin4" value="bg-warning">
                                        <label for="headerSkin4">Warning</label>
                                    </div>
                                    <div class="checkbox-custom fill checkbox-danger mb5">
                                        <input type="radio" name="headerSkin" id="headerSkin5" value="bg-danger">
                                        <label for="headerSkin5">Danger</label>
                                    </div>
                                    <div class="checkbox-custom fill checkbox-alert mb5">
                                        <input type="radio" name="headerSkin" id="headerSkin6" value="bg-alert">
                                        <label for="headerSkin6">Alert</label>
                                    </div>
                                    <div class="checkbox-custom fill checkbox-system mb5">
                                        <input type="radio" name="headerSkin" id="headerSkin7" value="bg-system">
                                        <label for="headerSkin7">System</label>
                                    </div>
                                    <div class="checkbox-custom fill checkbox-success mb5">
                                        <input type="radio" name="headerSkin" id="headerSkin2" value="bg-success">
                                        <label for="headerSkin2">Success</label>
                                    </div>
                                    <div class="checkbox-custom fill mb5">
                                        <input type="radio" name="headerSkin" id="headerSkin9" value="bg-dark">
                                        <label for="headerSkin9">Dark</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="toolbox-sidebar">
                            <form id="toolbox-sidebar-skin">
                                <h4 class="mv20">Sidebar Skins</h4>
                                <div class="skin-toolbox-swatches">
                                    <div class="checkbox-custom fill mb5">
                                        <input type="radio" name="sidebarSkin" checked id="sidebarSkin3" value="">
                                        <label for="sidebarSkin3">Dark</label>
                                    </div>
                                    <div class="checkbox-custom fill checkbox-disabled mb5">
                                        <input type="radio" name="sidebarSkin" id="sidebarSkin1" value="sidebar-light">
                                        <label for="sidebarSkin1">Light</label>
                                    </div>
                                    <div class="checkbox-custom fill checkbox-light mb5">
                                        <input type="radio" name="sidebarSkin" id="sidebarSkin2" value="sidebar-light light">
                                        <label for="sidebarSkin2">Lighter</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="toolbox-settings">
                            <form id="toolbox-settings-misc">
                                <h4 class="mv20 mtn">Layout Options</h4>
                                <div class="form-group">
                                    <div class="checkbox-custom fill mb5">
                                        <input type="checkbox" checked="" id="header-option">
                                        <label for="header-option">Fixed Header</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox-custom fill mb5">
                                        <input type="checkbox" checked="" id="sidebar-option">
                                        <label for="sidebar-option">Fixed Sidebar</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox-custom fill mb5">
                                        <input type="checkbox" id="breadcrumb-option">
                                        <label for="breadcrumb-option">Fixed Breadcrumbs</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox-custom fill mb5">
                                        <input type="checkbox" id="breadcrumb-hidden">
                                        <label for="breadcrumb-hidden">Hide Breadcrumbs</label>
                                    </div>
                                </div>
                                <h4 class="mv20">Layout Options</h4>
                                <div class="form-group">
                                    <div class="radio-custom mb5">
                                        <input type="radio" id="fullwidth-option" checked name="layout-option">
                                        <label for="fullwidth-option">Fullwidth Layout</label>
                                    </div>
                                </div>
                                <div class="form-group mb20">
                                    <div class="radio-custom radio-disabled mb5">
                                        <input type="radio" id="boxed-option" name="layout-option" disabled>
                                        <label for="boxed-option">Boxed Layout
                                            <b class="text-muted">(Coming Soon)</b>
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="form-group mn br-t p15">
                        <a href="#" id="clearLocalStorage" class="btn btn-primary btn-block pb10 pt10">Clear LocalStorage</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Theme Settings Pane -->

        <!-- Start: Main -->
        <div id="main">

            <!-- 
               ".navbar" Helper Classes: 
        
               * Positioning Classes: 
                '.navbar-static-top' - Static top positioned navbar
                '.navbar-static-top' - Fixed top positioned navbar
        
               * Available Skin Classes:
                 .bg-dark    .bg-primary   .bg-success   
                 .bg-info    .bg-warning   .bg-danger
                 .bg-alert   .bg-system 
        
              Example: <header class="navbar navbar-fixed-top bg-primary">
              Results: Fixed top navbar with blue background 
        
        
            < Start: Header -->
            <header class="navbar navbar-fixed-top no-print">
                <div class="navbar-branding">
                    <a class="navbar-brand" href="{!! route('dashboard') !!}">
                        <b>Admin</b>Designs
                    </a>
                    <span id="toggle_sidemenu_l" class="ad ad-lines"></span>
                </div>
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a class="sidebar-menu-toggle" href="#">
                            <span class="ad ad-ruby fs18"></span>
                        </a>
                    </li>
                    <li>
                        <a class="topbar-menu-toggle" href="#">
                            <span class="ad ad-wand fs16"></span>
                        </a>
                    </li>
                    <li class="hidden-xs">
                        <a class="request-fullscreen toggle-active" href="#">
                            <span class="ad ad-screen-full fs18"></span>
                        </a>
                    </li>
                </ul>
                <form class="navbar-form navbar-left navbar-search" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search..." value="Search...">
                    </div>
                </form>
                
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="ad ad-radio-tower fs18"></span>
                        </a>
                        <ul class="dropdown-menu media-list w350 animated animated-shorter fadeIn" role="menu">
                            <li class="dropdown-header">
                                <span class="dropdown-title"> Notifications</span>
                                <span class="label label-warning">12</span>
                            </li>
                            <li class="media">
                                <a class="media-left" href="#"> <img src="" class="mw40" alt="avatar"> </a>
                                <div class="media-body">
                                    <h5 class="media-heading">Article
                                        <small class="text-muted">- 08/16/22</small>
                                    </h5> Last Updated 36 days ago by
                                    <a class="text-system" href="#"> Max </a>
                                </div>
                            </li>
                            <li class="media">
                                <a class="media-left" href="#"> <img src="" class="mw40" alt="avatar"> </a>
                                <div class="media-body">
                                    <h5 class="media-heading mv5">Article
                                        <small> - 08/16/22</small>
                                    </h5>
                                    Last Updated 36 days ago by
                                    <a class="text-system" href="#"> Max </a>
                                </div>
                            </li>
                            <li class="media">
                                <a class="media-left" href="#"> <img src="" class="mw40" alt="avatar"> </a>
                                <div class="media-body">
                                    <h5 class="media-heading">Article
                                        <small class="text-muted">- 08/16/22</small>
                                    </h5> Last Updated 36 days ago by
                                    <a class="text-system" href="#"> Max </a>
                                </div>
                            </li>
                            <li class="media">
                                <a class="media-left" href="#"> <img src="" class="mw40" alt="avatar"> </a>
                                <div class="media-body">
                                    <h5 class="media-heading mv5">Article
                                        <small class="text-muted">- 08/16/22</small>
                                    </h5> Last Updated 36 days ago by
                                    <a class="text-system" href="#"> Max </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="flag-xs flag-us"></span> US
                        </a>
                        <ul class="dropdown-menu pv5 animated animated-short flipInX" role="menu">
                            <li>
                                <a href="javascript:void(0);">
                                    <span class="flag-xs flag-in mr10"></span> Hindu </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span class="flag-xs flag-tr mr10"></span> Turkish </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span class="flag-xs flag-es mr10"></span> Spanish </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-divider hidden-xs">
                        <i class="fa fa-circle"></i>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle fw600 p15" data-toggle="dropdown"> <img src="{{ asset('assets/admin/assets/img/avatars/1.jpg') }}" alt="avatar" class="mw30 br64 mr15"> {{ @$loggedUser->username }}
                            <span class="caret caret-tp hidden-xs"></span>
                        </a>
                        <ul class="dropdown-menu list-group dropdown-persist w250" role="menu">
                            <li class="dropdown-header clearfix">
                                <div class="pull-left ml10">
                                    <select id="user-status">
                                        <optgroup label="Current Status:">
                                            <option value="1-1">Away</option>
                                            <option value="1-2">Offline</option>
                                            <option value="1-3" selected="selected">Online</option>
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="pull-right mr10">
                                    <select id="user-role">
                                        <optgroup label="Logged in As:">
                                            <option value="1-1">Client</option>
                                            <option value="1-2">Editor</option>
                                            <option value="1-3" selected="selected">Admin</option>
                                        </optgroup>
                                    </select>
                                </div>

                            </li>
                            <li class="list-group-item">
                                <a href="#" class="animated animated-short fadeInUp">
                                    <span class="fa fa-envelope"></span> Messages
                                    <span class="label label-warning">2</span>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="animated animated-short fadeInUp">
                                    <span class="fa fa-user"></span> Friends
                                    <span class="label label-warning">6</span>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="animated animated-short fadeInUp">
                                    <span class="fa fa-gear"></span> Account Settings </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="animated animated-short fadeInUp">
                                    <span class="fa fa-bell"></span> Activity  </a>
                            </li>
                            <li class="dropdown-footer">
                                <a href="{!! url('logout') !!}" class="">
                                    <span class="fa fa-power-off pr5"></span> Logout </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            
            </header>
            <!-- End: Header -->


            <!-- Start: Sidebar Left -->
            <aside id="sidebar_left" class="nano nano-primary affix no-print">

                <!-- Start: Sidebar Left Content -->
                <div class="sidebar-left-content nano-content">

                    <!-- Start: Sidebar Header -->
                    <header class="sidebar-header">

                        <!-- Sidebar Widget - Menu (Slidedown) -->
                        <div class="sidebar-widget menu-widget">
                            <div class="row text-center mbn">
                                <div class="col-xs-4">
                                    <a href="{!! route('dashboard') !!}" class="text-primary" data-toggle="tooltip" data-placement="top" title="Dashboard">
                                        <span class="glyphicon glyphicon-home"></span>
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="{!! url('logout') !!}" class="text-info" data-toggle="tooltip" data-placement="top" title="Messages">
                                        <span class="glyphicon glyphicon-log-out"></span>
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="pages_profile.html" class="text-alert" data-toggle="tooltip" data-placement="top" title="Tasks">
                                        <span class="glyphicon glyphicon-bell"></span>
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="pages_timeline.html" class="text-system" data-toggle="tooltip" data-placement="top" title="Activity">
                                        <span class="fa fa-desktop"></span>
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="pages_profile.html" class="text-danger" data-toggle="tooltip" data-placement="top" title="Settings">
                                        <span class="fa fa-gears"></span>
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="pages_gallery.html" class="text-warning" data-toggle="tooltip" data-placement="top" title="Cron Jobs">
                                        <span class="fa fa-flask"></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </header>
                    <!-- End: Sidebar Header -->



                    @include('_partials.backend.menu')


                    <!-- Start: Sidebar Collapse Button -->
                    <div class="sidebar-toggle-mini">
                        <a href="#">
                            <span class="fa fa-sign-out"></span>
                        </a>
                    </div>
                    <!-- End: Sidebar Collapse Button -->

                </div>
                <!-- End: Sidebar Left Content -->

            </aside>
            <!-- End: Sidebar Left -->

            <!-- Start: Content-Wrapper -->
            <section id="content_wrapper">

                <!-- Start: Topbar-Dropdown -->
                <div id="topbar-dropmenu">
                    <div class="topbar-menu row">
                        <div class="col-xs-4 col-sm-2">
                            <a href="#" class="metro-tile">
                                <span class="glyphicon glyphicon-inbox"></span>
                                <span class="metro-title">Messages</span>
                            </a>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                            <a href="#" class="metro-tile">
                                <span class="glyphicon glyphicon-user"></span>
                                <span class="metro-title">Users</span>
                            </a>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                            <a href="#" class="metro-tile">
                                <span class="glyphicon glyphicon-headphones"></span>
                                <span class="metro-title">Support</span>
                            </a>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                            <a href="#" class="metro-tile">
                                <span class="fa fa-gears"></span>
                                <span class="metro-title">Settings</span>
                            </a>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                            <a href="#" class="metro-tile">
                                <span class="glyphicon glyphicon-facetime-video"></span>
                                <span class="metro-title">Videos</span>
                            </a>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                            <a href="#" class="metro-tile">
                                <span class="glyphicon glyphicon-picture"></span>
                                <span class="metro-title">Pictures</span>
                            </a>
                        </div>
                    </div>
                </div>
         

                <header id="topbar" class="no-print">
                    <div class="topbar-left">
                        @yield('breadcrumb')
                    </div>
                    <div class="topbar-right">
                        @yield('breadcrumb_right')
                </header>
          

                <section id="content" class="animated fadeIn">
                    <div class="row">
                        <div class="col-md-11">
                            <div id="notifications-wrapper">
                                @include('_partials.backend.notifications')
                            </div>
                        </div>
                    </div>
                    @yield('content')
                </section>


                <footer id="content-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <span class="footer-legal">© {{date('Y')}} Nurtured For Living</span>
                        </div>
                    </div>
                </footer>

            </section>


            <!-- Start: Right Sidebar -->
            <aside id="sidebar_right" class="nano affix">

                <!-- Start: Sidebar Right Content -->
                <div class="sidebar-right-content nano-content">

                    <div class="tab-block sidebar-block br-n">
                        <ul class="nav nav-tabs tabs-border nav-justified hidden">
                            <li class="active">
                                <a href="#sidebar-right-tab1" data-toggle="tab">Tab 1</a>
                            </li>
                            <li>
                                <a href="#sidebar-right-tab2" data-toggle="tab">Tab 2</a>
                            </li>
                            <li>
                                <a href="#sidebar-right-tab3" data-toggle="tab">Tab 3</a>
                            </li>
                        </ul>
                        <div class="tab-content br-n">
                           
                            <div id="sidebar-right-tab2" class="tab-pane"></div>
                            <div id="sidebar-right-tab3" class="tab-pane"></div>
                        </div>
                        <!-- end: .tab-content -->
                    </div>

                </div>
            </aside>
            <!-- End: Right Sidebar -->

        </div>
        <!-- End: Main -->

        @include('media::modal')

        <!-- BEGIN: PAGE SCRIPTS -->



        <!-- jQuery -->
        <script src="{{ asset('/assets/admin/vendor/jquery/jquery-1.11.1.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/vendor/jquery/jquery_ui/jquery-ui.min.js') }}"></script>

        @yield('scripts')




        <!-- HighCharts Plugin -->
        <script src="{{ asset('/assets/admin/vendor/plugins/highcharts/highcharts.js') }}"></script>

        <!-- Sparklines Plugin -->
        <script src="{{ asset('/assets/admin/vendor/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

        <!-- Simple Circles Plugin -->
        <script src="{{ asset('/assets/admin/vendor/plugins/circles/circles.js') }}"></script>

        <!-- JvectorMap Plugin + US Map (more maps in plugin/assets folder) -->
        <script src="{{ asset('/assets/admin/vendor/plugins/datatables/media/js/jquery.dataTables.js')}}"></script>
        <script src="{{ asset('/assets/admin/vendor/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js')}}"></script>
        <script src="{{ asset('/assets/admin/vendor/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js')}}"></script>
        <script src="{{ asset('/assets/admin/vendor/plugins/datatables/media/js/dataTables.bootstrap.js')}}"></script>
        <script src="{{ asset('/assets/admin/vendor/plugins/jvectormap/jquery.jvectormap.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/vendor/plugins/jvectormap/assets/jquery-jvectormap-us-lcc-en.js') }}"></script> 
        <script src="{{ asset('/assets/admin/vendor/plugins/tagsinput/tagsinput.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/vendor/plugins/sortable/jquery.sortable.js')}}"></script>


        <script src="{{ asset('/assets/admin/vendor/plugins/summernote/summernote.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/vendor/plugins/colorbox/jquery.colorbox.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/assets/admin/vendor/plugins/magnific/jquery.magnific-popup.js') }}"></script>
        <!-- Theme Javascript -->
        <script src="{{ asset('/assets/admin/assets/js/utility/utility.js') }}"></script>
        <script src="{{ asset('/assets/admin/assets/js/demo/demo.js') }}"></script>
        <script src="{{ asset('/assets/admin/assets/js/main.js') }}"></script>
        <script src="{{ asset('/packages/barryvdh/elfinder/js/standalonepopup.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/modules/media/js/vue.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/modules/media/js/SimpleAjaxUploader.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/modules/media/js/media.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/modules/media/js/summernote.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/assets/admin/assets/js/features.js')}}" type="text/javascript"></script>

        @yield('plugins')

        <!-- Widget Javascript -->
        <script src="{{ asset('/assets/admin/assets/js/demo/widgets.js') }}"></script>

        <script type="text/javascript">

            jQuery(document).ready(function () {

                "use strict";

                // Init Theme Core      
                Core.init();

                // Init Demo JS
                Demo.init();

                // Init Widget Demo JS
                // demoHighCharts.init();

                // Because we are using Admin Panels we use the OnFinish 
                // callback to activate the demoWidgets. It's smoother if
                // we let the panels be moved and organized before 
                // filling them with content from various plugins

                // Init plugins used on this page
                // HighCharts, JvectorMap, Admin Panels

                // Init Admin Panels on widgets inside the ".admin-panels" container
                $('.admin-panels').adminpanel({
                    grid: '.admin-grid',
                    draggable: true,
                    preserveGrid: true,
                    mobile: false,
                    onStart: function () {
                        // Do something before AdminPanels runs
                    },
                    onFinish: function () {
                        $('.admin-panels').addClass('animated fadeIn').removeClass('fade-onload');

                        // Init the rest of the plugins now that the panels
                        // have had a chance to be moved and organized.
                        // It's less taxing to organize empty panels
                        demoHighCharts.init();
                        runVectorMaps(); // function below
                    },
                    onSave: function () {
                        $(window).trigger('resize');
                    }
                });

                // Widget VectorMap
                function runVectorMaps() {

                    // Jvector Map Plugin
                    var runJvectorMap = function () {
                        // Data set
                        var mapData = [900, 700, 350, 500];
                        // Init Jvector Map
                        $('#WidgetMap').vectorMap({
                            map: 'us_lcc_en',
                            //regionsSelectable: true,
                            backgroundColor: 'transparent',
                            series: {
                                markers: [{
                                        attribute: 'r',
                                        scale: [3, 7],
                                        values: mapData
                                    }]
                            },
                            regionStyle: {
                                initial: {
                                    fill: '#E5E5E5'
                                },
                                hover: {
                                    "fill-opacity": 0.3
                                }
                            },
                            markers: [{
                                    latLng: [37.78, -122.41],
                                    name: 'San Francisco,CA'
                                }, {
                                    latLng: [36.73, -103.98],
                                    name: 'Texas,TX'
                                }, {
                                    latLng: [38.62, -90.19],
                                    name: 'St. Louis,MO'
                                }, {
                                    latLng: [40.67, -73.94],
                                    name: 'New York City,NY'
                                }],
                            markerStyle: {
                                initial: {
                                    fill: '#a288d5',
                                    stroke: '#b49ae0',
                                    "fill-opacity": 1,
                                    "stroke-width": 10,
                                    "stroke-opacity": 0.3,
                                    r: 3
                                },
                                hover: {
                                    stroke: 'black',
                                    "stroke-width": 2
                                },
                                selected: {
                                    fill: 'blue'
                                },
                                selectedHover: {}
                            },
                        });
                        // Manual code to alter the Vector map plugin to 
                        // allow for individual coloring of countries
                        var states = ['US-CA', 'US-TX', 'US-MO',
                            'US-NY'
                        ];
                        var colors = [bgWarningLr, bgPrimaryLr, bgInfoLr, bgAlertLr];
                        var colors2 = [bgWarning, bgPrimary, bgInfo, bgAlert];
                        $.each(states, function (i, e) {
                            $("#WidgetMap path[data-code=" + e + "]").css({
                                fill: colors[i]
                            });
                        });
                        $('#WidgetMap').find('.jvectormap-marker')
                                .each(function (i, e) {
                                    $(e).css({
                                        fill: colors2[i],
                                        stroke: colors2[i]
                                    });
                                });
                    }

                    if ($('#WidgetMap').length) {
                        runJvectorMap();
                    }
                }



                // DATA TABLES

                $('.datatable').dataTable({
                    "aoColumnDefs": [{
                            'bSortable': false,
                            'aTargets': [-1]
                        }],
                    "iDisplayLength": 10,
                    "aLengthMenu": [
                        [5, 10, 15, 25, 50, 100, -1],
                        [5, 10, 15, 25, 50, 100, "All"]
                    ],
                    "sDom": '<"dt-panelmenu clearfix"lfr>t<"dt-panelfooter clearfix"ip>',
                    "oTableTools": {
                        "sSwfPath": "vendor/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
                    }
                });


                // MISC DATATABLE HELPER FUNCTIONS

                // Add Placeholder text to datatables filter bar
                $('.dataTables_filter input').attr("placeholder", "Search...");

                // Turn off automatic editor initilization.
                // Used to prevent conflictions with multiple text 
                // editors being displayed on the same page.
                //                CKEDITOR.disableAutoInline = true;
                //
                //                // Init Ckeditor
                //                CKEDITOR.replace('ckeditor', {
                //                    height: 250,
                //                    on: {
                //                        instanceReady: function (evt) {
                //                            $('.cke').addClass('admin-skin cke-hide-bottom');
                //                        }
                //                    },
                //                });

                $('.summernote').summernote({
                    // height: 500,
                    minHeight: 200,
                    maxHeight: 500,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear','link']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['insert', ['picture','mediadiag']],
                        ['misc',['codeview','fullscreen','undo','redo']]
                    ]
                });

                Menu.bindSortable();

                @yield('js')

            });
        </script>

        @yield('scripts')

        <!-- END: PAGE SCRIPTS -->

    </body>

</html>
