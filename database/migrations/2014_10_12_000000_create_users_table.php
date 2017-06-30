<?php

use App\Dealcloser\Core\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 100);
            $table->string('name', 50);
            $table->string('last_name', 50);
            $table->string('email', 50)->unique();
            $table->string('password')->default(bcrypt(str_random(30)));
            $table->string('function', 50)->nullable();
            $table->integer('active')->default(0);
            $table->string('confirmation_code', 200)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'name'      => 'lars',
            'last_name' => 'janssen',
            'email'     => 'lars@netwize.nl',
            'password'  => bcrypt('secret'),
            'function'  => 'Ontwikkelaar',
            'active'    => 1
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
