<?php

namespace Tests\Feature\Settings\Rights;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_see_role_page()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-role-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $this->actingAs($this->user)->get('/instellingen/bedrijf/role')
            ->assertSee('Rollen');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_see_role_page()
    {
        $this->actingAs($this->user)->get('/instellingen/bedrijf/role')
            ->assertRedirect('/')
            ->assertDontSee('Rollen');
    }

    /** @test */
    public function a_user_with_right_permission_can_create_a_role()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-role-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $role = [
            'name' => 'Account-manager',
        ];

        $this->actingAs($this->user)->post('/instellingen/bedrijf/role', $role)
            ->assertSessionHas('status', 'Role aangemaakt');

        $this->assertDatabaseHas('roles', $role);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_create_a_role()
    {
        $role = [
            'name' => 'account-manager',
        ];

        $this->actingAs($this->user)->post('/instellingen/bedrijf/role', $role)
            ->assertSessionHas('status', 'Niet geautoriseerd!')
            ->assertRedirect('/');

        $this->assertDatabaseMissing('roles', $role);
    }

    /** @test */
    public function a_user_with_right_permission_can_update_a_role()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-role-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $role = [
            'name' => 'New role',
        ];

        $this->actingAs($this->user)->patchJson('instellingen/bedrijf/role/'.$this->superAdminRole->id, $role)
            ->assertJson(['status' => 'Rol geupdatet.']);

        $this->assertDatabaseHas('roles', $role);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_update_a_role()
    {
        $role = [
            'name' => 'New role',
        ];

        $this->actingAs($this->user)->patchJson('instellingen/bedrijf/role/'.$this->superAdminRole->id, $role)
            ->assertJson(['status' => 'Niet geautoriseerd!']);

        $this->assertDatabaseMissing('roles', $role);
    }

    /** @test */
    public function a_user_with_right_permission_can_destroy_a_role()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-role-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $role = create(Role::class, ['name' => 'admin']);

        $this->actingAs($this->user)->deleteJson('instellingen/bedrijf/role/'.$role->id)
            ->assertJson(['status' => 'Rol verwijderd.']);

        $this->assertDatabaseMissing('roles', $role->toArray());
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_destroy_a_role()
    {
        $role = create(Role::class, ['name' => 'admin']);

        $this->actingAs($this->user)->deleteJson('instellingen/bedrijf/role/'.$role->id)
            ->assertJson(['status' => 'Niet geautoriseerd!']);

        $this->assertDatabaseHas('roles', $role->toArray());
    }

    /** @test */
    public function a_user_can_not_destroy_his_own_role()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-role-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $this->actingAs($this->user)->deleteJson('instellingen/bedrijf/role/'.$this->superAdminRole->id)
            ->assertJson(['status' => 'U kunt deze rol niet verwijder. Koppel uzelf eerst aan een andere rol.']);

        $this->assertDatabaseHas('roles', $this->superAdminRole->toArray());
    }

    /** @test */
    public function a_role_that_already_exists_can_not_be_created()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-role-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $this->actingAs($this->user)->post('instellingen/bedrijf/role', $this->superAdminRole->toArray())
            ->assertSessionHasErrors('name');
    }
}
