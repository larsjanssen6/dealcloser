<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationTable extends Migration
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
            $table->string('slug');
            $table->string('name');
            $table->string('preposition')->nullable();
            $table->string('last_name');
            $table->string('initial')->nullable();
            $table->string('email')->unique();
            $table->string('linkedin')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->integer('gender')->default(0);
            $table->string('country_code');
            $table->string('function');
            $table->timestamp('date_of_birth')->nullable();
            $table->timestamp('employee_since')->nullable();

            /* start relation_negotiation */
            $table->integer('role_id')->unsigned();
            $table->integer('character_id')->unsigned();
            $table->integer('negotiation_profile_id')->unsigned();
            $table->integer('dmu_id')->unsigned();
            /* end relation_negotiation */

            $table->boolean('problem_owner')->default(0);
            $table->string('worked_at')->nullable();
            $table->string('hobbies')->nullable();
            $table->boolean('married')->default(0);
            $table->boolean('children')->default(0);
            $table->boolean('newsletter')->default(0);
            $table->boolean('o3')->default(0);
            $table->boolean('events')->default(0);
            $table->boolean('send_email')->default(0);
            $table->boolean('christmas_card')->default(0);
            $table->text('experience_with_us')->nullable();
            $table->text('track_record')->nullable();
            $table->timestamps();

            $table->foreign('role_id')
                ->references('id')
                ->on('relation_negotiation')
                ->onDelete('cascade');

            $table->foreign('character_id')
                ->references('id')
                ->on('relation_negotiation')
                ->onDelete('cascade');

            $table->foreign('negotiation_profile_id')
                ->references('id')
                ->on('relation_negotiation')
                ->onDelete('cascade');

            $table->foreign('dmu_id')
                ->references('id')
                ->on('relation_negotiation')
                ->onDelete('cascade');
        });

        Schema::create('relation_has_relation', function (Blueprint $table) {
            $table->integer('relation_parent_id')->unsigned();
            $table->integer('relation_child_id')->unsigned();

            $table->foreign('relation_parent_id')
                ->references('id')
                ->on('relation')
                ->onDelete('cascade');

            $table->foreign('relation_child_id')
                ->references('id')
                ->on('relation')
                ->onDelete('cascade');

            $table->string('type');

            $table->primary(['relation_parent_id', 'relation_child_id', 'type'], 'relation_has_relation_unique');
        });

        Schema::create('relation_has_organisation', function (Blueprint $table) {
            $table->integer('relation_id')->unsigned();
            $table->integer('organisation_id')->unsigned();

            $table->foreign('relation_id')
                ->references('id')
                ->on('relation')
                ->onDelete('cascade');

            $table->foreign('organisation_id')
                ->references('id')
                ->on('organisation')
                ->onDelete('cascade');

            $table->string('type');

            $table->primary(['relation_id', 'organisation_id', 'type'], 'relation_has_organisation_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relation_has_relation');
        Schema::dropIfExists('relation_has_organisation');
        Schema::dropIfExists('relation');
    }
}
