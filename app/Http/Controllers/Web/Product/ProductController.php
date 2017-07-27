<?php

namespace App\Http\Controllers\Web\Product;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use App\Dealcloser\Core\Product\Product;
use App\Http\Requests\Product\ProductRequest;
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
        $this->middleware('permission:edit-products')->only('update', 'destroy');
        $this->productRepo = $productRepo;
    }

    /**
     * Show all products.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('product.index')->with([
            'products' => $this->productRepo->paginate(Paginator::resolveCurrentPage()),
        ]);
    }

    /**
     * Show product create page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a product.
     *
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $this->productRepo->create($request->all());

        return redirect('/producten')
            ->with('status', 'Product aangemaakt!');
    }

    /**
     * Update a product.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->productRepo->update($product->id, $request->all());

        return response()->json(['status' => 'Geupdatet']);
    }

    /**
     * Destroy a product.
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $this->productRepo->delete($product->id);

        return response()->json(['status' => 'Verwijderd']);
    }
}
