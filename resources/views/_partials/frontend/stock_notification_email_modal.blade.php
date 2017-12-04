<div>
    <div class="modal fade" tabindex="-1" role="dialog"  id="stockNotification-modal">
        <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                        <h3 class="modal-title">Stock Replenishment Notification:</h3>
                    </div>
                    <div class="">

                        <div class="admin-form theme-info" id="login">
                            {!! Former::open()
                            ->route('shop.subscriptions.subscribeStockDelivered')
                            ->onsubmit('ShopSubscription.subscribeStockDelivered(this);return false;')->class('formStockNotifications')
                            !!}
                            <?php Former::framework('Nude'); ?>
                            {!! Former::token() !!}
                            {!! Former::hidden("product_id",'4') !!}
                            <div class="panel-body">
                                <div role="alert" class="alert alert-danger signin-error" style="display: none"></div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="" class="img-responsive product-image">
                                    </div>
                                    <div class="col-sm-8">
                                        <h3 class="product-name"></h3>
                                        <p>You will be notified when this item is back in stock.</p>
                                        {!! Former::text('email','')->classs('form-control')->placeholder('Enter your email...')->required() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-sm btn-success">
                                    Register Interest
                                </button>
                            </div>
                            {!! Former::close() !!}
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.vertical-alignment-helper -->
        </div><!-- /.modal -->
    </div>