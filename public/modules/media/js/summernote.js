(function (factory) {
    /* global define */
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
        // Node/CommonJS
        module.exports = factory(require('jquery'));
    } else {
        // Browser globals
        factory(window.jQuery);
    }
}(function ($) {

    // minimal dialog plugin
    $.extend($.summernote.plugins, {
        /**
         * @param {Object} context - context object has status of editor.
         */
        'mediadiag': function (context) {
            var self = this;

            // ui has renders to build ui elements.
            //  - you can create a button with `ui.button`
            var ui = $.summernote.ui;

            var $editor = context.layoutInfo.editor;
            var options = context.options;

            // add context menu button
            context.memo('button.mediadiag', function () {
                return ui.button({
                    contents: '<i class="glyphicon glyphicon-picture"/> File selector',
                    tooltip: 'media diag',
                    click: context.createInvokeHandler('mediadiag.showDialog')
                }).render();
            });

            // This method will be called when editor is initialized by $('..').summernote();
            // You can create elements for plugin
            self.initialize = function () {
                var $container = options.dialogsInBody ? $(document.body) : $editor;
                var idRender = 'dinhtrong-media-summernote-image' + Math.random().toString(36).substring(7);
                var body = '<div class="form-group row-fluid">' +
                        '<div class="clearfix">' +
                        '<lable>Image alt : </lable>' +
                        '<input type="text" class="form-control alt-txt" />' +
                        '</div>' +
                        '<lable>Image classes : </lable>' +
                        '<input type="text"  class="form-control classes-txt" />' +
                        '</div>' +
                        '<div class="clearfix">' +
                        '<lable>Margin : (top left bottom right)</lable>' +
                        '<input type="text" class="form-control margin-txt" placeholder="1px 1px 1px 1px" />' +
                        '</div>' +
                        '<div class="clearfix">' +
                        '<lable>Padding : </lable>(top left bottom right)' +
                        '<input type="text" class="form-control padding-txt"  placeholder="1px 1px 1px 1px" />' +
                        '</div>' +
                        '<div class="clearfix">' +
                        '<lable> Responsive : </lable> <input type="checkbox" class="is-responsive" />' +
                        '</div><br/>' +
                        '<button " type="button" input-name="summernote-image"  des="#' + idRender + '" class="btn btn-default media-selector"> Select image</button>' +
                        '<div id="' + idRender + '" class="img-wrapper"></div>' +
                        '</div>';
                var footer = '<div class="modal-footer">' +
                        '<button href="#" class="btn btn-primary ext-mediadiag-btn">OK</button>' +
                        '</div>';
                body += footer;
                self.$dialog = ui.dialog({
                    title: 'Insert image',
                    fade: options.dialogsFade,
                    body: body,
                    //footer: footer
                }).render().appendTo($container);

            };

            // This methods will be called when editor is destroyed by $('..').summernote('destroy');
            // You should remove elements on `initialize`.
            self.destroy = function () {
                self.$dialog.remove();
                self.$dialog = null;
            };

            self.showDialog = function () {
                self
                        .openDialog()
                        .then(function (dialogData) {
                            // [workaround] hide dialog before restore range for IE range focus
                            ui.hideDialog(self.$dialog);
                            context.invoke('editor.restoreRange');

                            // do something with dialogData
                            //console.log("dialog returned: ", dialogData)
                            // ...
                        })
                        .fail(function () {
                            context.invoke('editor.restoreRange');
                        });

            };

            self.openDialog = function () {
                return $.Deferred(function (deferred) {

                    self.$dialog.find('.img-wrapper').html('');
                    self.$dialog.find('.alt-txt').val('');

                    var $dialogBtn = self.$dialog.find('.ext-mediadiag-btn');
                    var $reponsiveCb = self.$dialog.find('[type="checkbox"].is-responsive');
                    var $classesTxt = self.$dialog.find('.classes-txt');
                    var $marginTxt = self.$dialog.find('.margin-txt');
                    var $paddingTxt = self.$dialog.find('.padding-txt');

                    ui.onDialogShown(self.$dialog, function () {
                        context.triggerEvent('dialog.shown');

                        $dialogBtn
                                .click(function (event) {
                                    event.preventDefault();
                                    var selectImage = self.$dialog.find('.img-wrapper img');
                                    //console.log(selectImage.attr('src'));
                                    var altTxt = self.$dialog.find('.alt-txt');
                                    if (typeof selectImage !== 'undefined') {
                                        var img = new Image();
                                        img.src = selectImage.attr('src');
                                        img.alt = altTxt.val();
                                        if ($reponsiveCb.is(':checked') && !$classesTxt.val().match(/img-responsive/g)) {
                                            $classesTxt.val($classesTxt.val() + ' img-responsive');
                                        }
                                        img.className = $classesTxt.val();
                                        var styles = [];
                                        if ($marginTxt.val()) {
                                            styles.push('margin:' + $marginTxt.val());
                                        }
                                        if ($paddingTxt.val()) {
                                            styles.push('padding:' + $paddingTxt.val());
                                        }
                                        img.style = styles.join(";");
                                        context.invoke('editor.insertNode', img);
                                    }
                                    //console.log('mini dialog OK clicked...');
                                    deferred.resolve({action: 'mini dialog OK clicked...'});
                                });

                        $reponsiveCb
                                .change(function (event) {
                                    event.preventDefault();
                                    var isHasReponsiveClass = $classesTxt.val().match(/img-responsive/g);
                                    if (this.checked) {
                                        if (!isHasReponsiveClass) {
                                            $classesTxt.val($classesTxt.val() + ' img-responsive')
                                        }
                                    } else {
                                        var newClass = $classesTxt.val().replace(/img-responsive/g, '');
                                        newClass.replace(/\s\s/g, ' ');
                                        $classesTxt.val(newClass);
                                    }
                                });
                    });

                    ui.onDialogHidden(self.$dialog, function () {
                        $dialogBtn.off('click');
                        if (deferred.state() === 'pending') {
                            deferred.reject();
                        }
                    });

                    ui.showDialog(self.$dialog);
                });
            };

        }
    });

}));



