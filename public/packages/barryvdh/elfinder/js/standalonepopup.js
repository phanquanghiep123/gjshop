$(document).on('click','.popup_selector',function (event) {
    event.preventDefault();
    var updateID = $(this).attr('data-inputid'); // Btn id clicked
    var elfinderUrl =  baseUrl + '/elfinder/popup/';

    // trigger the reveal modal with elfinder inside
    var triggerUrl = elfinderUrl + updateID;
    $.colorbox({
        href: triggerUrl,
        fastIframe: true,
        iframe: true,
        width: '70%',
        height: '50%'
    });

});
// function to update the file selected by elfinder
function processSelectedFile(filePath, requestingField) {
    console.log(requestingField);
    $('#' + requestingField).val(filePath).trigger('change');
    $('#' + requestingField + '-label').text(filePath);
    $('#' + requestingField + '-label').attr('href',baseUrl+'/'+filePath);
}
