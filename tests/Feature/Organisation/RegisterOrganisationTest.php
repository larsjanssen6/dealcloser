<?php

namespace Tests\Feature\Organisation;

use App\Dealcloser\Core\Organisation\Organisation;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterOrganisationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_see_organisation_registration_page()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['register-organisations']);
        $this->user->assignRole($this->superAdminRole->name);

        $this->actingAs($this->user)->get('/organisaties/registreer')
            ->assertSee('Registreer organisatie');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_see_organisation_registration_page()
    {
        $this->actingAs($this->user)->get('/organisaties/registreer')
            ->assertRedirect('/')
            ->assertDontSee('Registreer organisatie');
    }

    /** @test */
    public function a_user_with_the_right_permission_can_register_a_organisation()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['register-organisations']);
        $this->user->assignRole($this->superAdminRole->name);

        $organisation = make(Organisation::class)->toArray();

        $this->actingAs($this->user)->post('/organisaties/registreer', $organisation)
            ->assertRedirect('/organisaties')
            ->assertSessionHas(['status' => 'Organisatie aangemaakt!']);

        $this->assertDatabaseHas('organisation', $organisation);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_register_a_organisation()
    {
        $organisation = make(Organisation::class)->toArray();

        $this->actingAs($this->user)->post('/organisaties/registreer', $organisation)
            ->assertSessionHas(['status' => 'Niet geautoriseerd!'])
            ->assertRedirect('/');
    }
}
