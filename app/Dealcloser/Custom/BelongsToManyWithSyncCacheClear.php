<?php

namespace App\Dealcloser\Custom;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Cache\Repository as CacheRepository;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BelongsToManyWithSyncCacheClear extends BelongsToMany {

    /**
     * BelongsToManyWithSyncEvents constructor.
     *
     * @param Builder $query
     * @param Model $parent
     * @param string $table
     * @param string $foreignKey
     * @param string $relatedKey
     * @param null $relationName
     */
    public function __construct(Builder $query, Model $parent, $table, $foreignKey, $relatedKey, $relationName = null)
    {
        parent::__construct($query, $parent, $table, $foreignKey, $relatedKey, $relationName);
    }

    /**
     * When a pivot table is being synced,
     * we will clear the cache.
     *
     * @param array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection $ids
     * @param bool $detaching
     * @return array
     */
    public function sync($ids, $detaching = true) {

        $changes = parent::sync($ids, $detaching);

        resolve(CacheRepository::class)->tags(get_class($this->parent))->flush();

        return $changes;
    }
}