<?php

namespace Tests\Feature\Organisation;

use Tests\TestCase;
use App\Dealcloser\Core\Product\Product;
use App\Dealcloser\Core\Organisation\Organisation;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeleteOrganisationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_destroy_a_organisation()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-organisations']);
        $this->user->assignRole($this->superAdminRole->name);

        $organisation = create(Organisation::class);
        $total = Organisation::count();

        $this->actingAs($this->user)->deleteJson('/organisaties/'.$organisation->id)
            ->assertJson(['status' => 'Verwijderd']);

        $this->assertEquals($total - 1, Organisation::count());
        $this->assertDatabaseMissing('organisation', $organisation->toArray());
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_destroy_a_organisation()
    {
        $organisation = create(Organisation::class);
        $total = Organisation::count();

        $this->actingAs($this->user)->deleteJson('/organisaties/'.$organisation->id)
            ->assertJson(['status' => 'Niet geautoriseerd!']);

        $this->assertEquals($total, Organisation::count());
        $this->assertDatabaseHas('organisation', $organisation->toArray());
    }

    /** @test */
    public function when_a_organisation_is_destroyed_linked_products_will_go_away()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-organisations']);
        $this->user->assignRole($this->superAdminRole->name);

        $product = create(Product::class);
        $organisation = create(Organisation::class);

        $organisation->syncProducts([$product->id]);

        $this->assertDatabaseHas('organisation_has_product', [
            'product_id' => $product->id,
            'organisation_id' => $organisation->id,
        ]);

        $this->actingAs($this->user)->deleteJson('/organisaties/'.$organisation->id);

        $this->assertDatabaseMissing('organisation_has_product', [
            'product_id' => $product->id,
            'organisation_id'=> $organisation->id,
        ]);
    }
}
