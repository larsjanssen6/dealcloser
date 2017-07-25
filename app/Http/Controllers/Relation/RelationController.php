<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use DougSisk\CountryState\CountryState;
use App\Http\Requests\Relation\RelationRequest;
use App\Dealcloser\Interfaces\Repositories\IRelationRepo;
use App\Dealcloser\Interfaces\Repositories\INegotiationRepo;
use App\Dealcloser\Interfaces\Repositories\IOrganisationRepo;

class RelationController extends Controller
{
    /**
     * CountryState implementation.
     *
     * @var CountryState
     */
    private $countryState;

    /**
     * INegotiationRepo implementation.
     *
     * @var INegotiationRepo
     */
    private $negotiationRepo;

    /**
     * IOrganisationRepo implementation.
     *
     * @var IOrganisationRepo
     */
    private $organisationRepo;

    /**
     * IRelationRepo implementation.
     *
     * @var IRelationRepo
     */
    private $relationRepo;

    /**
     * Create a new controller instance.
     *
     * @param CountryState $countryState
     * @param INegotiationRepo $negotiationRepo
     * @param IOrganisationRepo $organisationRepo
     * @param IRelationRepo $relationRepo
     */
    public function __construct(CountryState $countryState,
                                INegotiationRepo $negotiationRepo,
                                IOrganisationRepo $organisationRepo,
                                IRelationRepo $relationRepo)
    {
        $this->middleware('permission:register-relations')->only('create', 'store');
        $this->countryState = $countryState;
        $this->negotiationRepo = $negotiationRepo;
        $this->organisationRepo = $organisationRepo;
        $this->relationRepo = $relationRepo;
    }

    /**
     * Show all relations.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('relation.index')->with([
            'relations' => $this->relationRepo->paginate(Paginator::resolveCurrentPage(), [
                'character',
                'dmu',
                'role',
                'negotiationProfile',
                'relationsInternal',
                'relationsExternal',
                'organisationsWorkedAt',
                'organisationsWorkingAt',
            ]),
        ]);
    }

    /**
     * Show relation create page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $negotiations = $this->negotiationRepo->getAll();

        return view('relation.create')->with([
//            'countries' => $this->countryState->getCountries(),

            'roles' => $negotiations
                ->where('type', 'role'),

            'characters' => $negotiations
                ->where('type', 'character'),

            'profiles' => $negotiations
                ->where('type', 'profile'),

            'decision_making_units' => $negotiations
                ->where('type', 'dmu'),

            'organisations' => $this->organisationRepo->getAll()->toArray(),
            'relations' => $this->relationRepo->getAll()->toArray(),
        ]);
    }

    /**
     * Store a relation.
     *
     * @param RelationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RelationRequest $request)
    {
        $relation = $this->relationRepo->create($request->all());
        $relation->attachRelations($request->relations_internal, 'internal');
        $relation->attachRelations($request->relations_external, 'external');

        $relation->attachOrganisations($request->organisations_working_at, 'working_at');
        $relation->attachOrganisations($request->organisations_worked_at, 'worked_at');

        return redirect('/relaties')
            ->with('status', 'Relatie aangemaakt!');
    }
}
