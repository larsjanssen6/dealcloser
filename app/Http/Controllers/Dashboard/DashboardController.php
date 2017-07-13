<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Dealcloser\Interfaces\Repositories\IUserRepo;
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
     * Create a new controller instance.
     * @param IRelationRepo $relationRepo
     * @param IUserRepo $userRepo
     */
    public function __construct(IRelationRepo $relationRepo, IUserRepo $userRepo)
    {
        $this->relationRepo = $relationRepo;
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        return view('dashboard/dashboard')->with([
            'total_relations' => $this->relationRepo->count(),
            'relations_latest' => $this->relationRepo->latest()->created_at,

            'total_users' => $this->userRepo->count(),
            'users_latest' => $this->userRepo->latest()->created_at,
        ]);
    }
}
