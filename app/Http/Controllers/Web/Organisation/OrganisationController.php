<?php

namespace App\Http\Controllers\Web\Organisation;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if (request()->wantsJson()) {
            return $this->organisationRepo->getAll();
        }

        return view('organisation.index')->with([
            'organisations' => $this->organisationRepo->paginate(Paginator::resolveCurrentPage())
        ]);
    }

    /**
     * Show a organisation.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->organisationRepo->find($id, [
            'category',
            'products'
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
            'categories' => $this->categoryRepo->findAll('type', 'organisation_category')->toArray(),
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
        $this->organisationRepo->update($organisation->id, $request->all());

        $organisation->syncProducts($request->products);

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
