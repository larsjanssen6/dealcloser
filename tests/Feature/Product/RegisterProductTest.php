<?php

namespace Tests\Feature\Product;

use Tests\TestCase;
use App\Dealcloser\Core\Product\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterProductTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_see_product_registration_page()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['register-products']);
        $this->user->assignRole($this->superAdminRole->name);

        $this->actingAs($this->user)->get('/producten/registreer')
            ->assertSee('Registreer product');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_see_product_registration_page()
    {
        $this->actingAs($this->user)->get('/producten/registreer')
            ->assertRedirect('/')
            ->assertDontSee('Registreer product');
    }

    /** @test */
    public function a_user_with_the_right_permission_can_register_a_product()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['register-products']);
        $this->user->assignRole($this->superAdminRole->name);

        $product = collect(make(Product::class))
            ->except('revenue', 'totalPurchase', 'grossMargin')
            ->toArray();

        $this->actingAs($this->user)->post('/producten/registreer', $product)
            ->assertRedirect('/producten')
            ->assertSessionHas(['status' => 'Product aangemaakt!']);

        $this->assertDatabaseHas('product', $product);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_register_a_product()
    {
        $product = collect(make(Product::class))
            ->except('revenue', 'totalPurchase', 'grossMargin')
            ->toArray();

        $this->actingAs($this->user)->post('/producten/registreer', $product)
            ->assertSessionHas(['status' => 'Niet geautoriseerd!'])
            ->assertRedirect('/');
    }
}
