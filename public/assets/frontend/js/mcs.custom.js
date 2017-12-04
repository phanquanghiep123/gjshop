window.addEventListener('pageshow', PageShowHandler, false);
window.addEventListener('unload', UnloadHandler, false);
if (typeof getParameterByName === 'undefined' || !$.isFunction(getParameterByName)) {
    function getParameterByName(name, url) {
        if (!url)
            url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results)
            return null;
        if (!results[2])
            return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
}

function PageShowHandler() {
    window.addEventListener('unload', UnloadHandler, false);
}

function UnloadHandler() {
    //enable button here
    window.removeEventListener('unload', UnloadHandler, false);
}

function menu() {
    if ($(window).width() > 992 && 0) {
        $('.nav-wrap #bottom-menu ul li').hover(function () {
            $(this).find('.sub-menu').show().animate({
                'top': '60%',
                'opacity': '1'
            }, 200);
        });

        $('.nav-wrap #bottom-menu ul li').mouseleave(function () {
            $(this).find('.sub-menu').animate({
                'top': '130%',
                'opacity': '0'
            }, 200, function () {
                $(this).hide();
            });
        });
    }
    $('.nav-mobile  ul li i').click(function () {
        $(this).parent().find('.sub-menu').slideToggle();
        $('.nav-mobile ul li i').toggleClass('fa-angle-up');
        $('.nav-mobile ul li i').toggleClass('fa-angle-down');
    });
    $('.toogle-menu').click(function () {
        $('.nav-mobile').slideDown();
        $(this).hide();
        return false;
    });
    $('.nav-mobile .fa-close').click(function () {
        $('.nav-mobile').slideUp();
        $('.toogle-menu').show();
    });
}

$(".tabs-menu a").click(function (event) {
    event.preventDefault();
    $(this).parent().addClass("current");
    $(this).parent().siblings().removeClass("current");
    var tab = $(this).attr("href");
    $(".tab-content").not(tab).css("display", "none");
    $(tab).fadeIn();
});
$('#searchForm a,#searchFormMobile a').click(function () {
    $('#popup-search').fadeIn();
    return false;
});
$('#popup-search .fa-close').click(function () {
    $('#popup-search').fadeOut();
});
menu();


$(window).scroll(function () {
    if ($(window).scrollTop() > 20) {
        // $('header .header-wrap').css('padding-top', '0px');
        // $('header.fixed #bottom-menu > ul > li').css('padding-bottom', '22px');
        $('#bottom-menu > ul > li .sub-menu').css('top', '80%');
        $('header.fixed #logo img').addClass('reduced_logo');

    } else {
        // $('header .header-wrap').css('padding-top', '15px');
        // $('header.fixed #bottom-menu > ul > li').css('padding-bottom', '22px');
        $('#bottom-menu > ul > li .sub-menu').css('top', '82%');
        $('header.fixed #logo img').removeClass('reduced_logo');
    }
});



$.wait = function (callback, seconds) {
    return window.setTimeout(callback, seconds * 500);
};
$.fn.serializefiles = function () {
    var obj = $(this);
    /* ADD FILE TO PARAM AJAX */
    var formData = new FormData();
    $.each($(obj).find("input[type='file']"), function (i, tag) {
        $.each($(tag)[0].files, function (i, file) {
            formData.append(tag.name, file);
        });
    });
    var params = $(obj).serializeArray();
    $.each(params, function (i, val) {
        formData.append(val.name, val.value);
    });
    return formData;
};
$.fn.extend({
    completedType: function (callback,timeout) {
        if(typeof timeout === 'undefined'){
            timeout = 1;
        }
        var _this = $(this);
        _this.on('change keyup', function () {
            var searchValue = $(this).val();
            if (_this.attr("data-lastval") !== searchValue) {
                _this.attr("data-lastval", searchValue);
                $.wait(function () {
                    var lasterSearchValue = _this.val();
                    if (lasterSearchValue === searchValue) {
                        callback.call(_this);
                    } else {
                        // callback.call(_this);
                    }
                }, timeout);
            }
        });
    }
});


