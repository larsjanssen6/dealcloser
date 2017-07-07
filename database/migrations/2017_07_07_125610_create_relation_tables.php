<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 100);
            $table->integer('category_id')->unsigned();
            $table->string('account_manager', 100);
            $table->string('organisation', 50)->unique();
            $table->string('country', 50);
            $table->string('state', 50);
            $table->string('street', 50);
            $table->string('house_number', 50);
            $table->string('sales_area', 50);
            $table->string('zip', 10);
            $table->string('town', 50);
            $table->string('phone', 20);
            $table->string('email', 50)->unique();
            $table->string('facebook', 50)->nullable();
            $table->string('whatsapp', 50)->nullable();
            $table->string('website', 50)->nullable();
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
        Schema::dropIfExists('relation');
    }
}
