$(function () {
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
});
$.put = function(url, data, callback, type){
 
  if ( $.isFunction(data) ){
    type = type || callback,
    callback = data,
    data = {}
  }
  data._method = "PUT";
  
  return $.ajax({
    url: url,
    type: 'PUT',
    success: callback,
    data: data,
    contentType: type
  });
};

$.delete = function(url, data, callback, type){
 
  if ( $.isFunction(data) ){
    type = type || callback,
        callback = data,
        data = {}
  }
 
  data._method = "DELETE";
 
  return $.ajax({
    url: url,
    type: 'DELETE',
    success: callback,
    data: data,
    contentType: type
  });
};

var Template = Template || {};
Template.parse = function (obj, templateDom) {
    var html = $(templateDom).html();
    $.each(obj, function (key, value) {
        var pattern = new RegExp("\\[\\[" + key + "\\]\\]", "g");
        html = html.replace(pattern, value);
    });
    return html;
};

var Validator = Validator || {};
Validator.handleMessage = function (responseText, errorDom) {
    try {
        var obj = $.parseJSON(responseText);
        var html = "<ul>";
        if (typeof errorDom === 'undefined') {
            errorDom = "#page-error";
        }
        $.each(obj, function (key, messages) {
            $.each(messages, function (index, message) {
                html += "<li>" + message + "</li>";
            });
        });
        html += "</ul>";

        $(errorDom).html(html);
        $(errorDom).show();
    } catch (ex) {

    }
};
Validator.hideAlert = function (errorDom) {
    if (typeof errorDom === 'undefined') {
        errorDom = "#page-error";
    }
    $(errorDom).hide();
};

var SuccessHandle = SuccessHandle || {};
SuccessHandle.messageHandle = function(message,successDom){
    if(typeof successDom === 'undefined') {
        successDom = '#page-success';
    }
    $(successDom).html(message);
    $(successDom).show();
}
SuccessHandle.hideAlert = function (successDom) {
    if (typeof successDom === 'undefined') {
        successDom = "#page-success";
    }
    $(successDom).hide();
};

var Menu = Menu || {};

Menu.bindSortable = function () {
    $('#menu-item-sortable,#page-for-sortable,#cat-for-sortable,#link-for-sortable').sortable({
        connectWith: '.menu-item-for-sortable'
    });
};

Menu.showAddLink = function () {
    $('#add-link-modal').modal('show');
};

Menu.addLink = function () {
    var title = $.trim($('#link-title').val());
    var href = $.trim($('#link-href').val());

    var hasError = false;

    if (title === '') {
        $('#link-title').addClass('error');
        hasError = true;
    } else {
        $('#link-title').removeClass('error');
    }

    if (href === '') {
        $('#link-href').addClass('error');
        hasError = true;
    } else {
        $('#link-href').removeClass('error');
    }

    if (!hasError) {
        var obj = {title: title, href: href};
        var link = Template.parse(obj, '#link-item-template');
        $('#link-for-sortable').append(link);
        Menu.bindSortable();
        $('#link-title').val('');
        $('#link-href').val('');
    }

};

Menu.add = function () {
    var name = $('#menu-name').val();
    var data = {items: [], name: name};
    $('#menu-item-sortable li').each(function () {
        var item = {};
        item.type = $(this).attr('data-type');
        if (typeof $(this).attr('data-link') !== 'undefined') {
            item.link = $(this).attr('data-link');
        }
        if (typeof $(this).attr('data-id') !== 'undefined') {
            item.id = $(this).attr('data-id');
        }
        if (typeof $(this).attr('data-title') !== 'undefined') {
            item.title = $(this).attr('data-title');
        }
        data.items.push(item);
    });

    //console.log(data);
    $.post(baseUrl + '/gjadmin/menus', data, function () {

    }).fail(function (xhr, textStatus, errorThrown) {
        if (xhr.status === 422) {
            Validator.handleMessage(xhr.responseText);
        }

    });
    ;
};

Menu.update = function () {
    var name = $('#menu-name').val();
    var id= $('#menu-id').val();
    var data = {items: [], name: name,_method:"PUT"};
    $('#menu-item-sortable li').each(function () {
        var item = {};
        item.type = $(this).attr('data-type');
        if (typeof $(this).attr('data-link') !== 'undefined') {
            item.link = $(this).attr('data-link');
        }
        if (typeof $(this).attr('data-id') !== 'undefined') {
            item.id = $(this).attr('data-id');
        }
        if (typeof $(this).attr('data-title') !== 'undefined') {
            item.title = $(this).attr('data-title');
        }
        data.items.push(item);
    });
    $.ajax({
        url: baseUrl + '/gjadmin/menus/'+id,
        type: 'post',
        method:"PUT",
        data: data,
        success: function(xhr, textStatus, errorThrown){
            SuccessHandle.messageHandle(xhr);
        },
        error : function (xhr, textStatus, errorThrown) {
            if (xhr.status === 422) {
                Validator.handleMessage(xhr.responseText);
            }
        }
    });
};

