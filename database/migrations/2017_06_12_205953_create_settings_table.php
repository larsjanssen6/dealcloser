<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Dealcloser\Core\Settings\Settings;
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
            $table->string('name')
                ->nullable();

            $table->string('email')
                ->nullable();

            $table->bigInteger('phone')
                ->nullable();

            $table->string('website')
                ->nullable();

            $table->text('description')
                ->nullable();

            $table->string('address')
                ->nullable();

            $table->string('zip')
                ->nullable();

            $table->string('town')
                ->nullable();

            $table->string('kvk')
                ->nullable();

            $table->string('btw')
                ->nullable();

            $table->integer('users')
                ->nullable();

            $table->string('license')
                ->nullable();

            $table->timestamp('active')
                ->nullable();

            $table->timestamps();
        });

        /**
         * Create a settings row.
         */

        Settings::create([]);
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
