<?php

namespace Tests\Unit\Category;

use App\Dealcloser\Core\Category\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    protected $category;

    public function setUp()
    {
        parent::setUp();

        $this->category = create(Category::class);
    }

    /** @test */
    public function it_has_permissions()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->category->permissions
        );
    }
}
