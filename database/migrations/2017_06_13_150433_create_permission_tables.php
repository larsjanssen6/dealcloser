<?php

use App\Dealcloser\Core\Settings\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        $foreignKeys = config('permission.foreign_keys');

        Schema::create($tableNames['category_permissions'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create($tableNames['permissions'], function (Blueprint $table) use ($tableNames, $foreignKeys) {
            $table->increments('id');
            $table->integer('category_permissions_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('guard_name');
            $table->timestamps();

            $table->foreign('category_permissions_id')
                ->references('id')
                ->on($tableNames['category_permissions'])
                ->onDelete('cascade');
        });

        Schema::create($tableNames['roles'], function (Blueprint $table)  use ($tableNames, $foreignKeys) {
            $table->increments('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $foreignKeys) {
            $table->integer('permission_id')->unsigned();
            $table->morphs('model');

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->primary(['permission_id', 'model_id', 'model_type']);
        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $foreignKeys) {
            $table->integer('role_id')->unsigned();
            $table->morphs('model');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['role_id', 'model_id', 'model_type']);
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });

        Category::create(['name' => 'Instellingen']);
        Category::create(['name' => 'Gebruikers']);
        Role::create(['name' => 'Super-admin']);

        Permission::create([
            'name'                      => 'edit-company-settings',
            'description'               => 'Bewerk bedrijfsinformatie',
            'category_permissions_id'   => 1
        ]);

        Permission::create([
            'name'                      => 'edit-usage-settings',
            'description'               => 'Bewerk gebruik',
            'category_permissions_id'   => 1
        ]);

        Permission::create([
            'name'                      => 'edit-role-settings',
            'description'               => 'Bewerk rollen',
            'category_permissions_id'   => 1
        ]);

        Permission::create([
            'name'                      => 'edit-permission-settings',
            'description'               => 'Bewerk permissies',
            'category_permissions_id'   => 1
        ]);

        Permission::create([
            'name'                      => 'application-is-always-active',
            'description'               => 'Applicatie is altijd actief voor',
            'category_permissions_id'   => 1
        ]);

        Permission::create([
            'name'                      => 'register-users',
            'description'               => 'Registreer gebruikers',
            'category_permissions_id'   => 2
        ]);

        Permission::create([
            'name'                      => 'edit-users',
            'description'               => 'Bewerk gebruikers',
            'category_permissions_id'   => 2
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
        Schema::drop($tableNames['category_permissions']);
    }
}
