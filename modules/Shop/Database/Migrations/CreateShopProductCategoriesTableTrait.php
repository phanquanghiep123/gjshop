<?php

namespace Modules\Shop\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Schema;

trait CreateShopProductCategoriesTableTrait
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_product_categories', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string("name");
            $table->string("slug");
            $table->integer('parent_id')->unsigned()->default(0);
            $table->boolean('status')->default(1);
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
        Schema::drop('shop_product_categories');
    }

}
