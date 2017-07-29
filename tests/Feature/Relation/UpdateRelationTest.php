<?php

namespace Tests\Feature\Relation;

use App\Dealcloser\Core\Organisation\Organisation;
use Tests\TestCase;
use App\Dealcloser\Core\Relation\Relation;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateRelationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_update_a_relation()
    {
        Relation::$withoutAppends = true;

        $this->superAdminRole->givePermissionTo($this->permissions['edit-relations']);
        $this->user->assignRole($this->superAdminRole->name);

        $relation = create(Relation::class);
        $toUpdate = collect(make(Relation::class))->merge(['id' => $relation->id])->toArray();

        $this->actingAs($this->user)->patchJson('/relaties/'.$relation->id, $toUpdate)
            ->assertJson(['status' => 'Geupdatet']);

        $this->assertDatabaseHas('relation', $toUpdate);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_update_a_relation()
    {
        $relation = create(Relation::class);
        $toUpdate = collect(make(Relation::class))->merge(['id' => $relation->id])->toArray();

        $this->actingAs($this->user)->patchJson('/relaties/'.$relation->id, $toUpdate)
            ->assertJson(['status' => 'Niet geautoriseerd!']);
    }

    /** @test */
    public function a_relation_can_have_relations()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-relations']);
        $this->user->assignRole($this->superAdminRole->name);

        $relation = create(Relation::class);
        $relationToAdd = create(Relation::class);

        $toUpdate = collect(make(Relation::class))
            ->merge(['relations_internal' => [$relationToAdd->id]])
            ->merge(['id' => $relation->id]);

        $this->actingAs($this->user)->patchJson('/relaties/'.$relation->id, $toUpdate->toArray());

        $this->assertDatabaseHas('relation_has_relation', [
            'relation_parent_id' => $relation->id,
            'relation_child_id'=> $relationToAdd->id,
            'type' => 'internal'
        ]);
    }

    /** @test */
    public function a_relation_can_have_no_relations()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-relations']);
        $this->user->assignRole($this->superAdminRole->name);

        $relation = create(Relation::class);
        $relationToAdd = create(Relation::class);

        $relation->syncRelations($relationToAdd->id, 'internal');

        $this->assertDatabaseHas('relation_has_relation', [
            'relation_parent_id' => $relation->id,
            'relation_child_id' => $relationToAdd->id,
            'type' => 'internal'
        ]);

        $toUpdate = collect(make(Relation::class))
            ->merge(['relations_internal' => []])
            ->merge(['id' => $relation->id]);

        $this->actingAs($this->user)->patchJson('/relaties/'.$relation->id, $toUpdate->toArray());

        $this->assertDatabaseMissing('relation_has_relation', [
            'relation_parent_id' => $relation->id,
            'relation_child_id'=> $relationToAdd->id,
            'type' => 'internal'
        ]);
    }

    /** @test */
    public function a_relation_can_have_organisations()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-relations']);
        $this->user->assignRole($this->superAdminRole->name);

        $relation = create(Relation::class);
        $organisationToAdd = create(Organisation::class);

        $toUpdate = collect(make(Relation::class))
            ->merge(['organisations_worked_at' => [$organisationToAdd->id]])
            ->merge(['id' => $relation->id]);

        $this->actingAs($this->user)->patchJson('/relaties/'.$relation->id, $toUpdate->toArray());

        $this->assertDatabaseHas('relation_has_organisation', [
            'relation_id' => $relation->id,
            'organisation_id'=> $organisationToAdd->id,
            'type' => 'worked_at'
        ]);
    }

    /** @test */
    public function a_relation_can_have_no_organisations()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-relations']);
        $this->user->assignRole($this->superAdminRole->name);

        $relation = create(Relation::class);
        $organisationToAdd = create(Organisation::class);

        $relation->syncOrganisations($organisationToAdd->id, 'worked_at');

        $this->assertDatabaseHas('relation_has_organisation', [
            'relation_id' => $relation->id,
            'organisation_id'=> $organisationToAdd->id,
            'type' => 'worked_at'
        ]);

        $toUpdate = collect(make(Relation::class))
            ->merge(['organisations_worked_at' => []])
            ->merge(['id' => $relation->id]);

        $this->actingAs($this->user)->patchJson('/relaties/'.$relation->id, $toUpdate->toArray());

        $this->assertDatabaseMissing('relation_has_organisation', [
            'relation_id' => $relation->id,
            'organisation_id'=> $organisationToAdd->id,
            'type' => 'worked_at'
        ]);
    }
}
