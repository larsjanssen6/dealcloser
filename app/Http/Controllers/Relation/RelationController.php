<?php

namespace App\Http\Controllers\Relation;

use App\Dealcloser\Core\Relation\Relation;
use App\Dealcloser\Interfaces\Repositories\ICategoryRepo;
use App\Dealcloser\Interfaces\Repositories\IRelationRepo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Relation\RelationRequest;
use DougSisk\CountryState\CountryState;
use Illuminate\Pagination\Paginator;

class RelationController extends Controller
{
    /**
     * IRelationRepo implementation.
     *
     * @var IRelationRepo
     */
    private $relationRepo;

    /**
     * ICategory implementation.
     *
     * @var ICategoryRepo
     */
    private $categoryRepo;

    /**
     * CountryState implementation.
     *
     * @var CountryState
     */
    private $countryState;

    /**
     * Create a new controller instance.
     *
     * @param IRelationRepo $relationRepo
     * @param ICategoryRepo $categoryRepo
     * @param CountryState  $countryState
     */
    public function __construct(IRelationRepo $relationRepo, ICategoryRepo $categoryRepo, CountryState $countryState)
    {
        $this->middleware('permission:register-relations')->only('create', 'store');
        $this->middleware('permission:edit-relations')->only('update');
        $this->relationRepo = $relationRepo;
        $this->categoryRepo = $categoryRepo;
        $this->countryState = $countryState;
    }

    /**
     * Show all relations.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('relation.index')->with([
            'relations'  => $this->relationRepo->paginate(Paginator::resolveCurrentPage(), ['category']),
            'categories' => $this->categoryRepo->findAll('model_type', Relation::class),
            'countries'  => collect($this->countryState->getCountries()),
        ]);
    }

    /**
     * Show user create form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('relation.create')->with([
            'categories' => $this->categoryRepo->findAll('model_type', Relation::class),
            'countries'  => collect($this->countryState->getCountries()),
        ]);
    }

    /**
     * Store a user.
     *
     * @param RelationRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RelationRequest $request)
    {
        $this->relationRepo->create($request->all());

        return redirect('/relaties')
            ->with('status', 'Relatie aangemaakt!');
    }

    /**
     * @param RelationRequest $request
     * @param Relation        $relation
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RelationRequest $request, Relation $relation)
    {
        $this->relationRepo->update($relation->id, $request->all());

        return response()->json(['status' => 'Geupdatet']);
    }
}
