<?php

namespace App\Http\Controllers\Relation;

use App\Dealcloser\Core\Relation\Relation;
use App\Dealcloser\Interfaces\Repositories\ICategoryRepo;
use App\Dealcloser\Interfaces\Repositories\IRelationRepo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Relation\RelationRequest;
use DougSisk\CountryState\CountryState;
use PragmaRX\Countries\Support\CountriesRepository;

class RelationController extends Controller
{
    /**
     * IRelationRepo implementation
     *
     * @var IRelationRepo
     */
    private $relationRepo;

    /**
     * ICategory implementation
     *
     * @var ICategoryRepo
     */
    private $categoryRepo;

    /**
     * Create a new controller instance. Only users with permission
     * register-relations have access to this controller.
     *
     * @param IRelationRepo $relationRepo
     * @param ICategoryRepo $categoryRepo
     */
    public function __construct(IRelationRepo $relationRepo, ICategoryRepo $categoryRepo)
    {
        $this->middleware('permission:register-relations')->only('create', 'store');
        $this->relationRepo = $relationRepo;
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Show all relations.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('relation.index')->with([
            //'relations' => $this->relationRepo->paginate(Paginator::resolveCurrentPage())
        ]);
    }

    public function create(CountryState $countryState)
    {
        return view('relation.create')->with([
            'categories' => $this->categoryRepo->findAll('type', 'corporation-categories'),
            'countries' => collect($countryState->getCountries()),
        ]);
    }

    public function store(RelationRequest $request)
    {
        $this->relationRepo->create($request->all());

        return redirect('/relaties')
            ->with('status', 'Relate aangemaakt!');
    }
}
