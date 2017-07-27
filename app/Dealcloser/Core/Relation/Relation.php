<?php

namespace App\Dealcloser\Core\Relation;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use App\Dealcloser\Traits\CustomModelLogic;
use App\Dealcloser\Traits\RelationAttributes;
use App\Dealcloser\Core\Organisation\Organisation;

class Relation extends Model
{
    use HasSlug,
        RelationAttributes,
        CustomModelLogic;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'relation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'preposition',
        'last_name',
        'initial',
        'email',
        'linkedin',
        'phone',
        'gender',
        'country_code',
        'state_code',
        'function',
        'date_of_birth',
        'employee_since',
        'role_id',
        'character_id',
        'negotiation_profile_id',
        'dmu_id',
        'problem_owner',
        'worked_at',
        'hobbies',
        'married',
        'children',
        'newsletter',
        'o3',
        'events',
        'send_email',
        'christmas_card',
        'experience_with_us',
        'track_record',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'full_name',
        'has_gender',
        'is_problem_owner',
        'is_married',
        'has_children',
        'wants_newsletter',
        'is_o3',
        'wants_events',
        'wants_email',
        'wants_christmas_card',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * A relation belongs to a character.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function character()
    {
        return $this->belongsTo(Negotiation::class);
    }

    /**
     * A relation belongs to a dmu.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dmu()
    {
        return $this->belongsTo(Negotiation::class);
    }

    /**
     * A relation belongs to a role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Negotiation::class);
    }

    /**
     * A relation belongs to a negotiation profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function negotiationProfile()
    {
        return $this->belongsTo(Negotiation::class);
    }

    /**
     * A relation belongs to many relations internal.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function relationsInternal()
    {
        return $this->belongsToMany(self::class, 'relation_has_relation', 'relation_parent_id', 'relation_child_id')->where('type', 'internal');
    }

    /**
     * A relation belongs to many relations external.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function relationsExternal()
    {
        return $this->belongsToMany(self::class, 'relation_has_relation', 'relation_parent_id', 'relation_child_id')->where('type', 'external');
    }

    /**
     * A relation belongs to many relations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function relations()
    {
        return $this->belongsToMany(self::class, 'relation_has_relation', 'relation_parent_id', 'relation_child_id');
    }

    /**
     * A relation belongs to many organisations worked at.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function organisationsWorkedAt()
    {
        return $this->belongsToMany(Organisation::class, 'relation_has_organisation')->where('type', 'worked_at');
    }

    /**
     * A relation belongs to many organisations working at.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function organisationsWorkingAt()
    {
        return $this->belongsToMany(Organisation::class, 'relation_has_organisation')->where('type', 'working_at');
    }

    /**
     * A relation belongs to many organisations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function organisations()
    {
        return $this->belongsToMany(Organisation::class, 'relation_has_organisation');
    }

    /**
     * Attach relations with relation.
     *
     * @param $relations
     * @param $type
     *
     * @return $this
     */
    public function attachRelations($relations, $type)
    {
        $this->relations()->attach($relations, ['type' => $type]);

        return $this;
    }

    /**
     * Attach relations with organisation.
     *
     * @param $relations
     * @param $type
     *
     * @return $this
     */
    public function attachOrganisations($relations, $type)
    {
        $this->organisations()->attach($relations, ['type' => $type]);

        return $this;
    }
}
