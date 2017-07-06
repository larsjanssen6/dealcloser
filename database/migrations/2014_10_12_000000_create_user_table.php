<?php

use App\Dealcloser\Core\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('slug', 100);
            $table->integer('department_id')->unsigned();
            $table->string('name', 50);
            $table->string('last_name', 50);
            $table->string('email', 50)->unique();
            $table->string('password')->nullable();
            $table->string('function', 50)->nullable();
            $table->integer('active')->default(0);
            $table->string('confirmation_code')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('department_id')
                ->references('id')
                ->on('department')
                ->onDelete('cascade');
        });

        User::create([
            'name'              => 'lars',
            'last_name'         => 'janssen',
            'email'             => 'lars@netwize.nl',
            'password'          => bcrypt('secret'),
            'function'          => 'Ontwikkelaar',
            'department_id'     => 1,
            'active'            => 1
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