var NotificationDisplay = NotificationDisplay || {};

NotificationDisplay.showSuccessMessage = function (message) {
    noty({
        layout: 'topCenter',
        theme: 'relax', // or 'relax'
        type: 'success',
        text: message,
        timeout: 7000,
        animation: {
            open: 'animated fadeInUp', // Animate.css class names
            close: 'animated fadeOutDown', // Animate.css class names
            easing: 'swing', // unavailable - no need
            speed: 500 // unavailable - no need
        }
    });
};


NotificationDisplay.showErrorMessage = function (error) {
    var message = '';
    try {
        var errorsAsJson = JSON.parse(error);
        $.each(errorsAsJson, function (index, value) {
            message += (value + '<br/>');
        });
    } catch (e) {
        message = error;
    }
    noty({
        layout: 'topCenter',
        theme: 'relax', // or 'relax'
        type: 'error',
        text: message,
        timeout: 7000,
        animation: {
            open: 'animated fadeInUp', // Animate.css class names
            close: 'animated fadeOutDown', // Animate.css class names
            easing: 'swing', // unavailable - no need
            speed: 500 // unavailable - no need
        }
    });
};



var Favorite = Favorite || {};

Favorite.addFavorites = function (link) {

    var url = $(link).data('url');
    var id = $(link).data('id');
    $.post(url, {id: id}, function (res) {
        NotificationDisplay.showSuccessMessage(res.message);
        // Favorite.loadFavorites(1);
    }).error(function (res) {
        if (res.status === 422) {
            NotificationDisplay.showErrorMessage(res.responseText);
        }
    });
};

Favorite.deleteFavorite = function (link) {
    var url = $(link).data('url');
    var message = $(link).attr('data-confirm');
    bootbox.confirm(message, function (result) {
        if (result) {
            $.delete(url, [], function (res) {
                NotificationDisplay.showSuccessMessage(res.message);
                Favorite.loadFavorites(1);
                Favorite.loadRecipeFavorites(1);
            });
        }
    });
};





// Article Favorites

Favorite.loadFavorites = function (page) {
    $.get(baseUrl + '/favorite-articles?page=' + page, function (html) {
        $('#my-favorite-articles').html(html);
    });
};
$('#my-favorite-articles').on('click', '.pager li a', function () {
    var link = $(this).attr('href');
    var page = getParameterByName('page', link);
    Favorite.loadFavorites(page);
    return false;
});
$('#user-favorite-articles').on('click', '.pager li a', function () {
    var link = $(this).attr('href');
    var page = getParameterByName('page', link);
    Favorite.loadFavorites(page);
    return false;
});


// Subscriptions 

var Subscriptions = Subscriptions || {};

Subscriptions.AddNotifications = function (form) {
    var url = $(form).attr('action');
    var data = $(form).serialize();
    $.post(url, data, function (res) {
        NotificationDisplay.showSuccessMessage(res.message);
    }).error(function (res) {
        if (res.status === 422) {
            NotificationDisplay.showErrorMessage(res.responseText);
        }
    });
};



Subscriptions.removeSubscription = function (form) {
    $.confirm({
        text: "Are you sure you want to cancel this subscription?",
        confirm: function () {
            var url = $(form).attr('action');
            var data = $(form).serialize();
            $.post(url, data)
                .done(function (res) {
                    $(form).parents('tr').remove();
                    if (!$('#subscriptions-table tbody tr').length) {
                        $('#subscriptions-table tbody').html($('#empty-subscription-tr').html());
                    }
                    NotificationDisplay.showSuccessMessage(res.message);
                })
                .fail(function (res) {

                });
        },
        cancel: function () {
            // nothing to do
        }
    });

};


