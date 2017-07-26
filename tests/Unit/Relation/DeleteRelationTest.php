<?php

namespace Tests\Feature\Relation;

use Tests\TestCase;
use App\Dealcloser\Core\Relation\Relation;
use App\Dealcloser\Core\Organisation\Organisation;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeleteRelationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_destroy_a_relation()
    {
        Relation::$withoutAppends = true;

        $this->superAdminRole->givePermissionTo($this->permissions['edit-relations']);
        $this->user->assignRole($this->superAdminRole->name);

        $relation = create(Relation::class)->toArray();

        $total = Relation::count();

        $this->actingAs($this->user)->deleteJson('/relaties/'.$relation['id'])
            ->assertJson(['status' => 'Verwijderd']);

        $this->assertEquals($total - 1, Relation::count());
        $this->assertDatabaseMissing('relation', $relation);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_destroy_a_relation()
    {
        Relation::$withoutAppends = true;

        $relation = create(Relation::class)->toArray();

        $total = Relation::count();

        $this->actingAs($this->user)->deleteJson('/relaties/'.$relation['id'])
            ->assertJson(['status' => 'Niet geautoriseerd!']);

        $this->assertEquals($total, Relation::count());
        $this->assertDatabaseHas('relation', $relation);
    }

    /** @test */
    public function when_a_relation_is_destroyed_linked_relations_will_go_away()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-relations']);
        $this->user->assignRole($this->superAdminRole->name);

        $relationToLink = create(Relation::class);
        $relation = create(Relation::class);

        $relation->attachRelations([$relationToLink->id], 'internal');

        $this->assertDatabaseHas('relation_has_relation', [
            'relation_parent_id' => $relation->id,
            'relation_child_id' => $relationToLink->id,
            'type' => 'internal',
        ]);

        $this->actingAs($this->user)->deleteJson('/relaties/'.$relation->id);

        $this->assertDatabaseMissing('relation_has_relation', [
            'relation_parent_id' => $relation->id,
            'relation_child_id' => $relationToLink->id,
            'type' => 'internal',
        ]);
    }

    /** @test */
    public function when_a_relation_is_destroyed_linked_organisations_will_go_away()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-relations']);
        $this->user->assignRole($this->superAdminRole->name);

        $organisation = create(Organisation::class);
        $relation = create(Relation::class);

        $relation->attachOrganisations([$organisation->id], 'working_at');

        $this->assertDatabaseHas('relation_has_organisation', [
            'relation_id' => $relation->id,
            'organisation_id' => $organisation->id,
            'type' => 'working_at',
        ]);

        $this->actingAs($this->user)->deleteJson('/relaties/'.$relation->id);

        $this->assertDatabaseMissing('relation_has_organisation', [
            'relation_id' => $relation->id,
            'organisation_id' => $organisation->id,
            'type' => 'working_at',
        ]);
    }
}
