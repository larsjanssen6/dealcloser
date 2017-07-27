<?php

namespace App\Http\Controllers\Web\Dashboard;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Dealcloser\Interfaces\Repositories\IUserRepo;
use App\Dealcloser\Interfaces\Repositories\IProductRepo;
use App\Dealcloser\Interfaces\Repositories\IOrganisationRepo;

class DashboardController extends Controller
{
    /**
     * IOrganisationRepo implementation.
     *
     * @var IOrganisationRepo
     */
    private $organisationRepo;

    /**
     * IUserRepo implementation.
     *
     * @var IUserRepo
     */
    private $userRepo;

    /**
     * IProductRepo implementation.
     *
     * @var IProductRepo
     */
    private $productRepo;

    /**
     * Create a new controller instance.
     * @param IOrganisationRepo $organisationRepo
     * @param IUserRepo $userRepo
     * @param IProductRepo $productRepo
     */
    public function __construct(IOrganisationRepo $organisationRepo,
                                IUserRepo $userRepo,
                                IProductRepo $productRepo)
    {
        $this->organisationRepo = $organisationRepo;
        $this->userRepo = $userRepo;
        $this->productRepo = $productRepo;
    }

    public function index()
    {
        $products = $this->productRepo->getAll();
        $organisations = $this->organisationRepo->getAll();
        $users = $this->userRepo->getAll();

        return view('dashboard/dashboard')->with([
            /*
            * Get organisation information
            */

            'organisations_total'               => $organisations->count(),
            'organisations_latest'              => $organisations->last(),
            'organisations_total_last_month'    => $organisations->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth())
                                                        ->where('created_at', '<=', Carbon::now()->startOfMonth())->count(),
            'organisations_total_current_month' => $organisations->where('created_at', '>=', Carbon::now()->startOfMonth())->count(),

            /*
            * Get user information
            */

            'users_total'           => $users->count(),
            'users_latest'          => $users->last(),

            /*
             * Get product information
             */

            'products_total'        => $products->count(),
            'products_latest'       => $products->last(),
            'products_revenue'      => $products->sum('revenue'),
            'products_gross_margin' => $products->sum('grossMargin'),
            'products_purchase'     => $products->sum('purchase'),
            'products_price'        => $products->sum('price'),
        ]);
    }
}
