<?php

namespace Tests\Unit\Relation;

use App\Dealcloser\Core\Organisation\Organisation;
use Tests\TestCase;
use App\Dealcloser\Core\Relation\Relation;
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
    public function it_belongs_to_a_character()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Relations\BelongsTo', $this->relation->character()
        );
    }

    /** @test */
    public function it_belongs_to_a_role()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Relations\BelongsTo', $this->relation->role()
        );
    }

    /** @test */
    public function it_belongs_to_a_dmu()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Relations\BelongsTo', $this->relation->dmu()
        );
    }

    /** @test */
    public function it_belongs_to_a_negotiation_profile()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Relations\BelongsTo', $this->relation->negotiationProfile()
        );
    }

    /** @test */
    public function it_belongs_to_many_relations_internal()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Relations\BelongsToMany', $this->relation->relationsInternal()
        );
    }

    /** @test */
    public function it_belongs_to_many_relations_external()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Relations\BelongsToMany', $this->relation->relationsExternal()
        );
    }

    /** @test */
    public function it_belongs_to_many_relations()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Relations\BelongsToMany', $this->relation->relations()
        );
    }

    /** @test */
    public function it_belongs_to_many_organisations_worked_at()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Relations\BelongsToMany', $this->relation->organisationsWorkedAt()
        );
    }

    /** @test */
    public function it_belongs_to_many_organisations_working_at()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Relations\BelongsToMany', $this->relation->organisationsWorkingAt()
        );
    }

    /** @test */
    public function it_belongs_to_many_organisations()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Relations\BelongsToMany', $this->relation->organisations()
        );
    }

    /** @test */
    public function it_can_attach_organisations()
    {
        $organisation = create(Organisation::class, [], 5);
        $this->relation->attachOrganisations($organisation->pluck('id'), 'working_at');
        $this->assertEquals($this->relation->organisations()->count(), 5);
    }

    /** @test */
    public function it_can_attach_relations()
    {
        $relation = create(Relation::class, [], 5);
        $this->relation->attachRelations($relation->pluck('id'), 'external');
        $this->assertEquals($this->relation->relations()->count(), 5);
    }
}