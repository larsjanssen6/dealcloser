<?php

namespace App\Http\Controllers\Web\Relation;

use App\Http\Controllers\Controller;
use App\Dealcloser\Interfaces\Repositories\INegotiationRepo;

class NegotiationController extends Controller
{
    /**
     * INegotiationRepo implementation.
     *
     * @var INegotiationRepo
     */
    private $negotiationRepo;

    /**
     * Create a new controller instance.
     *
     * @param INegotiationRepo $negotiationRepo
     */
    public function __construct(INegotiationRepo $negotiationRepo)
    {
        $this->negotiationRepo = $negotiationRepo;
    }

    /**
     * Show all negotiations.
     *
     * @return array
     */
    public function index()
    {
        $negotiations = $this->negotiationRepo->getAll();

        return [
                'roles' => $negotiations
                    ->where('type', 'role'),

                'characters' => $negotiations
                    ->where('type', 'character'),

                'profiles' => $negotiations
                    ->where('type', 'profile'),

                'decision_making_units' => $negotiations
                    ->where('type', 'dmu'),
        ];
    }
}
