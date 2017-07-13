<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use App\Dealcloser\Interfaces\Repositories\IProductRepo;

class ProductController extends Controller
{
    /**
     * IProductRepo implementation.
     *
     * @var IProductRepo
     */
    private $productRepo;

    /**
     * Create a new controller instance. Only users with permission
     * register-products have access to this controller.
     *
     * @param IProductRepo $productRepo
     */
    public function __construct(IProductRepo $productRepo)
    {
        $this->middleware('permission:register-products')->only('create', 'store');
        $this->productRepo = $productRepo;
    }

    public function index()
    {
        return view('product.index')->with([
            'products' => $this->productRepo->paginate(Paginator::resolveCurrentPage()),
        ]);
    }

    public function create()
    {
    }

    public function store()
    {
    }
}
