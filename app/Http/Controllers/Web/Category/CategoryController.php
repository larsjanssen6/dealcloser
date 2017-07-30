<?php

namespace App\Http\Controllers\Web\Category;

use App\Http\Controllers\Controller;
use App\Dealcloser\Interfaces\Repositories\ICategoryRepo;

class CategoryController extends Controller
{
    /**
     * ICategoryRepo implementation.
     *
     * @var ICategoryRepo
     */
    private $categoryRepo;

    /**
     * Create a new controller instance.
     *
     * @param ICategoryRepo $categoryRepo
     */
    public function __construct(ICategoryRepo $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->categoryRepo->getAll();
    }
}
