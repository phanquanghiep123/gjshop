<?php

namespace Modules\Shop\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Schema;

trait CreateShopProductProductCategoryTableTrait {

    public function up()
    {
        Schema::create('shop_product_product_category', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->references('id')->on('shop_products');
            $table->integer('product_category_id')->unsigned()->references('id')->on('shop_product_categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shop_product_product_category');
    }


}
