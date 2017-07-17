<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Dealcloser\Interfaces\Repositories\IUserRepo;
use App\Dealcloser\Interfaces\Repositories\IProductRepo;
use App\Dealcloser\Interfaces\Repositories\IRelationRepo;

class DashboardController extends Controller
{
    /**
     * IRelationRepo implementation.
     *
     * @var IRelationRepo
     */
    private $relationRepo;

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
     * @param IRelationRepo $relationRepo
     * @param IUserRepo $userRepo
     * @param IProductRepo $productRepo
     */
    public function __construct(IRelationRepo $relationRepo,
                                IUserRepo $userRepo,
                                IProductRepo $productRepo)
    {
        $this->relationRepo = $relationRepo;
        $this->userRepo = $userRepo;
        $this->productRepo = $productRepo;
    }

    public function index()
    {
        $products = $this->productRepo->getAll();
        $relations = $this->relationRepo->getAll();

        return view('dashboard/dashboard')->with([
            /*
            * Get relation information
            */

            'relations_total'               => $relations->count(),
            'relations_latest'              => $relations->last(),
            'relations_total_last_month'    => $relations->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth())
                                                        ->where('created_at', '<=', Carbon::now()->startOfMonth())->count(),
            'relations_total_current_month' => $relations->where('created_at', '>=', Carbon::now()->startOfMonth())->count(),

            /*
            * Get user information
            */

            'users_total'           => $this->userRepo->count(),
            'users_latest'          => $this->userRepo->latest(),

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
