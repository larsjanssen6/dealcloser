<?php

namespace Tests\Feature\Relation;

use App\Dealcloser\Core\Relation\Relation;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UpdateRelationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_update_a_relation()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-relations']);
        $this->user->assignRole($this->superAdminRole->name);

        $relation = create(Relation::class);
        $toUpdate = collect(make(Relation::class))->merge(['id' => $relation->id])->toArray();

        $this->actingAs($this->user)->patchJson('/relaties/' . $relation->id, $toUpdate)
            ->assertJson(['status' => 'Geupdatet']);

        $this->assertDatabaseHas('relation', $toUpdate);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_update_a_relation()
    {
        $relation = create(Relation::class);
        $toUpdate = collect(make(Relation::class))->merge(['id' => $relation->id])->toArray();

        $this->actingAs($this->user)->patchJson('/relaties/' . $relation->id, $toUpdate)
            ->assertJson(['status' => 'Niet geautoriseerd!']);
    }
}

