<?php

namespace Modules\Shop\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;

/**
 * Description of CreateShopShippingMethodsTable
 *
 * @author dinhtrong
 */
trait CreateShopShippingMethodsTableTrait {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        \Schema::create('shop_shipping_methods', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('type');
            $table->float('fee');
            $table->text('meta')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        \Schema::drop('shop_shipping_methods');
    }

}
