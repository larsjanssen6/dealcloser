<?php

namespace App\Http\Controllers\Web\Department;

use App\Http\Controllers\Controller;
use App\Dealcloser\Interfaces\Repositories\IDepartmentRepo;

class DepartmentController extends Controller
{
    /**
     * IDepartmentRepo implementation.
     *
     * @var IDepartmentRepo
     */
    private $departmentRepo;

    /**
     * Create a new controller instance.
     *
     * @param IDepartmentRepo $departmentRepo
     */
    public function __construct(IDepartmentRepo $departmentRepo)
    {
        $this->departmentRepo = $departmentRepo;
    }

    /**
     * Show all departments.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->departmentRepo->getAll();
    }
}