var Points = Points || {};



Points.convertPoints = function (form) {
    var url = $(form).attr('action');
    var data = $(form).serialize();
    $('#vouchers-table').prepend('<div class="temp"></div>');
    $('#accumulated-points').prepend('<div class="temp"></div>');


    $.post(url, data, function (res) {
        
        $('#vouchers-table').html(res.voucher);
        $('#accumulated-points').html(res.accumulated_points);
        $('#points-total').html(res.points_total);
        $('#vouchers-table').find('div.temp').remove();
        $('#accumulated-points').find('div.temp').remove();
        $('#points-total').find('div.temp').remove();
        document.getElementById("convertPointsForm").reset();

        NotificationDisplay.showSuccessMessage(res.message);
    }).error(function (res) {
        if (res.status === 422) {
            NotificationDisplay.showErrorMessage(res.responseText);
            $('#vouchers-table').find('div.temp').remove();
            $('#accumulated-points').find('div.temp').remove();
        }
    });
};


var Addresses = Addresses || {};
/*
Addresses.removeAddress = function (form) {
    $.confirm({
        text: "Are you sure you want to delete this address?",
        confirm: function () {
            var url = $(form).attr('action');
            var data = $(form).serialize();
            $('#user-addresses').prepend('<div class="temp"></div>');
            $.post(url, data)
                .done(function (res) {
                    $('#user-addresses').html(res.addresses);
                    $('#user-addresses').find('div.temp').remove();
                    NotificationDisplay.showSuccessMessage(res.message);
                })
                .fail(function (res) {
                    NotificationDisplay.showErrorMessage(res.responseText);
                });
        },
        cancel: function () {
            // nothing to do
        }
    });

};
*/

Addresses.removeAddress = function (link) {

    $.confirm({

        text: "Are you sure you want to delete this address?",
        confirm: function () {
            var url = $(link).data('url');
            var id = $(link).data('id');
            $('#user-addresses').prepend('<div class="temp"></div>');
            $.post(url, {id: id}, function (res) {
                    $('#user-addresses').html(res.addresses);
                    $('#user-addresses').find('div.temp').remove();
                    NotificationDisplay.showSuccessMessage(res.message);

            }).error(function (res) {
                if (res.status === 422) {
                    NotificationDisplay.showErrorMessage(res.responseText);
                }
            });
        },
        cancel: function () {
            // nothing to do
        }
    });
};


Addresses.markDefaultAddress = function (link) {
    var url = $(link).data('url');
    var id = $(link).data('id');
    $('#user-addresses').prepend('<div class="temp"></div>');
    $.post(url, {id: id}, function (res) {
            $('#user-addresses').html(res.addresses);
            $('#user-addresses').find('div.temp').remove();
            NotificationDisplay.showSuccessMessage(res.message);

    }).error(function (res) {
        if (res.status === 422) {
            NotificationDisplay.showErrorMessage(res.responseText);
        }
    });
};

// Newsletters 

var Newsletter = Newsletter || {};

Newsletter.Signup = function (form) {
    var url = $(form).attr('action');
    var data = $(form).serialize();
    $.post(url, data, function (res) {
        document.getElementById("newsletterSignup").reset();
        NotificationDisplay.showSuccessMessage(res.message);
    }).error(function (res) {
        if (res.status === 422) {
            NotificationDisplay.showErrorMessage(res.responseText);
        }
    });
};


// ContactForm 

var ContactForm = ContactForm || {};

ContactForm.Contact = function (form) {
    var url = $(form).attr('action');
    var data = $(form).serialize();
    $.post(url, data, function (res) {
        document.getElementById("contactUs").reset();
        NotificationDisplay.showSuccessMessage(res.message);
    }).error(function (res) {
        if (res.status === 422) {
            NotificationDisplay.showErrorMessage(res.responseText);
        }
    });
};



// ReferralForm 

var ReferralForm = ReferralForm || {};

