<?php

namespace Modules\Shop\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Schema;

/**
 * Description of CreateShopProductsTable
 *
 * @author dinhtrong
 */
trait CreateShopProductsTableTrait {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_products', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('slug')->index();
            $table->text('images')->nullable();
            $table->string('list_image')->nullable();
            $table->string('description',500)->nullable();
            $table->text('content')->nullable();
            $table->boolean('is_featured')->default(false)->index();
            $table->float('regular_price');
            $table->float('sale_price')->default(0);
            $table->datetime('sale_expired_at')->nullable();
            $table->float('weigh')->nullable();
            $table->string('taxt')->nullable();
            $table->float('ship_fee')->nullable();
            $table->text('meta')->nullable();

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
        Schema::drop('shop_products');
    }

}
