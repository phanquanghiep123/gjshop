<?php

namespace Modules\Shop\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Schema;

trait CreateShopFavoritesProductsTableTrait {

    public function up() {
        Schema::create('shop_favorites_products', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->references('id')->on('users');
            $table->integer('shop_product_id')->unsigned()->references('id')->on('shop_products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('shop_favorites_products');
    }

}
