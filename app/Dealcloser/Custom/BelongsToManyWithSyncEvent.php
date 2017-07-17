<?php

namespace App\Dealcloser\Custom;

trait BelongsToManyWithSyncEvent
{
    /**
     * Custom belongs to many because by default it does not observes
     * changes on pivot tables. When a pivot table is changed return
     * a custom belongs to many with sync cache clear class.
     * Here we will clear the cache.
     *
     * @param $related
     * @param null $table
     * @param null $foreignKey
     * @param null $relatedKey
     * @param null $relation
     * @return BelongsToManyWithSyncCacheClear
     */
    public function belongsToMany($related, $table = null, $foreignKey = null, $relatedKey = null, $relation = null)
    {
        if (is_null($relation)) {
            $relation = $this->guessBelongsToManyRelation();
        }

        $instance = $this->newRelatedInstance($related);
        $foreignKey = $foreignKey ?: $this->getForeignKey();
        $relatedKey = $relatedKey ?: $instance->getForeignKey();

        if (is_null($table)) {
            $table = $this->joiningTable($related);
        }

        return new BelongsToManyWithSyncCacheClear(
            $instance->newQuery(), $this, $table, $foreignKey, $relatedKey, $relation
        );
    }
}
