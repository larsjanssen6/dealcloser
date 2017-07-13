<?php

namespace Tests\Unit\Product;

use App\Dealcloser\Logic\ProductCalculation;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductCalculationTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var
     */
    private $calculation;

    /**
     *  Instantiate new product calculation.
     */
    public function setUp()
    {
        parent::setUp();
        $this->calculation = new ProductCalculation();
    }

    /** @test */
    public function it_calculates_the_revenue_correctly()
    {
        $this->assertEquals(800, $this->calculation->revenue(200, 4));
    }

    /** @test */
    public function it_calculates_the_total_purchase_correctly()
    {
        $this->assertEquals(200, $this->calculation->totalPurchase(100, 2));
    }

    /** @test */
    public function it_calculates_the_gross_margin_correctly()
    {
        $this->assertEquals(200, $this->calculation->grossMargin(400, 200));
    }
}
