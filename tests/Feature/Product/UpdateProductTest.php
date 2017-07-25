<?php

namespace Tests\Feature\Product;

use Tests\TestCase;
use App\Dealcloser\Core\Product\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateProductTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_update_a_product()
    {
        Product::$withoutAppends = true;

        $this->superAdminRole->givePermissionTo($this->permissions['edit-products']);
        $this->user->assignRole($this->superAdminRole->name);

        $product = create(Product::class);
        $toUpdate = make(Product::class)->toArray();

        $this->actingAs($this->user)->patchJson('/producten/'.$product->id, $toUpdate)
            ->assertJson(['status' => 'Geupdatet']);

        $this->assertDatabaseHas('product', $toUpdate);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_update_a_product()
    {
        Product::$withoutAppends = true;

        $product = create(Product::class);
        $toUpdate = make(Product::class)->toArray();

        $this->actingAs($this->user)->patchJson('/producten/'.$product->id, $toUpdate)
            ->assertJson(['status' => 'Niet geautoriseerd!']);
    }
}
