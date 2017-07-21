<?php

namespace App\Dealcloser\Core\Relation;

use Illuminate\Database\Eloquent\Model;

class Negotiation extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'relation_negotiation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'type'
    ];
}
