<?php

namespace App\Http\Controllers\Web\Role;

use App\Http\Controllers\Controller;
use App\Dealcloser\Interfaces\Repositories\IRoleRepo;

class RoleController extends Controller
{
    /**
     * IRoleRepo implementation.
     *
     * @var IRoleRepo
     */
    private $roleRepo;

    /**
     * Create a new controller instance.
     *
     * @param IRoleRepo       $roleRepo
     */
    public function __construct(IRoleRepo $roleRepo)
    {
        $this->roleRepo = $roleRepo;
    }

    /**
     * Show all users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->roleRepo->getAll();
    }
}