ReferralForm.Add = function (form) {
    var url = $(form).attr('action');
    var data = $(form).serialize();
    $.post(url, data, function (res) {
        document.getElementById("addReferral").reset();
        NotificationDisplay.showSuccessMessage(res.message);
    }).error(function (res) {
        if (res.status === 422) {
            NotificationDisplay.showErrorMessage(res.responseText);
        }
    });
};


// Search 

var Search = Search || {};

Search.submit = function (form) {
    var url = $(form).attr('action');
    var data = $(form).serialize();

    $('#popup-search .content-search').html('<div class="temp"></div>');

    $.get(url, data, function (response) {

        $('#popup-search .search-heading').html(response.heading); 

        if(!response.result){
            $('#popup-search .content-search').html('<div class="search-section col-md-6"><h3>Sorry no results were found!</h3></div>');
        } else {
            $('#popup-search .content-search').html(response.result);
        }
              
    });
};




Search.bindPagination = function () {
    $('#popup-search').on('click', '.content-search .pagination a,.pager a', function () {
        var link = $(this).attr('href');
        var that = this;
        $.get(link, [], function (response) {
            $(that).parents('.search-section').replaceWith(response.result);
        });
        return false;
    });
};


var Review = Review || {};

Review.addReview = function (form) {
    var url = $(form).attr('action');
    var data = $(form).serialize();
    $.post(url, data, function (res) {
        document.getElementById("addReview").reset();
        NotificationDisplay.showSuccessMessage(res.message);
    }).error(function (res) {
        if (res.status === 422) {
            NotificationDisplay.showErrorMessage(res.responseText);
        }
    });
};



var ImageSelector = ImageSelector || {};
ImageSelector.readImage = function (inputId, wrapperDomId) {
    var input = $('#' + inputId);
    var wrapperDom = $('#' + wrapperDomId);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var imgSrc = e.target.result;
            var image = new Image();
            image.src = imgSrc;
            image.className = 'thumbnail';
            image.width = 100;
            wrapperDom.append(image);
            wrapperDom.append('<button onclick="ImageSelector.removeImage(this,' + '"' + inputId + '",' + '"' + wrapperDomId + ')" type="button" class="btn btn-sm btn-danger">X</button>');
        };
        reader.readAsDataURL(input.files[0]);
    }
};

ImageSelector.removeImage = function (button) {
    var inputId = $(button).attr('data-input-id');
    var previewId = $(button).attr('data-preview-id');
    $("#" + inputId).val('');
    $("#" + previewId).html('');
};

ImageSelector.loadPreview = function (dom) {
    var previewId = $(dom).attr('data-preview-id');
    var inputId = $(dom).attr('id');
    var preview = $('#' + previewId);
    var oFReader = new FileReader();
    oFReader.readAsDataURL($(dom)[0].files[0]);
    oFReader.onload = function (oFREvent) {
        var image = new Image();
        image.src = oFREvent.target.result;
        image.className = 'thumbnail';
        image.width = 100;
        preview.html('');
        preview.append(image);
        var onclickContent = 'ImageSelector.removeImage("' + inputId + '",' + '"' + previewId + '"' + ')';
        var onclick = "onclick='" + onclickContent + "'";
        //console.log(onclick);
        preview.append('<button data-input-id="' + inputId + '" data-preview-id="' + previewId + '" onclick="ImageSelector.removeImage(this)" type="button" class="btn btn-sm btn-danger">X</button>');
    };
};



(function ($) {
    $.fn.serializefiles = function () {
        var obj = $(this);
        /* ADD FILE TO PARAM AJAX */
        var formData = new FormData();
        $.each($(obj).find("input[type='file']"), function (i, tag) {
            $.each($(tag)[0].files, function (i, file) {
                formData.append(tag.name, file);
            });
        });
        var params = $(obj).serializeArray();
        $.each(params, function (i, val) {
            formData.append(val.name, val.value);
        });
        return formData;
    };
})(jQuery);

