<?php
echo scripts([
    'assets/frontend/js/jquery-2.2.1.js',
    'assets/frontend/js/bootstrap.js',
    'assets/frontend/js/fancybox/jquery.fancybox.pack.js',
    'assets/frontend/js/fancybox/jquery.fancybox.media.js',
    'assets/frontend/js/mcs.custom.js',
    'assets/frontend/js/jquery.imagesloaded.min.js',
    'assets/frontend/js/jquery-imagefill.js',
    'assets/frontend/plugins/bxslider/jquery.bxslider.js',
    'assets/frontend/plugins/fancybox/jquery.fancybox.js',
    'assets/frontend/plugins/noty/packaged/jquery.noty.packaged.min.js',
    'assets/frontend/plugins/jquery.validate.js',
    'assets/frontend/plugins/ladda/spin.min.js',
    'assets/frontend/plugins/ladda/ladda.min.js',
    'assets/frontend/plugins/jquery.validate.js',
    'modules/shop/plugins/star-rating/star-rating.js',
    'assets/frontend/plugins/summernote/js/summernote.js',
    'assets/frontend/plugins/datatable/js/jquery.dataTables.js',
    'assets/frontend/plugins/datatable/js/dataTables.bootstrap.js',
    'assets/frontend/plugins/bootbox.js',
    'assets/frontend/plugins/jqueryUI/query.ui.widget.js',
    'assets/frontend/plugins/tmpl.js',
    'assets/frontend/plugins/vue.js',
    'assets/frontend/plugins/blueimpGallery/js/blueimp-gallery.js',
    'assets/frontend/plugins/blueimpLoadImage/js/load-image.all.min.js',
    'assets/frontend/plugins/jqueryFileUpload/js/jquery.fileupload.js',
    'assets/frontend/plugins/jqueryFileUpload/js/jquery.iframe-transport.js',
    'assets/frontend/plugins/jqueryFileUpload/js/jquery.fileupload-process.js',
    'assets/frontend/plugins/jqueryFileUpload/js/jquery.fileupload-image.js',
    'assets/frontend/plugins/jqueryFileUpload/js/jquery.fileupload-validate.js',
    'assets/frontend/plugins/jqueryFileUpload/js/jquery.fileupload-ui.js',
    'assets/frontend/plugins/jqueryValidator/jquery.validate.js',
    'assets/frontend/plugins/jqueryValidator/additional-methods.js',
    'assets/frontend/plugins/jQuery.print.js',
    'assets/frontend/plugins/jqueryConfirm/jquery.confirm.min.js',
    'modules/shop/js/app.js',
    'assets/frontend/js/features.js',
]);

?>

<!-- Go to www.addthis.com/dashboard to customize your tools>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5751b3efe369ad02"></script-->

<!--script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "a2f0aa0d-8297-4306-a4c2-94975d855820", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script-->

@if(config('shop.currency_baseon_region') && !\Session::get('shop.continent') && !\Cookie::get('continent')))
<script type="text/javascript">
    $('#choose-shop-modal').modal('show');
</script>
@endif
<script type="text/javascript">


    function PopupCenter(url, title, w, h) {
        // Fixes dual-screen position                         Most browsers      Firefox
        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

        var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        var left = ((width / 2) - (w / 2)) + dualScreenLeft;
        var top = ((height / 2) - (h / 2)) + dualScreenTop;
        var newWindow = window.open(url, title, 'scrollbars=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left + ',toolbar=0, status=0');

        // Puts focus on the newWindow
        if (window.focus) {
            newWindow.focus();
        }
    }


    $.validator.addMethod('filesize', function (value, element, param) {
        // param = size (en bytes) 
        // element = element to validate (<input>)
        // value = value of the element (file name)
        //console.log(element.files[0].size);
        //console.log(param);
        return this.optional(element) || (element.files[0].size <= param);
    });
    $(document).ready(function () {

        $('.simple-editor').summernote({
            height: 300,
            minHeight: null,
            maxHeight: null,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']]
            ]
        });

        $('table.datatable').each(function () {
            var self = this;
            var aoColumnDefs = [];

            var bSearchable = null;
            if ($(self).find('tr th[searchable]').length) {
                bSearchable = {};
                bSearchable.bSearchable = false;
                bSearchable.aTargets = [];
                $(self).find('tr th').each(function (index, th) {
                    if (typeof $(this).attr('searchable') === 'undefined' || $(this).attr('searchable') === "false") {
                        bSearchable.aTargets.push(index);
                    }
                });
                ;
            }
            if ($(self).find('tr th[sortable]').length) {
                var bSortable = {orderable: false, targets: []};
                $(self).find('tr th').each(function (index, th) {
                    if (typeof $(this).attr('sortable') === 'undefined' || $(this).attr('sortable') === "false") {
                        bSortable.targets.push(index);
                    }
                });
                aoColumnDefs.push(bSortable);
            }
            aoColumnDefs.push(bSearchable);

            // Clear null element of aoColumnDefs 
            aoColumnDefs = aoColumnDefs.filter(function (item) {
                return item !== null;
            });

            //console.log(aoColumnDefs);

            $(self).DataTable({
                "aoColumnDefs": aoColumnDefs
            });
        });


        $('#tableAllScripts').dataTable({
            "iDisplayLength": 10000,
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                var settings = this.fnSettings();
                var str = settings.oPreviousSearch.sSearch;
                $('td', nRow).each(function (i) {
                    this.innerHTML = aData[i].replace(new RegExp(str, 'i'), function (matched) {
                        return "" + matched + "";
                    });
                });
                return nRow;
            },
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [0]},
                {"bSearchable": false, "aTargets": [0]}
            ],
        });

        window.hasActiveMenu = false;
        var linkClass = '<?php echo App\Engine\Menu::getCurrentPageClassForActiveMenu(); ?>';
        var mapLinks = function () {
            return {
                products: ['shop']
            };
        };
        var checkMapLinks = function (link) {
            var result = false;
            $.each(mapLinks(), function (value, key) {
                //console.log('start check ' + key);
                //console.log('check ' + key + ' = ' + linkClass);
                if (key == linkClass) {
                    //console.log("check has link " + link);
                    if (value.indexOf(link) !== -1) {
                        result = true;
                        return;
                    }
                }
            });
            return result;
        };
        $('#bottom-menu li a').each(function () {
            if (!window.hasActiveMenu && ($(this).hasClass(linkClass) || checkMapLinks($(this).attr('class')))) {
                $(this).parent('li').addClass('active');
                window.hasActiveMenu = true;
            }
        });

    });
</script>

