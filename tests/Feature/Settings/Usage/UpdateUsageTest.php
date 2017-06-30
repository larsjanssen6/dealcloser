<?php

namespace Tests\Feature\Settings\Usage;

use App\Dealcloser\Core\Settings\Settings;
use App\Dealcloser\Core\User\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UpdateUsageTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_see_company_usage_page()
    {
        $permission = create(Permission::class, ['name' => 'edit-usage-settings']);

        $role = create(Role::class, ['name' => 'super-admin']);
        $role->givePermissionTo($permission->name);

        $user = create(User::class)->assignRole($role->name);

        $this->actingAs($user)->get('/instellingen/bedrijf/gebruik')
            ->assertSee('Update bedrijfsgebruik');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_see_company_usage_page()
    {
        create(Permission::class, ['name' => 'edit-usage-settings']);

        $user = create(User::class);

        $this->actingAs($user)->get('/instellingen/bedrijf/gebruik')
            ->assertRedirect('/')
            ->assertDontSee('Update bedrijfsgebruik');
    }

    /** @test */
    public function a_user_with_right_permission_can_update_company_usage()
    {
        $permission = create(Permission::class, ['name' => 'edit-usage-settings']);

        $role = create(Role::class, ['name' => 'super-admin']);
        $role->givePermissionTo($permission->name);

        $user = create(User::class)->assignRole($role->name);

        $this->signIn($user);

        $settings = [
            'users'     => 12,
            'active'    => '2017-05-10 17:38:00',
            'license'   => '11324543132443'
        ];

        $this->patch('/instellingen/bedrijf/gebruik', $settings)
            ->assertSessionHas('status', 'Bedrijfsgebruik geupdatet!');

        $this->assertDatabaseHas('settings', $settings);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_update_company_usage()
    {
        create(Permission::class, ['name' => 'edit-usage-settings']);

        $user = create(User::class);

        $this->signIn($user);

        $settings = [
            'users'     => 12,
            'active'    => '2017-05-10 17:38:00',
            'license'   => '11324543132443'
        ];

        $this->patch('/instellingen/bedrijf/gebruik', $settings)
            ->assertSessionHas('status', 'Niet geautoriseerd!')
            ->assertRedirect('/');

        $this->assertDatabaseMissing('settings', $settings);
    }

    /** @test */
    public function a_user_with_right_permission_can_sign_in_when_app_is_not_active()
    {
        $permission = create(Permission::class, ['name' => 'application-is-always-active']);

        $role = create(Role::class, ['name' => 'super-admin']);
        $role->givePermissionTo($permission->name);

        $user = create(User::class, ['password' => bcrypt('password')])->assignRole($role->name);

        Settings::set(['active' => Carbon::now()->subDays(1)]);

        $this->post('/', [
            'email'     => $user->email,
            'password'  => 'password'
        ])
            ->assertRedirect('/dashboard')
            ->assertSessionHas('status', sprintf('Welkom %s', $user->name));
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_sign_in_when_app_is_not_active()
    {
        create(Permission::class, ['name' => 'application-is-always-active']);

        $user = create(User::class, ['password' => bcrypt('password')]);

        Settings::set(['active' => Carbon::now()->subDays(1)]);

        $this->post('/', [
            'email'     => $user->email,
            'password'  => 'password'
        ])
            ->assertRedirect('/')
            ->assertSessionHas('status', 'Applicatie is niet actief, contacteer de beheerder');
    }
}

