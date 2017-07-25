<?php

namespace Tests\Feature\Organisation;

use Tests\TestCase;
use App\Dealcloser\Core\Product\Product;
use App\Dealcloser\Core\Organisation\Organisation;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateOrganisationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_update_a_organisation()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-organisations']);
        $this->user->assignRole($this->superAdminRole->name);

        $organisation = create(Organisation::class);
        $toUpdate = collect(make(Organisation::class))->merge(['id' => $organisation->id])->toArray();

        $this->actingAs($this->user)->patchJson('/organisaties/'.$organisation->id, $toUpdate)
            ->assertJson(['status' => 'Geupdatet']);

        $this->assertDatabaseHas('organisation', $toUpdate);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_update_a_organisation()
    {
        $organisation = create(Organisation::class);
        $toUpdate = collect(make(Organisation::class))->merge(['id' => $organisation->id])->toArray();

        $this->actingAs($this->user)->patchJson('/organisaties/'.$organisation->id, $toUpdate)
            ->assertJson(['status' => 'Niet geautoriseerd!']);
    }

    /** @test */
    public function a_organisation_can_have_products()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-organisations']);
        $this->user->assignRole($this->superAdminRole->name);

        $organisation = create(Organisation::class);
        $product = create(Product::class);

        $toUpdate = collect(make(Organisation::class))
            ->merge(['products' => [$product->id]])
            ->merge(['id' => $organisation->id]);

        $this->actingAs($this->user)->patchJson('/organisaties/'.$organisation->id, $toUpdate->toArray());

        $this->assertDatabaseHas('organisation_has_product', [
            'product_id' => $product->id,
            'organisation_id'=> $organisation->id,
        ]);
    }

    /** @test */
    public function a_organisation_can_have_no_products()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-organisations']);
        $this->user->assignRole($this->superAdminRole->name);

        $organisation = create(Organisation::class);
        $product = create(Product::class);

        $organisation->syncProducts($product->id);

        $this->assertDatabaseHas('organisation_has_product', [
            'product_id' => $product->id,
            'organisation_id'=> $organisation->id,
        ]);

        $toUpdate = collect(make(Organisation::class))
            ->merge(['products' => []])
            ->merge(['id' => $organisation->id]);

        $this->actingAs($this->user)->patchJson('/organisaties/'.$organisation->id, $toUpdate->toArray());

        $this->assertDatabaseMissing('organisation_has_product', [
            'product_id' => $product->id,
            'organisation_id'=> $organisation->id,
        ]);
    }
}
