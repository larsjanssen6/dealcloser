<?php

namespace Tests\Feature\User;

use App\Dealcloser\Core\User\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RegisterUserTest extends TestCase
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

        $user = collect(make(User::class))
            ->merge(['role' => $this->superAdminRole->name])
            ->toArray();

        $this->actingAs($this->user)->post('/gebruikers/registreer', $user)
            ->assertSessionHas(['status' => 'Gebruiker geregistreerd e-mail succesvol verzonden']);

        $this->assertDatabaseHas('users', [
            'name' => $user['name'],
            'last_name' => $user['last_name'],
            'email' => $user['email']
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

    /** @test */
    public function a_user_can_visit_registration_activation_page_with_correct_confirmation_code()
    {
        $user = create(User::class);

        $this->actingAs($this->user)->get('/registreer/' . $user->confirmation_code)
            ->assertSee("Activeer account");
    }

    /** @test */
    public function a_user_can_not_visit_registration_activation_page_with_incorrect_confirmation_code()
    {
        $this->actingAs($this->user)->get('/registreer/incorrect-confirmation-code')
            ->assertRedirect('/')
            ->assertSessionHas(['status' => 'Niet geautoriseerd!']);
    }

    /** @test */
    public function a_user_can_activate_his_account_with_correct_confirmation_code()
    {
        $user = create(User::class);

        $data = [
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ];

        $this->actingAs($this->user)->post('/registreer/' . $user->confirmation_code, $data)
            ->assertRedirect('/dashboard')
            ->assertSessionHas(['status' => 'Welkom uw account is geactiveerd']);
    }

    /** @test */
    public function a_user_can_not_activate_his_account_with_incorrect_confirmation_code()
    {
        create(User::class);

        $data = [
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ];

        $this->actingAs($this->user)->post('/registreer/incorrect-confirmation-code', $data)
            ->assertRedirect('/')
            ->assertSessionHas(['status' => 'Niet geautoriseerd!']);
    }
}

