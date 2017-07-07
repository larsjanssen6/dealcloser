<?php

namespace App\Http\Controllers\Relation;

use App\Dealcloser\Core\User\User;
use App\Dealcloser\Interfaces\Repositories\IRelationRepo;
use App\Http\Controllers\Controller;
use DougSisk\CountryState\CountryState;
use Illuminate\Http\Request;
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
     * CountriesRepo implementation
     *
     * @var CountriesRepository
     */
    private $countriesRepo;

    /**
     * Create a new controller instance. Only users with permission
     * register-relations have access to this controller.
     *
     * @param IRelationRepo $relationRepo
     */
    public function __construct(IRelationRepo $relationRepo)
    {
       // $this->middleware('permission:register-relations');
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
            //'relations' => $this->relationRepo->paginate(Paginator::resolveCurrentPage())
        ]);
    }

    public function create(CountryState $countryState)
    {
        return view('relation.create')->with([
            'categories' => User::all(),
            'countries' => collect($countryState->getCountries()),
        ]);
    }

    public function store(Request $request)
    {
        $this->relationRepo->create($request->all());
    }
}
