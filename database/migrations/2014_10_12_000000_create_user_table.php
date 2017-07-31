<?php

use App\Dealcloser\Core\User\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->integer('department_id')->unsigned();
            $table->string('name');
            $table->string('preposition')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('function')->nullable();
            $table->integer('active')->default(0);
            $table->string('confirmation_code')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('department_id')
                ->references('id')
                ->on('department')
                ->onDelete('cascade');
        });

        /**
         * Create user(s).
         */

        User::create([
            'name'              => 'lars',
            'last_name'         => 'janssen',
            'email'             => 'lars@riveau.nl',
            'password'          => bcrypt('secret'),
            'function'          => 'Ontwikkelaar',
            'department_id'     => 1,
            'active'            => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
