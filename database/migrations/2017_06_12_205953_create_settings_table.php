<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)
                ->nullable();

            $table->string('email', 50)
                ->nullable();

            $table->string('phone', 20)
                ->nullable();

            $table->string('website', 50)
                ->nullable();

            $table->text('description', 500)
                ->nullable();

            $table->string('address', 30)
                ->nullable();

            $table->string('zip', 10)
                ->nullable();

            $table->string('city', 30)
                ->nullable();

            $table->string('kvk', 20)
                ->nullable();

            $table->string('btw', 20)
                ->nullable();

            $table->integer('users')
                ->nullable();

            $table->string('license', 50)
                ->nullable();

            $table->timestamp('active')
                ->nullable();

            $table->timestamps();
        });

        DB::table('settings')->insert(
            [
                'id' => 1,
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
