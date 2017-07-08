<?php

use App\Dealcloser\Core\Settings\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
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
            $table->string('phone', 20);
            $table->string('email', 50)->unique();
            $table->string('facebook', 50)->nullable();
            $table->string('whatsapp', 50)->nullable();
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
            'name' => 'Instellingen',
            'type' => 'permission-categories'
        ]);

        $user = Category::create([
            'name' => 'Gebruikers',
            'type' => 'permission-categories'
        ]);

        $relation = Category::create([
            'name' => 'Relaties',
            'type' => 'permission-categories'
        ]);

        /*
         * Generate the corporation categories.
         */

        Category::create([
            'name' => 'Klant',
            'type' => 'corporation-categories'
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
            'description'               => 'Bewerk bedrijfsinformatie',
            'category_id'               => $settings->id
        ]);

        Permission::create([
            'name'                      => 'edit-usage-settings',
            'description'               => 'Bewerk gebruik',
            'category_id'               => $settings->id
        ]);

        Permission::create([
            'name'                      => 'edit-role-settings',
            'description'               => 'Bewerk rollen',
            'category_id'               => $settings->id
        ]);

        Permission::create([
            'name'                      => 'edit-permission-settings',
            'description'               => 'Bewerk permissies',
            'category_id'               => $settings->id
        ]);

        Permission::create([
            'name'                      => 'application-is-always-active',
            'description'               => 'Applicatie is altijd actief voor',
            'category_id'               => $settings->id
        ]);

        Permission::create([
            'name'                      => 'register-users',
            'description'               => 'Registreer gebruikers',
            'category_id'               => $user->id
        ]);

        Permission::create([
            'name'                      => 'edit-users',
            'description'               => 'Bewerk gebruikers',
            'category_id'               => $user->id
        ]);

        Permission::create([
            'name'                      => 'register-relations',
            'description'               => 'Registreer relaties',
            'category_id'               => $relation->id
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
