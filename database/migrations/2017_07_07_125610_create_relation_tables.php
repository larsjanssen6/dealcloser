<?php

use App\Dealcloser\Core\Relation\Relation;
use App\Dealcloser\Core\Settings\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
            $table->string('account_manager', 50);
            $table->string('organisation', 50)->unique();
            $table->string('country_code', 3);
            $table->string('state_code', 3);
            $table->string('street', 30);
            $table->string('house_number', 50);
            $table->string('sales_area', 50);
            $table->string('zip', 10);
            $table->string('town', 50);
            $table->string('phone', 50);
            $table->string('email', 50)->unique();
            $table->string('linkedin', 50)->nullable();
            $table->string('website', 50)->nullable();
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('category')
                ->onDelete('cascade');
        });

        /*
        * Generate the permission categories.
        */

        $settings = Category::create([
            'name'          => 'Instellingen',
            'model_type'    => Permission::class,
        ]);

        $user = Category::create([
            'name'          => 'Gebruikers',
            'model_type'    => Permission::class,
        ]);

        $relation = Category::create([
            'name'          => 'Relaties',
            'model_type'    => Permission::class,
        ]);

        /*
         * Generate the corporation categories.
         */

        Category::create([
            'name'       => 'Klant',
            'model_type' => Relation::class,
        ]);

        /*
        * Generate the role(s).
        */

        Role::create(['name' => 'Super-admin']);

        /*
        * Generate all permissions.
        */

        Permission::create([
            'name'                      => 'edit-company-settings',
            'description'               => 'Bedrijfsinformatie',
            'category_id'               => $settings->id,

        ]);

        Permission::create([
            'name'                      => 'edit-usage-settings',
            'description'               => 'Gebruik',
            'category_id'               => $settings->id,
        ]);

        Permission::create([
            'name'                      => 'edit-role-settings',
            'description'               => 'Rollen',
            'category_id'               => $settings->id,
        ]);

        Permission::create([
            'name'                      => 'edit-permission-settings',
            'description'               => 'Permissies',
            'category_id'               => $settings->id,
        ]);

        Permission::create([
            'name'                      => 'application-is-always-active',
            'description'               => 'Applicatie is altijd actief voor',
            'category_id'               => $settings->id,
        ]);

        Permission::create([
            'name'                      => 'register-users',
            'description'               => 'Registreer gebruikers',
            'category_id'               => $user->id,
        ]);

        Permission::create([
            'name'                      => 'edit-users',
            'description'               => 'Bewerk/verwijder gebruikers',
            'category_id'               => $user->id,
        ]);

        Permission::create([
            'name'                      => 'register-relations',
            'description'               => 'Registreer relaties',
            'category_id'               => $relation->id,
        ]);

        Permission::create([
            'name'                      => 'edit-relations',
            'description'               => 'Bewerk/verwijder relaties',
            'category_id'               => $relation->id,
        ]);
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
