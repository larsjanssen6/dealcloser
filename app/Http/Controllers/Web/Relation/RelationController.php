<?php

namespace App\Http\Controllers\Web\Relation;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use DougSisk\CountryState\CountryState;
use App\Dealcloser\Core\Relation\Relation;
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
        $this->middleware('permission:edit-relations')->only('destroy', 'update');
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
        if (request()->wantsJson()) {
            return $this->relationRepo->getAll();
        }

        return view('relation.index')->with([
            'relations' => $this->relationRepo->paginate(Paginator::resolveCurrentPage()),
        ]);
    }

    /**
     * Show relation create page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('relation.create')->with(array_merge($this->negotiations(), [
            'organisations' => $this->organisationRepo
                ->getAll()
                ->toArray(),

            'relations' => $this->relationRepo
                ->getAll()
                ->toArray(),
        ]));
    }

    /**
     * Show a relation.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->relationRepo->find($id, [
            'character',
            'dmu',
            'role',
            'negotiationProfile',
            'relationsInternal',
            'relationsExternal',
            'organisationsWorkedAt',
            'organisationsWorkingAt',
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

        $this->syncAll($request, $relation);

        return redirect('/relaties')
            ->with('status', 'Relatie aangemaakt!');
    }

    /**
     * @param RelationRequest $request
     * @param Relation $relation
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RelationRequest $request, Relation $relation)
    {
        $this->relationRepo->update($relation->id, $request->all());

        $this->syncAll($request, $relation);

        return response()->json(['status' => 'Geupdatet']);
    }

    /**
     * Destroy a relation.
     *
     * @param Relation $relation
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Relation $relation)
    {
        $this->relationRepo->delete($relation->id);

        return response()->json(['status' => 'Verwijderd']);
    }

    /**
     * Sync everything on relation model.
     *
     * @param RelationRequest $request
     * @param Relation $relation
     */
    public function syncAll(RelationRequest $request, Relation $relation)
    {
        $relation->syncRelations($request->relations_internal, 'internal');
        $relation->syncRelations($request->relations_external, 'external');

        $relation->syncOrganisations($request->organisations_working_at, 'working_at');
        $relation->syncOrganisations($request->organisations_worked_at, 'worked_at');
    }

    /**
     * Get all negotiations.
     *
     * @return array
     */
    public function negotiations()
    {
        $negotiations = $this->negotiationRepo->getAll();

        return [
            'negotiations' => [
                'roles' => $negotiations
                ->where('type', 'role'),

                    'characters' => $negotiations
                ->where('type', 'character'),

                    'profiles' => $negotiations
                ->where('type', 'profile'),

                    'decision_making_units' => $negotiations
                ->where('type', 'dmu'),
            ],
        ];
    }
}
