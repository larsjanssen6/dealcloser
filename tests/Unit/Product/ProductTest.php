<?php

namespace Tests\Unit\Product;

use Tests\TestCase;
use App\Dealcloser\Core\Product\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_calculate()
    {
        $this->assertInstanceOf(
            'App\Dealcloser\Logic\ProductCalculation', (new Product())->calculate()
        );
    }
}
