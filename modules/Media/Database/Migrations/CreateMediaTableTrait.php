<?php

namespace Modules\Media\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Schema;

/**
 * Description of CreateMediaTable
 *
 * @author dinhtrong
 */
trait CreateMediaTableTrait {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('medias', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('path');
            $table->string('mime');
            $table->string('thumbnail_150')->nullable();
            $table->string('thumbnail_300')->nullable();
            $table->integer('created_by')->unsigned()->default(0);
            $table->datetime('deleted_at');

            $table->timestamp('created_at')->index();
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('medias');
    }
}
