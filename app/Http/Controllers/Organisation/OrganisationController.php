<?php

namespace App\Http\Controllers\Organisation;

use Gate;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use DougSisk\CountryState\CountryState;
use App\Dealcloser\Core\Organisation\Organisation;
use App\Http\Requests\Organisation\OrganisationRequest;
use App\Dealcloser\Interfaces\Repositories\IProductRepo;
use App\Dealcloser\Interfaces\Repositories\ICategoryRepo;
use App\Dealcloser\Interfaces\Repositories\IOrganisationRepo;

class OrganisationController extends Controller
{
    /**
     * IOrganisation implementation.
     *
     * @var IOrganisationRepo
     */
    private $organisationRepo;

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
     * @param IOrganisationRepo $organisationRepo
     * @param ICategoryRepo $categoryRepo
     * @param IProductRepo $productRepo
     * @param CountryState $countryState
     */
    public function __construct(IOrganisationRepo $organisationRepo,
                                ICategoryRepo $categoryRepo,
                                IProductRepo $productRepo,
                                CountryState $countryState)
    {
        $this->middleware('permission:register-organisations')->only('create', 'store');
        $this->middleware('permission:edit-organisations')->only('update', 'destroy');
        $this->organisationRepo = $organisationRepo;
        $this->categoryRepo = $categoryRepo;
        $this->productRepo = $productRepo;
        $this->countryState = $countryState;
    }

    /**
     * Show all organisations.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (Gate::allows('edit-organisations')) {
            $products = $this->productRepo->getAll();
            $categories = $this->categoryRepo->findAll('model_type', Organisation::class);
            $countries = collect($this->countryState->getCountries());
        }

        return view('organisation.index')->with([
            'products'   => isset($products) ? $products : '',
            'organisations'  => $this->organisationRepo->paginate(Paginator::resolveCurrentPage(), ['category', 'products']),
            'categories' => isset($categories) ? $categories : '',
            'countries'  => isset($countries) ? $countries : '',
        ]);
    }

    /**
     * Show user create form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('organisation.create')->with([
            'categories' => $this->categoryRepo->findAll('model_type', Organisation::class),
            'countries'  => collect($this->countryState->getCountries()),
        ]);
    }

    /**
     * Store a organisation.
     *
     * @param OrganisationRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OrganisationRequest $request)
    {
        $this->organisationRepo->create($request->all());

        return redirect('/organisaties')
            ->with('status', 'Organisatie aangemaakt!');
    }

    /**
     * Update a organisation.
     *
     * @param OrganisationRequest $request
     * @param Organisation    $organisation
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OrganisationRequest $request, Organisation $organisation)
    {
        $organisation->syncProducts($request->products);
        $this->organisationRepo->update($organisation->id, $request->all());

        return response()->json(['status' => 'Geupdatet']);
    }

    /**
     * Destroy a organisation.
     *
     * @param Organisation $organisation
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Organisation $organisation)
    {
        $this->organisationRepo->delete($organisation->id);

        return response()->json(['status' => 'Verwijderd']);
    }
}