updateProfile = function (form) {
    var url = $(form).attr('action');
    var data = $(form).serializefiles();
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        processData: false,
        contentType: false,
        success: function (res) {
            var submitButton = $("#avatar-user-preview").find("button");
            if (submitButton.length) {
                submitButton.remove();
            }
            $('#password').val('');
            $('#confirm_password').val('');
            NotificationDisplay.showSuccessMessage(res.message);
        },
        error: function (res) {
            if (res.status === 422) {
                NotificationDisplay.showErrorMessage(res.responseText);
            }
        }
    });
};


$(document).ready(function () {
    $('.alert-dismissable').delay(6000).slideUp("slow");
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover({html: true});
    Ladda.bind('.spin[type="submit"]');
    Search.bindPagination();
});


$(window).load(function () {
    // Animate loader off screen
    setTimeout(function () {
        $(".se-pre-con").fadeOut();
    }, 10);
});


(function ($) {
    $.fn.extend({
        rotaterator: function (options) {

            var defaults = {
                fadeSpeed: 500,
                pauseSpeed: 100,
                child: null
            };

            var options = $.extend(defaults, options);

            return this.each(function () {
                var o = options;
                var obj = $(this);
                var items = $(obj.children(), obj);
                items.each(function () {
                    $(this).hide();
                })
                if (!o.child) {
                    var next = $(obj).children(':first');
                } else {
                    var next = o.child;
                }
                $(next).fadeIn(o.fadeSpeed, function () {
                    $(next).delay(o.pauseSpeed).fadeOut(o.fadeSpeed, function () {
                        var next = $(this).next();
                        if (next.length == 0) {
                            next = $(obj).children(':first');
                        }
                        $(obj).rotaterator({child: next, fadeSpeed: o.fadeSpeed, pauseSpeed: o.pauseSpeed});
                    })
                });
            });
        }
    });
})(jQuery);

$(document).ready(function () {
    $('#rotator').rotaterator({fadeSpeed: 500, pauseSpeed: 7000});
    $('#rotator2').rotaterator({fadeSpeed: 500, pauseSpeed: 7000});
    $('#homepage_rotator').rotaterator({fadeSpeed: 500, pauseSpeed: 5000});

    $(".video-link").fancybox({
        'hideOnContentClick': true,
        'titlePosition': 'inside',
        helpers: {
            title: {
                type: 'inside',
                position: 'top'
            }
        }
    });

    $('.share-link').click(function (e) {
        e.preventDefault();
        window.open($(this).attr('href'), 'fbShareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
        return false;
    });

    /*
     $('body').on('click', function (e) {
     //did not click a popover toggle, or icon in popover toggle, or popover
     if ($(e.target).data('toggle') !== 'popover'
     && $(e.target).parents('[data-toggle="popover"]').length === 0
     && $(e.target).parents('.popover.in').length === 0) { 
     $('[data-toggle="popover"]').popover('hide');
     }
     })
     */

    $(document).on('hidden.bs.modal', function (e) {
        var target = $(e.target);
        target.removeData('bs.modal')
            .find(".modal-body").html('');
    });


    /*
     $('html').on('click', function(e) {
     if (typeof $(e.target).data('original-title') == 'undefined' &&
     !$(e.target).parents().is('.popover.in')) {
     $('[data-original-title]').popover('hide');
     }
     });
     */
});

$.ajaxPrefilter(function (options, originalOptions, xhr) { // this will run before each request
    var token = $('meta[name="csrf-token"]').attr('content'); // or _token, whichever you are using

    if (token) {
        return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
    }
});


$(document).ready(function(){

    $('.product-container').hover(function() {
        $(this).find('.purchase_loyalty_points').css('display','inline-block');
    },function(){
        $(this).find('.purchase_loyalty_points').css('display','none');
    });

});

