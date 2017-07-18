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
            $table->decimal('price', 10);
            $table->decimal('purchase', 10);
            $table->integer('amount');
            $table->timestamps();
        });

        Schema::create('organisation_has_products', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('organisation_id')->unsigned();

            $table->foreign('product_id')
                ->references('id')
                ->on('product')
                ->onDelete('cascade');

            $table->foreign('organisation_id')
                ->references('id')
                ->on('organisation')
                ->onDelete('cascade');

            $table->primary(['product_id', 'organisation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisation_has_products');
        Schema::dropIfExists('product');
    }
}
