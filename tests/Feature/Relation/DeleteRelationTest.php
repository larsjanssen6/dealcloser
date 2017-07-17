<?php

namespace Tests\Feature\Relation;

use Tests\TestCase;
use App\Dealcloser\Core\Product\Product;
use App\Dealcloser\Core\Relation\Relation;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeleteRelationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_destroy_a_relation()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-relations']);
        $this->user->assignRole($this->superAdminRole->name);

        $relation = create(Relation::class);
        $total = Relation::count();

        $this->actingAs($this->user)->deleteJson('/relaties/'.$relation->id)
            ->assertJson(['status' => 'Verwijderd']);

        $this->assertEquals($total - 1, Relation::count());
        $this->assertDatabaseMissing('relation', $relation->toArray());
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_destroy_a_relation()
    {
        $relation = create(Relation::class);
        $total = Relation::count();

        $this->actingAs($this->user)->deleteJson('/relaties/'.$relation->id)
            ->assertJson(['status' => 'Niet geautoriseerd!']);

        $this->assertEquals($total, Relation::count());
        $this->assertDatabaseHas('relation', $relation->toArray());
    }

    /** @test */
    public function when_a_relation_is_destroyed_linked_products_will_go_away()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-relations']);
        $this->user->assignRole($this->superAdminRole->name);

        $product = create(Product::class)->toArray();
        $relation = create(Relation::class)->syncProducts([$product]);
        dd(Relation::with('products')->products);
        $this->actingAs($this->user)->deleteJson('/relaties/'.$relation->id);
        $this->assertDatabaseMissing('product_has_relations', [
            'product_id' => 1,
            'relation_id' => 1,
        ]);
    }
}
