<?php

namespace Tests\Feature\User;

use App\Dealcloser\Core\Department\Department;
use App\Dealcloser\Core\User\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_update_a_user()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-users']);
        $this->user->assignRole($this->superAdminRole->name);

        $user = create(User::class);
        $department = create(Department::class);
        $role = create(Role::class);

        $toUpdate = [
            'id'            => $user->id,
            'name'          => 'lars',
            'last_name'     => 'janssen',
            'email'         => 'lars@domain.com',
            'function'      => 'Ontwikkelaar',
            'active'        => 1,
            'department_id' => $department->id,
            'role'          => $role->name,
        ];

        $this->actingAs($this->user)->patchJson('/gebruikers/'.$user->id, $toUpdate)
            ->assertJson(['status' => 'Geupdatet']);

        $this->assertDatabaseHas('model_has_roles', [
            'role_id'    => $role->id,
            'model_id'   => $toUpdate['id'],
            'model_type' => 'App\Dealcloser\Core\User\User',
        ]);

        $toUpdate = collect($toUpdate)
            ->except('role')
            ->toArray();

        $this->assertDatabaseHas('user', $toUpdate);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_update_a_user()
    {
        $user = create(User::class);
        $department = create(Department::class);
        $role = create(Role::class);

        $toUpdate = [
            'id'            => $user->id,
            'name'          => 'lars',
            'last_name'     => 'janssen',
            'email'         => 'lars@domain.com',
            'function'      => 'Ontwikkelaar',
            'active'        => 1,
            'department_id' => $department->id,
            'role'          => $role->name,
        ];

        $this->actingAs($this->user)->patchJson('/gebruikers/'.$user->id, $toUpdate)
            ->assertJson(['status' => 'Niet geautoriseerd!']);
    }
}
