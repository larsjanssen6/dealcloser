<?php

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Schema\Blueprint;
use App\Dealcloser\Core\Category\Category;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->integer('category_id')->unsigned();
            $table->string('account_manager');
            $table->string('name')->unique();
            $table->string('country_code');
            $table->string('state_code');
            $table->string('street');
            $table->integer('house_number');
            $table->string('sales_area');
            $table->string('zip');
            $table->string('town');
            $table->bigInteger('phone');
            $table->string('email')->unique();
            $table->string('linkedin')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('category')
                ->onDelete('cascade');
        });

        /*
        * Create the permission categories.
        */

        $settings = Category::create([
            'name'          => 'Instellingen',
            'type'          => 'permission_category',
        ]);

        $user = Category::create([
            'name'          => 'Gebruikers',
            'type'          => 'permission_category',
        ]);

        $organisation = Category::create([
            'name'          => 'Organisaties',
            'type'          => 'permission_category',
        ]);

        $product = Category::create([
            'name'          => 'Producten',
            'type'          => 'permission_category',
        ]);

        $relation = Category::create([
            'name'          => 'Relaties',
            'type'          => 'permission_category',
        ]);

        /*
         * Generate the organisation categories.
         */

        Category::create([
            'name'       => 'Klant',
            'type'       => 'organisation_category',
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
            'description'               => 'Applicatie is altijd actief',
            'category_id'               => $settings->id,
        ]);

        Permission::create([
            'name'                      => 'see-graphs',
            'description'               => 'Toon grafieken',
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
            'name'                      => 'register-organisations',
            'description'               => 'Registreer organisaties',
            'category_id'               => $organisation->id,
        ]);

        Permission::create([
            'name'                      => 'edit-organisations',
            'description'               => 'Bewerk/verwijder organisaties',
            'category_id'               => $organisation->id,
        ]);

        Permission::create([
            'name'                      => 'register-products',
            'description'               => 'Registreer producten',
            'category_id'               => $product->id,
        ]);

        Permission::create([
            'name'                      => 'edit-products',
            'description'               => 'Bewerk/verwijder producten',
            'category_id'               => $product->id,
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
        Schema::dropIfExists('organisation');
    }
}
