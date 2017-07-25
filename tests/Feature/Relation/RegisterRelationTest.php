<?php

namespace Tests\Feature\Relation;

use Tests\TestCase;
use App\Dealcloser\Core\Relation\Relation;
use App\Dealcloser\Core\Organisation\Organisation;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterRelationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_see_relation_registration_page()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['register-relations']);
        $this->user->assignRole($this->superAdminRole->name);

        $this->actingAs($this->user)->get('/relaties/registreer')
            ->assertSee('REGISTREER RELATIE');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_see_relation_registration_page()
    {
        $this->actingAs($this->user)->get('/relaties/registreer')
            ->assertRedirect('/')
            ->assertDontSee('REGISTREER RELATIE');
    }

    /** @test */
    public function a_user_with_the_right_permission_can_register_a_relation()
    {
        Relation::$withoutAppends = true;

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
        Relation::$withoutAppends = true;

        $relation = make(Relation::class)->toArray();

        $this->actingAs($this->user)->post('/relaties/registreer', $relation)
            ->assertSessionHas(['status' => 'Niet geautoriseerd!'])
            ->assertRedirect('/');

        $this->assertDatabaseMissing('relation', $relation);
    }

    /** @test */
    public function a_relation_can_have_organisations_working_at()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['register-relations']);
        $this->user->assignRole($this->superAdminRole->name);

        $organisation = create(Organisation::class);

        $relation = collect(make(Relation::class))
                        ->merge(['organisations_working_at' => [$organisation->id]]);

        $this->actingAs($this->user)->post('/relaties/registreer', $relation->toArray());

        $this->assertDatabaseHas('relation_has_organisation', [
            'relation_id' => 1,
            'organisation_id' => $organisation->id,
            'type' => 'working_at',
        ]);
    }

    /** @test */
    public function a_relation_can_have_organisations_worked_at()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['register-relations']);
        $this->user->assignRole($this->superAdminRole->name);

        $organisation = create(Organisation::class);

        $relation = collect(make(Relation::class))
            ->merge(['organisations_worked_at' => [$organisation->id]]);

        $this->actingAs($this->user)->post('/relaties/registreer', $relation->toArray());

        $this->assertDatabaseHas('relation_has_organisation', [
            'relation_id' => 1,
            'organisation_id' => $organisation->id,
            'type' => 'worked_at',
        ]);
    }

    /** @test */
    public function a_relation_can_have_relations_internal()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['register-relations']);
        $this->user->assignRole($this->superAdminRole->name);

        $relationToAdd = create(Relation::class);

        $relation = collect(make(Relation::class))
            ->merge(['relations_internal' => [$relationToAdd->id]]);

        $this->actingAs($this->user)->post('/relaties/registreer', $relation->toArray());

        $this->assertDatabaseHas('relation_has_relation', [
            'relation_parent_id' => 2,
            'relation_child_id' => $relationToAdd->id,
            'type' => 'internal',
        ]);
    }

    /** @test */
    public function a_relation_can_have_relations_external()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['register-relations']);
        $this->user->assignRole($this->superAdminRole->name);

        $relationToAdd = create(Relation::class);

        $relation = collect(make(Relation::class))
            ->merge(['relations_external' => [$relationToAdd->id]]);

        $this->actingAs($this->user)->post('/relaties/registreer', $relation->toArray());

        $this->assertDatabaseHas('relation_has_relation', [
            'relation_parent_id' => 2,
            'relation_child_id' => $relationToAdd->id,
            'type' => 'external',
        ]);
    }
}
