<?php
    if(config('app.env') === 'production'){
        $lessOrCss = 'css';
    }else{
        $lessOrCss = 'less';
    }
    echo styles([
        'https://fonts.googleapis.com/css?family=Open+Sans:400,300,500,600',
        'http://fonts.googleapis.com/css?family=Great+Vibes',
        'assets/admin/assets/skin/default_skin/css/components.min.css',
        'assets/frontend/fonts/font-awesome/font-awesome.css',
        'assets/frontend/fonts/font.css',
        'assets/frontend/css/mcs.reset.css',
        'assets/frontend/css/bootstrap.min.css',
        'assets/frontend/css/responsive.css',
        'assets/frontend/plugins/bxslider/jquery.bxslider.css',
        'assets/frontend/plugins/fancybox/jquery.fancybox.css',
        'assets/frontend/plugins/animate.css',
        'assets/frontend/plugins/ladda/ladda.min.css',
        'assets/frontend/css/style.css',
        'modules/shop/plugins/star-rating/star-rating.css',
        'assets/frontend/css/custom.'.$lessOrCss,
        'modules/shop/css/styles.'.$lessOrCss,
        'assets/admin/vendor/plugins/simple-line-icons/simple-line-icons.min.css',
        'assets/admin/assets/skin/default_skin/css/plugins.min.css',
        'assets/frontend/plugins/summernote/css/summernote.css',
        'assets/frontend/plugins/datatable/css/dataTables.bootstrap.css',
        'assets/frontend/plugins/jqueryFileUpload/css/jquery.fileupload.css',
        'assets/frontend/plugins/jqueryFileUpload/css/jquery.fileupload-ui.css',
        'assets/frontend/plugins/jqueryUI/jquery-ui.css',
        'assets/frontend/plugins/jqueryUI/jquery-ui.theme.css',
        'assets/frontend/plugins/jqueryUI/jquery-ui-timepicker-addon.css',

    ]);   
?>
<meta name="p:domain_verify" content="0014ac0eadac08a261d3b079c6a326b6"/>
@if($lessOrCss == 'less')
<script type="text/javascript" src="{{asset('/assets/frontend/js/less.min.js') }}"></script>
@endif