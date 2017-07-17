<?php

namespace Tests\Unit\Relation;

use App\Dealcloser\Core\Product\Product;
use App\Dealcloser\Core\Relation\Relation;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RelationTest extends TestCase
{
    use DatabaseMigrations;

    protected $relation;

    public function setUp()
    {
        parent::setUp();

        $this->relation = create(Relation::class);
    }

    /** @test */
    public function it_has_many_products()
    {
        $this->assertInstanceOf(
            '\Illuminate\Database\Eloquent\Relations\BelongsToMany', $this->relation->products()
        );
    }

    /** @test */
    public function it_has_a_category()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Relations\BelongsTo', $this->relation->category()
        );
    }

    /** @test */
    public function it_can_sync_products()
    {
        $products = create(Product::class, [], 5)->toArray();
        $this->relation->syncProducts($products);
        $this->assertEquals($this->relation->products()->count(), 5);
    }
}
