<?php
if (\Route::is('shop/*')):
    ?>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="choose-cookie-modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                {!! Former::open()->route('shop.settings.saveCurrencyCookie') !!}
                <div style="padding: 15px;">
                    <label>Choose currency</label>
                    <div class='row'>
                        <div class='col-sm-8'>
                            <select name='currency' class='form-control'>
                                <?php
                                $setting = \Modules\Shop\CurrencySetting::getInstance();
                                $currencyService = Modules\Shop\CurrencyManager::getInstance($setting);
                                $currencies = $currencyService->getList();
                                ?>
                                @foreach($currencies as $key => $c)
                                <option value="{{$key}}">{{$key}} ({{$c}})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class='col-sm-4'>
                            <button class='btn btn-block btn-primary'>Ok</button>
                        </div>
                    </div>
                </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#choose-cookie-modal').modal('show');
    </script>
    <?php
endif;
?>