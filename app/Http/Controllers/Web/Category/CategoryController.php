<?php

namespace App\Http\Controllers\Web\Category;

use App\Dealcloser\Interfaces\Repositories\ICategoryRepo;
use App\Http\Controllers\Controller;

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
