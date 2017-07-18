<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class IssetWithReturnTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_isset_and_it_returns_collection()
    {
        $this->assertEquals(issetWithReturn(collect(["name" => "james"])), collect(["name" => "james"]));
    }

    /** @test */
    public function it_is_not_set_and_it_returns_null()
    {
        $this->assertEquals(issetWithReturn(null), '');
    }
}
