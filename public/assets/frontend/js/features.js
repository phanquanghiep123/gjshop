jQuery.each(["put", "delete"], function (i, method) {
    jQuery[ method ] = function (url, data, callback, type) {
        if (jQuery.isFunction(data)) {
            type = type || callback;
            callback = data;
            data = undefined;
        }

        return jQuery.ajax({
            url: url,
            type: method,
            dataType: type,
            data: data,
            success: callback
        });
    };
});
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.ajax({
  statusCode: {
    401: function() {
      $('#login-modal').modal('show');
    },
    500: function() {
      
    }
  }
});

var ArticleSearching = {};

ArticleSearching.bindSearch = function () {
    $('#articles-search-btn').completedType(function () {
        var search = $(this).val();
        if (search !== "") {
            $('#articles-search-result').show();
            var url = $(this).data('url');
            url += '?search=' + search;
            $.get(url, function (html) {
                if ($.trim(html)) {
                    $('#articles-search-result').html(html);
                } else {
                    $('#articles-search-result').html('');
                    $('#articles-search-result').hide();
                }
            });
        } else {
            $('#articles-search-result').html('');
            $('#articles-search-result').hide();
        }
    });
};

var Auth = Auth || {};

Auth.login = function(form){
    var url = $(form).attr('action');
    var data = $(form).serialize();
    $(form).find('[type="submit"]').attr('disabled','disabled');
    $.post(url,data,function(res){
        $(form).find('[type="submit"]').removeAttr('disabled');
        if(res.result){
            location.reload();
        }else{
             $(form).find('.alert').html(res.message);
             $(form).find('.alert').show();
        }
    }).error(function(){
        $(form).find('[type="submit"]').removeAttr('disabled');
    });
};
