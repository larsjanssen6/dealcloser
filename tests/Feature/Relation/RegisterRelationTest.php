<?php

namespace Tests\Feature\Relation;

use App\Dealcloser\Core\Relation\Relation;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RegisterRelationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_see_relation_registration_page()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['register-relations']);
        $this->user->assignRole($this->superAdminRole->name);

        $this->actingAs($this->user)->get('/relaties/registreer')
            ->assertSee('Registreer relatie');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_see_relation_registration_page()
    {
        $this->actingAs($this->user)->get('/relaties/registreer')
            ->assertRedirect('/')
            ->assertDontSee('Registreer gebruiker');
    }

    /** @test */
    public function a_user_with_the_right_permission_can_register_a_relation()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['register-relations']);
        $this->user->assignRole($this->superAdminRole->name);

        $relation = make(Relation::class)->toArray();

        $this->actingAs($this->user)->post('/relaties/registreer', $relation)
            ->assertRedirect('/relaties')
            ->assertSessionHas(['status' => 'Relatie aangemaakt!']);

        $this->assertDatabaseHas('relation', $relation);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_register_a_relation()
    {
        $relation = make(Relation::class)->toArray();

        $this->actingAs($this->user)->post('/relaties/registreer', $relation)
            ->assertSessionHas(['status' => 'Niet geautoriseerd!'])
            ->assertRedirect('/');
    }
}
