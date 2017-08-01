<?php

namespace App\Dealcloser\Core\Relation;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use App\Dealcloser\Traits\CustomModelLogic;
use App\Dealcloser\Traits\RelationAttributes;
use App\Dealcloser\Core\Organisation\Organisation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    public function character() : belongsTo
    {
        return $this->belongsTo(Negotiation::class);
    }

    /**
     * A relation belongs to a dmu.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dmu() : belongsTo
    {
        return $this->belongsTo(Negotiation::class);
    }

    /**
     * A relation belongs to a role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role() : belongsTo
    {
        return $this->belongsTo(Negotiation::class);
    }

    /**
     * A relation belongs to a negotiation profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function negotiationProfile() : belongsTo
    {
        return $this->belongsTo(Negotiation::class);
    }

    /**
     * A relation belongs to many relations internal.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function relationsInternal() : belongsToMany
    {
        return $this->belongsToMany(self::class, 'relation_has_relation', 'relation_parent_id', 'relation_child_id')->wherePivot('type', 'internal');
    }

    /**
     * A relation belongs to many relations external.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function relationsExternal() : belongsToMany
    {
        return $this->belongsToMany(self::class, 'relation_has_relation', 'relation_parent_id', 'relation_child_id')->wherePivot('type', 'external');
    }

    /**
     * A relation belongs to many relations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function relations() : belongsToMany
    {
        return $this->belongsToMany(self::class, 'relation_has_relation', 'relation_parent_id', 'relation_child_id');
    }

    /**
     * A relation belongs to many organisations worked at.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function organisationsWorkedAt() : belongsToMany
    {
        return $this->belongsToMany(Organisation::class, 'relation_has_organisation')->wherePivot('type', 'worked_at');
    }

    /**
     * A relation belongs to many organisations working at.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function organisationsWorkingAt() : belongsToMany
    {
        return $this->belongsToMany(Organisation::class, 'relation_has_organisation')->wherePivot('type', 'working_at');
    }

    /**
     * A relation belongs to many organisations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function organisations() : belongsToMany
    {
        return $this->belongsToMany(Organisation::class, 'relation_has_organisation');
    }

    /**
     * Sync relations.
     *
     * @param $relations
     * @param $type
     * @return $this
     */
    public function syncRelations($relations, $type)
    {
        $relations = collect($relations)->mapWithKeys(function ($relation) use ($type) {
            return [$relation => ['type' => $type]];
        })->toArray();

        if ($type === 'external') {
            $this->relationsexternal()->sync($relations);
        } elseif ($type === 'internal') {
            $this->relationsinternal()->sync($relations);
        }

        return $this;
    }

    /**
     * Sync relations.
     *
     * @param $organisations
     * @param $type
     * @return $this
     */
    public function syncOrganisations($organisations, $type)
    {
        $organisations = collect($organisations)->mapWithKeys(function ($organisation) use ($type) {
            return [$organisation => ['type' => $type]];
        })->toArray();

        if ($type === 'worked_at') {
            $this->organisationsWorkedAt()->sync($organisations);
        } elseif ($type === 'working_at') {
            $this->organisationsWorkingAt()->sync($organisations);
        }

        return $this;
    }
}
