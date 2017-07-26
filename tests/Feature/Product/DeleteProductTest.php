<?php

namespace Tests\Feature\Product;

use Tests\TestCase;
use App\Dealcloser\Core\Product\Product;
use App\Dealcloser\Core\Organisation\Organisation;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeleteProductTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_destroy_a_product()
    {
        Product::$withoutAppends = true;

        $this->superAdminRole->givePermissionTo($this->permissions['edit-products']);
        $this->user->assignRole($this->superAdminRole->name);

        $product = create(Product::class)->toArray();

        $total = Product::count();

        $this->actingAs($this->user)->deleteJson('/producten/'.$product['id'])
            ->assertJson(['status' => 'Verwijderd']);

        $this->assertEquals($total - 1, Product::count());
        $this->assertDatabaseMissing('product', $product);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_destroy_a_product()
    {
        Product::$withoutAppends = true;

        $product = create(Product::class)->toArray();

        $total = Product::count();

        $this->actingAs($this->user)->deleteJson('/producten/'.$product['id'])
            ->assertJson(['status' => 'Niet geautoriseerd!']);

        $this->assertEquals($total, Product::count());
        $this->assertDatabaseHas('product', $product);
    }

    /** @test */
    public function when_a_product_is_destroyed_linked_relations_will_go_away()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-products']);
        $this->user->assignRole($this->superAdminRole->name);

        $product = create(Product::class);
        $organisation = create(Organisation::class);

        $organisation->syncProducts([$organisation->id]);

        $this->assertDatabaseHas('organisation_has_product', [
            'product_id' => $product->id,
            'organisation_id' => $organisation->id,
        ]);

        $this->actingAs($this->user)->deleteJson('/producten/'.$product->id);

        $this->assertDatabaseMissing('organisation_has_product', [
            'product_id' => $product->id,
            'organisation_id'=> $organisation->id,
        ]);
    }
}
