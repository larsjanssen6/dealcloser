<?php

namespace Tests\Feature\Settings\Rights;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_see_permission_page()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-permission-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $this->actingAs($this->user)->get('/instellingen/bedrijf/permissie')
            ->assertSee('Permissies');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_see_permission_page()
    {
        $this->actingAs($this->user)->get('/instellingen/bedrijf/permissie')
            ->assertRedirect('/')
            ->assertDontSee('Permissies');
    }

    /** @test */
    public function a_user_with_the_right_permission_can_assign_permission_to_role()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-permission-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $this->actingAs($this->user)
            ->get(sprintf("/instellingen/bedrijf/permissie/update?role=%s&permission=%s",
                $this->superAdminRole->id,
                $this->permissions['register-users']))
            ->assertSessionHas('status', 'Permissie toegevoegd');

        $this->assertDatabaseHas('role_has_permissions', [
            'role_id' => $this->superAdminRole->id,
            'permission_id' => Permission::where('name', $this->permissions['register-users'])->first()->id,
        ]);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_assign_permission_to_role()
    {
        $this->actingAs($this->user)
            ->get(sprintf("/instellingen/bedrijf/permissie/update?role=%s&permission=%s",
                $this->superAdminRole->id,
                $this->permissions['register-users']))
            ->assertRedirect('/')
            ->assertSessionHas('status', 'Niet geautoriseerd!');
    }

    /** @test */
    public function a_user_with_the_right_permission_can_revoke_permission_from_a_role()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-permission-settings']);
        $this->superAdminRole->givePermissionTo($this->permissions['register-users']);

        $this->user->assignRole($this->superAdminRole->name);

        $this->actingAs($this->user)
            ->get(sprintf("/instellingen/bedrijf/permissie/update?role=%s&permission=%s",
                $this->superAdminRole->id, $this->permissions['register-users']))
            ->assertSessionHas('status', 'Permissie ingetrokken');

        $this->assertDatabaseMissing('role_has_permissions', [
            'role_id' => $this->superAdminRole->id,
            'permission_id' => Permission::where('name', $this->permissions['register-users'])->first()->id,
        ]);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_revoke_permission_to_role()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['register-users']);

        $this->actingAs($this->user)
            ->get(sprintf("/instellingen/bedrijf/permissie/update?role=%s&permission=%s",
                $this->superAdminRole->id, $this->permissions['register-users']))
            ->assertSessionHas('status', 'Niet geautoriseerd!');
    }
}

