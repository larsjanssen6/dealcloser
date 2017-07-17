<?php

namespace App\Http\Controllers\Relation;

use App\Dealcloser\Interfaces\Repositories\IProductRepo;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use DougSisk\CountryState\CountryState;
use App\Dealcloser\Core\Relation\Relation;
use App\Http\Requests\Relation\RelationRequest;
use App\Dealcloser\Interfaces\Repositories\ICategoryRepo;
use App\Dealcloser\Interfaces\Repositories\IRelationRepo;

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
     * IProduct implementation.
     *
     * @var IProductRepo
     */
    private $productRepo;

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
     * @param IProductRepo $productRepo
     * @param CountryState $countryState
     */
    public function __construct(IRelationRepo $relationRepo,
                                ICategoryRepo $categoryRepo,
                                IProductRepo $productRepo,
                                CountryState $countryState)
    {
        $this->middleware('permission:register-relations')->only('create', 'store');
        $this->middleware('permission:edit-relations')->only('update', 'destroy');
        $this->relationRepo = $relationRepo;
        $this->categoryRepo = $categoryRepo;
        $this->productRepo = $productRepo;
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
            'products'   => $this->productRepo->getAll(),
            'relations'  => $this->relationRepo->paginate(Paginator::resolveCurrentPage(), ['category', 'products']),
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
     * Store a relation.
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
     * Update a relation.
     *
     * @param RelationRequest $request
     * @param Relation        $relation
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RelationRequest $request, Relation $relation)
    {
        $relation->syncProducts($request->products);
        $this->relationRepo->update($relation->id, $request->all());

        return response()->json(['status' => 'Geupdatet']);
    }

    /**
     * Destroy a relation.
     *
     * @param Relation $relation
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Relation $relation)
    {
        $this->relationRepo->delete($relation->id);
        return response()->json(['status' => 'Verwijderd']);
    }
}
