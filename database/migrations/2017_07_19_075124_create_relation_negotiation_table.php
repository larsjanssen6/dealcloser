<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Dealcloser\Core\Relation\Negotiation;
use Illuminate\Database\Migrations\Migration;

class CreateRelationNegotiationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relation_negotiation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->timestamps();
        });

       /*
       * Start role
       */

        Negotiation::create([
            'name' => 'Management',
            'type' => 'role'
        ]);

        Negotiation::create([
            'name' => 'Directie',
            'type' => 'role'
        ]);

        Negotiation::create([
            'name' => 'Medewerker',
            'type' => 'role'
        ]);

        Negotiation::create([
            'name' => 'Extern',
            'type' => 'role'
        ]);

       /*
       * End role
       */

        /*
        * Start character
        */

        Negotiation::create([
            'name' => 'Blauw',
            'type' => 'character'
        ]);

        Negotiation::create([
            'name' => 'Groen',
            'type' => 'character'
        ]);

        Negotiation::create([
            'name' => 'Rood',
            'type' => 'character'
        ]);

        Negotiation::create([
            'name' => 'Geel',
            'type' => 'character'
        ]);

        /*
        * End character
        */

        /*
         * Start dmu
         */

        Negotiation::create([
            'name' => 'Beinvloeder',
            'type' => 'dmu'
        ]);

        Negotiation::create([
            'name' => 'Beslisser',
            'type' => 'dmu'
        ]);

        Negotiation::create([
            'name' => 'Tegenstander',
            'type' => 'dmu'
        ]);

        Negotiation::create([
            'name' => 'Neutraal',
            'type' => 'dmu'
        ]);

        /*
         * End dmu
         */

        /*
         * Start negotiation profile
         */

        Negotiation::create([
            'name' => 'Compromis zoekend',
            'type' => 'profile'
        ]);

        Negotiation::create([
            'name' => 'Samenwerkend',
            'type' => 'profile'
        ]);

        Negotiation::create([
            'name' => 'Doordrukken',
            'type' => 'profile'
        ]);

        Negotiation::create([
            'name' => 'Vermijdend',
            'type' => 'profile'
        ]);

        Negotiation::create([
            'name' => 'Toegevend',
            'type' => 'profile'
        ]);

        /*
         * End negotiation profile
         */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relation_negotiation');
    }
}
