<?php

namespace Modules\Shop\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Schema;

trait CreateShopOrdersTableTrait {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('shop_orders', function(Blueprint $table) {
            $table->increments('id');
            $table->string('token',50)->unique()->index();
            $table->integer('user_id')->unsigned()->default(0)->index();
            $table->string('customer_name')->imdex();
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->string('customer_state');
            $table->string('customer_city');
            $table->string('customer_country');
            $table->text('customer_note');
            $table->float('price');
            $table->float('ship_free');
            $table->float('taxt');
            $table->tinyInteger('payment_method');
            $table->text('meta');
            $table->tinyInteger('status')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('shop_orders');
    }

}
