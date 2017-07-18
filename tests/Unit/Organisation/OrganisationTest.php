<?php

namespace Tests\Unit\Organisation;

use Tests\TestCase;
use App\Dealcloser\Core\Product\Product;
use App\Dealcloser\Core\Organisation\Organisation;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OrganisationTest extends TestCase
{
    use DatabaseMigrations;

    protected $organisation;

    public function setUp()
    {
        parent::setUp();

        $this->organisation = create(Organisation::class);
    }

    /** @test */
    public function it_belongs_to_many_products()
    {
        $this->assertInstanceOf(
            '\Illuminate\Database\Eloquent\Relations\BelongsToMany', $this->organisation->products()
        );
    }

    /** @test */
    public function it_has_a_category()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Relations\BelongsTo', $this->organisation->category()
        );
    }

    /** @test */
    public function it_can_sync_products()
    {
        $products = create(Product::class, [], 5)->toArray();
        $this->organisation->syncProducts($products);
        $this->assertEquals($this->organisation->products()->count(), 5);
    }
}
