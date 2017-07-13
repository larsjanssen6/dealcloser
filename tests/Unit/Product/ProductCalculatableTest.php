<?php

namespace Tests\Unit\Product;

use Tests\TestCase;
use App\Dealcloser\Core\Product\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductCalculatableTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
    }

    /** @test */
    public function it_calculates_the_revenue_correctly()
    {
        $product = create(Product::class, ['price' => 200, 'amount' => 4]);

        $this->assertEquals(800, $product->revenue);
    }

    /** @test */
    public function it_calculates_the_total_purchase_correctly()
    {
        $product = create(Product::class, ['purchase' => 100, 'amount' => 2]);

        $this->assertEquals(200, $product->totalPurchase);
    }

    /** @test */
    public function it_calculates_the_gross_margin_correctly()
    {
        $product = create(Product::class, ['purchase' => 100, 'price' => 400, 'amount' => 100]);

        $this->assertEquals(30000, $product->grossMargin);
    }
}
