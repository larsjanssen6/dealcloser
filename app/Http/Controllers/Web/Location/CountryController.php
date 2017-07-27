<?php

namespace App\Http\Controllers\Web\Location;

use App\Http\Controllers\Controller;
use DougSisk\CountryState\CountryState;

class CountryController extends Controller
{
    /**
     * Return all countries.
     *
     * @param CountryState $countryState
     *
     * @return array
     */
    public function index(CountryState $countryState)
    {
        return $countryState->getCountries();
    }
}
