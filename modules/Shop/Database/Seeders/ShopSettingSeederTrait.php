<?php

namespace Modules\Shop\Database\Seeders;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of ShopSettingSeederTrait
 *
 * @author dinhtrong
 */
trait ShopSettingSeederTrait {

    public function run() {
        Model::unguard();

        $currencies = [
            'USD' => ['symbol' => '$', 'default' => true, 'rate' => '1.1298'],
            'GBP' => ['symbol' => '€', 'default' => false, 'rate' => '1'],
        ];
        \Modules\Shop\Models\Setting::create([
            'key' => 'currencies',
            'name' => 'Currencies',
            'value' => json_encode($currencies)
        ]);
    }

}
