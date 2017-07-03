<?php

namespace App\Http\Controllers\User;

use App\Dealcloser\Converters\Pagination;
use App\Dealcloser\Interfaces\Repositories\IUserRepo;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * IUserRepo implementation
     *
     * @var IUserRepo
     */
    private $userRepo;

    /**
     * Create a new controller instance. Only users with permission
     * register-users have access to this controller.
     *
     * @param IUserRepo $userRepo
     */
    public function __construct(IUserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Show all users.
     *
     * @param Pagination $pagination
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Pagination $pagination)
    {
        return view('user.users')->with([
            'users' => $pagination->toLengthAware($this->userRepo->paginate())
        ]);
    }
}
