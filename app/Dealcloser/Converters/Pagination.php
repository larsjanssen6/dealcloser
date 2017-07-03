<?php

namespace App\Dealcloser\Converters;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class Pagination
{
    /**
     * Convert to LengthAwarePaginator
     *
     * @param $toPaginate
     * @return LengthAwarePaginator
     */
    public function toLengthAware($toPaginate)
    {
        return new LengthAwarePaginator(
            $toPaginate->items,
            $toPaginate->totalItems,
            10,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]);
    }
}