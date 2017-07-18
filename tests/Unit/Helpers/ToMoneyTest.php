<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ToMoneyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_returns_money_format_in_euro()
    {
        $this->assertEquals(toMoney(12), '€ 12.00');
    }
}
