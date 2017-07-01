<?php

namespace Tests\Feature\User;

use App\Dealcloser\Core\User\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_see_user_registration_page()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['register-users']);
        $this->user->assignRole($this->superAdminRole->name);

        $this->actingAs($this->user)->get('/gebruikers/registreer')
            ->assertSee('Registreer gebruiker');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_see_user_registration_page()
    {
        $this->actingAs($this->user)->get('/gebruikers/registreer')
            ->assertRedirect('/')
            ->assertDontSee('Registreer gebruiker');
    }

    /** @test */
    public function a_user_with_the_right_permission_can_register_a_user()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['register-users']);
        $this->user->assignRole($this->superAdminRole->name);

        $userToRegister = collect(make(User::class))
            ->merge(['role' => $this->superAdminRole->name])
            ->toArray();

        $this->actingAs($this->user)->post('/gebruikers/registreer', $userToRegister)
            ->assertSessionHas(['status' => 'Gebruiker geregistreerd e-mail succesvol verzonden']);

        $this->assertDatabaseHas('users', [
            'name' => $userToRegister['name'],
            'last_name' => $userToRegister['last_name'],
            'email' => $userToRegister['email']
        ]);

        $this->assertDatabaseHas('model_has_roles', [
            'role_id' => 1,
            'model_id' => $this->user->id + 1,
            'model_type' => 'App\Dealcloser\Core\User\User'
        ]);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_register_a_user()
    {
        $userToRegister = collect(make(User::class))
            ->merge(['role' => $this->superAdminRole->name])
            ->toArray();

        $this->actingAs($this->user)->post('/gebruikers/registreer', $userToRegister)
            ->assertSessionHas(['status' => 'Niet geautoriseerd!'])
            ->assertRedirect('/');
    }
}

