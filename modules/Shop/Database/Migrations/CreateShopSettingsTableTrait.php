<?php

namespace Modules\Shop\Database\Migrations;

use Schema;
use Illuminate\Database\Schema\Blueprint;

/**
 * Description of CreateShopSettingsTable
 *
 * @author dinhtrong
 */
trait CreateShopSettingsTableTrait {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('shop_settings', function(Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->string('name');
            $table->string('value');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('shop_setting');
    }

}
