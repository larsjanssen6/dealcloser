<?php

namespace App\Http\Controllers\State;

use App\Http\Controllers\Controller;
use DougSisk\CountryState\CountryState;

class StateController extends Controller
{
    /**
     * Return all states based on a country.
     *
     * @param $country
     * @param CountryState $countryState
     * @return array
     */
    public function index($country, CountryState $countryState)
    {
        return $countryState->getStates($country);
    }
}
