<?php

namespace Tests\Unit\Relation;

use Tests\TestCase;
use App\Dealcloser\Core\Relation\Relation;
use App\Dealcloser\Core\Organisation\Organisation;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RelationTest extends TestCase
{
    use DatabaseMigrations;

    protected $relation;

    public function setUp()
    {
        parent::setUp();

        $this->relation = create(Relation::class, [
            'name' => 'Jan',
            'preposition' => 'van',
            'last_name' => 'Janssen',
            'gender' => 0,
            'problem_owner' => 0,
            'married' => 0,
            'children' => 0,
            'newsletter' => 0,
            'o3' => 0,
            'events' => 0,
            'christmas_card' => 0,
            'send_email' => 0,
        ]);
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
    public function it_can_sync_organisations()
    {
        $organisation = create(Organisation::class, [], 5);
        $this->relation->syncOrganisations($organisation->pluck('id'), 'working_at');
        $this->assertEquals($this->relation->organisations()->count(), 5);

        $this->relation->syncOrganisations([], 'working_at');
        $this->assertEquals($this->relation->organisations()->count(), 0);
    }

    /** @test */
    public function it_can_sync_relations()
    {
        $relation = create(Relation::class, [], 5);
        $this->relation->syncRelations($relation->pluck('id'), 'external');
        $this->assertEquals($this->relation->relations()->count(), 5);

        $this->relation->syncRelations([], 'external');
        $this->assertEquals($this->relation->relations()->count(), 0);
    }

    /** @test */
    public function it_can_receive_his_full_name_with_preposition()
    {
        $this->assertEquals($this->relation->fullName, 'Jan van Janssen');
    }

    /** @test */
    public function it_can_receive_his_full_name_without_preposition()
    {
        $relation = create(Relation::class, ['name' => 'Jan', 'preposition' => null, 'last_name' => 'Janssen']);
        $this->assertEquals($relation->fullName, 'Jan Janssen');
    }

    /** @test */
    public function it_can_receive_his_gender_man()
    {
        $this->assertEquals($this->relation->hasGender, 'Man');
    }

    /** @test */
    public function it_can_receive_his_gender_woman()
    {
        $relation = create(Relation::class, ['gender' => 1]);
        $this->assertEquals($relation->hasGender, 'Vrouw');
    }

    /** @test */
    public function it_can_receive_problem_owner_no()
    {
        $this->assertEquals($this->relation->isProblemOwner, 'Nee');
    }

    /** @test */
    public function it_can_receive_problem_owner_yes()
    {
        $relation = create(Relation::class, ['problem_owner' => 1]);
        $this->assertEquals($relation->isProblemOwner, 'Ja');
    }

    /** @test */
    public function it_can_receive_is_married_no()
    {
        $this->assertEquals($this->relation->isProblemOwner, 'Nee');
    }

    /** @test */
    public function it_can_receive_is_married_yes()
    {
        $relation = create(Relation::class, ['married' => 1]);
        $this->assertEquals($relation->isProblemOwner, 'Ja');
    }

    /** @test */
    public function it_can_receive_has_children_no()
    {
        $this->assertEquals($this->relation->hasChildren, 'Nee');
    }

    /** @test */
    public function it_can_receive_has_children_yes()
    {
        $relation = create(Relation::class, ['children' => 1]);
        $this->assertEquals($relation->hasChildren, 'Ja');
    }

    /** @test */
    public function it_can_receive_wants_newsletter_no()
    {
        $this->assertEquals($this->relation->wantsNewsletter, 'Nee');
    }

    /** @test */
    public function it_can_receive_wants_newsletter_yes()
    {
        $relation = create(Relation::class, ['newsletter' => 1]);
        $this->assertEquals($relation->wantsNewsletter, 'Ja');
    }

    /** @test */
    public function it_can_receive_is_o3_no()
    {
        $this->assertEquals($this->relation->isO3, 'Nee');
    }

    /** @test */
    public function it_can_receive_is_o3_yes()
    {
        $relation = create(Relation::class, ['o3' => 1]);
        $this->assertEquals($relation->isO3, 'Ja');
    }

    /** @test */
    public function it_can_receive_wants_events_no()
    {
        $this->assertEquals($this->relation->wantsEvents, 'Nee');
    }

    /** @test */
    public function it_can_receive_wants_events_yes()
    {
        $relation = create(Relation::class, ['events' => 1]);
        $this->assertEquals($relation->wantsEvents, 'Ja');
    }

    /** @test */
    public function it_can_receive_wants_email_no()
    {
        $this->assertEquals($this->relation->wantsEmail, 'Nee');
    }

    /** @test */
    public function it_can_receive_wants_email_yes()
    {
        $relation = create(Relation::class, ['email' => 1]);
        $this->assertEquals($relation->wantsEmail, 'Ja');
    }

    /** @test */
    public function it_can_receive_wants_christmas_card_no()
    {
        $this->assertEquals($this->relation->wantsChristmasCard, 'Nee');
    }

    /** @test */
    public function it_can_receive_wants_christmas_card_yes()
    {
        $relation = create(Relation::class, ['christmas_card' => 1]);
        $this->assertEquals($relation->wantsChristmasCard, 'Ja');
    }
}
