<?php

namespace Tests\Feature\Settings\Department;

use Tests\TestCase;
use App\Dealcloser\Core\Department\Department;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DepartmentTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_see_department_page()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-company-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $this->actingAs($this->user)->get('/instellingen/bedrijf/afdeling')
            ->assertSee('Afdelingen');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_see_department_page()
    {
        $this->actingAs($this->user)->get('/instellingen/bedrijf/afdeling')
            ->assertRedirect('/')
            ->assertDontSee('Afdelingen');
    }

    /** @test */
    public function a_user_with_the_right_permission_can_create_a_department()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-company-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $department = [
            'name' => 'Tech',
        ];

        $this->actingAs($this->user)->post('/instellingen/bedrijf/afdeling', $department)
            ->assertSessionHas('status', 'Afdeling aangemaakt!');

        $this->assertDatabaseHas('department', $department);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_create_a_department()
    {
        $department = [
            'name' => 'Tech',
        ];

        $this->actingAs($this->user)->post('/instellingen/bedrijf/afdeling', $department)
            ->assertSessionHas('status', 'Niet geautoriseerd!')
            ->assertRedirect('/');

        $this->assertDatabaseMissing('department', $department);
    }

    /** @test */
    public function a_user_with_right_permission_can_update_a_department()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-company-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $department = [
            'name' => 'New role',
        ];

        $this->actingAs($this->user)->patchJson('instellingen/bedrijf/afdeling/1', $department)
            ->assertJson(['status' => 'Afdeling geupdatet.']);

        $this->assertDatabaseHas('department', $department);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_update_a_department()
    {
        $department = [
            'name' => 'Tech',
        ];

        $this->actingAs($this->user)->patchJson('/instellingen/bedrijf/afdeling/1', $department)
            ->assertJson(['status' => 'Niet geautoriseerd!']);

        $this->assertDatabaseMissing('department', $department);
    }

    /** @test */
    public function a_user_with_right_permission_can_destroy_a_department()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-company-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $department = create(Department::class, ['name' => 'Tech']);

        $this->actingAs($this->user)->deleteJson('instellingen/bedrijf/afdeling/'.$department->id)
            ->assertJson(['status' => 'Afdeling verwijderd.']);

        $this->assertDatabaseMissing('department', $department->toArray());
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_destroy_a_department()
    {
        $department = create(Department::class, ['name' => 'Tech']);

        $this->actingAs($this->user)->deleteJson('instellingen/bedrijf/afdeling/'.$department->id)
            ->assertJson(['status' => 'Niet geautoriseerd!']);

        $this->assertDatabaseHas('department', $department->toArray());
    }

    /** @test */
    public function a_department_that_already_exists_can_not_be_created()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-company-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $department = create(Department::class, ['name' => 'Tech']);

        $this->actingAs($this->user)->post('instellingen/bedrijf/afdeling', $department->toArray())
            ->assertSessionHasErrors('name');
    }
}
