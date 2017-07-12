<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->string('description');
            $table->decimal('price');
            $table->decimal('purchase');
            $table->integer('license');
            $table->integer('days');
            $table->timestamps();
        });

        Schema::create('product_has_relations', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('relation_id')->unsigned();

            $table->foreign('product_id')
                ->references('id')
                ->on('product')
                ->onDelete('cascade');

            $table->foreign('relation_id')
                ->references('id')
                ->on('relation')
                ->onDelete('cascade');

            $table->primary(['product_id', 'relation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_has_relations');
        Schema::dropIfExists('product');
    }
}
