<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;
use App\Dealcloser\Core\Settings\Settings;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SettingsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_returns_correct_settings()
    {
        Settings::set([
            'name'          => 'Riveau',
            'email'         => 'info@riveau.com',
            'phone'         => '0623844932',
            'website'       => 'http://www.riveau.com',
            'description'   => 'nvt',
            'address'       => 'boschlaan 10',
            'town'          => 'maasbree',
            'kvk'           => 'kvknumber',
            'btw'           => 'btwnumber',
            'users'         => 10,
            'license'       => 'licensenumber',
            'active'        => 1,
        ]);

        $this->assertEquals('Riveau', settings()->name);
        $this->assertEquals('info@riveau.com', settings()->email);
        $this->assertEquals('0623844932', settings()->phone);
        $this->assertEquals('http://www.riveau.com', settings()->website);
        $this->assertEquals('nvt', settings()->description);
        $this->assertEquals('boschlaan 10', settings()->address);
        $this->assertEquals('maasbree', settings()->town);
        $this->assertEquals('kvknumber', settings()->kvk);
        $this->assertEquals('btwnumber', settings()->btw);
        $this->assertEquals(10, settings()->users);
        $this->assertEquals('licensenumber', settings()->license);
        $this->assertEquals(1, settings()->active);
    }
}
